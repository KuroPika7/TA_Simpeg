<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class punishment extends Model
{
    use HasFactory;
    protected $table = 'punishments';
    protected $guarded = [];
    public function karyawan(): BelongsTo
    {
        return $this->belongsTo(karyawan::class, 'karyawans_id');
    }
    protected $fillable = [
        'perihal_surat',
        'document_url',
        'pelanggaran',
        'nomor_surat',
    ];


}

