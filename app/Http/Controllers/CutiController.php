<?php

namespace App\Http\Controllers;

use App\Models\jabatan;
use App\Models\cuti;
use App\Models\jeniscuti;
use App\Models\User;
use App\Models\karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CutiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Cuti::with('karyawan');

        if (!Auth::user()->can('viewCuti', Cuti::class)) {
            $query->where('karyawans_id', Auth::user()->karyawan->id);
        }

        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        $cutis = $query->get();
        $message = $cutis->isEmpty() ? 'Tidak ada data cuti tersedia.' : null;

        $karyawan = Auth::user()->can('viewCuti', Cuti::class)
            ? Karyawan::all()
            : Karyawan::where('id', Auth::user()->karyawan->id)->first();

        return view('cuti.daftar-cuti', compact('cutis', 'message', 'karyawan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenisCutis = JenisCuti::all();
        return view('cuti.tambah-cuti', compact('jenisCutis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_cuti_id' => 'required|exists:jeniscutis,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:today|after_or_equal:start_date',
            'reason' => 'required|string',
            'document_url' => 'nullable|file|mimes:pdf,jpg,png',
        ]);

        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $totalDays = $startDate->diffInDays($endDate) + 1;

        // Ambil data jenis cuti yang dipilih
        $jenisCuti = JenisCuti::findOrFail($request->jenis_cuti_id);
        $jatahCutiJenis = $jenisCuti->jatah_cuti;

        // Hitung total cuti yang sudah digunakan untuk jenis cuti ini di tahun berjalan (hanya yang approved)
        $karyawanId = Auth::user()->karyawan->id;
        $currentYear = now()->year;

        $totalUsedDays = Cuti::where('karyawans_id', $karyawanId)
            ->where('jeniscuti_id', $request->jenis_cuti_id)
            ->where('status', '2') // Hanya hitung yang sudah approved
            ->whereYear('start_date', $currentYear)
            ->get()
            ->sum(function ($cuti) {
                return Carbon::parse($cuti->start_date)->diffInDays(Carbon::parse($cuti->end_date)) + 1;
            });

        // Validasi: total hari pengajuan + total sudah digunakan <= jatah cuti jenis
        $sisaQuota = $jatahCutiJenis - $totalUsedDays;

        if ($totalDays > $sisaQuota) {
            return redirect()->back()
                ->with('error', "Jumlah hari cuti melebihi jatah yang tersedia untuk {$jenisCuti->name}. Jatah: {$jatahCutiJenis} hari, Sudah digunakan: {$totalUsedDays} hari, Sisa: {$sisaQuota} hari, Anda mengajukan: {$totalDays} hari.")
                ->withInput();
        }

        // Cek apakah sudah ada pengajuan cuti di bulan yang sama (opsional, bisa dihapus jika tidak diperlukan)
        $existingLeave = Cuti::where('karyawans_id', $karyawanId)
            ->whereMonth('start_date', $startDate->month)
            ->whereYear('start_date', $startDate->year)
            ->exists();

        if ($existingLeave) {
            return redirect()->back()->with('error', 'Anda sudah mengajukan cuti pada bulan ini.')->withInput();
        }

        $cuti = new Cuti();
        $cuti->karyawans_id = $karyawanId;
        $cuti->jeniscuti_id = $request->jenis_cuti_id;
        $cuti->start_date = $request->start_date;
        $cuti->end_date = $request->end_date;
        $cuti->reason = $request->reason;

        if ($request->hasFile('document_url')) {
            $file     = $request->file('document_url');
            $fileName = $file->hashName();

            if (!file_exists(public_path('uploads'))) {
                mkdir(public_path('uploads'), 0755, true);
            }

            $file->move(public_path('uploads'), $fileName);

            $cuti->document_url = 'uploads/' . $fileName;
        }

        $cuti->save();

        return redirect()->route('daftar-cuti')->with('message', 'Cuti berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cuti = cuti::with(['karyawan.jabatan', 'jeniscuti'])->findOrFail($id);
        return view('cuti.lihat-cuti', compact('cuti'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cuti $cuti)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, cuti $cuti)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(cuti $cuti)
    {
        //
    }

    public function updateStatus(Request $request, $id)
    {
        $validationRules = [
            'status' => 'required|in:0,1,2',
        ];

        // Jika status ditolak (0), reject_note wajib diisi
        if ($request->status == '0') {
            $validationRules['reject_note'] = 'required|string|max:500';
        }

        $request->validate($validationRules);

        $cuti = cuti::findOrFail($id);

        // Periksa apakah pengguna memiliki hak untuk memperbarui status
        if (Auth::user()->can('approveCuti', $cuti)) {
            if ($request->status == '2' && $cuti->status != '2') {
                // If status is approved and was not previously approved
                $totalCuti = \Carbon\Carbon::parse($cuti->start_date)->diffInDays(\Carbon\Carbon::parse($cuti->end_date)) + 1;
                $karyawan = $cuti->karyawan;
                $karyawan->jatah_cuti -= $totalCuti;
                $karyawan->save();
            }

            $cuti->status = $request->status;

            // Simpan reject_note jika status ditolak
            if ($request->status == '0' && $request->has('reject_note')) {
                $cuti->reject_note = $request->reject_note;
            }

            $cuti->save();

            return redirect()->back()->with('message', 'Status cuti berhasil diperbarui');
        } else {
            return redirect()->back()->with('error', 'Anda tidak memiliki hak untuk memperbarui status cuti');
        }
    }

    public function search(Request $request)
    {
        return $this->index($request);
    }
}
