@extends('layouts.user_type.auth')

@section('content')
  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between">
              <h6>Daftar Lamaran</h6>
              <form method="GET" action="{{ route('daftar-lamaran.search') }}" class="d-flex">
                <select name="status" class="form-control me-2">
                  <option value="">All Status</option>
                  <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Ditolak</option>
                  <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Dilamar</option>
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
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Image</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Phone</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Pendidikan</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Gender</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jabatan</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Lowongan
                      </th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($lamarans as $lamaran)
                      <tr>
                        <td>
                          <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                        </td>
                        <td>
                          <img src="{{ $lamaran->image_url }}" alt="Image" class="img-fluid" width="50">
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0">{{ $lamaran->name }}</p>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0">{{ $lamaran->email }}</p>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0">{{ $lamaran->phone }}</p>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0">{{ $lamaran->pendidikan }}</p>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0">
                            @if ($lamaran->status == '0')
                              Ditolak
                            @elseif($lamaran->status == '1')
                              Dilamar
                            @else
                              Diterima
                            @endif
                          </p>                 
                        <td>
                          <p class="text-xs font-weight-bold mb-0">
                            @if ($lamaran->gender == 'Lk')
                              Laki-laki
                            @else
                              Perempuan
                            @endif
                          </p>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0">{{ $lamaran->lowongan->lowongan_jabatan }}</p>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0">{{ $lamaran->lowongan->lowongan }}</p>
                        </td>
                        <td class="align-middle text-center">
                          <a href="{{ route('daftar-lamaran.show', $lamaran->id) }}" class="btn-premium btn-premium-action btn-premium-action-view" title="Detail">
                            <i class="fas fa-eye"></i>
                          </a>
                          {{-- <button type="button" class="btn btn-link text-secondary font-weight-bold text-xs" onclick="confirmDelete({{ $lamaran->id }})" data-toggle="tooltip" data-original-title="Delete lamaran">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            <form id="delete-form-{{ $lamaran->id }}" action="{{ route('daftar-lamaran.destroy', $lamaran->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form> --}}
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
    function confirmDelete(id) {
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById('delete-form-' + id).submit(); // delete button
        }
      });
    }


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
          form.action = '/daftar-lamaran/' + id + '/update-status';
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
