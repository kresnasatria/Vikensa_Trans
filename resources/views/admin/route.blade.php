<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Manajemen Rute & Harga') }}
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

            {{-- FORM TAMBAH RUTE BARU --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-[2rem] border border-slate-200 p-8">
                <h3 class="text-xl font-black text-slate-900 mb-6">Tambah Rute & Biaya Baru</h3>
                
                <form action="{{ route('admin.route.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Kota Asal</label>
                            <input type="text" name="origin" placeholder="Cth: Bandung" required class="w-full rounded-xl border-slate-200 bg-slate-50 py-3 text-sm font-medium focus:border-sky-500 focus:ring-sky-500/20">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Kota Tujuan</label>
                            <input type="text" name="destination" placeholder="Cth: Jakarta" required class="w-full rounded-xl border-slate-200 bg-slate-50 py-3 text-sm font-medium focus:border-sky-500 focus:ring-sky-500/20">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Ongkos Rute (Rp)</label>
                            <input type="number" name="route_cost" placeholder="Cth: 150000" required class="w-full rounded-xl border-slate-200 bg-slate-50 py-3 text-sm font-medium focus:border-sky-500 focus:ring-sky-500/20">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Harga Bensin (Rp)</label>
                            <input type="number" name="fuel_cost" placeholder="Cth: 200000" required class="w-full rounded-xl border-slate-200 bg-slate-50 py-3 text-sm font-medium focus:border-sky-500 focus:ring-sky-500/20">
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end">
                        <button type="submit" class="bg-sky-500 hover:bg-sky-600 text-white font-black text-sm px-6 py-3 rounded-xl shadow-lg transition">
                            + Tambah Rute
                        </button>
                    </div>
                </form>
            </div>

            {{-- TABEL DAFTAR RUTE (EDIT LANGSUNG) --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-[2rem] border border-slate-200 p-8">
                <h3 class="text-xl font-black text-slate-900 mb-6">Daftar Rute & Update Harga Cepat</h3>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200 text-xs font-black uppercase text-slate-500 tracking-wider">
                                <th class="p-4">Rute Perjalanan</th>
                                <th class="p-4">Ongkos Rute (Rp)</th>
                                <th class="p-4">Harga Bensin (Rp)</th>
                                <th class="p-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($routes as $rute)
                                <tr class="border-b border-slate-100 hover:bg-slate-50/50">
                                    <td class="p-4 font-bold text-slate-800">
                                        {{ $rute->origin }} <span class="text-sky-400">➔</span> {{ $rute->destination }}
                                    </td>
                                    
                                    {{-- FORM EDIT INLINE UNTUK HARGA --}}
                                    <td colspan="3" class="p-0">
                                        <div class="flex items-center w-full">
                                            <form action="{{ route('admin.route.update', $rute->id) }}" method="POST" class="flex flex-1 items-center gap-4 px-4 py-2">
                                                @csrf
                                                @method('PUT')
                                                <input type="number" name="route_cost" value="{{ $rute->route_cost }}" required class="w-1/3 rounded-xl border-slate-200 bg-white py-2 text-sm font-bold text-indigo-600">
                                                <input type="number" name="fuel_cost" value="{{ $rute->fuel_cost }}" required class="w-1/3 rounded-xl border-slate-200 bg-white py-2 text-sm font-bold text-amber-600">
                                                
                                                <button type="submit" class="bg-slate-950 hover:bg-slate-800 text-white text-xs font-bold px-4 py-2.5 rounded-xl transition">
                                                    Update Harga
                                                </button>
                                            </form>

                                            {{-- TOMBOL HAPUS --}}
                                            <form action="{{ route('admin.route.destroy', $rute->id) }}" method="POST" class="pr-4" onsubmit="return confirm('Hapus rute ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-50 text-red-500 hover:bg-red-500 hover:text-white px-3 py-2.5 rounded-xl text-xs font-bold transition">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-8 text-center text-slate-500 font-medium border-dashed border-2 border-slate-200 rounded-xl">
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
</x-app-layout>