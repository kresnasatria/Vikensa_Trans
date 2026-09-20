<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Riwayat Pesanan VikensaTrans">
    <title>Riwayat Pesanan - VikensaTrans</title>

    {{-- FAVICON --}}
    <link rel="icon" type="image/png" href="{{ asset('images/vikensa_trans_logo.png') }}?v=3">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
        html { scroll-behavior: smooth; }
        body {
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }
        ::selection { background: #0ea5e9; color: white; }
        
        .history-card {
            transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
        }
        .history-card:hover {
            transform: translateY(-2px);
            border-color: rgba(14, 165, 233, .25);
            box-shadow: 0 20px 60px rgba(15, 23, 42, .07);
        }
        .stat-card {
            transition: transform .25s ease, box-shadow .25s ease;
        }
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 18px 45px rgba(15, 23, 42, .06);
        }
    </style>
</head>

@php
    $totalBookings = $bookings->count();
    $pendingCount = $bookings->where('payment_status', 'pending')->count();
    $paidCount = $bookings->where('payment_status', 'paid')->count();
    $cancelledCount = $bookings->where('payment_status', 'cancelled')->count();
    $totalPaid = $bookings->where('payment_status', 'paid')->sum('total_price');
    $userName = Auth::user()?->name ?? 'Pengguna';
@endphp

<body class="bg-slate-100 text-slate-900 antialiased" x-data="{ sidebarOpen: false, profileOpen: false }">

{{-- MOBILE OVERLAY --}}
<div x-show="sidebarOpen" x-cloak x-transition.opacity @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-slate-950/60 backdrop-blur-sm lg:hidden"></div>

{{-- SIDEBAR --}}
<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 flex w-[280px] flex-col border-r border-white/10 bg-slate-950 text-white transition-transform duration-300 lg:translate-x-0">
    
    {{-- LOGO --}}
    <div class="flex h-24 items-center justify-between border-b border-white/10 px-6">
        <a href="{{ url('/') }}" class="flex items-center">
            <img src="{{ asset('images/vikensa_trans_logo.png') }}" alt="VikensaTrans" class="h-16 w-auto max-w-[200px] object-contain">
        </a>
        <button type="button" @click="sidebarOpen = false" class="flex h-10 w-10 items-center justify-center rounded-xl text-slate-400 transition hover:bg-white/10 hover:text-white lg:hidden">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5"><path d="M6 6l12 12M18 6L6 18"/></svg>
        </button>
    </div>

    {{-- NAVIGATION --}}
    <nav class="flex-1 overflow-y-auto px-4 py-6">
        <p class="mb-3 px-4 text-[10px] font-black uppercase tracking-[.2em] text-slate-500">Menu Utama</p>

        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3.5 text-sm font-semibold text-slate-400 transition hover:bg-white/5 hover:text-white">
            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/5">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
            </div>
            Dashboard
        </a>

        <div class="mt-2 flex items-center gap-3 rounded-2xl bg-sky-500 px-4 py-3.5 text-sm font-bold text-white shadow-lg shadow-sky-500/10">
            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/15">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5"><path d="M3 12a9 9 0 1 0 3-6.7"/><path d="M3 4v6h6"/><path d="M12 7v5l3 2"/></svg>
            </div>
            Riwayat Pesanan
        </div>

        <a href="{{ route('profile.edit') }}" class="mt-2 flex items-center gap-3 rounded-2xl px-4 py-3.5 text-sm font-semibold text-slate-400 transition hover:bg-white/5 hover:text-white">
            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/5">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-5 3-8 8-8s8 3 8 8"/></svg>
            </div>
            Profil Saya
        </a>

        <p class="mb-3 mt-8 px-4 text-[10px] font-black uppercase tracking-[.2em] text-slate-500">Website</p>
        
        <a href="{{ url('/') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3.5 text-sm font-semibold text-slate-400 transition hover:bg-white/5 hover:text-white">
            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/5">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5"><path d="m3 11 9-8 9 8"/><path d="M5 10v10h14V10"/><path d="M9 20v-6h6v6"/></svg>
            </div>
            Kembali ke Beranda
        </a>

        <div class="mt-9 rounded-3xl border border-white/10 bg-white/[.04] p-5">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-sky-500/10 text-sky-400">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/><path d="m9 12 2 2 4-4"/></svg>
            </div>
            <p class="mt-4 text-sm font-black text-white">Pesananmu Tersimpan</p>
            <p class="mt-2 text-xs leading-6 text-slate-500">Pantau pembayaran, status pesanan, detail perjalanan dan kwitansi melalui halaman ini.</p>
        </div>
    </nav>

    {{-- USER PROFILE --}}
    <div class="border-t border-white/10 p-4">
        <div class="relative">
            <button type="button" @click="profileOpen = !profileOpen" class="flex w-full items-center gap-3 rounded-2xl p-3 text-left transition hover:bg-white/5">
                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-sky-500 text-sm font-black uppercase text-white">
                    {{ mb_substr($userName, 0, 1) }}
                </div>
                <div class="min-w-0 flex-1">
                    <p class="truncate text-sm font-bold text-white">{{ Auth::user()->name }}</p>
                    <p class="mt-0.5 truncate text-xs text-slate-500">{{ Auth::user()->email }}</p>
                </div>
                <svg :class="profileOpen ? 'rotate-180' : ''" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4 text-slate-500 transition"><path d="m6 9 6 6 6-6"/></svg>
            </button>

            <div x-show="profileOpen" x-cloak x-transition @click.outside="profileOpen = false" class="absolute bottom-full left-0 right-0 mb-2 overflow-hidden rounded-2xl border border-slate-200 bg-white p-2 shadow-2xl">
                <a href="{{ route('profile.edit') }}" class="block rounded-lg px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">Edit Profil</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full rounded-xl px-4 py-3 text-left text-sm font-semibold text-red-500 transition hover:bg-red-50">Keluar</button>
                </form>
            </div>
        </div>
    </div>
