<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IcrmData extends Model
{
    protected $table = 'icrm_data';

    protected $fillable = [
        'upload_log_id',
        'no',
        'petugas',
        'nama_mitra',
        'tanggal_bawa',
        'durasi_bawa',
        'serial_number',
        'brand',
        'category',
        'material_number',
        'nama_material',
        'unit',
        'jumlah',
    ];
}