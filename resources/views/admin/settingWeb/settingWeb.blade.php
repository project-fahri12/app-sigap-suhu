@extends('layouts.masterDashboard')

@section('judul', 'Setting Site')
@section('sub-judul', 'Pengaturan Website & PPDB')

@section('content')

{{-- alert hasil simpan --}}
@if (session('success'))
<div class="alert alert-success alert-dismissible">
    <button class="close" data-dismiss="alert">&times;</button>
    <i class="fa fa-check-circle"></i> {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger alert-dismissible">
    <button class="close" data-dismiss="alert">&times;</button>
    <i class="fa fa-warning"></i> {{ session('error') }}
</div>
@endif

<form action="{{ route('admin.setting-web.update', 1) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')

{{-- ================= SETTING WEBSITE ================= --}}
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">
            <i class="fa fa-globe"></i> Setting Website
        </h3>
    </div>

    <div class="box-body">
        <div class="row">

            {{-- input nama aplikasi & sistem --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nama Aplikasi</label>
                    <input type="text" name="app_name" class="form-control"
                        value="{{ setting('app_name','SIGAP') }}">
                </div>

                <div class="form-group">
                    <label>Nama Sistem</label>
                    <input type="text" name="system_name" class="form-control"
                        value="{{ setting('system_name') }}">
                </div>
            </div>

            {{-- upload & preview logo --}}
            <div class="col-md-6">
                <label>Logo Aplikasi</label>
                <input type="file" name="logo_app" class="form-control"
                    accept="image/*" onchange="previewLogo(this)">

                <div class="text-center" style="margin-top:15px">
                    <img id="logoPreview"
                        src="{{ asset(setting('logo_app','assets/logo-sigap.svg')) }}"
                        class="img-thumbnail"
                        style="max-height:100px">
                </div>
            </div>

        </div>
    </div>
</div>

{{-- ================= STATUS SISTEM PPDB ================= --}}
<div class="box box-info">
    <div class="box-body">

        <h4><i class="fa fa-info-circle"></i> Status Sistem</h4>
        <hr>

        {{-- tahun ajaran aktif --}}
        <p>
            Tahun Ajaran Aktif :
            @if($tahunAjaranAktif)
                <span class="label label-success">{{ $tahunAjaranAktif->tahun }}</span>
            @else
                <span class="label label-danger">Tidak Ada</span>
            @endif
        </p>

        {{-- gelombang aktif --}}
        <p>
            Gelombang Aktif :
            @if($gelombangAktif)
                <span class="label label-success">{{ $gelombangAktif->nama_gelombang }}</span>
            @else
                <span class="label label-danger">Tidak Ada</span>
            @endif
        </p>

    </div>
</div>

{{-- ================= SETTING PPDB ================= --}}
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">
            <i class="fa fa-graduation-cap"></i> Setting PPDB
        </h3>
    </div>

    <div class="box-body">
        <div class="row">

            {{-- info tahun ajaran --}}
            <div class="col-md-4">
                <div class="form-group">
                    <label>PPDB Saat Ini</label>
                    <input type="text" class="form-control"
                        value="{{ $tahunAjaranAktif->tahun ?? '-' }}" readonly>
                </div>
            </div>

            {{-- status buka / tutup --}}
            <div class="col-md-4">
                <div class="form-group">
                    <label>Status PPDB</label>
                    <select name="ppdb_status" class="form-control"
                        {{ (!$tahunAjaranAktif || !$gelombangAktif) ? 'disabled' : '' }}>
                        <option value="buka" {{ setting('ppdb_status') == 'buka' ? 'selected' : '' }}>
                            DIBUKA
                        </option>
                        <option value="tutup" {{ setting('ppdb_status') == 'tutup' ? 'selected' : '' }}>
                            DITUTUP
                        </option>
                    </select>

                    @if(!$tahunAjaranAktif || !$gelombangAktif)
                        <small class="text-danger">
                            PPDB tidak dapat dibuka tanpa Tahun Ajaran & Gelombang aktif
                        </small>
                    @endif
                </div>
            </div>

            {{-- keterangan periode --}}
            <div class="col-md-4">
                <div class="form-group">
                    <label>Keterangan PPDB</label>
                    <input type="text" name="ppdb_period" class="form-control"
                        value="{{ setting('ppdb_period') }}">
                </div>
            </div>

        </div>

        <hr>

        {{-- status akses --}}
        <div class="row">
            <div class="col-md-4">
                <label>Akses Pendaftaran</label><br>
                @if(setting('ppdb_status') == 'buka')
                    <span class="label label-success">
                        <i class="fa fa-unlock"></i> AKTIF
                    </span>
                @else
                    <span class="label label-danger">
                        <i class="fa fa-lock"></i> NONAKTIF
                    </span>
                @endif
            </div>
        </div>

    </div>
</div>

{{-- ================= INFORMASI PONDOK ================= --}}
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">
            <i class="fa fa-university"></i> Informasi Pondok
        </h3>
    </div>

    <div class="box-body">
        <div class="row">

            {{-- data utama --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nama Pondok</label>
                    <input type="text" name="pondok_name" class="form-control"
                        value="{{ setting('pondok_name') }}">
                </div>

                <div class="form-group">
                    <label>Pimpinan</label>
                    <input type="text" name="pondok_leader" class="form-control"
                        value="{{ setting('pondok_leader') }}">
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="pondok_address" class="form-control" rows="3">{{ setting('pondok_address') }}</textarea>
                </div>
            </div>

            {{-- kontak --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>Telepon</label>
                    <input type="text" name="pondok_phone" class="form-control"
                        value="{{ setting('pondok_phone') }}">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="pondok_email" class="form-control"
                        value="{{ setting('pondok_email') }}">
                </div>

                <div class="form-group">
                    <label>Website</label>
                    <input type="text" name="pondok_website" class="form-control"
                        value="{{ setting('pondok_website') }}">
                </div>
            </div>

        </div>
    </div>
</div>

{{-- ================= MEDIA SOSIAL ================= --}}
<div class="box box-warning">
    <div class="box-header with-border">
        <h3 class="box-title">
            <i class="fa fa-phone"></i> Kontak & Media Sosial
        </h3>
    </div>

    <div class="box-body">
        <div class="row">
            <div class="col-md-4">
                <label>WhatsApp</label>
                <input type="text" name="contact_whatsapp" class="form-control"
                    value="{{ setting('contact_whatsapp') }}">
            </div>

            <div class="col-md-4">
                <label>Instagram</label>
                <input type="text" name="social_instagram" class="form-control"
                    value="{{ setting('social_instagram') }}">
            </div>

            <div class="col-md-4">
                <label>Facebook</label>
                <input type="text" name="social_facebook" class="form-control"
                    value="{{ setting('social_facebook') }}">
            </div>
        </div>
    </div>
</div>

{{-- ================= TOMBOL SIMPAN ================= --}}
<div class="text-right">
    <button class="btn btn-success"
        {{ (!$tahunAjaranAktif || !$gelombangAktif) ? 'disabled' : '' }}>
        <i class="fa fa-save"></i> Simpan Perubahan
    </button>
</div>

</form>

{{-- preview logo --}}
<script>
function previewLogo(input) {
    const reader = new FileReader();
    reader.onload = e => document.getElementById('logoPreview').src = e.target.result;
    reader.readAsDataURL(input.files[0]);
}
</script>

@endsection
