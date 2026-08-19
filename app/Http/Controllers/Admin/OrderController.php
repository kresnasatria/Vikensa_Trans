<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class OrderController extends Controller
{
    // Menampilkan daftar semua pesanan yang masuk
    public function index()
    {
        // Ambil data booking beserta relasi user dan jadwal/armadanya
        $orders = Booking::with(['user', 'schedule.shuttle'])
                         ->orderBy('created_at', 'desc')
                         ->get();

        return view('admin.orders', compact('orders'));
    }

    // Mengubah status pembayaran (misal dari pending menjadi lunas)
    public function updateStatus(Request $request, $id)
    {
        $order = Booking::findOrFail($id);
        $order->update([
            'payment_status' => $request->payment_status
        ]);

        return back()->with('success', 'Status pesanan berhasil diperbarui!');
    }

    // Tambahkan fungsi ini di dalam OrderController.php
    public function markAsRead()
    {
        // Tandai semua pesanan yang belum dibaca menjadi sudah dibaca
        Booking::where('is_read', false)->update(['is_read' => true]);

        return back()->with('success', 'Semua pesanan ditandai sudah dibaca.');
    }
}