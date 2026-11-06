<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jeniscuti extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'jatah_cuti',
    ];

    public function cutis()
    {
        return $this->hasMany(Cuti::class, 'jeniscuti_id');
    }
}
