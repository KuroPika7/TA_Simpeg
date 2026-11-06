<?php

namespace App\Http\Controllers;

use App\Models\Penugasan;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenugasanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $userLevel = $user->karyawan->jabatan->level ?? 0;

        // If user is Level 1, only show their tasks
        // Assuming Level 1 is the 'Worker' level who receives tasks
        if ($userLevel == 1) {
            $karyawan = $user->karyawan;

            if ($karyawan) {
                $penugasans = Penugasan::where('karyawan_id', $karyawan->id)->orderBy('created_at', 'desc')->paginate(10);
            } else {
                $penugasans = collect();
            }
        } else {
            // Level 2, 3, 4 see all
            $penugasans = Penugasan::with('karyawan')->orderBy('created_at', 'desc')->paginate(10);
        }

        return view('penugasan.index', compact('penugasans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $userLevel = $user->karyawan->jabatan->level ?? 0;

        // Only Level 2, 3, 4 can create tasks
        if ($userLevel <= 1) {
            return redirect()->route('daftar-penugasan.index')->with('error', 'Unauthorized');
        }

        // Get only Karyawans who act as workers (Level 1)
        // User requested: "no role. level can get on jabatan"
        $karyawans = Karyawan::whereHas('jabatan', function ($q) {
            $q->where('level', 1);
        })->get();

        return view('penugasan.create', compact('karyawans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required',
            'perihal_surat' => 'required',
            'deskripsi' => 'required',
            'karyawan_id' => 'required|exists:karyawans,id',
            'deadline' => 'nullable|date|after_or_equal:today',
            'document_url' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:2048'
        ]);

        $attr = $request->all();
        $attr['assigner_id'] = Auth::id();
        $attr['status'] = 'Pending';

        if ($request->hasFile('document_url')) {
            $file = $request->file('document_url');
            $fileName = time() . '_' . $file->getClientOriginalName();
            if (!file_exists(public_path('uploads'))) {
                mkdir(public_path('uploads'), 0755, true);
            }
            $file->move(public_path('uploads'), $fileName);
            $attr['document_url'] = 'uploads/' . $fileName;
        }

        Penugasan::create($attr);

        return redirect()->route('daftar-penugasan.index')->with('success', 'Penugasan berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $penugasan = Penugasan::with('karyawan', 'assigner')->findOrFail($id);
        return view('penugasan.show', compact('penugasan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $penugasan = Penugasan::findOrFail($id);
        $user = Auth::user();
        $userLevel = $user->karyawan->jabatan->level ?? 0;

        // Logic for Level 1 Submission (Worker)
        if ($userLevel == 1) {
            $request->validate([
                'submission_file' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:5000',
                'submission_note' => 'nullable|string'
            ]);

            if ($request->hasFile('submission_file')) {
                $file = $request->file('submission_file');
                $fileName = 'SUB_' . time() . '_' . $file->getClientOriginalName();
                if (!file_exists(public_path('uploads'))) {
                    mkdir(public_path('uploads'), 0755, true);
                }
                $file->move(public_path('uploads'), $fileName);
                $penugasan->submission_file = 'uploads/' . $fileName;
            }

            $penugasan->submission_note = $request->submission_note;
            $penugasan->status = 'Submitted';
            $penugasan->save();

            return redirect()->back()->with('success', 'Tugas berhasil disubmit.');
        }

        // Logic for Admin/Supervisor (Update Status / Grade)
        else {
            $request->validate([
                'status' => 'required'
            ]);

            $penugasan->update($request->only('status'));
            return redirect()->back()->with('success', 'Status updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $penugasan = Penugasan::findOrFail($id);
        $penugasan->delete();

        return redirect()->route('daftar-penugasan.index')->with('success', 'Penugasan deleted successfully');
    }

    public function search(Request $request)
    {
        $keyword = $request->search;
        $user = Auth::user();
        $userLevel = $user->karyawan->jabatan->level ?? 0;

        if ($userLevel == 1) {
            $karyawan = $user->karyawan;
            if ($karyawan) {
                $penugasans = Penugasan::where('karyawan_id', $karyawan->id)
                    ->where(function ($q) use ($keyword) {
                        $q->where('perihal_surat', 'like', "%" . $keyword . "%")
                            ->orWhere('nomor_surat', 'like', "%" . $keyword . "%");
                    })->paginate(10);
            } else {
                $penugasans = collect();
            }
        } else {
            $penugasans = Penugasan::where('perihal_surat', 'like', "%" . $keyword . "%")
                ->orWhere('nomor_surat', 'like', "%" . $keyword . "%")
                ->orWhereHas('karyawan', function ($q) use ($keyword) {
                    $q->where('name', 'like', "%" . $keyword . "%");
                })
                ->paginate(10);
        }

        return view('penugasan.index', compact('penugasans'));
    }
}
