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
    Schema::create('shuttles', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Contoh: Hiace Commuter 1
        $table->string('license_plate')->unique(); // Plat nomor
        $table->integer('seat_capacity'); // Jumlah kursi, misal: 14
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shuttles');
    }
};
