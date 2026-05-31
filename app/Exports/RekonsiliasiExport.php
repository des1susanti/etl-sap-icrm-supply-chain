<?php

namespace App\Exports;

use App\Models\Reconciliation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

// REVISI: Tambah WithHeadings dan WithMapping agar hasil export
// punya header kolom dan data terformat, bukan raw object model
class RekonsiliasiExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // REVISI: Eager load relasi user agar kolom "Dibuat Oleh" bisa diisi
        return Reconciliation::with('user')->get();
    }

    public function headings(): array
    {
        return [
            'ID LAPORAN',
            'PERIODE',
            'TANGGAL PROSES',
            'TOTAL ITEM',
            'MATCH',
            'MISMATCH',
            'SAP ONLY',
            'ICRM ONLY',
            'DIBUAT OLEH',
            'STATUS',
        ];
    }

    public function map($rekon): array
    {
        return [
            'REP-' . str_pad($rekon->id, 8, '0', STR_PAD_LEFT),
            $rekon->periode        ?? '-',
            $rekon->created_at->format('d M Y, H:i'),
            $rekon->total_count    ?? 0,
            $rekon->match_count    ?? 0,
            $rekon->mismatch_count ?? 0,
            $rekon->sap_only_count ?? 0,
            $rekon->icrm_only_count ?? 0,
            $rekon->user?->name    ?? 'System',
            ucfirst($rekon->status ?? '-'),
        ];
    }
}