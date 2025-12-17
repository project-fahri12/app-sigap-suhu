@extends('layouts.masterDashboard')

@section('judul', 'Data Master')
@section('sub-judul', 'Tahun Ajaran')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">

            <div class="box-header with-border">
                <button class="btn btn-success" data-toggle="modal" data-target="#modalTambah">
                    <i class="fa fa-plus"></i> Tambah Tahun Ajaran
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
                            <th>Tahun</th>
                            <th>Periode</th>
                            <th>Status</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tahunAjaran as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->tahun }}</td>
                            <td>
                                {{ \Carbon\Carbon::parse($row->tanggal_mulai)->format('d M Y') }}
                                -
                                {{ \Carbon\Carbon::parse($row->tanggal_selesai)->format('d M Y') }}
                            </td>
                            <td>
                                @if($row->status === 'aktif')
                                    <span class="label label-success">Aktif</span>
                                @else
                                    <span class="label label-default">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#hapus{{ $row->id }}">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>

                        <div class="modal fade" id="hapus{{ $row->id }}">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header bg-red">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Konfirmasi Hapus</h4>
                                    </div>
                                    <div class="modal-body text-center">
                                        <p>
                                            Yakin ingin menghapus<br>
                                            <strong>{{ $row->tahun }}</strong>?
                                        </p>
                                    </div>
                                    <div class="modal-footer text-center">
                                        <form method="POST" action="{{ route('admin.tahun-ajaran.destroy', $row->id) }}">
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
                            <td colspan="5" class="text-center text-muted">
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

<div class="modal fade" id="modalTambah">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.tahun-ajaran.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-green">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Tambah Tahun Ajaran</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tahun</label>
                        <input type="text" name="tahun" class="form-control" value="{{ old('tahun') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
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
