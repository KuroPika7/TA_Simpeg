<?php

namespace App\Http\Controllers;

use App\Models\lowongan;
use Illuminate\Http\Request;

class LowonganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $lowongans = lowongan::all();
        return view('lowongan.index', compact('lowongans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('lowongan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'lowongan' => 'required',
            'lowongan_jabatan' => 'required',
            'persyaratan' => 'required',
            'deskripsi_lowongan' => 'required',
        ]);

    Lowongan::create($request->all());

    return redirect()->route('daftar-lowongan.index')->with('message', 'Lowongan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(lowongan $lowongan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {   
        $lowongan = Lowongan::findOrFail($id);
        return view('lowongan.edit', compact('lowongan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'lowongan' => 'required',
            'lowongan_jabatan' => 'required',
            'persyaratan' => 'required',
            'deskripsi_lowongan' => 'required',
        ]);

    $lowongan = Lowongan::findOrFail($id);
    $lowongan->update($request->all());

    return redirect()->route('daftar-lowongan.index')->with('message', 'Lowongan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $lowongan = Lowongan::findOrFail($id);
        $lowongan->delete();

        return redirect()->route('daftar-lowongan.index')->with('message', 'Lowongan berhasil dihapus');
    }
}
