{{-- 1. Notifikasi Sukses --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible shadow-sm">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
        {{ session('success') }}
    </div>
@endif

{{-- 2. Notifikasi Error / Gagal --}}
@if (session('error'))
    <div class="alert alert-danger alert-dismissible shadow-sm">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> Kesalahan!</h4>
        {{ session('error') }}
    </div>
@endif

{{-- 3. Notifikasi Warning (Peringatan) --}}
@if (session('warning'))
    <div class="alert alert-warning alert-dismissible shadow-sm">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-warning"></i> Perhatian!</h4>
        {{ session('warning') }}
    </div>
@endif

{{-- 4. Error Validasi Form (Jika ada input yang salah) --}}
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible shadow-sm">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> Terjadi Kesalahan Input:</h4>
        <ul style="margin-left: 20px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif