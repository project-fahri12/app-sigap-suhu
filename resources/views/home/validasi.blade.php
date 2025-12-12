@extends('home.homePage')

@section('content')
<section id="validasi-status" class="py-5 bg-light-soft">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                <div class="card card-custom p-4 shadow-lg border-primary-custom animate-on-scroll">
                    
                    <div class="card-header bg-light-aqua text-dark-navy fw-bold h5 py-3 rounded-top-4">
                        <i class="fas fa-check-double me-2"></i> Status Validasi Pendaftaran SIGAP
                    </div>

                    <div class="card-body">
                        
                        {{-- Form Pencarian (STILL STATIC, tidak memanggil backend) --}}
                        <div class="mb-4">
                            <form>
                                <div class="input-group input-group-lg floating-label-group">
                                    <input type="text" class="form-control" placeholder="Cari Kode atau Nama Pendaftar...">
                                    <label class="text-muted">Cari Kode atau Nama Pendaftar...</label>
                                    <button class="btn btn-primary-custom" type="button">
                                        <i class="fas fa-search"></i> Cari
                                    </button>
                                </div>
                            </form>
                        </div>
                        
                        {{-- Tabel Static --}}
                        <div class="table-responsive mb-4">
                            <table class="table table-hover table-striped table-bordered status-table">
                                <thead class="bg-primary-custom text-white">
                                    <tr>
                                        <th>Nama Pendaftar</th>
                                        <th>Kelas Tujuan</th>
                                        <th class="text-center">Pembayaran</th>
                                        <th class="text-center">Upload Berkas</th>
                                        <th class="text-center">Validasi Akhir</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>MUHAMMAD EVANDER WACHID</td>
                                        <td>1A</td>
                                        <td class="text-center text-success fw-bold">Sudah</td>
                                        <td class="text-center text-danger fw-bold">Belum</td>
                                        <td class="text-center text-danger fw-bold">Belum</td>
                                    </tr>

                                    <tr>
                                        <td>LAILA NIDAUL HANNA</td>
                                        <td>2A</td>
                                        <td class="text-center text-danger fw-bold">Belum</td>
                                        <td class="text-center text-danger fw-bold">Belum</td>
                                        <td class="text-center text-danger fw-bold">Belum</td>
                                    </tr>

                                    <tr>
                                        <td>ARYA WIBAWA</td>
                                        <td>2A</td>
                                        <td class="text-center text-success fw-bold">Sudah</td>
                                        <td class="text-center text-danger fw-bold">Belum</td>
                                        <td class="text-center text-danger fw-bold">Belum</td>
                                    </tr>

                                    <tr>
                                        <td>ALYCIA AURELLIA</td>
                                        <td>1A</td>
                                        <td class="text-center text-success fw-bold">Sudah</td>
                                        <td class="text-center text-success fw-bold">Sudah</td>
                                        <td class="text-center text-success fw-bold">Valid</td>
                                    </tr>

                                    <tr>
                                        <td>SYAKIRA GHINA FALIKHA</td>
                                        <td>3A</td>
                                        <td class="text-center text-success fw-bold">Sudah</td>
                                        <td class="text-center text-success fw-bold">Sudah</td>
                                        <td class="text-center text-success fw-bold">Valid</td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>

                        {{-- Info Box Static --}}
                        <div class="alert alert-info-sigap p-4 shadow-sm">
                            <h5 class="fw-bold text-dark-navy mb-3">
                                <i class="fas fa-info-circle me-2"></i> Instruksi Selanjutnya
                            </h5>

                            <p class="mb-2">
                                Bagi yang statusnya <strong>BELUM VALID</strong> silakan lengkapi pembayaran dan upload berkas.
                            </p>

                            <p class="mb-0">
                                Bagi yang sudah <span class="text-success fw-bold">VALID</span>, silakan 
                                <strong>Download Kartu Tes</strong> dan bergabung ke Grup PPDB setelah login.
                            </p>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
