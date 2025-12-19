<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('judul', 'Homepage')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="{{ asset('assets/bower_components/jquery/dist/jquery.min.js') }}"></script>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <style>
        /* ===============================
   GLOBAL COLOR
=============================== */
        .ppdb-green-bg {
            background-color: #16a34a;
        }

        /* ===============================
   NAVBAR
=============================== */
        .navbar {
            padding: 0.6rem 0;
        }

        .navbar-nav .nav-link {
            font-weight: 500;
        }

        .navbar-nav .nav-link.active {
            text-decoration: underline;
        }

        /* Header PPDB */
        .ppdb-header h5 {
            line-height: 1.3;
        }

        .ppdb-header .tahun-ajaran {
            font-weight: 600;
            letter-spacing: .5px;
        }


        /* ===============================
   MENU CARD (GRID)
=============================== */
        .menu-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;

            background: #ffffff;
            border-radius: 10px;
            padding: 20px 10px;
            height: 135px;

            text-decoration: none;
            color: #333;

            box-shadow: 0 4px 14px rgba(0, 0, 0, .08);
            transition: all .2s ease;
        }

        .menu-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 18px rgba(0, 0, 0, .12);
            color: #000;
        }

        /* Icon bulat (lebih kecil & elegan) */
        .menu-icon {
            width: 52px;
            height: 52px;
            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #16a34a;
            color: #fff;
            font-size: 22px;
            margin-bottom: 8px;
        }

        .menu-title {
            font-weight: 600;
            font-size: 14px;
            text-align: center;
        }

        /* ===============================
   LIST MENU (MODEL TOMBOL PANJANG)
=============================== */
        .ppdb-menu-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .ppdb-menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            background: #16a34a;
            color: #fff;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 3px 8px rgba(0, 0, 0, .15);
            transition: all .2s ease;
        }

        .ppdb-menu-item i {
            font-size: 18px;
            width: 22px;
            text-align: center;
        }

        .ppdb-menu-item:hover {
            background: #15803d;
            transform: translateY(-1px);
            color: #fff;
        }

        .nav-tabs .nav-link.active {
            background-color: #15803d !important;
            color: white !important;
            border-color: #15803d !important;
        }

        @media (max-width: 575.98px) {
            .nav-tabs .nav-link {
                border-radius: 0.5rem !important;
                margin-bottom: 5px;
            }

            .nav-tabs .nav-link.active {
                background-color: #15803d !important;
                color: white !important;
                border-color: #15803d !important;
            }
        }

        /* ===============================
   MOBILE ADJUST
=============================== */
        @media (max-width: 576px) {
            .menu-card {
                height: 125px;
            }

            .menu-title {
                font-size: 13px;
            }
        }
    </style>

    @stack('css')
</head>

<body class="bg-light">

    {{-- NAVBAR --}}
    @include('components.navbar')

    {{-- CONTENT --}}
    <main class="container my-4">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="text-center text-muted py-3 border-top">
        <small>
            &copy; {{ date('Y') }} {{ setting('pondok_name') }}
        </small>
    </footer>

    {{-- Bootstrap 5 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    @stack('js')
</body>

</html>
