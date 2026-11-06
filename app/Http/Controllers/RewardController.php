<?php

namespace App\Http\Controllers;

use App\Models\reward;
use App\Models\karyawan;
use Illuminate\Http\Request;
use Throwable;

class RewardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rewards = reward::all();
        return view('reward.daftar-reward', compact('rewards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $karyawans = Karyawan::with('jabatan')->where('status', 'Aktif')->get();
        return view('reward.tambah-reward', compact('karyawans'));
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
            ]);

            $file     = $request->file('document_url');
            $fileName = $file->hashName();

            // $file->storeAs((new Reward())->getTable(), $fileName, ['disk' => 'public']);
            if (!file_exists(public_path('uploads'))) {
                mkdir(public_path('uploads'), 0755, true);
            }
            $file->move(public_path('uploads'), $fileName);

            $reward = new reward();
            $reward->nomor_surat = $request->input('nomor_surat');
            $reward->perihal = $request->input('perihal_surat');
            // $reward->document_url = $request->input('document_url');
            $reward->document_url = 'uploads/' . $fileName;
            $reward->karyawans_id = $request->input('karyawan_id');
            $reward->save();

            return back()->with('message', 'Berhasil menambahkan data');
        } catch (Throwable $th) {
            return back()->withInput()->with('error', 'Terjadi kesalahan saat menambahkan data reward: ' . $th->getMessage());
        }
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $reward = reward::with(['karyawan.jabatan'])->findOrFail($id);
        return view('reward.lihat-reward', compact('reward'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(reward $reward)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, reward $reward)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(reward $reward)
    {
        //
    }
}
