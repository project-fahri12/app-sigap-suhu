
<script>
    $(document).ready(function() {
        // 1. Konfigurasi Dasar Toast
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        // 2. Notifikasi Sukses (Toast)
        @if(session('success'))
            Toast.fire({
                icon: 'success',
                title: "{{ session('success') }}"
            });
        @endif

        // 3. Notifikasi Error / Gagal (Modal)
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Kesalahan!',
                text: "{{ session('error') }}",
                confirmButtonColor: '#d33'
            });
        @endif

        // 4. Notifikasi Peringatan (Toast)
        @if(session('warning'))
            Toast.fire({
                icon: 'warning',
                title: "{{ session('warning') }}"
            });
        @endif

        // 5. Notifikasi Validasi Form (Modal)
        @if($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan Input',
                html: `
                    <div style="text-align: left; margin-left: 20px;">
                        <ul style="list-style-type: disc;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                `,
                confirmButtonColor: '#d33'
            });
        @endif
    });
</script>