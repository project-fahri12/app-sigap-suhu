<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>LOGIN ADMIN | {{ strtoupper($settings['app_name'] ?? 'SIGAP') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height:100vh;">
        <div class="col-md-4">

            <div class="card shadow">

                {{-- HEADER --}}
                <div class="card-header bg-primary text-white text-center">
                    @if(!empty($settings['logo']))
                        <img src="{{ asset($settings['logo']) }}"
                             alt="Logo"
                             height="50"
                             class="mb-2">
                    @endif

                    <h5 class="mb-0">
                        LOGIN ADMIN
                    </h5>
                    <small>
                        {{ strtoupper($settings['school_name'] ?? 'PPDB MADRASAH') }}
                    </small>
                </div>

                {{-- BODY --}}
                <div class="card-body">

                    {{-- ERROR --}}
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ strtoupper($error) }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.login') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">EMAIL</label>
                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   placeholder="ADMIN@EMAIL.COM"
                                   required autofocus>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">PASSWORD</label>
                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   placeholder="********"
                                   required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fa fa-sign-in"></i> MASUK
                        </button>
                    </form>

                </div>

                {{-- FOOTER --}}
                <div class="card-footer text-center text-muted">
                    <strong>{{ strtoupper($settings['app_name'] ?? 'SIGAP') }}</strong><br>
                    {{ strtoupper($settings['school_subtitle'] ?? 'SISTEM INFORMASI PPDB') }}<br>
                    TAHUN AJARAN {{ $settings['academic_year'] ?? '-' }}
                </div>

            </div>

        </div>
    </div>
</div>

</body>
</html>
