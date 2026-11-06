@extends('layouts.user_type.auth')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card modern-form-card">
          <div class="card-header form-header-gradient">
            <div class="d-flex align-items-center">
              <div class="form-header-icon me-3">
                <i class="fas fa-users" aria-hidden="true"></i>
              </div>
              <div>
                <h5 class="form-header-title">Form Rekrutmen Karyawan</h5>
                <p class="form-header-subtitle">Buka lowongan pekerjaan baru</p>
              </div>
            </div>
          </div>
          <div class="card-body form-body-padding">
            @if (session()->has('message'))
              <div class="alert alert-success-modern alert-dismissible fade show" role="alert">
                <span class="alert-icon"><i class="fas fa-check-circle"></i></span>
                <span class="alert-text"><strong>Success!</strong> {{ session()->get('message') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif

            <form action="{{ route('tambah-rekrutment.store') }}" method="POST" enctype="multipart/form-data">
              @csrf

              <div class="form-group-modern">
                <label for="lowongan" class="form-control-label">Nama Lowongan</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                  <input type="text" class="form-control" id="lowongan" name="lowongan"
                    placeholder="Contoh: Staff Marketing" required>
                </div>
                @error('lowongan')
                  <p class="form-error-text">{{ $message }}</p>
                @enderror
              </div>

              <div class="form-group-modern">
                <label for="deskripsi" class="form-control-label">Deskripsi Pekerjaan</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                  <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4"
                    placeholder="Jelaskan detail pekerjaan dan tanggung jawab" required></textarea>
                </div>
                @error('deskripsi')
                  <p class="form-error-text">{{ $message }}</p>
                @enderror
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group-modern">
                    <label for="tanggal_buka" class="form-control-label">Tanggal Buka</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                      <input type="date" class="form-control" id="tanggal_buka" name="tanggal_buka" required>
                    </div>
                    @error('tanggal_buka')
                      <p class="form-error-text">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group-modern">
                    <label for="tanggal_tutup" class="form-control-label">Tanggal Tutup</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-calendar-check"></i></span>
                      <input type="date" class="form-control" id="tanggal_tutup" name="tanggal_tutup" required>
                    </div>
                    @error('tanggal_tutup')
                      <p class="form-error-text">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="form-actions d-flex justify-content-end gap-3 mt-5">
                <button type="button" class="btn btn-cancel" onclick="window.history.back()">Batal</button>
                <button type="submit" class="btn btn-gradient-cyan text-white">
                  <i class="fas fa-save me-2"></i>
                  Simpan Lowongan
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
