<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Job Listings - PT Super Permata Kitchen</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />

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

    /* Navbar toggler for mobile */
    .navbar-toggler {
      border-color: rgba(255, 255, 255, 0.5);
    }

    .navbar-toggler-icon {
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 0.9)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }

    .navbar.scrolled .navbar-toggler {
      border-color: rgba(0, 0, 0, 0.1);
    }

    .navbar.scrolled .navbar-toggler-icon {
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(0, 0, 0, 0.7)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }

    /* Hero Section Update */
    .hero-section {
      position: relative;
      padding: 160px 0 100px;
      background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.7)), url('{{ asset('assets/img/background-home.jpg') }}') no-repeat center center;
      background-size: cover;
      color: white;
      text-align: center;
      margin-top: -85px;
      margin-bottom: 50px;
    }

    .hero-title {
      font-size: 3.5rem;
      font-weight: 800;
      margin-bottom: 1.5rem;
      background: linear-gradient(to right, #fff, #e2e8f0);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    /* Job Cards */
    .job-card {
      background: white;
      border-radius: 20px;
      padding: 2rem;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
      transition: all 0.3s ease;
      border: 1px solid rgba(0, 0, 0, 0.05);
      height: 100%;
      position: relative;
      overflow: hidden;
      display: flex;
      flex-direction: column;
    }

    .job-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 20px 40px rgba(118, 75, 162, 0.15);
      border-color: rgba(118, 75, 162, 0.2);
    }

    .job-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 5px;
      background: var(--primary-gradient);
      transform: scaleX(0);
      transform-origin: left;
      transition: transform 0.3s ease;
    }

    .job-card:hover::before {
      transform: scaleX(1);
    }

    .job-icon {
      width: 60px;
      height: 60px;
      border-radius: 15px;
      background: rgba(118, 75, 162, 0.1);
      color: #764ba2;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      margin-bottom: 1.5rem;
    }

    .job-title {
      font-weight: 700;
      font-size: 1.25rem;
      margin-bottom: 0.5rem;
      color: var(--text-primary);
    }

    .job-meta {
      display: flex;
      gap: 15px;
      margin-bottom: 1.5rem;
      font-size: 0.9rem;
      color: var(--text-secondary);
    }

    .job-meta i {
      color: #764ba2;
      margin-right: 5px;
    }

    .job-description {
      color: var(--text-secondary);
      margin-bottom: 1.5rem;
      flex-grow: 1;
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .badge-custom {
      padding: 8px 15px;
      border-radius: 30px;
      font-weight: 600;
      font-size: 0.8rem;
    }

    .badge-soft-primary {
      background: rgba(102, 126, 234, 0.1);
      color: #667eea;
    }

    /* Modal Styles */
    .modal-content {
      border: none;
      border-radius: 20px;
      overflow: hidden;
    }

    .modal-header {
      background: var(--primary-gradient);
      color: white;
      border: none;
      padding: 1.5rem 2rem;
    }

    .modal-header .close {
      color: white;
      opacity: 0.8;
      text-shadow: none;
    }

    .modal-header .close:hover {
      opacity: 1;
    }

    .modal-body {
      padding: 2rem;
    }

    .modal-footer {
      border: none;
      padding: 1.5rem 2rem;
      background: #f8fafc;
    }

    /* Footer */
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
      <a class="navbar-brand" href="{{ route('welcome') }}">PT. Super Permata Kitchen</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto align-items-center">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('welcome') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('welcome') }}#profile">About</a>
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

  <!-- Hero Section -->
  <header class="hero-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <h1 class="hero-title">Join Our World Class Team</h1>
          <p class="lead mb-4" style="opacity: 0.9;">Discover opportunities to grow, learn, and make an impact with PT
            Super Permata Kitchen.</p>
        </div>
      </div>
    </div>
  </header>

  <!-- Job Listing Section -->
  <div class="container pb-5">
    <div class="row g-4">
      @forelse ($lowongans as $lowongan)
        <div class="col-lg-4 col-md-6">
          <div class="job-card">
            <div class="d-flex justify-content-between align-items-start mb-3">
              <div class="job-icon">
                <i class="fas fa-briefcase"></i>
              </div>
              <span class="badge badge-custom badge-soft-primary">Full Time</span>
            </div>

            <h3 class="job-title">{{ $lowongan->lowongan }}</h3>

            <div class="job-meta">
              <span><i class="fas fa-user-tie"></i> {{ $lowongan->lowongan_jabatan }}</span>
            </div>

            <div class="job-description">
              {{ $lowongan->deskripsi_lowongan }}
            </div>

            <div class="d-flex gap-2 mt-auto">
              <!-- Using both data-toggle (BS4) and data-bs-toggle (BS5) for compatibility if both libs are loaded -->
              <button type="button" class="btn btn-outline-secondary btn-custom flex-grow-1" data-bs-toggle="modal"
                data-bs-target="#viewModal-{{ $lowongan->id }}">View Details</button>
              <a href="{{ route('tambah-lamaran', ['lowongan_id' => $lowongan->id]) }}"
                class="btn btn-primary-gradient btn-custom flex-grow-1 text-center">Apply Now</a>
            </div>
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="viewModal-{{ $lowongan->id }}" tabindex="-1" role="dialog"
          aria-labelledby="viewModalLabel-{{ $lowongan->id }}" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel-{{ $lowongan->id }}">Detail Lowongan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                  aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="mb-4">
                  <h4 class="fw-bold mb-3" style="color: #4a5568;">{{ $lowongan->lowongan }}</h4>
                  <div class="d-flex gap-3 text-muted mb-3">
                    <span><i class="fas fa-user-tie text-primary me-2"></i> {{ $lowongan->lowongan_jabatan }}</span>
                    <span><i class="fas fa-clock text-primary me-2"></i> Full Time</span>
                  </div>
                </div>

                <div class="mb-4">
                  <h6 class="fw-bold text-uppercase text-secondary small mb-3">Persyaratan</h6>
                  <div class="p-3 bg-light rounded-3 border" style="white-space: pre-line;">{{ $lowongan->persyaratan }}</div>
                </div>

                <div class="mb-4">
                  <h6 class="fw-bold text-uppercase text-secondary small mb-3">Deskripsi Pekerjaan</h6>
                  <div class="p-3 bg-light rounded-3 border">
                    <p class="text-secondary text-justify mb-0" style="white-space: pre-line;">{{ $lowongan->deskripsi_lowongan }}</p>
                  </div>
                </div>
              </div>
              <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary btn-custom" data-bs-dismiss="modal">Close</button>
                <a href="{{ route('tambah-lamaran', ['lowongan_id' => $lowongan->id]) }}"
                  class="btn btn-primary-gradient btn-custom">Apply Now</a>
              </div>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12">
          <div class="text-center py-5">
            <div class="mb-4">
              <i class="fas fa-briefcase fa-4x text-muted" style="opacity: 0.3;"></i>
            </div>
            <h3 class="fw-bold text-secondary">No Open Positions</h3>
            <p class="text-muted">We don't have any open positions right now. Please check back later.</p>
          </div>
        </div>
      @endforelse
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
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    window.addEventListener('scroll', function() {
      var navbar = document.querySelector('.navbar');
      if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
      } else {
        navbar.classList.remove('scrolled');
      }
    });
  </script>
</body>

</html>
