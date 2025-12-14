@extends('layouts.app') 

@section('content')

<div class="ppdb-container text-center">
    
    <h4 class="text-center text-success mb-4">PENDAFTARAN BERHASIL</h4>

    <div class="card p-4 mx-auto" style="max-width: 500px; border: 1px solid #ddd; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
        
        <p class="lead mb-2">Copy dan Simpan <strong>Kode Pendaftaran</strong> di bawah ini:</p>
        
        {{-- KODE PENDAFTARAN --}}
        <div class="p-3 mb-4 rounded" style="background-color: #e6ffe6; border: 2px solid var(--ppdb-green);">
            <h2 class="text-success fw-bold m-0">{{ $registration_code }}</h2>
        </div>
        
        <button class="btn btn-sm btn-outline-success mb-4"
                onclick="copyCode('{{ $registration_code }}')">
            <i class="fa fa-copy me-1"></i> Copy Kode
        </button>

        <h5 class="text-primary mb-3 border-bottom pb-2">INFORMASI PENTING</h5>

        <div class="text-start small">
            <ol>
                <li>
                    Gunakan <strong>KODE</strong> di atas sebagai <strong>USERNAME</strong> dan
                    <strong>Tanggal Lahir (YYYYMMDD)</strong> sebagai <strong>PASSWORD</strong>.
                </li>
                <li>
                    Setelah Login, lengkapi <strong>Data Orang Tua / Wali</strong> dan
                    lakukan <strong>Upload Berkas</strong>.
                </li>
                <li>
                    Selesaikan pembayaran (jika ada) untuk memvalidasi pendaftaran.
                </li>
                <li>
                    Format berkas: <strong>JPG / PNG / PDF</strong>, maksimal <strong>1 MB</strong>.
                </li>
                <li>
                    Informasi lanjut: klik <strong>Gabung Grup PPDB</strong> atau hubungi panitia.
                </li>
            </ol>
        </div>
        
        <div class="mt-4">
            <a href="{{ route('login') }}" class="btn btn-success btn-lg">
                <i class="fa fa-sign-in me-2"></i> Login Peserta
            </a>
        </div>
        
    </div>
</div>

<script>
    function copyCode(code) {
        navigator.clipboard.writeText(code).then(() => {
            alert("Kode Pendaftaran berhasil disalin:\n" + code);
        }).catch(() => {
            alert("Gagal menyalin. Silakan salin manual:\n" + code);
        });
    }
</script>

@endsection
