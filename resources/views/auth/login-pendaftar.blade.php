@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-4"> {{-- Ukuran dikecilkan ke col-4 agar lebih compact --}}
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-success mb-1">Login Pendaftar</h5>
                    <p class="text-muted small mb-4">Masuk ke portal pendaftaran</p>

                    @if ($errors->any())
                        <div class="alert alert-danger py-2 px-3 small border-0 mb-3">
                            {{ $errors->first() }} {{-- Hanya tampilkan satu pesan error agar ringkas --}}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('userLoginProses') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label small fw-bold">Kode Pendaftaran</label>
                            <input type="text" name="kode" 
                                   class="form-control @error('kode') is-invalid @enderror" 
                                   placeholder="Contoh: PPDB-001" value="{{ old('kode') }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" 
                                   class="form-control @error('tanggal_lahir') is-invalid @enderror" required>
                            <div class="form-text mt-2" style="font-size: 11px;">
                                *Gunakan tanggal lahir sebagai password
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success fw-bold py-2">
                                Login
                            </button>
                        </div>
                    </form>

                    <div class="mt-4 text-center">
                        <span class="small text-muted">Belum punya akun?</span>
                        <a href="{{ url('/register') }}" class="small text-success text-decoration-none fw-bold">Daftar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Fokus input warna success */
    .form-control:focus {
        border-color: #198754;
        box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.15);
    }
</style>
@endsection