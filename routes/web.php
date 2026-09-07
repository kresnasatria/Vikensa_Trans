<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Schedule;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\TripRouteController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ServiceLogController; 
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Admin\ContactController;


// --- AREA USER & UMUM ---
Route::get('/booking/{id}', [BookingController::class, 'create'])->name('book.create');
Route::post('/book-shuttle', [BookingController::class, 'store'])->name('book.store')->middleware('auth');
Route::put('/booking/{id}/cancel', [BookingController::class, 'cancel'])->name('book.cancel');

Route::get('/riwayat-pesanan', [BookingController::class, 'index'])->name('riwayat')->middleware('auth');
Route::get('/bayar/{id}', [BookingController::class, 'pay'])->name('bayar');
Route::get('/payment-success/{id}', [BookingController::class, 'paymentSuccess'])->name('payment.success');

Route::get('/', function () {
    // Ambil semua data jadwal beserta relasi armadanya
    $schedules = \App\Models\Schedule::with('shuttle')->get();
    
    // Ambil data kontak admin untuk footer
    $adminContact = \App\Models\AdminContact::first();

    return view('welcome', compact('schedules', 'adminContact'));
});

Route::get('/dashboard', function () {
    $schedules = Schedule::with(['route.origin', 'route.destination', 'shuttle'])->get();
    return view('dashboard', compact('schedules'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/booking/receipt/{id}', [App\Http\Controllers\BookingController::class, 'downloadReceipt'])->name('booking.receipt')->middleware('auth');
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

   // Rute Manajemen Rute & Harga
    Route::get('/rute', [TripRouteController::class, 'index'])->name('route.index');
    Route::post('/rute/simpan', [TripRouteController::class, 'store'])->name('route.store');
    
    // Rute untuk memunculkan halaman Edit Rute
    Route::get('/rute/edit/{id}', [TripRouteController::class, 'edit'])->name('route.edit');
    
    Route::put('/rute/update/{id}', [TripRouteController::class, 'update'])->name('route.update');
    Route::delete('/rute/hapus/{id}', [TripRouteController::class, 'destroy'])->name('route.destroy');

    // Rute untuk notifikasi pesanan baru (AJAX)
    Route::get('/cek-pesanan-baru', [AdminController::class, 'checkNewOrders'])->name('checkOrders');

    // Rute Halaman Manajemen Order
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::put('/orders/status/{id}', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

    // Rute untuk menandai pesanan sudah dibaca
    Route::post('/orders/mark-read', [OrderController::class, 'markAsRead'])->name('orders.markRead');

    // --- Rute untuk Catatan Servis Kendaraan ---
    Route::resource('services', ServiceLogController::class);

    // --- Rute untuk menghapus foto armada 
    Route::delete('/photos/{id}', [AdminController::class, 'destroyPhoto'])->name('photos.destroy');

    // --- Rute Pengaturan Kontak Bantuan Admin ---
    Route::get('/contacts', [ContactController::class, 'edit'])->name('contacts.edit');
    Route::put('/contacts', [ContactController::class, 'update'])->name('contacts.update');
    
});

// --- Rute untuk Google OAuth ---
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);