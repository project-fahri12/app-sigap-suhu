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
                <li>Mohon isi semua data yang bertanda **<span class="text-danger">*</span>** dengan lengkap dan benar.</li>
                <li>Setelah formulir ini disimpan, Anda akan mendapatkan **Kode Pendaftaran** untuk proses selanjutnya (pembayaran & upload berkas).</li>
            </ul>
        </div>
    </div>
    
    <h5 class="mb-3">Isi formulir pendaftaran di bawah ini:</h5>
    
    {{-- Tabs Navigasi (Bootstrap 5) --}}
    <ul class="nav nav-tabs" id="pendaftaranTabs" role="tablist">
        {{-- Tab 1: Data Calon Peserta (Pendaftar) --}}
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="peserta-tab" data-bs-toggle="tab" data-bs-target="#peserta-pane" type="button" role="tab" aria-controls="peserta-pane" aria-selected="true">
                <i class="fa fa-user me-2"></i> Data Calon Peserta
            </button>
        </li>
        {{-- Tab 2: Data Orang Tua / Wali --}}
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="ortu-tab" data-bs-toggle="tab" data-bs-target="#ortu-pane" type="button" role="tab" aria-controls="ortu-pane" aria-selected="false">
                <i class="fa fa-users me-2"></i> Data Orang Tua / Wali
            </button>
        </li>
    </ul>

    {{-- FORMULIR UTAMA --}}
    <form method="POST" action="{{ route('pendaftaran.store') }}"> 
        @csrf
        
        {{-- Tab Content --}}
        <div class="tab-content pt-3" id="pendaftaranTabsContent">
            
            {{--------------------------------------------------}}
            {{-- TAB 1: DATA CALON PESERTA (tabel: pendaftar) --}}
            {{--------------------------------------------------}}
            <div class="tab-pane fade show active" id="peserta-pane" role="tabpanel" aria-labelledby="peserta-tab" tabindex="0">
                <div class="row">
                    
                    <h6 class="text-primary mb-3">Pilihan Pendaftaran</h6>

                    {{-- Tahun Ajaran --}}
<div class="col-md-4 mb-3">
    <label class="form-label">Tahun Ajaran</label>

    <input type="text"
           class="form-control"
           value="{{ $tahun_ajaran->tahun }}"
           readonly>

    {{-- ID tetap dikirim --}}
    <input type="hidden"
           name="tahun_ajaran_id"
           value="{{ $tahun_ajaran->id }}">
</div>

                    
                    {{-- Gelombang --}}
<div class="col-md-4 mb-3">
    <label class="form-label">Gelombang</label>

    <input type="text"
           class="form-control"
           value="{{ $gelombang->nama_gelombang }}"
           readonly>

    {{-- ID tetap dikirim --}}
    <input type="hidden"
           name="gelombang_id"
           value="{{ $gelombang->id }}">
