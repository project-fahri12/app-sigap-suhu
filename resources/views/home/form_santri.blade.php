@extends('layouts.app')

@section('content')
    <div class="ppdb-container text-start">

        <h4 class="text-center text-success mb-3">PPDB | Madrasah Muallimin Muallimat 6 Tahun</h4>
        <h5 class="text-center mb-4">Bahrul 'Ulum Tambakberas Jombang</h5>

        {{-- Alert Persiapan Berkas --}}
        <div class="alert alert-success d-flex align-items-start" role="alert">
            <i class="fa fa-exclamation-triangle me-2 mt-1"></i>
            <div>
                **PERHATIAN:**
                <ul class="mb-0 mt-1 small ps-3">
                    <li>Mohon isi semua data yang bertanda **<span class="text-danger">*</span>** dengan lengkap dan benar.
                    </li>
                    <li>Setelah formulir ini disimpan, Anda akan mendapatkan **Kode Pendaftaran** untuk proses selanjutnya
                        (pembayaran & upload berkas).</li>
                </ul>
            </div>
        </div>

        <h5 class="mb-3">Isi formulir pendaftaran di bawah ini:</h5>

        <ul class="nav nav-tabs border-0 flex-row " id="pendaftaranTabs" role="tablist">

            {{-- Tab 1: Data Calon Peserta --}}
            <li class="nav-item mx-2" role="presentation ">
                {{-- 'w-100' agar tombol penuh di mobile, 'rounded' untuk estetika saat terpisah --}}
                <button class="nav-link active w-100 h-100 border text-start text-sm-center" id="peserta-tab"
                    data-bs-toggle="tab" data-bs-target="#peserta-pane" type="button" role="tab"
                    aria-controls="peserta-pane" aria-selected="true">
                    <i class="fa fa-user me-2"></i> Data Calon Peserta
                </button>
            </li>

            {{-- Tab 2: Data Orang Tua / Wali --}}
            <li class="nav-item" role="presentation">
                <button class="nav-link w-100 h-100 border text-start text-sm-center" id="ortu-tab" data-bs-toggle="tab"
                    data-bs-target="#ortu-pane" type="button" role="tab" aria-controls="ortu-pane"
                    aria-selected="false">
                    <i class="fa fa-users me-2"></i> Data Orang Tua / Wali
                </button>
            </li>
        </ul>

        {{-- FORMULIR UTAMA --}}
        <form method="POST" action="{{ route('pendaftaran.store') }}">
            @csrf

            {{-- Tab Content --}}
            <div class="tab-content pt-3" id="pendaftaranTabsContent">

                {{-- ---------------------------------------------- --}}
                {{-- TAB 1: DATA CALON PESERTA (tabel: pendaftar) --}}
                {{-- ---------------------------------------------- --}}
                <div class="tab-pane fade show active" id="peserta-pane" role="tabpanel" aria-labelledby="peserta-tab"
                    tabindex="0">

                    {{-- CARD 1: DATA PRIBADI --}}
