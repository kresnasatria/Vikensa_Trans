<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceLog;
use App\Models\Shuttle;
use Illuminate\Http\Request;

class ServiceLogController extends Controller
{
    // 1. Menampilkan daftar riwayat servis
    public function index()
    {
        $services = ServiceLog::with('shuttle')->latest()->get();
        return view('admin.services.index', compact('services'));
    }

    // 2. Menampilkan form tambah catatan servis
    public function create()
    {
        // Cari ID armada yang saat ini sedang aktif di tabel schedules
        $activeShuttleIds = \App\Models\Schedule::pluck('shuttle_id')->unique();
        
        // Ambil data armada yang ID-nya ada di daftar aktif tersebut saja
        $shuttles = \App\Models\Shuttle::whereIn('id', $activeShuttleIds)->get(); 

        return view('admin.services.create', compact('shuttles'));
    }

    // 3. Menyimpan data servis ke database
   public function store(Request $request)
    {
        $request->validate([
            'shuttle_id' => 'required|exists:shuttles,id',
            'kendala' => 'required|string',
            'kerusakan' => 'required|string',
            'suku_cadang' => 'required|string',
            'estimasi_waktu' => 'required|string',
            'estimasi_harga' => 'required|string', // <--- TAMBAHKAN BARIS INI
        ]);

        ServiceLog::create($request->all());

        return redirect()->route('admin.services.index')->with('success', 'Catatan servis berhasil ditambahkan!');
    }

    // 4. Menghapus catatan servis
    public function destroy($id)
    {
        ServiceLog::findOrFail($id)->delete();
        return redirect()->route('admin.services.index')->with('success', 'Catatan servis berhasil dihapus.');
    }

    // Menampilkan form edit catatan servis
    public function edit($id)
    {
        $service = ServiceLog::findOrFail($id);
        
        // Ambil data armada yang aktif (sama seperti saat create)
        $activeShuttleIds = \App\Models\Schedule::select('shuttle_id')->get()->pluck('shuttle_id')->unique()->toArray();
        $shuttles = \App\Models\Shuttle::whereIn('id', $activeShuttleIds)->get(); 

        return view('admin.services.edit', compact('service', 'shuttles'));
    }

    // Menyimpan perubahan data servis ke database
    public function update(Request $request, $id)
    {
        $request->validate([
            'shuttle_id' => 'required|exists:shuttles,id',
            'kendala' => 'required|string',
            'kerusakan' => 'required|string',
            'suku_cadang' => 'required|string',
            'estimasi_waktu' => 'required|string',
            'estimasi_harga' => 'required|string',
        ]);

        $service = ServiceLog::findOrFail($id);
        $service->update($request->all());

        return redirect()->route('admin.services.index')->with('success', 'Catatan servis berhasil diperbarui!');
    }
}