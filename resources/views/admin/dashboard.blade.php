@extends('layouts.masterDashboard')

@section('judul', 'Dashboard Analytics')
@section('sub-judul', 'Pusat Kendali PPDB Terpusat')

@section('content')
    <style>
        /* --- 1. ORIGINAL CUSTOM STYLING --- */
        .info-box {
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
        }
        .info-box:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }
        .box {
            border-radius: 10px;
            border-top: 3px solid #d2d6de;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }
        .table-vcenter td { vertical-align: middle !important; }
        .badge-status {
            padding: 5px 10px; border-radius: 50px;
            font-weight: 600; font-size: 10px; text-transform: uppercase;
        }
        .chart-container { position: relative; height: 280px; width: 100%; }

        /* --- 2. SKELETON WAVE LOADING ANIMATION --- */
        .skeleton-loading {
            position: relative;
            overflow: hidden !important;
            background-color: #f2f2f2 !important; /* Warna dasar abu-abu saat load */
            border: none !important;
        }

        /* Efek Gelombang Cahaya (Shimmer) */
        .skeleton-loading::after {
            content: "";
            position: absolute;
            top: 0; right: 0; bottom: 0; left: 0;
            transform: translateX(-100%);
            background-image: linear-gradient(
                90deg,
                rgba(255, 255, 255, 0) 0,
                rgba(255, 255, 255, 0.3) 20%,
                rgba(255, 255, 255, 0.6) 60%,
                rgba(255, 255, 255, 0)
            );
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            100% { transform: translateX(100%); }
        }

        /* Menyembunyikan konten asli saat class .is-loading aktif */
        .is-loading .info-box-content, 
        .is-loading .info-box-icon, 
        .is-loading .box-header, 
        .is-loading .box-body,
        .is-loading .alert {
            opacity: 0;
            visibility: hidden;
        }

        /* Menghapus background warna asli (bg-green dll) saat loading agar shimmer terlihat */
        .skeleton-loading.bg-green, .skeleton-loading.bg-aqua, 
        .skeleton-loading.bg-yellow, .skeleton-loading.bg-red {
            background-image: none !important;
            background-color: #e0e0e0 !important;
        }

        /* Transisi halus saat konten muncul */
        .info-box, .box {
            transition: opacity 0.5s ease-in-out, transform 0.3s;
        }
    </style>

    {{-- ROW 1: INFO BOXES --}}
    <div class="row">
        @php
            $cards = [
                ['icon' => 'calendar-check-o', 'bg' => 'bg-green', 'title' => 'Tahun Ajaran', 'val' => setting('tahun_ajaran') ?? '-', 'desc' =>  (setting('gelombang_aktif') ?? '1')],
                ['icon' => 'users', 'bg' => 'bg-aqua', 'title' => 'Total Pendaftar', 'val' => number_format($totalPendaftar), 'desc' => 'Pendaftar Terdaftar'],
                ['icon' => 'hourglass-half', 'bg' => 'bg-yellow', 'title' => 'Menunggu Validasi', 'val' => $belumBayar, 'desc' => 'Perlu Tindakan Admin'],
                ['icon' => 'credit-card', 'bg' => 'bg-red', 'title' => 'Belum Bayar', 'val' => $statusPembayaran['belum'], 'desc' => 'Tagihan Aktif'],
            ];
        @endphp

        @foreach($cards as $card)
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box {{ $card['bg'] }} skeleton-loading is-loading">
                <span class="info-box-icon"><i class="fa fa-{{ $card['icon'] }}"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ $card['title'] }}</span>
                    <span class="info-box-number">{{ $card['val'] }}</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 70%"></div>
                    </div>
                    <span class="progress-description">{{ $card['desc'] }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- ROW 2: ALERTS --}}
    <div class="row">
        <div class="col-md-12">
            <div class="skeleton-loading is-loading" style="border-radius:10px; margin-bottom: 20px;">
                @if (setting('status_ppdb') === 'buka')
                    <div class="alert alert-success alert-dismissible" style="border-radius: 10px; margin-bottom:0;">
                        <h4><i class="icon fa fa-check"></i> PPDB Sedang Berjalan!</h4>
                        Sistem pendaftaran online saat ini sedang <strong>DIREKTORI TERBUKA</strong> untuk periode {{ setting('tahun_ajaran') }}.
                    </div>
                @else
                    <div class="alert alert-danger alert-dismissible" style="border-radius: 10px; margin-bottom:0;">
                        <h4><i class="icon fa fa-ban"></i> PPDB Ditutup!</h4>
                        Sistem pendaftaran saat ini sedang dinonaktifkan sementara.
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- ROW 3: CHARTS --}}
    <div class="row">
        <div class="col-md-8">
            <div class="box box-primary skeleton-loading is-loading">
                <div class="box-header with-border">
                    <h3 class="box-title text-bold"><i class="fa fa-line-chart text-blue"></i> Tren Pendaftaran</h3>
                </div>
                <div class="box-body">
                    <div class="chart-container">
                        <canvas id="chartPendaftaran"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="box box-info skeleton-loading is-loading">
                <div class="box-header with-border">
                    <h3 class="box-title text-bold"><i class="fa fa-pie-chart text-aqua"></i> Komposisi</h3>
                </div>
                <div class="box-body">
                    <div class="chart-container">
                        <canvas id="chartPembayaran"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ROW 4: TABLE --}}
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default skeleton-loading is-loading">
                <div class="box-header with-border">
                    <h3 class="box-title text-bold"><i class="fa fa-user-plus text-gray"></i> Aktivitas Pendaftar Terbaru</h3>
                </div>
                <div class="box-body no-padding">
                    <div class="table-responsive">
                        <table class="table table-hover table-vcenter">
                            <thead class="bg-gray-light">
                                <tr>
                                    <th style="width: 50px" class="text-center">NO</th>
                                    <th>BIODATA PENDAFTAR</th>
                                    <th>UNIT TUJUAN</th>
                                    <th>VERIFIKASI BERKAS</th>
                                    <th class="text-center">WAKTU DAFTAR</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendaftarTerbaru as $row)
                                    <tr>
                                        <td class="text-center text-bold">{{ $loop->iteration }}</td>
                                        <td>
                                            <span class="text-bold text-uppercase">{{ $row->nama_lengkap }}</span><br>
                                            <small class="text-muted">{{ $row->asal_sekolah }}</small>
                                        </td>
                                        <td><span class="label label-info">{{ $row->unit->nama_unit ?? '-' }}</span></td>
                                        <td>
                                            <span class="badge-status bg-blue">{{ $row->verifikasi->verifikasi_berkas }}</span>
                                        </td>
                                        <td class="text-center">{{ $row->created_at->diffForHumans() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SCRIPTS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            
            // FUNGSI UNTUK MELEPAS SKELETON LOADING
            function stopSkeletonLoading() {
                const elements = document.querySelectorAll('.skeleton-loading');
                elements.forEach(el => {
                    el.classList.remove('skeleton-loading', 'is-loading');
                });
            }

            // --- 1. CHART TREND ---
            const ctxBar = document.getElementById('chartPendaftaran').getContext('2d');
            const gradient = ctxBar.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(60, 141, 188, 0.8)');
            gradient.addColorStop(1, 'rgba(60, 141, 188, 0.1)');

            new Chart(ctxBar, {
                type: 'line',
                data: {
                    labels: {!! json_encode($hariLabels) !!},
                    datasets: [{
                        label: 'Pendaftar',
                        data: {!! json_encode($dataTren) !!},
                        fill: true,
                        backgroundColor: gradient,
                        borderColor: '#3c8dbc',
                        tension: 0.4
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false }
            });

            // --- 2. CHART PIE ---
            const ctxPie = document.getElementById('chartPembayaran').getContext('2d');
            new Chart(ctxPie, {
                type: 'doughnut',
                data: {
                    labels: ['Valid', 'Pending', 'Invalid', 'Belum'],
                    datasets: [{
                        data: [
                            {{ $statusPembayaran['valid'] }},
                            {{ $statusPembayaran['pending'] }},
                            {{ $statusPembayaran['invalid'] }},
                            {{ $statusPembayaran['belum'] }}
                        ],
                        backgroundColor: ['#00a65a', '#f39c12', '#f56954', '#d2d6de']
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false, cutout: '70%' }
            });

            // --- 3. TRIGGER STOP LOADING ---
            // Kita beri delay 1 detik agar animasi wave/gelombang terlihat cantik sebelum data muncul
            setTimeout(stopSkeletonLoading, 1000);
        });
    </script>
@endsection