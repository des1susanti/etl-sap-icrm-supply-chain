<?php

namespace App\Exports;

use App\Models\Reconciliation;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;


class DetailRekonsiliasiExport implements WithMultipleSheets
{
    protected $id;
    protected $filter;

    public function __construct($id, $filter = 'all')
    {
        $this->id     = $id;
        $this->filter = $filter;
    }

    public function sheets(): array
    {
        return [
            new RingkasanSheet($this->id),
            new DetailDataSheet($this->id, $this->filter),
        ];
    }
}

/**
 * ─────────────────────────────────────────────────
 * HELPER: Tentukan displayStatus dari 1 baris data
 * ─────────────────────────────────────────────────
 * REVISI: Dibuat jadi function helper agar tidak
 * ditulis ulang di collection() dan map() — sumber
 * kebenaran cukup di satu tempat.
 */
function resolveDisplayStatus($row): string
{
    if (($row->status ?? '') === 'match') {
        return 'match';
    } elseif (!empty($row->sap_material) && !empty($row->icrm_material)) {
        return 'mismatch_diff';
    } elseif (!empty($row->sap_material) && empty($row->icrm_material)) {
        return 'sap_only';
    } else {
        return 'icrm_only';
    }
}


/**
 * TAB 1: RINGKASAN TOTAL INDIKATOR
 */
class RingkasanSheet implements FromCollection, WithHeadings, WithMapping, WithTitle
{
    protected $id;

    public function __construct($id) { $this->id = $id; }

    public function title(): string { return 'Ringkasan Laporan'; }

    public function collection()
    {
        return Reconciliation::with('user')->where('id', $this->id)->get();
    }

    public function headings(): array
    {
        // REVISI: Tambah kolom MISMATCH (BEDA MATERIAL) agar lengkap 5 indikator
        // sesuai tampilan web (Total, Match, Mismatch, SAP Only, ICRM Only)
        return [
            'ID LAPORAN', 'PERIODE', 'TANGGAL PROSES', 'TOTAL ITEM',
            'MATCH (SINKRON)', 'MISMATCH (BEDA MATERIAL)', 'SAP ONLY', 'ICRM ONLY',
            'DIBUAT OLEH', 'STATUS'
        ];
    }

    public function map($rekon): array
    {
        // Ambil semua hasil dari DB sekali saja
        $allResults = DB::table('reconciliation_results')
            ->where('reconciliation_id', $rekon->id)
            ->get();

        // REVISI: Hitung semua kategori dari data aktual, bukan dari kolom summary
        // agar konsisten dengan logika di web dan DetailDataSheet
        $matched      = 0;
        $mismatchDiff = 0;
        $sapOnly      = 0;
        $icrmOnly     = 0;

        foreach ($allResults as $row) {
            $st = resolveDisplayStatus($row);
            if ($st === 'match')         $matched++;
            elseif ($st === 'mismatch_diff') $mismatchDiff++;
            elseif ($st === 'sap_only')  $sapOnly++;
            else                          $icrmOnly++;
        }

        $total = $allResults->count();

        return [
            'REP-' . str_pad($rekon->id, 8, '0', STR_PAD_LEFT),
            $rekon->periode,
            $rekon->created_at->format('d M Y, H:i'),
            $total,
            $matched,
            $mismatchDiff,  // REVISI: Kolom baru mismatch_diff
            $sapOnly,
            $icrmOnly,
            $rekon->user?->name ?? 'System',
            ucfirst($rekon->status),
        ];
    }
}

/**
 * TAB 2: DETAIL DATA
 */
class DetailDataSheet implements FromCollection, WithHeadings, WithMapping, WithTitle
{
    protected $id;
    protected $filter;

    // REVISI: Pindah rowNumber ke dalam collection agar tidak rawan salah
    // jika objek di-reuse — nilainya di-reset lewat konstruktor
    private $rowNumber = 0;

    public function __construct($id, $filter = 'all')
    {
        $this->id        = $id;
        $this->filter    = $filter;
        $this->rowNumber = 0; // REVISI: Eksplisit reset di konstruktor
    }

    public function title(): string { return 'Hasil Detail Pencocokan'; }

    public function collection()
    {
        $results = DB::table('reconciliation_results')
            ->where('reconciliation_id', $this->id)
            ->get();

        return $results->filter(function ($row) {

            // REVISI: Gunakan helper, tidak tulis ulang logic
            $displayStatus = resolveDisplayStatus($row);

            if ($this->filter === 'all')      return true;
            if ($this->filter === 'match')    return $displayStatus === 'match';
            if ($this->filter === 'mismatch') return $displayStatus !== 'match';

            return $displayStatus === $this->filter;

        })->values();
    }

    public function headings(): array
    {
        return [
            '#',
            'SERIAL NUMBER', 'STATUS COCOK', 'KETERANGAN',
            'MATERIAL SAP', 'DESKRIPSI SAP', 'BATCH SAP', 'PLANT SAP', 'STORAGE LOCATION SAP', 'SYSTEM STATUS SAP',
            'MATERIAL NUMBER ICRM', 'NAMA MATERIAL ICRM', 'PETUGAS ICRM', 'MITRA ICRM', 'TANGGAL BAWA ICRM', 'DURASI BAWA ICRM'
        ];
    }

    public function map($row): array
    {
        $this->rowNumber++;

        // REVISI: Gunakan helper, tidak tulis ulang logic
        $displayStatus = resolveDisplayStatus($row);

        $statusLabel = $displayStatus === 'match' ? 'MATCH' : 'MISMATCH';

        $keterangan = match($displayStatus) {
            'match'         => 'Serial Number & Material cocok',
            'mismatch_diff' => 'Serial Number sama tetapi Material berbeda',
            'sap_only'      => 'Data hanya ada di SAP',
            'icrm_only'     => 'Data hanya ada di ICRM+',
            default         => 'Tidak Diketahui',
        };

        return [
            $this->rowNumber,
            $row->serial_number,
            $statusLabel,
            $keterangan,

            // Kolom SAP
            $row->sap_material, $row->sap_description, $row->sap_batch,
            $row->sap_plant,    $row->sap_location,    $row->sap_system_status,

            // Kolom ICRM
            $row->icrm_material,  $row->icrm_nama_material, $row->icrm_petugas,
            $row->icrm_mitra,     $row->icrm_tanggal_bawa,  $row->icrm_durasi_bawa,
        ];
    }
}