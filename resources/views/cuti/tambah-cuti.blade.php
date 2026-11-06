@extends('layouts.user_type.auth')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card modern-form-card">
          <div class="card-header form-header-gradient">
            <div class="d-flex align-items-center">
              <div class="form-header-icon me-3">
                <i class="fas fa-calendar-alt" aria-hidden="true"></i>
              </div>
              <div>
                <h5 class="form-header-title">Form Pengajuan Cuti</h5>
                <p class="form-header-subtitle">Ajukan permohonan cuti karyawan</p>
              </div>
            </div>
          </div>
          <div class="card-body form-body-padding">
            @if (session()->has('message'))
              <div class="alert alert-success-modern alert-dismissible fade show" role="alert">
                <span class="alert-icon"><i class="fas fa-check-circle"></i></span>
                <span class="alert-text text-white"><strong>Success!</strong> {{ session()->get('message') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif

            @if (session('error'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="alert-icon"><i class="fas fa-exclamation-circle"></i></span>
                <span class="alert-text text-white"><strong>Error!</strong> {{ session('error') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif

            <form action="{{ route('tambah-cuti.store') }}" method="POST" enctype="multipart/form-data">
              @csrf

              <div class="form-group-modern">
                <label for="jenis_cuti_id" class="form-control-label">Jenis Cuti</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-list"></i></span>
                  <select name="jenis_cuti_id" id="jenis_cuti_id" class="form-select" required>
                    <option value="">-- Pilih Jenis Cuti --</option>
                    @foreach ($jenisCutis as $jenisCuti)
                      <option value="{{ $jenisCuti->id }}">
                        {{ $jenisCuti->name }} (Jatah: {{ $jenisCuti->jatah_cuti }} hari)
                      </option>
                    @endforeach
                  </select>
                </div>
                <p class="form-helper-text">Pilih jenis cuti sesuai kebutuhan. Jatah cuti dihitung per tahun.</p>
                @error('jenis_cuti_id')
                  <p class="form-error-text">{{ $message }}</p>
                @enderror
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group-modern">
                    <label for="start_date" class="form-control-label">Tanggal Mulai Cuti</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                      <input type="date" class="form-control" id="start_date" name="start_date" min="{{ date('Y-m-d') }}" required>
                    </div>
                    @error('start_date')
                      <p class="form-error-text">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group-modern">
                    <label for="end_date" class="form-control-label">Tanggal Selesai Cuti</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-calendar-check"></i></span>
                      <input type="date" class="form-control" id="end_date" name="end_date" min="{{ date('Y-m-d') }}" required>
                    </div>
                    @error('end_date')
                      <p class="form-error-text">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="form-group-modern">
                <label for="reason" class="form-control-label">Alasan Cuti</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-comment-alt"></i></span>
                  <textarea class="form-control" id="reason" name="reason" rows="3" placeholder="Jelaskan alasan pengajuan cuti"
                    required></textarea>
                </div>
                @error('reason')
                  <p class="form-error-text">{{ $message }}</p>
                @enderror
              </div>

              <div class="form-group-modern">
                <label for="document_url" class="form-control-label">Upload Surat Cuti</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-file-upload"></i></span>
                  <input type="file" class="form-control" id="document_url" name="document_url">
                </div>
                <p class="form-helper-text">Format: PDF, JPG, PNG. Max: 2MB</p>
                @error('document_url')
                  <p class="form-error-text">{{ $message }}</p>
                @enderror
              </div>

              <div class="form-actions d-flex justify-content-end gap-3 mt-5">
                <button type="button" class="btn btn-cancel" onclick="window.history.back()">Batal</button>
                <button type="submit" class="btn btn-gradient-cyan text-white">
                  <i class="fas fa-save me-2"></i>
                  Simpan Pengajuan Cuti
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const startDateInput = document.getElementById('start_date');
      const endDateInput = document.getElementById('end_date');

      startDateInput.addEventListener('change', function() {
        if (this.value) {
          endDateInput.min = this.value;
          // If end date is now invalid (before new start date), clear it
          if (endDateInput.value && endDateInput.value < this.value) {
            endDateInput.value = '';
          }
        }
      });
    });
  </script>
@endsection
