<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Pesanan Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if($bookings->isEmpty())
                        <p class="text-gray-500 text-center py-4">Anda belum memiliki riwayat pesanan.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b bg-gray-50">
                                        <th class="p-4 text-sm font-semibold text-gray-600">Kode Booking</th>
                                        
                                        {{-- KOLOM WAKTU PEMESANAN BARU --}}
                                        <th class="p-4 text-sm font-semibold text-gray-600">Waktu Pemesanan</th>
                                        
                                        <th class="p-4 text-sm font-semibold text-gray-600">Armada & Rute</th>
                                        <th class="p-4 text-sm font-semibold text-gray-600">Total Harga</th>
                                        <th class="p-4 text-sm font-semibold text-gray-600 text-center">Status</th>
                                        <th class="p-4 text-sm font-semibold text-gray-600 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bookings as $booking)
                                        <tr class="border-b hover:bg-gray-50 transition">
                                            <td class="p-4 font-bold text-gray-800">{{ $booking->booking_code }}</td>
                                            
                                            {{-- DATA WAKTU PEMESANAN BARU --}}
                                            <td class="p-4">
                                                <p class="text-sm font-bold text-gray-700">
                                                    {{ $booking->created_at->timezone('Asia/Jakarta')->format('d M Y') }}
                                                </p>
                                                <p class="text-xs text-gray-500 mt-0.5">
                                                    {{ $booking->created_at->timezone('Asia/Jakarta')->format('H:i') }} WIB
                                                </p>
                                            </td>

                                            <td class="p-4">
                                                <p class="font-semibold">{{ $booking->schedule->shuttle->name }}</p>
                                                <p class="text-sm text-gray-500 font-medium">
                                                    {{ $booking->custom_origin ?? 'Asal' }} ➔ {{ $booking->custom_destination ?? 'Tujuan' }}
                                                </p>
                                            </td>
                                            <td class="p-4 font-bold text-blue-600">
                                                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                            </td>
                                            <td class="p-4 text-center">
                                                @if($booking->payment_status == 'pending')
                                                    <span class="bg-yellow-100 text-yellow-800 py-1 px-3 rounded-full text-xs font-bold">Menunggu Pembayaran</span>
                                                    
                                                    <!-- KETERANGAN WAKTU MUNDUR -->
                                                    <div class="mt-3 flex items-center justify-center gap-1 text-xs font-bold text-red-600 countdown-container" data-expire="{{ $booking->created_at->addMinutes(5)->timestamp * 1000 }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        <span class="time-display">Menghitung...</span>
                                                    </div>

                                            @elseif($booking->payment_status == 'paid')
                                                    <!-- TOMBOL CETAK KWITANSI -->
                                                    <a href="{{ route('booking.receipt', $booking->id) }}" target="_blank" class="inline-flex items-center gap-1.5 bg-indigo-50 text-indigo-600 hover:bg-indigo-600 hover:text-white px-3 py-2 rounded-lg text-xs font-bold transition">
                                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                                        </svg>
                                                        Kwitansi
                                                    </a>
                                                @elseif($booking->payment_status == 'cancelled')
                                                    <span class="text-gray-400 text-sm font-semibold">-</span>
                                                @else
                                                    <span class="text-gray-400 text-sm">-</span>
                                                @endif
                                            </td>
                                            <td class="p-4 text-center">
                                                @if($booking->payment_status == 'pending')
                                                    <div class="flex flex-col space-y-2 items-center justify-center">
                                                        <!-- Tombol Bayar -->
                                                        <a href="{{ route('bayar', $booking->id) }}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition ease-in-out duration-150 w-full md:w-auto">
                                                            Bayar Sekarang
                                                        </a>
                                                        
                                                        <!-- Tombol Batal -->
                                                        <form action="{{ route('book.cancel', $booking->id) }}" method="POST" class="w-full md:w-auto" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini? Data yang dibatalkan tidak dapat dikembalikan.');">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-red-100 border border-transparent rounded-md font-semibold text-xs text-red-700 uppercase tracking-widest hover:bg-red-200 transition ease-in-out duration-150 w-full">
                                                                Batalkan Pesanan
                                                            </button>
                                                        </form>
                                                    </div>
                                                @elseif($booking->payment_status == 'cancelled')
                                                    <span class="text-gray-400 text-sm font-semibold">-</span>
                                                @else
                                                    <span class="text-gray-400 text-sm">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPT HITUNG MUNDUR -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil semua elemen yang memiliki kelas 'countdown-container'
            const timers = document.querySelectorAll('.countdown-container');
            let isRefreshing = false;

            function updateTimers() {
                const now = new Date().getTime();

                timers.forEach(timer => {
                    const expireTime = parseInt(timer.getAttribute('data-expire'));
                    const distance = expireTime - now;
                    const displayElement = timer.querySelector('.time-display');

                    if (distance <= 0) {
                        displayElement.innerHTML = "Waktu Habis!";
                        // Cegah refresh berulang kali
                        if (!isRefreshing) {
                            isRefreshing = true;
                            // Refresh halaman agar backend mendeteksi dan membatalkan pesanan
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000); 
                        }
                    } else {
                        // Kalkulasi menit dan detik
                        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                        
                        // Format ke 00:00
                        const mDisplay = minutes < 10 ? "0" + minutes : minutes;
                        const sDisplay = seconds < 10 ? "0" + seconds : seconds;

                        displayElement.innerHTML = mDisplay + ":" + sDisplay;
                    }
                });
            }

            // Jalankan fungsi jika ada pesanan pending
            if (timers.length > 0) {
                updateTimers(); // Jalankan sekali langsung saat load
                setInterval(updateTimers, 1000); // Update setiap 1 detik
            }
        });
    </script>
</x-app-layout>