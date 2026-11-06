<?php

namespace App\Models;

use App\Casts\FileUrlCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class reward extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'rewards';
    protected $guarded = [];
    // protected $casts = [
    //     'document_url' => FileUrlCast::class,
    // ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawans_id');
    }

    protected $fillable = [
        'document_url',
        'description',

    ];
}
