<nav id="navbar" class="navbar navbar-expand-lg navbar-dark shadow-sm-soft sticky-top animate-navbar">
    <div class="container">
        
        <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('assets/logo-sigap-transparan.svg') }}" 
                 alt="Logo SIGAP" height="58" class="me-2 logo-animate">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                       href="{{ url('/') }}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('pendaftaran') ? 'active' : '' }}"
                       href="{{ url('/pendaftaran') }}">Pendaftaran</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('validasi') ? 'active' : '' }}"
                       href="{{ url('/validasi') }}">Validasi</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#kontak">Kontak</a>
                </li>
            </ul>

            <a href="{{ url('/login') }}" class="text-white btn btn-light-aqua ms-lg-3 shadow-lg hover-grow">
                Login Pendaftar
            </a>

        </div>
    </div>
</nav>
