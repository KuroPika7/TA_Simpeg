@extends('layouts.user_type.auth')

@section('content')
  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Daftar Promosi</h6>
              <!-- Filter Form -->
              <form method="GET" action="{{ route('daftar-promosi.search') }}" class="d-flex">
                <select name="status" class="form-control me-2">
                  <option value="">All Status</option>
                  <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Ditolak</option>
                  <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Pending</option>
                  <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Diterima</option>
                </select>
                <button type="submit" class="btn-premium btn-premium-primary btn-premium-md">
                    <i class="fas fa-filter"></i> Filter
                </button>
              </form>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jabatan</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nomor Surat
                      </th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Perihal Surat
                      </th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($promosi as $p)
                      <tr>
                        <td>
                          <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                        </td>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div class="mx-3">
                              <img
                                src="{{ $p->karyawan->image_url ? asset('storage/' . $p->karyawan->image_url) : '../assets/img/team-2.jpg' }}"
                                alt="{{ $p->karyawan->name }}" class="avatar avatar-sm">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm">{{ $p->karyawan->name }}</h6>
                              @if ($p->karyawan)
                                <p class="text-xs text-secondary mb-0">{{ $p->karyawan->email }}</p>
                              @else
                                <p class="text-xs text-secondary mb-0">No user associated</p>
                              @endif
                            </div>
                          </div>
                        </td>
                        <td>
                          @if ($p->jabatan)
                            <p class="text-xs font-weight-bold mb-0">{{ $p->jabatan->name }}</p>
                          @else
                            <p class="text-xs text-secondary mb-0">No position defined</p>
                          @endif
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0">{{ $p->nomor_surat }}</p>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0">{{ $p->perihal_surat }}</p>
                        </td>
                        <td class="align-middle text-center text-sm">
                          @if ($p->status == 0)
                            Ditolak
                          @elseif ($p->status == 1)
                            @can('approvePromosi')
                              <button type="button" class="btn-premium btn-premium-sm btn-premium-success mb-0"
                                onclick="updateStatus({{ $p->id }}, '2')" title="Accept">
                                <i class="fas fa-check"></i> Terima
                              </button>
                              <button type="button" class="btn-premium btn-premium-sm btn-premium-danger mb-0"
                                onclick="updateStatus({{ $p->id }}, '0')" title="Reject">
                                <i class="fas fa-times"></i> Tolak
                              </button>
                            @else
                              Pending
                            @endcan
                          @else
                            Diterima
                          @endif
                        </td>
                        <td class="align-middle text-center">
                          <div class="d-flex justify-content-center align-items-center gap-2">
                             <a href="{{ route('lihat-promosi', $p->id) }}" class="btn-premium btn-premium-action btn-premium-action-view" title="Detail">
                                <i class="fas fa-eye"></i>
                             </a>
                             @if ($p->document_url)
                                 <a href="{{ asset($p->document_url) }}" download class="btn-premium btn-premium-action btn-premium-action-edit" style="background: rgba(102, 126, 234, 0.1); color: #667eea !important;" title="Download">
                                     <i class="fas fa-download"></i>
                                 </a>
                             @endif
                          </div>
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
    function updateStatus(id, status) {
      Swal.fire({
        title: 'Are you sure?',
        text: "You want to update the status!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, update it!'
      }).then((result) => {
        if (result.isConfirmed) {
          var form = document.createElement('form');
          form.action = '/daftar-promosi/' + id + '/update-status';
          form.method = 'POST';
          form.style.display = 'none';

          var csrfInput = document.createElement('input');
          csrfInput.name = '_token';
          csrfInput.value = '{{ csrf_token() }}';
          form.appendChild(csrfInput);

          var statusInput = document.createElement('input');
          statusInput.name = 'status';
          statusInput.value = status;
          form.appendChild(statusInput);

          var methodInput = document.createElement('input');
          methodInput.name = '_method';
          methodInput.value = 'PUT';
          form.appendChild(methodInput);

          document.body.appendChild(form);
          form.submit();
        }
      })
    }
  </script>
@endsection
