@extends('layouts.masterDashboard')

@section('judul', 'LAPORAN PPDB')
@section('sub-judul', 'REKAPITULASI & EKSPOR DATA')

@section('content')

{{-- ================= SUMMARY ================= --}}
<div class="row">
@foreach([
    ['TOTAL PENDAFTAR', $total, 'aqua', 'users'],
    ['VALID / LOLOS', $valid, 'green', 'check-circle'],
    ['PENDING', $pending, 'yellow', 'clock-o'],
    ['DITOLAK', $ditolak, 'red', 'times-circle'],
] as [$label,$value,$color,$icon])
    <div class="col-md-3 col-xs-6">
        <div class="info-box bg-{{ $color }}">
            <span class="info-box-icon"><i class="fa fa-{{ $icon }}"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">{{ $label }}</span>
                <span class="info-box-number">{{ $value }}</span>
            </div>
        </div>
    </div>
@endforeach
</div>

{{-- ================= FILTER ================= --}}
<form method="GET" class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-filter"></i> FILTER DATA</h3>
    </div>

    <div class="box-body row">
        <div class="col-md-4">
            <label>UNIT</label>
            <select name="unit" class="form-control">
                <option value="">SEMUA</option>
                @foreach($units as $u)
                    <option value="{{ $u->id }}" @selected(request('unit')==$u->id)>
                        {{ strtoupper($u->nama_unit) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4">
            <label>GELOMBANG</label>
            <select name="gelombang" class="form-control">
                <option value="">SEMUA</option>
                @foreach($gelombangs as $g)
                    <option value="{{ $g->id }}" @selected(request('gelombang')==$g->id)>
                        {{ strtoupper($g->nama_gelombang) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4">
            <label>STATUS</label>
            <select name="status" class="form-control">
                <option value="">SEMUA</option>
                <option value="valid" @selected(request('status')=='valid')>VALID</option>
                <option value="pending" @selected(request('status')=='pending')>PENDING</option>
                <option value="invalid" @selected(request('status')=='invalid')>DITOLAK</option>
            </select>
        </div>
    </div>

    <div class="box-footer text-right">
        <button class="btn btn-primary"><i class="fa fa-search"></i> TERAPKAN</button>
        <a href="{{ route('admin.laporan.index') }}" class="btn btn-default">RESET</a>
    </div>
</form>

{{-- ================= TABLE ================= --}}
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-table"></i> DATA SANTRI</h3>

        {{-- EXPORT BUTTON DI ATAS TABEL --}}
        <div class="box-tools pull-right">
            <a href="{{ route('admin.laporan.export.excel') }}" class="btn btn-success btn-sm">
                <i class="fa fa-file-excel-o"></i> EXCEL
            </a>
            <a href="{{ route('admin.laporan.export.pdf') }}" class="btn btn-danger btn-sm">
                <i class="fa fa-file-pdf-o"></i> PDF
            </a>
            <a href="{{ route('admin.laporan.export.csv') }}" class="btn btn-info btn-sm">
                <i class="fa fa-file-text-o"></i> CSV
            </a>
        </div>
    </div>

    <div class="box-body table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="bg-navy">
                <tr>
                    <th width="40">NO</th>
                    <th>KODE</th>
                    <th>NAMA</th>
                    <th>UNIT</th>
                    <th>ASAL SEKOLAH</th>
                    <th>BAYAR</th>
                    <th>BERKAS</th>
                </tr>
            </thead>
            <tbody>
            @forelse($pendaftar as $row)
                @php($v = $row->verifikasi)
                <tr>
                    <td>{{ $loop->iteration + $pendaftar->firstItem() - 1 }}</td>
                    <td><span class="label label-info">{{ strtoupper($row->kode_pendaftaran) }}</span></td>
                    <td><b>{{ strtoupper($row->nama_lengkap) }}</b></td>
                    <td>{{ strtoupper($row->unit->nama_unit ?? '-') }}</td>
                    <td>{{ strtoupper($row->asal_sekolah ?? '-') }}</td>

                    <td>
                        <span class="label label-{{ $v?->verifikasi_pembayaran==='valid'?'success':($v?->verifikasi_pembayaran==='invalid'?'danger':'warning') }}">
                            {{ strtoupper($v?->verifikasi_pembayaran ?? 'PENDING') }}
                        </span>
                    </td>

                    <td>
                        <span class="label label-{{ in_array($v?->verifikasi_berkas,['invalid','belum'])?'danger':($v?->verifikasi_berkas==='valid'?'success':'warning') }}">
                            {{ strtoupper($v?->verifikasi_berkas ?? 'PENDING') }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center text-muted">DATA KOSONG</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="box-footer clearfix">
        <div class="pull-left">
            MENAMPILKAN {{ $pendaftar->firstItem() }}–{{ $pendaftar->lastItem() }} DARI {{ $pendaftar->total() }}
        </div>
        <div class="pull-right">
            {{ $pendaftar->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>

@endsection
