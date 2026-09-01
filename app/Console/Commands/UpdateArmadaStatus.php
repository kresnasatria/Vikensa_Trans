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
        // 1. Cari semua jadwal/armada yang saat ini KUNCINYA TERTUTUP (Disewa)
        $unavailableSchedules = \App\Models\Schedule::where('is_available', false)->get();
        $count = 0;

        foreach ($unavailableSchedules as $schedule) {
            
            // 2. Cek apakah armada ini punya pesanan LUNAS/PAID yang waktu selesainya MASIH DI MASA DEPAN
            $stillActive = \App\Models\Booking::where('schedule_id', $schedule->id)
                ->whereIn('payment_status', ['paid', 'lunas']) // Cek status yang sudah bayar
                ->where('custom_arrival_time', '>', \Carbon\Carbon::now()) // Waktunya belum habis
                ->exists();

            // 3. Jika TIDAK ADA pesanan aktif di masa depan, berarti dia sudah benar-benar bebas
            if (!$stillActive) {
                $schedule->update([
                    'is_available' => true
                ]);
                $count++;
            }
        }

        // Tampilkan pesan di terminal
        $this->info("Berhasil mengubah status {$count} armada menjadi Tersedia.");
    }
}