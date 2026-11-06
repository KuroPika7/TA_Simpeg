@extends('layouts.user_type.auth')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card modern-form-card">
          <div class="card-header form-header-gradient">
            <div class="d-flex align-items-center">
              <div class="form-header-icon me-3">
                <i class="fas fa-file-alt" aria-hidden="true"></i>
              </div>
              <div>
                <h5 class="form-header-title">Form Pengajuan Izin</h5>
                <p class="form-header-subtitle">Ajukan permohonan izin karyawan</p>
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

            <form action="{{ route('storeIzin') }}" method="POST">
              @csrf

              <div class="form-group-modern">
                <label for="alasan_izin" class="form-control-label">Alasan Izin</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-comment-alt"></i></span>
                  <textarea class="form-control" id="alasan_izin" name="alasan_izin" rows="5"
                    placeholder="Jelaskan alasan pengajuan izin" required></textarea>
                </div>
                @error('alasan_izin')
                  <p class="form-error-text">{{ $message }}</p>
                @enderror
              </div>

              <div class="form-actions d-flex justify-content-end gap-3 mt-5">
                <button type="button" class="btn btn-cancel" onclick="window.history.back()">Batal</button>
                <button type="submit" class="btn btn-gradient-cyan text-white">
                  <i class="fas fa-save me-2"></i>
                  Simpan Pengajuan Izin
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
