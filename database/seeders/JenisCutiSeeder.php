<?php

namespace Database\Seeders;

use App\Models\jeniscuti;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisCutiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        jeniscuti::create([
            'name' => 'Cuti Tahunan',
            'jatah_cuti' => 14,
          ]);
          jeniscuti::create([
            'name' => 'Cuti Sakit',
            'jatah_cuti' => 3,
          ]);
          jeniscuti::create([
            'name' => 'Cuti Melahirkan',
            'jatah_cuti' => 90,
          ]);
    }
}
