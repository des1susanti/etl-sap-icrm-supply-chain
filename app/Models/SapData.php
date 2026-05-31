<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SapData extends Model
{
    protected $table = 'sap_data';

    protected $fillable = [
        'upload_log_id',
        'material',
        'description',
        'batch',
        'plant',
        'stor_location',
        'serial_number',
        'created_by',
        'system_status',
        'changed_on',
        'created_on',
        'changed_by',
    ];
}