<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;
use App\Models\Shuttle;
use App\Models\Route;
use App\Models\Schedule;
use Carbon\Carbon;

class TravelSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Membuat Titik Lokasi
        $bandung = Location::create(['city' => 'Bandung', 'point_name' => 'Pool Pasteur']);
        $jakarta = Location::create(['city' => 'Jakarta', 'point_name' => 'Pool Pancoran']);

        // 2. Membuat Daftar Armada Unit (Charter)
        $shuttle1 = Shuttle::create([
            'name' => 'TechTok Express (Toyota Hiace)', 
            'license_plate' => 'D 1010 TK', 
            'seat_capacity' => 14
        ]);
        
        $shuttle2 = Shuttle::create([
            'name' => 'Laughing Circuits Cruiser (Isuzu Elf)', 
            'license_plate' => 'B 404 LC', 
            'seat_capacity' => 19
        ]);

        $shuttle3 = Shuttle::create([
            'name' => 'Neon Cyber-Van (Mercedes Sprinter)', 
            'license_plate' => 'B 2077 CP', 
            'seat_capacity' => 12
        ]);

        // 3. Membuat Rute Perjalanan
        $route1 = Route::create([
            'origin_id' => $bandung->id, 
            'destination_id' => $jakarta->id, 
            'distance_km' => 150
        ]);

        // 4. Membuat Jadwal & Harga Sewa 1 Unit (untuk besok)
        Schedule::create([
            'route_id' => $route1->id,
            'shuttle_id' => $shuttle1->id,
            'departure_time' => Carbon::tomorrow()->setHour(8)->setMinute(0),
            'arrival_time' => Carbon::tomorrow()->setHour(11)->setMinute(30),
            'price' => 1500000, 
            'is_available' => true,
        ]);

        Schedule::create([
            'route_id' => $route1->id,
            'shuttle_id' => $shuttle2->id,
            'departure_time' => Carbon::tomorrow()->setHour(10)->setMinute(0),
            'arrival_time' => Carbon::tomorrow()->setHour(13)->setMinute(30),
            'price' => 1200000, 
            'is_available' => true,
        ]);
        
        Schedule::create([
            'route_id' => $route1->id,
            'shuttle_id' => $shuttle3->id,
            'departure_time' => Carbon::tomorrow()->setHour(19)->setMinute(0), // Perjalanan Malam
            'arrival_time' => Carbon::tomorrow()->setHour(22)->setMinute(0),
            'price' => 2000000, 
            'is_available' => true,
        ]);
    }
}