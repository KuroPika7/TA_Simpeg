<?php

namespace App\Http\Controllers;

use App\Models\karyawan;
use App\Models\jabatan;
use App\Models\promosi;
use Illuminate\Http\Request;
use Throwable;

class PromosiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = promosi::query();

        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        $promosi = $query->get();
        return view('promosi.daftar-promosi', compact('promosi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $karyawans = Karyawan::with('jabatan')->where('status', 'Aktif')->get();
        $jabatans = jabatan::all();
        return view('promosi.tambah-promosi', compact('karyawans', 'jabatans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $request->validate([
                'nomor_surat' => 'required|string|max:255',
                'document_url' => 'required|file|max:15360',
                'karyawan_id' => 'required|string|max:255',
                'perihal_surat' => 'required|string|max:255',
                'jabatan_id' => 'required|string|max:255',
            ]);

            $file     = $request->file('document_url');
            $fileName = $file->hashName();

            if (!file_exists(public_path('uploads'))) {
                mkdir(public_path('uploads'), 0755, true);
            }
            $file->move(public_path('uploads'), $fileName);

            $promosi = new promosi();
            $promosi->nomor_surat = $request->input('nomor_surat');
            $promosi->perihal_surat = $request->input('perihal_surat');
            $promosi->document_url = 'uploads/' . $fileName;
            $promosi->jabatan_id = $request->input('jabatan_id');
            $promosi->karyawans_id = $request->input('karyawan_id');
            $promosi->status = '1'; // Set default status to Pending
            $promosi->save();

            return back()->with('message', 'Berhasil menambahkan data');
        } catch (Throwable $th) {
            return back()->withInput()->with('error', 'Terjadi kesalahan saat menambahkan data promosi: ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $promosi = promosi::with(['karyawan.jabatan', 'jabatan'])->findOrFail($id);
        return view('promosi.lihat-promosi', compact('promosi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(promosi $promosi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, promosi $promosi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(promosi $promosi)
    {
        //
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:0,1,2',
        ]);

        $promosi = promosi::findOrFail($id);

        // Check if user has permission to update status
        if (\Illuminate\Support\Facades\Auth::user()->can('approvePromosi')) {
            $promosi->status = $request->status;

            if ($request->status == '2') {
                // Approved
                $promosi->approved_by = \Illuminate\Support\Facades\Auth::user()->karyawan->id;
                $promosi->approved_at = now();
                $promosi->rejected_by = null;
                $promosi->rejected_at = null;
                $promosi->rejection_reason = null;
            } elseif ($request->status == '0') {
                // Rejected
                $promosi->rejected_by = \Illuminate\Support\Facades\Auth::user()->karyawan->id;
                $promosi->rejected_at = now();
                $promosi->approved_by = null;
                $promosi->approved_at = null;
            }

            $promosi->save();

            return redirect()->back()->with('message', 'Status Promosi berhasil diperbarui');
        } else {
            return redirect()->back()->with('error', 'Anda tidak memiliki hak untuk memperbarui status Promosi');
        }
    }

    public function search(Request $request)
    {
        return $this->index($request);
    }
}
