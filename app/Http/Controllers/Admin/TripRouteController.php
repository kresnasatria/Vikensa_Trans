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

    // Menyimpan rute baru
    public function store(Request $request)
    {
        $request->validate([
            'origin' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'route_cost' => 'required|numeric|min:0',
            'fuel_cost' => 'required|numeric|min:0',
        ]);

        TripRoute::create($request->all());

        return back()->with('success', 'Rute perjalanan baru berhasil ditambahkan!');
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