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
    Schema::table('schedules', function (Blueprint $table) {
        // Tambahkan 2 kolom teks baru
        $table->string('route_origin')->nullable()->after('route_id');
        $table->string('route_destination')->nullable()->after('route_origin');
        
        // Buat route_id lama menjadi opsional (agar tidak error)
        $table->unsignedBigInteger('route_id')->nullable()->change();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            //
        });
    }
};
