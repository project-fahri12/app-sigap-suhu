@extends('layouts.masterDashboard')

@section('content')
    <style>
        /* UI Enhancements */
        .card-upload {
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s;
        }

        .checklist-docs {
            list-style: none;
            padding: 0;
        }

        .checklist-docs li {
            padding: 8px 0;
            border-bottom: 1px dashed #eee;
            display: flex;
            align-items: center;
        }

        .checklist-docs li i {
            color: #00a65a;
            margin-right: 10px;
        }

        /* Responsive File Input Styling */
        .custom-file-upload {
            border: 2px dashed #ddd;
            display: block;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            border-radius: 8px;
            background: #fafafa;
            transition: 0.3s;
        }

        .custom-file-upload:hover {
            border-color: #3c8dbc;
            background: #f0f7ff;
        }

        /* Status Card */
        .status-badge-lg {
            padding: 10px 20px;
            font-size: 14px;
            border-radius: 50px;
            display: inline-block;
            margin-bottom: 10px;
        }

        /* Preview Image */
        #preview-foto {
            width: 120px;
            height: 160px;
            object-fit: cover;
            border-radius: 6px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 15px;
            border: 2px solid #fff;
        }

        @media (max-width: 768px) {
            .btn-responsive {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>

    <div class="row">
        {{-- Container Utama agar Tercenter di Desktop, Full di Mobile --}}
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-xs-12">

            {{-- HEADER INFO --}}
            <div class="box box-solid bg-teal-gradient card-upload shadow">
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-8">
                            <h4 style="margin-top:0;"><i class="fa fa-info-circle"></i> <strong>Informasi Berkas</strong></h4>
                            <ul class="checklist-docs">
                                <li><i class="fa fa-check-circle"></i> Kartu Keluarga (KK)</li>
                                <li><i class="fa fa-check-circle"></i> Akta Kelahiran</li>
                                <li><i class="fa fa-check-circle"></i> Ijazah Terakhir / SKL</li>
                                <li><i class="fa fa-check-circle"></i> Pas Foto Berwarna</li>
                            </ul>
                        </div>
                        <div class="col-sm-4 text-center hidden-xs">
                            <i class="fa fa-cloud-upload" style="font-size: 100px; opacity: 0.3; margin-top: 20px;"></i>
                        </div>
                    </div>
                    <div style="background: rgba(0,0,0,0.1); padding: 10px; border-radius: 5px; margin-top: 10px;">
                        <small><strong>Note:</strong> Gabungkan semua dokumen (selain foto) dalam 1 file
                            <strong>PDF</strong> maksimal 5MB.</small>
                    </div>
                </div>
            </div>

            {{-- STATUS VERIFIKASI --}}
            @if ($verifikasi && $verifikasi->verifikasi_berkas != 'belum')
                <div class="box box-primary card-upload shadow">
                    <div class="box-header with-border text-center">
                        <h3 class="box-title">Status Berkas Anda</h3>
                    </div>
                    <div class="box-body text-center">
                        @if ($verifikasi->verifikasi_berkas == 'pending')
                            <div class="status-badge-lg label-warning"><i class="fa fa-clock-o"></i> Menunggu Verifikasi
                            </div>
                            <p class="text-muted">Berkas Anda sedang diperiksa oleh panitia. Mohon cek berkala.</p>
                        @elseif($verifikasi->verifikasi_berkas == 'valid')
                            <div class="status-badge-lg label-success"><i class="fa fa-check"></i> Berkas Diterima</div>
                            <p class="text-success">Selamat! Berkas Anda telah dinyatakan valid.</p>
                            <div style="margin-top: 15px;">
                                <a href="{{ route('pendaftar.cetak-bukti-pdf') }}"
                                    class="btn btn-danger btn-lg btn-responsive">
                                    <i class="fa fa-file-pdf-o"></i> Download Bukti Pendaftaran
                                </a>
                            </div>
                        @elseif($verifikasi->verifikasi_berkas == 'invalid')
                            <div class="status-badge-lg label-danger"><i class="fa fa-times"></i> Berkas Ditolak</div>
                            <div class="alert alert-danger" style="margin-top:10px;">
                                <strong>Catatan Panitia:</strong><br>
                                {{ $verifikasi->catatan ?? 'Silahkan upload ulang berkas sesuai ketentuan.' }}
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            {{-- FORM UPLOAD (Hanya muncul jika belum upload atau ditolak) --}}
            @if (!$verifikasi || in_array($verifikasi->verifikasi_berkas, ['belum', 'invalid']))
                <div class="box box-primary card-upload shadow">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-upload text-blue"></i> Formulir Unggah Berkas</h3>
                    </div>

                    <form action="{{ route('pendaftar.upload-berkas.store') }}" method="POST" enctype="multipart/form-data"
                        id="uploadForm">
                        @csrf
                        <div class="box-body">
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </div>
                            @endif

                            <div class="row">
                                {{-- UPLOAD PDF --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><i class="fa fa-file-pdf-o text-red"></i> Dokumen Gabungan (PDF)</label>
                                        <label for="file-pdf" class="custom-file-upload">
                                            <i class="fa fa-folder-open text-muted"></i> <span id="pdf-name">Pilih File
                                                PDF...</span>
                                        </label>
                                        <input type="file" id="file-pdf" name="file" accept="application/pdf"
                                            style="display:none" required onchange="updateFileName(this, 'pdf-name')">
                                        <p class="help-block small">Max. 5MB (KK, Akta, Ijazah)</p>
                                    </div>
                                </div>

                                {{-- UPLOAD FOTO --}}
                                <div class="col-md-6 text-center">
                                    <div class="form-group">
                                        <label style="display:block; text-align:left;"><i class="fa fa-image text-blue"></i>
                                            Pas Foto (JPG/PNG)</label>
                                        <label for="file-foto" class="custom-file-upload">
                                            <i class="fa fa-camera text-muted"></i> <span>Pilih Foto...</span>
                                        </label>
                                        <input type="file" id="file-foto" name="foto" accept="image/jpeg,image/png"
                                            style="display:none" required onchange="previewFoto(this)">

                                        <center>
                                            <img id="preview-foto" src="" style="display:none">
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box-footer text-center" style="background: #f9f9f9;">
                            <button type="submit" class="btn btn-primary btn-lg btn-responsive shadow" id="btnSubmit">
                                <i class="fa fa-cloud-upload"></i> Kirim Berkas Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            @endif

        </div>
    </div>

    <script>
        // Update nama file saat dipilih
        function updateFileName(input, targetId) {
            const fileName = input.files[0].name;
            document.getElementById(targetId).innerText = fileName;
            document.getElementById(targetId).style.color = "#3c8dbc";
            document.getElementById(targetId).style.fontWeight = "bold";
        }

        // Preview Foto & Validasi
        function previewFoto(input) {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById('preview-foto');
                    img.src = e.target.result;
                    img.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        }

        // Animasi Loading saat Submit
        document.getElementById('uploadForm')?.addEventListener('submit', function() {
            const btn = document.getElementById('btnSubmit');
            btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Sedang Mengunggah...';
            btn.classList.add('disabled');
        });
    </script>

@endsection
