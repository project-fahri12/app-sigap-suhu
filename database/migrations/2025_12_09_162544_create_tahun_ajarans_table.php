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
    Schema::create('tahun_ajaran', function (Blueprint $table) {
        $table->uuid('id')->primary();
        $table->string('tahun');
        $table->enum('status', ['aktif', 'nonaktif']);
        $table->date('tanggal_mulai');
        $table->date('tanggal_selesai');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tahun_ajarans');
    }
};
