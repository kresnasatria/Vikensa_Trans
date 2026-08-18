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
        // 1. FITUR BARU: PENYAPU OTOMATIS (AUTO-CANCEL 5 MENIT)
        $expiredBookings = \App\Models\Booking::where('payment_status', 'pending')
                            ->where('created_at', '<', now()->subMinutes(5))
                            ->get();

        foreach ($expiredBookings as $booking) {
            $booking->update([
                'payment_status' => 'cancelled'
            ]);

            $schedule = \App\Models\Schedule::find($booking->schedule_id);
            if ($schedule) {
                $schedule->update([
                    'is_available' => true
                ]);
            }
        }

        // 2. Ambil data riwayat pesanan user untuk ditampilkan
        $bookings = \App\Models\Booking::where('user_id', \Illuminate\Support\Facades\Auth::id())
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('riwayat', compact('bookings'));
    }

    // Fungsi untuk menampilkan halaman form pemesanan
    public function create($id)
    {
        $schedule = \App\Models\Schedule::with(['shuttle', 'route.origin', 'route.destination'])->findOrFail($id);

        if (!$schedule->is_available) {
            return redirect()->route('dashboard')->with('error', 'Maaf, armada ini baru saja dipesan oleh orang lain.');
        }

        return view('booking', compact('schedule'));
    }

    // Fungsi untuk memproses data dari form pemesanan
    public function store(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'custom_origin' => 'required|string|max:255',
            'custom_destination' => 'required|string|max:255',
            'custom_departure_time' => 'required|date',
            'custom_arrival_time' => 'required|date|after:custom_departure_time',
        ]);

        $schedule = \App\Models\Schedule::findOrFail($request->schedule_id);

        \App\Models\Booking::create([
            'user_id' => Auth::id(),
            'schedule_id' => $schedule->id,
            'booking_code' => 'TRV-' . time(),
            'custom_origin' => $request->custom_origin,
            'custom_destination' => $request->custom_destination,
            'custom_departure_time' => $request->custom_departure_time,
            'custom_arrival_time' => $request->custom_arrival_time,
            'total_price' => $schedule->price,
            'payment_status' => 'pending'
        ]);

        // Kunci ketersediaan armada
        $schedule->update([
            'is_available' => false
        ]);

        return redirect()->route('riwayat')->with('success', 'Pesanan berhasil dibuat! Silakan lakukan pembayaran.');
    }

    public function pay($id)
    {
        $booking = Booking::with('schedule.shuttle')->findOrFail($id);

        if ($booking->payment_status != 'pending') {
            return redirect()->route('riwayat')->with('error', 'Pesanan ini sudah dibayar atau dibatalkan.');
        }

        // FITUR BARU: Cegah pembayaran jika sudah lewat 5 menit
        if ($booking->created_at->diffInMinutes(now()) >= 5) {
            $booking->update(['payment_status' => 'cancelled']);
            
            $schedule = \App\Models\Schedule::find($booking->schedule_id);
            if ($schedule) {
                $schedule->update(['is_available' => true]);
            }

            return redirect()->route('riwayat')->with('error', 'Waktu pembayaran telah habis (melewati 5 menit). Pesanan dibatalkan otomatis.');
        }

        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        $params = [
            'transaction_details' => [
                'order_id' => $booking->booking_code,
                'gross_amount' => $booking->total_price,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
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

        $snapToken = Snap::getSnapToken($params);

        return view('bayar', compact('booking', 'snapToken'));
    }

    public function paymentSuccess($id)
    {
        $booking = Booking::findOrFail($id);

        $booking->update([
            'payment_status' => 'paid'
        ]);

        return redirect()->route('riwayat')->with('success', 'Pembayaran berhasil dikonfirmasi! Terima kasih.');
    }

    public function cancel($id)
    {
        $booking = \App\Models\Booking::where('id', $id)
                        ->where('user_id', \Illuminate\Support\Facades\Auth::id())
                        ->firstOrFail();

        if ($booking->payment_status == 'pending') {
            
            $booking->update([
                'payment_status' => 'cancelled' 
            ]);

            $schedule = \App\Models\Schedule::find($booking->schedule_id);
            if($schedule) {
                $schedule->update([
                    'is_available' => true
                ]);
            }

            return redirect()->route('riwayat')->with('success', 'Pesanan Anda berhasil dibatalkan dan armada kembali tersedia.');
        } 

        return redirect()->route('riwayat')->with('error', 'Pesanan ini tidak dapat dibatalkan.');
    }
}