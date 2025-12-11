@extends('home.homePage')

@section('content')
<section id="form-pendaftaran-awal" class="py-5 bg-light-soft">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                <div class="card card-custom p-4 p-md-5 shadow-lg border-primary-custom animate-on-scroll">
                    <div class="card-body">
                        <h2 class="text-center fw-bold text-dark-navy mb-4">
                            <i class="fas fa-edit me-2 text-primary-custom"></i> Form Pendaftaran Awal
                        </h2>
                        <p class="text-center text-muted mb-5">
                            Mohon isi data diri calon pendaftar (santri) dengan informasi yang benar dan lengkap.
                        </p>

                        {{-- <form method="POST" action="{{ route('') }}"> --}}
                            @csrf
                            
                            <h4 class="fw-bold text-primary-custom border-bottom pb-2 mb-4">Data Pribadi</h4>
                            
                            <div class="row g-4 mb-4">
                                
                                <div class="col-md-6">
                                    <div class="form-floating floating-label-group">
                                        <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK (Nomor Induk Kependudukan)" required maxlength="20" pattern="\d{16,20}">
                                        <label for="nik">NIK (Nomor Induk Kependudukan)</label>
                                        <div class="form-text">Masukkan NIK 16 digit yang unik.</div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating floating-label-group">
                                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap" required>
                                        <label for="nama_lengkap">Nama Lengkap</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating floating-label-group">
                                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" required maxlength="100">
                                        <label for="tempat_lahir">Tempat Lahir</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating floating-label-group">
                                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                                        <label for="tanggal_lahir">Tanggal Lahir</label>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <label class="form-label fw-bold text-dark-navy mb-2">Jenis Kelamin</label>
                                    <div class="d-flex gap-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki_laki" value="Laki-laki" required>
                                            <label class="form-check-label" for="laki_laki">Laki-laki</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="Perempuan" required>
                                            <label class="form-check-label" for="perempuan">Perempuan</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h4 class="fw-bold text-primary-custom border-bottom pb-2 mb-4 mt-5">Alamat Domisili</h4>
                            
                            <div class="mb-4">
                                <div class="form-floating floating-label-group">
                                    <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat Lengkap" required style="height: 100px;"></textarea>
                                    <label for="alamat">Alamat Lengkap</label>
                                </div>
                            </div>

                            <h4 class="fw-bold text-primary-custom border-bottom pb-2 mb-4 mt-5">Pilihan Pendaftaran</h4>

                            <div class="row g-4 mb-4">
                                
                                <div class="col-md-6">
                                    <div class="form-floating floating-label-group">
                                        <select class="form-select" id="gelombang_id" name="gelombang_id" required>
                                            <option selected disabled value="">Pilih Gelombang...</option>
                                            {{-- Data ini diisi dari database/Controller --}}
                                            <option value="1">Gelombang 1 (Prioritas)</option>
                                            <option value="2">Gelombang 2 (Reguler)</option>
                                        </select>
                                        <label for="gelombang_id">Pilih Gelombang Pendaftaran</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating floating-label-group">
                                        <select class="form-select" id="unit_id" name="unit_id" required>
                                            <option selected disabled value="">Pilih Unit Pendidikan...</option>
                                            {{-- Data ini diisi dari database/Controller --}}
                                            <option value="SD">SD</option>
                                            <option value="SMP">SMP</option>
                                            <option value="SMA">SMA</option>
                                        </select>
                                        <label for="unit_id">Pilih Unit Pendidikan</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating floating-label-group">
                                        <select class="form-select" id="sekolah_pilihan_id" name="sekolah_pilihan_id" required>
                                            <option selected disabled value="">Pilih Sekolah/Jurusan...</option>
                                            {{-- Data ini diisi dari database/Controller, mungkin bergantung pada Unit ID --}}
                                            <option value="SMK_RPL">SMK - Rekayasa Perangkat Lunak</option>
                                            <option value="SMK_TKJ">SMK - Teknik Komputer Jaringan</option>
                                        </select>
                                        <label for="sekolah_pilihan_id">Pilihan Sekolah/Jurusan</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating floating-label-group">
                                        <select class="form-select" id="tahun_ajaran_id" name="tahun_ajaran_id" required>
                                            <option selected disabled value="">Pilih Tahun Ajaran...</option>
                                            {{-- Data ini diisi dari database/Controller --}}
                                            <option value="2026/2027">2026/2027</option>
                                            <option value="2027/2028">2027/2028</option>
                                        </select>
                                        <label for="tahun_ajaran_id">Tahun Ajaran</label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid mt-5">
                                <button type="submit" class="btn btn-primary-custom btn-lg shadow-lg hover-grow text-white">
                                    <i class="fas fa-arrow-right me-2 text-white"></i> Submit
                                </button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection