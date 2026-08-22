<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Manajemen Rute') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            {{-- Pesan Sukses --}}
            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-2xl font-semibold">
                    ✓ {{ session('success') }}
                </div>
            @endif

            {{-- FORM TAMBAH RUTE BARU (DENGAN ALPINE.JS MULTI-STOP) --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-[2rem] border border-slate-200 p-8">
                <h3 class="text-xl font-black text-slate-900 mb-6">Daftarkan Rute Perjalanan Baru</h3>
                
                <form action="{{ route('admin.route.store') }}" method="POST">
                    @csrf
                    
                    <div class="grid gap-6">
                        
                        {{-- KOTA ASAL & TUJUAN --}}
                        <div x-data="{ destinations: [''] }" class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-slate-50 p-6 rounded-2xl border border-slate-100">
                            
                            {{-- KOTA ASAL --}}
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Kota Asal Pertama</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="3"/></svg>
                                    </span>
                                    <input type="text" name="origin" placeholder="Cth: Bandung" required class="w-full rounded-xl border-slate-200 bg-white py-3 pl-11 pr-4 text-sm font-medium focus:border-sky-500 focus:ring-sky-500/20">
                                </div>
                            </div>

                            {{-- KOTA TUJUAN / TRANSIT DINAMIS --}}
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Kota Tujuan / Titik Transit</label>
                                
                                <template x-for="(dest, index) in destinations" :key="index">
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="relative flex-1">
                                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-xs font-black text-slate-400" x-text="index + 1"></span>
                                            <input type="text" name="destinations[]" x-model="destinations[index]" placeholder="Cth: Jakarta" required class="w-full rounded-xl border-slate-200 bg-white py-3 pl-10 pr-4 text-sm font-medium focus:border-sky-500 focus:ring-sky-500/20">
                                        </div>
                                        
                                        <button type="button" x-show="destinations.length > 1" @click="destinations.splice(index, 1)" title="Hapus Kota" class="flex shrink-0 h-11 w-11 items-center justify-center rounded-xl bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                        </button>
                                    </div>
                                </template>
                                
                                <button type="button" @click="destinations.push('')" class="mt-1 flex items-center gap-2 text-xs font-bold text-sky-600 bg-sky-100 px-4 py-2.5 rounded-xl hover:bg-sky-200 transition">
                                    + Tambah Titik Kota
                                </button>
                            </div>

                        </div>

                    </div>

                    <div class="mt-8 flex justify-end">
                        <button type="submit" class="bg-sky-500 hover:bg-sky-600 text-white font-black text-sm px-8 py-3.5 rounded-xl shadow-lg shadow-sky-500/30 transition">
                            + Simpan Rute Multi-Kota
                        </button>
                    </div>
                </form>
            </div>

            {{-- TABEL DAFTAR RUTE --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-[2rem] border border-slate-200 p-8">
                
                {{-- HEADER DAN LIVE SEARCH --}}
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <h3 class="text-xl font-black text-slate-900">Daftar Rute Perjalanan</h3>
                    
                    {{-- KOTAK INPUT LIVE SEARCH --}}
                    <div class="relative w-full sm:w-72">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </span>
                        <input type="text" id="liveSearchInput" placeholder="Cari rute (misal: Jakarta)..." 
                            class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50 pl-11 pr-4 text-xs font-bold text-slate-800 outline-none focus:border-sky-500 focus:bg-white transition">
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200 text-xs font-black uppercase text-slate-500 tracking-wider">
                                <th class="p-4">Rute Perjalanan (Multi-Stop)</th>
                                <th class="p-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="routeTableBody">
                            @forelse($routes as $rute)
                                <tr class="route-row border-b border-slate-100 hover:bg-slate-50/50">
                                    <td class="p-4 font-bold text-slate-800 route-text">
                                        {{ $rute->origin }} 
                                        
                                        {{-- LOGIKA UNTUK MENAMPILKAN ARRAY JIKA SUDAH JSON --}}
                                        @php
                                            $destinations = is_string($rute->destination) ? json_decode($rute->destination, true) : null;
                                        @endphp
                                        
                                        @if(is_array($destinations))
                                            @foreach($destinations as $dest)
                                                <span class="text-sky-400 mx-1">➔</span> {{ $dest }}
                                            @endforeach
                                        @else
                                            <span class="text-sky-400 mx-1">➔</span> {{ $rute->destination }}
                                        @endif

                                    </td>
                                    
                                    {{-- TOMBOL HAPUS --}}
                                    <td class="p-4 text-center w-32">
                                        <form action="{{ route('admin.route.destroy', $rute->id) }}" method="POST" onsubmit="return confirm('Hapus rute ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-50 text-red-500 hover:bg-red-500 hover:text-white px-4 py-2.5 rounded-xl text-xs font-bold transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr id="emptyRow">
                                    <td colspan="2" class="p-8 text-center text-slate-500 font-medium border-dashed border-2 border-slate-200 rounded-xl">
                                        Belum ada rute yang didaftarkan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    {{-- SCRIPT JAVASCRIPT UNTUK LIVE SEARCH --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('liveSearchInput');
            const rows = document.querySelectorAll('.route-row');

            if (searchInput) {
                searchInput.addEventListener('keyup', function() {
                    const keyword = searchInput.value.toLowerCase();

                    rows.forEach(row => {
                        const textElement = row.querySelector('.route-text');
                        if (textElement) {
                            const text = textElement.textContent.toLowerCase();
                            if (text.includes(keyword)) {
                                row.style.display = ''; // Tampilkan
                            } else {
                                row.style.display = 'none'; // Sembunyikan
                            }
                        }
                    });
                });
            }
        });
    </script>
</x-app-layout>