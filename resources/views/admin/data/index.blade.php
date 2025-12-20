@extends('layouts.masterDashboard')

@section('judul', 'DATA PENDAFTARAN')
@section('sub-judul', 'MANAJEMEN CALON SANTRI')

@section('content')

{{-- ================================================= --}}
{{-- RINGKASAN STATISTIK --}}
{{-- ================================================= --}}

<div class="row text-uppercase">

<div class="col-md-3">
    <div class="info-box bg-aqua">
        <span class="info-box-icon"><i class="fa fa-users"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">TOTAL PENDAFTAR</span>
            <span class="info-box-number">{{ $total }}</span>
            <small>SELURUH GELOMBANG</small>
        </div>
    </div>
</div>

<div class="col-md-3">
    <div class="info-box bg-green">
        <span class="info-box-icon"><i class="fa fa-check-circle"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">TERVERIFIKASI</span>
            <span class="info-box-number">{{ $terverifikasi }}</span>
            <small>BERKAS & PEMBAYARAN</small>
        </div>
    </div>
</div>

<div class="col-md-3">
    <div class="info-box bg-yellow">
        <span class="info-box-icon"><i class="fa fa-clock-o"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">MENUNGGU</span>
            <span class="info-box-number">{{ $menunggu }}</span>
            <small>MASIH PROSES</small>
        </div>
    </div>
</div>

<div class="col-md-3">
    <div class="info-box bg-red">
        <span class="info-box-icon"><i class="fa fa-times-circle"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">DITOLAK</span>
            <span class="info-box-number">{{ $ditolak }}</span>
            <small>TIDAK MEMENUHI SYARAT</small>
        </div>
    </div>
</div>

</div>

{{-- ================================================= --}}
{{-- FILTER & AKSI --}}
{{-- ================================================= --}}

<form method="GET" action="{{ route('admin.data-pendaftar.index') }}" class="text-uppercase">
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">
            <i class="fa fa-filter"></i> FILTER & AKSI DATA
        </h3>
    </div>

<div class="box-body">
    <div class="row">

        <div class="col-md-3">
            <label>TAHUN AJARAN</label>
            <select name="tahun_ajaran" class="form-control">
                <option value="">SEMUA</option>
                @foreach ($tahunAjaran as $ta)
                    <option value="{{ $ta->id }}" {{ request('tahun_ajaran') == $ta->id ? 'selected' : '' }}>
                        {{ strtoupper($ta->tahun) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label>GELOMBANG</label>
            <select name="gelombang" class="form-control">
                <option value="">SEMUA</option>
                @foreach ($gelombang as $g)
                    <option value="{{ $g->id }}" {{ request('gelombang') == $g->id ? 'selected' : '' }}>
                        {{ strtoupper($g->nama_gelombang) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label>STATUS</label>
            <select name="status" class="form-control">
                <option value="">SEMUA STATUS</option>
                <option value="valid" {{ request('status') == 'valid' ? 'selected' : '' }}>TERVERIFIKASI</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>MENUNGGU</option>
                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>DITOLAK</option>
            </select>
        </div>

        <div class="col-md-3">
            <label>CARI NAMA / NIK / KODE</label>
            <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="KETIK PENCARIAN...">
        </div>

    </div>

    <hr>

    <div class="row">
        <div class="col-md-12 text-right">
            <button class="btn btn-primary">
                <i class="fa fa-search"></i> TERAPKAN FILTER
            </button>

            <a href="{{ route('admin.data-pendaftar.index') }}" class="btn btn-default">
                <i class="fa fa-refresh"></i> RESET
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
            <i class="fa fa-database"></i> DAFTAR CALON SANTRI
        </h3>
    </div>

<div class="box-body table-responsive">
    <table class="table table-bordered table-hover text-uppercase">
        <thead>
            <tr>
                <th>#</th>
                <th>KODE</th>
                <th>NAMA</th>
                <th>NIK</th>
                <th>ASAL SEKOLAH</th>
                <th>GELOMBANG</th>
                <th>STATUS</th>
                <th>AKSI</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($pendaftar as $item)
            <tr>
                <td>{{ $loop->iteration + ($pendaftar->firstItem() - 1) }}</td>
                <td><span class="label label-info">{{ strtoupper($item->kode_pendaftaran) }}</span></td>
                <td>{{ strtoupper($item->nama_lengkap) }}</td>
                <td>{{ strtoupper($item->nik) }}</td>
                <td>{{ strtoupper($item->asal_sekolah ?? '-') }}</td>
                <td>{{ strtoupper($item->gelombang->nama_gelombang ?? '-') }}</td>
                <td>
                    @php $verif = $item->verifikasi; @endphp
                    @if (!$verif)
                        <span class="label label-default">BELUM ADA</span>
                    @elseif ($verif->verifikasi_berkas === 'valid' && $verif->verifikasi_pembayaran === 'valid')
                        <span class="label label-success">TERVERIFIKASI</span>
                    @elseif ($verif->verifikasi_berkas === 'invalid' || $verif->verifikasi_pembayaran === 'invalid')
                        <span class="label label-danger">DITOLAK</span>
                    @else
                        <span class="label label-warning">MENUNGGU</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.data-pendaftar.show', $item->id) }}" class="btn btn-xs btn-info">DETAIL</a>
                    <a href="{{ route('admin.data-pendaftar.edit', $item->id) }}" class="btn btn-xs btn-warning">EDIT</a>
                    <form action="{{ route('admin.data-pendaftar.destroy', $item->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('YAKIN HAPUS DATA INI?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-xs btn-danger">HAPUS</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center text-muted">DATA TIDAK DITEMUKAN</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<div class="box-footer clearfix text-uppercase">
    <div class="pull-left">
        MENAMPILKAN <strong>{{ $pendaftar->firstItem() }}</strong> - <strong>{{ $pendaftar->lastItem() }}</strong>
        DARI <strong>{{ $pendaftar->total() }}</strong> DATA
    </div>
    <div class="pull-right">
        {{ $pendaftar->links('pagination::bootstrap-4') }}
    </div>
</div>
```

</div>

@endsection
