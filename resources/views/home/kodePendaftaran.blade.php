@extends('layouts.app')

@push('styles')
<style>
    .ppdb-wrapper {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #f8f9fa;
        padding: 1rem;
    }

    .ppdb-card {
        max-width: 420px;
        width: 100%;
        border: none;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0,0,0,.1);
        padding: 2rem;
        text-align: center;
        background: #fff;
    }

    .ppdb-code-card {
        background: #f1f5f9;
        border: 2px dashed #0d6efd;
        border-radius: 12px;
        padding: 1.25rem;
        font-size: 1.8rem;
        font-weight: 700;
        letter-spacing: .25rem;
        margin: 1.5rem 0 1rem;
        user-select: all;
    }

    .ppdb-info {
        background: #e7f3ff;
        border-left: 4px solid #0d6efd;
        border-radius: 10px;
        padding: 1rem;
        text-align: left;
        font-size: .9rem;
        margin-bottom: 1.5rem;
    }
</style>
@endpush

@section('content')
<div class="ppdb-wrapper">
    <div class="ppdb-card">

        <i class="fa-solid fa-circle-check fa-3x text-success mb-3"></i>

        <h4 class="fw-bold mb-1">Pendaftaran Berhasil</h4>
        <p class="text-muted mb-3">Simpan nomor pendaftaran berikut</p>

        {{-- Card Nomor Pendaftaran --}}
        <div class="ppdb-code-card" id="registrationCode">
            {{ $registration_code ?? 'SG-2025-XXXXX' }}
        </div>

        {{-- Keterangan Penting --}}
        <div class="ppdb-info">
            <strong>
                <i class="fa-solid fa-circle-info me-1"></i> Penting!
            </strong>
            <p class="mb-0 mt-1">
                Nomor pendaftaran ini <b>wajib</b> digunakan untuk login,
                melakukan pembayaran, dan melengkapi berkas pendaftaran.
                Silakan cek email Anda untuk informasi lanjutan.
            </p>
        </div>

        <button class="btn btn-primary w-100 mb-3" onclick="copyCode()">
            <i class="fa-solid fa-copy me-2"></i> Salin Nomor
        </button>

        <a href="{{ route('login') }}" class="btn btn-outline-secondary w-100">
            Login Menggunakan Nomor
        </a>

    </div>
</div>
@endsection

@push('scripts')
<script>
function copyCode() {
    const code = document.getElementById('registrationCode').innerText.trim();
    navigator.clipboard.writeText(code).then(() => {
        alert('Nomor pendaftaran berhasil disalin');
    }).catch(() => {
        alert('Gagal menyalin. Silakan salin manual.');
    });
}
</script>
@endpush
