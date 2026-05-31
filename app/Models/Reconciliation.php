<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Reconciliation extends Model
{
    protected $fillable = [
        'user_id',
        'periode',
        'status',
        'sap_count',
        'icrm_count',
        'match_count',
        'mismatch_count', // REVISI: Tambah agar konsisten dengan export & controller
        'sap_only_count',
        'icrm_only_count',
        'total_count',
        'approved_by',
        'approved_at',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function results()
    {
        return $this->hasMany(ReconciliationResult::class);
    }
}