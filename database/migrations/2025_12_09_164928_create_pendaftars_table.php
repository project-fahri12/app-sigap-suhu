<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftar', function (Blueprint $table) {
            // Data Santri
            $table->uuid('id')->primary();
            $table->uuid('users_id');
            $table->string('kode_pendaftaran')->unique();
            $table->string('nik', 20)->unique();
            $table->string('nama_lengkap');
            $table->string('tempat_lahir', 100);
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->enum('status_santri', ['mukim', 'non_mukim']);

            $table->string('provinsi', 25);
            $table->string('kabupaten', 25);
            $table->string('kecamatan', 25);
            $table->string('desa', 25);
            $table->string('rt', 3)->nullable();
            $table->string('rw', 3)->nullable();
            $table->string('alamat_detail');
            $table->string('asal_sekolah', 50)->nullable();

            $table->uuid('gelombang_id');
            $table->uuid('tahun_ajaran_id');
            $table->uuid('sekolah_pilihan_id');
            $table->uuid('unit_id');
            // $table->enum('status_santri', ['daftar', 'lolos_biaya_pendaftaran', 'berkas', 'daftar_ulang', '']);

            $table->timestamps();

            $table->foreign('users_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('gelombang_id')->references('id')->on('gelombang')->cascadeOnDelete();
            $table->foreign('tahun_ajaran_id')->references('id')->on('tahun_ajaran')->cascadeOnDelete();
            $table->foreign('sekolah_pilihan_id')->references('id')->on('sekolah_pilihan')->cascadeOnDelete();
            $table->foreign('unit_id')->references('id')->on('unit')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftar');
    }
};
