<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('pembayaran', function (Blueprint $table) {
        $table->string('order_id')->after('pendaftar_id')->unique();
        $table->string('snap_token')->nullable()->after('nominal');
        $table->string('status')->default('pending')->after('snap_token'); // pending, settlement, expire, cancel
        $table->string('payment_type')->nullable()->after('status');
        
        // bukti_transfer dibuat nullable karena sekarang otomatis
        $table->string('bukti_transfer')->nullable()->change();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            //
        });
    }
};
