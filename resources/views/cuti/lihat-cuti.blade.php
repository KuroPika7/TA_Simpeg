@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 px-3 d-flex align-items-center">
                        <div class="icon icon-shape bg-white shadow text-center border-radius-md md-2 d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px;">
                            <i class="fas fa-calendar-alt text-primary opacity-10" style="font-size: 20px;"></i>
                        </div>
                        <div>
                            <h5 class="text-white mb-0">Detail Pengajuan Cuti</h5>
                            <p class="text-white text-sm opacity-8 mb-0">Informasi lengkap pengajuan cuti karyawan</p>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-5">
                    <div class="row">
                        <div class="col-md-7">
                            <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Informasi Umum</h6>
                            <ul class="list-group">
                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                    <div class="d-flex flex-column w-100">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h6 class="mb-0 text-sm">{{ $cuti->karyawan->name }}</h6>
                                            @if($cuti->status == '1')
                                                <span class="badge badge-sm bg-gradient-warning">Pending</span>
                                            @elseif($cuti->status == '2')
                                                <span class="badge badge-sm bg-gradient-success">Disetujui</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-danger">Ditolak</span>
                                            @endif
                                        </div>
                                        <span class="mb-2 text-xs">Jabatan: <span class="text-dark font-weight-bold ms-sm-2">{{ $cuti->karyawan->jabatan->name ?? '-' }}</span></span>
                                        <span class="mb-2 text-xs">Jenis Cuti: <span class="text-primary font-weight-bold ms-sm-2">{{ $cuti->jenisCuti->name ?? '-' }}</span></span>
                                        <span class="mb-2 text-xs">Periode: <span class="text-dark font-weight-bold ms-sm-2">{{ \Carbon\Carbon::parse($cuti->start_date)->translatedFormat('d F Y') }} - {{ \Carbon\Carbon::parse($cuti->end_date)->translatedFormat('d F Y') }}</span></span>
                                        <span class="mb-2 text-xs">Durasi: <span class="text-dark font-weight-bold ms-sm-2">{{ \Carbon\Carbon::parse($cuti->start_date)->diffInDays(\Carbon\Carbon::parse($cuti->end_date)) + 1 }} Hari</span></span>
                                        <span class="text-xs">Tanggal Pengajuan: <span class="text-dark ms-sm-2 font-weight-bold">{{ $cuti->created_at->translatedFormat('d F Y') }}</span></span>
                                    </div>
                                </li>
                            </ul>

                            <h6 class="text-uppercase text-body text-xs font-weight-bolder mt-4 mb-3">Alasan Cuti</h6>
                            <div class="bg-gray-100 border-radius-lg p-3">
                                <p class="text-sm mb-0">{{ $cuti->reason }}</p>
                            </div>

                            @if($cuti->status == '0' && $cuti->reject_note)
                            <h6 class="text-uppercase text-body text-xs font-weight-bolder mt-4 mb-3 text-danger">Alasan Penolakan</h6>
                            <div class="bg-gray-100 border-radius-lg p-3 border border-danger">
                                <p class="text-sm mb-0 text-danger">{{ $cuti->reject_note }}</p>
                            </div>
                            @endif
                        </div>
                        
                        <div class="col-md-5 mt-md-0 mt-4">
                            <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Dokumen Pendukung</h6>
                            <div class="card border-dashed border-1 border-secondary h-100">
                                <div class="card-body d-flex flex-column justify-content-center text-center">
                                    @if($cuti->document_url)
                                        <i class="fas fa-file-image text-primary fa-4x mb-3"></i>
                                        <h6 class="mb-1 text-dark">File Pendukung</h6>
                                        <p class="text-xs text-secondary">Klik tombol di bawah untuk melihat atau mengunduh file</p>
                                        <div class="d-grid gap-2 mt-3">
                                            <button type="button" class="btn btn-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#pdfModal">Lihat File</button>
                                            <a href="{{ asset($cuti->document_url) }}" download class="btn btn-outline-primary btn-sm mb-0">Unduh File</a>
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
                        <a href="{{ route('daftar-cuti') }}" class="btn btn-light px-5 mb-0 me-2">Kembali</a>
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
                <h5 class="modal-title" id="pdfModalLabel">Preview Cuti - {{ $cuti->karyawan->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <iframe src="{{ asset($cuti->document_url) }}" width="100%" height="800px" style="border: none;"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <a href="{{ asset($cuti->document_url) }}" download class="btn btn-primary">Unduh File</a>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-gradient-primary {
        background-image: linear-gradient(310deg, #7928ca 0%, #ff0080 100%);
    }
    .shadow-primary {
        box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(233, 30, 99, 0.4);
    }
    .border-dashed {
        border-style: dashed !important;
    }
</style>
@endsection
