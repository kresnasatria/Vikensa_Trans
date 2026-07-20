<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pilih Armada Charter') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Notifikasi Sukses / Error -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                @foreach ($schedules as $schedule)
                <!-- Tambahkan efek redup (opacity-60) jika is_available bernilai false -->
                <div class="overflow-hidden shadow-sm sm:rounded-lg {{ $schedule->is_available ? 'bg-white' : 'bg-gray-100 opacity-60' }}">
                    <div class="p-6 text-gray-900">
                        <!-- Nama Mobil & Label Status -->
                        <h3 class="text-lg font-bold mb-2 flex items-center">
                            {{ $schedule->shuttle->name }}
                            @if(!$schedule->is_available)
                                <span class="ml-3 bg-red-100 text-red-700 px-2 py-0.5 rounded text-xs font-bold uppercase tracking-wider">
                                    Disewa
                                </span>
                            @endif
                        </h3>
                        
                        <!-- Rute & Jam -->
                        <div class="text-sm text-gray-600 mb-4">
                            <p>💺 Kapasitas: {{ $schedule->shuttle->seat_capacity }} Penumpang</p>
                        </div>
                        
                        <!-- Harga & Tombol -->
                        <div class="flex items-center justify-between mt-4">
                            <span class="text-xl font-extrabold {{ $schedule->is_available ? 'text-blue-600' : 'text-gray-400' }}">
                                Rp {{ number_format($schedule->price, 0, ',', '.') }}
                            </span>
                            
                            <!-- Logika Tombol -->
                            @if($schedule->is_available)
                                <a href="{{ route('book.create', $schedule->id) }}" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700 transition cursor-pointer font-semibold text-sm">
                                    Form Pesan Unit
                                </a>
                           @else
                                <button disabled class="bg-gray-300 text-gray-500 font-semibold px-4 py-2 rounded cursor-not-allowed">
                                    Unit Disewa
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>