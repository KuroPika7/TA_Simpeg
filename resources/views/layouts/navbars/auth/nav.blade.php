<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
  navbar-scroll="true" style="overflow: visible;">
  <div class="container-fluid py-1 px-3">
    <div class="d-flex align-items-center w-100">
      <button class="navbar-toggler me-2" type="button" id="iconNavbarSidenav">
        <div class="sidenav-toggler-inner">
          <i class="sidenav-toggler-line"></i>
          <i class="sidenav-toggler-line"></i>
          <i class="sidenav-toggler-line"></i>
        </div>
      </button>

      <nav aria-label="breadcrumb" class="d-none d-md-block">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
          <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">
            {{ str_replace('-', ' ', Request::path()) }}</li>
        </ol>
        <h6 class="font-weight-bolder mb-0 text-capitalize">{{ str_replace('-', ' ', Request::path()) }}</h6>
      </nav>

      <div class="d-md-none flex-grow-1">
        <h6 class="font-weight-bolder mb-0 text-capitalize text-sm">{{ str_replace('-', ' ', Request::path()) }}</h6>
      </div>

      <div class="ms-auto d-flex align-items-center">

        <!-- Sign Out -->
        <div class="dropdown px-2 d-flex align-items-center">
          <a href="javascript:;" class="nav-link text-body font-weight-bold px-0 d-flex align-items-center gap-2"
            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-user me-sm-1"></i>
            <span class="d-sm-inline d-none">{{ auth()->user()->karyawan->name ?? auth()->user()->name }}</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end px-2 py-3" aria-labelledby="dropdownMenuButton">
            <li class="mb-2">
              <a class="dropdown-item border-radius-md" href="{{ route('profile') }}">
                <div class="d-flex py-1">
                  <div class="d-flex flex-column justify-content-center">
                    <h6 class="text-sm font-weight-normal mb-1">
                      <i class="fa fa-user me-1"></i> Profile
                    </h6>
                  </div>
                </div>
              </a>
            </li>
            <li>
              <a class="dropdown-item border-radius-md" href="{{ url('/logout') }}">
                <div class="d-flex py-1">
                  <div class="d-flex flex-column justify-content-center">
                    <h6 class="text-sm font-weight-normal mb-1">
                      <i class="fas fa-sign-out-alt me-1"></i> Sign Out
                    </h6>
                  </div>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</nav>
<!-- End Navbar -->

<style>
  .navbar-toggler {
    border: none;
    background: transparent;
    padding: 0.5rem;
    cursor: pointer;
    margin-right: 1rem;
  }

  .sidenav-toggler-inner {
    width: 24px;
    height: 18px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .sidenav-toggler-line {
    width: 100%;
    height: 2px;
    background-color: #344767;
    border-radius: 2px;
    transition: all 0.3s ease;
  }

  .navbar-toggler:hover .sidenav-toggler-line {
    background-color: #667eea;
  }

  .sidenav-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1029;
    display: none;
    opacity: 0;
    transition: opacity 0.3s ease;
  }

  .sidenav-overlay.show {
    display: block;
    opacity: 1;
  }

  @media (max-width: 991.98px) {
    .sidenav {
      position: fixed;
      top: 0;
      left: 0;
      height: 100vh;
      z-index: 1030;
      transform: translateX(calc(-100% - 1rem)) !important;
      transition: transform 0.3s ease;
    }

    body.g-sidenav-show.g-sidenav-pinned .sidenav {
      transform: translateX(0) !important;
      visibility: visible !important;
      display: block !important;
    }

    .navbar-main {
      margin: 0.5rem !important;
      padding: 0.5rem !important;
    }

    .navbar-main .container-fluid {
      padding: 0.5rem !important;
    }
  }

  @media (min-width: 992px) {
    .sidenav {
      transform: translateX(0);
    }

    body:not(.g-sidenav-show) .sidenav {
      transform: translateX(calc(-100% - 1rem));
    }
  }

  @media (max-width: 575.98px) {
    .navbar-main {
      margin: 0.25rem !important;
    }

    .breadcrumb-item,
    .font-weight-bolder {
      font-size: 0.75rem !important;
    }

    .nav-link {
      padding: 0.25rem !important;
    }
  }

  .navbar-main {
    overflow-x: hidden;
  }

  .navbar-main .d-flex {
    flex-wrap: nowrap;
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.getElementById('iconNavbarSidenav');
    const closeButton = document.getElementById('iconSidenav');
    const body = document.body;

    if (toggleButton) {
      const overlay = document.createElement('div');
      overlay.className = 'sidenav-overlay';
      document.body.appendChild(overlay);

      toggleButton.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();

        setTimeout(function() {
          const isMobile = window.innerWidth < 992;

          if (isMobile) {
            body.classList.toggle('g-sidenav-pinned');
            overlay.classList.toggle('show');
          } else {
            body.classList.toggle('g-sidenav-show');
          }
        }, 10);
      }, true);

      if (closeButton) {
        closeButton.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopImmediatePropagation();

          setTimeout(function() {
            body.classList.remove('g-sidenav-pinned');
            body.classList.remove('g-sidenav-show');
            overlay.classList.remove('show');
          }, 10);
        }, true);
      }

      overlay.addEventListener('click', function() {
        body.classList.remove('g-sidenav-pinned');
        overlay.classList.remove('show');
      });
    }
  });
</script>
