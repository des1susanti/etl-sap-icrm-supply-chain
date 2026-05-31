<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReconciliationResult extends Model
{
    protected $table = 'reconciliation_results';

    protected $fillable = [
        'reconciliation_id',
        'serial_number',
        'status',
        'sap_material',
        'sap_description',
        'sap_batch',
        'sap_plant',
        'sap_location',
        'sap_system_status',
        'icrm_material',
        'icrm_nama_material',
        'icrm_petugas',
        'icrm_mitra',
        'icrm_tanggal_bawa',
        'icrm_durasi_bawa',
    ];

    public function reconciliation()
    {
        return $this->belongsTo(Reconciliation::class);
    }
}