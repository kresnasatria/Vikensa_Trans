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
    Schema::create('schedules', function (Blueprint $table) {
        $table->id();
        $table->foreignId('route_id')->constrained()->cascadeOnDelete();
        $table->foreignId('shuttle_id')->constrained()->cascadeOnDelete();
        $table->dateTime('departure_time');
        $table->dateTime('arrival_time');
        $table->integer('price'); // Harga untuk sewa 1 unit mobil penuh
        
        // TAMBAHAN: Status ketersediaan mobil
        $table->boolean('is_available')->default(true); 
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
