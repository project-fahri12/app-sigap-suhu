@extends('layouts.app')


@section('content')
<div class="login-card">
    <div class="login-header">
        Login Pendaftar
    </div>

    {{-- Menampilkan pesan error validasi (jika ada) --}}
    @if ($errors->any())
        <div class="alert alert-danger p-2" role="alert">
            @foreach ($errors->all() as $error)
                <p class="m-0 small">{{ $error }}</p>
            @endforeach
        </div>
    @endif
    
    {{-- Form Login --}}
    <form method="POST" action="{{ route('userLoginProses') }}">
        @csrf

        {{-- Input Kode Pendaftaran (Username) --}}
        <div class="mb-3">
            <label for="kode" class="form-label">Kode Pendaftaran</label>
            <input type="text" 
                   class="form-control @error('kode') is-invalid @enderror" 
                   id="kode" 
                   name="kode" 
                   value="{{ old('kode') }}" 
                   required 
                   autofocus>
            {{-- Error feedback khusus kode --}}
            @error('kode')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- Input Tanggal Lahir (Password) --}}
        <div class="mb-4">
            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" 
                   class="form-control @error('tanggal_lahir') is-invalid @enderror" 
                   id="tanggal_lahir" 
                   name="tanggal_lahir" 
                   required>
            {{-- Error feedback khusus tanggal lahir --}}
            @error('tanggal_lahir')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        <div class="d-grid">
            <button type="submit" class="btn btn-ppdb">
                Login
            </button>
        </div>
    </form>

    <div class="mt-3 text-center small">
        <a href="{{ url('/register') }}" class="text-decoration-none">Belum punya akun? Daftar sekarang</a>
    </div>

</div>
@endsection