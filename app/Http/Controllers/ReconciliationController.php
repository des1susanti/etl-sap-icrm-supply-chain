<?php

namespace App\Http\Controllers;

use App\Models\Reconciliation;
use App\Models\SapData;
use App\Models\IcrmData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Exports\RekonsiliasiExport;
use App\Exports\DetailRekonsiliasiExport;
use Maatwebsite\Excel\Facades\Excel;

class ReconciliationController extends Controller
{
    public function index(Request $request)
    {
        $query = Reconciliation::with('user')
            ->withCount('results as results_count');

        if ($request->from) {
            $query->whereDate('created_at', '>=', $request->from);
        }

        if ($request->to) {
            $query->whereDate('created_at', '<=', $request->to);
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('id', 'like', '%' . $request->search . '%')
                  ->orWhere('periode', 'like', '%' . $request->search . '%');
            });
        }

        $reconciliations = $query->latest()->paginate(15);

        $stats = [
            'total'     => Reconciliation::count(),
            'completed' => Reconciliation::where('status', 'completed')->count(),
            'pending'   => Reconciliation::whereIn('status', ['draft', 'processing'])->count(),
            'failed'    => Reconciliation::where('status', 'failed')->count(),
        ];

        return view('reconciliation.index', compact('reconciliations', 'stats'));
    }

    public function create()
    {
        return view('reconciliation.create');
    }

    public function show($id)
    {
        $rekon = Reconciliation::with(['user', 'results'])->findOrFail($id);

        return view('reconciliation.show', compact('rekon'));
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $rekon = Reconciliation::findOrFail($id);

        return view('reconciliation.edit', compact('rekon'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

  public function update(Request $request, $id)
{
    $request->validate([
        'periode' => 'required',
    ]);

    $rekon = Reconciliation::findOrFail($id);

    $rekon->update([
        'periode' => $request->periode,
    ]);

    return redirect()
        ->route('reconciliation.show', $rekon->id)
        ->with('success', 'Periode berhasil diperbarui.');
}

    public function store(Request $request)
    {
        Log::info('ETL dipanggil oleh user: ' . (auth()->id() ?? 'NULL') . ' | periode: ' . $request->periode);

        $request->validate([
            'periode' => 'required|date',
        ], [
            'periode.required' => 'Periode rekonsiliasi wajib diisi.',
        ]);

        // Mengonversi tanggal dari form (YYYY-MM-DD) menjadi YYYY-MM untuk pencarian database
        $periodeInput = date('Y-m', strtotime($request->periode));

        // 1. Cari log berdasarkan periode YYYY-MM
        $sapLogIds = DB::table('upload_logs')
            ->where('periode', 'like', '%' . $periodeInput . '%')
            ->where('type', 'SAP')
            ->where('status', 'success')
            ->pluck('id');

        $icrmLogIds = DB::table('upload_logs')
            ->where('periode', 'like', '%' . $periodeInput . '%')
            ->where('type', 'ICRM')
            ->where('status', 'success')
            ->pluck('id');

        // 2. Hitung jumlah data berdasarkan log periode tersebut
        $sapCount  = SapData::whereIn('upload_log_id', $sapLogIds)->count();
        $icrmCount = IcrmData::whereIn('upload_log_id', $icrmLogIds)->count();

        if ($sapCount == 0) {
            return back()->with('error', 'Data SAP untuk periode ' . $periodeInput . ' belum diunggah atau statusnya belum sukses.');
        }

        if ($icrmCount == 0) {
            return back()->with('error', 'Data ICRM+ untuk periode ' . $periodeInput . ' belum diunggah atau statusnya belum sukses.');
        }

        DB::beginTransaction();

        try {

            $rekon = Reconciliation::create([
                'user_id'    => auth()->id() ?? 1,
                'periode'    => $periodeInput,
                'status'     => 'processing',
                'sap_count'  => $sapCount,
                'icrm_count' => $icrmCount,
            ]);

            Log::info('Rekon dibuat ID: ' . $rekon->id);

            // 3. Tarik data spesifik yang sesuai dengan log upload periode ini saja
            $sapData = SapData::whereIn('upload_log_id', $sapLogIds)
                ->get()
                ->keyBy(fn($r) => strtoupper(trim($r->serial_number)));

            $icrmData = IcrmData::whereIn('upload_log_id', $icrmLogIds)
                ->get()
                ->keyBy(fn($r) => strtoupper(trim($r->serial_number)));

            Log::info('SAP Periode Ini: ' . $sapData->count() . ' | ICRM Periode Ini: ' . $icrmData->count());

            $results = [];

            $stats = [
                'match'     => 0,
                'mismatch'  => 0,
                'sap_only'  => 0,
                'icrm_only' => 0,
            ];

            foreach ($sapData as $sn => $sap) {

                if ($icrmData->has($sn)) {

                    $icrm = $icrmData[$sn];

                    if (trim($sap->material) === trim($icrm->material_number)) {

                        $status = 'match';
                        $stats['match']++;

                    } else {

                        $status = 'mismatch';
                        $stats['mismatch']++;
                    }

                } else {

                    $icrm = null;
                    $status = 'mismatch';

                    $stats['sap_only']++;
                    $stats['mismatch']++;
                }

                $results[] = [
                    'reconciliation_id'  => $rekon->id,
                    'serial_number'      => $sap->serial_number,
                    'status'             => $status,
                    'sap_material'       => $sap->material,
                    'sap_description'    => $sap->description,
                    'sap_batch'          => $sap->batch,
                    'sap_plant'          => $sap->plant,
                    'sap_location'       => $sap->stor_location,
                    'sap_system_status'  => $sap->system_status,
                    'icrm_material'      => $icrm?->material_number,
                    'icrm_nama_material' => $icrm?->nama_material,
                    'icrm_petugas'       => $icrm?->petugas,
                    'icrm_mitra'         => $icrm?->nama_mitra,
                    'icrm_tanggal_bawa'  => $icrm?->tanggal_bawa,
                    'icrm_durasi_bawa'   => $icrm?->durasi_bawa,
                    'created_at'         => now(),
                    'updated_at'         => now(),
                ];
            }

            foreach ($icrmData as $sn => $icrm) {

                if (!$sapData->has($sn)) {

                    $status = 'mismatch';

                    $stats['icrm_only']++;
                    $stats['mismatch']++;

                    $results[] = [
                        'reconciliation_id'  => $rekon->id,
                        'serial_number'      => $icrm->serial_number,
                        'status'             => $status,
                        'sap_material'       => null,
                        'sap_description'    => null,
                        'sap_batch'          => null,
                        'sap_plant'          => null,
                        'sap_location'       => null,
                        'sap_system_status'  => null,
                        'icrm_material'      => $icrm->material_number,
                        'icrm_nama_material' => $icrm->nama_material,
                        'icrm_petugas'       => $icrm->petugas,
                        'icrm_mitra'         => $icrm->nama_mitra,
                        'icrm_tanggal_bawa'  => $icrm->tanggal_bawa,
                        'icrm_durasi_bawa'   => $icrm->durasi_bawa,
                        'created_at'         => now(),
                        'updated_at'         => now(),
                    ];
                }
            }

            Log::info('Total results: ' . count($results));

            foreach (array_chunk($results, 500) as $chunk) {
                DB::table('reconciliation_results')->insert($chunk);
            }

            Log::info('Insert selesai, update rekon...');

            $rekon->update([
                'status'          => 'draft',
                'match_count'     => $stats['match'],
                'mismatch_count'  => $stats['mismatch'],
                'sap_only_count'  => $stats['sap_only'],
                'icrm_only_count' => $stats['icrm_only'],
                'total_count'     => count($results),
            ]);

            DB::commit();

            Log::info('ETL SELESAI - Match: ' . $stats['match'] . ' | Mismatch: ' . $stats['mismatch']);

            return redirect()
                ->route('reconciliation.show', $rekon->id)
                ->with('success', "ETL selesai! Match: {$stats['match']} | Mismatch: {$stats['mismatch']}");

        } catch (\Exception $e) {

            DB::rollBack();

            Log::error(
                'ETL GAGAL: '
                . $e->getMessage()
                . ' | Line: '
                . $e->getLine()
                . ' | File: '
                . $e->getFile()
            );

            return back()->with('error', 'Gagal proses ETL: ' . $e->getMessage());
        }
    }

    public function approve($id)
    {
        $rekon = Reconciliation::findOrFail($id);

        $rekon->update([
            'status'      => 'completed',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);

        return back()->with('success', 'Rekonsiliasi berhasil diapprove.');
    }

    public function destroy($id)
    {
        $rekon = Reconciliation::findOrFail($id);

        DB::table('reconciliation_results')
            ->where('reconciliation_id', $id)
            ->delete();

        $rekon->delete();

        return redirect()
            ->route('reconciliation.index')
            ->with(
                'success',
                'Rekonsiliasi REP-' .
                str_pad($id, 8, '0', STR_PAD_LEFT) .
                ' berhasil dihapus.'
            );
    }

    public function exportDetail(Request $request, $id)
    {
        $rekon = Reconciliation::findOrFail($id);

        $filter = $request->query('filter', 'all');

        $fileName =
            'Detail_Rekonsiliasi_' .
            strtoupper($filter) .
            '_' .
            str_replace('/', '-', $rekon->periode) .
            '_REP-' .
            str_pad($rekon->id, 8, '0', STR_PAD_LEFT) .
            '.xlsx';

        return Excel::download(
            new DetailRekonsiliasiExport($id, $filter),
            $fileName
        );
    }

    public function exportExcel()
    {
        $fileName = 'laporan_rekonsiliasi_all_' . date('Y-m-d') . '.xlsx';

        return Excel::download(new RekonsiliasiExport, $fileName);
    }

    public function process($id)
    {
        return back();
    }
}
