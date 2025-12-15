@extends('layouts.masterDashboard')

@section('content')
<div class="box box-primary">
    <div class="box-header bg-primary">
        <h3 class="box-title" style="color:#fff;">
    <i class="fa fa-user"></i> IDENTITAS SANTRI
</h3>

    </div>

    <div class="box-body">

        {{-- FOTO --}}
        <div class="row mb-3">
            <div class="col-md-3 d-flex flex-column align-items-center">
                <div class="ratio ratio-3x4 w-100">
                    <img
                        src="{{ $berkas && $berkas->foto_path
                                ? asset('storage/'.$berkas->foto_path)
                                : asset('assets/default-user.png') }}"
                        class="img-fluid img-thumbnail object-fit-cover"
                        alt="Pas Foto">
                </div>
                <small class="text-muted mt-2">PAS FOTO 3X4</small>
            </div>
        </div>

        {{-- TAB --}}
        <ul class="nav nav-tabs">
            <li class="active"><a href="#santri" data-toggle="tab">Santri</a></li>
            <li><a href="#ortu" data-toggle="tab">Orang Tua</a></li>
            <li><a href="#wali" data-toggle="tab">Wali</a></li>
            <li><a href="#berkas" data-toggle="tab">Berkas</a></li>
        </ul>

        <div class="tab-content mt-3">

            {{-- SANTRI --}}
            <div class="tab-pane active" id="santri">
                <table class="table table-bordered">
                    <tr><th>Nama Lengkap</th><td>{{ strtoupper($pendaftar->nama_lengkap) }}</td></tr>
                    <tr><th>NIK</th><td>{{ $pendaftar->nik }}</td></tr>
                    <tr><th>Tempat, Tanggal Lahir</th>
                        <td>{{ strtoupper($pendaftar->tempat_lahir) }},
                            {{ \Carbon\Carbon::parse($pendaftar->tanggal_lahir)->format('d F Y') }}
                        </td>
                    </tr>
                    <tr><th>Jenis Kelamin</th>
                        <td>{{ $pendaftar->jenis_kelamin == 'L' ? 'LAKI-LAKI' : 'PEREMPUAN' }}</td>
                    </tr>
                    <tr><th>Alamat</th><td>{{ strtoupper($pendaftar->alamat) }}</td></tr>
                </table>
            </div>

            {{-- ORANG TUA --}}
            <div class="tab-pane" id="ortu">
                <table class="table table-bordered">
                    <tr><th>Nama Ayah</th><td>{{ strtoupper($orangTua->nama_ayah ?? '-') }}</td></tr>
                    <tr><th>Pekerjaan Ayah</th><td>{{ strtoupper($orangTua->pekerjaan_ayah ?? '-') }}</td></tr>
                    <tr><th>No HP Ayah</th><td>{{ $orangTua->no_hp_ayah ?? '-' }}</td></tr>
                    <tr><th>Nama Ibu</th><td>{{ strtoupper($orangTua->nama_ibu ?? '-') }}</td></tr>
                    <tr><th>Pekerjaan Ibu</th><td>{{ strtoupper($orangTua->pekerjaan_ibu ?? '-') }}</td></tr>
                    <tr><th>No HP Ibu</th><td>{{ $orangTua->no_hp_ibu ?? '-' }}</td></tr>
                </table>
            </div>

            {{-- WALI --}}
            <div class="tab-pane" id="wali">
                <table class="table table-bordered">
                    <tr><th>Nama Wali</th><td>{{ strtoupper($wali->nama_wali ?? '-') }}</td></tr>
                    <tr><th>Hubungan</th><td>{{ strtoupper($wali->hubungan_wali ?? '-') }}</td></tr>
                    <tr><th>Pekerjaan</th><td>{{ strtoupper($wali->pekerjaan_wali ?? '-') }}</td></tr>
                    <tr><th>No HP</th><td>{{ $wali->no_hp_wali ?? '-' }}</td></tr>
                </table>
            </div>

            {{-- BERKAS --}}
            <div class="tab-pane" id="berkas">
                @if($berkas)
                    <a href="{{ asset('storage/'.$berkas->file_path) }}"
                       target="_blank"
                       class="btn btn-primary">
                        <i class="fa fa-file-pdf-o"></i> LIHAT BERKAS PDF
                    </a>
                @else
                    <span class="text-muted">BELUM ADA BERKAS</span>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection
