@extends('layouts.masterDashboard')

@section('judul', 'Manajemen Pengguna')
@section('sub-judul', 'Daftar Akun Sistem')

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap.min.css">
<style>
    /* Styling tetap sama seperti sebelumnya */
    .box { border-radius: 12px; border-top: 3px solid #00a65a; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05); }
    .label-pill { padding: 5px 12px; border-radius: 50px; font-weight: 600; font-size: 10px; text-transform: uppercase; display: inline-block; min-width: 80px; color: white; text-align: center; }
    .role-admin { background-color: #dd4b39 !important; } 
    .role-petugas { background-color: #f39c12 !important; } 
    .role-pendaftar { background-color: #00c0ef !important; } 
    .skeleton-loading { position: relative; overflow: hidden; background-color: #f2f2f2; min-height: 200px; }
    .is-loading > * { opacity: 0; visibility: hidden; }
</style>
@endpush

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-success skeleton-loading is-loading" id="main-box">
            <div class="box-header with-border">
                <h3 class="box-title" style="font-weight: 700;">
                    <i class="fa fa-users text-green"></i> Daftar Akun Pengguna
                </h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalTambah">
                        <i class="fa fa-user-plus"></i> Tambah Akun
                    </button>
                </div>
            </div>

            <div class="box-body">
                <div class="table-responsive">
                    <table id="table-pengguna" class="table table-hover table-vcenter" width="100%">
                        <thead class="bg-gray-light">
                            <tr>
                                <th width="50" class="text-center">NO</th>
                                <th>NAMA PENGGUNA</th>
                                <th>EMAIL</th>
                                <th class="text-center">HAK AKSES</th>
                                <th width="100" class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataPengguna as $pengguna)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td><b>{{ $pengguna->username }}</b></td>
                                    <td class="text-muted">{{ $pengguna->email ?? '-' }}</td>
                                    <td class="text-center">
                                        <span class="label-pill role-{{ $pengguna->role }}">{{ $pengguna->role }}</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#edit{{ $pengguna->id }}">
                                                <i class="fa fa-edit text-blue"></i>
                                            </button>
                                            <button class="btn btn-default btn-sm btn-hapus" data-id="{{ $pengguna->id }}" data-nama="{{ $pengguna->name }}">
                                                <i class="fa fa-trash text-red"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                {{-- Modal Edit disertakan di sini (seperti kode Anda sebelumnya) --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Modal Tambah disertakan di sini --}}
@endsection

@push('scripts')
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        // 1. Inisialisasi DataTable
        var table = $('#table-pengguna').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            },
            "pageLength": 10,
            "order": [[0, "asc"]]
        });

        // 2. Hilangkan Skeleton setelah tabel siap
        setTimeout(function() {
            $('#main-box').removeClass('skeleton-loading is-loading');
        }, 500);

        // 3. Handle Form Spinner
        $(document).on('submit', '.form-submit', function() {
            var btn = $(this).find('.btn-loading');
            btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Memproses...');
        });

        // 4. Handle Hapus (Event Delegation agar tetap jalan saat ganti page datatable)
        $(document).on('click', '.btn-hapus', function() {
            var id = $(this).data('id');
            var nama = $(this).data('nama');
            Swal.fire({
                title: 'Hapus Akun?',
                text: "Akun " + nama + " akan dihapus permanen.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#form-hapus').attr('action', '/admin/data-akun/' + id).submit();
                }
            });
        });
    });
</script>
@endpush