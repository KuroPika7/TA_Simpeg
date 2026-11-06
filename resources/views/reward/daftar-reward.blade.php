@extends('layouts.user_type.auth')

@section('content')
  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Daftar Reward</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nomor Surat
                      </th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Perihal Surat
                      </th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Loop data dari database -->
                    @foreach ($rewards as $reward)
                      <tr>
                        <td>
                          <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0">{{ $reward->karyawan->name }}</p>
                        </td>
                        <td>
                          <p class="text-xs text-secondary mb-0">{{ $reward->nomor_surat }}</p>
                        </td>
                        <td>
                          <p class="text-xs text-secondary mb-0">{{ $reward->perihal }}</p>
                        </td>
                        <td class="align-middle text-center">
                          <div class="d-flex justify-content-center align-items-center gap-2">
                            <a href="{{ route('lihat-reward', $reward->id) }}" class="btn-premium btn-premium-action btn-premium-action-view" title="Detail">
                              <i class="fas fa-eye"></i>
                            </a>
                            @if ($reward->document_url)
                              <a href="{{ asset($reward->document_url) }}" download class="btn-premium btn-premium-action btn-premium-action-edit" style="background: rgba(102, 126, 234, 0.1); color: #667eea !important;" title="Download">
                                <i class="fas fa-download"></i>
                              </a>
                            @endif
                          </div>
                        </td>
                      </tr>
                    @endforeach
                    <!-- Akhir loop data -->
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
