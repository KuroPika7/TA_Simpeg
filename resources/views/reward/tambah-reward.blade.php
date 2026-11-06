@extends('layouts.user_type.auth')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card modern-form-card">
          <div class="card-header form-header-gradient">
            <div class="d-flex align-items-center">
              <div class="form-header-icon me-3">
                <i class="fas fa-medal" aria-hidden="true"></i>
              </div>
              <div>
                <h5 class="form-header-title">Form Reward Karyawan</h5>
                <p class="form-header-subtitle">Pemberian penghargaan kepada karyawan</p>
              </div>
            </div>
          </div>
          <div class="card-body form-body-padding">
            @if (session()->has('message'))
              <div class="alert alert-success-modern alert-dismissible fade show" role="alert">
                <span class="alert-icon"><i class="fas fa-check-circle"></i></span>
                <span class="alert-text"><strong>Berhasil!</strong> {{ session()->get('message') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif

            @if (session()->has('error'))
              <div class="alert alert-danger-modern alert-dismissible fade show" role="alert">
                <span class="alert-icon"><i class="fas fa-exclamation-circle"></i></span>
                <span class="alert-text"><strong>Gagal!</strong> {{ session()->get('error') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif

            <form action="{{ route('tambah-reward.store') }}" method="POST" enctype="multipart/form-data">
              @csrf

              <div class="form-group-modern">
                <label for="karyawan_id" class="form-control-label">Nama Karyawan</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-user"></i></span>
                  <select name="karyawan_id" id="karyawan_id" class="form-select @error('karyawan_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Nama Karyawan --</option>
                    @foreach ($karyawans as $k)
                      <option value="{{ $k->id }}" {{ old('karyawan_id') == $k->id ? 'selected' : '' }}>
                        {{ $k->name }} {{ $k->jabatan ? '(' . $k->jabatan->name . ')' : '' }}
                      </option>
                    @endforeach
                  </select>
                </div>
                @error('karyawan_id')
                  <p class="form-error-text">{{ $message }}</p>
                @enderror
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group-modern">
                    <label for="nomor_surat" class="form-control-label">Nomor Surat</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-file-alt"></i></span>
                      <input type="text" class="form-control @error('nomor_surat') is-invalid @enderror" id="nomor_surat" name="nomor_surat"
                        placeholder="Contoh: 001/REW/2024" value="{{ old('nomor_surat') }}" required>
                    </div>
                    @error('nomor_surat')
                      <p class="form-error-text">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group-modern">
                    <label for="perihal_surat" class="form-control-label">Perihal Surat</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                      <input type="text" class="form-control @error('perihal_surat') is-invalid @enderror" id="perihal_surat" name="perihal_surat"
                        placeholder="Perihal reward" value="{{ old('perihal_surat') }}" required>
                    </div>
                    @error('perihal_surat')
                      <p class="form-error-text">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="form-group-modern">
                <label for="document_url" class="form-control-label">Upload Surat Reward</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-file-upload"></i></span>
                  <input type="file" class="form-control @error('document_url') is-invalid @enderror" id="document_url" name="document_url" required>
                </div>
                <p class="form-helper-text">Format: PDF, JPG, PNG. Max: 2MB</p>
                @error('document_url')
                  <p class="form-error-text">{{ $message }}</p>
                @enderror
              </div>

              <div class="form-actions d-flex justify-content-end gap-3 mt-5">
                <button type="button" class="btn-premium btn-premium-ghost btn-premium-md" onclick="window.history.back()">Batal</button>
                <button type="submit" class="btn-premium btn-premium-primary btn-premium-md">
                  <i class="fas fa-save"></i> Simpan Data Reward
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
