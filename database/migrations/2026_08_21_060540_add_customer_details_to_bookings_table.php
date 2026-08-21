<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('booker_name')->nullable()->after('booking_code');
            $table->string('phone_number')->nullable()->after('booker_name');
            $table->text('pickup_address')->nullable()->after('phone_number');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['booker_name', 'phone_number', 'pickup_address']);
        });
    }
};