<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Throwable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PresensiController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->input('month');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if ($month) {
            $carbonMonth = Carbon::parse($month);
            $startDate = $carbonMonth->startOfMonth()->toDateString();
            $endDate = $carbonMonth->copy()->endOfMonth()->toDateString();
        }

        $query = Presensi::with('karyawan.jabatan');

        if (!Auth::user()->can('level4', Presensi::class)) {
            $query->where('karyawans_id', Auth::user()->karyawan->id);
        }

        if ($startDate && $endDate) {
            $query->whereBetween('clock_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        } else {
            $query->whereDate('clock_at', now());
        }

        $presensis = $query->orderBy('created_at', 'desc')->paginate(30);

        $message = $presensis->isEmpty() ? 'Tidak ada data absensi untuk periode ini.' : null;

        return view('presensi.daftar-absensi', compact('presensis', 'message', 'startDate', 'endDate'));
    }

    public function create()
    {
        $karyawans = Karyawan::all();
        return view('presensi.tambah-absen', compact('karyawans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required',
            'image_url' => 'required',
            'clock_in_location' => 'required|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'type' => 'required',
            'keterangan_pulang' => 'nullable|string',
        ]);

        try {
            $imageData = $request->input('image_url');
            $fileName = time() . '.jpg';
            $filePath = 'uploads/' . $fileName;

            list($type, $imageData) = explode(';', $imageData);
            list(, $imageData) = explode(',', $imageData);

            if (!file_exists(public_path('uploads'))) {
                mkdir(public_path('uploads'), 0755, true);
            }

            file_put_contents(public_path($filePath), base64_decode($imageData));

            $type = $request->input('type');
            $currentTime = Carbon::now('Asia/Jakarta');
            $currentDate = $currentTime->toDateString();
            $hour = (int)$currentTime->format('H');
            $minute = (int)$currentTime->format('i');
            $timeString = $currentTime->format('H:i');

            $karyawanId = $request->input('karyawan_id');

            if ($type == 'Datang') {
                $existingPresence = Presensi::where('karyawans_id', $karyawanId)
                    ->whereDate('clock_at', $currentDate)
                    ->where('type', 'Datang')
                    ->first();

                if ($existingPresence) {
                    return back()->withInput($request->all())->with('error', 'Anda sudah melakukan absensi masuk hari ini.');
                }
            }

            if ($type == 'Pulang') {
                $hasCheckIn = Presensi::where('karyawans_id', $karyawanId)
                    ->whereDate('clock_at', $currentDate)
                    ->where('type', 'Datang')
                    ->exists();

                if (!$hasCheckIn) {
                    return back()->withInput($request->all())->with('error', 'Anda belum melakukan absensi masuk hari ini.');
                }

                $existingCheckout = Presensi::where('karyawans_id', $karyawanId)
                    ->whereDate('clock_at', $currentDate)
                    ->where('type', 'Pulang')
                    ->first();
                
                if ($existingCheckout) {
                    return back()->withInput($request->all())->with('error', 'Anda sudah melakukan absensi pulang hari ini.');
                }
            }


            $status = null;
            if ($type == 'Datang') {

                if ($hour < 8) {
                    $status = 'Tepat Waktu';
                } elseif ($hour == 8 && $minute == 0) {
                    $status = 'Tepat Waktu';
                } else {
                    $status = 'Terlambat';
                }

            } elseif ($type == 'Pulang') {

                
                if ($hour < 17) {
                    $status = 'Pulang Cepat';
                    if (!$request->input('keterangan_pulang')) {
                        return back()->withInput($request->all())->with('error', 'Anda pulang sebelum jam 17:00. Wajib mengisi keterangan.');
                    }
                } else {
                    $status = 'Pulang Normal';
                }
            }

            $presensi = new Presensi();
            $presensi->karyawans_id = $karyawanId;
            $presensi->image_url = $filePath;
            $presensi->clock_at = $currentTime;
            $presensi->clock_in_location = $request->input('clock_in_location');
            $presensi->latitude = $request->input('latitude');
            $presensi->longitude = $request->input('longitude');
            $presensi->type = $type;
            $presensi->status = $status;
            $presensi->alasan_izin = $request->input('alasan_izin');
            $presensi->keterangan_pulang = $request->input('keterangan_pulang');
            $presensi->save();

            return redirect()->route('daftar-absensi')->with('message', 'Berhasil menambahkan absensi');
        } catch (Throwable $th) {
            return back()->withInput($request->all())->with('message', 'Terjadi kesalahan saat menambahkan absensi: ' . $th->getMessage());
        }
    }

    public function show($id)
    {
        $presensi = Presensi::findOrFail($id);
        return view('presensi.detail-absensi', compact('presensi'));
    }

    public function export(Request $request)
    {
        // Restricted to level 4 (Komisaris)
        if (Auth::user()->karyawan->jabatan->level !== 4) {
            abort(403);
        }

        $monthYear = $request->input('month'); // YYYY-MM
        if (!$monthYear) {
            $monthYear = date('Y-m');
        }

        $year = substr($monthYear, 0, 4);
        $month = substr($monthYear, 5, 2);

        $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $endDate = $startDate->copy()->endOfMonth();

        // Get all active employees
        $karyawans = Karyawan::where('status', 'Aktif')->get();

        // Get presensi for this month, grouped by employee and day
        $presensiData = Presensi::whereBetween('clock_at', [$startDate->toDateString() . ' 00:00:00', $endDate->toDateString() . ' 23:59:59'])
            ->get()
            ->groupBy(['karyawans_id', function ($item) {
                return Carbon::parse($item->clock_at)->format('j');
            }]);

        // Prepare all dates in the month (including weekends)
        $dates = [];
        $tempDate = $startDate->copy();
        while ($tempDate->lte($endDate)) {
            $dates[] = [
                'day' => $tempDate->format('j'),
                'dayName' => $this->getDayName($tempDate->format('D')),
                'date' => $tempDate->toDateString(),
                'isWeekend' => $tempDate->isWeekend()
            ];
            $tempDate->addDay();
        }

        $monthNameFull = $this->getMonthName($month) . ' ' . $year;

        // Set headers for Excel download
        $filename = "Daftar_Absensi_" . str_replace(' ', '_', $monthNameFull) . ".xls";
        
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        return view('presensi.export-excel', [
            'karyawans' => $karyawans,
            'dates' => $dates,
            'presensiData' => $presensiData,
            'monthName' => $monthNameFull
        ]);
    }

    private function getDayName($day)
    {
        $days = [
            'Sun' => 'Min',
            'Mon' => 'Sen',
            'Tue' => 'Sel',
            'Wed' => 'Rab',
            'Thu' => 'Kam',
            'Fri' => 'Jum',
            'Sat' => 'Sab',
        ];

        return $days[$day] ?? $day;
    }

    private function getMonthName($month)
    {
        $months = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        return $months[$month] ?? $month;
    }

    public function createIzin()
    {
        return view('Izin.tambah-izin');
    }

    public function storeIzin(Request $request)
    {
        // dd($request);
        $request->validate([
            'alasan_izin' => 'required|string|max:255',
        ]);

        try {
            $presensi = new Presensi();
            $presensi->karyawans_id = Auth::user()->karyawan->id;
            $presensi->alasan_izin = $request->input('alasan_izin');
            $presensi->type = 'izin';
            $presensi->clock_at = now();
            $presensi->save();

            return redirect()->route('daftar-absensi')->with('message', 'Izin berhasil ditambahkan.');
        } catch (Throwable $th) {
            return back()->withInput($request->all())->with('message', 'Terjadi kesalahan saat menambahkan izin.');
        }
    }
}
