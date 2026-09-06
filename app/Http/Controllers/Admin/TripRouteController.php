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

    // fungsi untuk menampilkan halaman form edit
    public function edit($id)
    {
        $rute = \App\Models\TripRoute::findOrFail($id);
        
        $destinations = is_string($rute->destination) ? json_decode($rute->destination, true) : $rute->destination;
        if (!is_array($destinations)) {
            $destinations = [$rute->destination];
        }

        return view('admin.route_edit', compact('rute', 'destinations')); 
    }

    // Memperbarui harga ongkos & bensin (Update Cepat)
   public function update(Request $request, $id)
    {
        $request->validate([
            'origin' => 'required|string|max:255',
            'destinations' => 'required|array',
            'destinations.*' => 'required|string|max:255',
            'biaya' => 'required|numeric|min:0', // Validasi biaya baru
        ]);

        $rute = \App\Models\TripRoute::findOrFail($id);
        
        $rute->update([
            'origin' => $request->origin,
            'destination' => json_encode($request->destinations),
            'biaya' => $request->biaya, // Simpan biaya baru
        ]);

        return redirect()->route('admin.route.index')->with('success', 'Rute perjalanan dan biaya berhasil diperbarui!');
    }

    // Menghapus rute
    public function destroy($id)
    {
        TripRoute::findOrFail($id)->delete();
        return back()->with('success', 'Rute berhasil dihapus.');
    }
}