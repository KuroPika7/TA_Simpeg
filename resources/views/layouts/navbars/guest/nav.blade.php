<!-- Navbar -->
<nav
  class="navbar navbar-expand-lg position-absolute top-0 z-index-3 my-3 {{ Request::is('static-sign-up') ? 'w-100 shadow-none navbar-transparent mt-4' : 'blur blur-rounded shadow-sm py-2 start-0 end-0 mx-4' }}"
  style="{{ !Request::is('static-sign-up') ? 'backdrop-filter: saturate(200%) blur(30px); background-color: rgba(255, 255, 255, 0.8);' : '' }}">
  <div class="container-fluid {{ Request::is('static-sign-up') ? 'container' : 'container-fluid' }}">
    <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 {{ Request::is('static-sign-up') ? 'text-white' : 'text-gradient text-primary' }}"
      href="{{ url('dashboard') }}">
      PT. Super Permata Kitchen
    </a>
    <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation"
      aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon mt-2">
        <span class="navbar-toggler-bar bar1"></span>
        <span class="navbar-toggler-bar bar2"></span>
        <span class="navbar-toggler-bar bar3"></span>
      </span>
    </button>
    <div class="collapse navbar-collapse" id="navigation">
      <ul class="navbar-nav mx-auto">
        @if (auth()->user())
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center me-2 active hover-scale" aria-current="page"
              href="{{ url('dashboard') }}">
              <i class="fa fa-chart-pie opacity-6 me-1 {{ Request::is('static-sign-up') ? '' : 'text-dark' }}"></i>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link me-2 hover-scale" href="{{ url('profile') }}">
              <i class="fa fa-user opacity-6 me-1 {{ Request::is('static-sign-up') ? '' : 'text-dark' }}"></i>
              Profile
            </a>
          </li>
        @endif
        <li class="nav-item">
          <a class="nav-link me-2 hover-scale" href="{{ auth()->user() ? url('static-sign-up') : url('register') }}">
            <i class="fas fa-user-circle opacity-6 me-1 {{ Request::is('static-sign-up') ? '' : 'text-dark' }}"></i>
            Sign Up
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2 hover-scale" href="{{ auth()->user() ? url('static-sign-in') : url('login') }}">
            <i class="fas fa-key opacity-6 me-1 {{ Request::is('static-sign-up') ? '' : 'text-dark' }}"></i>
            Sign In
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<style>
  .text-gradient.text-primary {
    background-image: linear-gradient(310deg, #7928CA 0%, #FF0080 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .hover-scale {
    transition: transform 0.2s;
  }

  .hover-scale:hover {
    transform: translateY(-1px);
  }
</style>
<!-- End Navbar -->