</aside>

{{-- MAIN WRAPPER --}}
<div class="lg:pl-[280px]">

    {{-- TOP BAR --}}
    <header class="sticky top-0 z-30 flex h-20 items-center border-b border-slate-200 bg-white/90 px-5 backdrop-blur-xl sm:px-7 lg:px-10">
        <div class="flex w-full items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <button type="button" @click="sidebarOpen = true" class="flex h-11 w-11 items-center justify-center rounded-xl border border-slate-200 text-slate-600 transition hover:bg-slate-50 lg:hidden">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-6 w-6"><path d="M4 6h16"/><path d="M4 12h16"/><path d="M4 18h16"/></svg>
                </button>
                <div>
                    <p class="text-xs font-semibold text-slate-400">VikensaTrans</p>
                    <h2 class="text-lg font-black text-slate-950">Riwayat Pesanan</h2>
                </div>
            </div>
            <a href="{{ route('dashboard') }}" class="inline-flex shrink-0 items-center justify-center gap-3 rounded-2xl bg-sky-500 px-4 py-2.5 text-sm font-black text-white shadow-lg shadow-sky-500/15 transition hover:bg-sky-400">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4"><path d="M12 5v14"/><path d="M5 12h14"/></svg>
                <span class="hidden sm:inline">Pesan Armada</span>
            </a>
        </div>
    </header>

    {{-- CONTENT --}}
    <main class="px-5 py-8 sm:px-7 lg:px-10 lg:py-10">
        <div class="mx-auto max-w-7xl">

            {{-- SUCCESS NOTIFICATION --}}
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-transition class="mb-6 flex items-center justify-between gap-4 rounded-xl border border-emerald-200 bg-emerald-50 px-5 py-4">
                    <div class="flex items-center gap-3">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600">✓</div>
                        <p class="text-sm font-semibold text-emerald-700">{{ session('success') }}</p>
                    </div>
                    <button type="button" @click="show = false" class="text-lg text-emerald-600">×</button>
                </div>
            @endif

            {{-- PAGE TITLE --}}
            <div class="flex flex-col justify-between gap-5 md:flex-row md:items-end">
                <div>
                    <p class="text-xs font-bold uppercase tracking-[.15em] text-sky-600">Pesanan Saya</p>
                    <h2 class="mt-2 text-2xl font-black tracking-tight text-slate-950 sm:text-3xl">Daftar Riwayat Pesanan</h2>
                    <p class="mt-2 text-sm leading-7 text-slate-500">Pesanan terbaru akan ditampilkan paling atas.</p>
                </div>

                @if($paidCount > 0)
                    <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3">
                        <p class="text-[10px] font-black uppercase tracking-wider text-emerald-600">Total Transaksi Lunas</p>
                        <p class="mt-1 text-lg font-black text-emerald-700">Rp {{ number_format($totalPaid, 0, ',', '.') }}</p>
                    </div>
                @endif
            </div>

            {{-- EMPTY --}}
            @if($bookings->isEmpty())
                <div class="mt-7 rounded-[2rem] border border-dashed border-slate-300 bg-white px-6 py-16 text-center">
                    <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-[1.5rem] bg-sky-50 text-sky-500">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="h-9 w-9"><path d="M6 2v4M18 2v4"/><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M3 10h18"/><path d="M8 15h8"/></svg>
                    </div>
                    <h3 class="mt-5 text-xl font-black text-slate-900">Belum ada pesanan</h3>
                    <p class="mx-auto mt-2 max-w-md text-sm leading-7 text-slate-500">Kamu belum pernah melakukan pemesanan armada VikensaTrans. Pilih unit dan buat perjalanan pertamamu sekarang.</p>
                    <a href="{{ route('dashboard') }}" class="mt-6 inline-flex items-center gap-2 rounded-2xl bg-sky-500 px-6 py-3.5 text-sm font-black text-white transition hover:bg-sky-400">
                        Pilih Armada
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg>
                    </a>
                </div>
            @else

                {{-- BOOKING CARDS --}}
                <div class="mt-7 space-y-5">
                    @foreach($bookings as $booking)
                        @php
                            $shuttle = $booking->schedule?->shuttle;
                            $shuttleName = $shuttle?->name ?? 'Armada VikensaTrans';

                            /*
                            |--------------------------------------------------------------------------
                            | PENGAMBILAN FOTO DARI TABEL RELASI `shuttle_photos`
                            |--------------------------------------------------------------------------
                            */
                            $vehicleImage = 'images/v01.jpeg'; // Default akhir

                            if ($shuttle) {
                                // Mengambil foto pertama dari relasi ShuttlePhoto yang ada di database controller Anda
                                $firstPhotoRecord =$shuttle->photos()->first();

                                if ($firstPhotoRecord && !empty($firstPhotoRecord->photo_path)) {
                                    $path =$firstPhotoRecord->photo_path;
                                    $vehicleImage = str_starts_with($path, 'storage/') ? $path : 'storage/' .$path;
                                }
                            }

                            // JIKA DATABASE KOSONG, GUNAKAN FALLBACK WULING / DEFAULT TEMPLATE
                            if ($vehicleImage === 'images/v01.jpeg') {
                                $vName = strtolower($shuttleName);
                                if (str_contains($vName, 'wuling')) {$vehicleImage = 'images/wuling.PNG';
                                } elseif ((($shuttle?->id ?? 1) % 2) === 0) {
                                    $vehicleImage = 'images/v02.jpeg';
                                }
                            }

                            // DATE LOGIC
                            $orderDate = $booking->created_at->copy()->timezone('Asia/Jakarta');$departure = $booking->custom_departure_time ? \Carbon\Carbon::parse($booking->custom_departure_time) : null;
                            $arrival = $booking->custom_arrival_time ? \Carbon\Carbon::parse($booking->custom_arrival_time) : null;

                            // DURATION LOGIC
                            $durationDays = 1;
                            if ($departure &&$arrival) {
                                $durationDays =$departure->diffInDays($arrival);$durationDays = $durationDays === 0 ? 1 :$durationDays;
                            }
                        @endphp

                        <article x-data="{ detailOpen: false }" class="history-card overflow-hidden rounded-[2rem] border border-slate-200 bg-white">
                            
                            {{-- TOP BAR --}}
                            <div class="flex flex-col justify-between gap-4 border-b border-slate-100 bg-slate-50/70 px-5 py-4 sm:flex-row sm:items-center lg:px-6">
                                <div class="flex flex-wrap items-center gap-3">
                                    <div class="inline-flex items-center gap-2 rounded-xl bg-slate-950 px-3 py-2 text-xs font-black text-white">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-4 w-4 text-sky-400"><path d="M4 7h16"/><path d="M4 12h10"/><path d="M4 17h7"/></svg>
                                        {{ $booking->booking_code }}
                                    </div>
                                    <span class="text-xs font-semibold text-slate-400">Dibuat {{ $orderDate->format('d M Y') }} • {{$orderDate->format('H:i') }} WIB</span>
                                </div>

                                {{-- STATUS BADGE --}}
                                @if($booking->payment_status === 'pending')
                                    <span class="inline-flex w-fit items-center gap-2 rounded-full bg-amber-100 px-3 py-2 text-[10px] font-black uppercase tracking-wider text-amber-700">
                                        <span class="h-2 w-2 rounded-full bg-amber-500"></span>Menunggu Pembayaran
                                    </span>
                                @elseif($booking->payment_status === 'paid')
                                    <p class="text-sm font-black text-emerald-700">Pembayaran telah dikonfirmasi</p>
                                @else
                                    <p class="text-sm font-black text-slate-500">Pesanan sudah dibatalkan</p>
                                @endif
                            </div>

                            {{-- BODY --}}
                            <div class="grid lg:grid-cols-[220px_minmax(0,1fr)]">
                                
                                {{-- VEHICLE IMAGE --}}
                                <div class="relative h-[210px] overflow-hidden bg-slate-200 lg:h-full lg:min-h-[275px]">
                                    <img src="{{ asset($vehicleImage) }}" alt="{{ $shuttleName }}" class="h-full w-full object-cover">
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/5 to-transparent"></div>
                                    <div class="absolute bottom-4 left-4 right-4">
                                        <p class="text-[10px] font-black uppercase tracking-widest text-sky-300">Armada</p>
                                        <p class="mt-1 text-lg font-black text-white">{{ $shuttleName }}</p>
                                        @if($shuttle?->license_plate)
                                            <p class="mt-1 text-xs font-semibold text-slate-300">{{ $shuttle->license_plate }}</p>
                                        @endif
                                    </div>
                                </div>

                                {{-- CONTENT INFO --}}
                                <div class="p-5 sm:p-6">
                                    
                                    {{-- ROUTE --}}
                                    <div class="flex items-start gap-4">
                                        <div class="flex w-5 shrink-0 flex-col items-center pt-1">
                                            <div class="h-3 w-3 rounded-full border-[3px] border-sky-500 bg-white"></div>
                                            <div class="my-1 h-10 w-px bg-slate-300"></div>
                                            <div class="h-3 w-3 rounded-full bg-slate-950"></div>
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <div>
                                                <p class="text-[10px] font-black uppercase tracking-wider text-slate-400">Kota Jemput</p>
                                                <p class="mt-1 text-base font-black text-slate-900 sm:text-lg">{{ $booking->custom_origin ?? 'Asal perjalanan' }}</p>
                                            </div>
                                            <div class="mt-4">
                                                <p class="text-[10px] font-black uppercase tracking-wider text-slate-400">Kota Tujuan</p>
                                                <p class="mt-1 text-base font-black text-slate-900 sm:text-lg">{{ $booking->custom_destination ?? 'Tujuan perjalanan' }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- INFO GRID --}}
                                    <div class="mt-6 grid gap-3 sm:grid-cols-2 xl:grid-cols-4">
                                        <div class="rounded-2xl bg-slate-50 p-4">
                                            <p class="text-[10px] font-black uppercase tracking-wider text-slate-400">Berangkat</p>
                                            @if($departure)
                                                <p class="mt-2 text-sm font-black text-slate-800">{{ $departure->format('d M Y') }}</p>
                                                <p class="mt-1 text-xs font-semibold text-slate-500">{{ $departure->format('H:i') }} WIB</p>
                                            @else
                                                <p class="mt-2 text-sm text-slate-400">-</p>
                                            @endif
                                        </div>
                                        <div class="rounded-2xl bg-slate-50 p-4">
                                            <p class="text-[10px] font-black uppercase tracking-wider text-slate-400">Selesai</p>
                                            @if($arrival)
                                                <p class="mt-2 text-sm font-black text-slate-800">{{ $arrival->format('d M Y') }}</p>
                                                <p class="mt-1 text-xs font-semibold text-slate-500">{{ $arrival->format('H:i') }} WIB</p>
                                            @else
                                                <p class="mt-2 text-sm text-slate-400">-</p>
                                            @endif
                                        </div>
                                        <div class="rounded-2xl bg-slate-50 p-4">
                                            <p class="text-[10px] font-black uppercase tracking-wider text-slate-400">Durasi</p>
                                            <p class="mt-2 text-sm font-black text-slate-800">{{ $durationDays }} Hari</p>
                                            <p class="mt-1 text-xs text-slate-400">Charter</p>
                                        </div>
                                        <div class="rounded-2xl bg-sky-50 p-4">
                                            <p class="text-[10px] font-black uppercase tracking-wider text-sky-500">Total Harga</p>
                                            <p class="mt-2 text-sm font-black text-sky-700">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                                            <p class="mt-1 text-xs text-sky-500">Total pesanan</p>
                                        </div>
                                    </div>

                                    {{-- PAYMENT COUNTDOWN --}}
                                    @if($booking->payment_status === 'pending')
                                        <div class="mt-5 flex flex-col justify-between gap-4 rounded-2xl border border-amber-200 bg-amber-50 p-4 sm:flex-row sm:items-center">
                                            <div class="flex items-center gap-3">
                                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-amber-100 text-amber-600">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
                                                </div>
                                                <div>
                                                    <p class="text-[10px] font-black uppercase tracking-wider text-slate-400">Sisa Waktu</p>
                                                    <p class="time-display mt-0.5 font-mono text-lg font-black text-red-500" data-expire="{{ $booking->created_at->copy()->addMinutes(5)->timestamp * 1000 }}">05:00</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    {{-- DETAILS FOLD --}}
                                    <div class="mt-5 border-t border-slate-100 pt-5">
                                        <button type="button" @click="detailOpen = !detailOpen" class="flex items-center gap-2 text-sm font-black text-slate-600 transition hover:text-sky-600">
                                            <span x-text="detailOpen ? 'Tutup Detail' : 'Lihat Detail Pesanan'"></span>
                                            <svg :class="detailOpen ? 'rotate-180' : ''" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4 transition"><path d="m6 9 6 6 6-6"/></svg>
                                        </button>
                                        
                                        <div x-show="detailOpen" x-cloak x-collapse class="mt-5">
                                            <div class="grid gap-4 rounded-2xl border border-slate-200 bg-slate-50 p-5 sm:grid-cols-2">
                                                <div>
                                                    <p class="text-[10px] font-black uppercase tracking-wider text-slate-400">Nama Pemesan</p>
                                                    <p class="mt-1 text-sm font-bold text-slate-800">{{ $booking->booker_name ?? Auth::user()->name }}</p>
                                                </div>
                                                <div>
                                                    <p class="text-[10px] font-black uppercase tracking-wider text-slate-400">No. WhatsApp / HP</p>
                                                    <p class="mt-1 text-sm font-bold text-slate-800">{{ $booking->phone_number ?? '-' }}</p>
                                                </div>
                                                <div class="sm:col-span-2">
                                                    <p class="text-[10px] font-black uppercase tracking-wider text-slate-400">Detail Titik Jemput</p>
                                                    <p class="mt-1 text-sm leading-6 text-slate-700">{{ $booking->pickup_address ?? '-' }}</p>
                                                </div>
                                                <div>
                                                    <p class="text-[10px] font-black uppercase tracking-wider text-slate-400">Kapasitas Armada</p>
                                                    <p class="mt-1 text-sm font-bold text-slate-800">{{ $shuttle?->seat_capacity ?? '-' }} Penumpang</p>
                                                </div>
                                                <div>
                                                    <p class="text-[10px] font-black uppercase tracking-wider text-slate-400">Plat Nomor</p>
                                                    <p class="mt-1 text-sm font-bold uppercase text-slate-800">{{ $shuttle?->license_plate ?? '-' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            {{-- ACTION FOOTER --}}
                            <div class="flex flex-col justify-between gap-4 border-t border-slate-100 bg-slate-50/60 px-5 py-5 sm:flex-row sm:items-center lg:px-6">
                                <div>
                                    @if($booking->payment_status === 'pending')
                                        <p class="text-sm font-black text-slate-800">Pesanan menunggu pembayaran</p>
                                        <p class="mt-1 text-xs text-slate-400">Bayar sebelum waktu habis agar armada tetap terkunci untukmu.</p>
                                    @elseif($booking->payment_status === 'paid')
                                        <p class="text-sm font-black text-emerald-700">Pembayaran telah dikonfirmasi</p>
                                        <p class="mt-1 text-xs text-slate-400">Kwitansi perjalanan sudah dapat diunduh.</p>
                                    @else
                                        <p class="text-sm font-black text-slate-500">Pesanan sudah dibatalkan</p>
                                        <p class="mt-1 text-xs text-slate-400">Armada telah dikembalikan menjadi tersedia.</p>
                                    @endif
                                </div>

                                <div class="flex flex-col gap-2 sm:flex-row">
                                    @if($booking->payment_status === 'pending')
                                        <a href="{{ route('bayar', $booking->id) }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-sky-500 px-5 py-3 text-xs font-black text-white shadow-lg shadow-sky-500/15 transition hover:bg-sky-400">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-4 w-4"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg>
                                            Bayar Sekarang
                                        </a>
                                        <form action="{{ route('book.cancel', $booking->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini? Pesanan yang dibatalkan tidak dapat dikembalikan.');">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-red-200 bg-red-50 px-5 py-3 text-xs font-black text-red-500 transition hover:bg-red-500 hover:text-white">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-4 w-4"><path d="M6 6l12 12M18 6L6 18"/></svg>
                                                Batalkan
                                            </button>
                                        </form>
                                    @elseif($booking->payment_status === 'paid')
                                        <a href="{{ route('booking.receipt', $booking->id) }}" target="_blank" title="Kwitansi" class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-950 px-5 py-3 text-xs font-black text-white transition hover:bg-sky-600">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-4 w-4"><path d="M12 3v12"/><path d="m8 11 4 4 4-4"/><path d="M5 21h14"/></svg>
                                            Download Kwitansi
                                        </a>
                                    @else
                                        <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-3 text-xs font-black text-slate-600 transition hover:border-sky-200 hover:bg-sky-50 hover:text-sky-600">
                                            Pesan Lagi
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif

        </div>
    </main>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const timers = document.querySelectorAll('.countdown-container, .time-display');
        let isRefreshing = false;

        function updateTimers() {
            const now = new Date().getTime();
            timers.forEach(function (timer) {
                if(!timer.hasAttribute('data-expire')) return;

                const expireTime = parseInt(timer.getAttribute('data-expire'));
                const distance = expireTime - now;

                if (distance <= 0) {
                    timer.textContent = 'Waktu Habis';
                    timer.classList.add('text-red-600');
                    if (!isRefreshing) {
                        isRefreshing = true;
                        setTimeout(function () {
                            window.location.reload();
                        }, 1000);
                    }
                    return;
                }

                const minutes = Math.floor(distance / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                timer.textContent = String(minutes).padStart(2, '0') + ':' + String(seconds).padStart(2, '0');
            });
        }

        if (timers.length > 0) {
            updateTimers();
            setInterval(updateTimers, 1000);
        }
    });
</script>

</body>
</html>