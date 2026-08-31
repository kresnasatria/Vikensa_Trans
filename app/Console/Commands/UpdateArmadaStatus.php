<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;

class UpdateArmadaStatus extends Command
{
    
    protected $signature = 'armada:update-status';
    protected $description = 'Mengubah status armada menjadi tersedia jika waktu sewa sudah habis';

    public function handle()
    {
        
        $finishedBookings = Booking::where('custom_arrival_time', '<', \Carbon\Carbon::now())
            ->whereHas('schedule', function($query) {
                $query->where('is_available', false);
            })->get();

        $count = 0;
        foreach ($finishedBookings as $booking) {
            $booking->schedule->update([
                'is_available' => true
            ]);
            $count++;
        }

        // Tampilkan pesan di terminal
        $this->info("Berhasil mengubah status {$count} armada menjadi Tersedia.");
    }
}