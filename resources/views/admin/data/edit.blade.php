@extends('layouts.masterDashboard')

@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Edit Data Pendaftar</h3>
    </div>

    <form action="{{ route('admin.data-pendaftar.update', $pendaftar->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="box-body">
            {{-- TAB NAVIGATION --}}
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#pendaftar" data-toggle="tab">DATA PENDAFTAR</a>
                </li>
                <li>
                    <a href="#orangtua" data-toggle="tab">DATA ORANG TUA</a>
                </li>
                <li>
                    <a href="#wali" data-toggle="tab">DATA WALI SANTRI</a>
                </li>
            </ul>

            {{-- TAB CONTENT --}}
            <div class="tab-content" style="margin-top:20px;">

                {{-- ================= TAB PENDAFTAR ================= --}}
                <div class="tab-pane active" id="pendaftar">
                    <div class="row">
                        <div class="col-md-6">
                            <label>NIK</label>
                            <input type="text" name="nik" class="form-control"
                                   value="{{ old('nik', $pendaftar->nik) }}">
                        </div>

                        <div class="col-md-6">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control"
                                   value="{{ old('nama_lengkap', strtoupper($pendaftar->nama_lengkap)) }}">
                        </div>

                        <div class="col-md-4">
                            <label>Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control"
                                   value="{{ old('tempat_lahir', strtoupper($pendaftar->tempat_lahir)) }}">
                        </div>

                        <div class="col-md-4">
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control"
                                   value="{{ old('tanggal_lahir', $pendaftar->tanggal_lahir) }}">
                        </div>

                        <div class="col-md-4">
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control">
                                <option value="">Pilih</option>
                                <option value="L" {{ old('jenis_kelamin', $pendaftar->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin', $pendaftar->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Status Santri</label>
                            <select name="status_santri" class="form-control">
                                <option value="">Pilih</option>
                                <option value="mukim" {{ old('status_santri', $pendaftar->status_santri) == 'mukim' ? 'selected' : '' }}>Mukim</option>
                                <option value="non_mukim" {{ old('status_santri', $pendaftar->status_santri) == 'non_mukim' ? 'selected' : '' }}>Non Mukim</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Asal Sekolah</label>
                            <input type="text" name="asal_sekolah" class="form-control"
                                   value="{{ old('asal_sekolah', strtoupper($pendaftar->asal_sekolah)) }}">
                        </div>

                        <div class="col-md-3">
                            <label>Provinsi</label>
                            <input type="text" name="provinsi" class="form-control"
                                   value="{{ old('provinsi', strtoupper($pendaftar->provinsi)) }}">
                        </div>

                        <div class="col-md-3">
                            <label>Kabupaten</label>
                            <input type="text" name="kabupaten" class="form-control"
                                   value="{{ old('kabupaten', strtoupper($pendaftar->kabupaten)) }}">
                        </div>

                        <div class="col-md-3">
                            <label>Kecamatan</label>
                            <input type="text" name="kecamatan" class="form-control"
                                   value="{{ old('kecamatan', strtoupper($pendaftar->kecamatan)) }}">
                        </div>

                        <div class="col-md-3">
                            <label>Desa</label>
                            <input type="text" name="desa" class="form-control"
                                   value="{{ old('desa', strtoupper($pendaftar->desa)) }}">
                        </div>

                        <div class="col-md-2">
                            <label>RT</label>
                            <input type="text" name="rt" class="form-control"
                                   value="{{ old('rt', $pendaftar->rt) }}">
                        </div>

                        <div class="col-md-2">
                            <label>RW</label>
                            <input type="text" name="rw" class="form-control"
                                   value="{{ old('rw', $pendaftar->rw) }}">
                        </div>

                        <div class="col-md-8">
                            <label>Alamat Detail</label>
                            <textarea name="alamat_detail" class="form-control" rows="2">{{ old('alamat_detail', strtoupper($pendaftar->alamat_detail)) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- ================= TAB ORANG TUA ================= --}}
                <div class="tab-pane" id="orangtua">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Nama Ayah</label>
                            <input type="text" name="nama_ayah" class="form-control"
                                   value="{{ old('nama_ayah', strtoupper(optional($pendaftar->orangTua)->nama_ayah)) }}">
                        </div>

                        <div class="col-md-6">
                            <label>Pekerjaan Ayah</label>
                            <input type="text" name="pekerjaan_ayah" class="form-control"
                                   value="{{ old('pekerjaan_ayah', strtoupper(optional($pendaftar->orangTua)->pekerjaan_ayah)) }}">
                        </div>

                        <div class="col-md-6">
                            <label>No HP Ayah</label>
                            <input type="text" name="no_hp_ayah" class="form-control"
                                   value="{{ old('no_hp_ayah', optional($pendaftar->orangTua)->no_hp_ayah) }}">
                        </div>

                        <div class="col-md-6">
                            <label>Status Ayah</label>
                            <select name="status_ayah" class="form-control">
                                <option value="">Pilih</option>
                                @foreach(['hidup','meninggal','tidak_diketahui'] as $v)
                                    <option value="{{ $v }}" {{ old('status_ayah', optional($pendaftar->orangTua)->status_ayah) == $v ? 'selected' : '' }}>
                                        {{ strtoupper(str_replace('_',' ',$v)) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Nama Ibu</label>
                            <input type="text" name="nama_ibu" class="form-control"
                                   value="{{ old('nama_ibu', strtoupper(optional($pendaftar->orangTua)->nama_ibu)) }}">
                        </div>

                        <div class="col-md-6">
                            <label>Pekerjaan Ibu</label>
                            <input type="text" name="pekerjaan_ibu" class="form-control"
                                   value="{{ old('pekerjaan_ibu', strtoupper(optional($pendaftar->orangTua)->pekerjaan_ibu)) }}">
                        </div>

                        <div class="col-md-6">
                            <label>No HP Ibu</label>
                            <input type="text" name="no_hp_ibu" class="form-control"
                                   value="{{ old('no_hp_ibu', optional($pendaftar->orangTua)->no_hp_ibu) }}">
                        </div>

                        <div class="col-md-6">
                            <label>Status Ibu</label>
                            <select name="status_ibu" class="form-control">
                                <option value="">Pilih</option>
                                @foreach(['hidup','meninggal','tidak_diketahui'] as $v)
                                    <option value="{{ $v }}" {{ old('status_ibu', optional($pendaftar->orangTua)->status_ibu) == $v ? 'selected' : '' }}>
                                        {{ strtoupper(str_replace('_',' ',$v)) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label>Alamat Orang Tua</label>
                            <textarea name="alamat_orang_tua" class="form-control" rows="3">{{ old('alamat_orang_tua', strtoupper(optional($pendaftar->orangTua)->alamat_orang_tua)) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- ================= TAB WALI ================= --}}
                <div class="tab-pane" id="wali">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Nama Wali</label>
                            <input type="text" name="nama_wali" class="form-control"
                                   value="{{ old('nama_wali', strtoupper(optional($pendaftar->waliSantri)->nama_wali)) }}">
                        </div>

                        <div class="col-md-6">
                            <label>Pekerjaan Wali</label>
                            <input type="text" name="pekerjaan_wali" class="form-control"
                                   value="{{ old('pekerjaan_wali', strtoupper(optional($pendaftar->waliSantri)->pekerjaan_wali)) }}">
                        </div>

                        <div class="col-md-6">
                            <label>Hubungan Wali</label>
                            <select name="hubungan_wali" class="form-control">
                                <option value="">Pilih</option>
                                @foreach(['ayah','ibu','paman','bibi','kakek','nenek','lainnya'] as $v)
                                    <option value="{{ $v }}" {{ old('hubungan_wali', optional($pendaftar->waliSantri)->hubungan_wali) == $v ? 'selected' : '' }}>
                                        {{ strtoupper($v) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>No HP Wali</label>
                            <input type="text" name="no_hp_wali" class="form-control"
                                   value="{{ old('no_hp_wali', optional($pendaftar->waliSantri)->no_hp_wali) }}">
                        </div>

                        <div class="col-md-12">
                            <label>Alamat Wali</label>
                            <textarea name="alamat_wali" class="form-control" rows="3">{{ old('alamat_wali', strtoupper(optional($pendaftar->waliSantri)->alamat_wali)) }}</textarea>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="box-footer text-right">
            <button class="btn btn-primary">
                <i class="fa fa-save"></i> SIMPAN PERUBAHAN
            </button>
        </div>
    </form>
</div>
@endsection
