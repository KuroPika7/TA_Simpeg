<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lowongan extends Model
{
    use HasFactory;
    protected $fillable = [
        'lowongan',
        'lowongan_jabatan',
        'persyaratan',
        'deskripsi_lowongan'
    ];
}
