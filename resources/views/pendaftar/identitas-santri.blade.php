@extends('layouts.masterDashboard')

@section('content')
    <style>
        /* Profile Sidebar Styling */
        .profile-user-img {
            width: 150px;
            height: 200px;
            object-fit: cover;
            border: 3px solid #d2d6de;
            margin: 0 auto;
        }

        .profile-card {
            border-top: 3px solid #3c8dbc;
        }

        /* Table Styling */
        .table-detail th {
            background-color: #f9f9f9;
            width: 35%;
            color: #555;
        }

        .table-detail td {
            color: #333;
            font-weight: 500;
        }

        /* PDF Preview Styling */
        .pdf-container {
            position: relative;
            width: 100%;
            height: 600px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background: #525659;
        }

        .nav-tabs-custom>.nav-tabs>li.active {
            border-top-color: #3c8dbc;
        }
    </style>

    <div class="row">
        {{-- KOLOM KIRI: RINGKASAN PROFIL --}}
        <div class="col-md-3">
            <div class="box box-primary profile-card">
                <div class="box-body box-profile text-center">
                    <img class="profile-user-img img-responsive img-thumbnail"
                        src="{{ $berkas && $berkas->foto_path ? asset('storage/' . $berkas->foto_path) : asset('assets/dist/img/avatar.png') }}"
                        alt="User profile picture">

                    <h3 class="profile-username text-center" style="font-size: 18px; font-weight: bold; margin-top: 15px;">
                        {{ strtoupper($pendaftar->nama_lengkap) }}
                    </h3>
                    <p class="text-muted text-center">{{ $pendaftar->kode_pendaftaran }}</p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Unit</b> <a class="pull-right">{{ $pendaftar->unit->nama_unit ?? '-' }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Status</b>
                            <span
                                class="pull-right label {{ $pendaftar->status_santri == 'mukim' ? 'label-success' : 'label-info' }}">
                                {{ strtoupper($pendaftar->status_santri) }}
                            </span>
                        </li>
                    </ul>

                    @if ($berkas)
                        <a href="{{ asset('storage/' . $berkas->file_path) }}" download class="btn btn-primary btn-block">
                            <i class="fa fa-download"></i> <b>Unduh Berkas PDF</b>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN: DETAIL DATA --}}
        <div class="col-md-9">
            <div class="nav-tabs-custom shadow">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#santri" data-toggle="tab"><i class="fa fa-user"></i> Data Santri</a></li>
                    <li><a href="#ortu" data-toggle="tab"><i class="fa fa-users"></i> Orang Tua</a></li>
                    <li><a href="#wali" data-toggle="tab"><i class="fa fa-user-secret"></i> Wali</a></li>
                    <li><a href="#berkas" data-toggle="tab"><i class="fa fa-file-pdf-o"></i> Preview Berkas</a></li>
                </ul>

                <div class="tab-content">
                    {{-- TAB SANTRI --}}
                    <div class="tab-pane active" id="santri">
                        <div class="table-responsive">
                            <table class="table table-detail">
                                <tr>
                                    <th>NIK</th>
                                    <td>{{ $pendaftar->nik }}</td>
                                </tr>
                                <tr>
                                    <th>Tempat, Tanggal Lahir</th>
                                    <td>{{ strtoupper($pendaftar->tempat_lahir) }},
                                        {{ \Carbon\Carbon::parse($pendaftar->tanggal_lahir)->format('d F Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td>{{ $pendaftar->jenis_kelamin == 'L' ? 'LAKI-LAKI' : 'PEREMPUAN' }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>
                                        {{ strtoupper($pendaftar->alamat_detail) }}<br>
                                        RT {{ $pendaftar->rt }} / RW {{ $pendaftar->rw }}, DESA
                                        {{ strtoupper($pendaftar->desa) }}<br>
                                        KEC. {{ strtoupper($pendaftar->kecamatan) }}, KAB.
                                        {{ strtoupper($pendaftar->kabupaten) }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Asal Sekolah</th>
                                    <td>{{ strtoupper($pendaftar->asal_sekolah ?? '-') }}</td>
                                </tr>
                                <tr>
                                    <th>Pilihan Sekolah</th>
                                    <td>{{ strtoupper($pendaftar->sekolahPilihan->nama_sekolah ?? '-') }}</td>
                                </tr>
                                <tr>
                                    <th>Gelombang</th>
                                    <td><span
                                            class="badge bg-blue">{{ strtoupper($pendaftar->gelombang->nama_gelombang ?? '-') }}</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    {{-- TAB ORANG TUA --}}
                    <div class="tab-pane" id="ortu">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="text-blue"><i class="fa fa-male"></i> Data Ayah</h4>
                                <table class="table table-detail">
                                    <tr>
                                        <th>Nama</th>
                                        <td>{{ strtoupper($orangTua->nama_ayah ?? '-') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pekerjaan</th>
                                        <td>{{ strtoupper($orangTua->pekerjaan_ayah ?? '-') }}</td>
                                    </tr>
                                    <tr>
                                        <th>No. HP</th>
                                        <td><span class="text-primary">{{ $orangTua->no_hp_ayah ?? '-' }}</span></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h4 class="text-red"><i class="fa fa-female"></i> Data Ibu</h4>
                                <table class="table table-detail">
                                    <tr>
                                        <th>Nama</th>
                                        <td>{{ strtoupper($orangTua->nama_ibu ?? '-') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pekerjaan</th>
                                        <td>{{ strtoupper($orangTua->pekerjaan_ibu ?? '-') }}</td>
                                    </tr>
                                    <tr>
                                        <th>No. HP</th>
                                        <td><span class="text-primary">{{ $orangTua->no_hp_ibu ?? '-' }}</span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- TAB WALI --}}
                    <div class="tab-pane" id="wali">
                        <table class="table table-detail">
                            <tr>
                                <th>Nama Wali</th>
                                <td>{{ strtoupper($wali->nama_wali ?? '-') }}</td>
                            </tr>
                            <tr>
                                <th>Hubungan</th>
                                <td>{{ strtoupper($wali->hubungan_wali ?? '-') }}</td>
                            </tr>
                            <tr>
                                <th>Pekerjaan</th>
                                <td>{{ strtoupper($wali->pekerjaan_wali ?? '-') }}</td>
                            </tr>
                            <tr>
                                <th>No. HP</th>
                                <td>{{ $wali->no_hp_wali ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>

                    {{-- TAB PREVIEW BERKAS --}}
                    <div class="tab-pane" id="berkas">
                        @if ($berkas && $berkas->file_path)
                            <div class="alert alert-info">
                                <i class="fa fa-info-circle"></i> Jika PDF tidak tampil, silakan klik tombol <b>Lihat
                                    Fullscreen</b> atau unduh berkas.
                                <a href="{{ asset('storage/' . $berkas->file_path) }}" target="_blank"
                                    class="btn btn-xs btn-default pull-right">Lihat Fullscreen</a>
                            </div>
                            <div class="pdf-container">
                                <iframe src="{{ asset('storage/' . $berkas->file_path) }}#toolbar=0" width="100%"
                                    height="100%" style="border: none;">
                                </iframe>
                            </div>
                        @else
                            <div class="text-center" style="padding: 50px 0;">
                                <i class="fa fa-file-text-o" style="font-size: 50px; color: #ddd;"></i>
                                <p class="text-muted mt-2">Belum ada berkas PDF yang diunggah.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
