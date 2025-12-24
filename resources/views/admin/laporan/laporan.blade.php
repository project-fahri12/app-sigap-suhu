@extends('layouts.masterDashboard')

@section('judul', 'Laporan PPDB')
@section('sub-judul', 'Rekapitulasi & Ekspor Data')

@section('content')
<style>
    /* KONSISTENSI FORM & BOX */
    .box { border-radius: 12px; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.05); transition: 0.3s; }
    .box-header { padding: 15px 20px; border-bottom: 1px solid #f4f4f4; }
    .box-title { font-weight: 700 !important; color: #333; }
    
    /* INFO BOX MODERN */
    .info-box { border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.03); min-height: 90px; }
    .info-box-icon { border-top-left-radius: 12px; border-bottom-left-radius: 12px; height: 90px; line-height: 90px; }
    .info-box-content { padding: 15px; }
    .info-box-text { font-weight: 600; text-transform: uppercase; font-size: 12px; color: #666; }
    .info-box-number { font-size: 24px; font-weight: 800; }

    /* FILTER STYLING */
    .filter-label { font-size: 11px; font-weight: 700; color: #3c8dbc; text-transform: uppercase; margin-bottom: 5px; display: block; }
    .form-control { border-radius: 8px; border: 1px solid #dce1e7; height: 40px; box-shadow: none; }
    .form-control:focus { border-color: #3c8dbc; box-shadow: none; }

    /* TABLE STYLING */
    .table thead th { background: #2c3b41; color: #fff; text-transform: uppercase; font-size: 11px; letter-spacing: 0.5px; padding: 12px 8px; border: none; }
    .table tbody td { vertical-align: middle; padding: 12px 8px; border-bottom: 1px solid #f4f4f4; }
    
    /* STATUS BADGE (KONSISTEN DENGAN HALAMAN VERIFIKASI) */
    .badge-status { padding: 4px 10px; border-radius: 50px; font-weight: 600; font-size: 10px; letter-spacing: 0.5px; text-transform: uppercase; display: inline-block; }
    .bg-valid { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
    .bg-invalid { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    .bg-pending { background-color: #fff3cd; color: #856404; border: 1px solid #ffeeba; }

    /* BUTTONS */
    .btn-flat-modern { border-radius: 8px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; transition: 0.3s; }
</style>

{{-- ================= SUMMARY STATS ================= --}}
<div class="row">
    @foreach([
        ['Total Pendaftar', $total, 'aqua', 'users'],
        ['Lolos Verifikasi', $valid, 'green', 'check-circle'],
        ['Proses Pending', $pending, 'yellow', 'clock-o'],
        ['Data Ditolak', $ditolak, 'red', 'times-circle'],
    ] as [$label,$value,$color,$icon])
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box shadow-sm">
                <span class="info-box-icon bg-{{ $color }}"><i class="fa fa-{{ $icon }}"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ $label }}</span>
                    <span class="info-box-number">{{ number_format($value) }}</span>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="row">
    {{-- ================= FILTER PANEL ================= --}}
    <div class="col-md-12">
        <form method="GET" class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-filter text-primary"></i> Filter Pencarian</h3>
            </div>
            <div class="box-body" style="padding: 20px;">
                <div class="row">
                    <div class="col-md-3">
                        <span class="filter-label">Pilih Unit</span>
                        <select name="unit" class="form-control">
                            <option value="">-- SEMUA UNIT --</option>
                            @foreach($units as $u)
                                <option value="{{ $u->id }}" @selected(request('unit')==$u->id)>
                                    {{ strtoupper($u->nama_unit) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <span class="filter-label">Pilih Gelombang</span>
                        <select name="gelombang" class="form-control">
                            <option value="">-- SEMUA GELOMBANG --</option>
                            @foreach($gelombangs as $g)
                                <option value="{{ $g->id }}" @selected(request('gelombang')==$g->id)>
                                    {{ strtoupper($g->nama_gelombang) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <span class="filter-label">Status Verifikasi</span>
                        <select name="status" class="form-control">
                            <option value="">-- SEMUA STATUS --</option>
                            <option value="valid" @selected(request('status')=='valid')>Lolos (Valid)</option>
                            <option value="pending" @selected(request('status')=='pending')>Pending</option>
                            <option value="invalid" @selected(request('status')=='invalid')>Ditolak</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <span class="filter-label">&nbsp;</span>
                        <div class="btn-group btn-group-justified">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-primary btn-flat-modern">
                                    <i class="fa fa-search"></i> Cari
                                </button>
                            </div>
                            <div class="btn-group">
                                <a href="{{ route('admin.laporan.index') }}" class="btn btn-default btn-flat-modern">
                                    <i class="fa fa-refresh"></i> Reset
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- ================= DATA TABLE ================= --}}
    <div class="col-md-12">
        <div class="box box-default">
            <div class="box-header with-border" style="background: #fff;">
                <h3 class="box-title"><i class="fa fa-list text-muted"></i> Data Calon Santri</h3>

                <div class="box-tools pull-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm dropdown-toggle btn-flat-modern" data-toggle="dropdown">
                            <i class="fa fa-download"></i> EKSPOR DATA <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right shadow" role="menu">
                            <li><a href="{{ route('admin.laporan.export.excel', request()->query()) }}"><i class="fa fa-file-excel-o text-green"></i> Format Excel</a></li>
                            <li><a href="{{ route('admin.laporan.export.pdf', request()->query()) }}"><i class="fa fa-file-pdf-o text-red"></i> Format PDF</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('admin.laporan.export.csv', request()->query()) }}"><i class="fa fa-file-text-o text-blue"></i> Format CSV</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="box-body no-padding">
                <div class="table-responsive">
                    <table class="table table-hover" style="margin-bottom: 0;">
                        <thead>
                            <tr>
                                <th width="50" class="text-center">NO</th>
                                <th>KODE DAFTAR</th>
                                <th>NAMA LENGKAP</th>
                                <th>UNIT TUJUAN</th>
                                <th>ASAL SEKOLAH</th>
                                <th class="text-center">PEMBAYARAN</th>
                                <th class="text-center">BERKAS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pendaftar as $row)
                                @php
                                    $v = $row->verifikasi;
                                    $statusBayar = $v?->verifikasi_pembayaran ?? 'pending';
                                    $statusBerkas = $v?->verifikasi_berkas ?? 'pending';
                                @endphp
                                <tr>
                                    <td class="text-center text-muted">{{ $loop->iteration + $pendaftar->firstItem() - 1 }}</td>
                                    <td><code style="font-weight: bold; color: #3c8dbc;">{{ $row->kode_pendaftaran }}</code></td>
                                    <td>
                                        <div style="font-weight: 700;">{{ strtoupper($row->nama_lengkap) }}</div>
                                        <small class="text-muted" style="font-size: 10px;"><i class="fa fa-clock-o"></i> {{ $row->created_at->format('d/m/Y H:i') }}</small>
                                    </td>
                                    <td><span class="text-uppercase">{{ $row->unit->nama_unit ?? '-' }}</span></td>
                                    <td><span class="text-uppercase">{{ $row->asal_sekolah ?? '-' }}</span></td>
                                    <td class="text-center">
                                        <span class="badge-status bg-{{ $statusBayar }}">
                                            {{ $statusBayar }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge-status bg-{{ in_array($statusBerkas, ['invalid','belum']) ? 'invalid' : ($statusBerkas == 'valid' ? 'valid' : 'pending') }}">
                                            {{ $statusBerkas }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center" style="padding: 40px;">
                                        <i class="fa fa-folder-open-o fa-3x text-muted" style="opacity: 0.3;"></i>
                                        <p class="text-muted" style="margin-top: 10px;">Data tidak ditemukan dengan filter tersebut.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="box-footer clearfix" style="background: #fafafa; border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
                <div class="row">
                    <div class="col-sm-6 text-muted" style="margin-top: 10px;">
                        Menampilkan <b>{{ $pendaftar->firstItem() }}</b> sampai <b>{{ $pendaftar->lastItem() }}</b> dari <b>{{ $pendaftar->total() }}</b> pendaftar
                    </div>
                    <div class="col-sm-6 text-right">
                        {{ $pendaftar->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection