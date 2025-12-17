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
        Schema::create('sekolah_pilihan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_sekolah');
            $table->enum('jenjang', ['RA/TK', 'SD/MI', 'SLTA', 'SLTP', 'PERGURUAN TINGGI', 'SALAF']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sekolah_pilihans');
    }
};
