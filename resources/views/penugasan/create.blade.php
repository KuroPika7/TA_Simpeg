@extends('layouts.user_type.auth')

@section('content')
  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12 col-lg-10 mx-auto">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Buat Penugasan Baru</h6>
            </div>
            <div class="card-body">
              <form action="{{ route('daftar-penugasan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="nomor_surat" class="form-control-label">Nomor Surat</label>
                      <input class="form-control" type="text" id="nomor_surat" name="nomor_surat" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="perihal_surat" class="form-control-label">Perihal</label>
                      <input class="form-control" type="text" id="perihal_surat" name="perihal_surat" required>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="karyawan_id" class="form-control-label">Tugaskan Kepada (Karyawan)</label>
                  <select class="form-control" name="karyawan_id" id="karyawan_id" required>
                    <option value="">-- Pilih Karyawan --</option>
                    @foreach ($karyawans as $karyawan)
                      <option value="{{ $karyawan->id }}">{{ $karyawan->name }} ({{ $karyawan->jabatan->name ?? '' }})
                      </option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="deskripsi" class="form-control-label">Deskripsi / Instruksi Tugas</label>
                  <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required></textarea>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="deadline" class="form-control-label">Deadline</label>
                      <input class="form-control" type="date" id="deadline" name="deadline" min="{{ date('Y-m-d') }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="document_url" class="form-control-label">Lampiran (Surat)</label>
                      <input class="form-control" type="file" id="document_url" name="document_url" required>
                      <small class="text-muted">Max: 2MB</small>
                    </div>
                  </div>
                </div>

                <div class="d-flex justify-content-end gap-3 mt-4">
                  <a href="{{ route('daftar-penugasan.index') }}" class="btn-premium btn-premium-ghost btn-premium-md">Batal</a>
                  <button type="submit" class="btn-premium btn-premium-primary btn-premium-md">
                    <i class="fas fa-save"></i> Simpan Tugas
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
