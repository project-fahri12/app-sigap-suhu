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
                            <th>Gelombang</th>
                            <th>Tahun Ajaran</th>
                            <th>Periode</th>
                            <th>Status</th>
                            <th width="100">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($gelombang as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->nama_gelombang }}</td>
                            <td>{{ $row->tahunAjaran->tahun ?? '-' }}</td>
                            <td>
                                {{ \Carbon\Carbon::parse($row->tanggal_mulai)->format('d M Y') }}
                                -
                                {{ \Carbon\Carbon::parse($row->tanggal_selesai)->format('d M Y') }}
                            </td>
                            <td>
                                @if($row->status === 'dibuka')
                                    <span class="label label-success">Dibuka</span>
                                @else
                                    <span class="label label-default">Ditutup</span>
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
                                        <h4 class="modal-title">Hapus Gelombang</h4>
                                    </div>
                                    <div class="modal-body text-center">
                                        Yakin ingin menghapus<br>
                                        <strong>{{ $row->nama_gelombang }}</strong>?
                                    </div>
                                    <div class="modal-footer text-center">
                                        <form method="POST" action="{{ route('admin.gelombang.destroy', $row->id) }}">
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
                            <td colspan="6" class="text-center text-muted">
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

<div class="modal fade" id="modalTambahGelombang">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.gelombang.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-green">
                    <h4 class="modal-title">Tambah Gelombang</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Gelombang</label>
                        <input type="text" name="nama_gelombang" class="form-control" placeholder="Gelombang I" required>
                    </div>

                    <div class="form-group">
                        <label>Tahun Ajaran</label>
                        <select name="tahun_ajaran_id" class="form-control" required>
                            @foreach($tahunAjaran as $ta)
                                <option value="{{ $ta->id }}">{{ $ta->tahun }}</option>
                            @endforeach
                        </select>
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
                            <option value="dibuka">Dibuka</option>
                            <option value="ditutup">Ditutup</option>
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
