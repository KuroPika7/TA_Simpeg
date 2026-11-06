@extends('layouts.user_type.auth')

@section('content')
  <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
    <div class="container-fluid">
      <div class="page-header min-height-300 border-radius-xl mt-4"
        style="background-image: url('../assets/img/auth_placeholder.jpg'); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
      </div>
      <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <div class="row gx-4">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              @if ($karyawan->image_url)
                <img src="{{ asset('storage/' . $karyawan->image_url) }}" alt="profile_image"
                  class="w-100 border-radius-lg shadow-sm" style="height: 100%; object-fit: cover;"
                  onerror="this.onerror=null; this.src='{{ asset('assets/img/bruce-mars.jpg') }}';">
              @else
                <img src="../assets/img/bruce-mars.jpg" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
              @endif
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                {{ $karyawan->name }}
              </h5>
              <p class="mb-0 font-weight-bold text-sm">
                {{ $karyawan->jabatan ? $karyawan->jabatan->name : 'N/A' }}
              </p>
            </div>
          </div>

        </div>
      </div>
    </div>
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <div class="row">
                <div class="col-md-8 d-flex align-items-center">
                  <h6 class="mb-0">Info Profil</h6>
                </div>
                <div class="col-md-4 text-end">
                  <a href="javascript:;">
                    <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top"
                      title="Edit Profile"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="card-body p-3">
              <p class="text-sm">
                Hai, Saya {{ $karyawan->name }}.
                Bekerja sebagai {{ $karyawan->jabatan ? $karyawan->jabatan->name : 'Karyawan' }} di PT. Super Permata
                Kitchen.
              </p>
              <hr class="horizontal gray-light my-4">
              <ul class="list-group">
                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Nama Lengkap:</strong>
                  &nbsp;
                  {{ $karyawan->name }}</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">No. HP:</strong> &nbsp;
                  {{ $karyawan->phone ?? '-' }}</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp;
                  {{ Auth::user()->email }}</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Alamat:</strong> &nbsp;
                  {{ $karyawan->address ?? '-' }}</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Tanggal Lahir:</strong> &nbsp;
                  {{ $karyawan->birth_date ? \Carbon\Carbon::parse($karyawan->birth_date)->format('d M Y') : '-' }}
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
