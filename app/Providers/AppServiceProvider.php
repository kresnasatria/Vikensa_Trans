<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use App\Models\Schedule;
use App\Models\Booking;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // =========================================================
        // ALGORITMA SWEEPER: OTOMATISASI STATUS KETERSEDIAAN ARMADA
        // =========================================================
        try {
            $now = Carbon::now();
            
            // 1. Cari semua armada yang saat ini berstatus "Disewa" / Tidak Tersedia
            $unavailableSchedules = Schedule::where('is_available', false)->get();

            foreach ($unavailableSchedules as $schedule) {
                // 2. Cek apakah armada ini masih punya pesanan aktif 
                // (Waktu selesai/kembalinya MASIH LEBIH BESAR dari waktu saat ini)
                $stillRented = Booking::where   ('schedule_id', $schedule->id)
                    ->where('custom_arrival_time', '>', $now)
                    ->exists();

                // 3. Jika sudah TIDAK ADA pesanan yang aktif, otomatis kembalikan jadi Tersedia
                if (!$stillRented) {
                    $schedule->update(['is_available' => true]);
                }
            }
        } catch (\Exception $e) {
            // Blok catch ini penting agar sistem tidak error saat Anda 
            // pertama kali melakukan migrate database di komputer baru.
        }
    }
}