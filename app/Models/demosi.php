<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class demosi extends Model
{
    use HasFactory;
    protected $table = 'demosis';

    protected $fillable = [
        'karyawans_id',
        'jabatan_id',
        'nomor_surat',
        'perihal_surat',
        'document_url',
        'status',
        'rejection_reason',
        'approved_by',
        'approved_at',
        'rejected_by',
        'rejected_at'
    ];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawans_id');
    }
}
