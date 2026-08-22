<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_logs', function (Blueprint $table) {
            $table->id();
            // Relasi ke tabel armada (shuttles)
            $table->foreignId('shuttle_id')->constrained('shuttles')->onDelete('cascade');
            
            $table->text('kendala')->nullable(); // Kendalanya apa saja
            $table->text('kerusakan')->nullable(); // Rusaknya apa saja
            $table->text('suku_cadang')->nullable(); // Suku cadang yang diganti
            $table->string('estimasi_waktu')->nullable(); // Estimasi waktu servis (misal: "3 Hari", "1 Minggu")
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_logs');
    }
};