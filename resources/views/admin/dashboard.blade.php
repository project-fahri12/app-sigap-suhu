@extends('layouts.masterDashboard')

@section('judul', 'Dashboard')
@section('sub-judul', 'Admin PPDB')

@section('content')

    {{-- ===================== --}}
    {{-- INFO BOX PPDB --}}
    {{-- ===================== --}}
    <div class="row">

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-green">
                <span class="info-box-icon"><i class="fa fa-calendar"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Tahun Ajaran</span>
                    <span class="info-box-number">
                        {{ setting('ppdb_academic_year') ?? '-' }}
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="fa fa-flag"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Gelombang Aktif</span>
                    <span class="info-box-number">
                        {{ setting('ppdb_active_wave') ?? '-' }}
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="fa fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Pendaftar</span>
                    <span class="info-box-number">
                        {{ $totalPendaftar }}
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-red">
                <span class="info-box-icon"><i class="fa fa-credit-card"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Belum Bayar</span>
                    <span class="info-box-number">
                        {{ $belumBayar }}
                    </span>
                </div>
            </div>
        </div>

    </div>

    {{-- ===================== --}}
    {{-- STATUS PPDB --}}
    {{-- ===================== --}}
    <div class="row">
        <div class="col-md-12">
            @if (setting('ppdb_status') === 'buka')
                <div class="callout callout-success">
                    <h4>
                        <i class="fa fa-check-circle"></i> PPDB Sedang Dibuka
                    </h4>
                    <p>
                        Periode:
                        <strong>
                            {{ setting('ppdb_period') }}
                        </strong>
                    </p>
                </div>
            @else
                <div class="callout callout-danger">
                    <h4>
                        <i class="fa fa-times-circle"></i> PPDB Ditutup
                    </h4>
                    <p>
                        {{ setting('ppdb_description') ?? 'Pendaftaran belum dibuka.' }}
                    </p>
                </div>
            @endif
        </div>
    </div>

    {{-- ===================== --}}
    {{-- GRAFIK (PLACEHOLDER) --}}
    {{-- ===================== --}}
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <i class="fa fa-bar-chart"></i> Statistik Pendaftaran
                    </h3>
                </div>
                <div class="box-body text-center" style="height:250px; line-height:250px;">
                    <span class="text-muted">
                        Grafik pendaftaran (akan dinamis)
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <i class="fa fa-pie-chart"></i> Status Pembayaran
                    </h3>
                </div>
                <div class="box-body text-center" style="height:250px; line-height:250px;">
                    <span class="text-muted">
                        Grafik pembayaran (akan dinamis)
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- ===================== --}}
    {{-- PENDAFTAR TERBARU --}}
    {{-- ===================== --}}
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <i class="fa fa-user-plus"></i> Pendaftar Terbaru
                    </h3>
                </div>

                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Asal Sekolah</th>
                                <th>Unit</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody style="text-transform: uppercase">
                            @forelse($pendaftarTerbaru as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->nama_lengkap }}</td>
                                    <td>{{ $row->asal_sekolah }}</td>
                                    <td>{{ $row->unit->nama_unit ?? '-' }}</td>
                                    <td>
                                        @php
                                            $verifikasi = $row->verifikasi;
                                            $pembayaran = $verifikasi->verifikasi_pembayaran ?? null;
                                            $berkas = $verifikasi->verifikasi_berkas ?? null;
                                        @endphp

                                        @if (is_null($verifikasi))
                                            <div style="display:flex; gap:6px;">
                                                <span class="label label-default" style="flex:1; text-align:center;">
                                                    Pembayaran: Belum
                                                </span>
                                                <span class="label label-default" style="flex:1; text-align:center;">
                                                    Berkas: Belum
                                                </span>
                                            </div>
                                        @else
                                            <div style="display:flex; gap:6px;">
                                                {{-- PEMBAYARAN --}}
                                                @if ($pembayaran === 'valid')
                                                    <span class="label label-success" style="flex:1; text-align:center;">
                                                        Pembayaran: Valid
                                                    </span>
                                                @elseif ($pembayaran === 'pending')
                                                    <span class="label label-warning" style="flex:1; text-align:center;">
                                                        Pembayaran: Pending
                                                    </span>
                                                @elseif ($pembayaran === 'invalid')
                                                    <span class="label label-danger" style="flex:1; text-align:center;">
                                                        Pembayaran: Invalid
                                                    </span>
                                                @else
                                                    <span class="label label-default" style="flex:1; text-align:center;">
                                                        Pembayaran: Belum
                                                    </span>
                                                @endif

                                                {{-- BERKAS --}}
                                                @if ($berkas === 'valid')
                                                    <span class="label label-success" style="flex:1; text-align:center;">
                                                        Berkas: Valid
                                                    </span>
                                                @elseif ($berkas === 'pending')
                                                    <span class="label label-warning" style="flex:1; text-align:center;">
                                                        Berkas: Pending
                                                    </span>
                                                @elseif ($berkas === 'invalid')
                                                    <span class="label label-danger" style="flex:1; text-align:center;">
                                                        Berkas: Invalid
                                                    </span>
                                                @else
                                                    <span class="label label-default" style="flex:1; text-align:center;">
                                                        Berkas: Belum
                                                    </span>
                                                @endif
                                            </div>
                                        @endif
                                    </td>


                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">
                                        Belum ada pendaftar
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
