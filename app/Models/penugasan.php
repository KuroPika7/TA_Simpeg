<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penugasan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_surat',
        'perihal_surat',
        'deskripsi',
        'karyawan_id',
        'assigner_id',
        'document_url',
        'submission_file',
        'submission_note',
        'status',
        'deadline'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }

    public function assigner()
    {
        return $this->belongsTo(User::class, 'assigner_id');
    }
}
