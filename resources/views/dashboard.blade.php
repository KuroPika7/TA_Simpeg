@extends('layouts.user_type.auth')

@section('content')
  <style>
    body {
      background: #f0f2f5;
    }

    .dashboard-modern {
      animation: fadeIn 0.6s ease-out;
      max-width: 100%;
      overflow-x: hidden;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .welcome-header {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border-radius: 16px;
      padding: 2rem;
      color: white;
      margin-bottom: 2rem;
      box-shadow: 0 4px 20px rgba(102, 126, 234, 0.3);
    }

    .welcome-header h2 {
      font-size: 1.75rem;
      font-weight: 700;
      margin-bottom: 0.5rem;
    }

    .welcome-header p {
      opacity: 0.9;
      margin: 0;
    }

    .stat-card-compact {
      background: white;
      border-radius: 12px;
      padding: 1.25rem;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .stat-card-compact:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
    }

    .stat-icon {
      width: 56px;
      height: 56px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      flex-shrink: 0;
    }

    .stat-icon.purple {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
    }

    .stat-icon.teal {
      background: linear-gradient(135deg, #0d9488 0%, #2563eb 100%);
      color: white;
    }

    .stat-icon.orange {
      background: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%);
      color: white;
    }

    .stat-icon.pink {
      background: linear-gradient(135deg, #ec4899 0%, #8b5cf6 100%);
      color: white;
    }

    .stat-info {
      flex: 1;
    }

    .stat-label-compact {
      font-size: 0.75rem;
      font-weight: 600;
      color: #6c757d;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 0.25rem;
    }

    .stat-value-compact {
      font-size: 1.5rem;
      font-weight: 700;
      color: #212529;
      margin-bottom: 0.25rem;
    }

    .stat-change-compact {
      font-size: 0.75rem;
      font-weight: 600;
    }

    .stat-change-compact.positive {
      color: #28a745;
    }

    .stat-change-compact.negative {
      color: #dc3545;
    }

    .info-card {
      background: white;
      border-radius: 12px;
      padding: 1.5rem;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
      height: 100%;
    }

    .info-card-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1.5rem;
    }

    .info-card-title {
      font-size: 1.125rem;
      font-weight: 700;
      color: #212529;
    }

    .info-card-content {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .info-card-content p {
      color: #6c757d;
      line-height: 1.6;
      margin: 0;
    }

    .info-card-link {
      color: #667eea;
      font-weight: 600;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      transition: all 0.3s ease;
    }

    .info-card-link:hover {
      color: #764ba2;
      gap: 0.75rem;
    }

    .info-illustration {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border-radius: 12px;
      padding: 2rem;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 200px;
    }

    .info-illustration img {
      max-width: 100%;
      height: auto;
    }

    @media (max-width: 991.98px) {
      .dashboard-modern {
        padding: 0 0.5rem;
      }

      .welcome-header {
        padding: 1.5rem;
        margin-bottom: 1.5rem;
      }

      .welcome-header h2 {
        font-size: 1.5rem;
      }

      .stat-card-compact {
        padding: 1rem;
      }

      .stat-icon {
        width: 48px;
        height: 48px;
        font-size: 1.25rem;
      }

      .stat-value-compact {
        font-size: 1.25rem;
      }

      .info-card {
        padding: 1.25rem;
      }

      .info-card-title {
        font-size: 1rem;
      }

      .row {
        margin-left: 0;
        margin-right: 0;
      }

      .row>* {
        padding-left: 0.5rem;
        padding-right: 0.5rem;
      }
    }

    @media (max-width: 575.98px) {
      .welcome-header {
        padding: 1.25rem;
        margin-bottom: 1rem;
      }

      .welcome-header h2 {
        font-size: 1.25rem;
      }

      .welcome-header p {
        font-size: 0.875rem;
      }

      .stat-card-compact {
        padding: 0.875rem;
        gap: 0.75rem;
      }

      .stat-icon {
        width: 42px;
        height: 42px;
        font-size: 1.125rem;
      }

      .stat-value-compact {
        font-size: 1.125rem;
      }

      .stat-label-compact {
        font-size: 0.7rem;
      }

      .info-card {
        padding: 1rem;
      }

      .info-card-title {
        font-size: 0.9375rem;
      }

      .info-illustration {
        padding: 1.5rem;
        min-height: 150px;
      }
    }
  </style>

  <div class="dashboard-modern">
    @if (session('message'))
      <div class="alert alert-success text-white" id="flash-message" style="border-radius: 12px; margin-bottom: 1.5rem;">
        {{ session('message') }}
      </div>
    @endif

    <!-- Welcome Header -->
    <div class="welcome-header">
      <h2 class="text-white">Selamat Datang, {{ Auth::user()->karyawan->name ?? Auth::user()->name }} 👋</h2>
      <p>Kelola sistem kepegawaian dengan mudah dan efisien</p>
    </div>

    @can('level4')
      <!-- Compact Stats Row -->
      <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
          <div class="stat-card-compact">
            <div class="stat-icon purple">
              <i class="ni ni-email-83"></i>
            </div>
            <div class="stat-info">
              <div class="stat-label-compact">Lamaran Masuk</div>
              <div class="stat-value-compact">{{ $totallamaran }}</div>
              <div class="stat-change-compact positive">Karyawan</div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="stat-card-compact">
            <div class="stat-icon teal">
              <i class="ni ni-single-02"></i>
            </div>
            <div class="stat-info">
              <div class="stat-label-compact">Pengajuan Cuti</div>
              <div class="stat-value-compact">{{ $totalCuti }}</div>
              <div class="stat-change-compact positive">Karyawan</div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="stat-card-compact">
            <div class="stat-icon orange">
              <i class="ni ni-badge"></i>
            </div>
            <div class="stat-info">
              <div class="stat-label-compact">Jumlah Karyawan</div>
              <div class="stat-value-compact">{{ $totalkaryawan }}</div>
              <div class="stat-change-compact positive">Karyawan</div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="stat-card-compact">
            <div class="stat-icon pink">
              <i class="ni ni-chart-bar-32"></i>
            </div>
            <div class="stat-info">
              <div class="stat-label-compact">Absensi Hari Ini</div>
              <div class="stat-value-compact">{{ $totalpresensi }}</div>
              <div class="stat-change-compact positive">Karyawan</div>
            </div>
          </div>
        </div>
      </div>
    @endcan

    <!-- Info Card -->
    <div class="row g-4">
      <div class="col-lg-12">
        <div class="info-card">
          <div class="row">
            <div class="col-lg-6">
              <div class="info-card-content">
                <h5 class="info-card-title">Sistem Informasi Kepegawaian</h5>
                <p class="mb-3">Selamat datang di aplikasi Sistem Informasi Kepegawaian PT. Super Permata Kitchen.
                  Dengan fitur-fitur yang lengkap dari manajemen kepegawaian, Anda dapat mengelola data karyawan dengan
                  mudah dan efisien.</p>
                <p class="mb-4">Aplikasi ini dirancang untuk membantu dalam mengelola berbagai aspek kepegawaian
                  seperti data karyawan, absensi, cuti, promosi, demosi, dan berbagai kebutuhan administratif lainnya.
                </p>
              </div>
            </div>
            <div class="col-lg-6 mt-4 mt-lg-0">
              <div class="info-illustration">
                <img src="../assets/img/illustrations/rocket-white.png" alt="illustration" style="max-height: 200px;">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', (event) => {
      const flashMessage = document.getElementById('flash-message');
      if (flashMessage) {
        setTimeout(() => {
          flashMessage.style.transition = 'opacity 0.5s ease';
          flashMessage.style.opacity = '0';
          setTimeout(() => {
            flashMessage.remove();
          }, 500);
        }, 3000);
      }
    });
  </script>
@endsection
