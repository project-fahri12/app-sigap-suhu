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
    Schema::create('pengumuman', function (Blueprint $table) {
        $table->uuid('id')->primary();

        $table->uuid('kategori_id');
        $table->string('judul');
        $table->text('isi');
        $table->string('file_lampiran')->nullable();

        $table->uuid('dibuat_oleh');
        $table->date('tanggal');

        $table->timestamps();

        $table->foreign('kategori_id')->references('id')->on('kategori_pengumuman')->onDelete('cascade');
        $table->foreign('dibuat_oleh')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengumumen');
    }
};
