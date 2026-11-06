<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lamaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'nik', 
        'email', 
        'phone', 
        'agama', 
        'pendidikan', 
        'address', 
        'birth_date', 
        'birth_place', 
        'status', 
        'gender', 
        'image_url',
        'document_url',
        'document_ktp',
        'lowongan_id'
    ];
   public function lowongan()
    {
        return $this->belongsTo(Lowongan::class, 'lowongan_id');
    }
}
