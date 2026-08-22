<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TripRoute;

class TripRouteController extends Controller
{
    // Menampilkan halaman manajemen rute
    public function index()
    {
        $routes = TripRoute::orderBy('created_at', 'desc')->get();
        return view('admin.route', compact('routes'));
    }

    // Menyimpan rute baru (Mendukung Multi-Kota / Multi-Stop)
    public function store(Request $request)
    {
        $request->validate([
            'origin' => 'required|string|max:255',
            'destinations' => 'required|array|min:1', 
            'destinations.*' => 'required|string|max:255', 
        ]);

        $destinationJson = json_encode($request->destinations);

        TripRoute::create([
            'origin' => $request->origin,
            'destination' => $destinationJson, 
            'route_cost' => 0, // Kita set 0 karena tidak digunakan lagi
            'fuel_cost' => 0,  // Kita set 0 karena tidak digunakan lagi
        ]);

        return back()->with('success', 'Rute multi-kota baru berhasil ditambahkan!');
    }

    // Memperbarui harga ongkos & bensin (Update Cepat)
    public function update(Request $request, $id)
    {
        $route = TripRoute::findOrFail($id);
        $route->update([
            'route_cost' => $request->route_cost,
            'fuel_cost' => $request->fuel_cost,
        ]);
        
        return back()->with('success', 'Harga ongkos dan bensin berhasil diperbarui!');
    }

    // Menghapus rute
    public function destroy($id)
    {
        TripRoute::findOrFail($id)->delete();
        return back()->with('success', 'Rute berhasil dihapus.');
    }
}