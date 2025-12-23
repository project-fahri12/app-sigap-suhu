@extends('layouts.masterDashboard')

@section('judul', 'DATA PENDAFTARAN')
@section('sub-judul', 'MANAJEMEN CALON SANTRI')

@section('content')

<div class="row text-uppercase">

<div class="col-md-3">
    <div class="info-box bg-aqua">
        <span class="info-box-icon"><i class="fa fa-users"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">TOTAL PENDAFTAR</span>
            <span class="info-box-number">{{ $total }}</span>
            <small>SELURUH DATA</small>
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
            <small>PROSES VERIFIKASI</small>
        </div>
    </div>
</div>

<div class="col-md-3">
    <div class="info-box bg-red">
        <span class="info-box-icon"><i class="fa fa-times-circle"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">DITOLAK</span>
            <span class="info-box-number">{{ $ditolak }}</span>
            <small>TIDAK VALID</small>
        </div>
    </div>
</div>

</div>

<form method="GET" action="{{ route('admin.data-pendaftar.index') }}" class="text-uppercase">
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">
            <i class="fa fa-filter"></i> FILTER DATA
        </h3>
    </div>

<div class="box-body">
<div class="row">

<div class="col-md-3">
    <label>TAHUN AJARAN</label>
    <select name="tahun_ajaran" class="form-control">
        <option value="">SEMUA</option>
        @foreach ($tahunAjaran as $ta)
            <option value="{{ $ta->id }}" @selected(request('tahun_ajaran') == $ta->id)>
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
            <option value="{{ $g->id }}" @selected(request('gelombang') == $g->id)>
                {{ strtoupper($g->nama_gelombang) }}
            </option>
        @endforeach
    </select>
</div>

<div class="col-md-3">
    <label>STATUS</label>
    <select name="status" class="form-control">
        <option value="">SEMUA</option>
        <option value="valid" @selected(request('status')=='valid')>TERVERIFIKASI</option>
        <option value="pending" @selected(request('status')=='pending')>MENUNGGU</option>
        <option value="ditolak" @selected(request('status')=='ditolak')>DITOLAK</option>
    </select>
</div>

<div class="col-md-3">
    <label>PENCARIAN</label>
    <input type="text" name="search" class="form-control"
        value="{{ request('search') }}"
        placeholder="NAMA / NIK / KODE">
</div>

</div>

<hr>

<div class="text-right">
    <button class="btn btn-primary">
        <i class="fa fa-search"></i> FILTER
    </button>
    <a href="{{ route('admin.data-pendaftar.index') }}" class="btn btn-default">
        <i class="fa fa-refresh"></i> RESET
    </a>
</div>
</div>
</div>
</form>

<div class="box box-success">
<div class="box-header with-border">
    <h3 class="box-title">
        <i class="fa fa-database"></i> DAFTAR PENDAFTAR
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
    <td>{{ $loop->iteration + $pendaftar->firstItem() - 1 }}</td>
    <td><span class="label label-info">{{ $item->kode_pendaftaran }}</span></td>
    <td>{{ $item->nama_lengkap }}</td>
    <td>{{ $item->nik }}</td>
    <td>{{ $item->asal_sekolah ?? '-' }}</td>
    <td>{{ $item->gelombang->nama_gelombang ?? '-' }}</td>
    <td>
        @php($v = $item->verifikasi)
        @if(!$v)
            <span class="label label-default">BELUM ADA</span>
        @elseif($v->verifikasi_berkas === 'valid' && $v->verifikasi_pembayaran === 'valid')
            <span class="label label-success">VALID</span>
        @elseif($v->verifikasi_berkas === 'invalid' || $v->verifikasi_pembayaran === 'invalid')
            <span class="label label-danger">DITOLAK</span>
        @else
            <span class="label label-warning">MENUNGGU</span>
        @endif
    </td>
    <td>
        <a href="{{ route('admin.data-pendaftar.show', $item->id) }}" class="btn btn-xs btn-info">DETAIL</a>
        <a href="{{ route('admin.data-pendaftar.edit', $item->id) }}" class="btn btn-xs btn-warning">EDIT</a>
    </td>
</tr>
@empty
<tr>
    <td colspan="8" class="text-center text-muted">
        DATA TIDAK DITEMUKAN
    </td>
</tr>
@endforelse

</tbody>
</table>
</div>

<div class="box-footer clearfix text-uppercase">
<div class="pull-left">
    MENAMPILKAN {{ $pendaftar->firstItem() ?? 0 }} –
    {{ $pendaftar->lastItem() ?? 0 }}
    DARI {{ $pendaftar->total() }} DATA
</div>
<div class="pull-right">
    {{ $pendaftar->links('pagination::bootstrap-4') }}
</div>
</div>

</div>

@endsection
