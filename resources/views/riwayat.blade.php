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
                                        <th class="p-4 text-sm font-semibold text-gray-600">Armada & Rute</th>
                                        <th class="p-4 text-sm font-semibold text-gray-600">Total Harga</th>
                                        <th class="p-4 text-sm font-semibold text-gray-600">Status</th>
                                        <th class="p-4 text-sm font-semibold text-gray-600 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bookings as $booking)
                                        <tr class="border-b hover:bg-gray-50 transition">
                                            <td class="p-4 font-bold text-gray-800">{{ $booking->booking_code }}</td>
                                            <td class="p-4">
                                                <p class="font-semibold">{{ $booking->schedule->shuttle->name }}</p>
                                                <p class="text-sm text-gray-500">
                                                    {{ $booking->schedule->route->origin->city }} ➔ {{ $booking->schedule->route->destination->city }}
                                                </p>
                                            </td>
                                            <td class="p-4 font-bold text-blue-600">
                                                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                            </td>
                                            <td class="p-4 text-center">
                                                @if($booking->payment_status == 'pending')
                                                    <span class="bg-yellow-100 text-yellow-800 py-1 px-3 rounded-full text-xs font-bold">Menunggu Pembayaran</span>
                                                @elseif($booking->payment_status == 'paid')
                                                    <span class="bg-green-100 text-green-800 py-1 px-3 rounded-full text-xs font-bold">Lunas</span>
                                                @elseif($booking->payment_status == 'cancelled')
                                                    <span class="bg-red-100 text-red-800 py-1 px-3 rounded-full text-xs font-bold">Dibatalkan</span>
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
</x-app-layout>