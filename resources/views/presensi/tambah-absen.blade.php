@extends('layouts.user_type.auth')

@section('content')
  <style>
    #loadingOverlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(255, 255, 255, 0.95);
      display: none;
      justify-content: center;
      align-items: center;
      z-index: 1050;
      border-radius: 0.5rem;
    }

    .loading-content {
      text-align: center;
      color: #344767;
    }

    .loading-spinner {
      width: 60px;
      height: 60px;
      border: 4px solid rgba(52, 71, 103, 0.2);
      border-top-color: #5e72e4;
      border-radius: 50%;
      animation: spin 1s linear infinite;
      margin: 0 auto 20px;
    }

    @keyframes spin {
      to {
        transform: rotate(360deg);
      }
    }

    #cameraContainer {
      position: relative;
      width: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    #video {
      width: 100%;
      max-width: 700px;
      height: auto;
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
      display: block;
      margin: 0 auto;
    }

    .btn-gradient-cyan {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border: none;
      color: white;
      transition: all 0.3s ease;
    }

    .btn-gradient-cyan:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
      color: white;
    }

    #map {
      height: 350px;
      width: 100%;
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      display: none;
    }

    .map-placeholder {
      height: 350px;
      width: 100%;
      background: #f8f9fa;
      border-radius: 15px;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      color: #adb5bd;
    }
  </style>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="alert-text text-white"><strong>Success!</strong> {{ session('success') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="alert-text text-white"><strong>Success!</strong> {{ session('message') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <span class="alert-text text-white"><strong>Error!</strong> {{ session('error') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="card modern-table-card">
          <div class="card-header table-header-gradient">
            <div>
              <h5 class="table-title">Tambah Presensi</h5>
              <p class="table-subtitle">Klik tombol untuk melakukan absensi dengan foto dan lokasi</p>
            </div>
          </div>
          <div class="card-body p-4">
            <!-- Main Action Button -->
            <div class="text-center mb-4">
              <button type="button" class="btn btn-gradient-cyan btn-lg px-5 py-3" data-bs-toggle="modal"
                data-bs-target="#presensiModal">
                <i class="fas fa-camera me-2"></i> Tambah Absensi
              </button>
            </div>

            <!-- Information Cards -->
            <div class="row mt-4">
              <!-- Instruction Card -->
              <div class="col-md-4 mb-3">
                <div class="card h-100 border-0 shadow-sm">
                  <div class="card-body text-center">
                    <div class="icon-shape bg-gradient-primary rounded-circle mb-3 mx-auto"
                      style="width: 60px; height: 60px; display: grid; place-items: center;">
                      <i class="fas fa-clipboard-list" style="color: white; font-size: 1.5rem;"></i>
                    </div>
                    <h6 class="font-weight-bold text-dark">Cara Absensi</h6>
                    <p class="text-sm text-muted mb-0">
                      1. Klik tombol "Tambah Absensi"<br>
                      2. Izinkan akses kamera & lokasi<br>
                      3. Ambil foto selfie<br>
                      4. Klik tombol "ABSEN"
                    </p>
                  </div>
                </div>
              </div>

              <!-- Camera Info Card -->
              <div class="col-md-4 mb-3">
                <div class="card h-100 border-0 shadow-sm">
                  <div class="card-body text-center">
                    <div class="icon-shape bg-gradient-success rounded-circle mb-3 mx-auto"
                      style="width: 60px; height: 60px; display: grid; place-items: center;">
                      <i class="fas fa-camera" style="color: white; font-size: 1.5rem;"></i>
                    </div>
                    <h6 class="font-weight-bold text-dark">Foto Selfie</h6>
                    <p class="text-sm text-muted mb-0">
                      Pastikan wajah Anda terlihat jelas dalam foto. Kamera depan akan otomatis aktif untuk memudahkan
                      pengambilan foto selfie.
                    </p>
                  </div>
                </div>
              </div>

              <!-- Location Info Card -->
              <div class="col-md-4 mb-3">
                <div class="card h-100 border-0 shadow-sm">
                  <div class="card-body text-center">
                    <div class="icon-shape bg-gradient-info rounded-circle mb-3 mx-auto"
                      style="width: 60px; height: 60px; display: grid; place-items: center;">
                      <i class="fas fa-map-marker-alt" style="color: white; font-size: 1.5rem;"></i>
                    </div>
                    <h6 class="font-weight-bold text-dark">Lokasi GPS</h6>
                    <p class="text-sm text-muted mb-0">
                      Sistem akan otomatis mendeteksi lokasi Anda saat melakukan absensi. Pastikan GPS aktif untuk akurasi
                      lokasi.
                    </p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Requirements Alert -->
            <div class="alert border mt-4" role="alert" style="background-color: #f8f9fa;">
              <div class="d-flex align-items-start">
                <i class="fas fa-info-circle text-primary me-3" style="font-size: 1.5rem; margin-top: 2px;"></i>
                <div>
                  <h6 class="alert-heading mb-1 text-dark">Persyaratan Absensi</h6>
                  <p class="mb-0 text-sm text-muted">
                    <i class="fas fa-check text-success me-2"></i>Browser harus mendukung kamera dan GPS<br>
                    <i class="fas fa-check text-success me-2"></i>Izinkan akses kamera dan lokasi saat diminta<br>
                    <i class="fas fa-check text-success me-2"></i>Pastikan koneksi internet stabil
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Presensi Modal -->
  <div class="modal fade" id="presensiModal" tabindex="-1" aria-labelledby="presensiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content" style="position: relative;">
        <div class="modal-header">
          <h5 class="modal-title" id="presensiModalLabel">Ambil Foto Presensi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- Loading Overlay (Inside Modal) -->
        <div id="loadingOverlay" style="display: flex;">
          <div class="loading-content">
            <div class="loading-spinner"></div>
            <h5 id="loadingText">Memuat kamera...</h5>
          </div>
        </div>

        <div class="modal-body" style="min-height: 200px;">
          <form id="presensiForm" action="{{ route('tambah-absen.store') }}" method="POST">
            @csrf

            <!-- Hidden inputs for data -->
            <input type="hidden" name="karyawan_id" id="karyawan_id" value="{{ auth()->user()->karyawan->id }}">
            <input type="hidden" name="clock_in_location" id="clock_in_location">
            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">
            <input type="hidden" name="image_url" id="image_url">

            <!-- Preview Row -->
            <div class="row mb-3">
              <!-- Camera Preview -->
              <div class="col-lg-6 mb-3">
                <div id="cameraContainer" style="display: none;">
                  <label class="form-label fw-bold d-block text-center mb-2">
                    <i class="fas fa-camera me-2"></i>Pratinjau Kamera
                  </label>
                  <video id="video" autoplay playsinline></video>
                  <canvas id="canvas" style="display: none;"></canvas>
                </div>
              </div>
              
              <!-- Map Location View -->
              <div class="col-lg-6 mb-3">
                <div id="mapContainer" style="display: none;">
                  <label class="form-label fw-bold d-block text-center mb-2">
                    <i class="fas fa-map-marker-alt me-2"></i>Lokasi Anda
                  </label>
                  <div id="map"></div>
                  <div id="mapPlaceholder" class="map-placeholder">
                    <div class="spinner-border text-primary mb-2" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>
                    <span>Mendeteksi Lokasi...</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Type Selection -->
            <div class="mb-4" id="typeContainer" style="display: none;">
              <div class="row justify-content-center">
                <div class="col-md-6">
                  <label for="type" class="form-label fw-bold">
                    <i class="ni ni-time-alarm me-2"></i>Tipe Absensi
                  </label>
                  <select name="type" id="type" class="form-select form-select-lg" required>
                    <option value="Datang">🌅 Masuk</option>
                    <option value="Pulang">🌙 Keluar</option>
                  </select>
                </div>
              </div>
            </div>

            <!-- Early Leave Reason -->
            <div class="mb-4" id="reasonContainer" style="display: none;">
              <div class="row justify-content-center">
                <div class="col-md-6">
                  <label for="keterangan_pulang" class="form-label fw-bold">
                    <i class="fas fa-pen me-2"></i>Alasan Pulang Cepat
                  </label>
                  <textarea name="keterangan_pulang" id="keterangan_pulang" class="form-control" rows="3" placeholder="Jelaskan alasan pulang lebih awal..."></textarea>
                  <small class="text-danger">* Wajib diisi jika pulang sebelum jam 17:00</small>
                </div>
              </div>
            </div>

            <!-- Absen Button -->
            <div class="text-center">
              <button type="button" id="absenBtn" class="btn btn-gradient-cyan btn-lg" style="display: none;">
                <i class="fas fa-check me-2"></i> ABSEN
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    let video = document.getElementById('video');
    let canvas = document.getElementById('canvas');
    let absenBtn = document.getElementById('absenBtn');
    let loadingOverlay = document.getElementById('loadingOverlay');
    let loadingText = document.getElementById('loadingText');
    let cameraContainer = document.getElementById('cameraContainer');
    let stream = null;

    function showLoading(text) {
      loadingText.textContent = text;
      loadingOverlay.style.display = 'flex';
      cameraContainer.style.display = 'none';
      document.getElementById('mapContainer').style.display = 'none';
    }

    function hideLoading() {
      loadingOverlay.style.display = 'none';
      cameraContainer.style.display = 'block';
      document.getElementById('mapContainer').style.display = 'block';
    }

    let map = null;
    let marker = null;

    function initMap() {
      if (map) return;
      
      // Default to Indonesia center
      map = L.map('map').setView([-2.5489, 118.0149], 5);
      
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
      }).addTo(map);
      
      marker = L.marker([-2.5489, 118.0149]).addTo(map);
    }

    // Initialize when modal is shown
    document.getElementById('presensiModal').addEventListener('shown.bs.modal', function() {
      initializeCamera();
    });

    // Cleanup when modal is hidden
    document.getElementById('presensiModal').addEventListener('hidden.bs.modal', function() {
      stopCamera();
      resetForm();
    });

    async function initializeCamera() {
      try {
        showLoading('Memuat kamera & lokasi...');
        initMap();
        
        // Start both camera and location detection
        const cameraPromise = startCamera();
        const locationPromise = getGeolocation(true); // true means update map
        
        await cameraPromise;
        // We don't necessarily need to wait for location to show the camera, 
        // but it's better to show everything when ready
        
        hideLoading();
        document.getElementById('typeContainer').style.display = 'block';

        // Disable Pulang option if before 14:00 (Logic removed to allow server-side validation)
        const now = new Date();
        const hour = now.getHours();
        const pulangOption = document.querySelector('option[value="Pulang"]');
        /* 
        if (hour < 17) {
          pulangOption.disabled = true;
        }
        */

        absenBtn.style.display = 'inline-block';
      } catch (error) {
        console.error('Camera error:', error);
        hideLoading();
        alert('Gagal mengakses kamera. Pastikan Anda telah memberikan izin kamera.');
      }
    }

    async function startCamera() {
      // Detect if mobile device
      const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

      const constraints = {
        video: {
          width: {
            ideal: 1280
          },
          height: {
            ideal: 720
          },
          facingMode: isMobile ? 'user' : 'user' // 'user' for front camera
        }
      };

      try {
        stream = await navigator.mediaDevices.getUserMedia(constraints);
        video.srcObject = stream;
        video.style.display = 'block';
      } catch (error) {
        console.error('Camera error:', error);
        throw new Error('Gagal mengakses kamera.');
      }
    }

    function stopCamera() {
      if (stream) {
        stream.getTracks().forEach(track => track.stop());
        stream = null;
      }
      video.srcObject = null;
    }

    function resetForm() {
      document.getElementById('clock_in_location').value = '';
      document.getElementById('latitude').value = '';
      document.getElementById('longitude').value = '';
      document.getElementById('image_url').value = '';
      document.getElementById('type').value = 'Datang';
      document.getElementById('typeContainer').style.display = 'none';
      absenBtn.style.display = 'none';
      absenBtn.disabled = false;
      absenBtn.innerHTML = '<i class="fas fa-check me-2"></i> ABSEN';
    }



    // Absen button click handler
    absenBtn.addEventListener('click', async function() {
      try {
        // Step 1: Capture photo
        showLoading('Mengambil foto...');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        const context = canvas.getContext('2d');
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        const imageDataUrl = canvas.toDataURL('image/png');
        document.getElementById('image_url').value = imageDataUrl;

        // Step 2: Get geolocation (final check)
        showLoading('Memastikan lokasi...');
        await getGeolocation(false);

        // Step 3: Submit form
        showLoading('Menyimpan data...');
        document.getElementById('presensiForm').submit();

      } catch (error) {
        console.error('Absen error:', error);
        hideLoading();
        alert(error.message);
      }
    });

    async function getGeolocation(updateMap = false) {
      return new Promise((resolve, reject) => {
        if (!navigator.geolocation) {
          reject(new Error('Geolocation tidak didukung oleh browser Anda'));
          return;
        }

        navigator.geolocation.getCurrentPosition(
          async (position) => {
              const lat = position.coords.latitude;
              const lng = position.coords.longitude;

              document.getElementById('latitude').value = lat;
              document.getElementById('longitude').value = lng;

              if (updateMap && map) {
                document.getElementById('mapPlaceholder').style.display = 'none';
                document.getElementById('map').style.display = 'block';
                
                const latLng = [lat, lng];
                map.setView(latLng, 16);
                marker.setLatLng(latLng);
                
                // Force leaflet to recalculate size if it was hidden
                setTimeout(() => {
                  map.invalidateSize();
                }, 100);
              }

              // Reverse geocoding to get address
              try {
                const address = await reverseGeocode(lat, lng);
                document.getElementById('clock_in_location').value = address;
              } catch (error) {
                console.error('Geocoding error:', error);
                document.getElementById('clock_in_location').value = `Lat: ${lat}, Lng: ${lng}`;
              }

              resolve();
            },
            (error) => {
              let errorMessage = 'Gagal mengambil lokasi. ';
              switch (error.code) {
                case error.PERMISSION_DENIED:
                  errorMessage += 'Izin lokasi ditolak. Silakan aktifkan izin lokasi di browser Anda.';
                  break;
                case error.POSITION_UNAVAILABLE:
                  errorMessage += 'Informasi lokasi tidak tersedia.';
                  break;
                case error.TIMEOUT:
                  errorMessage += 'Permintaan lokasi timeout.';
                  break;
                default:
                  errorMessage += 'Terjadi kesalahan yang tidak diketahui.';
              }
              reject(new Error(errorMessage));
            }, {
              enableHighAccuracy: true,
              timeout: 30000,
              maximumAge: 300000
            }
        );
      });
    }

    async function reverseGeocode(lat, lng) {
      try {
        const response = await fetch(
          `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`
        );
        const data = await response.json();

        if (data && data.display_name) {
          return data.display_name;
        } else {
          return `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
        }
      } catch (error) {
        console.error('Reverse geocoding failed:', error);
        return `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
      }
    }
    // Type change handler
    document.getElementById('type').addEventListener('change', function() {
        const type = this.value;
        const now = new Date();
        const hour = now.getHours();
        const reasonContainer = document.getElementById('reasonContainer');
        const reasonInput = document.getElementById('keterangan_pulang');
        
        // Show reason field if 'Pulang' is selected and it's before 17:00
        // hour < 17 checks if the current hour is less than 17 (5 PM)
        if (type === 'Pulang' && hour < 17) {
            reasonContainer.style.display = 'block';
            reasonInput.setAttribute('required', 'required');
        } else {
            reasonContainer.style.display = 'none';
            reasonInput.removeAttribute('required');
            reasonInput.value = '';
        }
    });
  </script>
@endsection
