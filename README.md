# 🚀 SIGAP: Sistem Informasi Gerbang Pendaftaran
**(Aplikasi PPDB Online - Proyek Praktik Kerja Lapangan)**

![Logo Aplikasi SIGAP](assets/sigap_logo-sigap.svg)

Aplikasi **SIGAP** (Sistem Informasi Gerbang Pendaftaran) adalah platform berbasis web yang dikembangkan untuk mengotomatisasi proses Penerimaan Peserta Didik Baru (PPDB). Proyek ini merupakan tugas akhir **Praktik Kerja Lapangan (PKL)**, bertujuan menyediakan solusi pendaftaran sekolah yang cepat, transparan, dan efisien.

---

## 🌟 Fitur Utama

Aplikasi SIGAP dirancang dengan dua peran utama: **Pendaftar** dan **Administrator**.

### Untuk Pendaftar/Orang Tua
* **Pendaftaran Akun:** Proses registrasi cepat dan verifikasi.
* **Pengisian Formulir:** Input data diri, data orang tua, dan pemilihan jalur pendaftaran.
* **Upload Dokumen:** Unggah dokumen persyaratan dalam berbagai format (PDF, JPG).
* **Cek Status:** Pelacakan status pendaftaran secara *real-time*.

### Untuk Administrator/Panitia
* **Verifikasi Digital:** Sistem untuk memverifikasi kelengkapan dan keabsahan dokumen pendaftar.
* **Manajemen Kuota:** Pengaturan kuota penerimaan berdasarkan jalur (Zonasi, Prestasi, Afirmasi).
* **Pelaporan Data:** Fitur *export* data pendaftar dalam format CSV/Excel.
* **Pengaturan Sistem:** Mengelola tanggal penting dan pengumuman.

---

## 🛠️ Tumpukan Teknologi (Technology Stack)

Proyek ini dikembangkan menggunakan tumpukan teknologi populer berikut:

* **Framework:** **Laravel v12**
* **Database:** **MySQL**
* **Frontend:** HTML5, CSS3, JavaScript, dan **Bootstrap 5** (untuk desain responsif).
* **Lingkungan Pengembangan:** PHP, Composer.

---

## ⚙️ Panduan Instalasi Lokal

Ikuti langkah-langkah berikut untuk menjalankan aplikasi SIGAP di lingkungan lokal Anda.

### Persyaratan
* PHP versi 8.2 atau lebih tinggi.
* Composer (untuk manajemen dependensi PHP).
* Web Server (Apache/Nginx) atau *tool* seperti XAMPP/Laragon.
* MySQL Database.

### Langkah-langkah
1.  **Clone Repositori:**
    ```bash
    git clone [https://github.com/mrfahridwihermawan/nama-repo-sigap.git](https://github.com/mrfahridwihermawan/nama-repo-sigap.git)
    cd nama-repo-sigap
    ```

2.  **Instal Dependensi:**
    ```bash
    composer install
    npm install 
    npm run dev # Atau npm run build
    ```

3.  **Konfigurasi Lingkungan:**
    * Buat salinan file `.env.example` menjadi `.env`.
    * Buat *database* baru di MySQL, lalu atur kredensial koneksi di file `.env`:
        ```
        DB_DATABASE=nama_database_anda
        DB_USERNAME=user_db
        DB_PASSWORD=password_db
        ```
    * Buat kunci aplikasi:
        ```bash
        php artisan key:generate
        ```

4.  **Migrasi Database dan Seed Data (Opsional):**
    ```bash
    php artisan migrate --seed 
    ```
    *(Gunakan `--seed` jika Anda memiliki data awal (misalnya, akun admin default).)*

5.  **Jalankan Aplikasi:**
    ```bash
    php artisan serve 
    ```
    Aplikasi akan berjalan di `http://127.0.0.1:8000` (atau sesuaikan dengan konfigurasi Anda).

---

## 🤝 Kontribusi

Proyek ini adalah hasil dari Praktik Kerja Lapangan. Saran, *issue*, atau *pull request* yang membangun sangat diterima untuk pengembangan lebih lanjut.

---

## 📞 Kontak dan Informasi Proyek

| Kunci | Detail |
| :--- | :--- |
| **Pengembang:** | **Fahri Dwi** |
| **Email:** | mrfahridwihermawan@gmail.com |
| **Kelas/Jurusan:** | XII Rekayasa Perangkat Lunak (RPL) |
| **Institusi:** | SMK SUBULUL HDUA |
| **Tahun Proyek:** | 2025 |

---

## 📄 Lisensi

Proyek ini dilisensikan di bawah **MIT License**.
