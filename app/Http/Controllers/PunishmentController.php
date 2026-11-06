<?php

namespace App\Http\Controllers;

use App\Models\punishment;
use App\Models\karyawan;
use Illuminate\Http\Request;
use Throwable;


class PunishmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $punishments = Punishment::all();
        return view('punishment.daftar-punishment', compact('punishments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $karyawans = Karyawan::with('jabatan')->where('status', 'Aktif')->get();
        return view('punishment.tambah-punishment', compact('karyawans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // dd($request);
            $request->validate([
                'nomor_surat' => 'required|string|max:255',
                'document_url' => 'required|file|max:15360',
                'karyawan_id' => 'required|string|max:255',
                'perihal_surat' => 'required|string|max:255',
                'pelanggaran' => 'required|string|max:255',
            ]);

            $file     = $request->file('document_url');
            $fileName = $file->hashName();

            if (!file_exists(public_path('uploads'))) {
                mkdir(public_path('uploads'), 0755, true);
            }
            $file->move(public_path('uploads'), $fileName);

            $punishment = new punishment();
            $punishment->nomor_surat = $request->input('nomor_surat');
            $punishment->perihal_surat = $request->input('perihal_surat');
            $punishment->pelanggaran = $request->input('pelanggaran');
            $punishment->document_url = 'uploads/' . $fileName;
            $punishment->karyawans_id = $request->input('karyawan_id');
            $punishment->save();

            return back()->with('message', 'Berhasil menambahkan data');
        } catch (Throwable $th) {
            return back()->withInput()->with('error', 'Terjadi kesalahan saat menambahkan data punishment: ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $punishment = punishment::with(['karyawan.jabatan'])->findOrFail($id);
        return view('punishment.lihat-punishment', compact('punishment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(punishment $punishment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, punishment $punishment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(punishment $punishment)
    {
        //
    }
}
