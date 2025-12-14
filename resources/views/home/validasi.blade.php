@extends('layouts.app')

@section('title', 'Validasi Pendaftaran')

@section('content')
<div class="validation-card">
            
            <div class="validation-header ">
                <i class="fa fa-bullhorn"></i> Info Validasi
            </div>

            {{-- Kolom Pencarian --}}
            <div class="mb-4">
                <input type="text" 
                       class="form-control" 
                       placeholder="Cari Nama Calon Siswa (Contoh: muhammad)">
            </div>

            {{-- Tabel Hasil Validasi --}}
            <div class="table-responsive mb-4">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Bayar</th>
                            <th>Upload</th>
                            <th>Validasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Data: MUHAMMAD EVANDER WACHID (Belum Valid) --}}
                        <tr>
                            <td class="text-danger-custom">MUHAMMAD EVANDER WACHID</td>
                            <td class="text-danger-custom">1A</td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-times-circle"></i></td>
                            <td class="text-danger-custom">Belum</td>
                        </tr>
                        {{-- Data: MUHAMMAD ROSICH SULTAN ALIZAR (Sudah Valid) --}}
                        <tr>
                            <td>MUHAMMAD ROSICH SULTAN ALIZAR</td>
                            <td>1A</td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td>Sudah</td>
                        </tr>
                        {{-- Data: MUHAMMAD BAHRUDDIN AL HAFIDH (Sudah Valid) --}}
                        <tr>
                            <td>MUHAMMAD BAHRUDDIN AL HAFIDH</td>
                            <td>1B</td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td>Sudah</td>
                        </tr>
                        {{-- Data: MUHAMMAD ZULFAN WAHYUDI (Sudah Valid) --}}
                        <tr>
                            <td>MUHAMMAD ZULFAN WAHYUDI</td>
                            <td>1A</td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td>Sudah</td>
                        </tr>
                        {{-- Data: MUHAMMAD TAMLIKHA ULUMUDDIN (Sudah Valid) --}}
                        <tr>
                            <td>MUHAMMAD TAMLIKHA ULUMUDDIN</td>
                            <td>1A</td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td><i class="fa fa-check-circle"></i></td>
                            <td>Sudah</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Keterangan --}}
            <div class="alert alert-secondary" role="alert">
                Bagi yang **BELUM VALID** silakan melakukan **Pembayaran** dan **upload berkas** untuk mendapatkan kartu tes, bagi yang sudah **VALID** bisa mendownload Kartu Tes (bagi yang belum mendownload). Dan apabila ada yang belum masuk grup PPDB, silakan login menggunakan Kode Pendaftaran dan klik link untuk bergabung dengan Grup PPDB (1 orang saja) agar tidak ketinggalan informasi.
            </div>

            {{-- Tambahkan tombol download/login jika diperlukan --}}
            <div class="d-grid gap-2 d-md-flex justify-content-md-center mt-4">
                <a href="{{ route('login') }}" class="btn btn-primary">
                    Login & Download Kartu Tes
                </a>
            </div>

        </div>
@endsection