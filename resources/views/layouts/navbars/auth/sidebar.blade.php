<style>
  .sidenav {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
  }

  .sidenav .navbar-brand-img {
    max-height: 2.5rem;
  }

  .sidenav .navbar-brand {
    padding: 1.5rem 1rem;
  }

  .sidenav .navbar-brand span {
    font-size: 0.875rem;
    line-height: 1.3;
    color: white !important;
  }

  .sidenav hr {
    background: rgba(255, 255, 255, 0.2) !important;
  }

  .sidenav .nav-link {
    color: rgba(255, 255, 255, 0.8) !important;
    padding: 0.65rem 2.5rem 0.65rem 1rem;
    margin: 0 0.5rem 0 0.5rem;
    border-radius: 8px;
    transition: all 0.3s ease;
    position: relative;
    display: block;
  }

  .sidenav .nav-link:hover {
    background: rgba(255, 255, 255, 0.1);
    color: white !important;
  }

  .sidenav .nav-link.active {
    background: rgba(13, 202, 240, 0.2);
    color: #0dcaf0 !important;
    box-shadow: 0 4px 12px rgba(13, 202, 240, 0.3);
  }

  .sidenav .nav-link.active .nav-link-text {
    color: #0dcaf0 !important;
    font-weight: 700;
  }

  .sidenav .icon {
    background: rgba(255, 255, 255, 0.15) !important;
    width: 32px;
    height: 32px;
    min-width: 32px;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
  }

  .sidenav .icon i {
    color: white !important;
    font-size: 0.875rem;
    line-height: 1;
    display: inline-block !important;
    font-style: normal !important;
    font-variant: normal !important;
    text-rendering: auto !important;
    -webkit-font-smoothing: antialiased !important;
  }

  .sidenav .icon i::before {
    font-family: "Font Awesome 5 Free" !important;
    font-weight: 900 !important;
    display: inline-block !important;
  }

  .sidenav .nav-link.active .icon {
    background: #0dcaf0 !important;
  }

  .sidenav .nav-link.active .icon i {
    color: white !important;
  }

  .sidenav h6 {
    color: rgba(255, 255, 255, 0.6) !important;
    font-size: 0.65rem;
    margin-top: 1rem;
    margin-bottom: 0.5rem;
  }

  .sidenav .nav {
    list-style: none !important;
  }

  .sidenav .nav .nav-link {
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
  }

  .sidenav ul,
  .sidenav ul li {
    list-style: none !important;
    list-style-type: none !important;
  }

  .sidenav ul li::marker {
    display: none !important;
    content: none !important;
  }

  .sidenav .collapse ul,
  .sidenav .collapse ul li {
    list-style: none !important;
    list-style-type: none !important;
  }

  #sidenav-collapse-main ul,
  #sidenav-collapse-main ul li {
    list-style: none !important;
    list-style-type: none !important;
  }

  .sidenav .nav .nav-link.active {
    background: transparent;
    color: white !important;
  }

  .sidenav .nav .nav-link.active .nav-link-text {
    color: white !important;
    font-weight: 700;
  }

  .sidenav .nav .nav-link.active .icon {
    background: rgba(255, 255, 255, 0.25) !important;
  }

  .sidenav .nav .icon {
    width: 28px;
    height: 28px;
    min-width: 28px;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
  }

  .sidenav .nav .icon i {
    font-size: 0.75rem;
    line-height: 1;
    display: inline-block !important;
    font-style: normal !important;
    font-variant: normal !important;
    text-rendering: auto !important;
    -webkit-font-smoothing: antialiased !important;
  }

  .sidenav .nav .icon i::before {
    font-family: "Font Awesome 5 Free" !important;
    font-weight: 900 !important;
    display: inline-block !important;
  }

  .sidenav .nav-link[data-bs-toggle="collapse"]::after {
    content: "\f107";
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    position: absolute;
    right: 1.25rem;
    top: 50%;
    transform: translateY(-50%);
    transition: transform 0.3s ease;
    color: white !important;
  }

  .sidenav .nav-link[data-bs-toggle="collapse"][aria-expanded="true"]::after {
    transform: translateY(-50%) rotate(180deg);
    color: white;
  }

  #sidenav-collapse-main {
    overflow-y: auto;
    overflow-x: hidden;
    scrollbar-width: none;
    -ms-overflow-style: none;
  }

  #sidenav-collapse-main::-webkit-scrollbar {
    display: none;
  }
</style>

