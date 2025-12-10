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
    Schema::create('pembayaran', function (Blueprint $table) {
        $table->uuid('id')->primary();
        $table->uuid('pendaftar_id');

        $table->integer('nominal');
        $table->string('bukti_transfer')->nullable();
        $table->enum('status', ['pending', 'diterima', 'ditolak'])->default('pending');
        $table->date('tanggal_bayar')->nullable();

        $table->timestamps();

        $table->foreign('pendaftar_id')->references('id')->on('pendaftar')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
