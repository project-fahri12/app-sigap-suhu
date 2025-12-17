@extends('layouts.masterDashboard')

@section('judul', 'Detail Pendaftar')
@section('sub-judul', 'Informasi Lengkap Calon Santri')

@section('content')

    <a href="{{ route('admin.data-pendaftar.index') }}" class="btn btn-default mb-3">
        <i class="fa fa-arrow-left"></i> Kembali
    </a>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">
                <i class="fa fa-user"></i> {{ $pendaftar->nama_lengkap }}
            </h3>
            <span class="pull-right label label-info">
                {{ $pendaftar->kode_pendaftaran }}
            </span>
        </div>

        <div class="box-body">

            {{-- ================= TAB NAV ================= --}}
            <ul class="nav nav-tabs">
                <li class="active"><a href="#profil" data-toggle="tab">Profil</a></li>
                <li><a href="#alamat" data-toggle="tab">Alamat</a></li>
                <li><a href="#orangtua" data-toggle="tab">Orang Tua</a></li>
                <li><a href="#wali" data-toggle="tab">Wali</a></li>
                <li><a href="#berkas" data-toggle="tab">Berkas</a></li>
                <li><a href="#pembayaran" data-toggle="tab">Pembayaran</a></li>
                <li><a href="#verifikasi" data-toggle="tab">Verifikasi</a></li>
            </ul>

            {{-- ================= TAB CONTENT ================= --}}
            <div class="tab-content" style="margin-top:20px">

                {{-- ================================================= --}}
                {{-- TAB PROFIL --}}
                {{-- ================================================= --}}
                <div class="tab-pane active" id="profil">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Nama Lengkap</th>
                            <td>{{ $pendaftar->nama_lengkap }}</td>
                        </tr>
                        <tr>
                            <th>NIK</th>
                            <td>{{ $pendaftar->nik }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>{{ ucfirst($pendaftar->jenis_kelamin) }}</td>
                        </tr>
                        <tr>
                            <th>Tempat, Tanggal Lahir</th>
                            <td>
                                {{ $pendaftar->tempat_lahir }},
                                {{ \Carbon\Carbon::parse($pendaftar->tanggal_lahir)->format('d M Y') }}
                            </td>
                        </tr>
                        <tr>
                            <th>Asal Sekolah</th>
                            <td>{{ $pendaftar->asal_sekolah }}</td>
                        </tr>
                        <tr>
                            <th>Status Santri</th>
                            <td>
                                <span class="label label-primary">
                                    {{ strtoupper($pendaftar->status_santri) }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>

                {{-- ================================================= --}}
                {{-- TAB ALAMAT (BERANTAI INDONESIA) --}}
                {{-- ================================================= --}}
                <div class="tab-pane" id="alamat">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Alamat Lengkap</th>
                            <td>{{ $pendaftar->alamat_lengkap }}</td>
                        </tr>
                        <tr>
                            <th>RT / RW</th>
                            <td>{{ $pendaftar->rt }} / {{ $pendaftar->rw }}</td>
                        </tr>
                        <tr>
                            <th>Desa / Kelurahan</th>
                            <td>{{ $pendaftar->desa }}</td>
                        </tr>
                        <tr>
                            <th>Kecamatan</th>
                            <td>{{ $pendaftar->kecamatan }}</td>
                        </tr>
                        <tr>
                            <th>Kabupaten / Kota</th>
                            <td>{{ $pendaftar->kabupaten }}</td>
                        </tr>
                        <tr>
                            <th>Provinsi</th>
                            <td>{{ $pendaftar->provinsi }}</td>
                        </tr>
                        <tr>
                            <th>Kode Pos</th>
                            <td>{{ $pendaftar->kode_pos }}</td>
                        </tr>
                    </table>
                </div>

                {{-- ================================================= --}}
                {{-- TAB ORANG TUA --}}
                {{-- ================================================= --}}
                <div class="tab-pane" id="orangtua">
                    @if ($pendaftar->orangTua)
                        <table class="table table-bordered">
                            <tr>
                                <th width="30%">Nama Ayah</th>
                                <td>{{ $pendaftar->orangTua->nama_ayah }}</td>
                            </tr>
                            <tr>
                                <th>Pekerjaan Ayah</th>
                                <td>{{ $pendaftar->orangTua->pekerjaan_ayah }}</td>
                            </tr>
                            <tr>
                                <th>Nama Ibu</th>
                                <td>{{ $pendaftar->orangTua->nama_ibu }}</td>
                            </tr>
                            <tr>
                                <th>Pekerjaan Ibu</th>
                                <td>{{ $pendaftar->orangTua->pekerjaan_ibu }}</td>
                            </tr>
                            <tr>
                                <th>No. HP Orang Tua</th>
                                <td>{{ $pendaftar->orangTua->no_hp }}</td>
                            </tr>
                        </table>
                    @else
                        <div class="alert alert-warning">Data orang tua belum diisi</div>
                    @endif
                </div>

                {{-- ================================================= --}}
                {{-- TAB WALI --}}
                {{-- ================================================= --}}
                <div class="tab-pane" id="wali">
                    @if ($pendaftar->waliSantri)
                        <table class="table table-bordered">
                            <tr>
                                <th width="30%">Nama Wali</th>
                                <td>{{ $pendaftar->waliSantri->nama_wali }}</td>
                            </tr>
                            <tr>
                                <th>Hubungan</th>
                                <td>{{ $pendaftar->waliSantri->hubungan }}</td>
                            </tr>
                            <tr>
                                <th>No. HP</th>
                                <td>{{ $pendaftar->waliSantri->no_hp }}</td>
                            </tr>
                        </table>
                    @else
                        <div class="alert alert-info">Tidak memiliki wali</div>
                    @endif
                </div>

                {{-- ================================================= --}}
                {{-- TAB BERKAS --}}
                {{-- ================================================= --}}
                <div class="tab-pane" id="berkas">
                    @if ($pendaftar->berkas)
                        <table class="table table-bordered">
                            <tr>
                                <th width="30%">Berkas Pendaftaran (PDF)</th>
                                <td>
                                    <a href="{{ asset($pendaftar->berkas->file_path) }}" target="_blank"
                                        class="btn btn-sm btn-primary">
                                        <i class="fa fa-file-pdf-o"></i> Lihat Berkas
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <th>Pas Foto</th>
                                <td>
                                    <img src="{{ asset($pendaftar->berkas->foto_path) }}" class="img-thumbnail"
                                        style="max-height:200px">
                                </td>
                            </tr>

                            <tr>
                                <th>Keterangan</th>
                                <td>{{ $pendaftar->berkas->keterangan ?? '-' }}</td>
                            </tr>

                            <tr>
                                <th>Tanggal Upload</th>
                                <td>{{ $pendaftar->berkas->created_at->format('d M Y H:i') }}</td>
                            </tr>
                        </table>
                    @else
                        <div class="alert alert-warning">
                            <i class="fa fa-warning"></i> Berkas belum diunggah
                        </div>
                    @endif


                </div>


                {{-- ================================================= --}}
                {{-- TAB PEMBAYARAN --}}
                {{-- ================================================= --}}
                <div class="tab-pane" id="pembayaran">
                    @if ($pendaftar->pembayaran)
                        <table class="table table-bordered">
                            <tr>
                                <th>Nominal</th>
                                <td>Rp {{ number_format($pendaftar->pembayaran->nominal, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Bayar</th>
                                <td>{{ $pendaftar->pembayaran->tanggal_bayar }}</td>
                            </tr>
                            <tr>
                                <th>Bukti</th>
                                <td>
                                    <a href="{{ asset($pendaftar->pembayaran->bukti) }}" target="_blank"
                                        class="btn btn-xs btn-success">
                                        Lihat Bukti
                                    </a>
                                </td>
                            </tr>
                        </table>
                    @else
                        <div class="alert alert-warning">Belum melakukan pembayaran</div>
                    @endif
                </div>

                {{-- ================================================= --}}
                {{-- TAB VERIFIKASI --}}
                {{-- ================================================= --}}
                <div class="tab-pane" id="verifikasi">
                    @if ($pendaftar->verifikasi)
                        <table class="table table-bordered">
                            <tr>
                                <th width="30%">Verifikasi Berkas</th>
                                <td>
                                    <span
                                        class="label label-{{ $pendaftar->verifikasi->verifikasi_berkas == 'valid' ? 'success' : 'danger' }}">
                                        {{ strtoupper($pendaftar->verifikasi->verifikasi_berkas) }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Verifikasi Pembayaran</th>
                                <td>
                                    <span
                                        class="label label-{{ $pendaftar->verifikasi->verifikasi_pembayaran == 'valid' ? 'success' : 'danger' }}">
                                        {{ strtoupper($pendaftar->verifikasi->verifikasi_pembayaran) }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Catatan</th>
                                <td>{{ $pendaftar->verifikasi->catatan ?? '-' }}</td>
                            </tr>
                        </table>
                    @else
                        <div class="alert alert-danger">Belum diverifikasi</div>
                    @endif
                </div>

            </div>
        </div>
    </div>

@endsection
