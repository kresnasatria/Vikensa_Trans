<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard - Manajemen Armada') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-t-4 border-purple-600">
                <div class="p-6 text-gray-900">
                    
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold text-purple-700">Daftar Unit & Harga</h3>
                        <!-- Nantinya tombol ini bisa dipakai untuk tambah jadwal baru -->
                        <a href="{{ route('admin.create') }}" class="inline-block bg-purple-600 text-white px-4 py-2 rounded shadow hover:bg-purple-700 transition font-semibold text-sm">
                            + Tambah Jadwal
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-100 text-gray-700 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left">Armada</th>
                                    <th class="py-3 px-6 text-left">Rute & Waktu</th>
                                    <th class="py-3 px-6 text-center">Harga Sewa</th>
                                    <th class="py-3 px-6 text-center">Status</th>
                                    <th class="py-3 px-6 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">
                                @foreach($schedules as $schedule)
                                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                                        <td class="py-3 px-6 text-left whitespace-nowrap">
                                            <div class="font-bold text-gray-800">{{ $schedule->shuttle->name }}</div>
                                            <div class="text-xs text-gray-500">Kapasitas: {{ $schedule->shuttle->seat_capacity }} Org</div>
                                        </td>
                                        <td class="py-3 px-6 text-left">
                                            <div class="font-semibold">{{ $schedule->route->origin->city }} ➔ {{ $schedule->route->destination->city }}</div>
                                            <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($schedule->departure_time)->format('d M Y, H:i') }}</div>
                                        </td>
                                        <td class="py-3 px-6 text-center font-bold text-blue-600">
                                            Rp {{ number_format($schedule->price, 0, ',', '.') }}
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            @if($schedule->is_available)
                                                <span class="bg-green-200 text-green-700 py-1 px-3 rounded-full text-xs font-bold uppercase">Tersedia</span>
                                            @else
                                                <span class="bg-red-200 text-red-700 py-1 px-3 rounded-full text-xs font-bold uppercase">Disewa</span>
                                            @endif
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            <div class="flex item-center justify-center space-x-4">
    <!-- Tombol Edit -->
                                                <a href="{{ route('admin.edit', $schedule->id) }}" class="w-5 text-gray-400 hover:text-purple-600 transform hover:scale-110 transition" title="Edit Data">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                </a>
                                                
                                                <!-- Tombol Hapus -->
                                                <form action="{{ route('admin.destroy', $schedule->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus jadwal ini? Data tidak bisa dikembalikan.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="w-5 text-gray-400 hover:text-red-600 transform hover:scale-110 transition cursor-pointer" title="Hapus Data">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>