@extends('layouts.masterDashboard')

@section('content')
    {{-- Load SDK Midtrans --}}
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    <style>
        /* CSS untuk Stepper Progress Dinamis */
        .step-item {
            position: relative;
            padding-bottom: 25px;
            padding-left: 35px;
        }

        .step-item::before {
            content: "";
            position: absolute;
            left: 11px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #eee;
        }

        .step-item:last-child::before {
            display: none;
        }

        .step-icon {
            position: absolute;
            left: 0;
            top: 0;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: #fff;
            border: 2px solid #ddd;
            text-align: center;
            line-height: 20px;
            font-size: 11px;
            z-index: 1;
            font-weight: bold;
            color: #999;
        }

        /* Warna Status */
        .step-success .step-icon {
            background: #00a65a;
            border-color: #00a65a;
            color: #fff;
        }

        .step-active .step-icon {
            background: #3c8dbc;
            border-color: #3c8dbc;
            color: #fff;
        }

        .step-danger .step-icon {
            background: #dd4b39;
            border-color: #dd4b39;
            color: #fff;
        }

        .step-locked .step-icon {
            background: #f4f4f4;
            border-color: #ddd;
            color: #ccc;
        }

        .step-content h5 {
            margin-top: 0;
            font-weight: bold;
            margin-bottom: 3px;
        }

        .step-content p {
            margin-bottom: 0;
        }

        .step-warning .step-icon {
            background: #f39c12 !important;
            border-color: #e67e22 !important;
            color: #fff !important;
        }
    </style>

    @php
        // LOGIKA DINAMIS PROGRESS
        // 1. Data Pendaftaran
        $step1Done = !empty($santri->nama_lengkap);

        // 2. Pembayaran
        $step2Valid = $verifikasi && $verifikasi->verifikasi_pembayaran === 'valid';
        $step2Pending = $pembayaran && $pembayaran->status === 'pending' && !$step2Valid;
        $step2Invalid = $verifikasi && $verifikasi->verifikasi_pembayaran === 'invalid';

        // 3. Upload Berkas (Asumsi ada kolom file_kk di table pendaftar/santri)
        $step3Active = $step2Valid;
        $step3Done = $step2Valid && !empty($santri->verifikasi->verifikasi_berkas);
    @endphp

    <div class="row">
        <div class="col-md-12">
            {{-- Alert Notifikasi --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
                    {{ session('success') }}
                </div>
            @endif

            <div class="row">
                {{-- PANEL KIRI: PROGRESS TRACKER --}}
                <div class="col-md-4">
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h4 class="box-title text-blue"><i class="fa fa-tasks"></i> Progress Pendaftaran</h4>
                        </div>
                        <div class="box-body">

                            {{-- STEP 1: DATA PENDAFTARAN --}}
                            <div class="step-item {{ $step1Done ? 'step-success' : 'step-active' }}">
                                <div class="step-icon"><i class="fa {{ $step1Done ? 'fa-check' : 'fa-edit' }}"></i></div>
                                <div class="step-content">
                                    <h5>Data Pendaftaran</h5>
                                    <p class="text-muted small">Lengkapi profil pendaftar</p>
                                </div>
                            </div>

                            {{-- STEP 2: PEMBAYARAN --}}
                            @php
                                $step2Class = $step2Valid
                                    ? 'step-success'
                                    : ($step2Invalid
                                        ? 'step-danger'
                                        : 'step-active');
                            @endphp
                            <div class="step-item {{ $step2Class }}">
                                <div class="step-icon">
                                    @if ($step2Valid)
                                        <i class="fa fa-check"></i>
                                    @elseif($step2Invalid)
                                        <i class="fa fa-times"></i>
                                    @else
                                        2
                                    @endif
                                </div>
                                <div class="step-content">
                                    <h5>Pembayaran Biaya</h5>
                                    <p class="small">
                                        @if ($step2Valid)
                                            <span class="text-success">Pembayaran Lunas</span>
                                        @elseif($step2Invalid)
                                            <span class="text-danger">Pembayaran Ditolak</span>
                                        @elseif($step2Pending)
                                            <span class="text-warning">Menunggu Pembayaran</span>
                                        @else
                                            <span class="text-muted">Belum Bayar</span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            {{-- STEP 3: UPLOAD BERKAS (DINAMIS) --}}
                            @php
                                $vBerkas = $verifikasi->verifikasi_berkas ?? 'belum';

                                // Tentukan Class CSS berdasarkan status verifikasi berkas
                                if (!$step2Valid) {
                                    $step3Class = 'step-locked';
                                } elseif ($vBerkas == 'valid') {
                                    $step3Class = 'step-success';
                                } elseif ($vBerkas == 'invalid') {
                                    $step3Class = 'step-danger';
                                } elseif ($vBerkas == 'pending') {
                                    $step3Class = 'step-warning'; // Menunggu verifikasi
                                } else {
                                    $step3Class = 'step-active'; // Pembayaran lunas tapi belum upload
                                }
                            @endphp

                            <div class="step-item {{ $step3Class }}">
                                <div class="step-icon">
                                    @if (!$step2Valid)
                                        <i class="fa fa-lock"></i>
                                    @elseif ($vBerkas == 'valid')
                                        <i class="fa fa-check"></i>
                                    @elseif ($vBerkas == 'invalid')
                                        <i class="fa fa-times"></i>
                                    @elseif ($vBerkas == 'pending')
                                        <i class="fa fa-clock-o"></i>
                                    @else
                                        <i class="fa fa-upload"></i>
                                    @endif
                                </div>
                                <div class="step-content">
                                    <h5>Upload Berkas</h5>
                                    <p class="small">
                                        @if (!$step2Valid)
                                            <span class="text-muted">Terkunci (Selesaikan Pembayaran)</span>
                                        @elseif ($vBerkas == 'valid')
                                            <span class="text-success">Berkas Diterima</span>
                                        @elseif ($vBerkas == 'invalid')
                                            <span class="text-danger">Berkas Ditolak (Upload Ulang)</span>
                                        @elseif ($vBerkas == 'pending')
                                            <span class="text-warning">Menunggu Verifikasi</span>
                                        @else
                                            <span class="text-primary">Silahkan Unggah Berkas</span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- PANEL KANAN: DETAIL PEMBAYARAN --}}
                <div class="col-md-8">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-credit-card"></i> Detail Tagihan</h3>
                        </div>

                        <div class="box-body">
                            @if ($step2Valid)
                                {{-- TAMPILAN JIKA SUDAH LUNAS --}}
                                <div class="well text-center" style="background: #f0fdf4; border: 1px solid #bbf7d0;">
                                    <i class="fa fa-check-circle text-success" style="font-size: 60px;"></i>
                                    <h2 class="text-success" style="margin-top: 10px; font-weight: bold;">LUNAS</h2>
                                    <p>
                                        Terima kasih <strong>{{ str($santri->nama_lengkap)->upper() }}</strong>,
                                        pembayaran Anda telah kami terima.
                                    </p>
                                    <hr>
                                    <a href="{{ route('pendaftar.upload-berkas.index') }}"
                                        class="btn btn-success btn-lg shadow">
                                        Lanjut Upload Berkas <i class="fa fa-arrow-right"></i>
                                    </a>
                                </div>
                            @else
                                {{-- TAMPILAN JIKA BELUM LUNAS --}}
                                <div class="text-center" style="padding: 20px 0;">
                                    <p class="text-muted">Total Biaya Pendaftaran:</p>
                                    <h1 style="margin-top: 0; font-weight: bold;">Rp
                                        {{ number_format(setting('biaya_pendaftaran') ?? 0, 0, ',', '.') }}</h1>

                                    @if ($step2Invalid)
                                        <div class="alert alert-danger" style="border-radius: 10px;">
                                            <h4><i class="icon fa fa-warning"></i> Pembayaran Ditolak</h4>
                                            <p>{{ $verifikasi->catatan }}</p>
                                        </div>
                                    @endif

                                    @if ($step2Pending)
                                        <div class="callout callout-warning text-left" style="border-radius: 10px;">
                                            <h4>Menunggu Pembayaran</h4>
                                            <p>Silahkan selesaikan pembayaran Anda menggunakan metode yang telah dipilih
                                                sebelumnya.</p>
                                        </div>
                                    @endif

                                    <div style="margin-top: 30px;">
                                        <button class="btn btn-primary btn-lg px-5 shadow" id="pay-button"
                                            style="min-width: 250px; font-weight: bold;">
                                            <i class="fa fa-shield"></i>
                                            {{ $step2Pending ? 'Lanjutkan Pembayaran' : 'Bayar Sekarang' }}
                                        </button>
                                    </div>
                                    <p class="small text-muted" style="margin-top: 15px;">
                                        <i class="fa fa-lock"></i> Pembayaran aman didukung oleh <strong>Midtrans</strong>
                                    </p>
                                </div>

                                <div class="box-footer" style="background: #fafafa; border-radius: 10px;">
                                    <p class="text-muted small"><i class="fa fa-info-circle"></i> ID Transaksi Anda:
                                        <strong>{{ $pembayaran->order_id ?? '-' }}</strong>
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SCRIPT SNAP --}}
    @if (!$step2Valid && isset($snapToken))
        <script type="text/javascript">
            const payButton = document.getElementById('pay-button');
            payButton.onclick = function(e) {
                e.preventDefault();

                // Animasi loading
                const originalContent = this.innerHTML;
                this.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menghubungkan...';
                this.disabled = true;

                window.snap.pay('{{ $snapToken }}', {
                    onSuccess: function(result) {
                        window.location.reload();
                    },
                    onPending: function(result) {
                        window.location.reload();
                    },
                    onError: function(result) {
                        alert("Terjadi kesalahan teknis.");
                        payButton.innerHTML = originalContent;
                        payButton.disabled = false;
                    },
                    onClose: function() {
                        // Kembalikan tombol jika user menutup popup tanpa bayar
                        payButton.innerHTML = originalContent;
                        payButton.disabled = false;
                    }
                });
            };
        </script>
    @endif
@endsection


{{-- Semua tinggal memperbaik ki logika nya tidak bole ditaruh di view --}}