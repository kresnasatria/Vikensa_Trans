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
        Schema::table('service_logs', function (Blueprint $table) {
            // Menambahkan kolom km_awal setelah shuttle_id (atau sesuaikan posisinya)
            $table->integer('km_awal')->nullable()->after('shuttle_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_logs', function (Blueprint $table) {
            //
        });
    }
};
