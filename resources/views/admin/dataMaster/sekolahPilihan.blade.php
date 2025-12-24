@extends('layouts.masterDashboard')

@section('judul', 'Data Master')
@section('sub-judul', 'Manajemen Sekolah Pilihan')

@section('content')
<style>
    /* --- UI STYLING (KONSISTEN) --- */
    .box { border-radius: 12px; border-top: 3px solid #3c8dbc; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05); }
    .table-vcenter td { vertical-align: middle !important; padding: 12px 8px !important; }
    
    .label-pill {
        padding: 5px 15px; border-radius: 50px;
        font-weight: 600; font-size: 11px; text-transform: uppercase;
        display: inline-block; min-width: 90px; text-align: center;
        color: white;
    }
    .bg-jenjang { background-color: #00c0ef !important; box-shadow: 0 2px 5px rgba(0,192,239,0.3); }

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

            {{-- HEADER --}}
            <div class="box-header with-border" style="padding: 15px;">
                <h3 class="box-title" style="font-weight: 700;">
                    <i class="fa fa-university text-blue"></i> Daftar Sekolah Pilihan
                </h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-success btn-sm btn-action" data-toggle="modal" data-target="#modalTambah">
                        <i class="fa fa-plus"></i> Tambah Sekolah
                    </button>
                </div>
            </div>

            {{-- TABLE --}}
            <div class="box-body no-padding">
                <div class="table-responsive">
                    <table class="table table-hover table-vcenter">
                        <thead class="bg-gray-light">
                            <tr>
                                <th width="60" class="text-center">NO</th>
                                <th>NAMA SEKOLAH</th>
                                <th>JENJANG</th>
                                <th width="100" class="text-center">KONTROL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sekolah as $row)
                                <tr>
                                    <td class="text-center text-muted">{{ $loop->iteration }}</td>
                                    <td>
                                        <span style="font-size: 14px; font-weight: 700; color: #333;">
                                            {{ strtoupper($row->nama_sekolah) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="label-pill bg-jenjang">
                                            {{ $row->jenjang }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-default btn-sm btn-action btn-hapus"
                                            data-id="{{ $row->id }}"
                                            data-nama="{{ $row->nama_sekolah }}"
                                            title="Hapus Sekolah">
                                            <i class="fa fa-trash text-red"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center" style="padding: 50px;">
                                        <i class="fa fa-folder-open-o fa-3x text-gray"></i>
                                        <p class="text-muted">Data sekolah belum tersedia</p>
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
        <form method="POST" action="{{ route('admin.sekolah-pilihan.store') }}" id="form-tambah">
            @csrf
            <div class="modal-content" style="border-radius: 12px;">
                <div class="modal-header bg-green text-white">
                    <h4 class="modal-title" style="font-weight: 700;">Tambah Sekolah Baru</h4>
                </div>

                <div class="modal-body" style="padding: 20px;">
                    <div class="form-group">
                        <label>Nama Sekolah</label>
                        <input type="text" name="nama_sekolah" class="form-control" 
                               placeholder="Masukkan nama sekolah" required>
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
        // --- 1. KONFIGURASI TOAST & ALERT (KONSISTEN) ---
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });

        // Pesan Sukses
        @if(session('success'))
            Toast.fire({ icon: 'success', title: "{{ session('success') }}" });
        @endif

        // Pesan Error Sistem
        @if(session('error'))
            Swal.fire({ icon: 'error', title: 'Oops...', text: "{{ session('error') }}" });
        @endif

        // Pesan Validasi Form (Modal agar lebih jelas jika banyak error)
        @if($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                html: '{!! implode("<br>", $errors->all()) !!}',
                confirmButtonColor: '#dd4b39'
            });
        @endif


        // --- 2. UI HANDLER (SKELETON & LOADING) ---
        setTimeout(() => {
            $('.skeleton-loading').removeClass('skeleton-loading is-loading');
        }, 800);

        $('#form-tambah').on('submit', function() {
            $('#btn-simpan').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
        });


        // --- 3. DELETE CONFIRMATION (KONSISTEN) ---
        $('.btn-hapus').click(function () {
            let id   = $(this).data('id');
            let nama = $(this).data('nama');

            Swal.fire({
                title: 'Hapus Sekolah?',
                text: "Sekolah " + nama + " akan dihapus dari daftar.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#form-delete')
                        .attr('action', '/admin/sekolah-pilihan/' + id)
                        .submit();
                }
            });
        });
    });
</script>
@endsection