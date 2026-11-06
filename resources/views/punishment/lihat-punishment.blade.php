@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-danger shadow-danger border-radius-lg pt-4 pb-3 px-3 d-flex align-items-center">
                        <div class="icon icon-shape bg-white shadow text-center border-radius-md md-2 d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px;">
                            <i class="fas fa-exclamation-triangle text-danger opacity-10" style="font-size: 20px;"></i>
                        </div>
                        <div>
                            <h5 class="text-white mb-0">Detail Arsip Punishment</h5>
                            <p class="text-white text-sm opacity-8 mb-0">Informasi lengkap pelanggaran dan sanksi karyawan</p>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-5">
                    <div class="row">
                        <div class="col-md-7">
                            <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Informasi Umum</h6>
                            <ul class="list-group">
                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-3 text-sm">{{ $punishment->karyawan->name }}</h6>
                                        <span class="mb-2 text-xs">Jabatan: <span class="text-dark font-weight-bold ms-sm-2">{{ $punishment->karyawan->jabatan->name ?? '-' }}</span></span>
                                        <span class="mb-2 text-xs">Nomor Surat: <span class="text-dark font-weight-bold ms-sm-2">{{ $punishment->nomor_surat }}</span></span>
                                        <span class="mb-2 text-xs">Perihal: <span class="text-dark font-weight-bold ms-sm-2">{{ $punishment->perihal_surat }}</span></span>
                                        <span class="text-xs">Tanggal Dibuat: <span class="text-dark ms-sm-2 font-weight-bold">{{ $punishment->created_at->translatedFormat('d F Y') }}</span></span>
                                    </div>
                                </li>
                            </ul>

                            <h6 class="text-uppercase text-body text-xs font-weight-bolder mt-4 mb-3">Keterangan Pelanggaran</h6>
                            <div class="bg-gray-100 border-radius-lg p-3">
                                <p class="text-sm mb-0">{{ $punishment->pelanggaran }}</p>
                            </div>
                        </div>
                        
                        <div class="col-md-5 mt-md-0 mt-4">
                            <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Dokumen Surat</h6>
                            <div class="card border-dashed border-1 border-secondary h-100">
                                <div class="card-body d-flex flex-column justify-content-center text-center">
                                    @if($punishment->document_url)
                                        <i class="fas fa-file-pdf text-danger fa-4x mb-3"></i>
                                        <h6 class="mb-1 text-dark">File Punishment</h6>
                                        <p class="text-xs text-secondary">Klik tombol di bawah untuk melihat atau mengunduh file</p>
                                        <div class="d-grid gap-2 mt-3">
                                            <button type="button" class="btn-premium btn-premium-danger btn-premium-md mb-0" data-bs-toggle="modal" data-bs-target="#pdfModal">
                                                <i class="fas fa-eye"></i> Lihat File
                                            </button>
                                            <a href="{{ asset($punishment->document_url) }}" download class="btn-premium btn-premium-outline btn-premium-outline-danger btn-premium-md mb-0">
                                                <i class="fas fa-download"></i> Unduh File
                                            </a>
                                        </div>
                                    @else
                                        <i class="fas fa-file-excel text-secondary fa-4x mb-3 opacity-3"></i>
                                        <h6 class="text-secondary">Tidak ada file terlampir</h6>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="horizontal dark my-5">

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('daftar-punishment') }}" class="btn-premium btn-premium-ghost btn-premium-md">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
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
                <h5 class="modal-title" id="pdfModalLabel">Preview Punishment - {{ $punishment->nomor_surat }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <iframe src="{{ asset($punishment->document_url) }}" width="100%" height="800px" style="border: none;"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-premium btn-premium-ghost btn-premium-md" data-bs-dismiss="modal">Tutup</button>
                <a href="{{ asset($punishment->document_url) }}" download class="btn-premium btn-premium-danger btn-premium-md">Unduh File</a>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-gradient-danger {
        background-image: linear-gradient(310deg, #ea0606 0%, #ff667c 100%);
    }
    .shadow-danger {
        box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(244, 67, 54, 0.4);
    }
    .border-dashed {
        border-style: dashed !important;
    }
</style>
@endsection
