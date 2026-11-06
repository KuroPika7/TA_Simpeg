<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\karyawan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employeeCredentials = [
            'MSY MARSHA ALISYA PUTRI' => 'spg1@gmail.com',
            'M RIKIAL FAKY' => 'spg2@gmail.com',
            'M MUHAIMIN DAMIKO' => 'kepalagudang@gmail.com',
            'LUTFIA NUR KHOLIFAH' => 'spg3@gmail.com',
            'WULAN' => 'entrydata@gmail.com',
            'DESVITA PERTIWI' => 'kasir1@gmail.com',
            'FITRIYADA' => 'kasir2@gmail.com',
            'RISKI ALTIAN FAJRI' => 'spg4@gmail.com',
            'IMAM ANUGRAH' => 'staffgudang@gmail.com',
            'MUHAMMAD SOLIHIN' => 'spg5@gmail.com',
            'MEGA SETVARINI' => 'kepalatoko@gmail.com',
            'ANGGUN' => 'spg6@gmail.com',
            'DLIYA SYAHIRAH EKA MARTIN' => 'supervisor@gmail.com',
            'PUTRI ARFAH' => 'kasir3@gmail.com',
            'AISYAH' => 'spg7@gmail.com',
            'INDAH PERMATA LESTARI' => 'spg8@gmail.com',
            'MIRA MARYUNI' => 'spg9@gmail.com',
            'NANDA RANDIKA' => 'direktur1@gmail.com',
            'LENI DAMAYANTI' => 'direktur2@gmail.com',
            'MUHAMMAD RASTRA SEWAKOTTAMA' => 'staffakuntansidanpajak@gmail.com',
            'RICKY' => 'komisaris@gmail.com',
        ];

        foreach ($employeeCredentials as $name => $email) {
            $karyawan = Karyawan::where('name', $name)->first();
            
            if ($karyawan) {
                // Check if user already exists
                $user = User::where('karyawan_id', $karyawan->id)->first();
                
                if (!$user) {
                    User::create([
                        'karyawan_id' => $karyawan->id,
                        'email' => $email,
                        'password' => Hash::make('secret'), // Default password
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
        }
    }
}
