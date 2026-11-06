@extends('layouts.user_type.auth')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card modern-form-card">
          <div class="card-header form-header-gradient">
            <div class="d-flex align-items-center">
              <div class="form-header-icon me-3">
                <i class="fas fa-exclamation-triangle" aria-hidden="true"></i>
              </div>
              <div>
                <h5 class="form-header-title">Form Surat Peringatan Karyawan</h5>
                <p class="form-header-subtitle">Catat pelanggaran dan sanksi karyawan</p>
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

            <form action="{{ route('surat-peringatan.store') }}" method="POST" enctype="multipart/form-data">
              @csrf

              <div class="form-group-modern">
                <label for="karyawan_id" class="form-control-label">Nama Karyawan</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-user"></i></span>
                  <select name="karyawan_id" id="karyawan_id" class="form-select @error('karyawan_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Nama Karyawan --</option>
                    @foreach ($karyawans as $k)
                      <option value="{{ $k->id }}" {{ old('karyawan_id') == $k->id ? 'selected' : '' }}>
                        {{ $k->name }} ({{ $k->jabatan->name }})
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
                    <label for="nomor_sp" class="form-control-label">Nomor Surat</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-file-alt"></i></span>
                      <input type="text" class="form-control @error('nomor_sp') is-invalid @enderror" id="nomor_sp" name="nomor_sp"
                        placeholder="Contoh: 001/PUN/2024" value="{{ old('nomor_sp') }}" required>
                    </div>
                    @error('nomor_sp')
                      <p class="form-error-text">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group-modern">
                    <label for="perihal" class="form-control-label">Perihal Surat</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                      <input type="text" class="form-control @error('perihal') is-invalid @enderror" id="perihal" name="perihal"
                        placeholder="Perihal punishment" value="{{ old('perihal') }}" required>
                    </div>
                    @error('perihal')
                      <p class="form-error-text">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group-modern">
                    <label for="tanggal" class="form-control-label">Tanggal Surat</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                      <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal"
                        value="{{ old('tanggal', date('Y-m-d')) }}" max="{{ date('Y-m-d') }}" required>
                    </div>
                    @error('tanggal')
                      <p class="form-error-text">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="form-group-modern">
                <label for="alasan" class="form-control-label">Keterangan Pelanggaran</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-comment-alt"></i></span>
                  <textarea class="form-control @error('alasan') is-invalid @enderror" id="alasan" name="alasan" rows="4"
                    placeholder="Jelaskan detail pelanggaran yang dilakukan" required>{{ old('alasan') }}</textarea>
                </div>
                @error('alasan')
                  <p class="form-error-text">{{ $message }}</p>
                @enderror
              </div>

              <div class="form-group-modern">
                <label for="file_sp" class="form-control-label">Upload Surat Punishment</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-file-upload"></i></span>
                  <input type="file" class="form-control @error('file_sp') is-invalid @enderror" id="file_sp" name="file_sp" accept=".pdf,.jpg,.png,.jpeg" required>
                </div>
                <p class="form-helper-text">Format: PDF, JPG, PNG. Max: 2MB</p>
                @error('file_sp')
                  <p class="form-error-text">{{ $message }}</p>
                @enderror
              </div>

              <div class="form-actions d-flex justify-content-end gap-3 mt-4">
                <a href="{{ route('surat-peringatan.index') }}" class="btn-premium btn-premium-ghost btn-premium-md">Batal</a>
                <button type="submit" class="btn-premium btn-premium-primary btn-premium-md">
                  <i class="fas fa-save"></i> Simpan Data SP
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
