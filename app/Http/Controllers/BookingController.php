<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
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
        $schedule = \App\Models\Schedule::with(['shuttle'])->findOrFail($id);

        if (!$schedule->is_available) {
            return redirect()->route('dashboard')->with('error', 'Maaf, armada ini baru saja dipesan oleh orang lain.');
        }

        // AMBIL DATA RUTE DARI DATABASE UNTUK DROPDOWN
        $routes = \App\Models\TripRoute::orderBy('origin', 'asc')->get();

        return view('booking', compact('schedule', 'routes'));
    }


    // Fungsi untuk memproses data dari form pemesanan
   // Fungsi untuk memproses data dari form pemesanan
    public function store(Request $request)
        {
            // 1. Validasi Input
            $request->validate([
                'schedule_id' => 'required|exists:schedules,id',
                'custom_origin' => 'required|string|max:255',
                'custom_destination' => 'required|string|max:255',
                'custom_departure_time' => 'required|date',
                'custom_arrival_time' => 'required|date|after_or_equal:custom_departure_time',
                'booker_name' => 'required|string|max:255',
                'phone_number' => 'required|string|max:20',
                'pickup_address' => 'required|string',
            ]);

            $schedule = \App\Models\Schedule::findOrFail($request->schedule_id);

            // ====================================================================
            // FITUR KEAMANAN: Kalkulasi Ulang Harga di Backend (Berdasarkan HARI)
            // Mencegah user memanipulasi total harga menggunakan Inspect Element
            // ====================================================================
            
            $departure = \Carbon\Carbon::parse($request->custom_departure_time);
            $arrival = \Carbon\Carbon::parse($request->custom_arrival_time);
            
            // 1. Dapatkan selisih waktu dalam bentuk desimal (contoh: 3.00069)
            $selisihDesimal = $departure->floatDiffInDays($arrival);

            // 2. Bulatkan ke atas (ceil) agar kelebihan menit dihitung sebagai hari baru
            $days = ceil($selisihDesimal);

            // 3. Pastikan minimal durasi adalah 1 hari
            if ($days < 1) {
                $days = 1;
            }

            // 4. Harga Akhir = Harga sewa armada per hari dikali jumlah hari
            $finalPrice = $schedule->price * $days;

            // ====================================================================

            // Simpan data pesanan ke database
            \App\Models\Booking::create([
                'user_id' => \Illuminate\Support\Facades\Auth::id(),
                'schedule_id' => $schedule->id,
                'booking_code' => 'TRV-' . time(),
                
                // Data Pemesan 
                'booker_name' => $request->booker_name,
                'phone_number' => $request->phone_number,
                'pickup_address' => $request->pickup_address,
                
                // Data Rute & Waktu
                'custom_origin' => $request->custom_origin,
                'custom_destination' => $request->custom_destination,
                'custom_departure_time' => $request->custom_departure_time,
                'custom_arrival_time' => $request->custom_arrival_time,
                
                // Harga Final yang diamankan
                'total_price' => $finalPrice, 
                
                'payment_status' => 'pending'
            ]);

            // Kunci unit armada agar langsung berubah menjadi "Disewa/Tidak Tersedia"
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

    // Di dalam BookingController.php (fungsi paymentSuccess / callback pembayaran)
        public function paymentSuccess($id)
    {
        $booking = \App\Models\Booking::findOrFail($id);
        
        // 1. Ubah status pesanan menjadi paid (lunas)
        $booking->update([
            'payment_status' => 'paid' 
        ]);

        // ====================================================================
        // 2. KODE BARU: Langsung ubah armada menjadi "Disewa" (Tidak Tersedia)
        // ====================================================================
        $schedule = \App\Models\Schedule::find($booking->schedule_id);
        if ($schedule) {
            $schedule->update([
                'is_available' => false
            ]);
        }
        // ====================================================================

        return redirect()->route('riwayat')->with('success', 'Pembayaran berhasil! Status pesanan Anda sudah Paid.');
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

        public function downloadReceipt($id)
    {
        $booking = \App\Models\Booking::with(['schedule.shuttle', 'user'])->findOrFail($id);

        if ($booking->payment_status !== 'paid') {
            return back()->with('error', 'Kwitansi belum bisa dicetak karena pembayaran belum lunas.');
        }

        $pdf = Pdf::loadView('pdf.receipt', compact('booking'));
        $pdf->setPaper('A5', 'landscape');

        return $pdf->download('Kwitansi_VikensaTrans_' . $booking->booking_code . '.pdf');
    }
}