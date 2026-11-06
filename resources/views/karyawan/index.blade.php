@extends('layouts.user_type.auth')

@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>Daftar Karyawan</h6>
            <form method="GET" action="{{ route('daftar-karyawan.search') }}" class="d-flex">
                <input type="text" name="name" class="form-control me-2" placeholder="Name" value="{{ request('name') }}">
                <select name="jabatan_id" class="form-control me-2">
                    <option value="">All Jabatan</option>
                    @foreach($jabatans as $jabatan)
                        <option value="{{ $jabatan->id }}" {{ request('jabatan_id') == $jabatan->id ? 'selected' : '' }}>{{ $jabatan->name }}</option>
                    @endforeach
                </select>
                <select name="status" class="form-control me-2">
                    <option value="">All Status</option>
                    <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="Non-Aktif" {{ request('status') == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
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
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                    <th class="text-secondary opacity-7">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($karyawan as $k)
                  <tr>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                    </td>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="mx-3">
                          <img src="{{ $k->image_url ? asset('storage/' . $k->image_url) : asset('assets/img/team-2.jpg') }}" 
                               alt="{{ $k->name }}" 
                               class="avatar avatar-sm"
                               onerror="this.onerror=null; this.src='{{ asset('assets/img/team-2.jpg') }}';">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">{{ $k->name }}</h6>
                          @if($k->user)
                            <p class="text-xs text-secondary mb-0">{{ $k->user->email }}</p>
                          @else
                            <p class="text-xs text-secondary mb-0">No user associated</p>
                          @endif
                        </div>
                      </div>
                    </td>
                    <td>
                      @if($k->jabatan)
                        <p class="text-xs font-weight-bold mb-0">{{ $k->jabatan->name }}</p>
                      @else
                        <p class="text-xs text-secondary mb-0">No job title defined</p>
                      @endif
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">{{ $k->status }}</p>
                    </td>
                    <td class="align-middle">
                      <div class="d-flex gap-2">
                        <a href="{{ route('daftar-karyawan.edit', $k->id) }}" class="btn-premium btn-premium-action btn-premium-action-edit" title="Edit">
                          <i class="fas fa-edit"></i>
                        </a>
                        <a href="{{ route('daftar-karyawan.show', $k->id) }}" class="btn-premium btn-premium-action btn-premium-action-view" title="Detail">
                          <i class="fas fa-eye"></i>
                        </a>
                      </div>
                    </td>
                  </tr>

                  <!-- Modal for Viewing Karyawan Details -->
                  <div class="modal fade" id="viewModal-{{ $k->id }}" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel-{{ $k->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="viewModalLabel-{{ $k->id }}">Detail Karyawan</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="d-flex">
                            <img src="{{ $k->image_url ? asset('storage/' . $k->image_url) : '../assets/img/team-2.jpg' }}" class="avatar avatar-lg me-3" alt="user1">
                            <div>
                              <p><strong>Nama:</strong> {{ $k->name }}</p>
                              <p><strong>Email:</strong> {{ $k->user ? $k->user->email : 'No email associated' }}</p>
                              <p><strong>Jabatan:</strong> {{ $k->jabatan ? $k->jabatan->name : 'No job title defined' }}</p>
                              <p><strong>Phone:</strong> {{ $k->phone }}</p>
                              <p><strong>Address:</strong> {{ $k->address }}</p>
                              <p><strong>Birth Date:</strong> {{ $k->birth_date ? $k->birth_date->format('d-m-Y') : 'N/A' }}</p>
                              <p><strong>Birth Place:</strong> {{ $k->birth_place }}</p>
                              <p><strong>Gender:</strong> {{ $k->gender == 'Lk' ? 'Male' : 'Female' }}</p>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn-premium btn-premium-ghost btn-premium-md" data-dismiss="modal">Tutup</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- End Modal -->
                  @endforeach
                </tbody>
              </table>
              <!-- Remove or comment this line to disable pagination -->
              {{ $karyawan->appends(['sortBy' => $sortBy, 'sort_order' => $sortOrder])->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

@endsection
