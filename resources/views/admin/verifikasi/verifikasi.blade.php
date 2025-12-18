@extends('layouts.masterDashboard')

@section('content')
    <style>
        /* Custom Styling untuk UX yang lebih Clean */
        .modal-content {
            border-radius: 12px;
            overflow: hidden;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            padding: 20px;
            border-bottom: 1px solid #eee;
        }

        .info-card {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            border: 1px solid #e9ecef;
        }

        .media-preview {
            background: #333;
            border-radius: 8px;
            min-height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        .media-preview img {
            max-height: 400px;
            width: auto;
        }

        .media-preview iframe {
            width: 100%;
            height: 400px;
            border: none;
        }

        .section-title {
            font-size: 14px;
            font-weight: 700;
            color: #444;
            margin-bottom: 10px;
            display: block;
            text-transform: uppercase;
        }

        .label-status {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
        }
    </style>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><b><i class="fa fa-user-check"></i> VERIFIKASI PENDAFTAR</b></h3>
        </div>

        <div class="box-body">
            {{-- TAB NAVIGASI --}}
            <ul class="nav nav-tabs nav-justified" id="mainTab">
                <li class="active">
                    <a href="#tab_belum" data-toggle="tab">
                        <b>BELUM DIPERIKSA</b> <span class="badge bg-blue"
                            style="margin-left:5px">{{ $dataBelum->count() }}</span>
                    </a>
                </li>
                <li>
                    <a href="#tab_lolos" data-toggle="tab">
                        <b>LOLOS</b> <span class="badge bg-green" style="margin-left:5px">{{ $dataLolos->count() }}</span>
                    </a>
                </li>
                <li>
                    <a href="#tab_ditolak" data-toggle="tab">
                        <b>DITOLAK</b> <span class="badge bg-red" style="margin-left:5px">{{ $dataDitolak->count() }}</span>
                    </a>
                </li>
            </ul>

            <div class="tab-content" style="margin-top: 20px;">

                {{-- LOOPING UNTUK 3 TAB (MENGGUNAKAN LOGIKA YANG SAMA) --}}
                @foreach (['belum' => $dataBelum, 'lolos' => $dataLolos, 'ditolak' => $dataDitolak] as $type => $dataset)
                    <div class="tab-pane {{ $type == 'belum' ? 'active' : '' }}" id="tab_{{ $type }}">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr class="bg-gray">
                                        <th width="5%">NO</th>
                                        <th>KODE DAFTAR</th>
                                        <th>NAMA PENDAFTAR</th>
                                        <th>PEMBAYARAN</th>
                                        <th>BERKAS</th>
                                        <th width="10%" class="text-center">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($dataset as $key => $row)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td><b>{{ $row->kode_pendaftaran ?? 'BELUM ADA' }}</b></td>
                                            <td>{{ strtoupper($row->nama_lengkap ?? 'DATA KOSONG') }}</td>
                                            <td>
                                                <span
                                                    class="label {{ $row->verifikasi->verifikasi_pembayaran == 'valid' ? 'label-success' : ($row->verifikasi->verifikasi_pembayaran == 'invalid' ? 'label-danger' : 'label-warning') }}">
                                                    {{ strtoupper($row->verifikasi->verifikasi_pembayaran) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span
                                                    class="label {{ $row->verifikasi->verifikasi_berkas == 'valid' ? 'label-success' : ($row->verifikasi->verifikasi_berkas == 'invalid' ? 'label-danger' : 'label-warning') }}">
                                                    {{ strtoupper($row->verifikasi->verifikasi_berkas) }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-primary btn-sm btn-block" data-toggle="modal"
                                                    data-target="#modalVerif{{ $row->id }}">
                                                    <i class="fa fa-search"></i> PERIKSA
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted" style="padding: 30px;">
                                                <i class="fa fa-info-circle fa-2x"></i> <br> TIDAK ADA DATA PENDAFTAR
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

    {{-- MODAL SECTION --}}
    @foreach ($dataBelum->merge($dataLolos)->merge($dataDitolak) as $row)
        <div class="modal fade" id="modalVerif{{ $row->id }}" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-navy">
                        <button type="button" class="close" data-dismiss="modal"
                            style="color: white opacity: 1"><span>&times;</span></button>
                        <h4 class="modal-title">VERIFIKASI PENDAFTAR: <b>{{ strtoupper($row->nama_lengkap) }}</b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            {{-- SISI KIRI: PREVIEW BERKAS & BAYAR --}}
                            <div class="col-md-7">
                                <ul class="nav nav-pills" style="margin-bottom: 10px;">
                                    <li class="active"><a href="#pay{{ $row->id }}" data-toggle="tab"><i
                                                class="fa fa-money"></i> BUKTI BAYAR</a></li>
                                    <li><a href="#doc{{ $row->id }}" data-toggle="tab"><i class="fa fa-file-text"></i>
                                            DOKUMEN BERKAS</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="pay{{ $row->id }}">
                                        <div class="media-preview">
                                            @if ($row->pembayaran && $row->pembayaran->bukti_transfer)
                                                <img src="{{ asset('storage/' . $row->pembayaran->bukti_transfer) }}"
                                                    alt="Bukti Transfer">
                                            @else
                                                <p class="text-white">BUKTI PEMBAYARAN BELUM TERSEDIA</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="doc{{ $row->id }}">
                                        <div class="media-preview">
                                            @if ($row->berkas && $row->berkas->file_path)
                                                <iframe src="{{ asset('storage/' . $row->berkas->file_path) }}"></iframe>
                                            @else
                                                <p class="text-white">DOKUMEN BERKAS BELUM TERSEDIA</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- SISI KANAN: FORM UPDATE --}}
                            <div class="col-md-5">
                                <div class="info-card">
                                    <span class="section-title">Informasi Pendaftar</span>
                                    <table class="table table-condensed" style="font-size: 12px; margin-bottom: 0;">
                                        <tr>
                                            <th>UNIT</th>
                                            <td>{{ $row->unit->nama_unit ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>ASAL</th>
                                            <td>{{ strtoupper($row->asal_sekolah ?? '-') }}</td>
                                        </tr>
                                        <tr>
                                            <th>TTL</th>
                                            <td>{{ strtoupper($row->tempat_lahir) }}, {{ $row->tanggal_lahir }}</td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="form-group">
                                    <label class="section-title">Status Verifikasi Pembayaran</label>
                                    <select class="form-control" id="status_pay_{{ $row->id }}">
                                        <option value="pending"
                                            {{ $row->verifikasi->verifikasi_pembayaran == 'pending' ? 'selected' : '' }}>
                                            PENDING (MENUNGGU)</option>
                                        <option value="valid"
                                            {{ $row->verifikasi->verifikasi_pembayaran == 'valid' ? 'selected' : '' }}>
                                            VALID (OKE)</option>
                                        <option value="invalid"
                                            {{ $row->verifikasi->verifikasi_pembayaran == 'invalid' ? 'selected' : '' }}>
                                            INVALID (DITOLAK)</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="section-title">Status Verifikasi Berkas</label>
                                    <select class="form-control" id="status_file_{{ $row->id }}">
                                        <option value="pending"
                                            {{ $row->verifikasi->verifikasi_berkas == 'pending' ? 'selected' : '' }}>
                                            PENDING (MENUNGGU)</option>
                                        <option value="belum"
                                            {{ $row->verifikasi->verifikasi_berkas == 'belum' ? 'selected' : '' }}>BELUM
                                            LENGKAP</option>
                                        <option value="valid"
                                            {{ $row->verifikasi->verifikasi_berkas == 'valid' ? 'selected' : '' }}>VALID
                                            (OKE)</option>
                                        <option value="invalid"
                                            {{ $row->verifikasi->verifikasi_berkas == 'invalid' ? 'selected' : '' }}>
                                            INVALID (DITOLAK)</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="section-title">Catatan / Alasan</label>
                                    <textarea class="form-control" id="note_{{ $row->id }}" rows="4"
                                        placeholder="Contoh: Foto bukti transfer buram, harap upload ulang." style="text-transform: uppercase;">{{ $row->verifikasi->catatan }}</textarea>
                                </div>

                                <button class="btn btn-success btn-block btn-lg btn-save-data"
                                    data-id="{{ $row->id }}">
                                    <i class="fa fa-save"></i> <b>SIMPAN VERIFIKASI</b>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- SCRIPT AJAX --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('.btn-save-data').on('click', function() {
                let id = $(this).data('id');
                let data = {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    status_pay: $('#status_pay_' + id).val(),
                    status_file: $('#status_file_' + id).val(),
                    catatan: $('#note_' + id).val()
                };

                let btn = $(this);
                btn.html('<i class="fa fa-spinner fa-spin"></i> MENYIMPAN...').attr('disabled', true);

                $.ajax({
                    url: "{{ route('admin.verifikasi.update') }}",
                    type: "POST",
                    data: data,
                    success: function(res) {
                        Swal.fire('BERHASIL!', res.message, 'success').then(() => location
                            .reload());
                    },
                    error: function() {
                        Swal.fire('ERROR!', 'Gagal menyambung ke server', 'error');
                        btn.html('<i class="fa fa-save"></i> SIMPAN VERIFIKASI').attr(
                            'disabled', false);
                    }
                });
            });
        });
    </script>
@endsection
