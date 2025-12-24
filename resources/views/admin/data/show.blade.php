@extends('layouts.masterDashboard')

@section('judul', 'Manajemen Pendaftaran')
@section('sub-judul', 'Detail Calon Santri')

@section('content')
    <style>
        /* --- UI STYLING (KONSISTEN) --- */
        .box {
            border-radius: 12px;
            border-top: 3px solid #3c8dbc;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        /* Modern Tabs */
        .nav-tabs-custom {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: none;
            border: 1px solid #eee;
        }

        .nav-tabs-custom>.nav-tabs>li.active {
            border-top-color: #3c8dbc;
        }

        .nav-tabs-custom>.nav-tabs>li>a {
            font-weight: 600;
            color: #777;
            padding: 12px 20px;
        }

        .nav-tabs-custom>.nav-tabs>li.active>a {
            color: #3c8dbc;
        }

        /* Info Table Styling */
        .table-detail tr th {
            background-color: #f9f9f9;
            width: 30%;
            color: #555;
            font-weight: 600;
            border-right: 1px solid #eee;
        }

        .table-detail tr td {
            color: #333;
        }

        /* Label Pill */
        .label-pill {
            padding: 5px 15px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 11px;
            text-transform: uppercase;
            display: inline-block;
        }

        .bg-valid {
            background-color: #00a65a;
            color: white;
        }

        .bg-pending {
            background-color: #f39c12;
            color: white;
        }

        .bg-ditolak {
            background-color: #dd4b39;
            color: white;
        }

        /* Image Preview */
        .img-preview {
            border-radius: 8px;
            border: 3px solid #eee;
            transition: transform 0.3s;
            cursor: zoom-in;
            max-height: 250px;
            object-fit: cover;
        }

        .img-preview:hover {
            transform: scale(1.02);
        }

        /* Skeleton Loading */
        .skeleton-loading {
            position: relative;
            overflow: hidden;
            background-color: #f2f2f2;
            min-height: 400px;
        }

        .skeleton-loading::after {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            transform: translateX(-100%);
            background-image: linear-gradient(90deg, rgba(255, 255, 255, 0) 0, rgba(255, 255, 255, 0.4) 50%, rgba(255, 255, 255, 0) 100%);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            100% {
                transform: translateX(100%);
            }
        }

        .is-loading>* {
            opacity: 0;
        }
    </style>

    <div class="row">
        <div class="col-md-12">
            <div style="margin-bottom: 15px;">
                <a href="{{ route('admin.data-pendaftar.index') }}" class="btn btn-default btn-sm" style="border-radius: 6px;">
                    <i class="fa fa-arrow-left"></i> Kembali ke Daftar
                </a>
            </div>

            <div class="box box-primary skeleton-loading is-loading">
                <div class="box-header with-border" style="padding: 20px;">
                    <div class="pull-left">
                        <h3 class="box-title" style="font-size: 20px; font-weight: 700;">
                            <i class="fa fa-user-circle text-blue"></i> {{ strtoupper($pendaftar->nama_lengkap) }}
                        </h3>
                        <div style="margin-top: 5px;">
                            <span class="text-muted"><i class="fa fa-barcode"></i> {{ $pendaftar->kode_pendaftaran }}</span>
                            <span style="margin: 0 10px; color: #ddd;">|</span>
                            <span class="text-muted"><i class="fa fa-calendar"></i> Gelombang:
                                {{ $pendaftar->gelombang->nama_gelombang ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="pull-right">
                        @php($v = $pendaftar->verifikasi)
                        @if (!$v)
                            <span class="label-pill bg-gray">BELUM ADA STATUS</span>
                        @elseif($v->verifikasi_berkas === 'valid' && $v->verifikasi_pembayaran === 'valid')
                            <span class="label-pill bg-valid"><i class="fa fa-check-circle"></i> TERVERIFIKASI</span>
                        @elseif($v->verifikasi_berkas === 'invalid' || $v->verifikasi_pembayaran === 'invalid')
                            <span class="label-pill bg-ditolak"><i class="fa fa-times-circle"></i> DITOLAK</span>
                        @else
                            <span class="label-pill bg-pending"><i class="fa fa-clock-o"></i> MENUNGGU VERIFIKASI</span>
                        @endif
                    </div>
                </div>

                <div class="box-body">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#profil" data-toggle="tab"><i class="fa fa-user"></i> Biodata</a>
                            </li>
                            <li><a href="#alamat" data-toggle="tab"><i class="fa fa-map-marker"></i> Alamat</a></li>
                            <li><a href="#orangtua" data-toggle="tab"><i class="fa fa-users"></i> Orang Tua</a></li>
                            <li><a href="#berkas" data-toggle="tab"><i class="fa fa-file-text"></i> Berkas</a></li>
                            <li><a href="#pembayaran" data-toggle="tab"><i class="fa fa-money"></i> Pembayaran</a></li>
                            <li class="pull-right"><a href="#verifikasi" data-toggle="tab" class="text-red"><i
                                        class="fa fa-check-square-o"></i> LOG VERIFIKASI</a></li>
                        </ul>

                        <div class="tab-content" style="padding: 20px;">

                            {{-- TAB PROFIL --}}
                            <div class="tab-pane active" id="profil">
                                <table class="table table-detail">
                                    <tr>
                                        <th>Nama Lengkap</th>
                                        <td><b>{{ $pendaftar->nama_lengkap }}</b></td>
                                    </tr>
                                    <tr>
                                        <th>NIK / No. Induk Kependudukan</th>
                                        <td><code style="font-size: 14px;">{{ $pendaftar->nik }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelamin</th>
                                        <td>{{ $pendaftar->jenis_kelamin == 'L' ? 'LAKI-LAKI' : 'PEREMPUAN' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tempat, Tanggal Lahir</th>
                                        <td>{{ $pendaftar->tempat_lahir }},
                                            {{ \Carbon\Carbon::parse($pendaftar->tanggal_lahir)->translatedFormat('d F Y') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Asal Sekolah</th>
                                        <td>{{ $pendaftar->asal_sekolah }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status Santri</th>
                                        <td><span
                                                class="label label-primary">{{ strtoupper($pendaftar->status_santri) }}</span>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            {{-- TAB ALAMAT --}}
                            <div class="tab-pane" id="alamat">
                                <table class="table table-detail">
                                    <tr>
                                        <th>Alamat Lengkap</th>
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

                            {{-- TAB ORANG TUA --}}
                            <div class="tab-pane" id="orangtua">
                                @if ($pendaftar->orangTua)
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4 class="page-header">Data Ayah</h4>
                                            <table class="table table-detail">
                                                <tr>
                                                    <th>Nama Ayah</th>
                                                    <td>{{ $pendaftar->orangTua->nama_ayah }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Pekerjaan</th>
                                                    <td>{{ $pendaftar->orangTua->pekerjaan_ayah }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <h4 class="page-header">Data Ibu</h4>
                                            <table class="table table-detail">
                                                <tr>
                                                    <th>Nama Ibu</th>
                                                    <td>{{ $pendaftar->orangTua->nama_ibu }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Pekerjaan</th>
                                                    <td>{{ $pendaftar->orangTua->pekerjaan_ibu }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="well well-sm mt-3">
                                                <i class="fa fa-phone"></i> <b>Kontak Orang Tua:</b>
                                                {{ $pendaftar->orangTua->no_hp }}
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="text-center p-5"><i class="fa fa-info-circle fa-2x text-gray"></i>
                                        <p>Data belum dilengkapi</p>
                                    </div>
                                @endif
                            </div>

                            {{-- TAB BERKAS --}}
                            <div class="tab-pane" id="berkas">
                                @if ($pendaftar->berkas)
                                    <div class="row">
                                        <div class="col-md-4 text-center">
                                            <label>Pas Foto</label><br>
                                            <img src="{{ asset('storage/' . $pendaftar->berkas->foto_path) }}"
                                                class="img-preview img-thumbnail">
                                        </div>
                                        <div class="col-md-8">
                                            <table class="table table-detail">
                                                <tr>
                                                    <th>File Dokumen (PDF)</th>
                                                    <td>
                                                        <a href="{{ asset($pendaftar->berkas->file_path) }}"
                                                            target="_blank" class="btn btn-danger btn-sm">
                                                            <i class="fa fa-file-pdf-o"></i> Buka File Pendaftaran
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Keterangan</th>
                                                    <td>{{ $pendaftar->berkas->keterangan ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Waktu Upload</th>
                                                    <td>{{ $pendaftar->berkas->created_at->translatedFormat('d M Y, H:i') }}
                                                        WIB</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                @else
                                    <div class="alert alert-warning"><i class="fa fa-warning"></i> Santri belum mengunggah
                                        berkas.</div>
                                @endif
                            </div>

                            {{-- TAB PEMBAYARAN --}}
                            <div class="tab-pane" id="pembayaran">
                                @if ($pendaftar->pembayaran)
                                    <div class="row">
                                        <div class="col-md-7">
                                            <table class="table table-detail">
                                                <tr>
                                                    <th>Nominal Bayar</th>
                                                    <td><b class="text-green" style="font-size: 18px;">Rp
                                                            {{ number_format($pendaftar->pembayaran->nominal, 0, ',', '.') }}</b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Tanggal Bayar</th>
                                                    <td>{{ $pendaftar->pembayaran->tanggal_bayar }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Status Internal</th>
                                                    <td><span class="label label-info">SUDAH UPLOAD</span></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-5 text-center">
                                            <label>Bukti Transfer</label><br>
                                        @empty($pendaftar->pembayaran->bukti)
                                            <span class="badge bg-secondary">Diverfikasi Sistem</span>
                                        @else
                                            <a href="{{ asset($pendaftar->pembayaran->bukti) }}" target="_blank">
                                                <img src="{{ asset($pendaftar->pembayaran->bukti) }}"
                                                    class="img-preview img-thumbnail">
                                            </a>
                                        @endempty

                                        <p class="text-muted"><small>*Klik gambar untuk memperbesar</small></p>
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-warning">Konfirmasi pembayaran belum dilakukan.</div>
                            @endif
                        </div>

                        {{-- TAB VERIFIKASI --}}
                        <div class="tab-pane" id="verifikasi">
                            <div class="box box-solid box-default" style="border: 1px solid #ddd;">
                                <div class="box-body no-padding">
                                    <table class="table table-detail">
                                        <tr>
                                            <th>Status Berkas</th>
                                            <td>
                                                <span
                                                    class="label-pill {{ ($pendaftar->verifikasi->verifikasi_berkas ?? '') == 'valid' ? 'bg-valid' : 'bg-ditolak' }}">
                                                    {{ strtoupper($pendaftar->verifikasi->verifikasi_berkas ?? 'BELUM') }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Status Pembayaran</th>
                                            <td>
                                                <span
                                                    class="label-pill {{ ($pendaftar->verifikasi->verifikasi_pembayaran ?? '') == 'valid' ? 'bg-valid' : 'bg-ditolak' }}">
                                                    {{ strtoupper($pendaftar->verifikasi->verifikasi_pembayaran ?? 'BELUM') }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Catatan Admin</th>
                                            <td class="text-italic text-muted">
                                                "{{ $pendaftar->verifikasi->catatan ?? 'Tidak ada catatan' }}"</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            {{-- BUTTON ACTION (Contoh) --}}
                            <div class="text-center" style="margin-top: 20px;">
                                <button class="btn btn-primary"
                                    onclick="alert('Fitur Form Verifikasi bisa diletakkan di sini atau via Modal')">
                                    <i class="fa fa-edit"></i> UPDATE STATUS VERIFIKASI
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Simulasi Loading Skeleton
        setTimeout(() => {
            $('.skeleton-loading').removeClass('skeleton-loading is-loading');
        }, 600);
    });
</script>
@endsection