<div class="card shadow-sm border-0 rounded-3">
    <div class="card-header bg-success text-white d-flex align-items-center py-3">
        <i class="fas fa-user-graduate me-2"></i>
        <h6 class="m-0 fw-bold">Data Pribadi Calon Peserta</h6>
    </div>
    
    <div class="card-body p-4">
        <div class="row g-3">
            {{-- Nama Lengkap --}}
            <div class="col-md-8">
                <label for="nama_lengkap" class="form-label fw-bold small">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror"
                    id="nama_lengkap" name="nama_lengkap" placeholder="Sesuai Ijazah / Kartu Keluarga"
                    value="{{ old('nama_lengkap') }}" required>
                @error('nama_lengkap')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- NIK --}}
            <div class="col-md-4">
                <label for="nik" class="form-label fw-bold small">NIK (16 Digit) <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('nik') is-invalid @enderror"
                    id="nik" name="nik" placeholder="35xxxxxxxxxxxxxx"
                    value="{{ old('nik') }}" maxlength="16" minlength="16" 
                    oninput="this.value=this.value.replace(/[^0-9]/g,'')" required>
                @error('nik')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tempat Lahir --}}
            <div class="col-md-4">
                <label for="tempat_lahir" class="form-label fw-bold small">Tempat Lahir <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                    id="tempat_lahir" name="tempat_lahir" placeholder="Kota/Kabupaten"
                    value="{{ old('tempat_lahir') }}" required>
                @error('tempat_lahir')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tanggal Lahir --}}
            <div class="col-md-4">
                <label for="tanggal_lahir" class="form-label fw-bold small">Tanggal Lahir <span class="text-danger">*</span></label>
                <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                    id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                @error('tanggal_lahir')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Jenis Kelamin --}}
            <div class="col-md-4">
                <label class="form-label fw-bold small">Jenis Kelamin <span class="text-danger">*</span></label>
                <div class="d-flex gap-4 mt-2">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="L" value="L"
                            {{ old('jenis_kelamin') == 'L' ? 'checked' : '' }} required>
                        <label class="form-check-label small" for="L">Laki-laki</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="P" value="P"
                            {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }} required>
                        <label class="form-check-label small" for="P">Perempuan</label>
                    </div>
                </div>
                @error('jenis_kelamin')
                    <div class="text-danger" style="font-size: 0.875em;">{{ $message }}</div>
                @enderror
            </div>

            {{-- Asal Sekolah --}}
            <div class="col-12">
                <label for="asal_sekolah" class="form-label fw-bold small">Asal Sekolah Sebelumnya <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('asal_sekolah') is-invalid @enderror"
                    id="asal_sekolah" name="asal_sekolah"
                    placeholder="Contoh: MI Bahrul Ulum Jombang" value="{{ old('asal_sekolah') }}" required>
                @error('asal_sekolah')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12"><hr class="my-2 opacity-25"></div>

            {{-- ALAMAT BERANTAI --}}
            <div class="col-md-6">
                <label class="form-label fw-bold small text-muted">Provinsi <span class="text-danger">*</span></label>
                <select id="provinsi" name="provinsi_id" class="form-select @error('provinsi_id') is-invalid @enderror" required>
                    <option value="">Pilih Provinsi</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold small text-muted">Kabupaten / Kota <span class="text-danger">*</span></label>
                <select id="kabupaten" name="kabupaten_id" class="form-select @error('kabupaten_id') is-invalid @enderror" disabled required>
                    <option value="">Pilih Kabupaten / Kota</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold small text-muted">Kecamatan <span class="text-danger">*</span></label>
                <select id="kecamatan" name="kecamatan_id" class="form-select @error('kecamatan_id') is-invalid @enderror" disabled required>
                    <option value="">Pilih Kecamatan</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold small text-muted">Desa / Kelurahan <span class="text-danger">*</span></label>
                <select id="desa" name="desa_id" class="form-select @error('desa_id') is-invalid @enderror" disabled required>
                    <option value="">Pilih Desa / Kelurahan</option>
                </select>
            </div>

            {{-- RT / RW --}}
            <div class="col-md-4">
                <label class="form-label fw-bold small text-muted">RT / RW <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text bg-light small">RT</span>
                    <input type="text" name="rt" class="form-control" placeholder="000" maxlength="3" 
                        oninput="this.value=this.value.replace(/[^0-9]/g,'')" value="{{ old('rt') }}" required>
                    <span class="input-group-text bg-light small">RW</span>
                    <input type="text" name="rw" class="form-control" placeholder="000" maxlength="3" 
                        oninput="this.value=this.value.replace(/[^0-9]/g,'')" value="{{ old('rw') }}" required>
                </div>
            </div>

            {{-- Alamat Detail --}}
            <div class="col-md-8">
                <label class="form-label fw-bold small text-muted">Alamat Detail (Dusun/Nama Jalan) <span class="text-danger">*</span></label>
                <textarea name="alamat_detail" class="form-control @error('alamat_detail') is-invalid @enderror" 
                    rows="1" placeholder="Nama Dusun, Lingkungan, atau Jalan" required>{{ old('alamat_detail') }}</textarea>
                @error('alamat_detail')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>
                    {{-- CARD 2 : INFORMASI PENDAFTARAN --}}
                    <div class="card shadow-sm border-0 mt-4">
                        <div class="card-header bg-primary text-white d-flex align-items-center">
                            <i class="fas fa-info-circle me-2"></i>
                            <h6 class="m-0 fw-bold">Pilihan Pendaftaran</h6>
                        </div>
                        <div class="card-body bg-light-subtle">
                            <div class="row g-3">
                                {{-- Tahun Ajaran --}}
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold text-muted small">Tahun Ajaran</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white"><i
                                                class="fas fa-calendar-alt text-primary"></i></span>
                                        <input type="text" class="form-control bg-white"
                                            value="{{ $tahun_ajaran->tahun ?? 'N/A' }}" readonly>
                                    </div>
                                    <input type="hidden" name="tahun_ajaran_id" value="{{ $tahun_ajaran->id ?? '' }}">
                                </div>

                                {{-- Gelombang --}}
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold text-muted small">Gelombang</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white"><i
                                                class="fas fa-layer-group text-primary"></i></span>
                                        <input type="text" class="form-control bg-white"
                                            value="{{ $gelombang->nama_gelombang ?? 'N/A' }}" readonly>
                                    </div>
                                    <input type="hidden" name="gelombang_id" value="{{ $gelombang->id ?? '' }}">
                                </div>

                                {{-- Unit Tujuan --}}
                                <div class="col-md-4">
                                    <label for="unit_id" class="form-label fw-semibold small">Unit Tujuan <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select @error('unit_id') is-invalid @enderror" id="unit_id"
                                        name="unit_id" required>
                                        <option value="">-- Pilih Unit --</option>
                                        @foreach ($unit_options ?? [] as $unit)
                                            <option value="{{ $unit->id }}"
                                                {{ old('unit_id') == $unit->id ? 'selected' : '' }}>
                                                {{ $unit->nama_unit }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('unit_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Pilihan Sekolah --}}
                                <div class="col-md-6">
                                    <label for="sekolah_pilihan_id" class="form-label fw-semibold small">Pilihan Sekolah
                                        <span class="text-danger">*</span></label>
                                    <select class="form-select @error('sekolah_pilihan_id') is-invalid @enderror"
                                        id="sekolah_pilihan_id" name="sekolah_pilihan_id" required>
                                        <option value="">-- Pilih Sekolah --</option>
                                        @foreach ($sekolah_options ?? [] as $sek)
                                            <option value="{{ $sek->id }}"
                                                {{ old('sekolah_pilihan_id') == $sek->id ? 'selected' : '' }}>
                                                {{ $sek->nama_sekolah }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('sekolah_pilihan_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Status Santri --}}
                                <div class="col-md-6">
                                    <label for="status_santri" class="form-label fw-semibold small">Status Santri <span
                                            class="text-danger">*</span></label>
                                    <select name="status_santri" id="status_santri"
                                        class="form-select @error('status_santri') is-invalid @enderror" required>
                                        <option value="">-- Pilih Status --</option>
                                        <option value="mukim" {{ old('status_santri') == 'mukim' ? 'selected' : '' }}>
                                            Mukim (Tinggal di Pondok)</option>
                                        <option value="non_mukim"
                                            {{ old('status_santri') == 'non_mukim' ? 'selected' : '' }}>Non Mukim (Pulang
                                            Pergi)</option>
                                    </select>
                                    @error('status_santri')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>



                    {{-- NAVIGATION BUTTONS --}}
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <span class="text-muted small"><span class="text-danger">*</span> Wajib diisi</span>
                        <button type="button" class="btn btn-primary px-4 shadow-sm"
                            onclick="document.getElementById('ortu-tab').click()">
                            Lanjut <i class="fas fa-chevron-right ms-2"></i>
                        </button>
                    </div>
                </div>
                {{-- ---------------------------------------------- --}}
                {{-- TAB 2: DATA ORANG TUA / WALI (tabel: orang_tua, wali_santri) --}}
                {{-- ---------------------------------------------- --}}
                <div class="tab-pane fade" id="ortu-pane" role="tabpanel" aria-labelledby="ortu-tab" tabindex="0">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-info text-white">
                            <h6 class="m-0"><i class="fa fa-users me-1"></i> Data Orang Tua Kandung (Wajib Diisi)</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                {{-- BAGIAN DATA AYAH --}}
                                <h6 class="mt-2 mb-3 pb-1 border-bottom" style="color: var(--sigap-blue);"><i
                                        class="fa fa-male me-1"></i> Data Ayah Kandung</h6>

                                {{-- 1. Nama Ayah (orang_tua.nama_ayah) --}}
                                <div class="col-md-6 mb-3">
                                    <label for="nama_ayah" class="form-label">Nama Ayah <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nama_ayah') is-invalid @enderror"
                                        id="nama_ayah" name="nama_ayah" placeholder="Nama Ayah Sesuai KK" required
                                        value="{{ old('nama_ayah') }}">
                                    @error('nama_ayah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- 2. Pekerjaan Ayah (orang_tua.pekerjaan_ayah) --}}
                                <div class="col-md-6 mb-3">
                                    <label for="pekerjaan_ayah" class="form-label">Pekerjaan Ayah</label>
                                    <input type="text"
                                        class="form-control @error('pekerjaan_ayah') is-invalid @enderror"
                                        id="pekerjaan_ayah" name="pekerjaan_ayah" placeholder="Contoh: Wiraswasta/PNS"
                                        value="{{ old('pekerjaan_ayah') }}">
                                    @error('pekerjaan_ayah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- 3. No HP Ayah (orang_tua.no_hp_ayah) --}}
                                <div class="col-md-6 mb-3">
                                    <label for="no_hp_ayah" class="form-label">No. HP Ayah</label>
                                    <input type="tel" class="form-control @error('no_hp_ayah') is-invalid @enderror"
                                        id="no_hp_ayah" name="no_hp_ayah" placeholder="08xxxxxxxxx (Aktif WA Disarankan)"
                                        value="{{ old('no_hp_ayah') }}">
                                    @error('no_hp_ayah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- 4. Status Ayah (orang_tua.status_ayah) --}}
                                <div class="col-md-6 mb-3">
                                    <label for="status_ayah" class="form-label">Status Ayah <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select @error('status_ayah') is-invalid @enderror"
                                        id="status_ayah" name="status_ayah" required>
                                        <option value="">--Pilih Status--</option>
                                        <option value="hidup" {{ old('status_ayah') == 'hidup' ? 'selected' : '' }}>Hidup
                                        </option>
                                        <option value="meninggal"
                                            {{ old('status_ayah') == 'meninggal' ? 'selected' : '' }}>
                                            Meninggal</option>
                                        <option value="tidak_diketahui"
                                            {{ old('status_ayah') == 'tidak_diketahui' ? 'selected' : '' }}>Tidak
                                            Diketahui
                                        </option>
                                    </select>
                                    @error('status_ayah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- BAGIAN DATA IBU --}}
                                <h6 class="mt-4 mb-3 pb-1 border-bottom" style="color: var(--sigap-blue);"><i
                                        class="fa fa-female me-1"></i> Data Ibu Kandung</h6>

                                {{-- 5. Nama Ibu (orang_tua.nama_ibu) --}}
                                <div class="col-md-6 mb-3">
                                    <label for="nama_ibu" class="form-label">Nama Ibu <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nama_ibu') is-invalid @enderror"
                                        id="nama_ibu" name="nama_ibu" placeholder="Nama Ibu Sesuai KK" required
                                        value="{{ old('nama_ibu') }}">
                                    @error('nama_ibu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- 6. Pekerjaan Ibu (orang_tua.pekerjaan_ibu) --}}
                                <div class="col-md-6 mb-3">
                                    <label for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu</label>
                                    <input type="text"
                                        class="form-control @error('pekerjaan_ibu') is-invalid @enderror"
                                        id="pekerjaan_ibu" name="pekerjaan_ibu"
                                        placeholder="Contoh: Ibu Rumah Tangga/PNS" value="{{ old('pekerjaan_ibu') }}">
                                    @error('pekerjaan_ibu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- 7. No HP Ibu (orang_tua.no_hp_ibu) --}}
                                <div class="col-md-6 mb-3">
                                    <label for="no_hp_ibu" class="form-label">No. HP Ibu</label>
                                    <input type="tel" class="form-control @error('no_hp_ibu') is-invalid @enderror"
                                        id="no_hp_ibu" name="no_hp_ibu" placeholder="08xxxxxxxxx (Aktif WA Disarankan)"
                                        value="{{ old('no_hp_ibu') }}">
                                    @error('no_hp_ibu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- 8. Status Ibu (orang_tua.status_ibu) --}}
                                <div class="col-md-6 mb-3">
                                    <label for="status_ibu" class="form-label">Status Ibu <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select @error('status_ibu') is-invalid @enderror" id="status_ibu"
                                        name="status_ibu" required>
                                        <option value="">--Pilih Status--</option>
                                        <option value="hidup" {{ old('status_ibu') == 'hidup' ? 'selected' : '' }}>Hidup
                                        </option>
                                        <option value="meninggal"
                                            {{ old('status_ibu') == 'meninggal' ? 'selected' : '' }}>
                                            Meninggal</option>
                                        <option value="tidak_diketahui"
                                            {{ old('status_ibu') == 'tidak_diketahui' ? 'selected' : '' }}>Tidak
                                            Diketahui</option>
                                    </select>
                                    @error('status_ibu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- 9. Alamat Orang Tua (orang_tua.alamat_orang_tua) --}}
                                <div class="col-md-12 mb-3">
                                    <label for="alamat_orang_tua" class="form-label">Alamat Lengkap Orang Tua</label>
                                    <textarea class="form-control @error('alamat_orang_tua') is-invalid @enderror" id="alamat_orang_tua"
                                        name="alamat_orang_tua" rows="3"
                                        placeholder="Alamat lengkap Orang Tua sesuai KK. Kosongkan jika sama dengan alamat calon peserta.">{{ old('alamat_orang_tua') }}</textarea>
                                    @error('alamat_orang_tua')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm">
                        <div class="card-header bg-warning text-dark">
                            <h6 class="m-0"><i class="fa fa-child me-1"></i> Data Wali Santri (Opsional)</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                {{-- BAGIAN DATA WALI SANTRI (tabel: wali_santri) --}}

                                {{-- 10. Nama Wali (wali_santri.nama_wali) --}}
                                <div class="col-md-6 mb-3">
                                    <label for="nama_wali" class="form-label">Nama Wali</label>
                                    <input type="text" class="form-control @error('nama_wali') is-invalid @enderror"
                                        id="nama_wali" name="nama_wali" placeholder="Nama Wali Santri"
                                        value="{{ old('nama_wali') }}">
                                    <div class="form-text">Kosongkan jika tidak ada wali selain Orang Tua.</div>
                                    @error('nama_wali')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- 11. Hubungan Wali (wali_santri.hubungan_wali) --}}
                                <div class="col-md-6 mb-3">
                                    <label for="hubungan_wali" class="form-label">Hubungan Wali</label>
                                    <select class="form-select @error('hubungan_wali') is-invalid @enderror"
                                        id="hubungan_wali" name="hubungan_wali">
                                        <option value="">--Pilih Opsi--</option>
                                        <option value="ayah" {{ old('hubungan_wali') == 'ayah' ? 'selected' : '' }}>Ayah
                                        </option>
                                        <option value="ibu" {{ old('hubungan_wali') == 'ibu' ? 'selected' : '' }}>Ibu
                                        </option>
                                        <option value="paman" {{ old('hubungan_wali') == 'paman' ? 'selected' : '' }}>
                                            Paman
                                        </option>
                                        <option value="bibi" {{ old('hubungan_wali') == 'bibi' ? 'selected' : '' }}>Bibi
                                        </option>
                                        <option value="kakek" {{ old('hubungan_wali') == 'kakek' ? 'selected' : '' }}>
                                            Kakek
                                        </option>
                                        <option value="nenek" {{ old('hubungan_wali') == 'nenek' ? 'selected' : '' }}>
                                            Nenek
                                        </option>
                                        <option value="lainnya" {{ old('hubungan_wali') == 'lainnya' ? 'selected' : '' }}>
                                            Lainnya
                                        </option>
                                    </select>
                                    @error('hubungan_wali')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- 12. Pekerjaan Wali (wali_santri.pekerjaan_wali) --}}
                                <div class="col-md-6 mb-3">
                                    <label for="pekerjaan_wali" class="form-label">Pekerjaan Wali</label>
                                    <input type="text"
                                        class="form-control @error('pekerjaan_wali') is-invalid @enderror"
                                        id="pekerjaan_wali" name="pekerjaan_wali" placeholder="Pekerjaan Wali"
                                        value="{{ old('pekerjaan_wali') }}">
                                    @error('pekerjaan_wali')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- 13. No. HP Wali (wali_santri.no_hp_wali) --}}
                                <div class="col-md-6 mb-3">
                                    <label for="no_hp_wali" class="form-label">No. HP Wali (Aktif WA)</label>
                                    <input type="tel" class="form-control @error('no_hp_wali') is-invalid @enderror"
                                        id="no_hp_wali" name="no_hp_wali" placeholder="08xxxxxxxxx"
                                        value="{{ old('no_hp_wali') }}">
                                    @error('no_hp_wali')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- 14. Alamat Wali (wali_santri.alamat_wali) --}}
                                <div class="col-md-12 mb-3">
                                    <label for="alamat_wali" class="form-label">Alamat Lengkap Wali</label>
                                    <textarea class="form-control @error('alamat_wali') is-invalid @enderror" id="alamat_wali" name="alamat_wali"
                                        rows="3" placeholder="Alamat lengkap Wali">{{ old('alamat_wali') }}</textarea>
                                    @error('alamat_wali')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- Tombol Navigasi dan Submit --}}
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-secondary"
                            onclick="document.getElementById('peserta-tab').click()">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </button>

                        <button type="submit" class="btn btn-primary">
                            Kirim<i class="fa fa-check"></i>
                        </button>
                    </div>

                </div>

            </div>

        </form>
    </div>

    {{-- Script untuk memastikan tab aktif jika ada error validasi di tab tersebut --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Daftar kolom yang ada di tab Orang Tua/Wali (orang_tua & wali_santri)
            @php
                $ortuWaliErrors = ['nama_ayah', 'pekerjaan_ayah', 'no_hp_ayah', 'status_ayah', 'nama_ibu', 'pekerjaan_ibu', 'no_hp_ibu', 'status_ibu', 'alamat_orang_tua', 'nama_wali', 'pekerjaan_wali', 'hubungan_wali', 'alamat_wali', 'no_hp_wali'];
                $hasOrtuWaliError = false;
                foreach ($ortuWaliErrors as $field) {
                    if ($errors->has($field)) {
                        $hasOrtuWaliError = true;
                        break;
                    }
                }
            @endphp

            @if ($hasOrtuWaliError)
                var ortuTab = new bootstrap.Tab(document.getElementById('ortu-tab'));
                ortuTab.show();
            @elseif ($errors->any())
                var pesertaTab = new bootstrap.Tab(document.getElementById('peserta-tab'));
                pesertaTab.show();
            @endif
        });
    </script>
@endsection

@push('js')
    <script>
        const provinsi = document.getElementById('provinsi');
        const kabupaten = document.getElementById('kabupaten');
        const kecamatan = document.getElementById('kecamatan');
        const desa = document.getElementById('desa');

        // LOAD PROVINSI
        fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
            .then(res => res.json())
            .then(data => {
                data.forEach(p => {
                    provinsi.innerHTML += `<option value="${p.id}">${p.name}</option>`;
                });
            });

        // PROVINSI → KABUPATEN
        provinsi.addEventListener('change', async function() {
            kabupaten.disabled = true;
            kabupaten.innerHTML = '<option>Memuat...</option>';

            const res = await fetch(
                `https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${this.value}.json`);
            const data = await res.json();

            kabupaten.disabled = false;
            kabupaten.innerHTML = '<option value="">Pilih Kabupaten / Kota</option>';
            data.forEach(item => {
                kabupaten.innerHTML += `<option value="${item.id}">${item.name}</option>`;
            });

            kecamatan.innerHTML = '<option value="">Pilih Kecamatan</option>';
            desa.innerHTML = '<option value="">Pilih Desa</option>';
            kecamatan.disabled = desa.disabled = true;
        });

        // KABUPATEN → KECAMATAN
        kabupaten.addEventListener('change', async function() {
            kecamatan.disabled = true;
            kecamatan.innerHTML = '<option>Memuat...</option>';

            const res = await fetch(
                `https://www.emsifa.com/api-wilayah-indonesia/api/districts/${this.value}.json`);
            const data = await res.json();

            kecamatan.disabled = false;
            kecamatan.innerHTML = '<option value="">Pilih Kecamatan</option>';
            data.forEach(item => {
                kecamatan.innerHTML += `<option value="${item.id}">${item.name}</option>`;
            });

            desa.innerHTML = '<option value="">Pilih Desa</option>';
            desa.disabled = true;
        });

        // KECAMATAN → DESA
        kecamatan.addEventListener('change', async function() {
            desa.disabled = true;
            desa.innerHTML = '<option>Memuat...</option>';

            const res = await fetch(
                `https://www.emsifa.com/api-wilayah-indonesia/api/villages/${this.value}.json`);
            const data = await res.json();

            desa.disabled = false;
            desa.innerHTML = '<option value="">Pilih Desa / Kelurahan</option>';
            data.forEach(item => {
                desa.innerHTML += `<option value="${item.id}">${item.name}</option>`;
            });
        });
    </script>
@endpush
