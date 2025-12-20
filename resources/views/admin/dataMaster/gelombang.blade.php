@extends('layouts.masterDashboard')

@section('judul', 'Data Master')
@section('sub-judul', 'Gelombang')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">

                {{-- HEADER --}}
                <div class="box-header with-border">
                    <button class="btn btn-success" data-toggle="modal" data-target="#modalTambah">
                        <i class="fa fa-plus"></i> Tambah Gelombang
                    </button>
                </div>

                {{-- TABLE --}}
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="50">NO</th>
                                <th>GELOMBANG</th>
                                <th>TAHUN AJARAN</th>
                                <th>PERIODE</th>
                                <th class="text-center">STATUS</th>
                                <th width="120" class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse($gelombang as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><b>{{ strtoupper($row->nama_gelombang) }}</b></td>
                                    <td>{{ $row->tahunAjaran->tahun ?? '-' }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($row->tanggal_mulai)->format('d M Y') }}
                                        -
                                        {{ \Carbon\Carbon::parse($row->tanggal_selesai)->format('d M Y') }}
                                    </td>
                                    <td class="text-center">
                                        {{-- Badge ID digunakan oleh AJAX untuk update realtime --}}
                                        <span id="badge-status-{{ $row->id }}"
                                            class="label {{ $row->status === 'buka' ? 'label-success' : 'label-default' }}"
                                            style="min-width:70px;display:inline-block">
                                            {{ strtoupper($row->status) }}
                                        </span>
                                    </td>

                                    <td class="text-center">

                                        <button class="btn btn-xs btn-warning btn-status" data-id="{{ $row->id }}"
                                            data-status="{{ $row->status }}"
                                            data-url="{{ route('admin.gelombang.status', $row->id) }}">
                                            <i class="fa fa-refresh"></i>
                                        </button>

                                        <button class="btn btn-xs btn-primary" data-toggle="modal"
                                            data-target="#edit{{ $row->id }}">
                                            <i class="fa fa-edit"></i>
                                        </button>

                                        <button class="btn btn-xs btn-danger btn-hapus" data-id="{{ $row->id }}"
                                            data-nama="{{ $row->nama_gelombang }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                {{-- MODAL EDIT --}}
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
                                                        <input type="text" name="nama_gelombang" class="form-control"
                                                            value="{{ $row->nama_gelombang }}" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Tahun Ajaran</label>
                                                        <select name="tahun_ajaran_id" class="form-control" required>
                                                            @foreach ($tahunAjaran as $ta)
                                                                <option value="{{ $ta->id }}"
                                                                    {{ $row->tahun_ajaran_id == $ta->id ? 'selected' : '' }}>
                                                                    {{ $ta->tahun }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Tanggal Mulai</label>
                                                        <input type="date" name="tanggal_mulai" class="form-control"
                                                            value="{{ $row->tanggal_mulai }}" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Tanggal Selesai</label>
                                                        <input type="date" name="tanggal_selesai" class="form-control"
                                                            value="{{ $row->tanggal_selesai }}" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Status</label>
                                                        <select name="status" class="form-control" required>
                                                            <option value="buka"
                                                                {{ $row->status == 'buka' ? 'selected' : '' }}>Dibuka</option>
                                                            <option value="tutup"
                                                                {{ $row->status == 'tutup' ? 'selected' : '' }}>Ditutup</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary btn-loading"
                                                        data-text="Menyimpan...">
                                                        Simpan
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">
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
            <form method="POST" action="{{ route('admin.gelombang.store') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-green">
                        <h4 class="modal-title">Tambah Gelombang</h4>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Nama Gelombang</label>
                            <input type="text" name="nama_gelombang" class="form-control" placeholder="Gelombang I"
                                required>
                        </div>

                        <div class="form-group">
                            <label>Tahun Ajaran</label>
                            <select name="tahun_ajaran_id" class="form-control" required>
                                @foreach ($tahunAjaran as $ta)
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
                                <option value="buka">Dibuka</option>
                                <option value="tutup">Ditutup</option>
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
        @csrf @method('DELETE')
    </form>

    {{-- SWEETALERT --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        /* TOAST CONFIG */
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        @if (session('success'))
            Toast.fire({ icon: 'success', title: "{{ session('success') }}" });
        @endif

        @if (session('error'))
            Toast.fire({ icon: 'error', title: "{{ session('error') }}" });
        @endif

        /* DELETE ACTION */
        $('.btn-hapus').click(function() {
            let id = $(this).data('id');
            let nama = $(this).data('nama');

            Swal.fire({
                title: 'Hapus Gelombang?',
                text: nama,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then(res => {
                if (res.isConfirmed) {
                    $('#form-delete').attr('action', '/admin/gelombang/' + id).submit();
                }
            });
        });

        /* STATUS TOGGLE (REALTIME AJAX) */
        $('.btn-status').click(function() {
            let btn = $(this);
            let id = btn.data('id');
            let url = btn.data('url');
            let statusSekarang = btn.data('status');
            let statusBaru = statusSekarang === 'buka' ? 'tutup' : 'buka';

            // Loading state pada tombol
            btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');

            $.ajax({
                url: url,
                type: 'PATCH',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: statusBaru
                },
                success: res => {
                    let label = $('#badge-status-' + id);
                    
                    if(statusBaru === 'buka') {
                        label.removeClass('label-default').addClass('label-success').text('BUKA');
                    } else {
                        label.removeClass('label-success').addClass('label-default').text('TUTUP');
                    }

                    btn.data('status', statusBaru);

                    Toast.fire({
                        icon: 'success',
                        title: res.message || 'Status berhasil diperbarui'
                    });
                },
                error: (xhr) => {
                    Toast.fire({
                        icon: 'error',
                        title: 'Gagal mengubah status'
                    });
                },
                complete: () => {
                    // Kembalikan ikon tombol
                    btn.prop('disabled', false).html('<i class="fa fa-refresh"></i>');
                }
            });
        });

        /* BUTTON LOADING ON SUBMIT */
        $('form').on('submit', function() {
            let btn = $(this).find('.btn-loading');
            if (btn.length) {
                btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> ' + btn.data('text'));
            }
        });
    </script>

@endsection