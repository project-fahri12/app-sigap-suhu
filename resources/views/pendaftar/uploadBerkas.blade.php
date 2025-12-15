@extends('layouts.masterDashboard')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">

        {{-- INFO --}}
        <div class="alert alert-info">
            <strong><i class="fa fa-info-circle"></i> Dokumen Wajib</strong>
            <ul style="padding-left:20px;">
                <li>KK</li>
                <li>Akta</li>
                <li>Ijazah / SKL</li>
                <li>Pas Foto</li>
                <li>(Opsional) KIP / Prestasi</li>
            </ul>
            <small>✔ Digabung 1 PDF (max 5MB)</small>
        </div>

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <i class="fa fa-upload"></i> Upload Berkas
                </h3>
            </div>

            {{-- ALERT --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- ================= STATUS ================= --}}
            @if($verifikasi)
                <div class="box-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Status Berkas</th>
                            <td>
                                @if($verifikasi->verifikasi_berkas == 'belum')
                                    <span class="label label-default">Belum Upload</span>
                                @elseif($verifikasi->verifikasi_berkas == 'pending')
                                    <span class="label label-warning">Menunggu Verifikasi</span>
                                @elseif($verifikasi->verifikasi_berkas == 'valid')
                                    <span class="label label-success">Diterima</span>
                                @elseif($verifikasi->verifikasi_berkas == 'invalid')
                                    <span class="label label-danger">Ditolak</span>
                                @endif
                            </td>
                        </tr>

                        @if($berkas)
                        <tr>
                            <th>Tanggal Upload</th>
                            <td>{{ $berkas->created_at->format('d F Y') }}</td>
                        </tr>
                        @endif

                        @if($verifikasi->catatan)
                        <tr>
                            <th>Catatan Panitia</th>
                            <td>{{ $verifikasi->catatan }}</td>
                        </tr>
                        @endif
                    </table>

                    {{-- JIKA VALID --}}
                    @if($verifikasi->verifikasi_berkas == 'valid')
                        <a href=""
                           class="btn btn-success">
                            <i class="fa fa-print"></i> Cetak Bukti
                        </a>
                    @endif

                    {{-- JIKA INVALID --}}
                    @if($verifikasi->verifikasi_berkas == 'invalid')
                        <div class="alert alert-danger">
                            Berkas ditolak, silakan upload ulang.
                        </div>
                    @endif
                </div>
            @endif

            {{-- ================= FORM UPLOAD ================= --}}
            @if(
                !$verifikasi ||
                in_array($verifikasi->verifikasi_berkas, ['belum','invalid'])
            ) route('pendaftar.upload-berkas.store') }}
                <form action="{{"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="box-body">
                        <div class="form-group">
                            <label>Upload PDF</label>
                            <input type="file"
                                   name="file"
                                   class="form-control"
                                   accept="application/pdf"
                                   required>
                        </div>
                    </div>

                    <div class="box-footer text-right">
                        <button class="btn btn-primary">
                            <i class="fa fa-paper-plane"></i> Upload
                        </button>
                    </div>
                </form>
            @endif

        </div>
    </div>
</div>
@endsection
