<?php

namespace App\Http\Controllers;

use App\Models\karyawan;
use App\Models\jabatan;
use App\Models\demosi;
use Illuminate\Http\Request;
use Throwable;

class DemosiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = demosi::query();

        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        $demosi = $query->get();
        return view('demosi.daftar-demosi', compact('demosi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $karyawans = Karyawan::with('jabatan')->where('status', 'Aktif')->get();
        $jabatans = jabatan::all();
        return view('demosi.tambah-demosi', compact('karyawans', 'jabatans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request);
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

            $demosi = new demosi();
            $demosi->nomor_surat = $request->input('nomor_surat');
            $demosi->perihal_surat = $request->input('perihal_surat');
            $demosi->document_url = 'uploads/' . $fileName;
            $demosi->jabatan_id = $request->input('jabatan_id');
            $demosi->karyawans_id = $request->input('karyawan_id');
            $demosi->status = '1'; // Set default status to Pending
            $demosi->save();

            return back()->with('message', 'Berhasil menambahkan data');
        } catch (Throwable $th) {
            return back()->withInput()->with('error', 'Terjadi kesalahan saat menambahkan data demosi: ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $demosi = demosi::with(['karyawan.jabatan', 'jabatan'])->findOrFail($id);
        return view('demosi.lihat-demosi', compact('demosi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(demosi $demosi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, demosi $demosi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(demosi $demosi)
    {
        //
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:0,1,2',
        ]);

        $demosi = demosi::findOrFail($id);

        // Check if user has permission to update status
        if (\Illuminate\Support\Facades\Auth::user()->can('approveDemosi')) {
            $demosi->status = $request->status;

            if ($request->status == '2') {
                // Approved
                $demosi->approved_by = \Illuminate\Support\Facades\Auth::user()->karyawan->id;
                $demosi->approved_at = now();
                $demosi->rejected_by = null;
                $demosi->rejected_at = null;
                $demosi->rejection_reason = null;
            } elseif ($request->status == '0') {
                // Rejected
                $demosi->rejected_by = \Illuminate\Support\Facades\Auth::user()->karyawan->id;
                $demosi->rejected_at = now();
                $demosi->approved_by = null;
                $demosi->approved_at = null;
            }

            $demosi->save();

            return redirect()->back()->with('message', 'Status Demosi berhasil diperbarui');
        } else {
            return redirect()->back()->with('error', 'Anda tidak memiliki hak untuk memperbarui status Demosi');
        }
    }

    public function search(Request $request)
    {
        return $this->index($request);
    }
}
