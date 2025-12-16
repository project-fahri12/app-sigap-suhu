@extends('layouts.masterDashboard')

@section('judul', 'Data Master')
@section('sub-judul', 'Gelombang')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-success">

            <div class="box-header with-border">
                <button class="btn btn-success" data-toggle="modal" data-target="#modalTambahGelombang">
                    <i class="fa fa-plus"></i> Tambah Gelombang
                </button>
            </div>

            <div class="box-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Gelombang</th>
                            <th>Tahun Ajaran</th>
                            <th>Status</th>
                            <th width="100">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Gelombang 1</td>
                            <td>2025 / 2026</td>
                            <td><span class="label label-success">Dibuka</span></td>
                            <td class="text-center">
                                <button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modalHapusGelombang">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Gelombang 2</td>
                            <td>2025 / 2026</td>
                            <td><span class="label label-default">Ditutup</span></td>
                            <td class="text-center">
                                <button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modalHapusGelombang">
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

{{-- MODAL TAMBAH --}}
<div class="modal fade" id="modalTambahGelombang">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <h4 class="modal-title">Tambah Gelombang</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Gelombang</label>
                    <input type="text" class="form-control" placeholder="Gelombang 1">
                </div>

                <div class="form-group">
                    <label>Tahun Ajaran</label>
                    <select class="form-control">
                        <option>2025 / 2026</option>
                        <option>2024 / 2025</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control">
                        <option>Dibuka</option>
                        <option>Ditutup</option>
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

{{-- MODAL HAPUS --}}
<div class="modal fade" id="modalHapusGelombang">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <h4 class="modal-title">Hapus Gelombang</h4>
            </div>
            <div class="modal-body text-center">
                Yakin ingin menghapus gelombang ini?
            </div>
            <div class="modal-footer text-center">
                <button class="btn btn-default" data-dismiss="modal">Batal</button>
                <button class="btn btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>

@endsection
