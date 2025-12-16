@extends('layouts.masterDashboard')

@section('judul', 'Data Master')
@section('sub-judul', 'Sekolah Pilihan')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-warning">

            <div class="box-header with-border">
                <button class="btn btn-success" data-toggle="modal" data-target="#modalTambahSekolah">
                    <i class="fa fa-plus"></i> Tambah Sekolah
                </button>
            </div>

            <div class="box-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Nama Sekolah</th>
                            <th>Jenjang</th>
                            <th width="100">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>SMP Negeri 1</td>
                            <td>SLTP</td>
                            <td class="text-center">
                                <button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modalHapusSekolah">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>SMA Negeri 1</td>
                            <td>SLTA</td>
                            <td class="text-center">
                                <button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modalHapusSekolah">
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
<div class="modal fade" id="modalTambahSekolah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <h4 class="modal-title">Tambah Sekolah</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Sekolah</label>
                    <input type="text" class="form-control">
                </div>

                <div class="form-group">
                    <label>Jenjang</label>
                    <select class="form-control">
                        <option>SLTP</option>
                        <option>SLTA</option>
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
<div class="modal fade" id="modalHapusSekolah">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <h4 class="modal-title">Hapus Sekolah</h4>
            </div>
            <div class="modal-body text-center">
                Yakin ingin menghapus sekolah ini?
            </div>
            <div class="modal-footer text-center">
                <button class="btn btn-default" data-dismiss="modal">Batal</button>
                <button class="btn btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>

@endsection
