@extends('layouts.masterDashboard')

@section('judul', 'Data Pendaftaran')
@section('sub-judul', 'Manajemen Calon Santri')

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap.min.css">
<style>
    /* --- UI STYLING (KONSISTEN) --- */
    .box {
        border-radius: 12px;
        border-top: 3px solid #3c8dbc;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        border-left: none;
        border-right: none;
        border-bottom: none;
    }

    .box-success {
        border-top-color: #00a65a;
    }

    .table-vcenter td {
        vertical-align: middle !important;
        padding: 12px 8px !important;
    }

    /* Info Box Modern */
    .info-box {
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.03);
        min-height: 90px;
    }

    .info-box-icon {
        border-radius: 12px 0 0 12px;
        height: 90px;
        line-height: 90px;
    }

    /* Label Pill Status */
    .label-pill {
        padding: 4px 12px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 10px;
        text-transform: uppercase;
        display: inline-block;
        text-align: center;
        color: white;
    }

    .bg-valid {
        background-color: #00a65a !important;
        box-shadow: 0 2px 4px rgba(0, 166, 90, 0.3);
    }

    .bg-pending {
        background-color: #f39c12 !important;
        box-shadow: 0 2px 4px rgba(243, 156, 18, 0.3);
    }

    .bg-ditolak {
        background-color: #dd4b39 !important;
        box-shadow: 0 2px 4px rgba(221, 75, 57, 0.3);
    }

    .bg-none {
        background-color: #d2d6de !important;
        color: #444;
    }

    .bg-kode {
        background-color: #00c0ef !important;
        font-family: 'Courier New', Courier, monospace;
    }

    .btn-action {
        border-radius: 6px;
        transition: all 0.2s;
        font-weight: 600;
    }

    /* Skeleton Wave */
    .skeleton-loading {
        position: relative;
        overflow: hidden !important;
        background-color: #f2f2f2 !important;
        min-height: 200px;
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
        opacity: 0 !important;
        visibility: hidden !important;
    }

    /* Datatable UI fix for AdminLTE */
    .dataTables_wrapper .row {
        margin: 0 !important;
    }
    .dataTables_filter {
        padding: 10px 15px;
        text-align: right;
    }
    .dataTables_length {
        padding: 10px 15px;
    }
    .dataTables_info, .dataTables_paginate {
        padding: 15px;
    }
</style>
@endpush

