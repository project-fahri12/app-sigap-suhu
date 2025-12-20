@extends('layouts.masterDashboard')

@section('judul', 'Data Master')
@section('sub-judul', 'Sekolah Pilihan')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary ">

            {{-- HEADER --}}
            <div class="box-header with-border">
                <button class="btn btn-success" data-toggle="modal" data-target="#modalTambah">
                    <i class="fa fa-plus"></i> Tambah Sekolah
                </button>
            </div>

            {{-- TABLE --}}
            <div class="box-body table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="50">NO</th>
                            <th>NAMA SEKOLAH</th>
                            <th>JENJANG</th>
                            <th width="100" class="text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>

                    @forelse($sekolah as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><b>{{ strtoupper($row->nama_sekolah) }}</b></td>
                            <td>
                                <span class="label label-info">
                                    {{ strtoupper($row->jenjang) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <button
                                    class="btn btn-xs btn-danger btn-hapus"
                                    data-id="{{ $row->id }}"
                                    data-nama="{{ $row->nama_sekolah }}">
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
        <form method="POST" action="{{ route('admin.sekolah-pilihan.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-green">
                    <h4 class="modal-title">Tambah Sekolah</h4>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Sekolah</label>
                        <input type="text"
                               name="nama_sekolah"
                               class="form-control"
                               placeholder="Nama sekolah"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Jenjang</label>
                        <select name="jenjang" class="form-control" required>
                            <option value="">-- pilih jenjang --</option>
                            <option value="RA/TK">RA/TK</option>
                            <option value="SD/MI">SD/MI</option>
                            <option value="SLTP">SLTP</option>
                            <option value="SLTA">SLTA</option>
                            <option value="PERGURUAN TINGGI">Perguruan Tinggi</option>
                            <option value="SALAF">Salaf</option>
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

<form id="form-delete" method="POST">
    @csrf
    @method('DELETE')
</form>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true
});

@if(session('success'))
Toast.fire({
    icon: 'success',
    title: "{{ session('success') }}"
});
@endif

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

$('.btn-hapus').click(function () {
    let id = $(this).data('id');
    let nama = $(this).data('nama');

    Swal.fire({
        title: 'Hapus Sekolah?',
        text: nama,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonText: 'Batal',
        confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#form-delete')
                .attr('action', '/admin/sekolah-pilihan/' + id)
                .submit();
        }
    });
});

$('form').on('submit', function () {
    let btn = $(this).find('.btn-loading');
    if (btn.length) {
        btn.prop('disabled', true);
        btn.html('<i class="fa fa-spinner fa-spin"></i> ' + btn.data('text'));
    }
});
</script>
@endsection

