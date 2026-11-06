<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class karyawan extends Model
{
    use HasFactory;
    protected $table = 'karyawans';
    protected $fillable = [
        'nip',
        'jabatan_id',
        'departemen',
        'name',
        'status',
        'tanggal_masuk',
        'gaji',
        'phone',
        'address',
        'birth_date',
        'birth_place',
        'gender',
        'image_url',
        'jatah_cuti'
    ];

    protected $casts = [
        'birth_date' => 'date', 
    ];

    public static function boot(){
       parent::boot();
    static::creating(function($karyawan){
        // Retrieve all leave types
        $jenisCutis = \DB::table('jeniscutis')->get();

        // Sum the total leave based on gender
        $totalCuti = 0;
        foreach ($jenisCutis as $jenisCuti) {
            if ($jenisCuti->name === 'Cuti Melahirkan' && $karyawan->gender === 'Lk') {
                continue; 
            }
            $totalCuti += $jenisCuti->jatah_cuti;
        }

        // Assign the calculated total leave to the karyawan's leave quota
        $karyawan->jatah_cuti = $totalCuti;
    });
    }
    public function user()
    {
        return $this->hasOne(User::class, 'karyawan_id');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }

    public function punishment()
    {
        return $this->belongsTo(Punishment::class, 'punishment_id');
    }

    public function presensi(){
        return $this->hasMany(Presensi::class, 'karyawans_id');
    }

}
