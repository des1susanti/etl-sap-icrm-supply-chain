<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class UploadLog extends Model
{
   protected $fillable = [
    'user_id',
    'type',
    'file_type', 
    'filename',
    'file_name', 
    'status',
    'message',
    'row_count',
    'periode',     
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}