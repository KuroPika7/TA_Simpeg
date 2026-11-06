<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PT Super Permata Kitchen</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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

    /* Hero Section */
    .hero {
      position: relative;
      height: 100vh;
      display: flex;
      align-items: center;
      background: url('{{ asset('assets/img/background-home.jpg') }}') no-repeat center center;
      background-size: cover;
      color: white;
      margin-top: -85px;
      /* Offset for absolute navbar */
    }

    .hero-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, rgba(102, 126, 234, 0.9) 0%, rgba(118, 75, 162, 0.9) 100%);
      z-index: 1;
    }

    .hero-content {
      position: relative;
      z-index: 2;
    }

    .hero h1 {
      font-size: 3.5rem;
      font-weight: 800;
      line-height: 1.2;
      margin-bottom: 1.5rem;
    }

    .hero p {
      font-size: 1.25rem;
      opacity: 0.9;
      margin-bottom: 2rem;
      font-weight: 300;
    }

    /* Cards & Sections */
    .section-title {
      font-weight: 800;
      margin-bottom: 1rem;
      background: var(--primary-gradient);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      display: inline-block;
    }

    .section-padding {
      padding: 100px 0;
    }

    .feature-card {
      background: white;
      border-radius: 20px;
      padding: 3rem;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
      transition: transform 0.3s;
      height: 100%;
      border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .feature-card:hover {
      transform: translateY(-10px);
    }

    .feature-icon {
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

    .mission-item {
      display: flex;
      align-items: flex-start;
      margin-bottom: 1.5rem;
    }

    .mission-item i {
      color: #4fd1c5;
      margin-right: 15px;
      margin-top: 5px;
    }

    .org-image-container {
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s;
    }

    .org-image-container:hover {
      transform: scale(1.02);
    }

    /* Footer */
    .footer {
      background: #1a202c;
      color: white;
      padding: 80px 0 30px;
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
            <a class="nav-link" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#profile">About</a>
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
  <header class="hero">
    <div class="hero-overlay"></div>
    <div class="container hero-content">
      <div class="row align-items-center">
        <div class="col-lg-8">
          <h1>Leading the Future of <br>Home & Kitchen in Sumatera</h1>
          <p>PT Super Permata Kitchen, perusahaan ritel yang bergerak di bidang
            peralatan dapur dan perlengkapan rumah tangga, melayani kebutuhan rumah tangga dengan berbagai produk
            berkualitas untuk pasar lokal Palembang.</p>
          <div class="d-flex gap-3">
            <a href="#profile" class="btn btn-custom btn-light text-primary shadow-lg">Learn More</a>
            <a href="{{ route('jobindex') }}" class="btn btn-custom btn-outline-light">Join Our Team</a>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Profile Section -->
  <section id="profile" class="section-padding">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 mb-5 mb-lg-0">
          <div class="org-image-container">
            <img src="{{ asset('assets/img/logo-ct1.png') }}" alt="Office Building" class="img-fluid w-100">
          </div>
        </div>
        <div class="col-lg-6 ps-lg-5">
          <h5 class="text-uppercase text-secondary letter-spacing-2 mb-2">Who We Are</h5>
          <h2 class="section-title">Profil Perusahaan</h2>
          <p class="text-muted mb-4 lead">PT Super Permata Kitchen Palembang adalah perusahaan ritel yang bergerak di
            bidang
            peralatan dapur dan perlengkapan rumah tangga, melayani kebutuhan rumah tangga dengan berbagai produk
            berkualitas untuk pasar lokal Palembang.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Vision & Mission -->
  <section class="section-padding bg-light">
    <div class="container">
      <div class="row g-4">
        <div class="col-lg-5">
          <div class="feature-card">
            <div class="feature-icon">
              <i class="fas fa-eye"></i>
            </div>
            <h3 class="mb-4">Visi Kami</h3>
            <p class="lead mb-4">Menjadi perusahaan terdepan dalam memberikan solusi bagi masyarakat dalam memenuhi
              kebutuhan rumah tangga yang berkualitas dan inovatif.</p>
            <p class="text-muted">Kami bertekad untuk menjadi pilar demokrasi yang kokoh, menyajikan informasi yang
              objektif, dan menjadi referensi utama bagi masyarakat Sumatera Selatan.</p>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="feature-card">
            <div class="feature-icon">
              <i class="fas fa-bullseye"></i>
            </div>
            <h3 class="mb-4">Misi Kami</h3>
            <div class="row">
              <div class="col-md-6">
                <div class="mission-item">
                  <i class="fas fa-check-circle"></i>
                  <p class="mb-0">Menjadi perusahaan yang terpercaya, tangguh dan mampu bersaing di bidang
                    perdagangan perlengkapan dan perabotan rumah tangga.</p>
                </div>
                <div class="mission-item">
                  <i class="fas fa-check-circle"></i>
                  <p class="mb-0">Menghadirkan produk yang berkualitas tinggi, terlengkap dan terkini dengan
                    memperhatikan kebutuhan pasar.</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mission-item">
                  <i class="fas fa-check-circle"></i>
                  <p class="mb-0">Mengutamakan kepuasan pelanggan melalui layanan yang profesional.</p>
                </div>
                <div class="mission-item">
                  <i class="fas fa-check-circle"></i>
                  <p class="mb-0">Menciptakan kondisi lapangan kerja yang mengedepankan tenaga kerja yang
                    cakap dan handal sesuai bidang usaha yang kami jalani.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Structure -->
  <section class="section-padding">
    <div class="container text-center">
      <span class="text-uppercase text-secondary letter-spacing-2">Organization</span>
      <h2 class="section-title d-block mb-5">Struktur Organisasi</h2>

      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="org-image-container bg-white p-3">
            <img src="{{ asset('assets/img/struktur-perusahaan.jpeg') }}" alt="Organization Structure"
              class="img-fluid rounded">
          </div>
          <p class="mt-3 text-muted">Sumber: PT. Super Permata Kitchen</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-4">
          <h5 class="footer-logo">PT. Super Permata Kitchen</h5>
          <p class="text-secondary">perusahaan yang bergerak di bidang peralatan dapur dan perlengkapan rumah
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
</body>

</html>
