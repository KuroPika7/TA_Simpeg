<?php

namespace Database\Seeders;

use App\Models\jabatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // Level 4
    jabatan::create([
      'name' => 'Komisaris',
      'level' => 4,
    ]);

    // Level 3
    jabatan::create([
      'name' => 'Direktur',
      'level' => 3,
    ]);

    // Level 2
    jabatan::create([
      'name' => 'Kepala Toko',
      'level' => 2,
    ]);

    jabatan::create([
      'name' => 'Kepala Gudang',
      'level' => 2,
    ]);

    //Level 1
    jabatan::create([
      'name' => 'Staff Keuangan',
      'level' => 1,
    ]);

    jabatan::create([
      'name' => 'Staff Akuntansi dan Pajak',
      'level' => 1,
    ]);

    jabatan::create([
      'name' => 'Supervisor',
      'level' => 1,
    ]);

    jabatan::create([
      'name' => 'Kasir',
      'level' => 1,
    ]);

    jabatan::create([
      'name' => 'Entry Data',
      'level' => 1,
    ]);
    
    jabatan::create([
      'name' => 'Staff Gudang',
      'level' => 1,
    ]);
    

    jabatan::create([
      'name' => 'Spg',
      'level' => 1,
    ]);
    
    

    // Level 1
    // $level1Positions = [
    //   'Staff Keuangan',
    //   'Staff Akuntansi dan Pajak',
    //   'Supervisor',
    //   'Kasir',
    //   'Entry Data',
    //   'Staff Gudang',
    //   'Spg',
    //   'Calon Pegawai'
    // ];

    // foreach ($level1Positions as $pos) {
    //   jabatan::create([
    //     'name' => $pos,
    //     'level' => 1,
    //   ]);
    // }
  }
}
