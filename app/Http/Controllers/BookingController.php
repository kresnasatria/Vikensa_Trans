<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class BookingController extends Controller
{
    public function index()
    {
        // Mengambil pesanan khusus milik pengguna yang sedang login, diurutkan dari yang terbaru
        $bookings = Booking::with(['schedule.route.origin', 'schedule.route.destination', 'schedule.shuttle'])
                    ->where('user_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('riwayat', compact('bookings'));
    }

   // 1. Tambahkan fungsi create ini untuk memunculkan form
    public function create($id)
    {
        $schedule = \App\Models\Schedule::with('shuttle')->findOrFail($id);
        return view('booking', compact('schedule'));
    }

    // 2. Perbarui fungsi store yang sudah ada menjadi seperti ini:
    public function store(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'custom_origin' => 'required|string|max:255',
            'custom_destination' => 'required|string|max:255',
            'custom_departure_time' => 'required|date',
        ]);

        $schedule = \App\Models\Schedule::findOrFail($request->schedule_id);

        Booking::create([
            'user_id' => Auth::id(),
            'schedule_id' => $schedule->id,
            'booking_code' => 'TRV-' . time(),
            'custom_origin' => $request->custom_origin,
            'custom_destination' => $request->custom_destination,
            'custom_departure_time' => $request->custom_departure_time,
            'total_price' => $schedule->price,
            'payment_status' => 'pending'
        ]);

        return redirect()->route('riwayat')->with('success', 'Pesanan berhasil dibuat! Silakan lakukan pembayaran.');
    }

    public function pay($id)
    {
        // 1. Cari data pesanan
        $booking = Booking::with('schedule.shuttle')->findOrFail($id);

        // 2. Pastikan pesanan masih pending
        if ($booking->payment_status != 'pending') {
            return redirect()->route('riwayat')->with('error', 'Pesanan ini sudah dibayar atau dibatalkan.');
        }

        // 3. Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        // 4. Siapkan parameter untuk dikirim ke Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $booking->booking_code,
                'gross_amount' => $booking->total_price,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name, // Mengambil nama user yang login
                'email' => Auth::user()->email,
            ],
            'item_details' => [
                [
                    'id' => $booking->schedule->shuttle->id,
                    'price' => $booking->total_price,
                    'quantity' => 1,
                    'name' => 'Sewa ' . $booking->schedule->shuttle->name,
                ]
            ]
        ];

        // 5. Dapatkan Token Snap dari Midtrans
        $snapToken = Snap::getSnapToken($params);

        // 6. Tampilkan halaman pembayaran
        return view('bayar', compact('booking', 'snapToken'));
    }

    public function paymentSuccess($id)
    {
        // 1. Cari pesanan berdasarkan ID
        $booking = Booking::findOrFail($id);

        // 2. Ubah statusnya menjadi 'paid' (Lunas)
        $booking->update([
            'payment_status' => 'paid'
        ]);

        // 3. Kembalikan ke halaman riwayat dengan pesan sukses
        return redirect()->route('riwayat')->with('success', 'Pembayaran berhasil dikonfirmasi! Terima kasih.');
    }

    // Fungsi untuk membatalkan pesanan
    public function cancel($id)
    {
        // Cari pesanan berdasarkan ID dan pastikan itu milik user yang sedang login
        $booking = \App\Models\Booking::where('id', $id)
                        ->where('user_id', \Illuminate\Support\Facades\Auth::id())
                        ->firstOrFail();

        // Pastikan pesanan masih berstatus pending
        if ($booking->payment_status == 'pending') {
            $booking->update([
                'payment_status' => 'cancelled' // Ubah status menjadi dibatalkan
            ]);

            return redirect()->route('riwayat')->with('success', 'Pesanan Anda berhasil dibatalkan.');
        }

        return redirect()->route('riwayat')->with('error', 'Pesanan ini tidak dapat dibatalkan.');
    }
}