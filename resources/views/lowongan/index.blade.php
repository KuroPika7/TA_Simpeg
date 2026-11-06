@extends('layouts.user_type.auth')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between">
                        <h6>Daftar Lowongan</h6>
                        <a href="{{ route('daftar-lowongan.create') }}" class="btn-premium btn-premium-primary btn-premium-md">
                            <i class="fas fa-plus"></i> Tambah Lowongan
                        </a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Lowongan</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jabatan</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Persyaratan</th>
                                        {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Deskripsi</th> --}}
                                        <th class="text-secondary opacity-7">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($lowongans as $lowongan)
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 my-1">{{ $loop->iteration }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $lowongan->lowongan }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $lowongan->lowongan_jabatan }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $lowongan->persyaratan }}</p>
                                        </td>
                                        {{-- <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $lowongan->deskripsi_lowongan }}</p>
                                        </td> --}}
                                        <td class="align-middle">
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('daftar-lowongan.edit', $lowongan->id) }}" class="btn-premium btn-premium-action btn-premium-action-edit" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn-premium btn-premium-action btn-premium-action-view" data-toggle="modal" data-target="#viewModal-{{ $lowongan->id }}" title="Detail">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button type="button" class="btn-premium btn-premium-action btn-premium-action-delete" onclick="confirmDelete({{ $lowongan->id }})" title="Delete">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                            <form id="delete-form-{{ $lowongan->id }}" action="{{ route('daftar-lowongan.destroy', $lowongan->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Modal -->
                                    <div class="modal fade" id="viewModal-{{ $lowongan->id }}" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel-{{ $lowongan->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="viewModalLabel-{{ $lowongan->id }}">Detail Lowongan</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Lowongan</label>
                                                                <div class="font-weight-bold text-dark">{{ $lowongan->lowongan }}</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Jabatan</label>
                                                                <div class="font-weight-bold text-dark">{{ $lowongan->lowongan_jabatan }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Persyaratan</label>
                                                                <div class="p-3 bg-gray-100 border-radius-lg">
                                                                    <p class="text-xs mb-0 text-dark">{{ $lowongan->persyaratan }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Deskripsi Lowongan</label>
                                                                <div class="p-3 bg-gray-100 border-radius-lg">
                                                                    <p class="text-xs mb-0 text-dark text-justify" style="white-space: pre-line;">{{ $lowongan->deskripsi_lowongan }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn-premium btn-premium-ghost btn-premium-md" data-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }
</script>

@endsection