@section('content')
    {{-- STATISTIK ATAS --}}
    <div class="row">
        <div class="col-md-3 col-sm-6">
            <div class="info-box shadow-sm">
                <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">TOTAL PENDAFTAR</span>
                    <span class="info-box-number" style="font-size: 24px;">{{ number_format($total) }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="info-box shadow-sm">
                <span class="info-box-icon bg-green"><i class="fa fa-check-circle"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">TERVERIFIKASI</span>
                    <span class="info-box-number" style="font-size: 24px;">{{ number_format($terverifikasi) }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="info-box shadow-sm">
                <span class="info-box-icon bg-yellow"><i class="fa fa-hourglass-half"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">MENUNGGU</span>
                    <span class="info-box-number" style="font-size: 24px;">{{ number_format($menunggu) }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="info-box shadow-sm">
                <span class="info-box-icon bg-red"><i class="fa fa-times-circle"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">DITOLAK</span>
                    <span class="info-box-number" style="font-size: 24px;">{{ number_format($ditolak) }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- FILTER DATA --}}
    <form method="GET" action="{{ route('admin.data-pendaftar.index') }}">
        <div class="box box-primary">
            <div class="box-header with-border" style="padding: 15px;">
                <h3 class="box-title" style="font-weight: 700;"><i class="fa fa-filter text-blue"></i> FILTER DATA</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body" style="padding: 20px;">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>TAHUN AJARAN</label>
                            <select name="tahun_ajaran" class="form-control">
                                <option value="">SEMUA TAHUN</option>
                                @foreach ($tahunAjaran as $ta)
                                    <option value="{{ $ta->id }}" @selected(request('tahun_ajaran') == $ta->id)>
                                        {{ strtoupper($ta->tahun) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>GELOMBANG</label>
                            <select name="gelombang" class="form-control">
                                <option value="">SEMUA GELOMBANG</option>
                                @foreach ($gelombang as $g)
                                    <option value="{{ $g->id }}" @selected(request('gelombang') == $g->id)>
                                        {{ strtoupper($g->nama_gelombang) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>STATUS</label>
                            <select name="status" class="form-control">
                                <option value="">SEMUA STATUS</option>
                                <option value="valid" @selected(request('status') == 'valid')>TERVERIFIKASI</option>
                                <option value="pending" @selected(request('status') == 'pending')>MENUNGGU</option>
                                <option value="ditolak" @selected(request('status') == 'ditolak')>DITOLAK</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer bg-gray-light text-right">
                <a href="{{ route('admin.data-pendaftar.index') }}" class="btn btn-default btn-action"><i class="fa fa-refresh"></i> RESET</a>
                <button type="submit" class="btn btn-primary btn-action"><i class="fa fa-filter"></i> TERAPKAN FILTER</button>
            </div>
        </div>
    </form>

    {{-- DAFTAR TABEL --}}
    <div class="box box-success skeleton-loading is-loading">
        <div class="box-header with-border" style="padding: 15px;">
            <h3 class="box-title" style="font-weight: 700;"><i class="fa fa-database text-green"></i> DAFTAR CALON SANTRI</h3>
        </div>

        <div class="box-body no-padding">
            <div class="table-responsive">
                <table id="table-pendaftar" class="table table-hover table-vcenter" width="100%">
                    <thead class="bg-gray-light">
                        <tr>
                            <th width="40" class="text-center">#</th>
                            <th>KODE</th>
                            <th>NAMA LENGKAP</th>
                            <th>NIK</th>
                            <th>ASAL SEKOLAH</th>
                            <th>GELOMBANG</th>
                            <th class="text-center">STATUS</th>
                            <th width="120" class="text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pendaftar as $item)
                            <tr>
                                <td class="text-center text-muted">{{ $loop->iteration }}</td>
                                <td><span class="label-pill bg-kode">{{ $item->kode_pendaftaran }}</span></td>
                                <td><b style="color: #333;">{{ strtoupper($item->nama_lengkap) }}</b></td>
                                <td class="text-muted">{{ $item->nik }}</td>
                                <td><small>{{ strtoupper($item->asal_sekolah ?? '-') }}</small></td>
                                <td><span class="text-blue">{{ $item->gelombang->nama_gelombang ?? '-' }}</span></td>
                                <td class="text-center">
                                    @php($v = $item->verifikasi)
                                    @if (!$v)
                                        <span class="label-pill bg-none">BELUM ADA</span>
                                    @elseif($v->verifikasi_berkas === 'valid' && $v->verifikasi_pembayaran === 'valid')
                                        <span class="label-pill bg-valid">VALID</span>
                                    @elseif($v->verifikasi_berkas === 'invalid' || $v->verifikasi_pembayaran === 'invalid')
                                        <span class="label-pill bg-ditolak">DITOLAK</span>
                                    @elseif($v->verifikasi_berkas === 'belum')
                                        <span class="label-pill bg-none">BELUM</span>
                                    @else
                                        <span class="label-pill bg-pending">MENUNGGU</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.data-pendaftar.show', $item->id) }}"
                                            class="btn btn-default btn-xs btn-action" title="Detail"><i
                                                class="fa fa-eye text-blue"></i></a>
                                        <a href="{{ route('admin.data-pendaftar.edit', $item->id) }}"
                                            class="btn btn-default btn-xs btn-action" title="Edit"><i
                                                class="fa fa-edit text-orange"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // 1. Inisialisasi DataTable
            if ($.fn.DataTable.isDataTable('#table-pendaftar')) {
                $('#table-pendaftar').DataTable().destroy();
            }

            var table = $('#table-pendaftar').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
                },
                "pageLength": 25,
                "order": [[0, "asc"]],
                "columnDefs": [
                    { "orderable": false, "targets": [7] }
                ],
                "dom": "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
                       "<'row'<'col-sm-12'tr>>" +
                       "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            });

            // 2. UI Handler (Skeleton)
            setTimeout(() => {
                $('.skeleton-loading').removeClass('skeleton-loading is-loading');
            }, 600);

            // 3. Toast Notification
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });

            @if (session('success'))
                Toast.fire({
                    icon: 'success',
                    title: "{{ session('success') }}"
                });
            @endif
        });
    </script>
@endpush