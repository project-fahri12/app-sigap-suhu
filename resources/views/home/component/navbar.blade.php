  <!-- Header -->
  <header>
      <div class="container">
          <nav class="nav-container">

              <!-- Logo -->
              <div class="logo">
                  <img src="{{ asset('assets/logo-sigap.svg') }}" alt="SIGAP Logo" class="logo-img">
              </div>

              <button class="mobile-menu-btn" id="mobileMenuBtn">
                  <i class="fas fa-bars"></i>
              </button>

              <ul class="nav-menu" id="navMenu">
                  <li>
                      <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                          Home
                      </a>
                  </li>
                  <li>
                    <a href="{{ route('pendaftaran') }}" class="{{ request()->routeIs('pendaftaran') ? 'active' : '' }}">Pendaftaran</a>
                </li>
                  <li>
                    <a href="{{ route('validasi') }}" class="{{ request()->routeIs('validasi') ? 'active' : '' }}">Validasi</a>
                </li>
                  <li>
                    <a href="{{ route('pengumuman') }}" class="{{ request()->routeIs('pengumuman') ? 'active' : '' }}">Pengumuman</a>
                </li>
                  <li>
                    <a href="{{ route('kontak') }}" class="{{ request()->routeIs('kontak') ? 'active' : '' }}">Kontak</a>
                </li>
                  <li>
                    <a href="#" class="login-btn">Login</a>
                </li>
              </ul>

          </nav>
      </div>
  </header>
