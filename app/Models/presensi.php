<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'karyawans_id',
        'image_url',
        'clock_at',
        'clock_in_location',
        'latitude',
        'longitude',
        'type',
        'status',
        'alasan_izin',
        'keterangan_pulang'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawans_id');
    }
}
