@extends('layouts.masterDashboard')

@section('judul', 'Data Master')
@section('sub-judul', 'Tahun Ajaran')

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

<div class="box box-primary">
    <div class="box-header with-border">
        <button class="btn btn-success" data-toggle="modal" data-target="#modalTambah">
            <i class="fa fa-plus"></i> Tambah Tahun Ajaran
        </button>
    </div>

    <div class="box-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th width="50">No</th>
                    <th>Tahun</th>
                    <th>Periode</th>
                    <th width="120" class="text-center">Status</th>
                    <th width="100" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tahunAjaran as $row)
                <tr id="row-{{ $row->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td><b>{{ $row->tahun }}</b></td>
                    <td>
                        {{ \Carbon\Carbon::parse($row->tanggal_mulai)->format('d M Y') }} - 
                        {{ \Carbon\Carbon::parse($row->tanggal_selesai)->format('d M Y') }}
                    </td>
                    <td class="text-center">
                        <span id="badge-status-{{ $row->id }}" 
                              class="label {{ $row->status === 'aktif' ? 'label-success' : 'label-default' }}"
                              style="min-width: 80px; display: inline-block; padding: 5px;">
                            {{ strtoupper($row->status) }}
                        </span>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-xs btn-warning btn-toggle-status" 
                                data-id="{{ $row->id }}" 
                                data-status="{{ $row->status }}"
                                title="Ganti Status">
                            <i class="fa fa-refresh"></i>
                        </button>
                        <button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#hapus{{ $row->id }}">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted">Data belum tersedia</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Modal Tambah --}}
<div class="modal fade" id="modalTambah">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.tahun-ajaran.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-green">
                    <button class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Tambah Tahun Ajaran</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tahun</label>
                        <input type="text" name="tahun" class="form-control" placeholder="Contoh: 2024/2025" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Mulai</label>
                                <input type="date" name="tanggal_mulai" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Selesai</label>
                                <input type="date" name="tanggal_selesai" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Status Awal</label>
                        <select name="status" class="form-control">
                            <option value="nonaktif">Nonaktif</option>
                            <option value="aktif">Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan Data</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Modal Hapus --}}
@foreach($tahunAjaran as $row)
<div class="modal fade" id="hapus{{ $row->id }}">
    <div class="modal-dialog modal-sm">
        <form method="POST" action="{{ route('admin.tahun-ajaran.destroy', $row->id) }}">
            @csrf @method('DELETE')
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h4>Hapus Data?</h4>
                    <p>Tahun Ajaran <b>{{ $row->tahun }}</b> akan dihapus permanen.</p>
                </div>
                <div class="modal-footer" style="text-align: center;">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).on('click', '.btn-toggle-status', function () {
    let btn = $(this);
    let id = btn.data('id');
    let currentStatus = btn.data('status');
    let newStatus = currentStatus === 'aktif' ? 'nonaktif' : 'aktif';

    btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');

    $.ajax({
        url: `/admin/tahun-ajaran/${id}/status`,
        type: 'PATCH',
        data: { _token: '{{ csrf_token() }}', status: newStatus },
        success: function (res) {
            // Jika aturan sistem hanya boleh ada 1 yang aktif:
            if(newStatus === 'aktif') {
                $('.label[id^="badge-status-"]').removeClass('label-success').addClass('label-default').text('NONAKTIF');
                $('.btn-toggle-status').data('status', 'nonaktif');
            }

            // Update baris ini
            let badge = $('#badge-status-' + id);
            badge.removeClass('label-success label-default')
                 .addClass(newStatus === 'aktif' ? 'label-success' : 'label-default')
                 .text(newStatus.toUpperCase());
            
            btn.data('status', newStatus);
            
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Status diperbarui menjadi ' + newStatus,
                toast: true,
                position: 'top-end',
                timer: 2000,
                showConfirmButton: false
            });
        },
        error: function (xhr) {
            Swal.fire('Gagal', xhr.responseJSON?.message ?? 'Terjadi kesalahan', 'error');
        },
        complete: function () {
            btn.prop('disabled', false).html('<i class="fa fa-refresh"></i>');
        }
    });
});
</script>
@endsection