</div>

                    
                    {{-- 3. Unit Tujuan (pendaftar.unit_id) --}}
                    <div class="col-md-4 mb-3">
                        <label for="unit_id" class="form-label">Unit Tujuan <span class="text-danger">*</span></label>
                        <select class="form-select @error('unit_id') is-invalid @enderror" id="unit_id" name="unit_id" required>
                            <option value="">-- Pilih Unit --</option>
                            @foreach($unit_options ?? [] as $unit)
                                <option value="{{ $unit->id }}" {{ old('unit_id') == $unit->id ? 'selected' : '' }}>{{ $unit->nama_unit }}</option>
                            @endforeach
                        </select>
                        @error('unit_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- 4. Pilihan Sekolah (pendaftar.sekolah_pilihan_id) --}}
                    <div class="col-md-12 mb-3">
                        <label for="sekolah_pilihan_id" class="form-label">Pilihan Sekolah <span class="text-danger">*</span></label>
                        <select class="form-select @error('sekolah_pilihan_id') is-invalid @enderror" id="sekolah_pilihan_id" name="sekolah_pilihan_id" required>
                            <option value="">-- Pilih Sekolah --</option>
                            @foreach($sekolah_options ?? [] as $sek)
                                <option value="{{ $sek->id }}" {{ old('sekolah_pilihan_id') == $sek->id ? 'selected' : '' }}>{{ $sek->nama_sekolah }}</option>
                            @endforeach
                        </select>
                        @error('sekolah_pilihan_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <hr class="my-3">
                    <h6 class="text-primary mb-3">Data Pribadi Calon Peserta</h6>
                    
                    {{-- 5. NIK (pendaftar.nik) --}}
                    <div class="col-md-6 mb-3">
                        <label for="nik" class="form-label">NIK Calon Peserta <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" placeholder="Nomor Induk Kependudukan (16 Digit)" required value="{{ old('nik') }}">
                        @error('nik') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    {{-- 6. Nama Lengkap (pendaftar.nama_lengkap) --}}
                    <div class="col-md-6 mb-3">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" name="nama_lengkap" placeholder="Nama lengkap sesuai KK/Ijazah" required value="{{ old('nama_lengkap') }}">
                        @error('nama_lengkap') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- 7. Tempat Lahir (pendaftar.tempat_lahir) --}}
                    <div class="col-md-4 mb-3">
                        <label for="tempat_lahir" class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" placeholder="Contoh: Jombang" required value="{{ old('tempat_lahir') }}">
                        @error('tempat_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- 8. Tanggal Lahir (pendaftar.tanggal_lahir) --}}
                    <div class="col-md-4 mb-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" required value="{{ old('tanggal_lahir') }}">
                        @error('tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    {{-- 9. Jenis Kelamin (pendaftar.jenis_kelamin) --}}
                    <div class="col-md-4 mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select class="form-select @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="">--Pilih Opsi--</option>
                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    {{-- 10. Alamat (pendaftar.alamat) --}}
                    <div class="col-md-12 mb-3">
                        <label for="alamat" class="form-label">Alamat Lengkap (Tempat Tinggal Santri) <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3" placeholder="Alamat lengkap, RT/RW, Desa/Kel, Kec, Kab/Kota" required>{{ old('alamat') }}</textarea>
                        @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    {{-- Tombol Pindah Tab --}}
                    <div class="d-flex justify-content-end mt-4">
                        <button type="button" class="btn btn-ppdb" onclick="document.getElementById('ortu-tab').click()">
                            Lanjut ke Data Orang Tua / Wali <i class="fa fa-arrow-right"></i>
                        </button>
                    </div>
                </div> 
            </div>
            
            {{--------------------------------------------------}}
            {{-- TAB 2: DATA ORANG TUA / WALI (tabel: orang_tua, wali_santri) --}}
            {{--------------------------------------------------}}
            <div class="tab-pane fade" id="ortu-pane" role="tabpanel" aria-labelledby="ortu-tab" tabindex="0">
                <div class="row">
                    
                    {{-- BAGIAN DATA ORANG TUA (tabel: orang_tua) --}}
                    <h6 class="mt-2 mb-3 pb-1 border-bottom" style="color: var(--sigap-blue);"><i class="fa fa-male me-1"></i> Data Ayah Kandung</h6>
                    
                    {{-- 1. Nama Ayah (orang_tua.nama_ayah) --}}
                    <div class="col-md-6 mb-3">
                        <label for="nama_ayah" class="form-label">Nama Ayah <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama_ayah') is-invalid @enderror" id="nama_ayah" name="nama_ayah" placeholder="Nama Ayah Sesuai KK" required value="{{ old('nama_ayah') }}">
                        @error('nama_ayah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    {{-- 2. Pekerjaan Ayah (orang_tua.pekerjaan_ayah) --}}
                    <div class="col-md-6 mb-3">
                        <label for="pekerjaan_ayah" class="form-label">Pekerjaan Ayah</label>
                        <input type="text" class="form-control @error('pekerjaan_ayah') is-invalid @enderror" id="pekerjaan_ayah" name="pekerjaan_ayah" placeholder="Contoh: Wiraswasta/PNS" value="{{ old('pekerjaan_ayah') }}">
                        @error('pekerjaan_ayah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    {{-- 3. No HP Ayah (orang_tua.no_hp_ayah) --}}
                    <div class="col-md-6 mb-3">
                        <label for="no_hp_ayah" class="form-label">No. HP Ayah</label>
                        <input type="tel" class="form-control @error('no_hp_ayah') is-invalid @enderror" id="no_hp_ayah" name="no_hp_ayah" placeholder="08xxxxxxxxx" value="{{ old('no_hp_ayah') }}">
                        @error('no_hp_ayah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- 4. Status Ayah (orang_tua.status_ayah) --}}
                    <div class="col-md-6 mb-3">
                        <label for="status_ayah" class="form-label">Status Ayah <span class="text-danger">*</span></label>
                        <select class="form-select @error('status_ayah') is-invalid @enderror" id="status_ayah" name="status_ayah" required>
                            <option value="">--Pilih Status--</option>
                            <option value="hidup" {{ old('status_ayah') == 'hidup' ? 'selected' : '' }}>Hidup</option>
                            <option value="meninggal" {{ old('status_ayah') == 'meninggal' ? 'selected' : '' }}>Meninggal</option>
                            <option value="tidak_diketahui" {{ old('status_ayah') == 'tidak_diketahui' ? 'selected' : '' }}>Tidak Diketahui</option>
                        </select>
                        @error('status_ayah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <h6 class="mt-4 mb-3 pb-1 border-bottom" style="color: var(--sigap-blue);"><i class="fa fa-female me-1"></i> Data Ibu Kandung</h6>
                    
                    {{-- 5. Nama Ibu (orang_tua.nama_ibu) --}}
                    <div class="col-md-6 mb-3">
                        <label for="nama_ibu" class="form-label">Nama Ibu <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama_ibu') is-invalid @enderror" id="nama_ibu" name="nama_ibu" placeholder="Nama Ibu Sesuai KK" required value="{{ old('nama_ibu') }}">
                        @error('nama_ibu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    {{-- 6. Pekerjaan Ibu (orang_tua.pekerjaan_ibu) --}}
                    <div class="col-md-6 mb-3">
                        <label for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu</label>
                        <input type="text" class="form-control @error('pekerjaan_ibu') is-invalid @enderror" id="pekerjaan_ibu" name="pekerjaan_ibu" placeholder="Contoh: Ibu Rumah Tangga/PNS" value="{{ old('pekerjaan_ibu') }}">
                        @error('pekerjaan_ibu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- 7. No HP Ibu (orang_tua.no_hp_ibu) --}}
                    <div class="col-md-6 mb-3">
                        <label for="no_hp_ibu" class="form-label">No. HP Ibu</label>
                        <input type="tel" class="form-control @error('no_hp_ibu') is-invalid @enderror" id="no_hp_ibu" name="no_hp_ibu" placeholder="08xxxxxxxxx" value="{{ old('no_hp_ibu') }}">
                        @error('no_hp_ibu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    {{-- 8. Status Ibu (orang_tua.status_ibu) --}}
                    <div class="col-md-6 mb-3">
                        <label for="status_ibu" class="form-label">Status Ibu <span class="text-danger">*</span></label>
                        <select class="form-select @error('status_ibu') is-invalid @enderror" id="status_ibu" name="status_ibu" required>
                            <option value="">--Pilih Status--</option>
                            <option value="hidup" {{ old('status_ibu') == 'hidup' ? 'selected' : '' }}>Hidup</option>
                            <option value="meninggal" {{ old('status_ibu') == 'meninggal' ? 'selected' : '' }}>Meninggal</option>
                            <option value="tidak_diketahui" {{ old('status_ibu') == 'tidak_diketahui' ? 'selected' : '' }}>Tidak Diketahui</option>
                        </select>
                        @error('status_ibu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    {{-- 9. Alamat Orang Tua (orang_tua.alamat_orang_tua) --}}
                    <div class="col-md-12 mb-3">
                        <label for="alamat_orang_tua" class="form-label">Alamat Lengkap Orang Tua</label>
                        <textarea class="form-control @error('alamat_orang_tua') is-invalid @enderror" id="alamat_orang_tua" name="alamat_orang_tua" rows="3" placeholder="Alamat lengkap Orang Tua sesuai KK">{{ old('alamat_orang_tua') }}</textarea>
                        @error('alamat_orang_tua') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <h6 class="mt-4 mb-3 pb-1 border-bottom" style="color: var(--sigap-blue);"><i class="fa fa-child me-1"></i> Data Wali Santri (Opsional)</h6>
                    
                    {{-- BAGIAN DATA WALI SANTRI (tabel: wali_santri) --}}
                    
                    {{-- 10. Nama Wali (wali_santri.nama_wali) --}}
                    <div class="col-md-6 mb-3">
                        <label for="nama_wali" class="form-label">Nama Wali</label>
                        <input type="text" class="form-control @error('nama_wali') is-invalid @enderror" id="nama_wali" name="nama_wali" placeholder="Nama Wali Santri" value="{{ old('nama_wali') }}">
                        <div class="form-text">Kosongkan jika tidak ada wali selain Orang Tua.</div>
                        @error('nama_wali') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    {{-- 11. Hubungan Wali (wali_santri.hubungan_wali) --}}
                    <div class="col-md-6 mb-3">
                        <label for="hubungan_wali" class="form-label">Hubungan Wali</label>
                        <select class="form-select @error('hubungan_wali') is-invalid @enderror" id="hubungan_wali" name="hubungan_wali">
                            <option value="">--Pilih Opsi--</option>
                            <option value="ayah" {{ old('hubungan_wali') == 'ayah' ? 'selected' : '' }}>Ayah</option>
                            <option value="ibu" {{ old('hubungan_wali') == 'ibu' ? 'selected' : '' }}>Ibu</option>
                            <option value="paman" {{ old('hubungan_wali') == 'paman' ? 'selected' : '' }}>Paman</option>
                            <option value="bibi" {{ old('hubungan_wali') == 'bibi' ? 'selected' : '' }}>Bibi</option>
                            <option value="kakek" {{ old('hubungan_wali') == 'kakek' ? 'selected' : '' }}>Kakek</option>
                            <option value="nenek" {{ old('hubungan_wali') == 'nenek' ? 'selected' : '' }}>Nenek</option>
                            <option value="lainnya" {{ old('hubungan_wali') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('hubungan_wali') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    {{-- 12. Pekerjaan Wali (wali_santri.pekerjaan_wali) --}}
                    <div class="col-md-6 mb-3">
                        <label for="pekerjaan_wali" class="form-label">Pekerjaan Wali</label>
                        <input type="text" class="form-control @error('pekerjaan_wali') is-invalid @enderror" id="pekerjaan_wali" name="pekerjaan_wali" placeholder="Pekerjaan Wali" value="{{ old('pekerjaan_wali') }}">
                        @error('pekerjaan_wali') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- 13. No. HP Wali (wali_santri.no_hp_wali) --}}
                    <div class="col-md-6 mb-3">
                        <label for="no_hp_wali" class="form-label">No. HP Wali (Aktif WA)</label>
                        <input type="tel" class="form-control @error('no_hp_wali') is-invalid @enderror" id="no_hp_wali" name="no_hp_wali" placeholder="08xxxxxxxxx" value="{{ old('no_hp_wali') }}">
                        @error('no_hp_wali') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- 14. Alamat Wali (wali_santri.alamat_wali) --}}
                    <div class="col-md-12 mb-3">
                        <label for="alamat_wali" class="form-label">Alamat Lengkap Wali</label>
                        <textarea class="form-control @error('alamat_wali') is-invalid @enderror" id="alamat_wali" name="alamat_wali" rows="3" placeholder="Alamat lengkap Wali">{{ old('alamat_wali') }}</textarea>
                        @error('alamat_wali') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                </div> {{-- Tombol Navigasi dan Submit --}}
                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-secondary" onclick="document.getElementById('peserta-tab').click()">
                        <i class="fa fa-arrow-left"></i> Kembali ke Data Calon Peserta
                    </button>
                    
                    <button type="submit" class="btn btn-ppdb">
                        Selesaikan & Simpan Pendaftaran <i class="fa fa-check"></i>
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
            $ortuWaliErrors = [
                'nama_ayah', 'pekerjaan_ayah', 'no_hp_ayah', 'status_ayah',
                'nama_ibu', 'pekerjaan_ibu', 'no_hp_ibu', 'status_ibu', 
                'alamat_orang_tua',
                'nama_wali', 'pekerjaan_wali', 'hubungan_wali', 'alamat_wali', 'no_hp_wali'
            ];
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