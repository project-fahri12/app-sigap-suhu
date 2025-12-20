@extends('layouts.masterDashboard')

@section('judul', 'Data Master')
@section('sub-judul', 'Unit')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">

            {{-- HEADER --}}
            <div class="box-header with-border">
                <button class="btn btn-success" data-toggle="modal" data-target="#modalTambah">
                    <i class="fa fa-plus"></i> Tambah Unit
                </button>
            </div>

            {{-- TABLE --}}
            <div class="box-body table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="50">NO</th>
                            <th>NAMA UNIT</th>
                            <th>JENIS SANTRI</th>
                            <th width="100" class="text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>

                    @forelse($unit as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><b>{{ strtoupper($row->nama_unit) }}</b></td>
                            <td>
                                @if($row->jenis_kelamin === 'putra')
                                    <span class="label label-primary">PUTRA</span>
                                @elseif($row->jenis_kelamin === 'putri')
                                    <span class="label label-danger">PUTRI</span>
                                @else
                                    <span class="label label-success">PUTRA & PUTRI</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button
                                    class="btn btn-xs btn-danger btn-hapus"
                                    data-id="{{ $row->id }}"
                                    data-nama="{{ $row->nama_unit }}">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                DATA BELUM TERSEDIA
                            </td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

{{-- MODAL TAMBAH --}}
<div class="modal fade" id="modalTambah">
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
                        <input type="text"
                               name="nama_unit"
                               class="form-control"
                               placeholder="Contoh: Subulul Huda Induk"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Jenis Santri</label>
                        <select name="jenis_kelamin" class="form-control" required>
                            <option value="campur">Putra & Putri</option>
                            <option value="putra">Putra saja</option>
                            <option value="putri">Putri saja</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-success btn-loading" data-text="Menyimpan...">
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- FORM DELETE (HIDDEN) --}}
<form id="form-delete" method="POST">
    @csrf
    @method('DELETE')
</form>

{{-- SWEETALERT --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
/* ================= TOAST ================= */
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 5000,
    timerProgressBar: true
});

/* SUCCESS */
@if(session('success'))
Toast.fire({
    icon: 'success',
    title: "{{ session('success') }}"
});
@endif

/* ERROR */
@if(session('error'))
Toast.fire({
    icon: 'error',
    title: "{{ session('error') }}"
});
@endif

/* VALIDATION */
@if($errors->any())
Toast.fire({
    icon: 'warning',
    title: "{{ $errors->first() }}"
});
@endif

/* ================= DELETE CONFIRM ================= */
$('.btn-hapus').click(function () {
    let id   = $(this).data('id');
    let nama = $(this).data('nama');

    Swal.fire({
        title: 'Hapus Unit?',
        text: nama,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonText: 'Batal',
        confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#form-delete')
                .attr('action', '/admin/unit/' + id)
                .submit();
        }
    });
});

/* ================= BUTTON LOADING ================= */
$('form').on('submit', function () {
    let btn = $(this).find('.btn-loading');
    if (btn.length) {
        btn.prop('disabled', true);
        btn.html('<i class="fa fa-spinner fa-spin"></i> ' + btn.data('text'));
    }
});
</script>

@endsection
