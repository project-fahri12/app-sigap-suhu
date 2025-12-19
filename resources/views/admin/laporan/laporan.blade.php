@extends('layouts.masterDashboard')

@section('judul', 'Laporan PPDB')
@section('sub-judul', 'Rekapitulasi & Ekspor Data')

@section('content')
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Pendaftar</span>
                <span class="info-box-number">250</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-check-circle"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Lolos/Valid</span>
                <span class="info-box-number">180</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-hourglass-2"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Pending</span>
                <span class="info-box-number">45</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-times-circle"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Ditolak</span>
                <span class="info-box-number">25</span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-filter"></i> Filter Data</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Unit/Jenjang</label>
                            <select class="form-control select2" style="width: 100%;">
                                <option selected="selected">Semua Unit</option>
                                <option>SD IT AL-AMANAH</option>
                                <option>SMP IT AL-AMANAH</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Gelombang</label>
                            <select class="form-control select2" style="width: 100%;">
                                <option selected="selected">Semua Gelombang</option>
                                <option>Gelombang 1</option>
                                <option>Gelombang 2</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Status Verifikasi</label>
                            <select class="form-control select2" style="width: 100%;">
                                <option selected="selected">Semua Status</option>
                                <option>Valid</option>
                                <option>Pending</option>
                                <option>Invalid</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Terapkan Filter</button>
                <button type="reset" class="btn btn-default">Reset</button>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-cloud-download"></i> Ekspor Siswa Lolos</h3>
            </div>
            <div class="box-body text-center">
                <p class="text-muted">Gunakan tombol di bawah untuk mengunduh laporan khusus pendaftar yang statusnya sudah <b>Valid / Lolos Seleksi</b>.</p>
                <div class="btn-group-vertical" style="width: 100%;">
                    <a href="#" class="btn btn-success btn-lg">
                        <i class="fa fa-file-excel-o pull-left"></i> Ekspor ke Excel (.xlsx)
                    </a>
                    <a href="#" class="btn btn-danger btn-lg" style="margin-top: 10px;">
                        <i class="fa fa-file-pdf-o pull-left"></i> Ekspor ke PDF (.pdf)
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Daftar Pendaftar Terkini</h3>
                <div class="box-tools">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body no-padding">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr class="bg-navy">
                                <th width="50">No</th>
                                <th>No. Reg</th>
                                <th>Nama Siswa</th>
                                <th>Unit Tujuan</th>
                                <th>Asal Sekolah</th>
                                <th>Status Bayar</th>
                                <th>Status Berkas</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><span class="badge bg-gray">REG-2024001</span></td>
                                <td><b>Budi Santoso</b></td>
                                <td>SMP IT AL-AMANAH</td>
                                <td>SDN 01 Kediri</td>
                                <td><span class="label label-success">LUNAS</span></td>
                                <td><span class="label label-success">VALID</span></td>
                                <td class="text-center">
                                    <button class="btn btn-xs btn-default" title="Detail"><i class="fa fa-eye"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><span class="badge bg-gray">REG-2024002</span></td>
                                <td><b>Ani Wijaya</b></td>
                                <td>SD IT AL-AMANAH</td>
                                <td>TK Pertiwi</td>
                                <td><span class="label label-success">LUNAS</span></td>
                                <td><span class="label label-success">VALID</span></td>
                                <td class="text-center">
                                    <button class="btn btn-xs btn-default" title="Detail"><i class="fa fa-eye"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td><span class="badge bg-gray">REG-2024003</span></td>
                                <td>Dedi Kurniawan</td>
                                <td>SMP IT AL-AMANAH</td>
                                <td>SDN 05 Kediri</td>
                                <td><span class="label label-warning">PENDING</span></td>
                                <td><span class="label label-warning">CEK BERKAS</span></td>
                                <td class="text-center">
                                    <button class="btn btn-xs btn-default" title="Detail"><i class="fa fa-eye"></i></button>
                                </td>
                            </tr>
                             <tr>
                                <td>4</td>
                                <td><span class="badge bg-gray">REG-2024004</span></td>
                                <td>Citra Lestari</td>
                                <td>SD IT AL-AMANAH</td>
                                <td>TK Mentari</td>
                                <td><span class="label label-danger">BELUM BAYAR</span></td>
                                <td><span class="label label-danger">INVALID</span></td>
                                <td class="text-center">
                                    <button class="btn btn-xs btn-default" title="Detail"><i class="fa fa-eye"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="box-footer clearfix">
                <ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="#">&laquo;</a></li>
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">&raquo;</a></li>
                </ul>
                <span class="text-muted">Menampilkan 4 dari 250 data pendaftar</span>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    .info-box-number { font-size: 24px; }
    .table > therapeutic > tr > th { vertical-align: middle; }
    .btn-lg { text-align: left; padding: 15px 20px; }
    .btn-lg i { font-size: 24px; margin-right: 10px; }
</style>
@endpush