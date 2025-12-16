<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        {{ setting('app_name', 'SIGAP') }}
        @if (setting('system_name'))
            | {{ setting('system_name') }}
        @endif
    </title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        /* Variabel Warna PPDB */
        :root {
            --ppdb-green: #38a538;
            --ppdb-dark: #2c3e50;
            --sigap-blue: #1c365c;
            --sigap-orange: #ff6e1d;
            --navbar-text-light: white;
        }

        /* --- Global Layout --- */
        body {
            background-color: #f0f0f0;
            color: var(--ppdb-dark);
        }

        /* --- Custom Class untuk Warna Hijau Navbar --- */
        .ppdb-green-bg {
            background-color: var(--ppdb-green) !important;
        }

        /* Mengubah warna teks dan ikon di navbar agar terlihat pada latar belakang hijau */
        .ppdb-green-bg .navbar-nav .nav-link,
        .ppdb-green-bg .navbar-toggler,
        .ppdb-green-bg .navbar-brand {
            color: var(--navbar-text-light) !important;
        }

        .ppdb-green-bg .navbar-toggler-icon {
            filter: invert(1) grayscale(100%) brightness(200%);
        }

        .ppdb-green-bg .navbar-nav .nav-link:hover {
            color: #d4e7d4 !important;
        }

        /* --- Header SIGAP (Navbar) --- */
        .sigap-navbar .navbar-brand .sigap-logo-img {
            height: 40px;
            margin-top: -5px;
        }

        .navbar-brand {
            padding-top: 5px;
            padding-bottom: 5px;
        }

        /* --- Konten PPDB --- */
        .ppdb-container {
            max-width: 800px;
            /* Margin Top pada container utama dihapus karena sudah ada margin bawah di navbar */
            margin: 0px auto 30px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .logo-ppdb {
            width: 100px;
            height: auto;
            margin-bottom: 15px;
        }

        .main-title {
            font-size: 1.5rem;
            font-weight: bold;
            line-height: 1.2;
        }

        .subtitle {
            font-size: 1.1rem;
            margin-bottom: 5px;
        }

        .year {
            font-size: 0.9rem;
            margin-bottom: 25px;
            color: #666;
        }

        /* --- Accordion (Menu PPDB) --- */
        .ppdb-accordion .accordion-item {
            border: none;
            margin-bottom: 10px;
        }

        /* Tombol Header Accordion */
        .ppdb-accordion .accordion-button {
            background-color: var(--ppdb-green);
            color: white;
            padding: 15px 20px;
            border-radius: 5px;
            text-align: left;
            font-weight: bold;
            font-size: 1rem;
            transition: background-color 0.3s;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .ppdb-accordion .accordion-button:not(.collapsed) {
            background-color: var(--ppdb-green);
            color: white;
            box-shadow: none;
        }

        .ppdb-accordion .accordion-button:hover {
            background-color: var(--sigap-blue);
            color: white;
        }

        /* Ikon di Menu */
        .ppdb-accordion .accordion-button i {
            margin-right: 15px;
            width: 20px;
        }

        /* Konten di dalam Accordion */
        .ppdb-accordion .accordion-body {
            text-align: left;
            padding: 15px 20px;
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            border-top: none;
            border-radius: 0 0 5px 5px;
        }

        /* --- Footer --- */
        .footer {
            padding: 20px;
            background-color: #f8f8f8;
            font-size: 12px;
            color: #666;
            margin-top: 30px;
        }

        .footer p {
            margin: 3px 0;
        }

        .school-name {
            font-weight: bold;
            color: var(--sigap-blue);
        }

        /* Responsive Navbar Bootstrap 5 (user menu) */
        .user-image {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            margin-right: 5px;
        }

        /* Styling untuk User Menu Dropdown Header */
        .user-menu .user-header {
            text-align: center;
            padding: 10px;
            background-color: var(--sigap-blue);
            color: white;
        }

        .user-menu .user-header img {
            height: 90px;
            width: 90px;
            border: 3px solid rgba(255, 255, 255, 0.2);
        }

        .login-card {
            width: 100%;
            max-width: 400px;
            padding: 30px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .login-header {
            background-color: var(--ppdb-green);
            color: white;
            padding: 15px 20px;
            border-radius: 5px 5px 0 0;
            font-size: 1.2rem;
            font-weight: bold;
            text-align: center;
            /* Meringkas bagian atas card */
            margin: -30px -30px 30px -30px;
        }

        .btn-ppdb {
            background-color: var(--ppdb-green);
            color: white;
            border: none;
            padding: 10px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn-ppdb:hover {
            background-color: #2c8c2c;
            color: white;
        }
    </style>
</head>

<body>

    @include('components.navbar')

    <main class="container">
        <div class="ppdb-container">
            @yield('content')
        </div>
    </main>

    @include('components.footer')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>
