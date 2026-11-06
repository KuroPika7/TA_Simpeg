<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\SuratPeringatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Throwable;

class SuratPeringatanController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('canViewSuratPeringatan', \App\Models\SuratPeringatan::class);
        $userLevel = Auth::user()->karyawan->jabatan->level;
        $karyawanId = Auth::user()->karyawan->id;

        $query = SuratPeringatan::with(['karyawan.jabatan', 'pembuat.jabatan']);

        if ($userLevel === 2) {
            $query->where('pembuat_id', $karyawanId);
        } elseif ($userLevel < 2) {
            $query->where('karyawan_id', $karyawanId);
        }

        if ($request->has('nomor_sp') && $request->nomor_sp != '') {
            $query->where('nomor_sp', $request->nomor_sp);
        }

        $suratPeringatans = $query->latest()->paginate(10);

        return view('surat-peringatan.daftar-sp', compact('suratPeringatans'));
    }

    public function search(Request $request)
    {
        return $this->index($request);
    }

    public function create()
    {
        $this->authorize('canManageSuratPeringatan', \App\Models\SuratPeringatan::class);
        $userLevel = Auth::user()->karyawan->jabatan->level;
        if ($userLevel < 2) {
            abort(403, 'Hanya Kepala Bagian atau level di atasnya yang dapat membuat Surat Peringatan.');
        }

        // Get employees with level lower than current user
        $karyawans = Karyawan::whereHas('jabatan', function($q) use ($userLevel) {
            $q->where('level', '<', $userLevel);
        })->where('status', 'Aktif')->get();

        return view('surat-peringatan.tambah-sp', compact('karyawans'));
    }

    public function store(Request $request)
    {
        $this->authorize('canManageSuratPeringatan', \App\Models\SuratPeringatan::class);
        $request->validate([
            'karyawan_id' => 'required|exists:karyawans,id',
            'nomor_sp' => 'required|string',
            'perihal' => 'required|string',
            'tanggal' => 'required|date|before_or_equal:today',
            'alasan' => 'required|string',
            'keterangan' => 'nullable|string',
            'file_sp' => 'required|file|mimes:pdf,jpg,png,jpeg|max:2048',
        ], [
            'tanggal.before_or_equal' => 'Tanggal surat tidak boleh lebih dari hari ini.',
        ]);

        try {
            $filePath = null;
            if ($request->hasFile('file_sp')) {
                $file = $request->file('file_sp');
                $filename = time() . '_' . $file->getClientOriginalName();
                
                if (!file_exists(public_path('uploads/surat_peringatan'))) {
                    mkdir(public_path('uploads/surat_peringatan'), 0755, true);
                }
                
                $file->move(public_path('uploads/surat_peringatan'), $filename);
                $filePath = 'uploads/surat_peringatan/' . $filename;
            }

            SuratPeringatan::create([
                'karyawan_id' => $request->karyawan_id,
                'pembuat_id' => Auth::user()->karyawan->id,
                'nomor_sp' => $request->nomor_sp,
                'perihal' => $request->perihal,
                'tanggal' => $request->tanggal,
                'alasan' => $request->alasan,
                'keterangan' => $request->keterangan,
                'file_path' => $filePath,
            ]);

            return redirect()->route('surat-peringatan.index')->with('message', 'Arsip Surat Peringatan berhasil disimpan.');
        } catch (Throwable $th) {
            return back()->withInput()->with('error', 'Gagal menyimpan arsip: ' . $th->getMessage());
        }
    }

    public function show($id)
    {
        $suratPeringatan = SuratPeringatan::with(['karyawan.jabatan', 'pembuat.jabatan'])->findOrFail($id);
        
        $user = Auth::user()->karyawan;
        $userLevel = $user->jabatan->level;

        // Authorization check
        $this->authorize('canViewSuratPeringatan', \App\Models\SuratPeringatan::class);
        
        if ($userLevel < 3 && $suratPeringatan->karyawan_id !== $user->id && $suratPeringatan->pembuat_id !== $user->id) {
             abort(403);
        }

        return view('surat-peringatan.lihat-sp', compact('suratPeringatan'));
    }
    
    public function destroy($id)
    {
        $this->authorize('canManageSuratPeringatan', \App\Models\SuratPeringatan::class);
        $suratPeringatan = SuratPeringatan::findOrFail($id);
        $suratPeringatan->delete();
        return redirect()->route('surat-peringatan.index')->with('message', 'Surat Peringatan berhasil dihapus.');
    }
}
