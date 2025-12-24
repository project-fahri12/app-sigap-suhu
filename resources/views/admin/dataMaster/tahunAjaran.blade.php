@extends('layouts.masterDashboard')

@section('judul', 'Data Master')
@section('sub-judul', 'Pengaturan Tahun Ajaran')

@section('content')
    <style>
        /* --- UI STYLING --- */
        .box { border-radius: 12px; border-top: 3px solid #3c8dbc; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05); }
        .table-vcenter td { vertical-align: middle !important; padding: 12px 8px !important; }
        
        .label-pill {
            padding: 5px 15px; border-radius: 50px;
            font-weight: 600; font-size: 11px; text-transform: uppercase;
            transition: all 0.4s ease; display: inline-block; min-width: 90px;
            color: white;
        }
        .bg-aktif { background-color: #00a65a !important; box-shadow: 0 2px 5px rgba(0,166,90,0.3); }
        .bg-nonaktif { background-color: #d2d6de !important; color: #555 !important; }

        .btn-action { border-radius: 6px; transition: all 0.2s; }
        .btn-action:hover { transform: translateY(-1px); }

        /* --- SKELETON WAVE --- */
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
            <div class="box box-primary skeleton-loading is-loading" id="main-box">
                <div class="box-header with-border" style="padding: 15px;">
                    <h3 class="box-title" style="font-weight: 700;">
                        <i class="fa fa-calendar-check-o text-blue"></i> Manajemen Tahun Ajaran
                    </h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-success btn-sm btn-action" data-toggle="modal" data-target="#modalTambah">
                            <i class="fa fa-plus"></i> Tambah Baru
                        </button>
                    </div>
                </div>

                <div class="box-body no-padding">
                    <div class="table-responsive">
                        <table class="table table-hover table-vcenter" id="table-ta">
                            <thead class="bg-gray-light">
                                <tr>
                                    <th width="60" class="text-center">NO</th>
                                    <th>TAHUN AJARAN</th>
                                    <th>PERIODE PENDAFTARAN</th>
                                    <th class="text-center">STATUS</th>
                                    <th width="150" class="text-center">KONTROL</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tahunAjaran as $row)
                                    <tr id="row-{{ $row->id }}">
                                        <td class="text-center text-muted">{{ $loop->iteration }}</td>
                                        <td><span style="font-size: 15px; font-weight: 700;">{{ $row->tahun }}</span></td>
                                        <td>
                                            <small class="text-muted"><i class="fa fa-clock-o"></i> DURASI</small><br>
                                            {{ \Carbon\Carbon::parse($row->tanggal_mulai)->format('d M Y') }} - 
                                            {{ \Carbon\Carbon::parse($row->tanggal_selesai)->format('d M Y') }}
                                        </td>
                                        <td class="text-center">
                                            <span id="label-{{ $row->id }}" class="label-pill {{ $row->status === 'aktif' ? 'bg-aktif' : 'bg-nonaktif' }}">
                                                {{ strtoupper($row->status) }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <button class="btn btn-default btn-sm btn-action btn-status" 
                                                    data-id="{{ $row->id }}" 
                                                    data-url="{{ route('admin.tahun-ajaran.status', $row->id) }}"
                                                    data-status="{{ $row->status }}"
                                                    title="Switch Status">
                                                    <i class="fa fa-power-off {{ $row->status === 'aktif' ? 'text-green' : 'text-muted' }}"></i>
                                                </button>
                                                <button class="btn btn-default btn-sm btn-action btn-hapus" 
                                                    data-id="{{ $row->id }}" 
                                                    data-nama="{{ $row->tahun }}"
                                                    title="Hapus">
                                                    <i class="fa fa-trash text-red"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center" style="padding: 50px;">
                                            <i class="fa fa-folder-open-o fa-3x text-gray"></i>
                                            <p class="text-muted">Belum ada data tersedia</p>
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
            <form method="POST" action="{{ route('admin.tahun-ajaran.store') }}" id="form-tambah">
                @csrf
                <div class="modal-content" style="border-radius: 12px;">
                    <div class="modal-header bg-green text-white">
                        <h4 class="modal-title" style="font-weight: 700;">Tambah Tahun Ajaran</h4>
                    </div>
                    <div class="modal-body" style="padding: 20px;">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tgl Mulai</label>
                                    <input type="date" name="tanggal_mulai" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tgl Selesai</label>
                                    <input type="date" name="tanggal_selesai" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Status Awal</label>
                            <select name="status" class="form-control">
                                <option value="nonaktif">Nonaktif</option>
                                <option value="aktif">Aktif (Ganti Tahun Sekarang)</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer bg-gray-light">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" id="btn-simpan" class="btn btn-success">Simpan Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <form id="form-delete" method="POST">@csrf @method('DELETE')</form>

    {{-- SCRIPTS --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // --- 1. KONFIGURASI TOAST & ALERT ---
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });

            // Munculkan Pesan Sukses dari Session Laravel
            @if(session('success'))
                Toast.fire({ icon: 'success', title: "{{ session('success') }}" });
            @endif

            // Munculkan Pesan Error dari Session Laravel
            @if(session('error'))
                Swal.fire({ icon: 'error', title: 'Oops...', text: "{{ session('error') }}" });
            @endif

            // Munculkan Pesan Validasi Form
            @if($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Kesalahan Input',
                    html: '{!! implode("<br>", $errors->all()) !!}'
                });
            @endif


            // --- 2. UI HANDLER (SKELETON & LOADING) ---
            setTimeout(() => {
                $('.skeleton-loading').removeClass('skeleton-loading is-loading');
            }, 800);

            $('#form-tambah').on('submit', function() {
                $('#btn-simpan').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Memproses...');
            });


            // --- 3. TOGGLE STATUS (AJAX) ---
            $('.btn-status').click(function() {
                let btn = $(this);
                let id = btn.data('id');
                let url = btn.data('url');
                let currentStatus = btn.data('status');
                let nextStatus = currentStatus === 'aktif' ? 'nonaktif' : 'aktif';

                btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');

                $.ajax({
                    url: url,
                    type: 'PATCH',
                    data: { _token: '{{ csrf_token() }}', status: nextStatus },
                    success: res => {
                        if (nextStatus === 'aktif') {
                            // Reset visual baris lain karena hanya 1 TA yang boleh aktif
                            $('.label-pill').removeClass('bg-aktif').addClass('bg-nonaktif').text('NONAKTIF');
                            $('.btn-status i').removeClass('text-green').addClass('text-muted');
                            $('.btn-status').data('status', 'nonaktif');
                        }

                        // Update baris aktif
                        let label = $('#label-' + id);
                        if (nextStatus === 'aktif') {
                            label.removeClass('bg-nonaktif').addClass('bg-aktif').text('AKTIF');
                            btn.find('i').removeClass('text-muted').addClass('text-green');
                        } else {
                            label.removeClass('bg-aktif').addClass('bg-nonaktif').text('NONAKTIF');
                            btn.find('i').removeClass('text-green').addClass('text-muted');
                        }

                        btn.data('status', nextStatus);
                        Toast.fire({ icon: 'success', title: 'Status berhasil diperbarui!' });
                    },
                    error: () => {
                        Toast.fire({ icon: 'error', title: 'Gagal merubah status' });
                    },
                    complete: () => {
                        btn.prop('disabled', false).html('<i class="fa fa-power-off ' + (btn.data('status') === 'aktif' ? 'text-green' : 'text-muted') + '"></i>');
                    }
                });
            });


            // --- 4. DELETE CONFIRMATION ---
            $('.btn-hapus').click(function() {
                let id = $(this).data('id');
                let nama = $(this).data('nama');
                
                Swal.fire({
                    title: 'Hapus Tahun Ajaran?',
                    text: "Data " + nama + " akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then(res => {
                    if (res.isConfirmed) {
                        // Ganti action form delete secara dinamis
                        $('#form-delete').attr('action', '/admin/tahun-ajaran/' + id).submit();
                    }
                });
            });
        });
    </script>
@endsection