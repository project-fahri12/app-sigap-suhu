@extends('layouts.masterDashboard')

@section('content')
    <style>
        .modal-content {
            border-radius: 12px;
            overflow: hidden;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .media-preview {
            background: #333;
            border-radius: 8px;
            min-height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .media-preview img {
            max-height: 400px;
        }

        .media-preview iframe {
            width: 100%;
            height: 400px;
            border: none;
        }

        .section-title {
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
        }
    </style>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">
                <i class="fa fa-user-check"></i> <b>VERIFIKASI PENDAFTAR</b>
            </h3>
        </div>

        <div class="box-body">

            {{-- TAB --}}
            <ul class="nav nav-tabs nav-justified">
                <li class="active">
                    <a href="#belum" data-toggle="tab">
                        BELUM DIPERIKSA <span class="badge bg-blue">{{ $dataBelum->count() }}</span>
                    </a>
                </li>
                <li>
                    <a href="#lolos" data-toggle="tab">
                        LOLOS <span class="badge bg-green">{{ $dataLolos->count() }}</span>
                    </a>
                </li>
                <li>
                    <a href="#ditolak" data-toggle="tab">
                        DITOLAK <span class="badge bg-red">{{ $dataDitolak->count() }}</span>
                    </a>
                </li>
            </ul>

            <div class="tab-content" style="margin-top:15px">

                @foreach (['belum' => $dataBelum, 'lolos' => $dataLolos, 'ditolak' => $dataDitolak] as $type => $dataset)
                    <div class="tab-pane {{ $type === 'belum' ? 'active' : '' }}" id="{{ $type }}">

                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr class="bg-gray">
                                    <th width="5%">NO</th>
                                    <th>KODE</th>
                                    <th>NAMA</th>
                                    <th>PEMBAYARAN</th>
                                    <th>BERKAS</th>
                                    <th width="10%" class="text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dataset as $i => $row)
                                    @php
                                        $statusBayar = $row->verifikasi?->verifikasi_pembayaran ?? 'BELUM BAYAR';
                                        $statusBerkas = $row->verifikasi?->verifikasi_berkas ?? 'BELUM UPLOAD';
                                    @endphp

                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td><b>{{ $row->kode_pendaftaran ?? '-' }}</b></td>
                                        <td>{{ strtoupper($row->nama_lengkap ?? '-') }}</td>

                                        <td>
                                            <span
                                                class="label
                                    {{ $statusBayar === 'valid' ? 'label-success' : ($statusBayar === 'invalid' ? 'label-danger' : 'label-warning') }}">
                                                {{ strtoupper($statusBayar) }}
                                            </span>
                                        </td>

                                        <td>
                                            <span
                                                class="label
                                    {{ $statusBerkas === 'valid'
                                        ? 'label-success'
                                        : ($statusBerkas === 'invalid'
                                            ? 'label-danger'
                                            : 'label-warning') }}">
                                                {{ strtoupper($statusBerkas) }}
                                            </span>
                                        </td>

                                        @php
                                            $statusBayar = $row->verifikasi?->verifikasi_pembayaran;
                                            $statusBerkas = $row->verifikasi?->verifikasi_berkas;

                                            $adaPending = in_array('pending', [$statusBayar, $statusBerkas], true);
                                        @endphp

                                        <td class="text-center">
                                            @if ($adaPending)
                                                <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                    data-target="#modal{{ $row->id }}">
                                                    <i class="fa fa-search"></i> PERIKSA
                                                </button>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>

                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">
                                            DATA TIDAK DITEMUKAN
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                @endforeach

            </div>
        </div>
    </div>

    {{-- ================= MODAL ================= --}}
    @foreach ($dataBelum->merge($dataLolos)->merge($dataDitolak) as $row)
        @php
            $statusBayar = $row->verifikasi?->verifikasi_pembayaran ?? 'pending';
            $statusBerkas = $row->verifikasi?->verifikasi_berkas ?? 'pending';
        @endphp

        <div class="modal fade" id="modal{{ $row->id }}">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header bg-navy">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">
                            VERIFIKASI: <b>{{ strtoupper($row->nama_lengkap) }}</b>
                        </h4>
                    </div>

                    <div class="modal-body">
                        <div class="row">

                            {{-- PREVIEW --}}
                            <div class="col-md-7">
                                <ul class="nav nav-pills">
                                    <li class="active"><a href="#pay{{ $row->id }}" data-toggle="tab">BUKTI BAYAR</a>
                                    </li>
                                    <li><a href="#doc{{ $row->id }}" data-toggle="tab">BERKAS</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane active" id="pay{{ $row->id }}">
                                        <div class="media-preview">
                                            @if ($row->pembayaran?->bukti_transfer)
                                                <img src="{{ asset('storage/' . $row->pembayaran->bukti_transfer) }}">
                                            @else
                                                <span class="text-white">BELUM ADA BUKTI</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="doc{{ $row->id }}">
                                        <div class="media-preview">
                                            @if ($row->berkas?->file_path)
                                                <iframe src="{{ asset('storage/' . $row->berkas->file_path) }}"></iframe>
                                            @else
                                                <span class="text-white">BERKAS BELUM ADA</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- FORM --}}
                            <div class="col-md-5">

                                <div class="form-group">
                                    <label>Status Pembayaran</label>
                                    <select class="form-control" id="status_pay_{{ $row->id }}">
                                        <option value="pending" {{ $statusBayar === 'pending' ? 'selected' : '' }}>PENDING
                                        </option>
                                        <option value="valid" {{ $statusBayar === 'valid' ? 'selected' : '' }}>VALID
                                        </option>
                                        <option value="invalid" {{ $statusBayar === 'invalid' ? 'selected' : '' }}>INVALID
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Status Berkas</label>
                                    <select class="form-control" id="status_file_{{ $row->id }}"
                                        {{ $statusBayar === 'valid' ? '' : 'disabled' }}>

                                        <option value="pending" {{ $statusBerkas === 'pending' ? 'selected' : '' }}>
                                            PENDING
                                        </option>
                                        <option value="belum" {{ $statusBerkas === 'belum' ? 'selected' : '' }}>
                                            BELUM
                                        </option>
                                        <option value="valid" {{ $statusBerkas === 'valid' ? 'selected' : '' }}>
                                            VALID
                                        </option>
                                        <option value="invalid" {{ $statusBerkas === 'invalid' ? 'selected' : '' }}>
                                            INVALID
                                        </option>
                                    </select>

                                    {!! $statusBayar === 'valid' ? '' : '<small class="text-muted">Aktif setelah pembayaran VALID</small>' !!}
                                </div>


                                <div class="form-group">
                                    <label>Catatan</label>
                                    <textarea class="form-control" id="note_{{ $row->id }}" rows="4">{{ $row->verifikasi?->catatan }}</textarea>
                                </div>

                                <button class="btn btn-success btn-block btn-save" data-id="{{ $row->id }}">
                                    <i class="fa fa-save"></i> SIMPAN
                                </button>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endforeach

   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function () {

    /* ==============================
     * ENABLE / DISABLE STATUS BERKAS
     * ============================== */
    $(document).on('change', '[id^="status_pay_"]', function () {
        let id = $(this).attr('id').replace('status_pay_', '');
        let statusPay = $(this).val();

        if (statusPay === 'valid') {
            $('#status_file_' + id)
                .prop('disabled', false);
        } else {
            $('#status_file_' + id)
                .prop('disabled', true)
                .val('pending');
        }
    });


    /* ==============================
     * SIMPAN VERIFIKASI
     * ============================== */
    $(document).on('click', '.btn-save', function () {
        let id = $(this).data('id');

        let statusPay  = $('#status_pay_' + id).val();
        let statusFile = $('#status_file_' + id).val();
        let catatan    = $('#note_' + id).val();

        // DATA WAJIB
        let data = {
            _token: "{{ csrf_token() }}",
            id: id,
            status_pay: statusPay,
            catatan: catatan
        };

        // 🔥 HANYA KIRIM STATUS BERKAS JIKA PEMBAYARAN VALID
        if (statusPay === 'valid') {
            data.status_file = statusFile;
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
                }).then(() => {
                    location.reload();
                });
            },
            error: function (xhr) {
                let msg = 'Terjadi kesalahan';

                if (xhr.status === 403) {
                    msg = xhr.responseJSON?.message ?? 'Akses ditolak';
                } else if (xhr.status === 404) {
                    msg = 'Data tidak ditemukan';
                } else if (xhr.status === 422) {
                    msg = 'Data tidak valid';
                }

                Swal.fire({
                    icon: 'warning',
                    title: 'DITOLAK',
                    text: msg
                });
            }
        });
    });

});
</script>

@endsection
