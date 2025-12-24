{{-- SCRIPT SNAP MIDTRANS --}}
@if (!$santri->registration_progress->step2->is_valid && isset($snapToken))
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            const payButton = document.getElementById('pay-button');
            
            if (!payButton) return;

            payButton.addEventListener('click', function (e) {
                e.preventDefault();

                // 1. Efek Loading pada Tombol
                const originalContent = this.innerHTML;
                this.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menghubungkan ke Midtrans...';
                this.disabled = true;

                // 2. Panggil Popup Snap
                window.snap.pay('{{ $snapToken }}', {
                    onSuccess: function(result) {
                        /* Terpanggil saat pembayaran berhasil (Settlement) */
                        window.location.reload();
                    },
                    onPending: function(result) {
                        /* Terpanggil saat user sudah memilih metode (misal: VA keluar) tapi belum bayar */
                        window.location.reload();
                    },
                    onError: function(result) {
                        /* Terpanggil saat terjadi kesalahan teknis di sisi Midtrans */
                        console.error(result);
                        alert("Terjadi kesalahan teknis saat memproses pembayaran.");
                        resetButton(payButton, originalContent);
                    },
                    onClose: function() {
                        /* Terpanggil saat user menutup popup tanpa menyelesaikan transaksi */
                        resetButton(payButton, originalContent);
                    }
                });
            });

            function resetButton(button, content) {
                button.innerHTML = content;
                button.disabled = false;
            }
        });
    </script>
@endif