<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3"
  id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
      aria-hidden="true" id="iconSidenav"></i>
    <a class="align-items-center d-flex m-0 navbar-brand text-wrap" href="{{ route('dashboard') }}">
      <img src="{{ asset('assets/img/logo-ct1.png') }}" class="navbar-brand-img h-100" alt="...">
      <span class="ms-3 font-weight-bold">Sistem Informasi Kepegawaian PT. Super Permata Kitchen</span>
    </a>
  </div>
  <hr class="horizontal dark mt-0">
  <div class="w-auto overflow-auto" id="sidenav-collapse-main" style="max-height: calc(100vh - 150px);">
    <ul class="navbar-nav">
      <!-- Dashboard -->
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ url('dashboard') }}">
          <div
            class="icon icon-shape icon-sm shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-home"></i>
          </div>
          <span class="nav-link-text ms-1 text-light">Dashboard</span>
        </a>
      </li>

      @can('canManageKaryawan')
        <!-- Karyawan Management -->
        <li class="nav-item mt-2">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder">Karyawan Management</h6>
        </li>

        <!-- Karyawan -->
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#masterDataKaryawan" class="nav-link" aria-controls="masterDataKaryawan"
            role="button" aria-expanded="false">
            <div
              class="icon icon-shape icon-sm shadow border-radius-md text-center d-flex align-items-center justify-content-center me-2">
              <i class="fas fa-users"></i>
            </div>
            <span class="nav-link-text ms-1">Karyawan</span>
          </a>
          <div class="collapse" id="masterDataKaryawan">
            <ul class="nav ms-4 ps-3" style="list-style: none !important;">
              <li class="nav-item {{ Request::is('daftar-karyawan') ? 'active' : '' }}">
                <a class="nav-link {{ Request::is('daftar-karyawan') ? 'active' : '' }}"
                  href="{{ url('daftar-karyawan') }}">
                  <div
                    class="icon shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-list"></i>
                  </div>
                  <span class="nav-link-text ms-1">Daftar Karyawan</span>
                </a>
              </li>
              <li class="nav-item {{ Request::is('tambah-karyawan') ? 'active' : '' }}">
                <a class="nav-link {{ Request::is('tambah-karyawan') ? 'active' : '' }}"
                  href="{{ url('tambah-karyawan') }}">
                  <div
                    class="icon shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-user-plus"></i>
                  </div>
                  <span class="nav-link-text ms-1">Tambah Karyawan</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
      @endcan

      @can('canViewPresensi')
        <!-- Absensi -->
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#masterDataAbsensi" class="nav-link" aria-controls="masterDataAbsensi"
            role="button" aria-expanded="false">
            <div
              class="icon icon-shape icon-sm shadow border-radius-md text-center d-flex align-items-center justify-content-center me-2">
              <i class="fas fa-clipboard-check"></i>
            </div>
            <span class="nav-link-text ms-1">Presensi</span>
          </a>
          <div class="collapse" id="masterDataAbsensi">
            <ul class="nav ms-4 ps-3" style="list-style: none !important;">
              <li class="nav-item {{ Request::is('daftar-absensi') ? 'active' : '' }}">
                <a class="nav-link {{ Request::is('daftar-absensi') ? 'active' : '' }}"
                  href="{{ route('daftar-absensi') }}">
                  <div
                    class="icon shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-list"></i>
                  </div>
                  <span class="nav-link-text ms-1">Daftar Presensi</span>
                </a>
              </li>
              @can('canCreatePresensi')
                <li class="nav-item {{ Request::is('tambah-absen') ? 'active' : '' }}">
                  <a class="nav-link {{ Request::is('tambah-absen') ? 'active' : '' }}"
                    href="{{ route('tambah-absen.create') }}">
                    <div
                      class="icon shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                      <i class="fas fa-user-check"></i>
                    </div>
                    <span class="nav-link-text ms-1">Tambah Presensi</span>
                  </a>
                </li>
                <li class="nav-item {{ Request::is('tambah-izin') ? 'active' : '' }}">
                  <a class="nav-link {{ Request::is('tambah-izin') ? 'active' : '' }}" href="{{ url('tambah-izin') }}">
                    <div
                      class="icon shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                      <i class="fas fa-calendar-plus"></i>
                    </div>
                    <span class="nav-link-text ms-1">Tambah Izin</span>
                  </a>
                </li>
              @endcan
            </ul>
          </div>
        </li>
      @endcan

      @can('canManageLowongan')
        <!-- Rekrutment -->
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#masterDataRekrutment" class="nav-link" aria-controls="masterDataRekrutment"
            role="button" aria-expanded="false">
            <div
              class="icon icon-shape icon-sm shadow border-radius-md text-center d-flex align-items-center justify-content-center me-2">
              <i class="fas fa-user-tie"></i>
            </div>
            <span class="nav-link-text ms-1">Rekrutment</span>
          </a>
          <div class="collapse" id="masterDataRekrutment">
            <ul class="nav ms-4 ps-3" style="list-style: none !important;">
              <li class="nav-item {{ Request::is('daftar-lamaran') ? 'active' : '' }}">
                <a class="nav-link {{ Request::is('daftar-lamaran') ? 'active' : '' }}"
                  href="{{ url('daftar-lamaran') }}">
                  <div
                    class="icon shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-envelope"></i>
                  </div>
                  <span class="nav-link-text ms-1">Daftar Lamaran</span>
                </a>
              </li>
              <li class="nav-item {{ Request::is('daftar-lowongan') ? 'active' : '' }}">
                <a class="nav-link {{ Request::is('daftar-lowongan') ? 'active' : '' }}"
                  href="{{ url('daftar-lowongan') }}">
                  <div
                    class="icon shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-briefcase"></i>
                  </div>
                  <span class="nav-link-text ms-1">Daftar Lowongan</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
      @endcan

      @can('canViewPresensi')
        <!-- Cuti -->
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#masterDataCuti" class="nav-link" aria-controls="masterDataCuti"
            role="button" aria-expanded="false">
            <div
              class="icon icon-shape icon-sm shadow border-radius-md text-center d-flex align-items-center justify-content-center me-2">
              <i class="fas fa-umbrella-beach"></i>
            </div>
            <span class="nav-link-text ms-1">Cuti</span>
          </a>
          <div class="collapse" id="masterDataCuti">
            <ul class="nav ms-4 ps-3" style="list-style: none !important;">
              <li class="nav-item {{ Request::is('daftar-cuti') ? 'active' : '' }}">
                <a class="nav-link {{ Request::is('daftar-cuti') ? 'active' : '' }}" href="{{ url('daftar-cuti') }}">
                  <div
                    class="icon shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-list"></i>
                  </div>
                  <span class="nav-link-text ms-1">Daftar Cuti</span>
                </a>
              </li>
              @can('canCreateCuti')
                <li class="nav-item {{ Request::is('tambah-cuti') ? 'active' : '' }}">
                  <a class="nav-link {{ Request::is('tambah-cuti') ? 'active' : '' }}" href="{{ url('tambah-cuti') }}">
                    <div
                      class="icon shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                      <i class="fas fa-calendar-plus"></i>
                    </div>
                    <span class="nav-link-text ms-1">Tambah Cuti</span>
                  </a>
                </li>
              @endcan
            </ul>
          </div>
        </li>
      @endcan

      @can('canViewPenugasan')
        <!-- Penugasan -->
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#masterDataPenugasan" class="nav-link"
            aria-controls="masterDataPenugasan" role="button" aria-expanded="false">
            <div
              class="icon icon-shape icon-sm shadow border-radius-md text-center d-flex align-items-center justify-content-center me-2">
              <i class="fas fa-tasks"></i>
            </div>
            <span class="nav-link-text ms-1">Penugasan</span>
          </a>
          <div class="collapse" id="masterDataPenugasan">
            <ul class="nav ms-4 ps-3" style="list-style: none !important;">
              <li class="nav-item {{ Request::is('daftar-penugasan') ? 'active' : '' }}">
                <a class="nav-link {{ Request::is('daftar-penugasan') ? 'active' : '' }}"
                  href="{{ route('daftar-penugasan.index') }}">
                  <div
                    class="icon shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-list"></i>
                  </div>
                  <span class="nav-link-text ms-1">Daftar Penugasan</span>
                </a>
              </li>
              @can('canManagePenugasan')
                <li class="nav-item {{ Request::is('daftar-penugasan/create') ? 'active' : '' }}">
                  <a class="nav-link {{ Request::is('daftar-penugasan/create') ? 'active' : '' }}"
                    href="{{ route('daftar-penugasan.create') }}">
                    <div
                      class="icon shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                      <i class="fas fa-plus"></i>
                    </div>
                    <span class="nav-link-text ms-1">Buat Tugas</span>
                  </a>
                </li>
              @endcan
            </ul>
          </div>
        </li>
      @endcan

      @can('canViewSuratPeringatan')
        <!-- Surat Peringatan -->
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#masterDataSP" class="nav-link" aria-controls="masterDataSP"
            role="button" aria-expanded="false">
            <div
              class="icon icon-shape icon-sm shadow border-radius-md text-center d-flex align-items-center justify-content-center me-2">
              <i class="fas fa-exclamation-triangle"></i>
            </div>
            <span class="nav-link-text ms-1">Surat Peringatan</span>
          </a>
          <div class="collapse" id="masterDataSP">
            <ul class="nav ms-4 ps-3" style="list-style: none !important;">
              <li class="nav-item {{ Request::is('surat-peringatan') ? 'active' : '' }}">
                <a class="nav-link {{ Request::is('surat-peringatan') ? 'active' : '' }}"
                  href="{{ route('surat-peringatan.index') }}">
                  <div
                    class="icon shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-list"></i>
                  </div>
                  <span class="nav-link-text ms-1">Daftar SP</span>
                </a>
              </li>
              @can('canManageSuratPeringatan')
                <li class="nav-item {{ Request::is('surat-peringatan/create') ? 'active' : '' }}">
                  <a class="nav-link {{ Request::is('surat-peringatan/create') ? 'active' : '' }}"
                    href="{{ route('surat-peringatan.create') }}">
                    <div
                      class="icon shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                      <i class="fas fa-plus"></i>
                    </div>
                    <span class="nav-link-text ms-1">Tambah SP</span>
                  </a>
                </li>
              @endcan
            </ul>
          </div>
        </li>
      @endcan

      @can('canViewPHK')
        <!-- PHK -->
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#masterDataPHK" class="nav-link" aria-controls="masterDataPHK"
            role="button" aria-expanded="false">
            <div
              class="icon icon-shape icon-sm shadow border-radius-md text-center d-flex align-items-center justify-content-center me-2">
              <i class="fas fa-user-slash"></i>
            </div>
            <span class="nav-link-text ms-1">PHK</span>
          </a>
          <div class="collapse" id="masterDataPHK">
            <ul class="nav ms-4 ps-3" style="list-style: none !important;">
              <li class="nav-item {{ Request::is('daftar-phk') ? 'active' : '' }}">
                <a class="nav-link {{ Request::is('daftar-phk') ? 'active' : '' }}" href="{{ url('daftar-phk') }}">
                  <div
                    class="icon shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-list"></i>
                  </div>
                  <span class="nav-link-text ms-1">Daftar PHK</span>
                </a>
              </li>
              @can('canManagePHK')
                <li class="nav-item {{ Request::is('tambah-phk') ? 'active' : '' }}">
                  <a class="nav-link {{ Request::is('tambah-phk') ? 'active' : '' }}" href="{{ url('tambah-phk') }}">
                    <div
                      class="icon shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                      <i class="fas fa-user-minus"></i>
                    </div>
                    <span class="nav-link-text ms-1">Tambah PHK</span>
                  </a>
                </li>
              @endcan
            </ul>
          </div>
        </li>
      @endcan

      @can('canViewPromosi')
        <!-- Promosi -->
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#masterDataPromosi" class="nav-link" aria-controls="masterDataPromosi"
            role="button" aria-expanded="false">
            <div
              class="icon icon-shape icon-sm shadow border-radius-md text-center d-flex align-items-center justify-content-center me-2">
              <i class="fas fa-arrow-up"></i>
            </div>
            <span class="nav-link-text ms-1">Promosi</span>
          </a>
          <div class="collapse" id="masterDataPromosi">
            <ul class="nav ms-4 ps-3" style="list-style: none !important;">
              <li class="nav-item {{ Request::is('daftar-promosi') ? 'active' : '' }}">
                <a class="nav-link {{ Request::is('daftar-promosi') ? 'active' : '' }}"
                  href="{{ url('daftar-promosi') }}">
                  <div
                    class="icon shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-list"></i>
                  </div>
                  <span class="nav-link-text ms-1">Daftar Promosi</span>
                </a>
              </li>
              @can('canManagePromosi')
                <li class="nav-item {{ Request::is('tambah-promosi') ? 'active' : '' }}">
                  <a class="nav-link {{ Request::is('tambah-promosi') ? 'active' : '' }}"
                    href="{{ url('tambah-promosi') }}">
                    <div
                      class="icon shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                      <i class="fas fa-plus"></i>
                    </div>
                    <span class="nav-link-text ms-1">Tambah Promosi</span>
                  </a>
                </li>
              @endcan
            </ul>
          </div>
        </li>
      @endcan

      @can('canViewDemosi')
        <!-- Demosi -->
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#masterDataDemosi" class="nav-link" aria-controls="masterDataDemosi"
            role="button" aria-expanded="false">
            <div
              class="icon icon-shape icon-sm shadow border-radius-md text-center d-flex align-items-center justify-content-center me-2">
              <i class="fas fa-arrow-down"></i>
            </div>
            <span class="nav-link-text ms-1">Demosi</span>
          </a>
          <div class="collapse" id="masterDataDemosi">
            <ul class="nav ms-4 ps-3" style="list-style: none !important;">
              <li class="nav-item {{ Request::is('daftar-demosi') ? 'active' : '' }}">
                <a class="nav-link {{ Request::is('daftar-demosi') ? 'active' : '' }}"
                  href="{{ url('daftar-demosi') }}">
                  <div
                    class="icon shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-list"></i>
                  </div>
                  <span class="nav-link-text ms-1">Daftar Demosi</span>
                </a>
              </li>
              @can('canManageDemosi')
                <li class="nav-item {{ Request::is('tambah-demosi') ? 'active' : '' }}">
                  <a class="nav-link {{ Request::is('tambah-demosi') ? 'active' : '' }}"
                    href="{{ url('tambah-demosi') }}">
                    <div
                      class="icon shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                      <i class="fas fa-minus"></i>
                    </div>
                    <span class="nav-link-text ms-1">Tambah Demosi</span>
                  </a>
                </li>
              @endcan
            </ul>
          </div>
        </li>
      @endcan

      @can('canManageReward')
        <!-- Reward -->
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#masterDataReward" class="nav-link" aria-controls="masterDataReward"
            role="button" aria-expanded="false">
            <div
              class="icon icon-shape icon-sm shadow border-radius-md text-center d-flex align-items-center justify-content-center me-2">
              <i class="fas fa-award"></i>
            </div>
            <span class="nav-link-text ms-1">Reward</span>
          </a>
          <div class="collapse" id="masterDataReward">
            <ul class="nav ms-4 ps-3" style="list-style: none !important;">
              <li class="nav-item {{ Request::is('daftar-reward') ? 'active' : '' }}">
                <a class="nav-link {{ Request::is('daftar-reward') ? 'active' : '' }}"
                  href="{{ url('daftar-reward') }}">
                  <div
                    class="icon shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-list"></i>
                  </div>
                  <span class="nav-link-text ms-1">Daftar Reward</span>
                </a>
              </li>
              <li class="nav-item {{ Request::is('tambah-reward') ? 'active' : '' }}">
                <a class="nav-link {{ Request::is('tambah-reward') ? 'active' : '' }}"
                  href="{{ url('tambah-reward') }}">
                  <div
                    class="icon shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-plus-circle"></i>
                  </div>
                  <span class="nav-link-text ms-1">Tambah Reward</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
      @endcan

      @can('canManagePunishment')
        <!-- Punishment -->
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#masterDataPunishment" class="nav-link"
            aria-controls="masterDataPunishment" role="button" aria-expanded="false">
            <div
              class="icon icon-shape icon-sm shadow border-radius-md text-center d-flex align-items-center justify-content-center me-2">
              <i class="fas fa-gavel"></i>
            </div>
            <span class="nav-link-text ms-1">Punishment</span>
          </a>
          <div class="collapse" id="masterDataPunishment">
            <ul class="nav ms-4 ps-3" style="list-style: none !important;">
              <li class="nav-item {{ Request::is('daftar-punishment') ? 'active' : '' }}">
                <a class="nav-link {{ Request::is('daftar-punishment') ? 'active' : '' }}"
                  href="{{ url('daftar-punishment') }}">
                  <div
                    class="icon shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-list"></i>
                  </div>
                  <span class="nav-link-text ms-1">Daftar Punishment</span>
                </a>
              </li>
              <li class="nav-item {{ Request::is('tambah-punishment') ? 'active' : '' }}">
                <a class="nav-link {{ Request::is('tambah-punishment') ? 'active' : '' }}"
                  href="{{ url('tambah-punishment') }}">
                  <div
                    class="icon shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fas fa-minus-circle"></i>
                  </div>
                  <span class="nav-link-text ms-1">Tambah Punishment</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
      @endcan


      <!-- Account Pages -->
      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder">Account</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('profile') ? 'active' : '' }}" href="{{ url('profile') }}">
          <div
            class="icon icon-shape icon-sm shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-user"></i>
          </div>
          <span class="nav-link-text ms-1">Profile</span>
        </a>
      </li>
    </ul>
  </div>
</aside>
