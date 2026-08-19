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
        
        // Pemanggilan $routes dihapus karena form rute sudah dipisah

        return view('admin.edit', compact('schedule'));
    }

    // Menyimpan SEMUA perubahan ke database
    public function update(Request $request, $id)
    {
        // Validasi semua inputan baru (Tanpa validasi rute)
        $request->validate([
            'shuttle_name' => 'required|string|max:255',
            'seat_capacity' => 'required|integer|min:1',
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

        // 2. Update data Jadwal (Schedule) - Tanpa update rute
        $schedule->update([
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

    // Menyimpan data armada baru ke database
    public function store(Request $request)
    {
        // 1. Validasi hanya untuk data armada, harga, dan status
        $request->validate([
            'shuttle_name' => 'required|string|max:255',
            'license_plate' => 'required|string|max:20|unique:shuttles,license_plate',
            'seat_capacity' => 'required|integer|min:1',
            'price' => 'required|numeric',
            'is_available' => 'required|boolean'
        ]);

        // 2. Simpan Data Armada
        $shuttle = \App\Models\Shuttle::create([
            'name' => $request->shuttle_name,
            'license_plate' => $request->license_plate, 
            'seat_capacity' => $request->seat_capacity,
        ]);

        // 3. Simpan Harga Dasar & Status ke tabel Schedule
        \App\Models\Schedule::create([
            'shuttle_id' => $shuttle->id,
            'price' => $request->price,
            'is_available' => $request->is_available,
            // Kita kosongkan (null) kolom jadwal & rute lama karena input dari user
            'route_origin' => null,
            'route_destination' => null,
            'departure_time' => null,
            'arrival_time' => null
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Armada baru berhasil ditambahkan!');
    }
}