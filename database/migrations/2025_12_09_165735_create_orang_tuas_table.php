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
        Schema::create('orang_tua', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('pendaftar_id');

            $table->string('nama_ayah')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->enum('status_ayah', ['hidup', 'meninggal', 'tidak_diketahui'])->nullable();

            $table->string('nama_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->enum('status_ibu', ['hidup', 'meninggal', 'tidak_diketahui'])->nullable();

            $table->text('alamat_orang_tua')->nullable();

            $table->string('email')->nullable();
            $table->string('no_wa_utama', 20)->nullable();
            $table->enum('pemilik_no_utama', ['ayah','ibu','wali','lainnya'])->nullable();

            $table->string('no_wa_cadangan', 20)->nullable();
            $table->enum('pemilik_no_cadangan', ['ayah','ibu','wali','lainnya'])->nullable();

            $table->timestamps();

            $table->foreign('pendaftar_id')
                ->references('id')
                ->on('pendaftar')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orang_tua');
    }
};
