@extends('layouts.masterDashboard')

@section('judul', 'Informasi Kontak')
@section('sub-judul', 'Daftar Kontak & Status Pendaftar')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap.min.css">
    <style>
        /* KONSISTENSI UI BOX */
        .box {
            border-radius: 12px;
            border-top: 3px solid #3c8dbc;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border-left: none;
            border-right: none;
            border-bottom: none;
        }

        /* NAV TABS STYLING */
        .nav-tabs-custom {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: none;
            background: transparent;
        }

        .nav-tabs-custom>.nav-tabs {
            border-bottom-color: #f4f4f4;
            background: #f9fafb;
            padding: 10px 10px 0 10px;
            border-radius: 12px 12px 0 0;
        }

        .nav-tabs-custom>.nav-tabs>li>a {
            border-radius: 8px 8px 0 0;
            font-weight: 600;
            color: #777;
            transition: 0.3s;
            padding: 12px 20px;
        }

        .nav-tabs-custom>.nav-tabs>li.active>a {
            border-top-color: transparent;
            border-left-color: #eee;
            border-right-color: #eee;
            color: #3c8dbc;
            background: #fff;
        }

        /* BADGE STATUS */
        .badge-status {
            padding: 4px 12px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 10px;
            text-transform: uppercase;
            display: inline-block;
            min-width: 85px;
            text-align: center;
        }

        .bg-valid {
            background-color: #00a65a;
            color: #fff;
        }

        .bg-invalid {
            background-color: #dd4b39;
            color: #fff;
        }

        .bg-pending {
            background-color: #f39c12;
            color: #fff;
        }

        /* TABLE DESIGN */
        .table-vcenter td {
            vertical-align: middle !important;
            padding: 12px 8px !important;
        }

        .table thead th {
            background: #f8f9fa;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.5px;
            color: #555;
            border-bottom: 2px solid #eee;
        }

        /* WHATSAPP BUTTON */
        .btn-wa {
            background-color: #25D366;
            color: white !important;
            border-radius: 50px;
            padding: 5px 15px;
            font-size: 11px;
            font-weight: 700;
            transition: 0.3s;
            display: inline-block;
            text-decoration: none !important;
        }

        .btn-wa:hover {
            background-color: #128C7E;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(37, 211, 102, 0.3);
        }

        /* ANIMASI GELOMBANG (SHIMMER) */
        .skeleton-loading {
            position: relative;
            overflow: hidden !important;
            background-color: #f2f2f2 !important;
        }

        .skeleton-loading::after {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            transform: translateX(-100%);
            background-image: linear-gradient(90deg, rgba(255, 255, 255, 0) 0, rgba(255, 255, 255, 0.6) 50%, rgba(255, 255, 255, 0) 100%);
            animation: shimmer 1.5s infinite;
        }

        @keyframes shimmer {
            100% {
                transform: translateX(100%);
            }
        }

        .is-loading .tab-content,
        .is-loading .nav-tabs {
            opacity: 0;
            visibility: hidden;
        }
    </style>
@endpush

@section('content')
    <div id="kontak-container" class="box box-primary skeleton-loading is-loading">
        <div class="box-header with-border" style="padding: 15px 20px;">
            <h3 class="box-title" style="font-weight: 700;">
                <i class="fa fa-address-book text-blue"></i> DATA KONTAK PENDAFTAR
            </h3>
        </div>

        <div class="box-body" style="padding: 0;">
            <div class="nav-tabs-custom">

                <div class="tab-content" style="padding: 20px;">
                    <div class="tab-pane active" id="all">
                        <div class="table-responsive">
                            <table class="table table-hover table-vcenter datatable-statis" width="100%">
                                <thead>
                                    <tr>
                                        <th width="30">NO</th>
                                        <th>NO REGIST</th>
                                        <th>NAMA & SEKOLAH ASAL</th>
                                        <th>SEKOLAH TUJUAN & UNIT</th>
                                        <th class="text-center">KONTAK</th>
                                        <th class="text-center">STATUS BERKAS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($info as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><code
                                                    style="color: #3c8dbc; font-weight: bold;">{{ $item->kode_pendaftaran }}</code>
                                            </td>
                                            <td>
                                                <div style="font-weight: 700; color: #333;">
                                                    {{ strtoupper($item->nama_lengkap) }}</div>
                                                <small class="text-muted"><i
                                                        class="fa fa-graduation-cap"></i>{{ strtoupper($item->asal_sekolah) }}</small>
                                            </td>
                                            <td>
                                                <div style="font-weight: 600;">
                                                    {{ strtoupper($item->sekolahPilihan->nama_sekolah) }}</div>
                                                <span class="label label-primary"
                                                    style="font-size: 10px;">{{ strtoupper($item->unit->nama_unit) }}</span>
                                            </td>
                                            <td class="text-center">
                                                <a href="https://wa.me/{{ ($item->orangTua->no_wa_utama }}"
                                                    target="_blank" class="btn-wa">
                                                    <i class="fa fa-whatsapp"></i> WHATSAPP
                                                </a>
                                            </td>
                                            @php
                                                $status = $item->verifikasi->verifikasi_berkas ?? 'belum';
                                            @endphp

                                            <td class="text-center">
                                                @if ($status === 'belum')
                                                    <span class="badge-status bg-secondary">Belum</span>
                                                @elseif ($status === 'pending')
                                                    <span class="badge-status bg-warning">Pending</span>
                                                @elseif ($status === 'valid')
                                                    <span class="badge-status bg-success">Valid</span>
                                                @elseif ($status === 'invalid')
                                                    <span class="badge-status bg-danger">Invalid</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi DataTable
            var table = $('.datatable-statis').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
                },
                "pageLength": 10,
                "ordering": true,
                "info": true
            });

            // Simulasi Berhenti Loading Shimmer
            setTimeout(function() {
                $('#kontak-container').removeClass('skeleton-loading is-loading');
                table.columns.adjust().draw();
            }, 800);
        });
    </script>
@endpush
