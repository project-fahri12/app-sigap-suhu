@extends('layouts.masterDashboard')

@section('judul', 'Data Master')
@section('sub-judul', 'Pengaturan Gelombang')

@section('content')
    <style>
        /* --- UI STYLING KONSISTEN --- */
        .box { border-radius: 12px; border-top: 3px solid #00a65a; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05); }
        .table-vcenter td { vertical-align: middle !important; padding: 12px 8px !important; }
        
        .label-pill {
            padding: 5px 15px; border-radius: 50px;
            font-weight: 600; font-size: 11px; text-transform: uppercase;
            transition: all 0.4s ease; display: inline-block; min-width: 80px;
            color: white;
        }
        .bg-buka { background-color: #00a65a !important; box-shadow: 0 2px 5px rgba(0,166,90,0.3); }
        .bg-tutup { background-color: #d2d6de !important; color: #555 !important; }

        .btn-action { border-radius: 6px; transition: all 0.2s; }
        .btn-action:hover { transform: translateY(-1px); }

        /* SKELETON LOADING */
        .skeleton-loading { position: relative; overflow: hidden !important; background-color: #f2f2f2 !important; min-height: 200px; border: none !important; }
        .skeleton-loading::after {
            content: ""; position: absolute; top: 0; right: 0; bottom: 0; left: 0;
            transform: translateX(-100%);
            background-image: linear-gradient(90deg, rgba(255,255,255,0) 0, rgba(255,255,255,0.5) 50%, rgba(255,255,255,0) 100%);
            animation: shimmer 2s infinite;
        }
        @keyframes shimmer { 100% { transform: translateX(100%); } }
        .is-loading > * { opacity: 0 !important; visibility: hidden !important; }
    </style>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-success skeleton-loading is-loading" id="main-box">
                
                <div class="box-header with-border" style="padding: 15px;">
                    <h3 class="box-title" style="font-weight: 700;">
                        <i class="fa fa-flag text-green"></i> Daftar Gelombang Pendaftaran
                    </h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-success btn-sm btn-action" data-toggle="modal" data-target="#modalTambah">
                            <i class="fa fa-plus"></i> Tambah Gelombang
                        </button>
                    </div>
                </div>

                <div class="box-body no-padding">
                    <div class="table-responsive">
                        <table class="table table-hover table-vcenter">
                            <thead class="bg-gray-light">
                                <tr>
                                    <th width="60" class="text-center">NO</th>
                                    <th>GELOMBANG</th>
                                    <th>TAHUN AJARAN</th>
                                    <th>PERIODE</th>
                                    <th class="text-center">STATUS</th>
                                    <th width="150" class="text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($gelombang as $row)
                                    <tr>
                                        <td class="text-center text-muted">{{ $loop->iteration }}</td>
                                        <td><b style="font-size: 14px;">{{ strtoupper($row->nama_gelombang) }}</b></td>
                                        <td><span class="label label-default">{{ $row->tahunAjaran->tahun ?? '-' }}</span></td>
                                        <td>
                                            <small class="text-muted"><i class="fa fa-calendar"></i></small> 
                                            {{ \Carbon\Carbon::parse($row->tanggal_mulai)->format('d M Y') }} - 
                                            {{ \Carbon\Carbon::parse($row->tanggal_selesai)->format('d M Y') }}
                                        </td>
                                        <td class="text-center">
                                            <span id="badge-status-{{ $row->id }}" 
                                                class="label-pill {{ $row->status === 'buka' ? 'bg-buka' : 'bg-tutup' }}">
                                                {{ $row->status === 'buka' ? 'DIBUKA' : 'DITUTUP' }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <button class="btn btn-default btn-sm btn-action btn-status" 
                                                    data-id="{{ $row->id }}" 
                                                    data-url="{{ route('admin.gelombang.status', $row->id) }}"
                                                    data-status="{{ $row->status }}">
                                                    <i class="fa fa-refresh {{ $row->status === 'buka' ? 'text-green' : '' }}"></i>
                                                </button>
                                                <button class="btn btn-default btn-sm btn-action" data-toggle="modal" data-target="#edit{{ $row->id }}">
                                                    <i class="fa fa-edit text-blue"></i>
                                                </button>
                                                <button class="btn btn-default btn-sm btn-action btn-hapus" data-id="{{ $row->id }}" data-nama="{{ $row->nama_gelombang }}">
                                                    <i class="fa fa-trash text-red"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    {{-- MODAL EDIT --}}
                                    <div class="modal fade" id="edit{{ $row->id }}">
                                        <div class="modal-dialog">
                                            <form method="POST" action="{{ route('admin.gelombang.update', $row->id) }}" class="form-submit">
                                                @csrf @method('PUT')
                                                <div class="modal-content" style="border-radius: 12px;">
                                                    <div class="modal-header bg-blue text-white">
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
                                                                @foreach ($tahunAjaran as $ta)
                                                                    <option value="{{ $ta->id }}" {{ $row->tahun_ajaran_id == $ta->id ? 'selected' : '' }}>
                                                                        {{ $ta->tahun }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Tanggal Mulai</label>
                                                                    <input type="date" name="tanggal_mulai" class="form-control" value="{{ $row->tanggal_mulai }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Tanggal Selesai</label>
                                                                    <input type="date" name="tanggal_selesai" class="form-control" value="{{ $row->tanggal_selesai }}" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Status</label>
                                                            <select name="status" class="form-control">
                                                                <option value="buka" {{ $row->status == 'buka' ? 'selected' : '' }}>Dibuka</option>
                                                                <option value="tutup" {{ $row->status == 'tutup' ? 'selected' : '' }}>Ditutup</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary btn-loading" data-text="Menyimpan...">Simpan Perubahan</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center" style="padding: 50px;">
                                            <i class="fa fa-info-circle fa-2x text-gray"></i><br>
                                            <span class="text-muted">Data gelombang belum tersedia.</span>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL TAMBAH --}}
    <div class="modal fade" id="modalTambah">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('admin.gelombang.store') }}" class="form-submit">
                @csrf
                <div class="modal-content" style="border-radius: 12px;">
                    <div class="modal-header bg-green text-white">
                        <h4 class="modal-title">Tambah Gelombang</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Gelombang</label>
                            <input type="text" name="nama_gelombang" class="form-control" placeholder="Contoh: Gelombang I" required>
                        </div>
                        <div class="form-group">
                            <label>Tahun Ajaran</label>
                            <select name="tahun_ajaran_id" class="form-control" required>
                                <option value="">-- Pilih Tahun Ajaran --</option>
                                @foreach ($tahunAjaran as $ta)
                                    <option value="{{ $ta->id }}">{{ $ta->tahun }}</option>
                                @endforeach
                            </select>
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
                                <option value="tutup">Ditutup</option>
                                <option value="buka">Dibuka</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer bg-gray-light">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success btn-loading" data-text="Menyimpan...">Simpan Gelombang</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <form id="form-delete" method="POST">@csrf @method('DELETE')</form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // --- 1. SKELETON EFFECT ---
            setTimeout(() => {
                $('.skeleton-loading').removeClass('skeleton-loading is-loading');
            }, 800);

            // --- 2. CONFIG SWEETALERT TOAST ---
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3500,
                timerProgressBar: true
            });

            // --- 3. HANDLING LARAVEL SESSIONS WITH SWEETALERT ---

            // --- 4. FORM SUBMIT SPINNER ---
            $('.form-submit').on('submit', function() {
                let btn = $(this).find('.btn-loading');
                btn.prop('disabled', true)
                   .html('<i class="fa fa-spinner fa-spin"></i> ' + btn.data('text'));
            });

            // --- 5. AJAX STATUS TOGGLE ---
            $('.btn-status').click(function() {
                let btn = $(this);
                let id = btn.data('id');
                let url = btn.data('url');
                let currentStatus = btn.data('status');
                let nextStatus = currentStatus === 'buka' ? 'tutup' : 'buka';

                btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');

                $.ajax({
                    url: url,
                    type: 'PATCH',
                    data: { _token: '{{ csrf_token() }}', status: nextStatus },
                    success: res => {
                        let label = $('#badge-status-' + id);
                        if(nextStatus === 'buka') {
                            label.removeClass('bg-tutup').addClass('bg-buka').text('DIBUKA');
                            btn.find('i').addClass('text-green');
                        } else {
                            label.removeClass('bg-buka').addClass('bg-tutup').text('DITUTUP');
                            btn.find('i').removeClass('text-green');
                        }
                        btn.data('status', nextStatus);
                        Toast.fire({ icon: 'success', title: 'Status diperbarui' });
                    },
                    error: () => {
                        Toast.fire({ icon: 'error', title: 'Gagal mengubah status' });
                    },
                    complete: () => {
                        btn.prop('disabled', false).html('<i class="fa fa-refresh"></i>');
                    }
                });
            });

            // --- 6. DELETE CONFIRMATION ---
            $('.btn-hapus').click(function() {
                let id = $(this).data('id');
                let nama = $(this).data('nama');
                Swal.fire({
                    title: 'Hapus Gelombang?',
                    text: "Menghapus " + nama + " dapat mempengaruhi data pendaftar.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then(res => {
                    if (res.isConfirmed) {
                        $('#form-delete').attr('action', '/admin/gelombang/' + id).submit();
                    }
                });
            });
        });
    </script>
@endsection