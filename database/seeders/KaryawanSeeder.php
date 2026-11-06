<?php

namespace Database\Seeders;

use App\Models\karyawan;
use App\Models\jabatan;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Helper to get jabatan ID by name
        $getJabatanId = function ($name) {
            $jabatan = jabatan::where('name', 'like', '%' . $name . '%')->first();
            return $jabatan ? $jabatan->id : 1; // Default to 1 if not found
        };

        $employees = [
            [
                'name' => 'MSY MARSHA ALISYA PUTRI',
                'gender' => 'Pr',
                'birth_date' => '2005-11-15',
                'birth_place' => 'PALEMBANG',
                'phone' => '0812745694496',
                'address' => 'LR TERUSAN BARAT NO 175 - 301 RT. 10 RW. 003 14 ULU',
                'jabatan' => 'Spg',
                'image_url' => 'images/spg1.jpg',
                'email' => 'spg1@gmail.com'
            ],
            [
                'name' => 'M RIKIAL FAKY',
                'gender' => 'Lk',
                'birth_date' => '2006-05-04',
                'birth_place' => 'PALEMBANG',
                'phone' => '0895621013808',
                'address' => 'LRG LAWANG KIDUL LAUT NO. 1531 RT. 022 RW. 001 LAWANG KIDUL LAUT, ILIR TIMUR DUA',
                'jabatan' => 'Spg',
                'image_url' => 'images/spg2.jpg',
                'email' => 'spg2@gmail.com'
            ],
            [
                'name' => 'M MUHAIMIN DAMIKO',
                'gender' => 'Lk',
                'birth_date' => '2006-02-10',
                'birth_place' => 'PALEMBANG',
                'phone' => '082288283732',
                'address' => 'JL BUNGARAN V UJUNG',
                'jabatan' => 'Kepala Gudang',
                'image_url' => 'images/kepalagudang.jpg',
                'email' => 'kepalagudang@gmail.com'
            ],
            [
                'name' => 'LUTFIA NUR KHOLIFAH',
                'gender' => 'Pr',
                'birth_date' => '2005-03-10',
                'birth_place' => 'PALEMBANG',
                'phone' => '081234567800',
                'address' => 'JL JAKABARING SAMPING POLRESTABES RT. 21 RW. 005 SILABERANTI JAKABARING',
                'jabatan' => 'Spg',
                'image_url' => 'images/spg3.jpg',
                'email' => 'spg3@gmail.com'
            ],
            [
                'name' => 'WULAN',
                'gender' => 'Pr',
                'birth_date' => '2003-04-20',
                'birth_place' => 'KARYA MAKMUR BATUMARTA VIII',
                'phone' => '081368021508',
                'address' => 'BLOK D DUSUN V RT 013 RW 008 KARYA MAKMUR MADANG SUKU III OKU TIMUR',
                'jabatan' => 'Entry Data',
                'image_url' => 'images/entrydata.jpg',
                'email' => 'entrydata@gmail.com'
            ],
            [
                'name' => 'DESVITA PERTIWI',
                'gender' => 'Pr',
                'birth_date' => '2005-12-03',
                'birth_place' => 'PALEMBANG',
                'phone' => '081234567801',
                'address' => 'TEPI SUNGAI OGAN RT 020 RW 005 LIMA BELAS ULU JAKABARING',
                'jabatan' => 'Kasir',
                'image_url' => 'images/kasir1.jpg',
                'email' => 'kasir1@gmail.com'
            ],
            [
                'name' => 'FITRIYADA',
                'gender' => 'Pr',
                'birth_date' => '2002-12-10',
                'birth_place' => 'OKU TIMUR',
                'phone' => '081234567802',
                'address' => 'JL GUB H. BASTARI LRG TEMBESU RT 002 RW 003',
                'jabatan' => 'Kasir',
                'image_url' => 'images/kasir2.jpg',
                'email' => 'kasir2@gmail.com'
            ],
            [
                'name' => 'RISKI ALTIAN FAJRI',
                'gender' => 'Lk',
                'birth_date' => '2006-11-18',
                'birth_place' => 'PALEMBANG',
                'phone' => '083143294750',
                'address' => 'LR PAHLAWAN II RT 020 RW 007 PLAJU ULU, PLAJU, PALEMBANG',
                'jabatan' => 'Spg',
                'image_url' => 'images/spg4.jpg',
                'email' => 'spg4@gmail.com'
            ],
            [
                'name' => 'IMAM ANUGRAH',
                'gender' => 'Lk',
                'birth_date' => '2005-10-24',
                'birth_place' => 'PALEMBANG',
                'phone' => '08975343696',
                'address' => 'JL D I PANJAITAN BLK MESJID JAMIK NO. 696 RT. 018 RW. 006 PLAJU ILIR, PLAJU',
                'jabatan' => 'Staff Gudang',
                'image_url' => 'images/staffgudang.jpg',
                'email' => 'staffgudang@gmail.com'
            ],
            [
                'name' => 'MUHAMMAD SOLIHIN',
                'gender' => 'Lk',
                'birth_date' => '2002-10-23',
                'birth_place' => 'GUNUNG RAYA',
                'phone' => '083809535410',
                'address' => 'JLN BUNGARAN II NO 340 RT 008 RW 002 8 ULU JAKABARING',
                'jabatan' => 'Spg',
                'image_url' => 'images/spg5.jpg',
                'email' => 'spg5@gmail.com'
            ],
            [
                'name' => 'MEGA SETVARINI',
                'gender' => 'Pr',
                'birth_date' => '2002-04-29',
                'birth_place' => 'PALEMBANG',
                'phone' => '08986412791',
                'address' => 'JL ABIKUSNO COKRO SUYOSO RT 022 RW 005 KEMANG AGUNG, KERTAPATI',
                'jabatan' => 'Kepala Toko',
                'image_url' => 'images/kepalatoko.jpg',
                'email' => 'kepalatoko@gmail.com'
            ],
            [
                'name' => 'ANGGUN',
                'gender' => 'Pr',
                'birth_date' => '2005-12-19',
                'birth_place' => 'PALEMBANG',
                'phone' => '083150964524',
                'address' => 'LORONG MEKAR NO. 3015 RT. 040 RW. 005 SUKABANGUN, SUKARAMI',
                'jabatan' => 'Spg',
                'image_url' => 'images/spg6.jpg',
                'email' => 'spg6@gmail.com'
            ],
            [
                'name' => 'DLIYA SYAHIRAH EKA MARTIN',
                'gender' => 'Pr',
                'birth_date' => '2004-03-19',
                'birth_place' => 'PALEMBANG',
                'phone' => '082179618332',
                'address' => 'JL SULTAN M. MANSYUR LR. SUNGAI ITAM NO. 1202 RT 015 RW 005, BUKIT LAMA ILIR BARAT I',
                'jabatan' => 'Supervisor',
                'image_url' => 'images/supervisor.jpg',
                'email' => 'supervisor@gmail.com'
            ],
            [
                'name' => 'PUTRI ARFAH',
                'gender' => 'Pr',
                'birth_date' => '1994-01-08',
                'birth_place' => 'BATUSANGKAR',
                'phone' => '085266377717',
                'address' => 'JL KERAMAT NO 1363 RT 036 RW 006 TANGGA TAKAT SEBERANG ULU DUA',
                'jabatan' => 'Kasir',
                'image_url' => 'images/kasir3.jpg',
                'email' => 'kasir3@gmail.com'
            ],
            [
                'name' => 'AISYAH',
                'gender' => 'Pr',
                'birth_date' => '2003-01-20',
                'birth_place' => 'PALEMBANG',
                'phone' => '081234567809',
                'address' => 'JL H FAQIH USMAN LR SINTREN NO 46 RT 002 RW 001 2 ULU SEBERANG ULU I',
                'jabatan' => 'Spg',
                'image_url' => 'images/spg7.jpg',
                'email' => 'spg7@gmail.com'
            ],
            [
                'name' => 'INDAH PERMATA LESTARI',
                'gender' => 'Pr',
                'birth_date' => '1998-08-01',
                'birth_place' => 'PALEMBANG',
                'phone' => '083189923413',
                'address' => 'JL K HA BASTARI LR BERSAMA II RT 008 RW 002 DELAPAN ULU JAKABARING',
                'jabatan' => 'Spg',
                'image_url' => 'images/spg8.jpg',
                'email' => 'spg8@gmail.com'
            ],
            [
                'name' => 'MIRA MARYUNI',
                'gender' => 'Pr',
                'birth_date' => '2001-11-23',
                'birth_place' => 'OKU TIMUR',
                'phone' => '085367972498',
                'address' => 'JL GUB H A BASTARI LR TEMBESU RT.011 RW.003 DELAPAN ULU, SEBERANG ULU I',
                'jabatan' => 'Spg',
                'image_url' => 'images/spg9.jpg',
                'email' => 'spg9@gmail.com'
            ],
            [
                'name' => 'NANDA RANDIKA',
                'gender' => 'Pr',
                'birth_date' => '1999-05-07',
                'birth_place' => 'JUDI II, MUBA',
                'phone' => '085272110021',
                'address' => 'DSN DESA JUDI KEC. SANGA DESA KAB. MUSI BANYUASIN',
                'jabatan' => 'Direktur',
                'image_url' => 'images/direktur1.jpg',
                'email' => 'direktur1@gmail.com'
            ],
            [
                'name' => 'LENI DAMAYANTI',
                'gender' => 'Pr',
                'birth_date' => '2002-07-17',
                'birth_place' => 'PALEMBANG',
                'phone' => '083187073158',
                'address' => 'JL BUNGARAN V UJUNG',
                'jabatan' => 'Direktur',
                'image_url' => 'images/direktur2.jpg',
                'email' => 'direktur2@gmail.com' 
            ],
             [
                'name' => 'MUHAMMAD RASTRA SEWAKOTTAMA',
                'gender' => 'Lk',
                'birth_date' => '2000-01-01', 
                'birth_place' => 'JAKARTA', 
                'phone' => '081271495040',
                'address' => 'JL BUNGARAN V UJUNG',
                'jabatan' => 'Staff Akuntansi dan Pajak',
                'image_url' => 'images/staffakuntandanpajak.jpg',
                'email' => 'staffakuntansidanpajak@gmail.com'
            ],
            [
                'name' => 'RICKY',
                'gender' => 'Lk',
                'birth_date' => '1985-01-15',
                'birth_place' => 'JAKARTA',
                'phone' => '081299999999',
                'address' => 'Jl. Jenderal Sudirman No. 1, Jakarta',
                'jabatan' => 'Komisaris',
                'image_url' => 'images/komisaris.jpg',
                'email' => 'komisaris@gmail.com'
            ],
        ];

        foreach ($employees as $emp) {
            // Create Karyawan
            $karyawan = Karyawan::create([
                'jabatan_id' => $getJabatanId($emp['jabatan']),
                'name' => $emp['name'],
                'phone' => $emp['phone'],
                'address' => $emp['address'],
                'birth_date' => $emp['birth_date'],
                'birth_place' => $emp['birth_place'],
                'gender' => $emp['gender'],
                'status' => 'Aktif',
                'image_url' => $emp['image_url']
            ]);
        }
    }
}
