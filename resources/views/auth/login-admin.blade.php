<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>LOGIN ADMIN | {{ $settings['app_name'] ?? 'SIGAP' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --primary-green: #28a745;
            --dark-green: #1e7e34;
        }

        body, html {
            height: 100%;
            margin: 0;
            overflow: hidden; 
            background-color: #f8f9fa;
            font-family: 'Inter', sans-serif;
            font-size: 13px; /* Ukuran font global diperkecil lagi */
        }

        .top-bg {
            position: absolute;
            top: 0;
            width: 100%;
            height: 30vh; /* Dikurangi agar lebih compact */
            background-color: var(--primary-green);
            z-index: 1;
            border-bottom-left-radius: 40px;
            border-bottom-right-radius: 40px;
        }

        .main-wrapper {
            position: relative;
            z-index: 2;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
        }

        .login-card {
            background: #ffffff;
            width: 100%;
            max-width: 310px; /* Diperkecil lagi */
            padding: 1.2rem;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        }

        .img-placeholder {
            width: 100%;
            height: 50px; /* Lebih kecil */
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .img-placeholder img {
            max-height: 100%;
            max-width: 70%;
            object-fit: contain;
        }

        .login-title {
            font-weight: 700;
            font-size: 1rem;
            color: #333;
            margin-bottom: 0.8rem;
            text-align: center;
        }

        .form-group-custom {
            margin-bottom: 0.7rem;
        }

        .form-control-custom {
            border: none;
            border-bottom: 1.5px solid #eee;
            border-radius: 0;
            padding: 0.3rem 0;
            font-size: 0.85rem;
            box-shadow: none !important;
            transition: 0.3s;
        }

        .form-control-custom:focus {
            border-bottom-color: var(--primary-green);
        }

        .btn-green {
            background-color: var(--primary-green);
            color: white;
            border: 1.5px solid var(--primary-green);
            border-radius: 50px;
            padding: 6px;
            font-weight: 600;
            font-size: 0.85rem;
            width: 100%;
            margin-top: 0.5rem;
            transition: 0.3s;
        }

        .btn-green:disabled {
            background-color: #ffffff;
            color: var(--primary-green);
            border-color: #eee;
        }

        .loader-green {
            color: var(--primary-green) !important;
        }

        .pass-group {
            position: relative;
        }

        .toggle-pass {
            position: absolute;
            right: 0;
            top: 25px; /* Disesuaikan posisi */
            cursor: pointer;
            color: #bbb;
            font-size: 0.8rem;
        }

        .forgot-pass {
            display: block;
            text-align: right;
            font-size: 0.7rem;
            color: var(--primary-green);
            text-decoration: none;
            margin-top: 2px;
        }

        .footer-text {
            text-align: center;
            font-size: 0.65rem;
            color: #ccc;
            margin-top: 1rem;
        }

        /* Custom SweetAlert Button Warna Hijau */
        .swal2-confirm-green {
            background-color: var(--primary-green) !important;
            color: white !important;
            border-radius: 50px !important;
            padding: 8px 25px !important;
        }
    </style>
</head>
<body>

    <div class="top-bg"></div>

    <div class="main-wrapper">
        <div class="login-card">
            
            <div class="img-placeholder">
                @if(!empty(setting('logo_app')))
                    <img src="{{ asset('assets/logo-sigap-brown.png') }}" alt="Logo">
                @else
                    <svg width="60" height="40" viewBox="0 0 200 150" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="200" height="150" rx="10" fill="#f0f0f0"/>
                        <circle cx="100" cy="60" r="30" fill="#FFC107"/>
                        <rect x="60" y="100" width="80" height="10" rx="5" fill="#28a745"/>
                    </svg>
                @endif
            </div>

            <h2 class="login-title">Log in</h2>

            <form method="POST" action="{{ route('admin.login') }}" id="loginForm">
                @csrf
                
                <div class="form-group-custom">
                    <label class="small fw-bold text-muted">Your Email</label>
                    <input type="email" name="email" class="form-control form-control-custom" placeholder="email@domain.com" value="{{ old('email') }}" required>
                </div>

                <div class="form-group-custom pass-group">
                    <label class="small fw-bold text-muted">Password</label>
                    <input type="password" name="password" id="password" class="form-control form-control-custom" placeholder="••••••••" required>
                    <i class="fa-regular fa-eye toggle-pass" id="eyeIcon"></i>
                    <a href="#" class="forgot-pass">Forgot password?</a>
                </div>

                <button type="submit" class="btn btn-green" id="submitBtn">
                    <span id="btnText">Log in</span>
                    <span id="btnLoader" class="spinner-border spinner-border-sm loader-green d-none"></span>
                </button>
            </form>

            <div class="footer-text">
                {{ strtoupper($settings['app_name'] ?? 'SIGAP') }} &copy; {{ date('Y') }}
            </div>
        </div>
    </div>

    <script>
        // 1. Tampilkan SweetAlert jika ada error validasi dari Laravel
        @if($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal',
                html: '{!! implode("<br>", $errors->all()) !!}',
                confirmButtonText: 'Coba Lagi',
                customClass: {
                    confirmButton: 'swal2-confirm-green'
                },
                buttonsStyling: false
            });
        @endif

        // 2. Fitur Eye Icon (Show/Hide Password)
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        eyeIcon.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        // 3. Fitur Loading Button & Reset jika validasi gagal (opsional)
        const loginForm = document.getElementById('loginForm');
        const submitBtn = document.getElementById('submitBtn');
        const btnText = document.getElementById('btnText');
        const btnLoader = document.getElementById('btnLoader');

        loginForm.addEventListener('submit', function() {
            if (loginForm.checkValidity()) {
                submitBtn.disabled = true;
                btnText.classList.add('d-none');
                btnLoader.classList.remove('d-none');
            }
        });
    </script>
</body>
</html>