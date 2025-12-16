@extends('layouts.masterDashboard')

@section('judul', 'Data Master')
@section('sub-judul', 'Unit')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">

            <div class="box-header with-border">
                <button class="btn btn-success" data-toggle="modal" data-target="#modalTambahUnit">
                    <i class="fa fa-plus"></i> Tambah Unit
                </button>
            </div>

            <div class="box-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Nama Unit</th>
                            <th width="100">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Induk</td>
                            <td class="text-center">
                                <button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modalHapusUnit">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Al-Risalah</td>
                            <td class="text-center">
                                <button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modalHapusUnit">
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
<div class="modal fade" id="modalTambahUnit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <h4 class="modal-title">Tambah Unit</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Unit</label>
                    <input type="text" class="form-control" placeholder="Contoh: Al-Mubtadiin">
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
<div class="modal fade" id="modalHapusUnit">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <h4 class="modal-title">Hapus Unit</h4>
            </div>
            <div class="modal-body text-center">
                Yakin ingin menghapus unit ini?
            </div>
            <div class="modal-footer text-center">
                <button class="btn btn-default" data-dismiss="modal">Batal</button>
                <button class="btn btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>

@endsection
