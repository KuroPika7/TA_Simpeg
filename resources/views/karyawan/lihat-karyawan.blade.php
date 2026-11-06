@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3 px-3 d-flex align-items-center">
                        <div class="icon icon-shape bg-white shadow text-center border-radius-md md-2 d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px;">
                            <i class="fas fa-user-tie text-info opacity-10" style="font-size: 20px;"></i>
                        </div>
                        <div>
                            <h5 class="text-white mb-0">Detail Data Karyawan</h5>
                            <p class="text-white text-sm opacity-8 mb-0">Informasi lengkap profil dan kepegawaian</p>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-5">
                    <div class="row">
                        <!-- Left Column: Personal Info -->
                        <div class="col-md-7">
                            <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Informasi Personal</h6>
                            <ul class="list-group">
                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                    <div class="d-flex flex-column w-100">
                                        <h6 class="mb-3 text-sm">{{ $karyawan->name }}</h6>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <span class="mb-2 text-xs d-block">NIK/NIP: <span class="text-dark font-weight-bold ms-sm-2">{{ $karyawan->nip ?? '-' }}</span></span>
                                                <span class="mb-2 text-xs d-block">Email: <span class="text-dark font-weight-bold ms-sm-2">{{ $karyawan->user->email ?? '-' }}</span></span>
                                                <span class="mb-2 text-xs d-block">No. Telepon: <span class="text-dark font-weight-bold ms-sm-2">{{ $karyawan->phone }}</span></span>
                                            </div>
                                            <div class="col-sm-6">
                                                <span class="mb-2 text-xs d-block">Gender: <span class="text-dark font-weight-bold ms-sm-2">{{ $karyawan->gender == 'Lk' ? 'Laki-laki' : 'Perempuan' }}</span></span>
                                                <span class="mb-2 text-xs d-block">Tempat Lahir: <span class="text-dark font-weight-bold ms-sm-2">{{ $karyawan->birth_place }}</span></span>
                                                <span class="text-xs d-block">Tanggal Lahir: <span class="text-dark ms-sm-2 font-weight-bold">{{ $karyawan->birth_date ? \Carbon\Carbon::parse($karyawan->birth_date)->translatedFormat('d F Y') : '-' }}</span></span>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <span class="text-xs">Alamat:</span>
                                            <p class="text-dark font-weight-bold text-sm mt-1 mb-0">{{ $karyawan->address }}</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                            <h6 class="text-uppercase text-body text-xs font-weight-bolder mt-4 mb-3">Informasi Pekerjaan</h6>
                            <ul class="list-group">
                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                    <div class="d-flex flex-column w-100">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <span class="mb-2 text-xs d-block">Jabatan: <span class="text-dark font-weight-bold ms-sm-2">{{ $karyawan->jabatan->name ?? '-' }}</span></span>
                                                <span class="mb-2 text-xs d-block">Departemen: <span class="text-dark font-weight-bold ms-sm-2">{{ $karyawan->departemen ?? '-' }}</span></span>
                                            </div>
                                            <div class="col-sm-6">
                                                <span class="mb-2 text-xs d-block">Status: <span class="badge badge-sm bg-gradient-{{ $karyawan->status == 'Aktif' ? 'success' : 'secondary' }} ms-2">{{ $karyawan->status }}</span></span>
                                                <span class="mb-2 text-xs d-block">Tanggal Masuk: <span class="text-dark font-weight-bold ms-sm-2">{{ $karyawan->tanggal_masuk ? \Carbon\Carbon::parse($karyawan->tanggal_masuk)->translatedFormat('d F Y') : '-' }}</span></span>

                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        
                        <!-- Right Column: Photo & Actions -->
                        <div class="col-md-5 mt-md-0 mt-4">
                            <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Foto Profil</h6>
                            <div class="card border-1 border-secondary h-100 table-responsive p-0">
                                <div class="card-body d-flex flex-column justify-content-center text-center align-items-center">
                                    @if($karyawan->image_url)
                                        <img src="{{ asset('storage/' . $karyawan->image_url) }}" alt="Foto Karyawan" class="img-fluid border-radius-lg shadow-sm" style="max-height: 300px; width: 100%; object-fit: cover;">
                                    @else
                                        <div class="avatar avatar-xl bg-gradient-secondary shadow-sm rounded-circle mb-3" style="width: 150px; height: 150px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-user fa-3x text-white"></i>
                                        </div>
                                        <p class="text-secondary text-sm">Belum ada foto profil</p>
                                    @endif
                                    
                                    <div class="mt-4 w-100">
                                         <a href="{{ route('daftar-karyawan.edit', $karyawan->id) }}" class="btn btn-warning w-100 mb-2">
                                            <i class="fas fa-edit me-2"></i> Edit Data
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="horizontal dark my-5">

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('daftar-karyawan.search') }}" class="btn btn-light px-5 mb-0">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-gradient-info {
        background-image: linear-gradient(310deg, #2152ff 0%, #21d4fd 100%);
    }
    .shadow-info {
        box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(33, 150, 243, 0.4);
    }
</style>
@endsection
