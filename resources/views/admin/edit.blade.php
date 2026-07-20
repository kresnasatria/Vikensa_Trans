<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Penyesuaian Unit: ') }} {{ $schedule->shuttle->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-t-4 border-purple-600">
                <div class="p-8 text-gray-900">
                    
                    <form action="{{ route('admin.update', $schedule->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <h3 class="text-lg font-bold text-gray-700 border-b pb-2 mb-4">Informasi Armada</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Input Nama Armada -->
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="shuttle_name">
                                    Nama Armada
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-500" 
                                    id="shuttle_name" type="text" name="shuttle_name" value="{{ $schedule->shuttle->name }}" required>
                            </div>

                            <!-- Input Kapasitas -->
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="seat_capacity">
                                    Kapasitas Penumpang
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-500" 
                                    id="seat_capacity" type="number" name="seat_capacity" value="{{ $schedule->shuttle->seat_capacity }}" required>
                            </div>
                        </div>

                        <h3 class="text-lg font-bold text-gray-700 border-b pb-2 mb-4 mt-8">Detail Jadwal & Harga</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Dropdown Rute -->
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="route_id">
                                    Rute Perjalanan
                                </label>
                                <select name="route_id" id="route_id" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-500">
                                    @foreach($routes as $rute)
                                        <option value="{{ $rute->id }}" {{ $schedule->route_id == $rute->id ? 'selected' : '' }}>
                                            {{ $rute->origin->city }} ➔ {{ $rute->destination->city }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Input Waktu -->
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="departure_time">
                                    Waktu Keberangkatan
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-500" 
                                    id="departure_time" type="datetime-local" name="departure_time" value="{{ \Carbon\Carbon::parse($schedule->departure_time)->format('Y-m-d\TH:i') }}" required>
                            </div>
                            
                            <!-- Input Harga -->
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
                                    Harga Sewa (Rp)
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-500" 
                                    id="price" type="number" name="price" value="{{ $schedule->price }}" required>
                            </div>

                            <!-- Dropdown Status -->
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="is_available">
                                    Status Ketersediaan
                                </label>
                                <select name="is_available" id="is_available" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-500">
                                    <option value="1" {{ $schedule->is_available ? 'selected' : '' }}>Tersedia (Bisa Dipesan)</option>
                                    <option value="0" {{ !$schedule->is_available ? 'selected' : '' }}>Disewa / Kosong</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-8 pt-4 border-t">
                            <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700 font-bold text-sm">Kembali</a>
                            <button class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 px-8 rounded focus:outline-none focus:shadow-outline transition shadow-lg" type="submit">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>