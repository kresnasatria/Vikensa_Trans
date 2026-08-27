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
        // Cari data berdasarkan ID jadwal (schedule) dan muat relasi shuttle beserta fotonya
        $schedule = \App\Models\Schedule::with('shuttle.photos')->findOrFail($id);
        $shuttle = $schedule->shuttle; // Menyediakan variabel $shuttle untuk form foto

        return view('admin.edit', compact('schedule', 'shuttle'));
    }

    // Menyimpan SEMUA perubahan ke database
    public function update(Request $request, $id)
    {
        // 1. Ambil data Schedule berdasarkan ID dari URL, lalu ambil relasi Shuttle-nya
        $schedule = \App\Models\Schedule::findOrFail($id);
        $shuttle = $schedule->shuttle;

        // 2. Validasi dengan menggunakan ID Shuttle yang valid ($shuttle->id)
        $request->validate([
            'shuttle_name' => 'required|string|max:255',
            'license_plate' => 'required|string|max:20|unique:shuttles,license_plate,' . $shuttle->id,
            'seat_capacity' => 'required|integer|min:1',
            'price' => 'required|numeric',
            'is_available' => 'required|boolean',
            'photos' => 'nullable|array|max:8',
            'photos.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);
        
        // 3. Update data teks shuttle yang benar
        $shuttle->update([
            'name' => $request->shuttle_name,
            'license_plate' => strtoupper($request->license_plate),
            'seat_capacity' => $request->seat_capacity,
        ]);

        // 4. Jika ada foto baru yang di-upload, tambahkan ke database
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('shuttles', 'public');
                \App\Models\ShuttlePhoto::create([
                    'shuttle_id' => $shuttle->id,
                    'photo_path' => $path
                ]);
            }
        }

        // 5. Update tabel schedule (harga & status)
        $schedule->update([
            'price' => $request->price,
            'is_available' => $request->is_available
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Data armada dan foto berhasil diperbarui!');
    }

    // Menghapus data dari database secara menyeluruh
    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        
        // Simpan ID Shuttle (Armada) sebelum jadwalnya dihapus
        $shuttleId = $schedule->shuttle_id;

        // 1. Hapus jadwal & harga
        $schedule->delete();

        // 2. Hapus fisik mobilnya dari tabel shuttles agar plat nomor ikut terhapus
        if ($shuttleId) {
            \App\Models\Shuttle::where('id', $shuttleId)->delete();
        }

        return redirect()->route('admin.dashboard')->with('success', 'Seluruh data Armada beserta harganya berhasil dihapus!');
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
            // 1. Validasi data armada, harga, status, dan FOTO
            $request->validate([
                'shuttle_name' => 'required|string|max:255',
                'license_plate' => 'required|string|max:20|unique:shuttles,license_plate',
                'seat_capacity' => 'required|integer|min:1',
                'price' => 'required|numeric',
                'is_available' => 'required|boolean',
                
                // Validasi untuk file foto: maksimal 8 file, harus gambar, maksimal 2MB per foto
                'photos' => 'nullable|array|max:8',
                'photos.*' => 'image|mimes:jpeg,png,jpg|max:2048'
            ]);

            // 2. Simpan Data Armada
            $shuttle = \App\Models\Shuttle::create([
                'name' => $request->shuttle_name,
                'license_plate' => strtoupper($request->license_plate), 
                'seat_capacity' => $request->seat_capacity,
            ]);

            // 2.5. Proses Upload dan Simpan Foto (JIKA ADA)
            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $photo) {
                    // Simpan fisik file ke folder storage/app/public/shuttles
                    $path = $photo->store('shuttles', 'public');
                    
                    // Simpan nama/jalur file ke tabel database shuttle_photos
                    \App\Models\ShuttlePhoto::create([
                        'shuttle_id' => $shuttle->id,
                        'photo_path' => $path
                    ]);
                }
            }

            // 3. Simpan Harga Dasar & Status ke tabel Schedule dengan nilai default waktu
            \App\Models\Schedule::create([
                'shuttle_id' => $shuttle->id,
                'price' => $request->price,
                'is_available' => $request->is_available,
                'departure_time' => now(), // Memberikan nilai tanggal & jam saat ini
                'arrival_time' => now()    // Memberikan nilai tanggal & jam saat ini
            ]);

            return redirect()->route('admin.dashboard')->with('success', 'Armada baru beserta fotonya berhasil ditambahkan!');
        }

    // Mengecek pesanan baru untuk notifikasi AJAX
   public function checkNewOrders()
    {
        $latestOrder = \App\Models\Booking::orderBy('id', 'desc')->first();
        
        // Hitung jumlah order yang belum dibaca (untuk badge sidebar secara real-time)
        $unreadCount = \App\Models\Booking::where('is_read', false)->count();

        return response()->json([
            'latest_id' => $latestOrder ? $latestOrder->id : 0,
            'unread_count' => $unreadCount
        ]);
    }

    // Endpoint untuk Hapus Foto Satuan Halaman Edit
    public function destroyPhoto($photoId)
    {
        $photo = \App\Models\ShuttlePhoto::findOrFail($photoId);
        
        // Hapus file fisik dari storage
        if (\Storage::disk('public')->exists($photo->photo_path)) {
            \Storage::disk('public')->delete($photo->photo_path);
        }
        
        // Hapus dari database
        $photo->delete();

        return back()->with('success', 'Foto berhasil dihapus.');
    }
}