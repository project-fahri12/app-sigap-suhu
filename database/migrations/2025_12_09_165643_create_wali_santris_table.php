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
        Schema::create('wali_santri', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('pendaftar_id');

            $table->string('nama_wali');
            $table->string('pekerjaan_wali')->nullable();
            $table->enum('hubungan_wali', ['ayah', 'ibu', 'paman', 'bibi', 'kakek', 'nenek', 'lainnya']);
            $table->text('alamat_wali')->nullable();
            $table->string('no_hp_wali', 20)->nullable();

            $table->timestamps();

            $table->foreign('pendaftar_id')->references('id')->on('pendaftar')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wali_santris');
    }
};
