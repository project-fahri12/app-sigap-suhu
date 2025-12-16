@extends('layouts.masterDashboard')

@section('judul', 'Setting Site')
@section('sub-judul', 'Pengaturan Website & PPDB')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('admin.setting-web.update', 1) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- ================================================================= --}}
        {{-- 1. SETTING WEBSITE --}}
        {{-- ================================================================= --}}
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-globe"></i> Setting Website
                        </h3>
                    </div>

                    <div class="box-body row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Aplikasi</label>
                                <input type="text" name="app_name" class="form-control"
                                    value="{{ setting('app_name', 'SIGAP') }}">
                            </div>

                            <div class="form-group">
                                <label>Nama Sistem</label>
                                <input type="text" name="system_name" class="form-control"
                                    value="{{ setting('system_name') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>Logo Aplikasi</label>
                            <input type="file" name="logo_app" class="form-control" accept="image/*"
                                onchange="previewLogo(this)">

                            <div style="margin-top:10px">
                                <img id="logoPreview" src="{{ asset(setting('logo_app', 'assets/logo-sigap.svg')) }}"
                                    style="height:80px">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================================================================= --}}
        {{-- 2. SETTING PPDB --}}
        {{-- ================================================================= --}}
        <div class="row">
            <div class="col-md-12">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-graduation-cap"></i> Setting PPDB
                        </h3>
                    </div>

                    <div class="box-body">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>PPDB Saat Ini</label>
                                    <input type="text" name="ppdb_academic_year" class="form-control"
                                        value="{{ setting('ppdb_academic_year') }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label>Status PPDB</label>
                                <select name="ppdb_status" class="form-control">
                                    <option value="buka" {{ setting('ppdb_status') == 'buka' ? 'selected' : '' }}>
                                        DIBUKA
                                    </option>
                                    <option value="tutup" {{ setting('ppdb_status') == 'tutup' ? 'selected' : '' }}>
                                        DITUTUP
                                    </option>
                                </select>
                                <small class="text-danger">
                                    * Harus ada gelombang aktif
                                </small>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <input type="text" name="ppdb_period" class="form-control"
                                        value="{{ setting('ppdb_period') }}">
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Gelombang Aktif</label>
                                    <input type="text" name="ppdb_active_wave" class="form-control"
                                        value="{{ setting('ppdb_active_wave') }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label>Akses Pendaftaran</label><br>
                                @if (setting('ppdb_status') == 'buka')
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
            </div>
        </div>

        {{-- ================================================================= --}}
        {{-- 3. INFORMASI PONDOK PESANTREN --}}
        {{-- ================================================================= --}}
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-university"></i> Informasi Pondok Pesantren
                        </h3>
                    </div>

                    <div class="box-body row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Nama Pondok</label>
                                <input type="text" name="pondok_name" class="form-control"
                                    value="{{ setting('pondok_name') }}" placeholder="Nama Pondok Pesantren">
                            </div>

                            <div class="form-group">
                                <label>Pengasuh / Pimpinan</label>
                                <input type="text" name="pondok_leader" class="form-control"
                                    value="{{ setting('pondok_leader') }}" placeholder="Nama Pengasuh">
                            </div>

                            <div class="form-group">
                                <label>Alamat Pondok</label>
                                <textarea name="pondok_address" class="form-control" rows="3" placeholder="Alamat lengkap pondok">{{ setting('pondok_address') }}</textarea>
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Nomor Telepon</label>
                                <input type="text" name="pondok_phone" class="form-control"
                                    value="{{ setting('pondok_phone') }}" placeholder="Contoh: 0812xxxxxxx">
                            </div>

                            <div class="form-group">
                                <label>Email Resmi</label>
                                <input type="email" name="pondok_email" class="form-control"
                                    value="{{ setting('pondok_email') }}" placeholder="email@pondok.ac.id">
                            </div>

                            <div class="form-group">
                                <label>Website</label>
                                <input type="text" name="pondok_website" class="form-control"
                                    value="{{ setting('pondok_website') }}" placeholder="https://website-pondok.sch.id">
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- ================================================================= --}}
        {{-- 4. KONTAK & MEDIA SOSIAL --}}
        {{-- ================================================================= --}}
        <div class="row">
            <div class="col-md-12">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-phone"></i> Kontak & Media Sosial
                        </h3>
                    </div>

                    <div class="box-body row">
                        <div class="col-md-4">
                            <input type="text" name="contact_whatsapp" class="form-control"
                                value="{{ setting('contact_whatsapp') }}">
                        </div>

                        <div class="col-md-4">
                            <input type="text" name="social_instagram" class="form-control"
                                value="{{ setting('social_instagram') }}">
                        </div>

                        <div class="col-md-4">
                            <input type="text" name="social_facebook" class="form-control"
                                value="{{ setting('social_facebook') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-right">
            <button class="btn btn-success">
                <i class="fa fa-save"></i> Simpan Perubahan
            </button>
        </div>

    </form>

    {{-- PREVIEW LOGO --}}
    <script>
        function previewLogo(input) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('logoPreview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    </script>

@endsection
