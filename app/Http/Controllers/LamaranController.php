<?php

namespace App\Http\Controllers;

use App\Models\lamaran;
use App\Models\lowongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LamaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $lamarans = lamaran::with('lowongan')->get();
        return view('lamaran.index', compact('lamarans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $lowongan = Lowongan::findOrFail($request->lowongan_id);
        return view('tambah-lamaran', compact('lowongan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nik' => 'required|numeric|digits:16|unique:lamarans',
            'email' => 'required|email|unique:lamarans',
            'phone' => 'nullable',
            'agama' => 'required',
            'pendidikan' => 'nullable',
            'address' => 'nullable',
            'birth_date' => 'nullable|date|before_or_equal:today',
            'birth_place' => 'nullable',
            'status' => 'required|in:0,1,2',
            'gender' => 'required|in:Lk,Pr',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'document_cv' => 'required|mimes:pdf|max:2048',
            'document_ktp' => 'required|mimes:jpeg,png,jpg,pdf|max:2048',
            'lowongan_id' => 'required|exists:lowongans,id',
        ], [
            'birth_date.before_or_equal' => 'Tanggal lahir tidak boleh lebih dari hari ini.',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $file->hashName();
            if (!file_exists(public_path('images'))) {
                mkdir(public_path('images'), 0755, true);
            }
            $file->move(public_path('images'), $fileName);
            $data['image_url'] = 'images/' . $fileName;
        }
        if ($request->hasFile('document_cv')) {
            $file = $request->file('document_cv');
            $fileName = $file->hashName();
            if (!file_exists(public_path('uploads'))) {
                mkdir(public_path('uploads'), 0755, true);
            }
            $file->move(public_path('uploads'), $fileName);
            $data['document_url'] = 'uploads/' . $fileName;
        }
        if ($request->hasFile('document_ktp')) {
            $file = $request->file('document_ktp');
            $fileName = $file->hashName();
            if (!file_exists(public_path('uploads/ktp'))) {
                mkdir(public_path('uploads/ktp'), 0755, true);
            }
            $file->move(public_path('uploads/ktp'), $fileName);
            $data['document_ktp'] = 'uploads/ktp/' . $fileName;
        }

        Lamaran::create($data);

        return redirect()->back()->with('message', 'Lamaran berhasil diajukan')->withInput();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $lamaran = lamaran::with('lowongan')->findOrFail($id);
        return view('lamaran.lihat-lamaran', compact('lamaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(lamaran $lamaran)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, lamaran $lamaran)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy($id)
    // {
    //     $lamaran = lamaran::findOrFail($id);
    //     $lamaran->delete();

    //     return redirect()->back()->with('message', 'Data lamaran berhasil dihapus');
    // }


    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:0,1,2',
        ]);

        $lamaran = Lamaran::findOrFail($id);
        $lamaran->status = $request->status;
        $lamaran->save();

        return redirect()->back()->with('message', 'Status lamaran berhasil diperbarui');
    }

    public function search(Request $request)
    {
        //
        $query = lamaran::with('lowongan');

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('lowongan_id')) {
            $query->whereHas('lowongan', function ($q) use ($request) {
                $q->where('lowongan', 'like', '%' . $request->lowongan_id . '%');
            });
        }

        $lamarans = $query->get();

        return view('lamaran.index', compact('lamarans'));
    }
}
