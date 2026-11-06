@extends('layouts.user_type.auth')

@section('content')
  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              @if (Auth::user()->can('viewCuti', \App\Models\Cuti::class))
                <h6>Daftar Cuti Semua Karyawan</h6>
              @else
                <h6>Daftar Cuti {{ Auth::user()->karyawan->name ?? Auth::user()->email }}</h6>
              @endif

              @if (session('message'))
                <div class="alert alert-success-modern alert-dismissible fade show mx-3" role="alert">
                  <span class="alert-icon"><i class="fas fa-check-circle"></i></span>
                  <span class="alert-text"><strong>Berhasil!</strong> {{ session('message') }}</span>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif

              @if (session('error'))
                <div class="alert alert-danger-modern alert-dismissible fade show mx-3" role="alert">
                  <span class="alert-icon"><i class="fas fa-exclamation-circle"></i></span>
                  <span class="alert-text"><strong>Gagal!</strong> {{ session('error') }}</span>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif

              <!-- Filter Form -->
              <form method="GET" action="{{ route('daftar-cuti.search') }}" class="d-flex">
                <select name="status" class="form-control me-2">
                  <option value="">All Status</option>
                  <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Ditolak</option>
                  <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Diproses</option>
                  <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Diterima</option>
                </select>
                <button type="submit" class="btn-premium btn-premium-primary btn-premium-md">
                    <i class="fas fa-filter"></i> Filter
                </button>
              </form>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              @cannot('level3')
                <p class="px-3">Jatah Cuti: {{ $karyawan->jatah_cuti ?? 0 }} hari</p>
              @endcannot
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jenis Cuti</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal Mulai
                      </th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal Selesai
                      </th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Total Cuti</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($cutis as $cuti)
                      <tr>
                        <td>
                          <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                        </td>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div>
                              <img
                                src="{{ $cuti->karyawan->image_url ? asset('storage/' . $cuti->karyawan->image_url) : asset('assets/img/team-2.jpg') }}"
                                class="avatar avatar-sm me-3" alt="{{ $cuti->karyawan->name }}">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm">{{ $cuti->karyawan->name }}</h6>
                              <p class="text-xs text-secondary mb-0">{{ $cuti->karyawan->email }}</p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0">{{ $cuti->jenisCuti->name }}</p>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0">{{ $cuti->start_date }}</p>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0">{{ $cuti->end_date }}</p>
                        </td>
                        <td>
                          @php
                            $totalCuti =
                                \Carbon\Carbon::parse($cuti->start_date)->diffInDays(
                                    \Carbon\Carbon::parse($cuti->end_date),
                                ) + 1;
                          @endphp
                          <p class="text-xs font-weight-bold mb-0">{{ $totalCuti }} hari</p>
                        </td>
                        <td class="text-center">
                          @if ($cuti->status == 0)
                            <span class="badge badge-sm bg-gradient-danger">Ditolak</span>
                            @if ($cuti->reject_note)
                              <p class="text-xs text-secondary mb-0 mt-1">Alasan: {{ $cuti->reject_note }}</p>
                            @endif
                          @elseif ($cuti->status == 1)
                            @can('approveCuti', $cuti)
                              <button type="button" class="btn-premium btn-premium-sm btn-premium-success mb-0"
                                onclick="approveLeave({{ $cuti->id }})" title="Accept">
                                <i class="fas fa-check"></i> Terima
                              </button>
                              <button type="button" class="btn-premium btn-premium-sm btn-premium-danger mb-0 ms-1"
                                data-toggle="modal" data-target="#rejectModal-{{ $cuti->id }}"
                                title="Reject">
                                <i class="fas fa-times"></i> Tolak
                              </button>

                              <!-- Reject Modal -->
                              <div class="modal fade" id="rejectModal-{{ $cuti->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="rejectModalLabel-{{ $cuti->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="rejectModalLabel-{{ $cuti->id }}">Tolak Cuti -
                                        {{ $cuti->karyawan->name }}</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <form action="{{ route('daftar-cuti.update-status', $cuti->id) }}" method="POST">
                                      @csrf
                                      @method('PUT')
                                      <input type="hidden" name="status" value="0">
                                      <div class="modal-body">
                                        <div class="form-group">
                                          <label for="reject_note-{{ $cuti->id }}">Alasan Penolakan <span
                                              class="text-danger">*</span></label>
                                          <textarea class="form-control" id="reject_note-{{ $cuti->id }}" name="reject_note" rows="4"
                                            placeholder="Masukkan alasan penolakan cuti..." required></textarea>
                                          <small class="form-text text-muted">Maksimal 500 karakter</small>
                                        </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn-premium btn-premium-ghost btn-premium-md" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn-premium btn-premium-danger btn-premium-md">
                                          <i class="fas fa-times"></i> Tolak Cuti
                                        </button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            @else
                              <span class="badge badge-sm bg-gradient-warning">Diproses</span>
                            @endcan
                          @else
                            <span class="badge badge-sm bg-gradient-success">Diterima</span>
                          @endif
                        </td>
                        <td class="align-middle text-center">
                          <a href="{{ route('lihat-cuti', $cuti->id) }}" class="btn-premium btn-premium-action btn-premium-action-view" title="Detail">
                            <i class="fas fa-eye"></i>
                          </a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script>
    // Function untuk approve langsung tanpa modal
    function approveLeave(id) {
      var form = document.createElement('form');
      form.action = '/daftar-cuti/' + id + '/update-status';
      form.method = 'POST';
      form.style.display = 'none';

      var csrfInput = document.createElement('input');
      csrfInput.name = '_token';
      csrfInput.value = '{{ csrf_token() }}';
      form.appendChild(csrfInput);

      var statusInput = document.createElement('input');
      statusInput.name = 'status';
      statusInput.value = '2';
      form.appendChild(statusInput);

      var methodInput = document.createElement('input');
      methodInput.name = '_method';
      methodInput.value = 'PUT';
      form.appendChild(methodInput);

      document.body.appendChild(form);
      form.submit();
    }
  </script>
@endsection
