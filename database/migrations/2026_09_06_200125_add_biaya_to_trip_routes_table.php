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
    Schema::table('trip_routes', function (Blueprint $table) {
        // Tambahkan kolom biaya, set default 0 agar data lama tidak error
        $table->integer('biaya')->default(0)->after('destination'); 
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trip_routes', function (Blueprint $table) {
            //
        });
    }
};
