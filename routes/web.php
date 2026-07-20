<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Schedule; // Tambahkan ini di bagian paling atas file (di bawah <?php)
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;

// Dan tambahkan rute ini tepat di BAWAH rute /dashboard Anda:
Route::get('/booking/{id}', [App\Http\Controllers\BookingController::class, 'create'])->name('book.create');
Route::post('/book-shuttle', [BookingController::class, 'store'])->name('book.store')->middleware('auth');
// Rute untuk membatalkan pesanan
Route::put('/booking/{id}/cancel', [\App\Http\Controllers\BookingController::class, 'cancel'])->name('book.cancel');

// Tambahkan di bawah Route::post('/book-shuttle', ...)
Route::get('/riwayat-pesanan', [BookingController::class, 'index'])->name('riwayat')->middleware('auth');

Route::get('/bayar/{id}', [BookingController::class, 'pay'])->name('bayar');

// Rute untuk mengubah status database setelah pembayaran berhasil
Route::get('/payment-success/{id}', [BookingController::class, 'paymentSuccess'])->name('payment.success');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    // Menghapus where('is_available') agar SEMUA armada dipanggil ke layar
    $schedules = Schedule::with(['route.origin', 'route.destination', 'shuttle'])->get();

    return view('dashboard', compact('schedules'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// --- AREA KHUSUS ADMIN ---
Route::middleware(['auth', \App\Http\Middleware\IsAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Rute Edit & Update
    Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [AdminController::class, 'update'])->name('update');
    
    // Rute Hapus
    Route::delete('/hapus/{id}', [AdminController::class, 'destroy'])->name('destroy');

    // Rute Tambah Data
    Route::get('/tambah', [AdminController::class, 'create'])->name('create');
    Route::post('/simpan', [AdminController::class, 'store'])->name('store');

});




    
    

