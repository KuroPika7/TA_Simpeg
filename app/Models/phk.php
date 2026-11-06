<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class phk extends Model
{
    use HasFactory;
    protected $table = 'phks';

    protected $fillable = [
        'karyawans_id',
        'nomor_surat',
        'perihal',
        'document_url',
        'status',
        'rejection_reason',
        'approved_by',
        'approved_at',
        'rejected_by',
        'rejected_at'
    ];

    public function karyawan(): BelongsTo
    {
        return $this->belongsTo(karyawan::class, 'karyawans_id');
    }
}
