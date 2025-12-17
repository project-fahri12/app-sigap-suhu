@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body p-4 text-center">
                    {{-- Judul --}}
                    <h5 class="fw-bold text-success mb-2">Pendaftaran Ditutup</h5>
                    
                    {{-- Garis Pemisah --}}
                    <hr class="mx-auto my-3" style="width: 50px; border-top: 3px solid #198754; border-radius: 10px;">

                    {{-- Pesan --}}
                    <p class="text-muted small mb-4">
                        Mohon maaf, pendaftaran Penerimaan Peserta Didik Baru (PPDB) saat ini telah resmi ditutup. 
                        Terima kasih atas antusiasme Anda.
                    </p>

                    {{-- Info Tambahan (Opsional) --}}
                    <div class="bg-light p-3 rounded-2 mb-4">
                        <p class="small mb-0 text-secondary">
                            Bagi calon santri yang sudah mendaftar, silakan tetap login untuk memantau status seleksi atau pengumuman berikutnya.
                        </p>
                    </div>

                    {{-- Tombol Navigasi --}}
                    <div class="d-grid gap-2">
                        <a href="{{ url('/login') }}" class="btn btn-success fw-bold py-2">
                            Login ke Akun
                        </a>
                            <a href="" class="btn btn-info fw-semibold py-2 text-white">
                                chat admin
                            </a>
                        <a href="{{ url('/') }}" class="btn btn-link text-decoration-none text-muted small">
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection