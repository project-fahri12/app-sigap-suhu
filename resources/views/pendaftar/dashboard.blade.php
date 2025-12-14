@extends('layouts.masterDashboard')

@section('content')
<div class="row">
  <div class="col-md-12">

  {{-- PESAN SUCCESS --}}
@if (session('success'))
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <i class="fa fa-check-circle"></i>
    {{ session('success') }}
  </div>
@endif

{{-- PESAN ERROR VALIDASI --}}
@if ($errors->any())
  <div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <i class="fa fa-exclamation-triangle"></i>
    <ul style="margin-bottom:0">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif


    <div class="row">

      <!-- PETUNJUK / LANGKAH (KIRI) -->
      <div class="col-md-4">
        <div class="box box-solid box-info">
          <div class="box-header with-border">
            <h4 class="box-title">
              <i class="fa fa-map-signs"></i> Langkah Selanjutnya
            </h4>
          </div>

          <div class="box-body">
            <ul class="list-unstyled">
              <li class="mb-3">
                <i class="fa fa-check-circle text-green"></i>
                Lengkapi data pendaftaran
              </li>
              <li class="mb-3">
                <i class="fa fa-credit-card text-blue"></i>
                Lakukan pembayaran pendaftaran
              </li>
              <li class="mb-3">
                <i class="fa fa-upload text-orange"></i>
                Upload bukti transfer
              </li>
              <li class="mb-3">
                <i class="fa fa-clock-o text-muted"></i>
                Tunggu verifikasi panitia
              </li>
            </ul>

            <hr>

            <div class="alert alert-info">
              <i class="fa fa-info-circle"></i>
              Setelah pembayaran diverifikasi, Anda akan diarahkan ke tahap selanjutnya.
            </div>

            <!-- BUTTON GABUNG GRUP -->
            <a href="#"
               class="btn btn-success btn-block">
              <i class="fa fa-whatsapp"></i> Gabung Grup Informasi
            </a>

            <small class="text-muted text-center d-block mt-2">
              Grup digunakan untuk pengumuman resmi
            </small>
          </div>
        </div>
      </div>

      <!-- FORM PEMBAYARAN (KANAN) -->
      <div class="col-md-8">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">
              <i class="fa fa-credit-card"></i> Pembayaran Pendaftaran
            </h3>
          </div>

          <!-- FORM -->
          <form action="{{ route('pendaftar.pembayaran.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="box-body">

              <!-- NOMINAL -->
              <div class="form-group">
                <label>Nominal Pembayaran</label>
                <input
                  type="number"
                  name="nominal"
                  class="form-control"
                  placeholder="Contoh: 500000"
                  required
                >
              </div>

              <!-- TANGGAL -->
              <div class="form-group">
                <label>Tanggal Pembayaran</label>
                <input
                  type="date"
                  name="tanggal_bayar"
                  class="form-control"
                  required
                >
              </div>

              <!-- BUKTI TRANSFER -->
              <div class="form-group">
                <label>Upload Bukti Transfer</label>
                <input
                  type="file"
                  name="bukti_transfer"
                  class="form-control"
                  required
                >
                <small class="text-muted">
                  JPG / PNG / PDF (maks 2MB)
                </small>
              </div>

            </div>

            <div class="box-footer">
              <button type="submit" class="btn btn-primary">
                <i class="fa fa-paper-plane"></i> Kirim Pembayaran
              </button>
            </div>
          </form>
          <!-- END FORM -->

        </div>
      </div>

    </div>

  </div>
</div>
@endsection
