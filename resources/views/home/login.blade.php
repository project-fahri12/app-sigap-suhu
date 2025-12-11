@extends('home.homePage')

@section('content')

<section class="py-5 bg-light-soft">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow-lg border-0 rounded-4 animate-on-scroll">
                    
                    <div class="card-header text-center bg-light-aqua text-dark-navy py-4 rounded-top-4">
                        <img src="{{ asset('assets/logo-sigap.svg') }}" 
                             alt="SIGAP" height="70" class="mb-2">
                        <h4 class="fw-bold mt-2">Login Pendaftar SIGAP</h4>
                        <p class="mb-0 small">Masuk menggunakan Kode Pendaftaran & Tanggal Lahir</p>
                    </div>

                    <div class="card-body p-4">

                        <form>
                            {{-- Kode Pendaftaran --}}
                            <div class="mb-4 floating-label-group">
                                <label class="form-label text-dark-navy fw-semibold">Kode Pendaftaran</label>
                                <input type="text" name="kode" class="form-control form-control-sm" 
                                    placeholder="Contoh: P20251234" required>
                            </div>

                            {{-- Tanggal Lahir --}}
                            <div class="mb-4 floating-label-group">
                                <label class="form-label text-dark-navy fw-semibold">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control form-control-sm" required>
                            </div>

                            <button type="submit" 
                                class="btn btn-primary-custom w-100 py-2 fs-5 shadow-sm hover-grow text-white">
                                <i class="fas fa-sign-in-alt me-2"></i> Login
                            </button>
                        </form>

                        <div class="text-center mt-4 small">
                            Belum memiliki kode?  
                            <a href="{{ url('/pendaftaran') }}" class="text-primary-custom fw-bold">
                                Daftar Sekarang
                            </a>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</section>

@endsection
