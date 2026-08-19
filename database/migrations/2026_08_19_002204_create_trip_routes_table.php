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
        Schema::create('trip_routes', function (Blueprint $table) {
            $table->id();
            $table->string('origin'); // Kota Jemput (Asal)
            $table->string('destination'); // Kota Tujuan
            $table->integer('route_cost'); // Ongkos Rute Perjalanan
            $table->integer('fuel_cost'); // Biaya Bensin (Bisa diubah-ubah nanti)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_routes');
    }
};