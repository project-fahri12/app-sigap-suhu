@extends('layouts.masterDashboard')

@section('judul', 'Data Pendaftaran')
@section('sub-judul', 'Manajemen Calon Santri')

@section('content')

{{-- ================================================= --}}
{{-- RINGKASAN STATISTIK --}}
{{-- ================================================= --}}
<div class="row">

    <div class="col-md-3">
        <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Pendaftar</span>
                <span class="info-box-number">{{ $total }}</span>
                <small>Seluruh gelombang</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-check-circle"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Terverifikasi</span>
                <span class="info-box-number">{{ $terverifikasi }}</span>
                <small>berkas & pembayaran</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa fa-clock-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Menunggu</span>
                <span class="info-box-number">{{ $menunggu }}</span>
                <small>Masih proses</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-times-circle"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Ditolak</span>
                <span class="info-box-number">{{ $ditolak }}</span>
                <small>Tidak memenuhi syarat</small>
            </div>
        </div>
    </div>

</div>

{{-- ================================================= --}}
{{-- FILTER & AKSI --}}
{{-- ================================================= --}}
<form method="GET" action="{{ route('admin.data-pendaftar.index') }}">
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">
            <i class="fa fa-filter"></i> Filter & Aksi Data
        </h3>
    </div>

    <div class="box-body">
        <div class="row">

            <div class="col-md-3">
                <label>Tahun Ajaran</label>
                <select name="tahun_ajaran" class="form-control">
                    <option value="">Semua</option>
                    @foreach ($tahunAjaran as $ta)
                        <option value="{{ $ta->id }}"
                            {{ request('tahun_ajaran') == $ta->id ? 'selected' : '' }}>
                            {{ $ta->tahun }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label>Gelombang</label>
                <select name="gelombang" class="form-control">
                    <option value="">Semua</option>
                    @foreach ($gelombang as $g)
                        <option value="{{ $g->id }}"
                            {{ request('gelombang') == $g->id ? 'selected' : '' }}>
                            {{ $g->nama_gelombang }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="">Semua Status</option>
                    <option value="valid" {{ request('status') == 'valid' ? 'selected' : '' }}>Terverifikasi</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                    <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>

            <div class="col-md-3">
                <label>Cari Nama / NIK / Kode</label>
                <input type="text" name="search" class="form-control"
                       value="{{ request('search') }}"
                       placeholder="Ketik pencarian...">
            </div>

        </div>

        <hr>

        <div class="row">
            <div class="col-md-12 text-right">
                <button class="btn btn-primary">
                    <i class="fa fa-search"></i> Terapkan Filter
                </button>

                <a href="{{ route('admin.data-pendaftar.index') }}" class="btn btn-default">
                    <i class="fa fa-refresh"></i> Reset
                </a>
            </div>
        </div>
    </div>
</div>
</form>

{{-- ================================================= --}}
{{-- TABEL DATA PENDAFTAR --}}
{{-- ================================================= --}}
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">
            <i class="fa fa-database"></i> Daftar Calon Santri
        </h3>
    </div>

    <div class="box-body table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th width="3%">#</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>Asal Sekolah</th>
                    <th>Gelombang</th>
                    <th>Status</th>
                    <th width="20%">Aksi</th>
                </tr>
            </thead>
            <tbody>

            @forelse ($pendaftar as $item)
                <tr>
                    <td>{{ $loop->iteration + ($pendaftar->firstItem() - 1) }}</td>

                    <td>
                        <span class="label label-info">
                            {{ $item->kode_pendaftaran }}
                        </span>
                    </td>

                    <td>{{ $item->nama_lengkap }}</td>
                    <td>{{ $item->nik }}</td>
                    <td>{{ $item->asal_sekolah ?? '-' }}</td>
                    <td>{{ $item->gelombang->nama_gelombang ?? '-' }}</td>

                    {{-- STATUS --}}
                    <td>
                        @php
                            $verif = $item->verifikasi;
                        @endphp

                        @if (!$verif)
                            <span class="label label-default">Belum Ada</span>
                        @elseif ($verif->verifikasi_berkas === 'valid' && $verif->verifikasi_pembayaran === 'valid')
                            <span class="label label-success">Terverifikasi</span>
                        @elseif ($verif->verifikasi_berkas === 'ditolak' || $verif->verifikasi_pembayaran === 'ditolak')
                            <span class="label label-danger">Ditolak</span>
                        @else
                            <span class="label label-warning">Menunggu</span>
                        @endif
                    </td>

                    {{-- AKSI --}}
                    <td>
                        <a href="{{ route('admin.data-pendaftar.show', $item->id) }}"
                           class="btn btn-xs btn-info">
                            <i class="fa fa-eye"></i> Detail
                        </a>

                        <a href="{{ route('admin.data-pendaftar.edit', $item->id) }}"
                           class="btn btn-xs btn-warning">
                            <i class="fa fa-edit"></i> Edit
                        </a>

                        <form action="{{ route('admin.data-pendaftar.destroy', $item->id) }}"
                              method="POST"
                              style="display:inline-block"
                              onsubmit="return confirm('Yakin hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-xs btn-danger">
                                <i class="fa fa-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">
                        Data tidak ditemukan
                    </td>
                </tr>
            @endforelse

            </tbody>
        </table>
    </div>

    <div class="box-footer clearfix">
        <div class="pull-left">
            Menampilkan
            <strong>{{ $pendaftar->firstItem() }}</strong>
            -
            <strong>{{ $pendaftar->lastItem() }}</strong>
            dari
            <strong>{{ $pendaftar->total() }}</strong> data
        </div>

        <div class="pull-right">
            {{ $pendaftar->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>

@endsection
