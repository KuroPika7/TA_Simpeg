@extends('layouts.user_type.auth')

@section('content')
  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Daftar Surat Peringatan</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jabatan</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nomor Surat</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Perihal Surat</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($suratPeringatans as $sp)
                      <tr>
                        <td>
                          <p class="text-xs font-weight-bold mb-0 px-3">{{ ($suratPeringatans->currentPage() - 1) * $suratPeringatans->perPage() + $loop->iteration }}</p>
                        </td>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div>
                                @if($sp->karyawan->image_url)
                                    <img src="{{ Str::startsWith($sp->karyawan->image_url, 'http') ? $sp->karyawan->image_url : asset($sp->karyawan->image_url) }}" class="avatar avatar-sm me-3" alt="user">
                                @else
                                    <img src="{{ asset('assets/img/team-2.jpg') }}" class="avatar avatar-sm me-3" alt="user">
                                @endif
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm">{{ $sp->karyawan->name }}</h6>
                              <p class="text-xs text-secondary mb-0">{{ $sp->karyawan->email }}</p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0">{{ $sp->karyawan->jabatan->name ?? '-' }}</p>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0">{{ $sp->nomor_sp }}</p>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0 text-truncate" style="max-width: 150px;">{{ $sp->perihal }}</p>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <span class="text-secondary text-xs font-weight-bold">{{ \Carbon\Carbon::parse($sp->tanggal)->translatedFormat('d F Y') }}</span>
                        </td>
                        <td class="align-middle text-center">
                          <div class="d-flex justify-content-center align-items-center gap-2">
                             <a href="{{ route('surat-peringatan.show', $sp->id) }}" class="btn-premium btn-premium-action btn-premium-action-view" title="Detail">
                                <i class="fas fa-eye"></i>
                             </a>
                             @if ($sp->file_path)
                                 <a href="{{ asset($sp->file_path) }}" download class="btn-premium btn-premium-action btn-premium-action-edit" style="background: rgba(102, 126, 234, 0.1); color: #667eea !important;" title="Download">
                                     <i class="fas fa-download"></i>
                                 </a>
                             @endif
                          </div>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="7" class="text-center py-4">
                          <p class="text-sm mb-0">Tidak ada data arsip surat peringatan.</p>
                        </td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
            @if($suratPeringatans->hasPages())
            <div class="card-footer py-2">
                {{ $suratPeringatans->links() }}
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection

