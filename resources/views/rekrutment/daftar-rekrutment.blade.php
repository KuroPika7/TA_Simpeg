@extends('layouts.user_type.auth')

@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>Applicants Table</h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Posisi yang Dilamar</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                    <th class="text-secondary opacity-7">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Loop data dari database -->
                  @foreach ($applicants as $applicant)
                  <tr>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                    </td>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                          <img src="{{ $applicant->profile_picture }}" class="avatar avatar-sm me-3" alt="{{ $applicant->name }}">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">{{ $applicant->name }}</h6>
                          <p class="text-xs text-secondary mb-0">{{ $applicant->email }}</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">{{ $applicant->applied_position }}</p>
                    </td>
                    <td>
                      <p class="text-xs text-secondary mb-0">{{ $applicant->status }}</p>
                    </td>
                    <td class="align-middle">
                      <a href="{{ route('applicants.edit', $applicant->id) }}" class="text-secondary font-weight-bold text-xs me-2" data-toggle="tooltip" data-original-title="Edit applicant">
                        <i class="fas fa-edit"></i>
                      </a>
                      <a href="{{ route('applicants.show', $applicant->id) }}" class="text-secondary font-weight-bold text-xs me-2" data-toggle="tooltip" data-original-title="View details">
                        <i class="fas fa-eye"></i>
                      </a>
                      <form action="{{ route('applicants.destroy', $applicant->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-link text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Delete applicant">
                          <i class="fas fa-trash-alt"></i>
                        </button>
                      </form>
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
