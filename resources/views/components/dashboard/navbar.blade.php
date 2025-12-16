<header class="main-header">

    <!-- Logo -->
    <a href="{{ url('/') }}" class="logo bg-green">

        {{-- Logo Desktop --}}
        <span class="logo-lg">
            <img
                src="{{ asset(setting('logo_app', 'assets/logo-sigap-transparan.svg')) }}"
                alt="{{ setting('app_name', 'SIGAP') }}"
                style="height:28px; margin-top:-4px;"
                onerror="this.src='{{ asset('assets/logo-sigap-transparan.svg') }}'"
            >
        </span>

    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top bg-green" role="navigation">

        <!-- Sidebar toggle -->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <!-- User Account -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                        <img
                            src="{{ asset('assets/dist/img/avatar.png') }}"
                            class="user-image"
                            alt="User Image"
                        >

                        <span class="hidden-xs">
                            {{ auth()->user()->username ?? 'Administrator' }}
                        </span>
                    </a>

                    <ul class="dropdown-menu">

                        <!-- User image -->
                        <li class="user-header bg-green">
                            <img
                                src="{{ asset('assets/dist/img/avatar.png') }}"
                                class="img-circle"
                                alt="User Image"
                            >

                            <p>
                                {{ auth()->user()->username ?? 'Administrator' }}
                                <small>
                                    {{ ucfirst(auth()->user()->role ?? 'admin') }}
                                </small>
                            </p>
                        </li>

                        <!-- Menu Footer -->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#"
                                   class="btn btn-default btn-flat">
                                    Profil
                                </a>
                            </div>

                            <div class="pull-right">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="btn btn-default btn-flat">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </li>

                    </ul>
                </li>

            </ul>
        </div>
    </nav>
</header>
