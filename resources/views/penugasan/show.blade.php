@extends('layouts.user_type.auth')

@section('content')
  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12 col-lg-8 mx-auto">
          <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
              <div>
                <h6 class="mb-0">Detail Penugasan</h6>
                <small class="text-muted">{{ $penugasan->nomor_surat }}</small>
              </div>
              <div>
                @if ($penugasan->status == 'Pending')
                  <span class="badge bg-secondary">Pending</span>
                @elseif($penugasan->status == 'Submitted')
                  <span class="badge bg-info">Submitted</span>
                @elseif($penugasan->status == 'Approved')
                  <span class="badge bg-success">Completed</span>
                @else
                  <span class="badge bg-danger">{{ $penugasan->status }}</span>
                @endif
              </div>
            </div>
            <div class="card-body">
              <h5 class="font-weight-bolder">{{ $penugasan->perihal_surat }}</h5>
              <p class="text-sm">
                <i class="fas fa-user me-1 text-secondary"></i> <strong>Ditugaskan ke:</strong>
                {{ $penugasan->karyawan->name }} <br>
                <i class="fas fa-calendar me-1 text-secondary"></i> <strong>Deadline:</strong>
                {{ $penugasan->deadline ? \Carbon\Carbon::parse($penugasan->deadline)->format('d M Y') : 'Tidak ada deadline' }}
                <br>
                <i class="fas fa-user-edit me-1 text-secondary"></i> <strong>Pemberi Tugas:</strong>
                {{ $penugasan->assigner->karyawan->jabatan->name ?? 'Admin' }} ({{ $penugasan->assigner->karyawan->name ?? '-' }})
              </p>

              <hr class="horizontal dark">

              <h6 class="text-uppercase text-body text-xs font-weight-bolder">Deskripsi Tugas</h6>
              <p class="text-sm mt-2">{{ $penugasan->deskripsi }}</p>

              @if ($penugasan->document_url)
                <div class="my-3">
                  <button type="button" class="btn-premium btn-premium-outline btn-premium-outline-primary btn-premium-md" data-bs-toggle="modal" data-bs-target="#taskDocumentModal">
                    <i class="fas fa-paperclip me-2"></i> Lihat Lampiran Tugas
                  </button>
                </div>
              @endif

              <hr class="horizontal dark my-4">

              <!-- Submission Section -->
              <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Hasil Pengerjaan</h6>

              @if ($penugasan->submission_file || $penugasan->submission_note)
                <div class="alert alert-light border">
                  @if ($penugasan->submission_note)
                    <p class="text-sm mb-2"><strong>Catatan:</strong> <br> {{ $penugasan->submission_note }}</p>
                  @endif

                  @if ($penugasan->submission_file)
                    <button type="button" class="btn-premium btn-premium-success btn-premium-md mb-0" data-bs-toggle="modal" data-bs-target="#submissionFileModal">
                      <i class="fas fa-eye"></i> Lihat Hasil
                    </button>
                  @endif
                </div>
              @else
                <p class="text-sm text-secondary fst-italic">Belum ada hasil yang dikumpulkan.</p>
              @endif

              <!-- Forms Logic -->

              <!-- Level 1 Submit Form (Only visible if NOT Level 2 aka Admin) -->
              @cannot('level2')
                @if ($penugasan->status != 'Approved')
                  <div class="card bg-gray-100 mt-4">
                    <div class="card-body">
                      <h6 class="mb-3">Kumpulkan Tugas</h6>
                      <form action="{{ route('daftar-penugasan.update', $penugasan->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                          <label class="form-control-label">Upload File Hasil</label>
                          <input type="file" name="submission_file" class="form-control" required>
                        </div>

                        <div class="form-group">
                          <label class="form-control-label">Catatan Tambahan</label>
                          <textarea name="submission_note" class="form-control" rows="3"></textarea>
                        </div>

                        <button type="submit" class="btn-premium btn-premium-primary btn-premium-md w-100">
                           <i class="fas fa-paper-plane"></i> Kirim Tugas
                        </button>
                      </form>
                    </div>
                  </div>
                @endif
              @endcannot

              <!-- Admin/Supervisor Action Form -->
              @can('level2')
                <div class="card bg-gray-100 mt-4">
                  <div class="card-body">
                    <h6 class="mb-3">Update Status Tugas</h6>
                    <form action="{{ route('daftar-penugasan.update', $penugasan->id) }}" method="POST">
                      @csrf
                      @method('PUT')
                      <div class="d-flex align-items-center">
                        <select name="status" class="form-control me-2">
                          <option value="Pending" {{ $penugasan->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                          <option value="Submitted" {{ $penugasan->status == 'Submitted' ? 'selected' : '' }}>Submitted
                          </option>
                          <option value="Approved" {{ $penugasan->status == 'Approved' ? 'selected' : '' }}>Approved
                            (Selesai)</option>
                          <option value="Rejected" {{ $penugasan->status == 'Rejected' ? 'selected' : '' }}>Rejected
                            (Revisi)</option>
                        </select>
                        <button type="submit" class="btn-premium btn-premium-dark btn-premium-md mb-0">Update</button>
                      </div>
                    </form>
                  </div>
                </div>
              @endcan

            </div>
          </div>
          <div class="text-center mt-4">
            <a href="{{ route('daftar-penugasan.index') }}" class="btn-premium btn-premium-ghost btn-premium-md">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
          </div>
        </div>
      </div>
    </div>
  </main>
  </main>

  <!-- Task Document Modal -->
  @if ($penugasan->document_url)
  <div class="modal fade" id="taskDocumentModal" tabindex="-1" role="dialog" aria-labelledby="taskDocumentModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="taskDocumentModalLabel">Preview Lampiran Tugas - {{ $penugasan->nomor_surat }}</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body p-0">
                  <iframe src="{{ asset($penugasan->document_url) }}" width="100%" height="800px" style="border: none;"></iframe>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn-premium btn-premium-ghost btn-premium-md" data-bs-dismiss="modal">Tutup</button>
                  <a href="{{ asset($penugasan->document_url) }}" download class="btn-premium btn-premium-primary btn-premium-md">Unduh File</a>
              </div>
          </div>
      </div>
  </div>
  @endif
  
  <!-- Submission File Modal -->
  @if ($penugasan->submission_file)
  <div class="modal fade" id="submissionFileModal" tabindex="-1" role="dialog" aria-labelledby="submissionFileModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="submissionFileModalLabel">Preview Hasil Pengerjaan - {{ $penugasan->nomor_surat }}</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body p-0">
                  <iframe src="{{ asset($penugasan->submission_file) }}" width="100%" height="800px" style="border: none;"></iframe>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn-premium btn-premium-ghost btn-premium-md" data-bs-dismiss="modal">Tutup</button>
                  <a href="{{ asset($penugasan->submission_file) }}" download class="btn-premium btn-premium-success btn-premium-md">Unduh File</a>
              </div>
          </div>
      </div>
  </div>
  @endif

@endsection
