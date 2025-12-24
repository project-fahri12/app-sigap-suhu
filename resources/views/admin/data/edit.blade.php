@extends('layouts.masterDashboard')

@section('judul', 'Manajemen Pendaftaran')
@section('sub-judul', 'Koreksi Data Santri')

@section('content')
<style>
    /* KONSISTENSI UI DENGAN HALAMAN DETAIL */
    .box { border-radius: 12px; border-top: 3px solid #3c8dbc; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05); }
    
    /* Modern Tabs */
    .nav-tabs-custom { border-radius: 12px; overflow: hidden; box-shadow: none; border: 1px solid #eee; }
    .nav-tabs-custom > .nav-tabs > li > a { font-weight: 600; color: #777; padding: 12px 20px; transition: 0.3s; }
    .nav-tabs-custom > .nav-tabs > li.active > a { color: #3c8dbc; border-top-color: transparent; background: #fff; }
    .nav-tabs-custom > .nav-tabs > li:not(.active) > a:hover { background: #f9f9f9; color: #3c8dbc; }

    /* Form Styling */
    .form-group label { font-weight: 700; color: #555; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; }
    .form-control { border-radius: 6px; border: 1px solid #d2d6de; padding: 10px 12px; height: auto; transition: border-color 0.2s; }
    .form-control:focus { border-color: #3c8dbc; box-shadow: none; }
    
    /* Section Divider */
    .section-title { font-size: 14px; font-weight: 700; color: #3c8dbc; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px dashed #eee; display: block; }
    
    .btn-save { border-radius: 50px; padding: 10px 30px; font-weight: 700; box-shadow: 0 4px 10px rgba(60, 141, 188, 0.3); }
</style>

<div class="row">
    <div class="col-md-12">
        <div style="margin-bottom: 15px;">
            <a href="{{ route('admin.data-pendaftar.index') }}" class="btn btn-default btn-sm" style="border-radius: 6px;">
                <i class="fa fa-arrow-left"></i> Batal & Kembali
            </a>
        </div>

        <div class="box box-primary">
            <div class="box-header with-border" style="padding: 20px;">
                <h3 class="box-title" style="font-weight: 700;">
                    <i class="fa fa-edit text-blue"></i> EDIT DATA: {{ strtoupper($pendaftar->nama_lengkap) }}
                </h3>
                <span class="pull-right text-muted">ID: #{{ $pendaftar->kode_pendaftaran }}</span>
            </div>

            <form action="{{ route('admin.data-pendaftar.update', $pendaftar->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="box-body" style="padding: 0;">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#pendaftar" data-toggle="tab"><i class="fa fa-user"></i> BIODATA SANTRI</a>
                            </li>
                            <li>
                                <a href="#orangtua" data-toggle="tab"><i class="fa fa-users"></i> DATA ORANG TUA</a>
                            </li>
                            <li>
                                <a href="#wali" data-toggle="tab"><i class="fa fa-shield"></i> DATA WALI</a>
                            </li>
                        </ul>

                        <div class="tab-content" style="padding: 30px;">
                            
                            {{-- ================= TAB PENDAFTAR ================= --}}
                            <div class="tab-pane active" id="pendaftar">
                                <span class="section-title"><i class="fa fa-info-circle"></i> Informasi Identitas Utama</span>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>NIK (No. Induk Kependudukan)</label>
                                            <input type="text" name="nik" class="form-control" placeholder="16 Digit NIK"
                                                   value="{{ old('nik', $pendaftar->nik) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama Lengkap Santri</label>
                                            <input type="text" name="nama_lengkap" class="form-control" 
                                                   value="{{ old('nama_lengkap', strtoupper($pendaftar->nama_lengkap)) }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tempat Lahir</label>
                                            <input type="text" name="tempat_lahir" class="form-control"
                                                   value="{{ old('tempat_lahir', strtoupper($pendaftar->tempat_lahir)) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tanggal Lahir</label>
                                            <input type="date" name="tanggal_lahir" class="form-control"
                                                   value="{{ old('tanggal_lahir', $pendaftar->tanggal_lahir) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <select name="jenis_kelamin" class="form-control">
                                                <option value="L" {{ old('jenis_kelamin', $pendaftar->jenis_kelamin) == 'L' ? 'selected' : '' }}>LAKI-LAKI</option>
                                                <option value="P" {{ old('jenis_kelamin', $pendaftar->jenis_kelamin) == 'P' ? 'selected' : '' }}>PEREMPUAN</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Asal Sekolah</label>
                                            <input type="text" name="asal_sekolah" class="form-control"
                                                   value="{{ old('asal_sekolah', strtoupper($pendaftar->asal_sekolah)) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status Santri</label>
                                            <select name="status_santri" class="form-control">
                                                <option value="mukim" {{ old('status_santri', $pendaftar->status_santri) == 'mukim' ? 'selected' : '' }}>MUKIM (MENETAP)</option>
                                                <option value="non_mukim" {{ old('status_santri', $pendaftar->status_santri) == 'non_mukim' ? 'selected' : '' }}>NON-MUKIM (PULANG PERGI)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <span class="section-title" style="margin-top: 20px;"><i class="fa fa-map-marker"></i> Alamat Lengkap</span>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group"><label>Provinsi</label>
                                        <input type="text" name="provinsi" class="form-control" value="{{ old('provinsi', strtoupper($pendaftar->provinsi)) }}"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group"><label>Kabupaten</label>
                                        <input type="text" name="kabupaten" class="form-control" value="{{ old('kabupaten', strtoupper($pendaftar->kabupaten)) }}"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group"><label>Kecamatan</label>
                                        <input type="text" name="kecamatan" class="form-control" value="{{ old('kecamatan', strtoupper($pendaftar->kecamatan)) }}"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group"><label>Desa</label>
                                        <input type="text" name="desa" class="form-control" value="{{ old('desa', strtoupper($pendaftar->desa)) }}"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group"><label>RT</label>
                                        <input type="text" name="rt" class="form-control" value="{{ old('rt', $pendaftar->rt) }}"></div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group"><label>RW</label>
                                        <input type="text" name="rw" class="form-control" value="{{ old('rw', $pendaftar->rw) }}"></div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group"><label>Detail Jalan / No. Rumah</label>
                                        <textarea name="alamat_detail" class="form-control" rows="2" placeholder="Contoh: Jl. Pesantren No. 123">{{ old('alamat_detail', strtoupper($pendaftar->alamat_detail)) }}</textarea></div>
                                    </div>
                                </div>
                            </div>

                            {{-- ================= TAB ORANG TUA ================= --}}
                            <div class="tab-pane" id="orangtua">
                                <div class="row">
                                    <div class="col-md-6" style="border-right: 1px solid #eee;">
                                        <span class="section-title text-blue">DATA AYAH</span>
                                        <div class="form-group">
                                            <label>Nama Lengkap Ayah</label>
                                            <input type="text" name="nama_ayah" class="form-control" value="{{ old('nama_ayah', strtoupper(optional($pendaftar->orangTua)->nama_ayah)) }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Pekerjaan Ayah</label>
                                            <input type="text" name="pekerjaan_ayah" class="form-control" value="{{ old('pekerjaan_ayah', strtoupper(optional($pendaftar->orangTua)->pekerjaan_ayah)) }}">
                                        </div>
                                        <div class="form-group">
                                            <label>No. HP / WhatsApp Ayah</label>
                                            <input type="text" name="no_hp_ayah" class="form-control" value="{{ old('no_hp_ayah', optional($pendaftar->orangTua)->no_hp_ayah) }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Status Ayah</label>
                                            <select name="status_ayah" class="form-control">
                                                @foreach(['hidup','meninggal','tidak_diketahui'] as $v)
                                                    <option value="{{ $v }}" {{ old('status_ayah', optional($pendaftar->orangTua)->status_ayah) == $v ? 'selected' : '' }}>{{ strtoupper(str_replace('_',' ',$v)) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <span class="section-title text-red">DATA IBU</span>
                                        <div class="form-group">
                                            <label>Nama Lengkap Ibu</label>
                                            <input type="text" name="nama_ibu" class="form-control" value="{{ old('nama_ibu', strtoupper(optional($pendaftar->orangTua)->nama_ibu)) }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Pekerjaan Ibu</label>
                                            <input type="text" name="pekerjaan_ibu" class="form-control" value="{{ old('pekerjaan_ibu', strtoupper(optional($pendaftar->orangTua)->pekerjaan_ibu)) }}">
                                        </div>
                                        <div class="form-group">
                                            <label>No. HP / WhatsApp Ibu</label>
                                            <input type="text" name="no_hp_ibu" class="form-control" value="{{ old('no_hp_ibu', optional($pendaftar->orangTua)->no_hp_ibu) }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Status Ibu</label>
                                            <select name="status_ibu" class="form-control">
                                                @foreach(['hidup','meninggal','tidak_diketahui'] as $v)
                                                    <option value="{{ $v }}" {{ old('status_ibu', optional($pendaftar->orangTua)->status_ibu) == $v ? 'selected' : '' }}>{{ strtoupper(str_replace('_',' ',$v)) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12 mt-3">
                                        <div class="form-group">
                                            <label>Alamat Orang Tua (Jika Berbeda dengan Santri)</label>
                                            <textarea name="alamat_orang_tua" class="form-control" rows="2">{{ old('alamat_orang_tua', strtoupper(optional($pendaftar->orangTua)->alamat_orang_tua)) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- ================= TAB WALI ================= --}}
                            <div class="tab-pane" id="wali">
                                <div class="callout callout-info" style="border-radius: 8px;">
                                    <h4><i class="icon fa fa-info"></i> Info</h4>
                                    <p>Hanya diisi jika santri tinggal bersama wali (bukan orang tua kandung).</p>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"><label>Nama Lengkap Wali</label>
                                        <input type="text" name="nama_wali" class="form-control" value="{{ old('nama_wali', strtoupper(optional($pendaftar->waliSantri)->nama_wali)) }}"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"><label>Hubungan Wali</label>
                                        <select name="hubungan_wali" class="form-control">
                                            <option value="">-- Pilih Hubungan --</option>
                                            @foreach(['ayah','ibu','paman','bibi','kakek','nenek','lainnya'] as $v)
                                                <option value="{{ $v }}" {{ old('hubungan_wali', optional($pendaftar->waliSantri)->hubungan_wali) == $v ? 'selected' : '' }}>{{ strtoupper($v) }}</option>
                                            @endforeach
                                        </select></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"><label>Pekerjaan Wali</label>
                                        <input type="text" name="pekerjaan_wali" class="form-control" value="{{ old('pekerjaan_wali', strtoupper(optional($pendaftar->waliSantri)->pekerjaan_wali)) }}"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"><label>No. HP Wali</label>
                                        <input type="text" name="no_hp_wali" class="form-control" value="{{ old('no_hp_wali', optional($pendaftar->waliSantri)->no_hp_wali) }}"></div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group"><label>Alamat Wali</label>
                                        <textarea name="alamat_wali" class="form-control" rows="3">{{ old('alamat_wali', strtoupper(optional($pendaftar->waliSantri)->alamat_wali)) }}</textarea></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="box-footer" style="background: #fcfcfc; padding: 20px; border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
                    <div class="pull-left text-muted">
                        <small><i class="fa fa-info-circle"></i> Pastikan semua data yang diubah telah diverifikasi kebenarannya.</small>
                    </div>
                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-save">
                            <i class="fa fa-save"></i> SIMPAN PERUBAHAN DATA
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection