@extends('layouts.user_type.auth')

@section('content')
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
  <style>
    .modal-map {
      height: 250px;
      width: 100%;
      border-radius: 12px;
      margin-top: 15px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
  </style>
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card modern-table-card">
          <div class="card-header table-header-gradient">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                @if (Auth::user()->karyawan->jabatan->level === 4)
                  <h5 class="table-title mb-0">Daftar Absensi Semua Karyawan</h5>
                  <p class="table-subtitle mb-0">Kelola data absensi karyawan</p>
                @else
                  <h5 class="table-title mb-0">Daftar Absensi {{ Auth::user()->karyawan->name }}</h5>
                  <p class="table-subtitle mb-0">Riwayat absensi Anda</p>
                @endif
              </div>

              <form action="{{ route('daftar-absensi') }}" method="GET" class="d-flex align-items-center gap-2">
                <div class="input-group input-group-sm">
                  <span class="input-group-text bg-white border-0 text-secondary"><i class="fas fa-calendar"></i></span>
                  <input type="date" name="start_date" id="start_date" class="form-control border-0 ps-2"
                    value="{{ $startDate ?? now()->format('Y-m-d') }}" max="{{ now()->format('Y-m-d') }}" placeholder="Start Date">
                </div>
                <span class="text-white font-weight-bold px-1">-</span>
                <div class="input-group input-group-sm">
                  <span class="input-group-text bg-white border-0 text-secondary"><i class="fas fa-calendar"></i></span>
                  <input type="date" name="end_date" id="end_date" class="form-control border-0 ps-2"
                    value="{{ $endDate ?? now()->format('Y-m-d') }}" max="{{ now()->format('Y-m-d') }}"
                    placeholder="End Date">
                </div>
                <button type="submit"
                  class="btn-premium btn-premium-white btn-premium-sm mb-0 text-primary ms-2 font-weight-bold" style="background: white !important; color: #7928CA !important;">
                  <i class="fas fa-filter"></i> Filter
                </button>
                @if (request('start_date') || request('end_date'))
                  <a href="{{ route('daftar-absensi') }}" class="btn-premium btn-premium-outline btn-premium-outline-secondary btn-premium-sm mb-0 ms-1" style="border-color: white !important; color: white !important;"
                    title="Reset Filter"><i class="fas fa-times"></i></a>
                @endif
              </form>
            </div>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="modern-table">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Karyawan</th>
                    <th>Foto</th>
                    <th>Jenis</th>
                    <th>Lokasi</th>
                    <th>Status</th>
                    <th>Waktu</th>
                    <!-- @if (Auth::user()->karyawan->jabatan->level === 4)
                      <th class="text-center">Aksi</th>
                    @endif -->
                  </tr>
                </thead>
                <tbody>
                  @forelse($presensis as $index => $presensi)
                    <tr>
                      <td>
                        <span class="text-sm font-weight-bold">{{ $index + 1 }}</span>
                      </td>
                      <td>
                        <div class="table-user-info">
                          @if ($presensi->karyawan && $presensi->karyawan->image_url)
                            <img src="{{ asset('storage/' . $presensi->karyawan->image_url) }}" class="table-user-avatar"
                              alt="{{ $presensi->karyawan->name }}">
                          @else
                            <img src="{{ asset('assets/img/team-2.jpg') }}" class="table-user-avatar" alt="Default">
                          @endif
                          <div class="table-user-details">
                            <h6>{{ $presensi->karyawan->name ?? 'N/A' }}</h6>
                            <p>{{ $presensi->karyawan->jabatan->name ?? '-' }}</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        @if ($presensi->image_url)
                          <img src="{{ asset($presensi->image_url) }}" alt="Foto Absen"
                            style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px; cursor: pointer;"
                            data-bs-toggle="modal" data-bs-target="#imageModal{{ $presensi->id }}">
                        @else
                          <span class="text-muted text-sm">No photo</span>
                        @endif
                      </td>
                      <td>
                        @if ($presensi->type === 'in')
                          <span class="table-badge badge-success">Masuk</span>
                        @elseif ($presensi->type === 'out')
                          <span class="table-badge badge-danger">Keluar</span>
                        @elseif ($presensi->type === 'izin')
                          <span class="table-badge badge-warning">Izin</span>
                        @else
                          <span class="table-badge badge-info">{{ ucfirst($presensi->type) }}</span>
                        @endif
                      </td>
                      <td>
                        <div style="max-width: 250px;">
                          <p class="text-xs mb-1">
                            <i class="fas fa-map-marker-alt me-1"></i>
                            {{ Str::limit($presensi->clock_in_location ?? 'Lokasi tidak tersedia', 50) }}
                          </p>
                          @if ($presensi->latitude && $presensi->longitude)
                            <a href="https://www.openstreetmap.org/?mlat={{ $presensi->latitude }}&mlon={{ $presensi->longitude }}#map=18/{{ $presensi->latitude }}/{{ $presensi->longitude }}"
                              target="_blank" class="btn-premium btn-premium-outline btn-premium-outline-info btn-premium-sm"
                              style="font-size: 0.7rem; padding: 4px 10px;" title="Lihat di OpenStreetMap">
                              <i class="fas fa-map-marked-alt"></i> Cek Lokasi
                            </a>
                          @endif
                        </div>
                      </td>
                      <td>
                        <small class="text-xxs text-light d-block mb-1">Row ID: {{ $presensi->id }}</small>
                        @if ($presensi->status == 'Tepat Waktu' || $presensi->status == 'Pulang Normal')
                          <span class="table-badge badge-success">{{ $presensi->status }}</span>
                        @elseif ($presensi->status == 'Terlambat' || $presensi->status == 'Pulang Cepat')
                          <span class="table-badge badge-warning">{{ $presensi->status }}</span>
                        @elseif ($presensi->status == 'Lembur')
                          <span class="table-badge badge-info">{{ $presensi->status }}</span>
                        @else
                          <span class="text-xs text-secondary">{{ $presensi->status ?? '-' }}</span>
                        @endif

                        @php
                            $alasanDisplay = $presensi->keterangan_pulang ?: $presensi->alasan_izin;
                        @endphp
                        
                        @if ($alasanDisplay)
                          <div class="mt-2">
                            <div class="p-2 bg-light border-radius-sm" style="border-left: 3px solid #fbcf33;">
                              <p class="text-xs mb-0 text-dark font-weight-bold" style="white-space: normal; line-height: 1.2;">
                                <i class="fas fa-comment-dots me-1 text-warning"></i>Keterangan:
                              </p>
                              <p class="text-xs mb-0 text-secondary italic" style="white-space: normal; line-height: 1.2; font-style: italic;">
                                {{ $alasanDisplay }}
                              </p>
                            </div>
                          </div>
                        @endif
                      </td>
                      <td>
                        @php
                          try {
                              $waktuFormatted =
                                  $presensi->clock_at instanceof \Carbon\Carbon
                                      ? $presensi->clock_at->format('d M Y, H:i')
                                      : \Carbon\Carbon::parse($presensi->clock_at)->format('d M Y, H:i');
                          } catch (\Exception $e) {
                              $waktuFormatted = $presensi->clock_at ?? 'N/A';
                          }
                        @endphp
                        <span class="text-sm">{{ $waktuFormatted }}</span>
                      </td>
                      @if (Auth::user()->karyawan->jabatan->level === 4)
                        <td>
                          <div class="table-actions justify-content-center">
                            @if ($presensi->type == 'izin')
                             <button class="btn-premium btn-premium-action btn-premium-action-view" data-bs-toggle="modal"
                                data-bs-target="#izinModal{{ $presensi->id }}" title="Detail Izin">
                                <i class="fas fa-eye"></i>
                              </button>
                            @endif
                          </div>
                        </td>
                      @endif
                    </tr>

                    @if ($presensi->image_url)
                      <div class="modal fade" id="imageModal{{ $presensi->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Foto Absensi - {{ $presensi->karyawan->name ?? 'N/A' }}</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <div class="text-center">
                                <img src="{{ asset($presensi->image_url) }}" alt="Foto Absensi"
                                  style="max-width: 100%; border-radius: 10px; max-height: 300px; object-fit: contain;">
                              </div>
                              <div class="mt-3">
                                <p class="mb-1 text-sm"><strong><i class="fas fa-clock me-1 text-primary"></i> Waktu:</strong> {{ $waktuFormatted }}</p>
                                <p class="mb-1 text-sm"><strong><i class="fas fa-map-marker-alt me-1 text-danger"></i> Lokasi:</strong> {{ $presensi->clock_in_location }}</p>
                                @if($presensi->keterangan_pulang)
                                  <p class="mb-1 text-sm"><strong><i class="fas fa-info-circle me-1 text-warning"></i> Alasan Pulang:</strong> {{ $presensi->keterangan_pulang }}</p>
                                @endif
                                
                                @if ($presensi->latitude && $presensi->longitude)
                                  <div id="map-{{ $presensi->id }}" class="modal-map" 
                                    data-lat="{{ $presensi->latitude }}" 
                                    data-lng="{{ $presensi->longitude }}"></div>
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endif

                    @if ($presensi->type == 'izin')
                      <div class="modal fade" id="izinModal{{ $presensi->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Detail Izin</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <p><strong>Nama Karyawan:</strong> {{ $presensi->karyawan->name }}</p>
                              <p><strong>Alasan Izin:</strong> {{ $presensi->alasan_izin ?? '-' }}</p>
                              <p><strong>Tanggal Izin:</strong> {{ $presensi->created_at->format('d M Y') }}</p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endif
                  @empty
                    <tr>
                      <td colspan="7">
                        <div class="table-empty-state">
                          <i class="fas fa-calendar-check"></i>
                          <h6>Belum Ada Data Absensi</h6>
                          <p>Belum ada data absensi yang tercatat</p>
                        </div>
                      </td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
            <div class="px-4 py-3 border-top">
              {{ $presensis->appends(request()->query())->links() }}
            </div>
          </div>
        </div>

        @if (Auth::user()->karyawan->jabatan->level === 4)
          <div class="card modern-table-card mt-4">
            <div class="card-header table-header-gradient" style="background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%) !important;">
              <h6 class="table-title mb-0 text-white"><i class="fas fa-file-excel me-2"></i> Export Daftar Absensi</h6>
              <p class="table-subtitle mb-0 text-white opacity-8">Export data absensi bulanan ke format Excel</p>
            </div>
            <div class="card-body">
              <form action="{{ route('presensi.export') }}" method="GET" class="row align-items-end">
                <div class="col-md-4">
                  <label for="export_month" class="form-label text-sm font-weight-bold">Pilih Bulan & Tahun</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                    <input type="month" name="month" id="export_month" class="form-control" 
                      value="{{ date('Y-m') }}" required>
                  </div>
                </div>
                <div class="col-md-3">
                  <button type="submit" class="btn-premium btn-premium-warning btn-premium-md mb-0 w-100">
                    <i class="fas fa-download"></i> Export ke Excel
                  </button>
                </div>
              </form>
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>

  @if (session('success'))
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const toast = document.createElement('div');
        toast.className = 'modern-toast';
        toast.innerHTML = `
          <div class="toast-icon">
            <i class="fas fa-check-circle"></i>
          </div>
          <div class="toast-content">
            <div class="toast-title">Success!</div>
            <div class="toast-message">{{ session('success') }}</div>
          </div>
          <button class="toast-close" onclick="this.parentElement.remove()">
            <i class="fas fa-times"></i>
          </button>
        `;

        const style = document.createElement('style');
        style.textContent = `
          .modern-toast {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 99999 !important;
            min-width: 350px;
            max-width: 450px;
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            border-radius: 12px;
            padding: 16px 20px;
            box-shadow: 0 10px 40px rgba(56, 239, 125, 0.4), 0 4px 12px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideInRight 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            backdrop-filter: blur(10px);
          }
          
          @keyframes slideInRight {
            from {
              transform: translateX(400px);
              opacity: 0;
            }
            to {
              transform: translateX(0);
              opacity: 1;
            }
          }
          
          @keyframes slideOutRight {
            from {
              transform: translateX(0);
              opacity: 1;
            }
            to {
              transform: translateX(400px);
              opacity: 0;
            }
          }
          
          .toast-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
          }
          
          .toast-icon i {
            color: white;
            font-size: 20px;
          }
          
          .toast-content {
            flex: 1;
            color: white;
          }
          
          .toast-title {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 4px;
            color: white;
          }
          
          .toast-message {
            font-size: 14px;
            opacity: 0.95;
            color: white;
            line-height: 1.4;
          }
          
          .toast-close {
            width: 28px;
            height: 28px;
            background: rgba(255, 255, 255, 0.15);
            border: none;
            border-radius: 6px;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            flex-shrink: 0;
          }
          
          .toast-close:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: scale(1.1);
          }
          
          .toast-close i {
            font-size: 14px;
          }
          
          @media (max-width: 576px) {
            .modern-toast {
              min-width: auto;
              max-width: calc(100vw - 40px);
              right: 20px;
              left: 20px;
            }
          }
        `;

        document.head.appendChild(style);
        document.body.appendChild(toast);

        // Auto remove after 5 seconds with animation
        setTimeout(() => {
          toast.style.animation = 'slideOutRight 0.3s ease-in-out';
          setTimeout(() => {
            toast.remove();
          }, 300);
        }, 5000);
      });
    </script>
  @endif
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const startDateInput = document.getElementById('start_date');
      const endDateInput = document.getElementById('end_date');
      const form = startDateInput.closest('form');

      function updateConstraints() {
        const startDate = startDateInput.value;
        const endDate = endDateInput.value;

        if (startDate) {
          endDateInput.min = startDate;
        }
        
        if (endDate) {
          startDateInput.max = endDate;
        }
      }

      startDateInput.addEventListener('change', updateConstraints);
      endDateInput.addEventListener('change', updateConstraints);
      
      // Initialize constraints
      updateConstraints();

      form.addEventListener('submit', function(e) {
        if (startDateInput.value && endDateInput.value && startDateInput.value > endDateInput.value) {
            e.preventDefault();
            alert('Tanggal awal tidak boleh lebih besar dari tanggal akhir.');
        }
      });

      // Handle Map Initialization for Modals
      const modals = document.querySelectorAll('.modal');
      modals.forEach(modal => {
        modal.addEventListener('shown.bs.modal', function() {
          const mapElement = this.querySelector('.modal-map');
          if (mapElement) {
            const id = mapElement.id;
            const lat = mapElement.dataset.lat;
            const lng = mapElement.dataset.lng;
            
            // Check if map already initialized
            if (mapElement._leaflet_id) return;

            const map = L.map(id).setView([lat, lng], 16);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
              attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
            L.marker([lat, lng]).addTo(map);
            
            // Fix Leaflet rendering issues in modals
            setTimeout(() => {
              map.invalidateSize();
            }, 200);
          }
        });
      });
    });
  </script>
@endsection
