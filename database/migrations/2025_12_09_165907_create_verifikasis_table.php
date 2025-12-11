<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('verifikasi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('pendaftar_id');

            $table->enum('verifikasi_berkas', ['pending', 'valid', 'invalid'])->default('pending');
            $table->enum('verifikasi_pembayaran', ['pending', 'valid', 'invalid'])->default('pending');

            $table->text('catatan')->nullable();
            $table->uuid('diverifikasi_oleh')->nullable(); // ID user admin/panitia
            $table->date('tanggal')->nullable();

            $table->timestamps();

            $table->foreign('pendaftar_id')->references('id')->on('pendaftar')->onDelete('cascade');
            $table->foreign('diverifikasi_oleh')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verifikasis');
    }
};
