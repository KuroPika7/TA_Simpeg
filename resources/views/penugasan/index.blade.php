@extends('layouts.user_type.auth')

@section('content')
  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Daftar Penugasan</h6>
              @if (session('success'))
                <div class="alert alert-success text-white" role="alert">
                  {{ session('success') }}
                </div>
              @endif
              @if (session('error'))
                <div class="alert alert-danger text-white" role="alert">
                  {{ session('error') }}
                </div>
              @endif

              <!-- Filter Form -->
              <form method="GET" action="{{ route('daftar-penugasan.search') }}" class="d-flex mt-3">
                <input type="text" name="search" class="form-control me-2" placeholder="Cari Nomor Surat / Perihal..."
                  value="{{ request('search') }}">
                <button type="submit" class="btn-premium btn-premium-primary btn-premium-md">
                   <i class="fas fa-search"></i> Cari
                </button>
              </form>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nomor Surat
                      </th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Perihal</th>
                      @can('level2')
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Ditugaskan Ke
                        </th>
                      @endcan
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Deadline</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                      <th class="text-secondary opacity-7">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($penugasans as $penugasan)
                      <tr>
                        <td class="ps-4">
                          <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0">{{ $penugasan->nomor_surat }}</p>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0">{{ Str::limit($penugasan->perihal_surat, 30) }}</p>
                        </td>
                        @can('level2')
                          <td>
                            <p class="text-xs font-weight-bold mb-0">{{ $penugasan->karyawan->name ?? '-' }}</p>
                          </td>
                        @endcan
                        <td>
                          <p class="text-xs font-weight-bold mb-0">
                            {{ $penugasan->deadline ? \Carbon\Carbon::parse($penugasan->deadline)->format('d M Y') : '-' }}
                          </p>
                        </td>
                        <td>
                          @if ($penugasan->status == 'Pending')
                            <span class="badge badge-sm bg-gradient-secondary">Pending</span>
                          @elseif($penugasan->status == 'Submitted')
                            <span class="badge badge-sm bg-gradient-info">Submitted</span>
                          @elseif($penugasan->status == 'Approved')
                            <span class="badge badge-sm bg-gradient-success">Completed</span>
                          @else
                            <span class="badge badge-sm bg-gradient-danger">{{ $penugasan->status }}</span>
                          @endif
                        </td>
                        <td class="align-middle">
                          <div class="d-flex gap-2">
                            <a href="{{ route('daftar-penugasan.show', $penugasan->id) }}"
                              class="btn-premium btn-premium-action btn-premium-action-view" title="Lihat Detail">
                              <i class="fas fa-eye"></i>
                            </a>
                            @can('level2')
                              <form action="{{ route('daftar-penugasan.destroy', $penugasan->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-premium btn-premium-action btn-premium-action-delete delete-confirm"
                                  title="Hapus">
                                  <i class="fas fa-trash"></i>
                                </button>
                              </form>
                            @endcan
                          </div>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="{{ Auth::user()->can('level2') ? 7 : 6 }}" class="text-center py-4">
                          <p class="text-sm mb-0">Belum ada penugasan.</p>
                        </td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
              <div class="px-4 py-3 border-top">
                {{ $penugasans->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
