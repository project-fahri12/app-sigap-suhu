@extends('layouts.masterDashboard')

@section('judul', 'Data Master')
@section('sub-judul', 'Tahun Ajaran')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">

                {{-- HEADER --}}
                <div class="box-header with-border">
                    <button class="btn btn-success" data-toggle="modal" data-target="#modalTambah">
                        <i class="fa fa-plus"></i> Tambah Tahun Ajaran
                    </button>
                </div>

                {{-- TABLE --}}
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead >
                            <tr>
                                <th width="50">NO</th>
                                <th>TAHUN</th>
                                <th>PERIODE</th>
                                <th class="text-center">STATUS</th>
                                <th width="120" class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse($tahunAjaran as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><b>{{ $row->tahun }}</b></td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($row->tanggal_mulai)->format('d M Y') }}
                                        -
                                        {{ \Carbon\Carbon::parse($row->tanggal_selesai)->format('d M Y') }}
                                    </td>
                                    <td class="text-center">
                                        <span id="label-status-{{ $row->id }}"
                                            class="label {{ $row->status === 'aktif' ? 'label-success' : 'label-default' }}"
                                            style="min-width:80px;display:inline-block">
                                            {{ strtoupper($row->status) }}
                                        </span>
                                    </td>
                                    <td class="text-center">

                                        <button class="btn btn-xs btn-warning btn-status" data-id="{{ $row->id }}"
                                            data-status="{{ $row->status }}"
                                            data-url="{{ route('admin.tahun-ajaran.status', $row->id) }}"
                                            title="Ubah Status">
                                            <i class="fa fa-refresh"></i>
                                        </button>

                                        <button class="btn btn-xs btn-danger btn-hapus" data-id="{{ $row->id }}"
                                            data-nama="{{ $row->tahun }}">
                                            <i class="fa fa-trash"></i>
                                        </button>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">
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
            <form method="POST" action="{{ route('admin.tahun-ajaran.store') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-green">
                        <h4 class="modal-title">Tambah Tahun Ajaran</h4>
                    </div>
                    <div class="modal-body">
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
                            <select name="status" class="form-control" required>
                                <option value="nonaktif">Nonaktif</option>
                                <option value="aktif">Aktif</option>
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

    {{-- FORM DELETE --}}
    <form id="form-delete" method="POST">
        @csrf
        @method('DELETE')
    </form>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        /* TOAST */
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        @if (session('success'))
            Toast.fire({
                icon: 'success',
                title: "{{ session('success') }}"
            });
        @endif

        @if (session('error'))
            Toast.fire({
                icon: 'error',
                title: "{{ session('error') }}"
            });
        @endif

        @if ($errors->any())
            Toast.fire({
                icon: 'warning',
                title: "{{ $errors->first() }}"
            });
        @endif

        /* DELETE */
        $('.btn-hapus').click(function() {
            let id = $(this).data('id');
            let nama = $(this).data('nama');

            Swal.fire({
                title: 'Hapus Tahun Ajaran?',
                text: nama,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then(res => {
                if (res.isConfirmed) {
                    $('#form-delete')
                        .attr('action', '/admin/tahun-ajaran/' + id)
                        .submit();
                }
            });
        });

        /* STATUS TOGGLE */
        $('.btn-status').click(function() {
            let btn = $(this);
            let id = btn.data('id');
            let url = btn.data('url');
            let status = btn.data('status');
            let newStatus = status === 'aktif' ? 'nonaktif' : 'aktif';

            btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');

            $.ajax({
                url: url,
                type: 'PATCH',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: newStatus
                },
                success: res => {

                    if (newStatus === 'aktif') {
                        $('[id^="label-status-"]')
                            .removeClass('label-success')
                            .addClass('label-default')
                            .text('NONAKTIF');
                        $('.btn-status').data('status', 'nonaktif');
                    }

                    let label = $('#label-status-' + id);
                    label
                        .removeClass('label-default label-success')
                        .addClass(newStatus === 'aktif' ? 'label-success' : 'label-default')
                        .text(newStatus.toUpperCase());

                    btn.data('status', newStatus);

                    Toast.fire({
                        icon: 'success',
                        title: res.message
                    });
                },
                error: () => {
                    Toast.fire({
                        icon: 'error',
                        title: 'Gagal mengubah status'
                    });
                },
                complete: () => {
                    btn.prop('disabled', false).html('<i class="fa fa-refresh"></i>');
                }
            });
        });

        /* BUTTON LOADING */
        $('form').on('submit', function() {
            let btn = $(this).find('.btn-loading');
            if (btn.length) {
                btn.prop('disabled', true)
                    .html('<i class="fa fa-spinner fa-spin"></i> ' + btn.data('text'));
            }
        });
    </script>

@endsection
