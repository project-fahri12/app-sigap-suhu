@extends('layouts.masterDashboard')

@section('judul', 'Verifikasi Pendaftaran')
@section('sub-judul', 'Pemeriksaan Berkas & Pembayaran')

@section('content')
<style>
    /* KONSISTENSI BOX & TAB */
    .box { border-radius: 12px; border-top: 3px solid #3c8dbc; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
    
    .nav-tabs-custom { border-radius: 12px; overflow: hidden; box-shadow: none; }
    .nav-tabs-custom > .nav-tabs { border-bottom-color: #f4f4f4; background: #f9fafb; padding: 10px 10px 0 10px; }
    .nav-tabs-custom > .nav-tabs > li > a { border-radius: 8px 8px 0 0; font-weight: 600; color: #777; transition: 0.3s; }
    .nav-tabs-custom > .nav-tabs > li.active > a { border-top-color: transparent; border-left-color: #eee; border-right-color: #eee; color: #3c8dbc; background: #fff; }
    
    /* STATUS BADGE MODERN */
    .badge-status { padding: 5px 12px; border-radius: 50px; font-weight: 600; font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase; }
    .bg-valid { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
    .bg-invalid { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    .bg-pending { background-color: #fff3cd; color: #856404; border: 1px solid #ffeeba; }

    /* TABLE STYLING */
    .table > tbody > tr > td { vertical-align: middle; padding: 12px 8px; }
    .table thead th { background: #f8f9fa; text-transform: uppercase; font-size: 12px; letter-spacing: 0.5px; color: #555; border-bottom: 2px solid #eee; }

    /* MODAL & PREVIEW */
    .modal-content { border-radius: 16px; border: none; box-shadow: 0 20px 50px rgba(0,0,0,0.3); }
    .modal-header { border-top-left-radius: 16px; border-top-right-radius: 16px; padding: 20px; }
    
    .media-preview { 
        background: #222; 
        border-radius: 12px; 
        min-height: 450px; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        overflow: hidden; 
        border: 4px solid #333;
    }
    .media-preview img { max-height: 440px; width: auto; transition: transform 0.3s; }
    .media-preview img:hover { transform: scale(1.02); }
    .media-preview iframe { width: 100%; height: 450px; border: none; }

    .form-section-label { font-size: 12px; font-weight: 700; color: #3c8dbc; text-transform: uppercase; margin-bottom: 15px; display: block; border-bottom: 1px solid #eee; padding-bottom: 5px; }
</style>

<div class="box box-primary">
    <div class="box-header with-border" style="padding: 15px 20px;">
        <h3 class="box-title" style="font-weight: 700;">
            <i class="fa fa-shield text-blue"></i> PANEL VERIFIKASI
        </h3>
    </div>

    <div class="box-body" style="padding: 0;">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs nav-justified">
                <li class="active">
                    <a href="#belum" data-toggle="tab">
                        <i class="fa fa-clock-o"></i> BELUM DIPERIKSA 
                        <span class="label label-primary" style="margin-left:5px; border-radius:10px;">{{ $dataBelum->count() }}</span>
                    </a>
                </li>
                <li>
                    <a href="#lolos" data-toggle="tab">
                        <i class="fa fa-check-circle"></i> LOLOS VERIFIKASI
                        <span class="label label-success" style="margin-left:5px; border-radius:10px;">{{ $dataLolos->count() }}</span>
                    </a>
                </li>
                <li>
                    <a href="#ditolak" data-toggle="tab">
                        <i class="fa fa-times-circle"></i> DITOLAK
                        <span class="label label-danger" style="margin-left:5px; border-radius:10px;">{{ $dataDitolak->count() }}</span>
                    </a>
                </li>
            </ul>

            <div class="tab-content" style="padding: 20px;">
                @foreach (['belum' => $dataBelum, 'lolos' => $dataLolos, 'ditolak' => $dataDitolak] as $type => $dataset)
                    <div class="tab-pane {{ $type === 'belum' ? 'active' : '' }}" id="{{ $type }}">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%" class="text-center">NO</th>
                                        <th>KODE</th>
                                        <th>NAMA PENDAFTAR</th>
                                        <th class="text-center">PEMBAYARAN</th>
                                        <th class="text-center">BERKAS</th>
                                        <th width="15%" class="text-center">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($dataset as $i => $row)
                                        @php
                                            $statusBayar = $row->verifikasi?->verifikasi_pembayaran ?? 'pending';
                                            $statusBerkas = $row->verifikasi?->verifikasi_berkas ?? 'pending';
                                        @endphp
                                        <tr>
                                            <td class="text-center text-muted">{{ $i + 1 }}</td>
                                            <td><code style="font-size: 13px; font-weight: bold;">{{ $row->kode_pendaftaran }}</code></td>
                                            <td>
                                                <div style="font-weight: 700; color: #333;">{{ strtoupper($row->nama_lengkap) }}</div>
                                                <small class="text-muted"><i class="fa fa-calendar"></i> {{ $row->created_at->format('d/m/Y H:i') }}</small>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge-status bg-{{ $statusBayar }}">
                                                    {{ $statusBayar }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge-status bg-{{ $statusBerkas }}">
                                                    {{ $statusBerkas }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-default btn-sm btn-flat" 
                                                        style="border-radius: 4px; font-weight: 600;"
                                                        data-toggle="modal" data-target="#modal{{ $row->id }}">
                                                    <i class="fa fa-search text-blue"></i> PERIKSA DATA
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center" style="padding: 50px;">
                                                <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="80" style="opacity: 0.2;">
                                                <p class="text-muted" style="margin-top: 10px;">Tidak ada data pendaftar pada kategori ini.</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- ================= MODAL VERIFIKASI ================= --}}
@foreach ($dataBelum->merge($dataLolos)->merge($dataDitolak) as $row)
    @php
        $statusBayar = $row->verifikasi?->verifikasi_pembayaran ?? 'pending';
        $statusBerkas = $row->verifikasi?->verifikasi_berkas ?? 'pending';
    @endphp

    <div class="modal fade" id="modal{{ $row->id }}" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-navy">
                    <button type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 1;">&times;</button>
                    <h4 class="modal-title" style="font-weight: 700;">
                        <i class="fa fa-user-check"></i> VERIFIKASI: {{ strtoupper($row->nama_lengkap) }}
                    </h4>
                </div>

                <div class="modal-body" style="background: #fcfcfc;">
                    <div class="row">
                        {{-- SISI KIRI: PREVIEW --}}
                        <div class="col-md-7">
                            <div class="nav-tabs-custom" style="background: transparent;">
                                <ul class="nav nav-pills" style="margin-bottom: 10px;">
                                    <li class="active">
                                        <a href="#pay{{ $row->id }}" data-toggle="tab" style="border-radius: 20px; padding: 5px 15px;">
                                            <i class="fa fa-money"></i> Bukti Bayar
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#doc{{ $row->id }}" data-toggle="tab" style="border-radius: 20px; padding: 5px 15px;">
                                            <i class="fa fa-file-text"></i> Berkas PDF
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content" style="padding: 0; background: transparent;">
                                    <div class="tab-pane active" id="pay{{ $row->id }}">
                                        <div class="media-preview">
                                            @if ($row->pembayaran?->bukti_transfer)
                                                <img src="{{ asset('storage/' . $row->pembayaran->bukti_transfer) }}" class="img-responsive">
                                            @else
                                                <div class="text-center text-muted">
                                                    <i class="fa fa-image fa-4x"></i><br>Belum Upload Bukti
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="doc{{ $row->id }}">
                                        <div class="media-preview">
                                            @if ($row->berkas?->file_path)
                                                <iframe src="{{ asset('storage/' . $row->berkas->file_path) }}"></iframe>
                                            @else
                                                <div class="text-center text-muted">
                                                    <i class="fa fa-file-pdf-o fa-4x"></i><br>Berkas Belum Tersedia
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- SISI KANAN: FORM KEPUTUSAN --}}
                        <div class="col-md-5">
                            <div style="background: #fff; padding: 20px; border-radius: 12px; border: 1px solid #eee;">
                                <span class="form-section-label">Keputusan Verifikasi</span>
                                
                                <div class="form-group">
                                    <label><i class="fa fa-credit-card text-muted"></i> Status Pembayaran</label>
                                    <select class="form-control" id="status_pay_{{ $row->id }}" style="height: 40px; font-weight: 600;">
                                        <option value="pending" {{ $statusBayar === 'pending' ? 'selected' : '' }}>⌛ PENDING</option>
                                        <option value="valid" {{ $statusBayar === 'valid' ? 'selected' : '' }}>✅ VALID / LOLOS</option>
                                        <option value="invalid" {{ $statusBayar === 'invalid' ? 'selected' : '' }}>❌ INVALID / TOLAK</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label><i class="fa fa-folder-open text-muted"></i> Status Berkas</label>
                                    <select class="form-control" id="status_file_{{ $row->id }}" 
                                            {{ $statusBayar === 'valid' ? '' : 'disabled' }}
                                            style="height: 40px; font-weight: 600;">
                                        <option value="pending" {{ $statusBerkas === 'pending' ? 'selected' : '' }}>⌛ PENDING</option>
                                        <option value="valid" {{ $statusBerkas === 'valid' ? 'selected' : '' }}>✅ VALID / LENGKAP</option>
                                        <option value="invalid" {{ $statusBerkas === 'invalid' ? 'selected' : '' }}>❌ INVALID / TIDAK LENGKAP</option>
                                    </select>
                                    @if($statusBayar !== 'valid')
                                        <small class="text-danger mt-1" style="display:block;"><i class="fa fa-info-circle"></i> Berkas hanya bisa diproses jika pembayaran VALID</small>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label><i class="fa fa-commenting text-muted"></i> Catatan Internal</label>
                                    <textarea class="form-control" id="note_{{ $row->id }}" rows="4" placeholder="Alasan penolakan atau catatan tambahan untuk santri...">{{ $row->verifikasi?->catatan }}</textarea>
                                </div>

                                <hr>

                                <button class="btn btn-success btn-block btn-lg btn-save" data-id="{{ $row->id }}" style="border-radius: 8px; font-weight: 700; box-shadow: 0 4px 10px rgba(0,166,90,0.2);">
                                    <i class="fa fa-save"></i> SIMPAN KEPUTUSAN
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

{{-- SCRIPT TETAP SAMA NAMUN DENGAN UI FEEDBACK --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function () {
    // Sync Selects logic
    $(document).on('change', '[id^="status_pay_"]', function () {
        let id = $(this).attr('id').replace('status_pay_', '');
        let statusPay = $(this).val();
        let fileSelect = $('#status_file_' + id);

        if (statusPay === 'valid') {
            fileSelect.prop('disabled', false).css('background', '#fff');
        } else {
            fileSelect.prop('disabled', true).val('pending').css('background', '#f4f4f4');
        }
    });

    $(document).on('click', '.btn-save', function () {
        let btn = $(this);
        let id = btn.data('id');
        
        // UI Loading
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Memproses...');

        let data = {
            _token: "{{ csrf_token() }}",
            id: id,
            status_pay: $('#status_pay_' + id).val(),
            catatan: $('#note_' + id).val()
        };

        if ($('#status_pay_' + id).val() === 'valid') {
            data.status_file = $('#status_file_' + id).val();
        }

        $.ajax({
            url: "{{ route('admin.verifikasi.update') }}",
            type: "POST",
            data: data,
            success: function (res) {
                Swal.fire({
                    icon: 'success',
                    title: 'BERHASIL',
                    text: res.message,
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    location.reload();
                });
            },
            error: function (xhr) {
                btn.prop('disabled', false).html('<i class="fa fa-save"></i> SIMPAN KEPUTUSAN');
                Swal.fire({
                    icon: 'error',
                    title: 'GAGAL',
                    text: xhr.responseJSON?.message ?? 'Terjadi kesalahan sistem'
                });
            }
        });
    });
});
</script>
@endsection