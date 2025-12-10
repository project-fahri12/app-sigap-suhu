<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGAP - Sistem Informasi Gerbang Pendaftaran</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
{{-- Navbar --}}
@include('home.component.navbar')
   
{{-- content --}}

    @yield('content')
 {{-- Footer --}}
@include('home.component.footer')
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
