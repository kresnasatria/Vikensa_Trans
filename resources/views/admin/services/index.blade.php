<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Catatan Servis Armada') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-2xl font-semibold">
                    ✓ {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-[2rem] border border-slate-200 p-8">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <h3 class="text-xl font-black text-slate-900">Riwayat Perawatan Kendaraan</h3>
                    <a href="{{ route('admin.services.create') }}" class="bg-sky-500 hover:bg-sky-400 text-white text-xs font-black px-4 py-2.5 rounded-xl shadow-lg shadow-sky-500/20 transition">
                        + Tambah Catatan Servis
                    </a>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200 text-xs font-black uppercase text-slate-500 tracking-wider">
                                <th class="p-4">Tanggal</th>
                                <th class="p-4">Armada</th>
                                <th class="p-4">Kendala & Kerusakan</th>
                                <th class="p-4">Suku Cadang Diganti</th>
                                <th class="p-4">Servis Berikutnya</th>
                                <th class="p-4">Estimasi Biaya Servis</th>
                                <th class="p-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($services as $service)
                                <tr class="border-b border-slate-100 hover:bg-slate-50/50">
                                    <td class="p-4 text-sm font-bold text-slate-700">
                                        {{ $service->created_at->format('d M Y') }}
                                    </td>
                                    <td class="p-4 font-black text-sky-600">
                                        {{ $service->shuttle->name }}
                                        <p class="text-xs text-slate-400 font-semibold uppercase">{{ $service->shuttle->license_plate }}</p>
                                    </td>
                                    <td class="p-4 text-sm">
                                        <p><span class="font-bold text-slate-700">Kendala:</span> {{ $service->kendala }}</p>
                                        <p class="mt-1"><span class="font-bold text-slate-700">Rusak:</span> <span class="text-red-500">{{ $service->kerusakan }}</span></p>
                                    </td>
                                    <td class="p-4 text-sm font-medium text-slate-600">
                                        {{ $service->suku_cadang }}
                                    </td>
                                    <td class="p-4 text-sm font-bold text-amber-600">
                                        {{ $service->estimasi_waktu }}
                                    </td>
                                    <td class="p-4 text-sm font-bold text-emerald-600">
                                        {{ $service->estimasi_harga }}
                                    </td>
                                    <td class="p-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <!-- Tombol Edit -->
                                            <a href="{{ route('admin.services.edit', $service->id) }}" class="text-sky-600 hover:text-sky-800 font-bold text-xs bg-sky-50 px-3 py-1.5 rounded-lg transition">
                                                Edit
                                            </a>
                                            
                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Hapus catatan servis ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700 font-bold text-xs bg-red-50 px-3 py-1.5 rounded-lg transition">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-8 text-center text-slate-500 font-medium border-dashed border-2 border-slate-200 rounded-xl">
                                        Belum ada catatan servis kendaraan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>