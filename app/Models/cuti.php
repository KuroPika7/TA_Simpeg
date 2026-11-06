<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;

    protected $table = 'cutis';

    protected $fillable = [
        'karyawans_id',
        'jeniscuti_id',
        'document_url',
        'reason',
        'status',
        'rejection_reason',
        'reject_note',
        'start_date',
        'end_date',
        'approved_by',
        'approved_at',
        'rejected_by',
        'rejected_at'
    ];

    public function jenisCuti()
    {
        return $this->belongsTo(JenisCuti::class, 'jeniscuti_id');
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawans_id');
    }
}
