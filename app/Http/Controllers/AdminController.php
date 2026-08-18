<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;

class AdminController extends Controller
{
    public function index()
    {
        // Mengambil semua jadwal armada dari database
        $schedules = Schedule::with(['shuttle', 'route.origin', 'route.destination'])->orderBy('departure_time', 'desc')->get();
        
        return view('admin.dashboard', compact('schedules'));
    }

 // Menampilkan halaman form edit (Versi Lengkap)
    public function edit($id)
    {
        $schedule = Schedule::with(['shuttle', 'route.origin', 'route.destination'])->findOrFail($id);
        
        // Mengambil semua rute yang tersedia di database untuk ditampilkan di Dropdown
        $routes = \App\Models\Route::with(['origin', 'destination'])->get();
        
        return view('admin.edit', compact('schedule', 'routes'));
    }

    // Menyimpan SEMUA perubahan ke database
    public function update(Request $request, $id)
    {
        // Validasi semua inputan baru
        $request->validate([
            'shuttle_name' => 'required|string|max:255',
            'seat_capacity' => 'required|integer|min:1',
            'route_id' => 'required|exists:routes,id',
            'departure_time' => 'required|date',
            'price' => 'required|numeric',
            'is_available' => 'required|boolean'
        ]);

        $schedule = Schedule::findOrFail($id);

        // 1. Update data Armada (Shuttle)
        $schedule->shuttle->update([
            'name' => $request->shuttle_name,
            'seat_capacity' => $request->seat_capacity
        ]);

        // 2. Update data Jadwal (Schedule)
        $schedule->update([
            'route_id' => $request->route_id,
            'departure_time' => $request->departure_time,
            'price' => $request->price,
            'is_available' => $request->is_available
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Seluruh data armada dan jadwal berhasil diperbarui!');
    }

    // Menghapus data dari database
    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Jadwal armada berhasil dihapus!');
    }

    // Menampilkan halaman form tambah data
    public function create()
    {
        // Mengambil semua rute untuk pilihan dropdown
        $routes = \App\Models\Route::with(['origin', 'destination'])->get();
        return view('admin.create', compact('routes'));
    }

    // Menyimpan data armada dan jadwal baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'shuttle_name' => 'required|string|max:255',
            'license_plate' => 'required|string|max:20|unique:shuttles,license_plate',
            'seat_capacity' => 'required|integer|min:1',
            // BARU: Ganti route_id dengan rute manual
            'route_origin' => 'required|string|max:255',
            'route_destination' => 'required|string|max:255',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date|after:departure_time',
            'price' => 'required|numeric',
            'is_available' => 'required|boolean'
        ]);

        $shuttle = \App\Models\Shuttle::create([
            'name' => $request->shuttle_name,
            'license_plate' => $request->license_plate, 
            'seat_capacity' => $request->seat_capacity,
        ]);

        \App\Models\Schedule::create([
            'shuttle_id' => $shuttle->id,
            // BARU: Simpan rute manual yang diketik
            'route_origin' => $request->route_origin,
            'route_destination' => $request->route_destination,
            'departure_time' => $request->departure_time,
            'arrival_time' => $request->arrival_time,
            'price' => $request->price,
            'is_available' => $request->is_available
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Armada dan jadwal baru berhasil ditambahkan!');
    }
}