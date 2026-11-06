<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPeringatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'karyawan_id',
        'pembuat_id',
        'nomor_sp',
        'tanggal',
        'perihal',
        'alasan',
        'keterangan',
        'file_path'
    ];

    public function karyawan()
    {
        return $this->belongsTo(karyawan::class, 'karyawan_id');
    }

    public function pembuat()
    {
        return $this->belongsTo(karyawan::class, 'pembuat_id');
    }
}
