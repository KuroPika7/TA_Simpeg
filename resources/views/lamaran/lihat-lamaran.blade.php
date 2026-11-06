@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 px-3 d-flex align-items-center">
                        <div class="icon icon-shape bg-white shadow text-center border-radius-md md-2 d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px;">
                            <i class="fas fa-user-tie text-primary opacity-10" style="font-size: 20px;"></i>
                        </div>
                        <div>
                            <h5 class="text-white mb-0">Detail Data Pelamar</h5>
                            <p class="text-white text-sm opacity-8 mb-0">Informasi lengkap calon karyawan dan dokumen lamaran</p>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-5">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="d-flex align-items-center mb-4">
                                @if($lamaran->image_url)
                                    <div class="avatar avatar-xl position-relative me-3">
                                        <img src="{{ asset($lamaran->image_url) }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                                    </div>
                                @endif
                                <div>
                                    <h5 class="mb-1 font-weight-bolder">{{ $lamaran->name }}</h5>
                                    <p class="mb-0 font-weight-normal text-sm">{{ $lamaran->lowongan->lowongan_jabatan ?? '-' }}</p>
                                </div>
                            </div>

                            <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Informasi Pribadi</h6>
                            <ul class="list-group">
                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                    <div class="w-100">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <span class="text-xs">NIK:</span>
                                                <span class="text-dark font-weight-bold d-block">{{ $lamaran->nik ?? '-' }}</span>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <span class="text-xs">Email:</span>
                                                <span class="text-dark font-weight-bold d-block">{{ $lamaran->email }}</span>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <span class="text-xs">Telepon:</span>
                                                <span class="text-dark font-weight-bold d-block">{{ $lamaran->phone ?? '-' }}</span>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <span class="text-xs">Agama:</span>
                                                <span class="text-dark font-weight-bold d-block">{{ $lamaran->agama }}</span>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <span class="text-xs">Jenis Kelamin:</span>
                                                <span class="text-dark font-weight-bold d-block">{{ $lamaran->gender == 'Lk' ? 'Laki-laki' : 'Perempuan' }}</span>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <span class="text-xs">Pendidikan:</span>
                                                <span class="text-dark font-weight-bold d-block">{{ $lamaran->pendidikan ?? '-' }}</span>
                                            </div>                                          
                                            <div class="col-md-6 mb-3">
                                                <span class="text-xs">Status Lamaran:</span>
                                                <span class="badge badge-sm bg-gradient-{{ $lamaran->status == '0' ? 'danger' : ($lamaran->status == '1' ? 'warning' : 'success') }} d-block" style="width: fit-content;">
                                                    {{ $lamaran->status == '0' ? 'Ditolak' : ($lamaran->status == '1' ? 'Dilamar' : 'Diterima') }}
                                                </span>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <span class="text-xs">Tempat, Tanggal Lahir:</span>
                                                <span class="text-dark font-weight-bold d-block">{{ $lamaran->birth_place ?? '-' }}, {{ $lamaran->birth_date ? \Carbon\Carbon::parse($lamaran->birth_date)->translatedFormat('d F Y') : '-' }}</span>
                                            </div>
                                            <div class="col-12">
                                                <span class="text-xs">Alamat:</span>
                                                <span class="text-dark font-weight-bold d-block">{{ $lamaran->address ?? '-' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        
                        <div class="col-md-5 mt-md-0 mt-4">
                            <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Dokumen CV</h6>
                            <div class="card border-dashed border-1 border-secondary mb-4">
                                <div class="card-body d-flex flex-column justify-content-center text-center">
                                    @if($lamaran->document_url)
                                        <i class="fas fa-file-pdf text-primary fa-4x mb-3"></i>
                                        <h6 class="mb-1 text-dark">File Curriculum Vitae</h6>
                                        <p class="text-xs text-secondary">Lihat dokumen CV pelamar di bawah ini</p>
                                        <div class="d-grid gap-2 mt-3">
                                            <button type="button" class="btn-premium btn-premium-primary btn-premium-md mb-0" data-bs-toggle="modal" data-bs-target="#pdfModal">
                                                <i class="fas fa-eye"></i> Lihat CV
                                            </button>
                                            <a href="{{ asset($lamaran->document_url) }}" download class="btn-premium btn-premium-outline btn-premium-outline-primary btn-premium-md mb-0">
                                                <i class="fas fa-download"></i> Unduh CV
                                            </a>
                                        </div>
                                    @else
                                        <i class="fas fa-file-excel text-secondary fa-4x mb-3 opacity-3"></i>
                                        <h6 class="text-secondary">Tidak ada CV terlampir</h6>
                                    @endif
                                </div>
                            </div>

                            <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Dokumen KTP</h6>
                            <div class="card border-dashed border-1 border-secondary">
                                <div class="card-body d-flex flex-column justify-content-center text-center">
                                    @if($lamaran->document_ktp)
                                        <i class="fas fa-id-card text-info fa-4x mb-3"></i>
                                        <h6 class="mb-1 text-dark">File KTP</h6>
                                        <p class="text-xs text-secondary">Lihat dokumen KTP pelamar di bawah ini</p>
                                        <div class="d-grid gap-2 mt-3">
                                            <button type="button" class="btn-premium btn-premium-info btn-premium-md mb-0" data-bs-toggle="modal" data-bs-target="#ktpModal">
                                                <i class="fas fa-eye"></i> Lihat KTP
                                            </button>
                                            <a href="{{ asset($lamaran->document_ktp) }}" download class="btn-premium btn-premium-outline btn-premium-outline-info btn-premium-md mb-0">
                                                <i class="fas fa-download"></i> Unduh KTP
                                            </a>
                                        </div>
                                    @else
                                        <i class="fas fa-file-excel text-secondary fa-4x mb-3 opacity-3"></i>
                                        <h6 class="text-secondary">Tidak ada KTP terlampir</h6>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>

                    <hr class="horizontal dark my-5">

                    <div class="d-flex justify-content-end gap-3">
                        <a href="{{ route('daftar-lamaran.search') }}" class="btn-premium btn-premium-ghost btn-premium-md mb-0">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        
                        @if($lamaran->status == '1')
                            <button type="button" onclick="updateStatus({{ $lamaran->id }}, '2')" class="btn-premium btn-premium-success btn-premium-md mb-0">
                                <i class="fas fa-check"></i> Terima
                            </button>
                            <button type="button" onclick="updateStatus({{ $lamaran->id }}, '0')" class="btn-premium btn-premium-danger btn-premium-md mb-0">
                                <i class="fas fa-times"></i> Tolak
                            </button>
                        @endif
                        @if($lamaran->status == '2')
                             <a href="{{ route('tambah-karyawan') }}?lamaran_id={{ $lamaran->id }}" class="btn-premium btn-premium-info btn-premium-md mb-0">
                                <i class="fas fa-user-plus"></i> Angkat Jadi Pegawai
                             </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- PDF Modal -->
<div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfModalLabel">Preview CV - {{ $lamaran->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <iframe src="{{ asset($lamaran->document_url) }}" width="100%" height="800px" style="border: none;"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <a href="{{ asset($lamaran->document_url) }}" download class="btn btn-primary">Unduh File</a>
            </div>
        </div>
    </div>
</div>

<!-- KTP Modal -->
<div class="modal fade" id="ktpModal" tabindex="-1" role="dialog" aria-labelledby="ktpModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ktpModalLabel">Preview KTP - {{ $lamaran->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <iframe src="{{ asset($lamaran->document_ktp) }}" width="100%" height="800px" style="border: none;"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <a href="{{ asset($lamaran->document_ktp) }}" download class="btn btn-info text-white">Unduh File</a>
            </div>
        </div>
    </div>
</div>

<script>
    function updateStatus(id, status) {
        const title = status == '2' ? 'Terima Pelamar?' : 'Tolak Pelamar?';
        const text = status == '2' ? 'Anda akan menerima pelamar ini.' : 'Anda akan menolak pelamar ini.';
        const confirmBtnColor = status == '2' ? '#2dce89' : '#f5365c';

        Swal.fire({
            title: title,
            text: text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: confirmBtnColor,
            cancelButtonColor: '#adb5bd',
            confirmButtonText: 'Ya, Lanjutkan'
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

<style>
    .bg-gradient-primary {
        background-image: linear-gradient(310deg, #5e72e4 0%, #825ee4 100%);
    }
    .shadow-primary {
        box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(94, 114, 228, 0.4);
    }
    .border-dashed {
        border-style: dashed !important;
    }
    .avatar-xl {
        width: 74px !important;
        height: 74px !important;
    }
    .btn-grad-blue {
        background-image: linear-gradient(310deg, #2152ff 0%, #21d4fd 100%);
        color: white;
    }
    .btn-grad-blue:hover {
        color: white;
        box-shadow: 0 4px 10px rgba(33, 212, 253, 0.4);
    }
</style>
@endsection
