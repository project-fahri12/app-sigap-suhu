@extends('home.homePage')


@section('content')
<section id="form-pendaftaran-awal" class="py-5 bg-light-soft">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                {{-- Tampilkan Error Global jika ada --}}
                @if (session('error'))
                    <div class="alert alert-danger shadow-sm rounded-custom mb-4">{{ session('error') }}</div>
                @endif
                {{-- Global error dari controller store() --}}
                @if ($errors->has('gagal'))
                    <div class="alert alert-danger shadow-sm rounded-custom mb-4">{{ $errors->first('gagal') }}</div>
                @endif
                
                <div class="card card-custom p-4 p-md-5 shadow-lg border-primary-custom animate-on-scroll">
                    <div class="card-body">
                        <h2 class="text-center fw-bold text-dark-navy mb-4">
                            <i class="fas fa-edit me-2 text-primary-custom"></i> Form Pendaftaran Awal
                        </h2>

                        <form action="{{ route('pendaftaran.store') }}" method="POST">
                            @csrf
                            
                            <h4 class="fw-bold text-primary-custom border-bottom pb-2 mb-4">Data Pribadi</h4>
                            
                            <div class="row g-4 mb-4">
                                
                                {{-- NIK (Nomor Induk Kependudukan) --}}
                                <div class="col-md-6">
                                    <div class="form-floating floating-label-group">
                                        <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" placeholder="NIK" required maxlength="20" pattern="\d{16,20}" value="{{ old('nik') }}">
                                        <label for="nik">NIK (Nomor Induk Kependudukan) <span class="text-danger">*</span></label>
                                        @error('nik')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @else
                                            <div class="form-text">Masukkan NIK 16 digit yang unik.</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                {{-- Nama Lengkap --}}
                                <div class="col-md-6">
                                    <div class="form-floating floating-label-group">
                                        <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap" required value="{{ old('nama_lengkap') }}">
                                        <label for="nama_lengkap">Nama Lengkap <span class="text-danger">*</span></label>
                                        @error('nama_lengkap')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                {{-- Tempat Lahir --}}
                                <div class="col-md-6">
                                    <div class="form-floating floating-label-group">
                                        <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" required maxlength="100" value="{{ old('tempat_lahir') }}">
                                        <label for="tempat_lahir">Tempat Lahir <span class="text-danger">*</span></label>
                                        @error('tempat_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                {{-- Tanggal Lahir --}}
                                <div class="col-md-6">
                                    <div class="form-floating floating-label-group">
                                        <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" required value="{{ old('tanggal_lahir') }}">
                                        <label for="tanggal_lahir">Tanggal Lahir <span class="text-danger">*</span></label>
                                        @error('tanggal_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                {{-- Jenis Kelamin (Radio Button) --}}
                                <div class="col-12">
                                    <label class="form-label fw-bold text-dark-navy mb-2">Jenis Kelamin <span class="text-danger">*</span></label>
                                    <div class="d-flex gap-4">
                                        <div class="form-check @error('jenis_kelamin') is-invalid-radio @enderror">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki_laki" value="L" required {{ old('jenis_kelamin') == 'Laki-laki' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="laki_laki">Laki-laki</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="L" required {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="perempuan">Perempuan</label>
                                        </div>
                                    </div>
                                   @error('jenis_kelamin')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <h4 class="fw-bold text-primary-custom border-bottom pb-2 mb-4 mt-5">Alamat Domisili</h4>
                            
                            {{-- Alamat Lengkap --}}
                            <div class="mb-4">
                                <div class="form-floating floating-label-group">
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" placeholder="Alamat Lengkap" required style="height: 100px;">{{ old('alamat') }}</textarea>
                                    <label for="alamat">Alamat Lengkap <span class="text-danger">*</span></label>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <h4 class="fw-bold text-primary-custom border-bottom pb-2 mb-4 mt-5">Pilihan Pendaftaran</h4>

                            <div class="row g-4 mb-4">
                                
                                {{-- Pilih Gelombang Pendaftaran (Readonly) --}}
                                <div class="col-md-6">
                                    {{-- Asumsi Controller telah memfilter dan memberikan objek Gelombang aktif tunggal, misal: $gelombang_aktif --}}
                                    @php
                                        // Asumsi: jika $gelombang_options adalah array/koleksi, ambil elemen pertama
                                        $gelombang_aktif = is_iterable($gelombang_options) && count($gelombang_options) > 0 ? $gelombang_options[0] : null;
                                    @endphp
                                    <div class="form-floating floating-label-group">
                                        <input type="text" class="form-control" id="gelombang_display" placeholder="Gelombang Pendaftaran" value="{{ $gelombang_aktif ? $gelombang_aktif->nama_gelombang : 'Tidak Ada Gelombang Aktif' }}" readonly>
                                        <label for="gelombang_display">Gelombang Pendaftaran <span class="text-danger">*</span></label>
                                        
                                        {{-- Input hidden untuk mengirimkan ID ke controller --}}
                                        @if($gelombang_aktif)
                                            <input type="hidden" name="gelombang_id" value="{{ $gelombang_aktif->id }}">
                                        @endif

                                        {{-- Tampilkan error jika ada validation error atau gelombang aktif tidak ada --}}
                                        @error('gelombang_id')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @elseif(!$gelombang_aktif)
                                            <div class="text-danger small mt-1">Harap hubungi administrator, tidak ada gelombang pendaftaran yang aktif.</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                {{-- Pilih Unit Pendidikan (Tetap Select Dinamis) --}}
                                <div class="col-md-6">
                                    <div class="form-floating floating-label-group">
                                        <select class="form-select @error('unit_id') is-invalid @enderror" id="unit_id" name="unit_id" required>
                                            <option selected disabled value="">Pilih Unit Pendidikan...</option>
                                            @foreach ($unit_options as $unit)
                                                {{-- Menggunakan properti 'nama' (asumsi model Eloquent) --}}
                                                <option value="{{ $unit->id }}" {{ old('unit_id') == $unit->id ? 'selected' : '' }}>
                                                    {{ $unit->nama_unit }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="unit_id">Pilih Unit Pendidikan <span class="text-danger">*</span></label>
                                        @error('unit_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                {{-- Pilihan Sekolah/Jurusan (Tetap Select Dinamis) --}}
                                <div class="col-md-6">
                                    <div class="form-floating floating-label-group">
                                        <select class="form-select @error('sekolah_pilihan_id') is-invalid @enderror" id="sekolah_pilihan_id" name="sekolah_pilihan_id" required>
                                            <option selected disabled value="">Pilih Sekolah/Jurusan...</option>
                                            @foreach ($sekolah_options as $sekolah)
                                                {{-- Menggunakan properti 'nama' (asumsi model Eloquent) --}}
                                                <option value="{{ $sekolah->id }}" {{ old('sekolah_pilihan_id') == $sekolah->id ? 'selected' : '' }}>
                                                    {{ $sekolah->nama_sekolah }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="sekolah_pilihan_id">Pilihan Sekolah/Jurusan <span class="text-danger">*</span></label>
                                        @error('sekolah_pilihan_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Tahun Ajaran (Readonly) --}}
                                <div class="col-md-6">
                                    {{-- Asumsi Controller telah memfilter dan memberikan objek Tahun Ajaran aktif tunggal, misal: $tahun_ajaran_aktif --}}
                                    @php
                                        // Asumsi: jika $tahun_ajaran_options adalah array/koleksi, ambil elemen pertama
                                        $tahun_ajaran_aktif = is_iterable($tahun_ajaran_options) && count($tahun_ajaran_options) > 0 ? $tahun_ajaran_options[0] : null;
                                    @endphp
                                    <div class="form-floating floating-label-group">
                                        <input type="text" class="form-control" id="tahun_ajaran_display" placeholder="Tahun Ajaran" value="{{ $tahun_ajaran_aktif ? $tahun_ajaran_aktif->tahun : 'Tidak Ada Tahun Ajaran Aktif' }}" readonly>
                                        <label for="tahun_ajaran_display">Tahun Ajaran <span class="text-danger">*</span></label>
                                        
                                        {{-- Input hidden untuk mengirimkan ID ke controller --}}
                                        @if($tahun_ajaran_aktif)
                                            <input type="hidden" name="tahun_ajaran_id" value="{{ $tahun_ajaran_aktif->id }}">
                                        @endif
                                        
                                        {{-- Tampilkan error jika ada validation error atau Tahun Ajaran aktif tidak ada --}}
                                        @error('tahun_ajaran_id')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @elseif(!$tahun_ajaran_aktif)
                                            <div class="text-danger small mt-1">Harap hubungi administrator, tidak ada tahun ajaran yang aktif.</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid mt-5">
                                <button type="submit" class="btn btn-primary-custom btn-lg shadow-lg hover-grow text-white">
                                    <i class="fas fa-arrow-right me-2"></i> Submit
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