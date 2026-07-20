<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Armada & Jadwal Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-t-4 border-purple-600">
                <div class="p-8 text-gray-900">
                    
                    <form action="{{ route('admin.store') }}" method="POST">
                        @csrf

                        <h3 class="text-lg font-bold text-gray-700 border-b pb-2 mb-4">Informasi Armada Baru</h3>
                        <!-- Ubah menjadi grid-cols-3 -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                            
                            <!-- Input Nama Armada -->
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="shuttle_name">
                                    Nama Armada
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-500" 
                                    id="shuttle_name" type="text" name="shuttle_name" placeholder="Cth: Cyber-Van Deluxe" required>
                            </div>

                            <!-- Input Plat Nomor (BARU) -->
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="license_plate">
                                    Plat Nomor (Nopol)
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-500" 
                                    id="license_plate" type="text" name="license_plate" placeholder="Cth: D 1234 ABC" required>
                            </div>

                            <!-- Input Kapasitas -->
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="seat_capacity">
                                    Kapasitas
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-500" 
                                    id="seat_capacity" type="number" name="seat_capacity" placeholder="Cth: 15" required>
                            </div>
                        </div>

                        <h3 class="text-lg font-bold text-gray-700 border-b pb-2 mb-4 mt-8">Detail Jadwal Dasar & Harga</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Dropdown Rute -->
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="route_id">
                                    Rute Dasar
                                </label>
                                <select name="route_id" id="route_id" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-500">
                                    <option value="" disabled selected>Pilih Rute...</option>
                                    @foreach($routes as $rute)
                                        <option value="{{ $rute->id }}">
                                            {{ $rute->origin->city }} ➔ {{ $rute->destination->city }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Input Waktu Keberangkatan -->
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="departure_time">
                                    Waktu Keberangkatan
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-500" 
                                    id="departure_time" type="datetime-local" name="departure_time" required>
                            </div>

                            <!-- Input Waktu Tiba (BARU) -->
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="arrival_time">
                                    Perkiraan Waktu Tiba
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-500" 
                                    id="arrival_time" type="datetime-local" name="arrival_time" required>
                            </div>
                            
                            <!-- Input Harga -->
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
                                    Harga Sewa (Rp)
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-500" 
                                    id="price" type="number" name="price" placeholder="Cth: 2500000" required>
                            </div>

                            <!-- Dropdown Status -->
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="is_available">
                                    Status Ketersediaan
                                </label>
                                <select name="is_available" id="is_available" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-500">
                                    <option value="1" selected>Tersedia (Bisa Dipesan)</option>
                                    <option value="0">Disewa / Kosong</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-8 pt-4 border-t">
                            <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700 font-bold text-sm">Batal</a>
                            <button class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 px-8 rounded focus:outline-none focus:shadow-outline transition shadow-lg" type="submit">
                                + Tambahkan Data
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>