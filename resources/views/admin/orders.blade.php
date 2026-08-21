<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Manajemen Order Masuk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            {{-- Pesan Sukses --}}
            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-2xl font-semibold">
                    ✓ {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-[2rem] border border-slate-200 p-8">
                
                {{-- HEADER JUDUL & TOMBOL TANDAI SUDAH DIBACA --}}
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <h3 class="text-xl font-black text-slate-900">Daftar Seluruh Pesanan Charter</h3>
                    
                    <form action="{{ route('admin.orders.markRead') }}" method="POST">
                        @csrf
                        <button type="submit" class="inline-flex items-center gap-2 bg-sky-500 hover:bg-sky-400 text-white text-xs font-black px-4 py-2.5 rounded-xl shadow-lg shadow-sky-500/20 transition">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            Tandai Semua Sudah Dibaca
                        </button>
                    </form>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200 text-xs font-black uppercase text-slate-500 tracking-wider">
                                <th class="p-4">Kode Booking</th>
                                <th class="p-4">Waktu Order</th> {{-- KOLOM BARU --}}
                                <th class="p-4 min-w-[200px]">Pemesan & Detail Jemput</th>
                                <th class="p-4">Armada</th>
                                <th class="p-4">Rute Perjalanan</th>
                                <th class="p-4">Total Harga</th>
                                <th class="p-4">Status</th>
                                <th class="p-4 text-center">Aksi / Ubah Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr class="border-b border-slate-100 hover:bg-slate-50/50">
                                    <td class="p-4 font-black text-sky-600">
                                        {{ $order->booking_code }}
                                    </td>
                                    
                                    {{-- TAMPILAN WAKTU ORDER BARU --}}
                                    <td class="p-4">
                                        <p class="text-xs font-bold text-slate-700">
                                            {{ $order->created_at->format('d M Y') }}
                                        </p>
                                        <p class="mt-1 text-[11px] font-semibold text-slate-400">
                                            {{ $order->created_at->format('H:i') }} WIB
                                        </p>
                                    </td>

                                    <td class="p-4">
                                        {{-- Nama Pemesan --}}
                                        <p class="font-black text-slate-800">
                                            {{ $order->booker_name ?? ($order->user->name ?? 'User Tamu') }}
                                        </p>
                                        
                                        {{-- No HP --}}
                                        <p class="mt-1 flex items-center gap-1 text-xs font-semibold text-slate-600">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3 w-3"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                            {{ $order->phone_number ?? 'Tidak ada No HP' }}
                                        </p>
                                        
                                        {{-- Alamat --}}
                                        <p class="mt-1 flex items-start gap-1 text-xs text-slate-400 max-w-[200px]" title="{{ $order->pickup_address }}">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3 w-3 shrink-0 mt-0.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                                            <span class="truncate">{{ $order->pickup_address ?? 'Tidak ada rincian alamat' }}</span>
                                        </p>
                                    </td>

                                    <td class="p-4 font-semibold text-slate-700">
                                        {{ $order->schedule->shuttle->name ?? 'Armada Charter' }}
                                    </td>
                                    <td class="p-4 text-sm text-slate-600">
                                        <span class="font-bold">{{ $order->custom_origin }}</span> ➔ <span class="font-bold">{{ $order->custom_destination }}</span>
                                    </td>
                                    <td class="p-4 font-black text-slate-900">
                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </td>
                                    <td class="p-4">
                                        @if($order->payment_status == 'paid')
                                            <span class="bg-emerald-100 text-emerald-700 text-xs font-black px-3 py-1 rounded-full uppercase">Lunas</span>
                                        @else
                                            <span class="bg-amber-100 text-amber-700 text-xs font-black px-3 py-1 rounded-full uppercase">Pending</span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-center">
                                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="inline-flex items-center gap-2">
                                            @csrf
                                            @method('PUT')
                                            <select name="payment_status" class="rounded-xl border-slate-200 bg-slate-50 text-xs font-bold py-2 pl-3 pr-8 focus:ring-2 focus:ring-sky-500 outline-none">
                                                <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Lunas</option>
                                            </select>
                                            <button type="submit" class="bg-slate-950 hover:bg-slate-800 text-white text-xs font-bold px-3 py-2 rounded-xl transition">
                                                Simpan
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    {{-- Mengubah colspan menjadi 8 karena ada penambahan kolom Waktu Order --}}
                                    <td colspan="8" class="p-8 text-center text-slate-500 font-medium border-dashed border-2 border-slate-200 rounded-xl">
                                        Belum ada data pesanan yang masuk.
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