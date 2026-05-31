<?php

namespace App\Http\Controllers;

use App\Models\UploadLog;
use App\Models\SapData;
use App\Models\IcrmData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;

class UploadController extends Controller
{
  
    public function index()
    {
        $logs = UploadLog::with('user')->latest()->paginate(10);
        return view('upload.index', compact('logs'));
     dd($logs);   
    }

    public function uploadSAP(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls|max:10240',
        ], [
            'file.required' => 'File SAP wajib dipilih.',
            'file.mimes'    => 'Format file harus .xlsx atau .xls.',
            'file.max'      => 'Ukuran file maksimal 10MB.',
        ]);

        // Proteksi Periode dinamis (default ke bulan berjalan jika tidak dikirim dari form)
     $currentPeriode = $request->periode;

        $file     = $request->file('file');
        $filename = 'SAP_' . date('Ymd_His') . '_' . $file->getClientOriginalName();
        $path     = $file->storeAs('uploads/sap', $filename);

        $fullPath    = storage_path('app/private/' . $path);
        $spreadsheet = IOFactory::load($fullPath);
        $sheet       = $spreadsheet->getActiveSheet();
        $rows        = $sheet->toArray(null, true, true, true);

        DB::beginTransaction();
        try {
            // Ambil ID log lama pada periode yang sama untuk dibersihkan datanya (Mencegah Duplikasi)
            $oldLogIds = UploadLog::where('periode', $currentPeriode)
                ->where('type', 'SAP')
                ->pluck('id');

            // Hapus data SAP lama spesifik untuk periode ini saja (Jangan pakai truncate)
            SapData::whereIn('upload_log_id', $oldLogIds)->delete();
            UploadLog::whereIn('id', $oldLogIds)->delete();

           $log = UploadLog::create([
    'user_id'   => auth()->id(),
    'type'      => 'SAP',
    'file_type' => 'sap',
    'filename'  => $filename,
    'file_name' => $filename,
    'status'    => 'processing',
    'row_count' => 0,
    'periode'   => $currentPeriode,
]);

\Log::info('UPLOAD LOG SAP CREATED', [
    'id' => $log->id,
    'filename' => $filename,
    'periode' => $currentPeriode,
]);

$rowCount = 0;
            $insertData = [];

            foreach ($rows as $i => $row) {
                if ($i == 1) continue;
                if (empty(array_filter($row))) continue;

                $insertData[] = [
                    'upload_log_id' => $log->id,
                    'material'      => trim((string)($row['A'] ?? '')),
                    'description'   => $row['B'] ?? null,
                    'batch'         => $row['C'] ?? null,
                    'plant'         => $row['D'] ?? null,
                    'stor_location' => $row['E'] ?? null,
                    'serial_number' => trim((string)($row['F'] ?? '')),
                    'created_by'    => $row['G'] ?? null,
                    'system_status' => $row['H'] ?? null,
                    'changed_on'    => $row['I'] ?? null,
                    'created_on'    => $row['J'] ?? null,
                    'changed_by'    => $row['K'] ?? null,
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ];

                $rowCount++;
            }

            // Gunakan chunk insert agar proses upload jauh lebih cepat dan hemat memori
            foreach (array_chunk($insertData, 500) as $chunk) {
                SapData::insert($chunk);
            }

            $log->update(['status' => 'success', 'row_count' => $rowCount]);
            DB::commit();

            return back()->with('success', "File SAP berhasil diunggah: {$filename} ({$rowCount} baris data)");

        } catch (\Exception $e) {
    DB::rollBack();

    \Log::error('UPLOAD SAP ERROR: ' . $e->getMessage());

    return back()->with('error', $e->getMessage());
}
    }

    public function uploadICRM(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls|max:10240',
        ], [
            'file.required' => 'File ICRM+ wajib dipilih.',
            'file.mimes'    => 'Format file harus .xlsx atau .xls.',
            'file.max'      => 'Ukuran file maksimal 10MB.',
        ]);

        $currentPeriode = $request->periode;

        $file     = $request->file('file');
        $filename = 'ICRM_' . date('Ymd_His') . '_' . $file->getClientOriginalName();
        $path     = $file->storeAs('uploads/icrm', $filename);

        $fullPath    = storage_path('app/private/' . $path);
        $spreadsheet = IOFactory::load($fullPath);
        $sheet       = $spreadsheet->getActiveSheet();
        $rows        = $sheet->toArray(null, true, true, true);

        DB::beginTransaction();
        try {
            // Ambil ID log lama pada periode yang sama untuk dibersihkan datanya
            $oldLogIds = UploadLog::where('periode', $currentPeriode)
                ->where('type', 'ICRM')
                ->pluck('id');

            // Hapus data ICRM lama spesifik untuk periode ini saja
            IcrmData::whereIn('upload_log_id', $oldLogIds)->delete();
            UploadLog::whereIn('id', $oldLogIds)->delete();

      $log = UploadLog::create([
    'user_id'   => auth()->id(),
    'type'      => 'ICRM',
    'file_type' => 'icrm',
    'filename'  => $filename,
    'file_name' => $filename,
    'status'    => 'processing',
    'row_count' => 0,
    'periode'   => $currentPeriode,
]);

\Log::info('UPLOAD LOG ICRM CREATED', [
    'id' => $log->id,
    'filename' => $filename,
    'periode' => $currentPeriode,
]);

$rowCount = 0;
            $insertData = [];

            foreach ($rows as $i => $row) {
                if ($i == 1) continue;
                if (empty(array_filter($row))) continue;

                $insertData[] = [
                    'upload_log_id'   => $log->id,
                    'no'              => $row['A'] ?? null,
                    'petugas'         => $row['B'] ?? null,
                    'nama_mitra'      => $row['C'] ?? null,
                    'tanggal_bawa'    => $row['D'] ?? null,
                    'durasi_bawa'     => $row['E'] ?? null,
                    'serial_number'   => trim((string)($row['F'] ?? '')),
                    'brand'           => $row['G'] ?? null,
                    'category'        => $row['H'] ?? null,
                    'material_number' => trim((string)($row['I'] ?? '')),
                    'nama_material'   => $row['J'] ?? null,
                    'unit'            => $row['K'] ?? null,
                    'jumlah'          => $row['L'] ?? null,
                    'created_at'      => now(),
                    'updated_at'      => now(),
                ];

                $rowCount++;
            }

            foreach (array_chunk($insertData, 500) as $chunk) {
                IcrmData::insert($chunk);
            }

            $log->update(['status' => 'success', 'row_count' => $rowCount]);
            DB::commit();

            return back()->with('success', "File ICRM+ berhasil diunggah: {$filename} ({$rowCount} baris data)");

        } catch (\Exception $e) {
    DB::rollBack();

    \Log::error('UPLOAD ICRM ERROR: ' . $e->getMessage());

    return back()->with('error', $e->getMessage());
}
    }

    public function destroy($id)
    {
        $log = UploadLog::findOrFail($id);
        
        // Hapus data anak tabel sebelum log utamanya dihapus agar tidak menjadi data sampah
        if (strtoupper($log->type) === 'SAP') {
            SapData::where('upload_log_id', $log->id)->delete();
        } elseif (strtoupper($log->type) === 'ICRM') {
            IcrmData::where('upload_log_id', $log->id)->delete();
        }

        $log->delete();
        return back()->with('success', 'Log upload dan data terkait berhasil dihapus.');
    }

    public function logs()
    {
        $logs = UploadLog::with('user')->latest()->paginate(20);
        return view('upload.index', compact('logs'));
    }
}