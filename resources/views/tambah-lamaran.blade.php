<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Apply Job - PT Super Permata Kitchen</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    :root {
      --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      --glass-bg: rgba(255, 255, 255, 0.95);
      --glass-border: 1px solid rgba(255, 255, 255, 0.18);
      --text-primary: #2d3748;
      --text-secondary: #718096;
    }

    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      color: var(--text-primary);
      overflow-x: hidden;
      background-color: #f8f9fa;
    }

    /* Navbar & Glassmorphism */
    .navbar {
      transition: all 0.4s ease;
      padding: 1.5rem 0;
      background: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(10px);
    }

    .navbar.scrolled {
      background: rgba(255, 255, 255, 0.95);
      padding: 1rem 0;
      box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05);
    }

    .navbar-brand {
      font-weight: 700;
      font-size: 1.5rem;
      color: #fff;
    }

    .navbar.scrolled .navbar-brand {
      background: var(--primary-gradient);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .nav-link {
      font-weight: 500;
      color: rgba(255, 255, 255, 0.9) !important;
      margin: 0 10px;
      position: relative;
    }

    .navbar.scrolled .nav-link {
      color: var(--text-primary) !important;
    }

    .nav-link::after {
      content: '';
      position: absolute;
      width: 0;
      height: 2px;
      bottom: -5px;
      left: 0;
      background: #fff;
      transition: width 0.3s;
    }

    .navbar.scrolled .nav-link::after {
      background: #764ba2;
    }

    .nav-link:hover::after {
      width: 100%;
    }

    .btn-custom {
      padding: 10px 25px;
      border-radius: 50px;
      font-weight: 600;
      transition: all 0.3s;
    }

    .btn-primary-gradient {
      background: var(--primary-gradient);
      border: none;
      color: white;
      box-shadow: 0 5px 15px rgba(118, 75, 162, 0.4);
    }

    .btn-primary-gradient:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(118, 75, 162, 0.6);
      color: white;
    }

    /* Hero Section for Page Title */
    .page-header {
      position: relative;
      height: 450px;
      /* Increased height */
      display: flex;
      align-items: center;
      background: url('{{ asset('assets/img/newspaperprofile.jpg') }}') no-repeat center center;
      background-size: cover;
      color: white;
      margin-top: -85px;
      /* Pull up behind navbar */
      padding-top: 85px;
      /* Push content down to avoid navbar overlap */
    }

    .page-header-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, rgba(102, 126, 234, 0.9) 0%, rgba(118, 75, 162, 0.9) 100%);
      z-index: 1;
    }

    .page-header-content {
      position: relative;
      z-index: 2;
      width: 100%;
      text-align: center;
    }

    /* Form Card Styling */
    .main-content {
      margin-top: -60px;
      /* Reduced negative margin to move card down */
      position: relative;
      z-index: 3;
      padding-bottom: 50px;
    }

    .modern-form-card {
      background: white;
      border-radius: 20px;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
      border: none;
      overflow: hidden;
    }

    .form-header-gradient {
      background: var(--primary-gradient);
      padding: 2rem;
      color: white;
      border: none;
    }

    .form-body-padding {
      padding: 3rem;
    }

    .form-control {
      border-radius: 10px;
      padding: 12px 15px;
      border: 1px solid #e2e8f0;
      transition: all 0.3s;
    }

    .form-control:focus {
      box-shadow: 0 0 0 3px rgba(118, 75, 162, 0.2);
      border-color: #764ba2;
    }

    .form-group-modern {
      margin-bottom: 1.5rem;
    }

    .form-control-label {
      font-weight: 600;
      font-size: 0.875rem;
      margin-bottom: 0.5rem;
      color: var(--text-primary);
      display: block;
    }

    .input-group-text {
      background-color: #f8f9fa;
      border: 1px solid #e2e8f0;
      border-radius: 10px 0 0 10px;
      color: #764ba2;
    }

    .input-group .form-control {
      border-top-left-radius: 0;
      border-bottom-left-radius: 0;
    }

    .form-section-header {
      color: #764ba2;
      font-weight: 700;
      margin-bottom: 1.5rem;
      padding-bottom: 0.5rem;
      border-bottom: 2px solid rgba(118, 75, 162, 0.1);
    }

    .btn-gradient-cyan {
      background: var(--primary-gradient);
      border: none;
      border-radius: 50px;
      padding: 10px 24px;
      font-weight: 600;
      letter-spacing: 0.5px;
      transition: all 0.3s;
      color: white;
      font-size: 1rem;
    }

    .btn-gradient-cyan:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(118, 75, 162, 0.4);
      color: white;
    }

    .footer {
      background: #1a202c;
      color: white;
      padding: 80px 0 30px;
      margin-top: 80px;
    }

    .footer-logo {
      font-size: 1.5rem;
      font-weight: 700;
      margin-bottom: 1.5rem;
      background: var(--primary-gradient);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .social-link {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      margin-right: 10px;
      transition: all 0.3s;
      text-decoration: none;
    }

    .social-link:hover {
      background: #764ba2;
      color: white;
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">PT. Super Permata Kitchen</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto align-items-center">
          <li class="nav-item">
            <a class="nav-link" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/#profile">About</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
              Career
            </a>
            <ul class="dropdown-menu border-0 shadow-lg">
              <li><a class="dropdown-item" href="{{ route('jobindex') }}">Job Listings</a></li>
            </ul>
          </li>
          <li class="nav-item ms-lg-3">
            <a class="btn btn-custom btn-primary-gradient px-4" href="{{ route('dashboard') }}">
              Login <i class="fas fa-arrow-right ms-2"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Header (Restored) -->
  <header class="page-header">
    <div class="page-header-overlay"></div>
    <div class="page-header-content container">
      <h1 class="display-4 fw-bold mb-2">Karir Bersama Kami</h1>
      <p class="lead opacity-75">Bergabunglah dan tumbuh bersama PT Super Permata Kitchen</p>
    </div>
  </header>

  <!-- Main Form Content -->
  <div class="container main-content">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="card modern-form-card">
          <div class="card-header form-header-gradient text-center">
            <h3 class="fw-bold mb-1 text-white">Form Lamaran Pekerjaan</h3>
            <p class="mb-0 text-white-50">Posisi: <strong>{{ $lowongan->lowongan }}</strong></p>
          </div>
          <div class="card-body form-body-padding">
            @if (session()->has('message'))
              <script>
                document.addEventListener('DOMContentLoaded', function() {
                  Swal.fire({
                    title: 'Berhasil!',
                    text: "{{ session('message') }}",
                    icon: 'success',
                    confirmButtonText: 'OK'
                  });
                });
              </script>
            @endif

            <form action="{{ route('daftar-lamaran.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="lowongan_id" value="{{ $lowongan->id }}" required>

              <div class="row">
                <!-- Left Column -->
                <div class="col-md-6">
                  <h5 class="form-section-header">Identitas Diri</h5>

                  <!-- Name -->
                  <div class="form-group-modern">
                    <label for="name" class="form-control-label">Nama Lengkap</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-user"></i></span>
                      <input type="text" class="form-control" id="name" name="name"
                        value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required>
                    </div>
                    @if ($errors->has('name'))
                      <small class="text-danger mt-1">{{ $errors->first('name') }}</small>
                    @endif
                  </div>
                  
                  <!-- NIK -->
                  <div class="form-group-modern">
                    <label for="nik" class="form-control-label">NIK (Nomor Induk Kependudukan)</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                      <input type="number" class="form-control" id="nik" name="nik"
                        value="{{ old('nik') }}" placeholder="Masukkan 16 digit NIK" required>
                    </div>
                    @if ($errors->has('nik'))
                      <small class="text-danger mt-1">{{ $errors->first('nik') }}</small>
                    @endif
                  </div>

                  <!-- Email -->
                  <div class="form-group-modern">
                    <label for="email" class="form-control-label">Email</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                      <input type="email" class="form-control" id="email" name="email"
                        value="{{ old('email') }}" placeholder="contoh@email.com" required>
                    </div>
                    @if ($errors->has('email'))
                      <small class="text-danger mt-1">{{ $errors->first('email') }}</small>
                    @endif
                  </div>

                  <!-- Phone -->
                  <div class="form-group-modern">
                    <label for="phone" class="form-control-label">Nomor Telepon</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                      <input type="text" class="form-control" id="phone" name="phone"
                        value="{{ old('phone') }}" placeholder="08xxxxxxxxxx">
                    </div>
                    @if ($errors->has('phone'))
                      <small class="text-danger mt-1">{{ $errors->first('phone') }}</small>
                    @endif
                  </div>

                  <!-- Gender -->
                  <div class="form-group-modern">
                    <label for="gender" class="form-control-label">Jenis Kelamin</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                      <select name="gender" id="gender" class="form-control" required>
                        <option value="">-- Pilih Gender --</option>
                        <option value="Lk" {{ old('gender') == 'Lk' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Pr" {{ old('gender') == 'Pr' ? 'selected' : '' }}>Perempuan</option>
                      </select>
                    </div>
                    @if ($errors->has('gender'))
                      <small class="text-danger mt-1">{{ $errors->first('gender') }}</small>
                    @endif
                  </div>

                  <!-- Place of Birth -->
                  <div class="form-group-modern">
                    <label for="birth_place" class="form-control-label">Tempat Lahir</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                      <input type="text" class="form-control" id="birth_place" name="birth_place"
                        value="{{ old('birth_place') }}" placeholder="Kota Kelahiran">
                    </div>
                    @if ($errors->has('birth_place'))
                      <small class="text-danger mt-1">{{ $errors->first('birth_place') }}</small>
                    @endif
                  </div>

                  <!-- Date of Birth -->
                  <div class="form-group-modern">
                    <label for="birth_date" class="form-control-label">Tanggal Lahir</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                      <input type="date" class="form-control" id="birth_date" name="birth_date"
                        value="{{ old('birth_date') }}" max="{{ date('Y-m-d') }}">
                    </div>
                    @if ($errors->has('birth_date'))
                      <small class="text-danger mt-1">{{ $errors->first('birth_date') }}</small>
                    @endif
                  </div>
                </div>

                <!-- Right Column -->
                <div class="col-md-6">
                  <h5 class="form-section-header mt-4 mt-md-0">Data Tambahan</h5>

                  <!-- Agama -->
                  <div class="form-group-modern">
                    <label for="agama" class="form-control-label">Agama</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-pray"></i></span>
                      <input type="text" class="form-control" id="agama" name="agama"
                        value="{{ old('agama') }}" required placeholder="Agama">
                    </div>
                    @if ($errors->has('agama'))
                      <small class="text-danger mt-1">{{ $errors->first('agama') }}</small>
                    @endif
                  </div>

                  <!-- Pendidikan -->
                  <div class="form-group-modern">
                    <label for="pendidikan" class="form-control-label">Pendidikan Terakhir</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                      <input type="text" class="form-control" id="pendidikan" name="pendidikan"
                        value="{{ old('pendidikan') }}" placeholder="Contoh: S1 Teknik Informatika">
                    </div>
                    @if ($errors->has('pendidikan'))
                      <small class="text-danger mt-1">{{ $errors->first('pendidikan') }}</small>
                    @endif
                  </div>

                  <!-- Address -->
                  <div class="form-group-modern">
                    <label for="address" class="form-control-label">Alamat Domisili</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-home"></i></span>
                      <textarea class="form-control" id="address" name="address" rows="3" placeholder="Alamat lengkap...">{{ old('address') }}</textarea>
                    </div>
                    @if ($errors->has('address'))
                      <small class="text-danger mt-1">{{ $errors->first('address') }}</small>
                    @endif
                  </div>

                  <div class="alert alert-info border-0 shadow-sm mt-4">
                    <h6 class="alert-heading fw-bold mb-1"><i class="fas fa-file-upload me-2"></i>Berkas Lamaran</h6>
                    <small>Pastikan dokumen yang diunggah jelas dan sesuai persyaratan.</small>
                  </div>

                  <!-- Image Upload -->
                  <div class="form-group-modern">
                    <label for="image" class="form-control-label">Pas Foto</label>
                    <input type="file" class="form-control" id="image" name="image" required>
                    <small class="text-muted fst-italic">Format: JPG/PNG/JPEG</small>
                    @if ($errors->has('image'))
                      <div class="text-danger small mt-1">{{ $errors->first('image') }}</div>
                    @endif
                  </div>

                  <!-- KTP Upload -->
                  <div class="form-group-modern">
                    <label for="document_ktp" class="form-control-label">KTP (Kartu Tanda Penduduk)</label>
                    <input type="file" class="form-control" id="document_ktp" name="document_ktp" accept=".jpg,.jpeg,.png,.pdf" required>
                    <small class="text-muted fst-italic">Format: JPG/PNG/PDF. Max size 2MB.</small>
                    @if ($errors->has('document_ktp'))
                      <div class="text-danger small mt-1">{{ $errors->first('document_ktp') }}</div>
                    @endif
                  </div>

                  <!-- CV Upload -->
                  <div class="form-group-modern">
                    <label for="document_cv" class="form-control-label">Curriculum Vitae (CV)</label>
                    <input type="file" class="form-control" id="document_cv" name="document_cv" accept=".pdf" required>
                    <small class="text-muted fst-italic">Format: PDF only. Max size 2MB.</small>
                    @if ($errors->has('document_cv'))
                      <div class="text-danger small mt-1">{{ $errors->first('document_cv') }}</div>
                    @endif
                  </div>

                  <input type="hidden" name="status" value="1">

                </div>
              </div>

              <div class="text-end mt-4 pt-3 border-top">
                <a href="{{ route('jobindex') }}" class="btn btn-secondary rounded-pill px-4 me-2">Batal</a>
                <button type="submit" class="btn btn-gradient-cyan px-4 shadow-sm">
                  <i class="fas fa-paper-plane me-2"></i> Kirim Lamaran
                </button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-4">
          <h5 class="footer-logo">PT. Super Permata Kitchen</h5>
          <p class="text-secondary">perusahaan ritel yang bergerak di bidang peralatan dapur dan perlengkapan rumah
            tangga, melayani kebutuhan rumah tangga dengan berbagai produk berkualitas untuk pasar lokal Palembang.</p>
          <div class="d-flex mt-4">
            <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
            <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
            <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
          </div>
        </div>
        <div class="col-lg-2 offset-lg-1">
          <h6 class="text-white mb-3">Company</h6>
          <ul class="list-unstyled text-secondary">
            <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">About Us</a></li>
            <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">Careers</a></li>
            <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">Press</a></li>
            <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">Contact</a></li>
          </ul>
        </div>
        <div class="col-lg-2">
          <h6 class="text-white mb-3">Resources</h6>
          <ul class="list-unstyled text-secondary">
            <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">News</a></li>
            <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">Partners</a></li>
            <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">Terms</a></li>
            <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">Privacy</a></li>
          </ul>
        </div>
        <div class="col-lg-3">
          <h6 class="text-white mb-3">Office</h6>
          <p class="text-secondary">Jl. Gubernur H. Bastari No. 25, Silaberanti, Jakabaring, Palembang.</p>
        </div>
      </div>
      <div class="border-top border-secondary mt-5 pt-4 text-center text-secondary">
        <p>&copy; 2025 PT. Super Permata Kitchen. All rights reserved.</p>
      </div>
    </div>
  </footer>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Navbar scroll effect
    window.addEventListener('scroll', function() {
      var navbar = document.querySelector('.navbar');
      if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
      } else {
        navbar.classList.remove('scrolled');
      }
    });
  </script>
<style>
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>
</body>

</html>
