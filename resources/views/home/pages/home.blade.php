@extends('home.homePage')

@section('content')
  <!-- Hero Section -->
<section class="hero" id="home">
    <!-- Background Pattern -->
    <div class="hero-pattern">
        <div class="pattern-dots"></div>
        <div class="pattern-waves"></div>
        <div class="pattern-squares"></div>
    </div>
    
    <div class="container">
        <div class="hero-container">
            <div class="hero-content">
                <h1>SIGAP – Sistem Informasi Gerbang Pendaftaran</h1>
                <p class="hero-subtitle">PPDB Online Cepat, Mudah, dan Transparan untuk masa depan pendidikan yang lebih baik.</p>
                <div class="hero-buttons">
                    <a href="#pendaftaran" class="btn btn-primary">
                        <i class="fas fa-user-plus me-2"></i> Daftar Sekarang
                    </a>
                    <a href="#persyaratan" class="btn btn-secondary">
                        <i class="fas fa-file-alt me-2"></i> Lihat Persyaratan
                    </a>
                </div>
                
                <!-- Stats -->
                <div class="hero-stats">
                    <div class="stat-item">
                        <div class="stat-number">1.500+</div>
                        <div class="stat-text">Pendaftar Tahun Ini</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">98%</div>
                        <div class="stat-text">Kepuasan Pengguna</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">24/7</div>
                        <div class="stat-text">Layanan Online</div>
                    </div>
                </div>
            </div>
            <div class="hero-image">
                <div class="hero-illustration">
                    <!-- Floating elements -->
                    <div class="floating-element element-1">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="floating-element element-2">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="floating-element element-3">
                        <i class="fas fa-laptop"></i>
                    </div>
                    
                    <!-- Main illustration -->
                    <div class="illustration-content">
                        <div class="illustration-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3>PPDB Online 2024</h3>
                        <p>Pendaftaran Peserta Didik Baru</p>
                        <div class="illustration-badge">
                            <span class="badge-text">Gelombang 2</span>
                            <span class="badge-subtext">Berlangsung</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Gelombang Pendaftaran Section -->
    <section class="gelombang-section" id="pendaftaran">
        <div class="container">
            <div class="section-title">
                <h2>Gelombang Pendaftaran PPDB</h2>
                <p>Pilih gelombang pendaftaran yang sesuai dengan waktu Anda</p>
            </div>
            <div class="gelombang-cards">
                <div class="gelombang-card card">
                    <div class="gelombang-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h3>Gelombang 1</h3>
                    <div class="gelombang-dates">15 Januari - 15 Februari 2024</div>
                    <p>Pendaftaran awal dengan kuota terbatas. Dapatkan potongan biaya pendaftaran 20%.</p>
                </div>
                <div class="gelombang-card card">
                    <div class="gelombang-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h3>Gelombang 2</h3>
                    <div class="gelombang-dates">1 Maret - 1 April 2024</div>
                    <p>Pendaftaran reguler dengan kuota lebih banyak. Waktu optimal untuk pendaftaran.</p>
                </div>
                <div class="gelombang-card card">
                    <div class="gelombang-icon">
                        <i class="fas fa-calendar-day"></i>
                    </div>
                    <h3>Gelombang 3</h3>
                    <div class="gelombang-dates">15 April - 15 Mei 2024</div>
                    <p>Pendaftaran akhir. Kuota terbatas dan hanya tersedia untuk program tertentu.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Visi Misi Section -->
    <section class="visi-misi-section">
        <div class="container">
            <div class="section-title">
                <h2>Visi & Misi Sekolah</h2>
                <p>Mewujudkan pendidikan berkualitas untuk generasi unggul</p>
            </div>
            <div class="visi-misi-container">
                <div class="visi-card card">
                    <div class="visi-misi-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h3>Visi</h3>
                    <p>Menjadi lembaga pendidikan unggul yang menghasilkan lulusan berkarakter, berdaya saing global,
                        dan berakhlak mulia, serta mampu berkontribusi positif bagi masyarakat dan bangsa.</p>
                </div>
                <div class="misi-card card">
                    <div class="visi-misi-icon">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h3>Misi</h3>
                    <ul class="misi-list">
                        <li><i class="fas fa-check-circle"></i> Menyelenggarakan pendidikan berkualitas dengan kurikulum
                            yang relevan dan inovatif</li>
                        <li><i class="fas fa-check-circle"></i> Mengembangkan karakter siswa melalui pendidikan akhlak
                            dan kepemimpinan</li>
                        <li><i class="fas fa-check-circle"></i> Meningkatkan kompetensi guru dan tenaga kependidikan
                            secara berkelanjutan</li>
                        <li><i class="fas fa-check-circle"></i> Menyediakan fasilitas pendidikan yang memadai dan
                            teknologi terkini</li>
                        <li><i class="fas fa-check-circle"></i> Menjalin kerjasama dengan orang tua dan masyarakat untuk
                            mendukung proses pendidikan</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Fasilitas Section -->
    <section class="fasilitas-section">
        <div class="container">
            <div class="section-title">
                <h2>Fasilitas Sekolah</h2>
                <p>Dukung pembelajaran optimal dengan fasilitas lengkap dan modern</p>
            </div>
            <div class="fasilitas-grid">
                <div class="fasilitas-card card">
                    <div class="fasilitas-icon">
                        <i class="fas fa-flask"></i>
                    </div>
                    <h3>Laboratorium</h3>
                    <p>Laboratorium sains dan komputer dengan peralatan modern untuk eksperimen dan penelitian.</p>
                </div>
                <div class="fasilitas-card card">
                    <div class="fasilitas-icon">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <h3>Perpustakaan Digital</h3>
                    <p>Koleksi buku lengkap dengan akses digital dan ruang baca yang nyaman.</p>
                </div>
                <div class="fasilitas-card card">
                    <div class="fasilitas-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <h3>Asrama</h3>
                    <p>Asrama nyaman dengan pengawasan 24 jam untuk siswa yang membutuhkan.</p>
                </div>
                <div class="fasilitas-card card">
                    <div class="fasilitas-icon">
                        <i class="fas fa-futbol"></i>
                    </div>
                    <h3>Lapangan Olahraga</h3>
                    <p>Lapangan sepak bola, basket, voli, dan fasilitas olahraga lainnya.</p>
                </div>
                <div class="fasilitas-card card">
                    <div class="fasilitas-icon">
                        <i class="fas fa-desktop"></i>
                    </div>
                    <h3>Multimedia Center</h3>
                    <p>Studio audio visual dan ruang kreatif untuk pengembangan bakat siswa.</p>
                </div>
                <div class="fasilitas-card card">
                    <div class="fasilitas-icon">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <h3>Kantin Sehat</h3>
                    <p>Kantin dengan makanan bergizi dan suasana yang bersih serta nyaman.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Persyaratan Section -->
    <section class="persyaratan-section" id="persyaratan">
        <div class="container">
            <div class="section-title">
                <h2>Persyaratan Pendaftaran</h2>
                <p>Siapkan dokumen-dokumen berikut untuk proses pendaftaran</p>
            </div>
            <div class="persyaratan-container">
                <ul class="persyaratan-list">
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <div>
                            <h3>Fotokopi Kartu Keluarga (KK)</h3>
                            <p>Fotokopi KK yang masih berlaku dan terbaru</p>
                        </div>
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <div>
                            <h3>Akta Kelahiran</h3>
                            <p>Fotokopi akta kelahiran calon siswa</p>
                        </div>
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <div>
                            <h3>Ijazah / Surat Keterangan Lulus</h3>
                            <p>Ijazah sekolah sebelumnya atau surat keterangan lulus</p>
                        </div>
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <div>
                            <h3>Pas Foto</h3>
                            <p>4 lembar pas foto ukuran 3x4 dengan latar belakang merah</p>
                        </div>
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <div>
                            <h3>Rapor Semester</h3>
                            <p>Fotokopi rapor semester 1-5 untuk SMA/SMK atau semester 1-5 untuk SMP</p>
                        </div>
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        <div>
                            <h3>Berkas Tambahan</h3>
                            <p>Surat keterangan lain sesuai dengan program yang dipilih</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Alur Pendaftaran Section -->
    <section class="alur-section">
        <div class="container">
            <div class="section-title">
                <h2>Alur Pendaftaran</h2>
                <p>Proses pendaftaran yang mudah dan terstruktur</p>
            </div>
            <div class="alur-steps">

                <div class="alur-step">
                    <div class="step-number">1</div>
                    <h3>Isi Formulir</h3>
                    <p>Mengisi formulir awal dan mendapatkan Kode Pendaftaran SIGAP.</p>
                </div>

                <div class="alur-step">
                    <div class="step-number">2</div>
                    <h3>Login</h3>
                    <p>Masuk menggunakan Kode Pendaftaran sebagai username dan tanggal lahir sebagai password.</p>
                </div>

                <div class="alur-step">
                    <div class="step-number">3</div>
                    <h3>Pembayaran Pendaftaran</h3>
                    <p>Melakukan pembayaran biaya pendaftaran.</p>
                </div>

                <div class="alur-step">
                    <div class="step-number">4</div>
                    <h3>Lengkapi Data & Upload Berkas</h3>
                    <p>Mengisi data lengkap dan mengunggah berkas dalam format PDF.</p>
                </div>

                <div class="alur-step">
                    <div class="step-number">5</div>
                    <h3>Validasi</h3>
                    <p>Menunggu proses verifikasi data oleh admin.</p>
                </div>

                <div class="alur-step">
                    <div class="step-number">6</div>
                    <h3>Cetak Bukti</h3>
                    <p>Mencetak bukti pendaftaran untuk keperluan daftar ulang.</p>
                </div>

            </div>
        </div>
    </section>


    <!-- Pengumuman Section -->
    <section class="pengumuman-section" id="pengumuman">
        <div class="container">
            <div class="section-title">
                <h2>Informasi & Pengumuman Terbaru</h2>
                <p>Update terkini seputar PPDB dan kegiatan sekolah</p>
            </div>
            <div class="pengumuman-grid">
                <div class="pengumuman-card card">
                    <div class="pengumuman-date">
                        <i class="far fa-calendar"></i> 20 Maret 2024
                    </div>
                    <h3>Jadwal Tes Masuk Gelombang 2</h3>
                    <p>Tes masuk untuk pendaftar gelombang 2 akan dilaksanakan pada tanggal 5 April 2024. Peserta
                        diharapkan hadir 30 menit sebelum tes dimulai.</p>
                </div>
                <div class="pengumuman-card card">
                    <div class="pengumuman-date">
                        <i class="far fa-calendar"></i> 15 Maret 2024
                    </div>
                    <h3>Pengumuman Hasil Seleksi Gelombang 1</h3>
                    <p>Hasil seleksi gelombang 1 telah diumumkan. Silakan cek di akun SIGAP masing-masing. Daftar ulang
                        paling lambat 25 Maret 2024.</p>
                </div>
                <div class="pengumuman-card card">
                    <div class="pengumuman-date">
                        <i class="far fa-calendar"></i> 10 Maret 2024
                    </div>
                    <h3>Open House Virtual 2024</h3>
                    <p>Ikuti open house virtual kami pada 28 Maret 2024 untuk mengenal lebih dekat program dan fasilitas
                        sekolah. Daftar melalui link di website.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Kontak Section -->
    <section class="kontak-section" id="kontak">
        <div class="container">
            <div class="section-title">
                <h2>Kontak Kami</h2>
                <p>Hubungi kami untuk informasi lebih lanjut</p>
            </div>
            <div class="kontak-container">
                <div class="kontak-info">
                    <div class="kontak-item">
                        <div class="kontak-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h3>Alamat</h3>
                            <p>Jl. Pendidikan No. 123, Kota Pendidikan, Jawa Barat 40123</p>
                        </div>
                    </div>
                    <div class="kontak-item">
                        <div class="kontak-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div>
                            <h3>Telepon</h3>
                            <p>(022) 1234567</p>
                            <p>Senin - Jumat, 08:00 - 16:00 WIB</p>
                        </div>
                    </div>
                    <div class="kontak-item">
                        <div class="kontak-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h3>Email</h3>
                            <p>info@sigap-ppdb.sch.id</p>
                            <p>ppdb@sigap-ppdb.sch.id</p>
                        </div>
                    </div>
                    <div class="map-placeholder">
                        <i class="fas fa-map-marked-alt" style="font-size: 2rem; margin-right: 10px;"></i>
                        <span>Google Maps Integration</span>
                    </div>
                </div>
                <div class="kontak-form card">
                    <h3 style="margin-bottom: 25px; color: var(--dark-blue);">Kirim Pesan</h3>
                    <form id="contactForm">
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" id="name" class="form-control"
                                placeholder="Masukkan nama lengkap">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" class="form-control"
                                placeholder="Masukkan alamat email">
                        </div>
                        <div class="form-group">
                            <label for="subject">Subjek</label>
                            <input type="text" id="subject" class="form-control" placeholder="Subjek pesan">
                        </div>
                        <div class="form-group">
                            <label for="message">Pesan</label>
                            <textarea id="message" class="form-control" rows="5" placeholder="Tulis pesan Anda"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width: 100%;">Kirim Pesan</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection