<?php

namespace App\Http\Controllers;


use App\Models\karyawan;
use App\Models\phk;
use Illuminate\Http\Request;
use Throwable;

class PhkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = phk::query();

        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        $phks = $query->get();
        return view('phk.daftar-phk', compact('phks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $karyawans = Karyawan::with('jabatan')->where('status', 'Aktif')->get();
        return view('phk.tambah-phk', compact('karyawans'));
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
            ]);

            $file     = $request->file('document_url');
            $fileName = $file->hashName();

            if (!file_exists(public_path('uploads'))) {
                mkdir(public_path('uploads'), 0755, true);
            }
            $file->move(public_path('uploads'), $fileName);

            $phk = new phk();
            $phk->nomor_surat = $request->input('nomor_surat');
            $phk->perihal = $request->input('perihal_surat');
            $phk->document_url = 'uploads/' . $fileName;
            $phk->karyawans_id = $request->input('karyawan_id');
            $phk->status = '1'; // Set default status to Pending
            $phk->save();

            return back()->with('message', 'Berhasil menambahkan data');
        } catch (Throwable $th) {
            return back()->withInput()->with('error', 'Terjadi kesalahan saat menambahkan data PHK: ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $phk = phk::with(['karyawan.jabatan'])->findOrFail($id);
        return view('phk.lihat-phk', compact('phk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(phk $phk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, phk $phk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(phk $phk)
    {
        //
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:0,1,2',
        ]);

        $phk = phk::findOrFail($id);

        // Check if user has permission to update status
        if (\Illuminate\Support\Facades\Auth::user()->can('approvePHK')) {
            $phk->status = $request->status;

            if ($request->status == '2') {
                // Approved
                $phk->approved_by = \Illuminate\Support\Facades\Auth::user()->karyawan->id;
                $phk->approved_at = now();
                $phk->rejected_by = null;
                $phk->rejected_at = null;
                $phk->rejection_reason = null;

                // Deactivate Karyawan
                $karyawan = $phk->karyawan;
                if ($karyawan) {
                    $karyawan->status = 'Non-Aktif';
                    $karyawan->save();
                }
            } elseif ($request->status == '0') {
                // Rejected
                $phk->rejected_by = \Illuminate\Support\Facades\Auth::user()->karyawan->id;
                $phk->rejected_at = now();
                $phk->approved_by = null;
                $phk->approved_at = null;
            }

            $phk->save();

            return redirect()->back()->with('message', 'Status PHK berhasil diperbarui');
        } else {
            return redirect()->back()->with('error', 'Anda tidak memiliki hak untuk memperbarui status PHK');
        }
    }

    public function search(Request $request)
    {
        return $this->index($request);
    }
}
