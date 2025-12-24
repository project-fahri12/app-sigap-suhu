{{-- <style>
    /* CSS diletakkan di atas agar dibaca browser paling awal */
    #loader-wrapper {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        z-index: 9999999;
        display: flex; /* Langsung tampil tanpa animasi muncul */
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: rgba(255, 255, 255, 0.4); 
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
    }

    /* Gunakan class khusus untuk menghilang secara halus */
    .loader-fade-out {
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.4s ease-out, visibility 0.4s;
    }

    .loader-content { text-align: center; }

    .loading-img {
        width: 150px;
        animation: pulse-slow 2.5s infinite ease-in-out;
    }

    .loading-text {
        font-family: sans-serif;
        font-weight: 600;
        color: #5d4037;
        letter-spacing: 2px;
        display: block;
        margin-top: 10px;
    }

    @keyframes pulse-slow {
        0%, 100% { transform: scale(0.95); opacity: 0.8; }
        50% { transform: scale(1.05); opacity: 1; }
    }
</style>

<div id="loader-wrapper">
    <div class="loader-content">
        <img src="{{ asset('assets/logo-sigap-brown.png') }}" class="loading-img" alt="Logo">
        <span class="loading-text">
            <i class="fa fa-circle-o-notch fa-spin"></i> Memuat...
        </span>
    </div>
</div>

<script>
    (function() {
        const loader = document.getElementById("loader-wrapper");

        // FUNGSI SEMBUNYIKAN
        function hideLoading() {
            loader.classList.add("loader-fade-out");
        }

        // FUNGSI TAMPILKAN
        function showLoading() {
            loader.classList.remove("loader-fade-out");
            loader.style.display = "flex";
        }

        // 1. Saat halaman baru selesai load, sembunyikan loading
        window.addEventListener("load", function() {
            setTimeout(hideLoading, 200); 
        });

        // 2. Tangkap klik pada link menu agar loading muncul di halaman lama sebelum pindah
        document.addEventListener("click", function(e) {
            const btn = e.target.closest(".btn-loading, .sidebar-menu a");
            if (btn) {
                const href = btn.getAttribute("href");
                if (href && href !== "#" && !href.startsWith("javascript")) {
                    showLoading();
                }
            }
        });

        // 3. Tangkap submit form
        document.addEventListener("submit", function(e) {
            if (!e.defaultPrevented) {
                showLoading();
            }
        });
    })();
</script> --}}