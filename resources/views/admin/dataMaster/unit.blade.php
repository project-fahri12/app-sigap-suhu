@extends('layouts.masterDashboard')

@section('judul', 'Data Master')
@section('sub-judul', 'Unit')

@section('content')

@if(session('error'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4><i class="icon fa fa-ban"></i> Peringatan!</h4>
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4><i class="icon fa fa-check"></i> Sukses!</h4>
        {{ session('success') }}
    </div>
@endif

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">

            <div class="box-header with-border">
                <button class="btn btn-success" data-toggle="modal" data-target="#modalTambahUnit">
                    <i class="fa fa-plus"></i> Tambah Unit
                </button>
            </div>

            <div class="box-body">

                @if(session('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ session('success') }}
                </div>
                @endif

                @if($errors->any())
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <ul style="margin:0;padding-left:18px">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Nama Unit</th>
                            <th>Jenis Santri</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($unit as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->nama_unit }}</td>
                            <td>
                                @if($row->jenis_kelamin === 'putra')
                                    <span class="label label-primary">Putra</span>
                                @elseif($row->jenis_kelamin === 'putri')
                                    <span class="label label-danger">Putri</span>
                                @else
                                    <span class="label label-success">Putra & Putri</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#hapus{{ $row->id }}">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>

                        <div class="modal fade" id="hapus{{ $row->id }}">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header bg-red">
                                        <h4 class="modal-title">Hapus Unit</h4>
                                    </div>
                                    <div class="modal-body text-center">
                                        Yakin ingin menghapus<br>
                                        <strong>{{ $row->nama_unit }}</strong>?
                                    </div>
                                    <div class="modal-footer text-center">
                                        <form method="POST" action="{{ route('admin.unit.destroy', $row->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-danger btn-loading" data-text="Menghapus...">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                Data belum tersedia
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambahUnit">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.unit.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-green">
                    <h4 class="modal-title">Tambah Unit</h4>
                </div>
                <div class="modal-body">    
                    <div class="form-group">
                        <label>Nama Unit</label>
                        <input type="text" name="nama_unit" class="form-control" placeholder="contoh : subulul huda induk" required>
                    </div>

                    <div class="form-group">
                        <label>Jenis Santri</label>
                        <select name="jenis_kelamin" class="form-control" required>
                            <option value="campur" selected>Putra & Putri</option>
                            <option value="putra">Putra saja</option>
                            <option value="putri">Putri saja</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success btn-loading" data-text="Menyimpan...">
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).on('submit', 'form', function () {
    let btn = $(this).find('.btn-loading');
    if (btn.length) {
        btn.prop('disabled', true);
        btn.html('<i class="fa fa-spinner fa-spin"></i> ' + btn.data('text'));
    }
});
</script>
@endpush
