@extends('layouts.masterDashboard')

@section('judul', 'Data Master')
@section('sub-judul', 'Tahun Ajaran')

@section('content')

{{-- ================================================== --}}
{{-- BUTTON TAMBAH --}}
{{-- ================================================== --}}
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <button class="btn btn-success" data-toggle="modal" data-target="#modalTambah">
                    <i class="fa fa-plus"></i> Tambah Tahun Ajaran
                </button>
            </div>

            {{-- ================================================== --}}
            {{-- TABLE DATA --}}
            {{-- ================================================== --}}
            <div class="box-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width:50px">No</th>
                            <th>Tahun Ajaran</th>
                            <th>Status</th>
                            <th style="width:120px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>2025 / 2026</td>
                            <td>
                                <span class="label label-success">
                                    Aktif
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modalHapus">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>2024 / 2025</td>
                            <td>
                                <span class="label label-default">
                                    Tidak Aktif
                                </span>
                            </td>
                            <td>

                                <button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modalHapus">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- ================================================== --}}
{{-- MODAL TAMBAH --}}
{{-- ================================================== --}}
<div class="modal fade" id="modalTambah">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header bg-green">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">
                    <i class="fa fa-plus"></i> Tambah Tahun Ajaran
                </h4>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label>Tahun Ajaran</label>
                    <input type="text" class="form-control" placeholder="Contoh: 2025 / 2026">
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control">
                        <option>Aktif</option>
                        <option>Tidak Aktif</option>
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Batal</button>
                <button class="btn btn-success">Simpan</button>
            </div>

        </div>
    </div>
</div>

{{-- ================================================== --}}
{{-- MODAL HAPUS --}}
{{-- ================================================== --}}
<div class="modal fade" id="modalHapus">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <div class="modal-header bg-red">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">
                    <i class="fa fa-trash"></i> Konfirmasi Hapus
                </h4>
            </div>

            <div class="modal-body text-center">
                <p>
                    Yakin ingin menghapus<br>
                    <strong>Tahun Ajaran 2025 / 2026</strong>?
                </p>
            </div>

            <div class="modal-footer text-center">
                <button class="btn btn-default" data-dismiss="modal">Batal</button>
                <button class="btn btn-danger">Hapus</button>
            </div>

        </div>
    </div>
</div>

@endsection
