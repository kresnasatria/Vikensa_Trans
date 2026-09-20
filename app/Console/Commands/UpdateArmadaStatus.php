<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateArmadaStatus extends Command
{
    protected $signature = 'armada:update-status';
    protected $description = 'Update status armada yang sudah habis waktu sewanya';

    public function handle()
    {
        $now = \Carbon\Carbon::now('Asia/Jakarta'); 
        $count = 0;

        $this->info("=== MEMULAI PENGECEKAN PADA " . $now->format('H:i:s') . " WIB ===");

        // Cari armada yang statusnya 'Tidak Tersedia' / 'Disewa'
        $busySchedules = \App\Models\Schedule::with('shuttle')->where('is_available', false)->get();

        if($busySchedules->isEmpty()) {
            $this->info("Semua armada sudah berstatus Tersedia.");
            return;
        }

        foreach ($busySchedules as $schedule) {
            $shuttleName = $schedule->shuttle->name ?? 'Armada ID ' . $schedule->id;
            $this->info("Mengecek: " . $shuttleName);
            
            $activeBookings = \App\Models\Booking::where('schedule_id', $schedule->id)
                ->where('payment_status', '!=', 'cancelled')
                ->get();

            $isStillRented = false;
            $reason = "";

            foreach ($activeBookings as $booking) {
                if ($booking->custom_arrival_time) {
                    $endTime = \Carbon\Carbon::parse($booking->custom_arrival_time, 'Asia/Jakarta');
                    if ($endTime > $now) {
                        $isStillRented = true; 
                        $reason = "Booking {$booking->booking_code} (Selesai: {$endTime->format('d M Y H:i')} WIB)";
                        break; 
                    }
                } 
                else if ($schedule->arrival_time) {
                    $endTime = \Carbon\Carbon::parse($schedule->arrival_time, 'Asia/Jakarta');
                    if ($endTime > $now) {
                        $isStillRented = true;
                        $reason = "Jadwal Reguler (Selesai: {$endTime->format('d M Y H:i')} WIB)";
                        break;
                    }
                }
            }

            if ($isStillRented) {
                $this->warn(" -> [DITAHAN] Masih sah disewa oleh: " . $reason);
                continue; 
            }

            // Jika semua waktu pesanan sudah kedaluwarsa
            $schedule->update(['is_available' => true]);
            $this->info(" -> [DIBEBASKAN] Waktu sewa sudah habis, status menjadi Tersedia!");
            $count++;
        }

        $this->info("=== SELESAI: {$count} armada diubah menjadi Tersedia ===");
    }
}