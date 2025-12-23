@extends('layouts.masterDashboard')

@section('content')
<div class="row">
    <div class="col-md-12">

        {{-- ALERT SUKSES --}}
        @if (session('success'))
            <div class="alert alert-success">
                <i class="fa fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        {{-- ALERT ERROR VALIDASI --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <i class="fa fa-exclamation-triangle"></i>
                <strong>Terjadi kesalahan:</strong>
                <ul style="margin-top: 10px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">

            {{-- PANEL PETUNJUK / ALUR PENDAFTARAN --}}
            <div class="col-md-4">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h4 class="box-title"> <i class="fa fa-map-signs"></i> Alur Pendaftaran </h4>
                    </div>
                    <div class="box-body">
                        <ul class="list-unstyled">
                            <li><i class="fa fa-check text-green"></i> Isi data pendaftaran</li>
                            <li><i class="fa fa-credit-card text-blue"></i> Lakukan pembayaran</li>
                            <li><i class="fa fa-upload text-orange"></i> Upload berkas & pas foto</li>
                            <li><i class="fa fa-clock-o text-muted"></i> Menunggu verifikasi panitia (maks. 1x24 jam)</li>
                            <li><i class="fa fa-whatsapp text-green"></i> Bergabung ke grup informasi wali/orangtua</li>
                            <li><i class="fa fa-file-pdf-o text-red"></i> Setelah semua verifikasi selesai, cetak PDF bukti pendaftaran dan lakukan pembayaran ulang jika diperlukan</li>
                            <li><i class="fa fa-commenting-o text-yellow"></i> Jika belum tervverifikasi dalam 1x24 jam, harap hubungi admin melalui chat</li>
                        </ul>
                        <hr>
                        <a href="#" class="btn btn-success btn-block">
                            <i class="fa fa-whatsapp"></i> Gabung Grup Informasi
                        </a>
                    </div>
                </div>
            </div>

            {{-- PANEL PEMBAYARAN --}}
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-credit-card"></i> Pembayaran
                        </h3>
                    </div>

                    <div class="box-body">
                        {{-- BELUM PERNAH BAYAR --}}
                        @if (!$pembayaran)
                            @include('pendaftar.partials.form-pembayaran')

                        {{-- SUDAH BAYAR --}}
                        @else
                            <table class="table table-bordered">
                                <tr>
                                    <th width="200">Nominal</th>
                                    <td>Rp {{ number_format($pembayaran->nominal, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Bayar</th>
                                    <td>{{ \Carbon\Carbon::parse($pembayaran->tanggal_bayar)->translatedFormat('d F Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if (!$verifikasi || $verifikasi->verifikasi_pembayaran === 'pending')
                                            <span class="label label-warning">
                                                Menunggu Verifikasi Panitia
                                            </span>
                                        @elseif($verifikasi->verifikasi_pembayaran === 'invalid')
                                            <span class="label label-danger">
                                                Pembayaran Ditolak
                                            </span>
                                        @elseif($verifikasi->verifikasi_pembayaran === 'valid')
                                            <span class="label label-success">
                                                Pembayaran Diterima
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            </table>

                            {{-- JIKA DITOLAK --}}
                            @if ($verifikasi && $verifikasi->verifikasi_pembayaran === 'invalid')
                                <div class="alert alert-danger">
                                    <i class="fa fa-info-circle"></i>
                                    Pembayaran ditolak.
                                    <br>
                                    <strong>Catatan:</strong> {{ $verifikasi->catatan }}
                                </div>

                                @include('pendaftar.partials.form-pembayaran')
                            @endif
                        @endif
                    </div>
                </div>

                {{-- JIKA PEMBAYARAN VALID --}}
                @if ($verifikasi && $verifikasi->verifikasi_pembayaran === 'valid')
                    <a href="{{ route('pendaftar.upload-berkas.index') }}" class="btn btn-success m-3">
                        <i class="fa fa-upload"></i> Lanjut Upload Berkas
                    </a>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection
