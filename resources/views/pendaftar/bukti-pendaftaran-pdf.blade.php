<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>BUKTI PENDAFTARAN</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            text-transform: uppercase; /* 🔥 SEMUA KAPITAL */
        }

        .kop {
            width: 100%;
            border-bottom: 3px solid #000;
            margin-bottom: 15px;
            padding-bottom: 10px;
        }

        .kop table {
            width: 100%;
        }

        .kop .logo {
            width: 80px;
        }

        .kop .title {
            text-align: center;
        }

        .kop h2,
        .kop h3,
        .kop p {
            margin: 2px 0;
        }

        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table.data td {
            padding: 6px;
            vertical-align: top;
        }

        .label {
            width: 35%;
        }

        .box {
            border: 1px solid #000;
            padding: 10px;
            margin-top: 10px;
        }

        .footer {
            margin-top: 40px;
            text-align: right;
        }
    </style>
</head>
<body>

{{-- ================= KOP SURAT ================= --}}
<div class="kop">
    <table>
        <tr>
            <td class="logo">
                @if(!empty($setting['logo']))
                    <img src="{{ public_path($setting['logo']) }}" width="70">
                @endif
            </td>
            <td class="title">
                <h2>{{ $setting['school_name'] ?? 'PPDB MADRASAH' }}</h2>
                <h3>{{ $setting['school_subtitle'] ?? 'SISTEM INFORMASI GERBANG PENDAFTARAN' }}</h3>
                <p>
                    {{ $setting['app_name'] ?? 'SIGAP' }} –
                    TAHUN AJARAN {{ $setting['academic_year'] ?? '2025 / 2026' }}
                </p>
            </td>
        </tr>
    </table>
</div>

<h3 style="text-align:center; margin-bottom:10px;">
    BUKTI PENDAFTARAN PESERTA DIDIK BARU
</h3>

<div class="box">
<table class="data">
    <tr>
        <td class="label">NOMOR PENDAFTARAN</td>
        <td>: {{ strtoupper($pendaftar->kode_pendaftaran) }}</td>
    </tr>
    <tr>
        <td class="label">NAMA LENGKAP</td>
        <td>: {{ strtoupper($pendaftar->nama_lengkap) }}</td>
    </tr>
    <tr>
        <td class="label">NIK</td>
        <td>: {{ strtoupper($pendaftar->nik) }}</td>
    </tr>
    <tr>
        <td class="label">ASAL SEKOLAH</td>
        <td>: {{ strtoupper($pendaftar->asal_sekolah) }}</td>
    </tr>
    <tr>
        <td class="label">TANGGAL DAFTAR</td>
        <td>: {{ strtoupper($verifikasi->created_at->format('d F Y')) }}</td>
    </tr>
    <tr>
        <td class="label">STATUS BERKAS</td>
        <td>: {{ strtoupper($verifikasi->verifikasi_berkas) }}</td>
    </tr>
    <tr>
        <td class="label">STATUS PEMBAYARAN</td>
        <td>: {{ strtoupper($verifikasi->verifikasi_pembayaran) }}</td>
    </tr>
</table>
</div>

<p style="margin-top:15px;">
    BUKTI PENDAFTARAN INI MERUPAKAN BUKTI SAH BAHWA PESERTA DIDIK
    TELAH MELAKUKAN PENDAFTARAN PPDB SECARA ONLINE.
</p>

<div class="footer">
    {{ strtoupper(now()->format('d F Y')) }} <br>
    PANITIA PPDB
</div>

</body>
</html>
