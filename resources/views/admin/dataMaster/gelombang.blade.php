@extends('layouts.masterDashboard')

@section('judul', 'Data Master')
@section('sub-judul', 'Gelombang')

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
                            <th>Periode</th>
                            <th class="text-center">Status</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($gelombang as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->nama_gelombang }}</td>
                            <td>{{ $row->tahunAjaran->tahun ?? '-' }}</td>
                            <td>
                                {{ \Carbon\Carbon::parse($row->tanggal_mulai)->format('d M Y') }} - 
                                {{ \Carbon\Carbon::parse($row->tanggal_selesai)->format('d M Y') }}
                            </td>
                            <td class="text-center">
                                <span id="label-status-{{ $row->id }}" 
                                    class="label {{ $row->status === 'dibuka' ? 'label-success' : 'label-default' }}"
                                    style="min-width: 60px; display: inline-block;">
                                    {{ ucfirst($row->status) }}
                                </span>
                            </td>
                           {{-- Tombol di dalam @foreach --}}
<td class="text-center">
    <button class="btn btn-xs btn-warning btn-status-toggle" 
        data-id="{{ $row->id }}" 
        data-status="{{ $row->status }}"
        data-url="{{ route('admin.gelombang.status', $row->id) }}"
        title="Ubah Status">
        <i class="fa fa-refresh"></i>
    </button>
    
    <button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#edit{{ $row->id }}">
        <i class="fa fa-edit"></i>
    </button>

    <button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#hapus{{ $row->id }}">
        <i class="fa fa-trash"></i>
    </button>
</td>

</td>
                        </tr>

                        {{-- Modal Edit --}}
                        <div class="modal fade" id="edit{{ $row->id }}">
                            <div class="modal-dialog">
                                <form method="POST" action="{{ route('admin.gelombang.update', $row->id) }}">
                                    @csrf @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header bg-blue">
                                            <h4 class="modal-title">Edit Gelombang</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Nama Gelombang</label>
                                                <input type="text" name="nama_gelombang" class="form-control" value="{{ $row->nama_gelombang }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Tahun Ajaran</label>
                                                <select name="tahun_ajaran_id" class="form-control" required>
                                                    @foreach($tahunAjaran as $ta)
                                                        <option value="{{ $ta->id }}" {{ $row->tahun_ajaran_id == $ta->id ? 'selected' : '' }}>{{ $ta->tahun }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Mulai</label>
                                                <input type="date" name="tanggal_mulai" class="form-control" value="{{ $row->tanggal_mulai }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Selesai</label>
                                                <input type="date" name="tanggal_selesai" class="form-control" value="{{ $row->tanggal_selesai }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="status" class="form-control" required>
                                                    <option value="dibuka" {{ $row->status == 'dibuka' ? 'selected' : '' }}>Dibuka</option>
                                                    <option value="ditutup" {{ $row->status == 'ditutup' ? 'selected' : '' }}>Ditutup</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- Modal Hapus --}}
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
                                            @csrf @method('DELETE')
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Data belum tersedia</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal Tambah --}}
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
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
// AJAX Status Toggle
$(document).on('click', '.btn-status-toggle', function() {
    let btn = $(this);
    let url = btn.data('url'); 
    let id = btn.data('id');
    let currentStatus = btn.data('status');
    let newStatus = currentStatus === 'buka' ? 'tutup' : 'buka';

    btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');

    $.ajax({
        url: url, 
        type: 'PATCH',
        data: {
            _token: '{{ csrf_token() }}',
            status: newStatus
        },
        success: function(res) {
            let label = $('#label-status-' + id);
            
            // Update UI secara instan
            if (newStatus === 'buka') {
                label.removeClass('label-default').addClass('label-success').text('Dibuka');
            } else {
                label.removeClass('label-success').addClass('label-default').text('Ditutup');
            }

            // Simpan status baru ke atribut tombol
            btn.data('status', newStatus);

            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: res.message,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000
            });
        },
        error: function(xhr) {
            Swal.fire('Error', xhr.responseJSON?.message ?? 'Gagal mengubah status', 'error');
        },
        complete: function() {
            btn.prop('disabled', false).html('<i class="fa fa-refresh"></i>');
        }
    });
});
// Loading Button for forms
$(document).on('submit', 'form', function () {
    let btn = $(this).find('button[type="submit"]');
    btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Tunggu...');
});
</script>

@endsection

