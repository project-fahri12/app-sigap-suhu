   <header class="main-header mt-3 mb-5">
        <nav class="navbar navbar-expand-lg sigap-navbar border-bottom ppdb-green-bg">
            <div class="container-fluid">

                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('assets/logo-sigap-transparan.svg') }}"
                        alt="SIGAP"
                        class="sigap-logo-img">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sigapNavbarContent" aria-controls="sigapNavbarContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="sigapNavbarContent">
                    
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        {{-- MENU STATIS --}}
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                                Home
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link {{ request()->is('validasi*') ? 'active' : '' }}" href="{{ url('/validasi') }}">
                                Validasi
                            </a>
                        </li> -->
                    </ul>

                    <ul class="navbar-nav ms-auto">
                        {{-- Guest --}}
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">
                                    <i class="fa fa-sign-in"></i> Login
                                </a>
                            </li>
                        @endguest

                        {{-- Auth (Dropdown User Menu) --}}
                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset('assets/dist/img/user-default.png') }}" class="user-image" alt="User Image">
                                    <span class="d-none d-lg-inline">{{ auth()->user()->name }}</span>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end user-menu" aria-labelledby="navbarDropdownUser">
                                    {{-- User Header --}}
                                    <li class="user-header text-center py-3">
                                        <img src="{{ asset('assets/dist/img/user-default.png') }}" class="img-circle sigap-user-img-large mb-2" alt="User Image">
                                        <p class="m-0">
                                            {{ auth()->user()->name }}
                                            <small>{{ auth()->user()->role ?? 'Administrator' }}</small>
                                        </p>
                                    </li>
                                    
                                    <li><hr class="dropdown-divider m-0"></li>

                                    {{-- User Footer --}}
                                    <li class="user-footer p-2 d-flex justify-content-between">
                                        <a href="" class="btn btn-sm btn-light btn-flat">Profile</a>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-light btn-flat">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endauth
                    </ul>

                </div>
            </div>
        </nav>
    </header>