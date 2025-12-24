<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - SIGAP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .bg-sigap {
            background-color: #10b981;
        }

        /* Emerald 500 */
        .text-sigap {
            color: #059669;
        }

        /* Emerald 600 */
    </style>
</head>

<body class="bg-slate-50 flex items-center justify-center min-h-screen p-6">
    <div class="max-w-md w-full text-center">
        <div class="relative flex justify-center mb-8">
            <div class="absolute inset-0 bg-emerald-200 blur-3xl opacity-30 rounded-full"></div>
            <div class="relative animate-float text-sigap">
                @yield('icon')
            </div>
        </div>

        <h1 class="text-7xl font-bold text-slate-800 mb-4">@yield('code')</h1>
        <h2 class="text-2xl font-semibold text-slate-700 mb-3">@yield('heading')</h2>
        <p class="text-slate-500 mb-8 leading-relaxed">
            @yield('message')
        </p>

        @if ($exception->getStatusCode() !== 503)
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/"
                    class="inline-flex items-center justify-center px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-xl transition-all duration-200 shadow-lg shadow-emerald-200">
                    <i data-lucide="home" class="w-5 h-5 mr-2"></i>
                    Kembali ke Beranda
                </a>
            </div>
        @else
            {{-- Opsional: Tampilkan pesan atau tombol refresh saat maintenance --}}
            <div class="flex justify-center">
                <button onclick="window.location.reload()"
                    class="inline-flex items-center justify-center px-6 py-3 border-2 border-emerald-600 text-emerald-600 hover:bg-emerald-50 font-semibold rounded-xl transition-all duration-200">
                    <i data-lucide="refresh-cw" class="w-5 h-5 mr-2 animate-spin-slow"></i>
                    Coba Segarkan Halaman
                </button>
            </div>
        @endif

        <div
            class="mt-12 flex flex-col items-center justify-center space-y-2 opacity-60 hover:opacity-100 transition-opacity duration-300">
            <img src="{{ asset('assets/logo-sigap-brown.png') }}" alt="Logo SIGAP" class="h-12 w-auto object-contain">

            <div class="text-center">
                <span class="block text-xs font-bold text-slate-500 tracking-widest uppercase">Aplikasi SIGAP</span>
                <span class="block text-[10px] text-slate-400 italic">Solusi Informasi Terintegrasi & Cepat</span>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>
