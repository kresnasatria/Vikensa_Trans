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
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();
        $table->string('booking_code')->unique(); 
        $table->foreignId('user_id')->constrained()->cascadeOnDelete(); 
        $table->foreignId('schedule_id')->constrained()->cascadeOnDelete(); 
        
        // KOLOM seat_numbers DIHAPUS, diganti dengan catatan opsional
        $table->text('pickup_notes')->nullable(); // Misal: "Jemput di lobi hotel"
        
        $table->integer('total_price');
        $table->enum('payment_status', ['pending', 'paid', 'cancelled'])->default('pending');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
