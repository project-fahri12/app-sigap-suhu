<footer id="footer" class="py-5 bg-dark-navy text-white mt-5">
    <div class="container">
        <div class="row">
            
            <div class="col-md-4 mb-4 mb-md-0">
                <a class="d-flex align-items-center mb-3 text-decoration-none" href="{{ url('/') }}">
                    {{-- Placeholder untuk SVG Logo --}}
                    <img src="{{ asset('assets/logo-sigap.svg') }}" alt="Logo SIGAP" height="100" class="me-2">
                    <span class="h5 fw-bold text-white mb-0">SIGAP</span>
                    <span class="h5 text-light-aqua ms-1 small mb-0">PPDB</span>
                </a>
                <p class="small text-muted">Sistem Informasi Gerbang Pendaftaran, solusi PPDB online yang cepat, mudah, dan transparan.</p>
                <div class="social-icons mt-3">
                    <a href="#" class="text-white me-3 hover-text-aqua"><i class="fab fa-facebook-f fa-lg"></i></a>
                    <a href="#" class="text-white me-3 hover-text-aqua"><i class="fab fa-twitter fa-lg"></i></a>
                    <a href="#" class="text-white me-3 hover-text-aqua"><i class="fab fa-instagram fa-lg"></i></a>
                    <a href="#" class="text-white me-3 hover-text-aqua"><i class="fab fa-youtube fa-lg"></i></a>
                </div>
            </div>
            
            <div class="col-md-2 mb-3 mb-md-0">
                <h6 class="fw-bold text-light-aqua mb-3">Tautan Cepat</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="{{ url('/') }}" class="text-muted text-decoration-none hover-text-white">Beranda</a></li>
                    <li class="mb-2"><a href="#persyaratan" class="text-muted text-decoration-none hover-text-white">Persyaratan</a></li>
                    <li class="mb-2"><a href="#alur" class="text-muted text-decoration-none hover-text-white">Prosedur</a></li>
                    <li class="mb-2"><a href="#visimisi" class="text-muted text-decoration-none hover-text-white">Visi & Misi</a></li>
                </ul>
            </div>
            
            <div class="col-md-3 mb-3 mb-md-0">
                <h6 class="fw-bold text-light-aqua mb-3">Layanan PPDB</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="{{ url('/pendaftaran/cek-status') }}" class="text-muted text-decoration-none hover-text-white">Cek Status Pendaftaran</a></li>
                    <li class="mb-2"><a href="#" class="text-muted text-decoration-none hover-text-white">Download Formulir</a></li>
                    <li class="mb-2"><a href="#pengumuman" class="text-muted text-decoration-none hover-text-white">Arsip Pengumuman</a></li>
                    <li class="mb-2"><a href="#" class="text-muted text-decoration-none hover-text-white">FAQ</a></li>
                </ul>
            </div>
            
            <div class="col-md-3">
                <h6 class="fw-bold text-light-aqua mb-3">Hubungi Kami</h6>
                <ul class="list-unstyled small text-muted">
                    <li class="mb-2">Jl. Pendidikan No. 1</li>
                    <li class="mb-2">(021) 1234 5678</li>
                    <li class="mb-2">info@sigap.sch.id</li>
                </ul>
            </div>
        </div>
        
        <hr class="my-4 border-light-aqua opacity-25">
        
        <div class="row">
            <div class="col-12 text-center small text-muted">
                &copy; {{ date('Y') }} SIGAP - Sistem Informasi Gerbang Pendaftaran. All rights reserved.
            </div>
        </div>
    </div>
</footer>