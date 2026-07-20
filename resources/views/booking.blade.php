<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Form Pemesanan Charter') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-t-4 border-blue-500">
                <div class="p-8 text-gray-900">
                    
                    <div class="mb-8 border-b pb-4">
                        <h3 class="text-xl font-bold">Armada Pilihan: {{ $schedule->shuttle->name }}</h3>
                        <p class="text-sm text-gray-500">Kapasitas: {{ $schedule->shuttle->seat_capacity }} Penumpang | Harga Dasar: Rp {{ number_format($schedule->price, 0, ',', '.') }}</p>
                    </div>

                    <form action="{{ route('book.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Input Kota Asal -->
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="custom_origin">
                                    Kota Jemput (Asal)
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                    id="custom_origin" type="text" name="custom_origin" placeholder="Cth: Bandung" required>
                            </div>

                            <!-- Input Kota Tujuan -->
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="custom_destination">
                                    Kota Tujuan
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                    id="custom_destination" type="text" name="custom_destination" placeholder="Cth: Jakarta Selatan" required>
                            </div>
                        </div>

                        <!-- Grid Waktu Berangkat & Waktu Selesai -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <!-- Rencana Waktu Keberangkatan -->
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="custom_departure_time">
                                    Rencana Waktu Keberangkatan
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                    id="custom_departure_time" type="datetime-local" name="custom_departure_time" required>
                            </div>

                            <!-- Rencana Waktu Selesai (BARU) -->
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="custom_arrival_time">
                                    Rencana Waktu Selesai (Kembali)
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                    id="custom_arrival_time" type="datetime-local" name="custom_arrival_time" required>
                            </div>
                        </div>

                        <div class="flex justify-end pt-4 border-t">
                            <button type="submit" class="bg-blue-600 text-white font-bold py-3 px-8 rounded shadow hover:bg-blue-700 transition">
                                Konfirmasi & Pesan Sekarang
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>