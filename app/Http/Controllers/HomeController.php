<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\karyawan;
use App\Models\lamaran;
use Illuminate\Http\Request;
use App\Models\lowongan;
use App\Models\Presensi;

class HomeController extends Controller
{
    public function home()
    {
        $totalpresensi = Presensi::count();
        $totalkaryawan = karyawan::count();
        $totallamaran = lamaran::count();
        $totalCuti = Cuti::count();

        return view('dashboard', compact('totalkaryawan', 'totallamaran', 'totalCuti', 'totalpresensi'));
    }

    public function welcome(){
        return view('welcome');
    }

    public function joblisting(){
        $lowongans = lowongan::all();
        return view('jobsindex', compact('lowongans'));
    }
}
