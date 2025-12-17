<nav class="navbar navbar-expand-lg navbar-dark ppdb-green-bg shadow-sm">
    <div class="container">

        {{-- LOGO --}}
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset(setting('logo_app', 'assets/logo-sigap-transparan.svg')) }}"
                 alt="Logo"
                 style="height:28px"
                 onerror="this.src='{{ asset('assets/logo-sigap-transparan.svg') }}'">
        </a>

        {{-- MOBILE : LOGIN SAJA --}}
        @guest
            <div class="d-flex d-lg-none ms-auto">
                <a href="{{ route('login') }}" class="nav-link text-white fw-semibold">
                    <i class="fa fa-sign-in me-1"></i> Login
                </a>
            </div>
        @endguest

        {{-- DESKTOP MENU --}}
        <div class="collapse navbar-collapse d-none d-lg-flex">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}"
                       href="{{ url('/') }}">Home</a>
                </li>

                @auth
                    <li class="nav-item">
                        <a class="nav-link"
                           href="{{ route(auth()->user()->role.'.dashboard') }}">
                            Dashboard
                        </a>
                    </li>
                @endauth

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fa fa-sign-in me-1"></i> Login
                        </a>
                    </li>
                @endguest

            </ul>
        </div>

    </div>
</nav>
