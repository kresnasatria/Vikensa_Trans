<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_logs', function (Blueprint $table) {
            // Menambahkan kolom estimasi_harga bertipe string agar admin bisa mengetik bebas (contoh: "Rp 1.500.000")
            $table->string('estimasi_harga')->nullable()->after('suku_cadang');
        });
    }

    public function down(): void
    {
        Schema::table('service_logs', function (Blueprint $table) {
            $table->dropColumn('estimasi_harga');
        });
    }
};