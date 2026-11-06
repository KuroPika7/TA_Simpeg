<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jabatan extends Model
{
    use HasFactory;
    protected $table = 'jabatans';

    public function Karyawan(){
        return $this->belongsTo(Karyawan::class, "jabatan_id","id");
    
    }

    public function karyawans(){
        return $this->hasMany(Karyawan::class, 'jabatan_id');
    }

    
}
