<?php

namespace App\Http\Controllers;

use App\Models\jabatan;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sortBy = 'id';
        $sortOrder = 'desc';
        $karyawan = Karyawan::with('user', 'jabatan')
            ->orderBy($sortBy, $sortOrder)
            ->paginate(50);
        $jabatans = Jabatan::all();

        return view('karyawan.index', compact('karyawan', 'jabatans', 'sortBy', 'sortOrder'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $jabatans = jabatan::all();
        $lamaran = null;
        if ($request->has('lamaran_id')) {
            $lamaran = \App\Models\lamaran::find($request->lamaran_id);
        }
        return view('karyawan.tambah-karyawan', compact('jabatans', 'lamaran'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50|unique:karyawans',
            'email' => 'required|string|max:255',
            'password' => 'required|string',
            'jabatan_id' => 'required',
            'departemen' => 'nullable|string|max:100',
            'tanggal_masuk' => 'required|date',
            'gaji' => 'nullable|numeric',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'birth_date' => 'required|date|before_or_equal:today',
            'birth_place' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        DB::beginTransaction();
        try {
            $karyawan = new Karyawan();
            $karyawan->name = $request->input('name');
            $karyawan->nip = $request->input('nip');
            $karyawan->jabatan_id = $request->input('jabatan_id');
            $karyawan->departemen = $request->input('departemen');
            $karyawan->tanggal_masuk = $request->input('tanggal_masuk');
            $karyawan->gaji = $request->input('gaji');
            $karyawan->phone = $request->input('phone');
            $karyawan->address = $request->input('address');
            $karyawan->birth_date = $request->input('birth_date');
            $karyawan->birth_place = $request->input('birth_place');
            $karyawan->gender = $request->input('gender');

            // Simpan gambar
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->storeAs('images', $imageName, 'public');
                $karyawan->image_url = 'images/' . $imageName;
            }

            $karyawan->save();

            $user = new User();
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->karyawan_id = $karyawan->id;
            $user->save();

            DB::commit();

            return redirect('/daftar-karyawan')
                 ->with('message', 'Berhasil menambahkan pengguna dan karyawan.');

        } catch (Throwable $th) {
            DB::rollBack();
            throw_if(app()->hasDebugModeEnabled(), $th);
            return back()->withInput($request->all())->with('message', 'Terjadi kesalahan saat menambahkan pengguna dan karyawan.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $karyawan = Karyawan::with('user', 'jabatan')->findOrFail($id);
        return view('karyawan.lihat-karyawan', compact('karyawan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $jabatans = jabatan::all();
        return view('karyawan.edit-karyawan', compact('karyawan', 'jabatans'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50|unique:karyawans,nip,' . $id,
            'email' => 'required|string|max:255',
            'password' => 'nullable|string', // Password optional
            'jabatan_id' => 'required',
            'departemen' => 'nullable|string|max:100',
            'tanggal_masuk' => 'required|date',
            'gaji' => 'nullable|numeric',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'birth_date' => 'nullable|date|before_or_equal:today',
            'birth_place' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|string|max:10',
        ]);

        DB::beginTransaction();
        try {
            $karyawan = Karyawan::findOrFail($id);
            $karyawan->name = $request->input('name');
            $karyawan->nip = $request->input('nip');
            $karyawan->jabatan_id = $request->input('jabatan_id');
            $karyawan->departemen = $request->input('departemen');
            $karyawan->tanggal_masuk = $request->input('tanggal_masuk');
            $karyawan->gaji = $request->input('gaji');
            $karyawan->phone = $request->input('phone');
            $karyawan->address = $request->input('address');
            $karyawan->birth_date = $request->input('birth_date');
            $karyawan->birth_place = $request->input('birth_place');
            $karyawan->gender = $request->input('gender');
            $karyawan->status = $request->input('status');

            // Simpan gambar jika ada
            if ($request->hasFile('image')) {
                // Hapus gambar lama jika ada
                if ($karyawan->image_url && \Illuminate\Support\Facades\Storage::disk('public')->exists($karyawan->image_url)) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($karyawan->image_url);
                }

                // Simpan gambar baru
                $imageName = time() . '.' . $request->image->extension();
                $request->image->storeAs('images', $imageName, 'public');
                $karyawan->image_url = 'images/' . $imageName;
            }

            $karyawan->save();

            $user = User::where('karyawan_id', $karyawan->id)->first();
            if ($user) {
                $user->email = $request->input('email');
                if ($request->input('password')) {
                    $user->password = bcrypt($request->input('password'));
                }
                $user->save();
            }

            DB::commit();

            // return view('daftar-karyawan.index')->with('message', 'Karyawan berhasil diperbarui.');
            return redirect('daftar-karyawan');;
        } catch (Throwable $th) {
            DB::rollBack();
            throw_if(app()->hasDebugModeEnabled(), $th);
            return back()->withInput($request->all())->with('message', 'Terjadi kesalahan saat memperbarui karyawan.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // DB::beginTransaction();
        // try {
        //     // Find the karyawan by ID
        //     $karyawan = Karyawan::findOrFail($id);

        //     // Delete the associated user
        //     User::where('karyawan_id', $karyawan->id)->delete();

        //     // Delete the karyawan record
        //     $karyawan->delete();

        //     DB::commit();
        //     return redirect()->route('daftar-karyawan')->with('message', 'Karyawan berhasil dihapus.');
        // } catch (Throwable $th) {
        //     DB::rollBack();
        //     throw_if(app()->hasDebugModeEnabled(), $th);
        //     return back()->with('message', 'Terjadi kesalahan saat menghapus karyawan.');
        // }
    }

    public function search(Request $request)
    {
        $query = Karyawan::with('user', 'jabatan');

        // Filter by name
        if ($request->has('name') && $request->name != '') {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Filter by jabatan_id
        if ($request->has('jabatan_id') && $request->jabatan_id != '') {
            $query->where('jabatan_id', $request->jabatan_id);
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Sorting logic
        $sortBy = $request->get('sort_by', 'id');
        $sortOrder = $request->get('sort_order', 'asc');
        $query->orderBy($sortBy, $sortOrder);

        $karyawan = $query->paginate(50);
        $jabatans = Jabatan::all();

        return view('karyawan.index', compact('karyawan', 'jabatans', 'sortBy', 'sortOrder'));
    }
}
