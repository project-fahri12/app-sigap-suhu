<form action="{{ route('pendaftar.pembayaran.store') }}"
      method="POST"
      enctype="multipart/form-data">
    @csrf

    <div class="box-body">

        <div class="form-group">
            <label>Nominal Pembayaran</label>
            <input type="number" name="nominal" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Tanggal Pembayaran</label>
            <input type="date" name="tanggal_bayar" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Upload Bukti Transfer</label>
            <input type="file" name="bukti_transfer" class="form-control" required>
            <small class="text-muted">JPG / PNG / PDF (maks 2MB)</small>
        </div>

    </div>

    <div class="box-footer">
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-paper-plane"></i> Kirim Pembayaran
        </button>
    </div>
</form>
