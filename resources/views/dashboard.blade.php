<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Dashboard VikensaTrans - Pesan armada untuk perjalanan Anda.">
    <title>Dashboard - VikensaTrans</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] {
            display: none !important;
        }

        body {
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        ::selection {
            background: #0ea5e9;
            color: white;
        }

        .dashboard-card {
            transition: transform .3s ease, box-shadow .3s ease, border-color .3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 24px 60px rgba(15, 23, 42, .08);
            border-color: rgba(14, 165, 233, .25);
        }

        .vehicle-image {
            transition: transform .5s ease;
        }

        .dashboard-card:hover .vehicle-image {
            transform: scale(1.035);
        }
    </style>
</head>

<body class="bg-slate-100 text-slate-900 antialiased" x-data="{ sidebarOpen: false }">

@php
    $availableCount = $schedules->where('is_available', true)->count();
    $unavailableCount = $schedules->where('is_available', false)->count();
@endphp

{{-- MOBILE OVERLAY --}}
<div x-show="sidebarOpen" x-cloak x-transition.opacity @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-slate-950/60 backdrop-blur-sm lg:hidden"></div>

{{-- SIDEBAR --}}
<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 flex w-[280px] flex-col border-r border-white/10 bg-slate-950 text-white transition-transform duration-300 lg:translate-x-0">
    
    {{-- LOGO --}}
    <div class="flex h-24 items-center justify-between border-b border-white/10 px-6">
        <a href="{{ url('/') }}" class="flex items-center">
            <img src="{{ asset('images/vikensa_trans_logo.png') }}" alt="VikensaTrans" class="h-16 w-auto max-w-[200px] object-contain">
        </a>

        <button @click="sidebarOpen = false" type="button" class="flex h-10 w-10 items-center justify-center rounded-xl text-slate-400 transition hover:bg-white/10 hover:text-white lg:hidden">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5"><path d="M6 6l12 12M18 6L6 18"/></svg>
        </button>
    </div>

    {{-- NAVIGATION --}}
    <nav class="flex-1 overflow-y-auto px-4 py-6">
        <p class="mb-3 px-4 text-[10px] font-black uppercase tracking-[.2em] text-slate-500">Menu Utama</p>

        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 rounded-2xl bg-sky-500 px-4 py-3.5 text-sm font-bold text-white shadow-lg shadow-sky-500/10">
            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/15">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
            </div>
            Dashboard
        </a>

        <a href="{{ route('riwayat') }}" class="mt-2 flex items-center gap-3 rounded-2xl px-4 py-3.5 text-sm font-semibold text-slate-400 transition hover:bg-white/5 hover:text-white">
            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/5">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5"><path d="M3 12a9 9 0 1 0 3-6.7"/><path d="M3 4v6h6"/><path d="M12 7v5l3 2"/></svg>
            </div>
            Riwayat Pesanan
        </a>

        <a href="{{ route('profile.edit') }}" class="mt-2 flex items-center gap-3 rounded-2xl px-4 py-3.5 text-sm font-semibold text-slate-400 transition hover:bg-white/5 hover:text-white">
            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/5">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-5 3-8 8-8s8 3 8 8"/></svg>
            </div>
            Profil Saya
        </a>

        @if((Auth::user()->role ?? null) === 'admin')
            <p class="mb-3 mt-8 px-4 text-[10px] font-black uppercase tracking-[.2em] text-slate-500">Administrator</p>
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3.5 text-sm font-semibold text-slate-400 transition hover:bg-white/5 hover:text-white">
                <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/5">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5"><path d="M12 2 20 6v6c0 5-3.5 8.5-8 10-4.5-1.5-8-5-8-10V6Z"/><path d="m9 12 2 2 4-4"/></svg>
                </div>
                Panel Admin
            </a>
        @endif

        <p class="mb-3 mt-8 px-4 text-[10px] font-black uppercase tracking-[.2em] text-slate-500">Website</p>
        <a href="{{ url('/') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3.5 text-sm font-semibold text-slate-400 transition hover:bg-white/5 hover:text-white">
            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/5">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5"><path d="m3 11 9-8 9 8"/><path d="M5 10v10h14V10"/><path d="M9 20v-6h6v6"/></svg>
            </div>
            Kembali ke Beranda
        </a>
    </nav>

    {{-- PROFILE SIDEBAR --}}
    <div class="border-t border-white/10 p-4">
        <div x-data="{ profileOpen: false }" class="relative">
            <button @click="profileOpen = !profileOpen" type="button" class="flex w-full items-center gap-3 rounded-2xl p-3 text-left transition hover:bg-white/5">
                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-sky-500 text-sm font-black uppercase text-white">
                    {{ mb_substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="min-w-0 flex-1">
                    <p class="truncate text-sm font-bold text-white">{{ Auth::user()->name }}</p>
                    <p class="mt-0.5 truncate text-xs text-slate-500">{{ Auth::user()->email }}</p>
                </div>
                <svg :class="profileOpen ? 'rotate-180' : ''" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4 text-slate-500 transition"><path d="m6 9 6 6 6-6"/></svg>
            </button>

            <div x-show="profileOpen" x-cloak @click.outside="profileOpen = false" x-transition class="absolute bottom-full left-0 right-0 mb-2 overflow-hidden rounded-2xl border border-slate-200 bg-white p-2 shadow-2xl">
                <a href="{{ route('profile.edit') }}" class="block rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">Edit Profil</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full rounded-xl px-4 py-3 text-left text-sm font-semibold text-red-500 transition hover:bg-red-50">Keluar</button>
                </form>
            </div>
        </div>
    </div>
</aside>

{{-- MAIN AREA --}}
<div class="lg:pl-[280px]">

    {{-- TOP BAR --}}
    <header class="sticky top-0 z-30 flex h-20 items-center border-b border-slate-200 bg-white/90 px-5 backdrop-blur-xl sm:px-7 lg:px-10">
        <div class="flex w-full items-center justify-between gap-5">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = true" type="button" class="flex h-11 w-11 items-center justify-center rounded-xl border border-slate-200 text-slate-600 transition hover:bg-slate-50 lg:hidden">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-6 w-6"><path d="M4 6h16"/><path d="M4 12h16"/><path d="M4 18h16"/></svg>
                </button>
                <div>
                    <p class="text-xs font-semibold text-slate-400">VikensaTrans</p>
                    <h2 class="text-lg font-black text-slate-950">Dashboard</h2>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('riwayat') }}" class="hidden items-center gap-2 rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-bold text-slate-600 transition hover:border-sky-200 hover:bg-sky-50 hover:text-sky-600 sm:flex">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-4 w-4"><path d="M3 12a9 9 0 1 0 3-6.7"/><path d="M3 4v6h6"/></svg>
                    Riwayat
                </a>
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-sky-100 text-sm font-black uppercase text-sky-600">
                    {{ mb_substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
        </div>
    </header>

    {{-- CONTENT --}}
    <main class="px-5 py-8 sm:px-7 lg:px-10 lg:py-10">
        <div class="mx-auto max-w-7xl">

            {{-- FLASH MESSAGE --}}
            @if(session('success'))
                <div class="mb-7 flex items-center gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-semibold text-emerald-700">
                    <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-emerald-100">✓</span>
                    {{ session('success') }}
                </div>
            @endif

            {{-- WELCOME BANNER --}}
            <section class="relative overflow-hidden rounded-[2rem] bg-gradient-to-r from-slate-950 via-slate-900 to-blue-950 px-6 py-9 text-white sm:px-9 lg:px-11 lg:py-11">
                <div class="pointer-events-none absolute -right-20 -top-24 h-80 w-80 rounded-full bg-sky-500/20 blur-[100px]"></div>

                <div class="relative z-10 flex flex-col justify-between gap-8 lg:flex-row lg:items-end">
                    <div class="max-w-2xl">
                        <div class="inline-flex items-center gap-2 rounded-full border border-sky-400/20 bg-sky-400/10 px-4 py-2 text-xs font-bold text-sky-300">
                            <span class="h-2 w-2 rounded-full bg-emerald-400"></span> Selamat datang kembali
                        </div>
                        <h1 class="mt-5 text-3xl font-black tracking-tight sm:text-4xl lg:text-5xl">
                            Halo, <span class="text-sky-400">{{ Auth::user()->name }}!</span>
                        </h1>
                        <p class="mt-4 max-w-xl text-sm leading-7 text-slate-400 sm:text-base">
                            Pilih armada VikensaTrans dan atur perjalanan sesuai kebutuhanmu. Kota jemput, tujuan, serta waktu perjalanan dapat ditentukan pada saat melakukan pemesanan.
                        </p>
                    </div>

                    <a href="#pilih-armada" class="inline-flex shrink-0 items-center justify-center gap-3 rounded-2xl bg-sky-500 px-6 py-4 text-sm font-black text-white shadow-xl shadow-sky-500/20 transition hover:-translate-y-1 hover:bg-sky-400">
                        Pilih Armada <span>→</span>
                    </a>
                </div>
            </section>

            {{-- STATISTICS --}}
            <section class="mt-7 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                <div class="dashboard-card rounded-3xl border border-slate-200 bg-white p-6">
                    <p class="text-sm font-semibold text-slate-500">Armada Terdaftar</p>
                    <div class="mt-3 flex items-end justify-between">
                        <div>
                            <p class="text-3xl font-black text-slate-950">{{ $schedules->count() }}</p>
                            <p class="mt-1 text-xs text-slate-400">Total Unit</p>
                        </div>
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-sky-50 text-sky-600">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-6 w-6"><path d="M3 13l2-5a3 3 0 0 1 2.8-2h8.4A3 3 0 0 1 19 8l2 5"/><path d="M5 13h14a2 2 0 0 1 2 2v3H3v-3a2 2 0 0 1 2-2Z"/></svg>
                        </div>
                    </div>
                </div>

                <div class="dashboard-card rounded-3xl border border-slate-200 bg-white p-6">
                    <p class="text-sm font-semibold text-slate-500">Tersedia</p>
                    <div class="mt-3 flex items-end justify-between">
                        <div>
                            <p class="text-3xl font-black text-emerald-600">{{ $availableCount }}</p>
                            <p class="mt-1 text-xs text-slate-400">Siap dipesan</p>
                        </div>
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 font-black text-emerald-600">✓</div>
                    </div>
                </div>

                <div class="dashboard-card rounded-3xl border border-slate-200 bg-white p-6">
                    <p class="text-sm font-semibold text-slate-500">Sedang Disewa</p>
                    <div class="mt-3 flex items-end justify-between">
                        <div>
                            <p class="text-3xl font-black text-amber-500">{{ $unavailableCount }}</p>
                            <p class="mt-1 text-xs text-slate-400">Belum tersedia</p>
                        </div>
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-50 text-amber-500">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-6 w-6"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
                        </div>
                    </div>
                </div>

                <div class="dashboard-card rounded-3xl border border-slate-200 bg-white p-6">
                    <p class="text-sm font-semibold text-slate-500">Sistem Pemesanan</p>
                    <div class="mt-3 flex items-end justify-between">
                        <div>
                            <p class="text-2xl font-black text-slate-950">Charter</p>
                            <p class="mt-1 text-xs text-slate-400">Sewa satu unit</p>
                        </div>
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-6 w-6"><path d="M3 5h18v14H3z"/><path d="M3 10h18"/></svg>
                        </div>
                    </div>
                </div>
            </section>

            {{-- ARMADA LIST --}}
            <section id="pilih-armada" class="mt-12">
                <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
                    <div>
                        <p class="text-xs font-black uppercase tracking-[.18em] text-sky-600">Armada VikensaTrans</p>
                        <h2 class="mt-2 text-2xl font-black tracking-tight text-slate-950 sm:text-3xl">Pilih Armada Anda</h2>
                        <p class="mt-2 max-w-2xl text-sm leading-7 text-slate-500">Pilih unit kendaraan yang masih tersedia. Detail kota jemput, tujuan, serta waktu keberangkatan akan diisi pada form pemesanan.</p>
                    </div>
                    <div class="inline-flex w-fit items-center gap-2 rounded-full bg-white px-4 py-2 text-xs font-bold text-slate-500 ring-1 ring-slate-200">
                        <span class="h-2 w-2 rounded-full bg-emerald-500"></span> {{ $availableCount }} unit tersedia
                    </div>
                </div>

                <div class="mt-7 grid gap-7 xl:grid-cols-2">
                    @forelse($schedules as $schedule)
                        @php
                            $firstPhoto = $schedule->shuttle->photos->first();
                            $vehicleImage = $firstPhoto ? asset('storage/' . $firstPhoto->photo_path) : asset('images/v01.jpeg');
                        @endphp

                                <article class="dashboard-card relative flex flex-col overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm transition-all duration-300" :class="showGallery ? '!transform-none !shadow-sm pointer-events-auto' : ''" x-data="{ showGallery: false }">                            <div class="relative h-[240px] shrink-0 overflow-hidden bg-slate-200 sm:h-[280px]">
                                <img src="{{ $vehicleImage }}" alt="{{ $schedule->shuttle->name ?? 'Armada' }}" class="vehicle-image h-full w-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/5 to-transparent"></div>
                                
                                <div class="absolute left-5 top-5 rounded-full bg-white/95 px-4 py-2 text-xs font-black text-slate-800 shadow-lg">
                                    Unit {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                </div>

                                @if($schedule->is_available)
                                    <div class="absolute right-5 top-5 inline-flex items-center gap-2 rounded-full bg-emerald-500 px-4 py-2 text-xs font-black text-white shadow-lg">
                                        <span class="h-2 w-2 rounded-full bg-white"></span>Tersedia
                                    </div>
                                @else
                                    <div class="absolute right-5 top-5 inline-flex items-center gap-2 rounded-full bg-red-500 px-4 py-2 text-xs font-black text-white shadow-lg">
                                        <span class="h-2 w-2 rounded-full bg-white"></span>Disewa
                                    </div>
                                @endif

                                <div class="absolute bottom-5 left-5 right-5">
                                    <p class="text-xs font-bold uppercase tracking-[.15em] text-sky-300">VikensaTrans</p>
                                    <h3 class="mt-1 text-2xl font-black text-white">{{ $schedule->shuttle->name ?? 'Armada' }}</h3>
                                </div>
                            </div>

                            {{-- CARD CONTENT --}}
                            <div class="flex flex-1 flex-col p-6 sm:p-7">
                                
                                {{-- HARGA & PLAT --}}
                                <div class="flex items-start justify-between gap-4 border-b border-slate-100 pb-5">
                                    <div>
                                        <p class="text-xs font-semibold text-slate-400">Harga Dasar</p>
                                        <p class="mt-1 text-2xl font-black text-sky-600">Rp {{ number_format($schedule->price, 0, ',', '.') }}</p>
                                        <p class="mt-1 text-xs text-slate-400">Sewa satu unit</p>
                                    </div>
                                    <div class="rounded-2xl bg-slate-50 px-4 py-3 text-right">
                                        <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Plat Nomor</p>
                                        <p class="mt-1 text-sm font-black text-slate-900">{{ $schedule->shuttle->license_plate ?? '-' }}</p>
                                    </div>
                                </div>

                                {{-- DESKRIPSI OTOMATIS --}}
                                <div class="mt-5">
                                    <p class="text-sm leading-6 text-slate-500">
                                        Armada <span class="font-bold text-slate-700">{{ $schedule->shuttle->name }}</span> ini memiliki kapasitas maksimal <span class="font-bold text-slate-700">{{ $schedule->shuttle->seat_capacity }} orang penumpang</span>. Kendaraan ini sangat cocok dan nyaman untuk menemani perjalanan Anda dengan rute fleksibel yang bisa ditentukan sendiri.
                                    </p>
                                </div>

                                {{-- INFORMASI DETAIL KARTU --}}
                                <div class="mt-6 grid gap-3 sm:grid-cols-2">
                                    <div class="flex items-center gap-3 rounded-2xl bg-slate-50 p-4">
                                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white text-sky-600 shadow-sm">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5"><circle cx="9" cy="8" r="3"/><circle cx="17" cy="9" r="2"/><path d="M3 20c0-4 2-7 6-7s6 3 6 7"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Kapasitas</p>
                                            <p class="mt-1 text-sm font-black text-slate-900">{{ $schedule->shuttle->seat_capacity ?? '-' }} Penumpang</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-3 rounded-2xl bg-slate-50 p-4">
                                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white text-sky-600 shadow-sm">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5"><path d="M12 22s7-5 7-12a7 7 0 1 0-14 0c0 7 7 12 7 12Z"/><circle cx="12" cy="10" r="2"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Rute</p>
                                            <p class="mt-1 text-sm font-black text-slate-900">Fleksibel</p>
                                        </div>
                                    </div>
                                </div>

                                {{-- TOMBOL LIHAT FOTO LENGKAP --}}
                                <div class="mt-4">
                                    <button @click="showGallery = true" type="button" class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-sky-50 px-5 py-3 text-sm font-bold text-sky-600 transition hover:bg-sky-100">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
                                        Lihat Foto Unit ({{ $schedule->shuttle->photos->count() }} Foto)
                                    </button>
                                </div>

                                {{-- SPACER --}}
                                <div class="mt-auto pt-6"></div>

                                {{-- TOMBOL PESAN --}}
                                <div>
                                    @if($schedule->is_available)
                                        <a href="{{ route('book.create', $schedule->id) }}" class="group flex w-full items-center justify-center gap-3 rounded-2xl bg-slate-950 px-6 py-4 text-sm font-black text-white shadow-xl shadow-slate-900/10 transition hover:-translate-y-0.5 hover:bg-sky-600">
                                            Pesan Unit Ini
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5 transition group-hover:translate-x-1"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg>
                                        </a>
                                    @else
                                        <button type="button" disabled class="flex w-full cursor-not-allowed items-center justify-center gap-2 rounded-2xl bg-slate-100 px-6 py-4 text-sm font-black text-slate-400">
                                            Unit Sedang Disewa
                                        </button>
                                    @endif
                                </div>

                            </div>

                            {{-- MODAL GALERI FOTO (DIBUNGKUS DALAM CONTAINER FIXED AGAR MUNCUL FULL SCREEN DI ATAS LAYAR) --}}
                            <div x-show="showGallery" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/80 p-4 backdrop-blur-sm" x-transition>
                                <div @click.outside="showGallery = false" class="flex w-full max-w-4xl flex-col overflow-hidden rounded-3xl bg-white p-6 shadow-2xl sm:max-h-[90vh]">
                                    <div class="mb-4 flex shrink-0 items-center justify-between border-b border-slate-100 pb-4">
                                        <div>
                                            <h3 class="text-xl font-black text-slate-800">Galeri Foto Unit</h3>
                                            <p class="text-sm text-slate-500">{{ $schedule->shuttle->name ?? 'Armada' }} — {{ $schedule->shuttle->license_plate ?? '-' }}</p>
                                        </div>
                                        <button @click="showGallery = false" type="button" class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 font-bold text-slate-500 transition hover:bg-red-100 hover:text-red-500">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5"><path d="M18 6L6 18M6 6l12 12"></path></svg>
                                        </button>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 gap-4 overflow-y-auto p-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                                        @forelse($schedule->shuttle->photos ?? [] as $photo)
                                            <div class="group relative aspect-square overflow-hidden rounded-2xl border border-slate-200 bg-slate-100">
                                                <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="Foto {{ $schedule->shuttle->name }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-110">
                                            </div>
                                        @empty
                                            <div class="col-span-full rounded-2xl border border-dashed border-slate-200 bg-slate-50 py-12 text-center">
                                                <p class="font-bold text-slate-400">Belum ada foto yang diunggah untuk unit ini.</p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>

                        </article>

                        {{-- MODAL GALERI FOTO (DIPINDAH KELUAR DI BAWAH ARTICLE AGAR MUNCUL FULL SCREEN DENGAN MULUS) --}}
                        <div x-show="showGallery" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/80 p-4 backdrop-blur-sm" x-transition>
                            <div @click.outside="showGallery = false" class="flex w-full max-w-4xl flex-col overflow-hidden rounded-3xl bg-white p-6 shadow-2xl sm:max-h-[90vh]">
                                <div class="mb-4 flex shrink-0 items-center justify-between border-b border-slate-100 pb-4">
                                    <div>
                                        <h3 class="text-xl font-black text-slate-800">Galeri Foto Unit</h3>
                                        <p class="text-sm text-slate-500">{{ $schedule->shuttle->name ?? 'Armada' }} — {{ $schedule->shuttle->license_plate ?? '-' }}</p>
                                    </div>
                                    <button @click="showGallery = false" type="button" class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 font-bold text-slate-500 transition hover:bg-red-100 hover:text-red-500">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5"><path d="M18 6L6 18M6 6l12 12"></path></svg>
                                    </button>
                                </div>
                                
                                <div class="grid grid-cols-1 gap-4 overflow-y-auto p-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                                    @forelse($schedule->shuttle->photos ?? [] as $photo)
                                        <div class="group relative aspect-square overflow-hidden rounded-2xl border border-slate-200 bg-slate-100">
                                            <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="Foto {{ $schedule->shuttle->name }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-110">
                                        </div>
                                    @empty
                                        <div class="col-span-full rounded-2xl border border-dashed border-slate-200 bg-slate-50 py-12 text-center">
                                            <p class="font-bold text-slate-400">Belum ada foto yang diunggah untuk unit ini.</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                    @empty
                        <div class="col-span-full rounded-[2rem] border border-dashed border-slate-300 bg-white px-6 py-16 text-center">
                            <h3 class="text-xl font-black text-slate-950">Armada belum tersedia</h3>
                            <p class="mt-2 text-sm text-slate-400">Silakan tambahkan unit armada baru melalui panel admin.</p>
                        </div>
                    @endforelse
                </div>
            </section>

            {{-- HOW TO BOOK --}}
            <section class="mt-12 grid gap-6 lg:grid-cols-[1.35fr_.65fr]">
                <div class="rounded-[2rem] border border-slate-200 bg-white p-6 sm:p-8">
                    <p class="text-xs font-black uppercase tracking-[.18em] text-sky-600">Cara Pemesanan</p>
                    <h3 class="mt-2 text-2xl font-black text-slate-950">Tiga langkah menuju perjalananmu.</h3>

                    <div class="mt-7 grid gap-4 sm:grid-cols-3">
                        <div class="rounded-2xl bg-slate-50 p-5">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-950 text-sm font-black text-white">01</div>
                            <h4 class="mt-5 font-black">Pilih Armada</h4>
                            <p class="mt-2 text-xs leading-6 text-slate-500">Pilih unit kendaraan yang tersedia sesuai kebutuhan Anda.</p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-5">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-950 text-sm font-black text-white">02</div>
                            <h4 class="mt-5 font-black">Isi Perjalanan</h4>
                            <p class="mt-2 text-xs leading-6 text-slate-500">Tentukan lokasi jemput, tujuan, serta waktu perjalanan.</p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-5">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-950 text-sm font-black text-white">03</div>
                            <h4 class="mt-5 font-black">Bayar</h4>
                            <p class="mt-2 text-xs leading-6 text-slate-500">Selesaikan pembayaran dan cek status pesanan.</p>
                        </div>
                    </div>
                </div>

                <div class="relative overflow-hidden rounded-[2rem] bg-sky-600 p-7 text-white sm:p-8">
                    <div class="absolute -right-16 -top-16 h-48 w-48 rounded-full bg-white/10"></div>
                    <div class="relative">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/15">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-6 w-6"><path d="M3 12a9 9 0 1 0 3-6.7"/><path d="M3 4v6h6"/><path d="M12 7v5l3 2"/></svg>
                        </div>
                        <h3 class="mt-8 text-2xl font-black">Sudah pernah memesan?</h3>
                        <p class="mt-3 text-sm leading-7 text-sky-100">Cek status pembayaran dan seluruh riwayat perjalanan VikensaTrans milikmu.</p>
                        <a href="{{ route('riwayat') }}" class="mt-7 inline-flex items-center gap-2 rounded-xl bg-white px-5 py-3 text-sm font-black text-sky-600 transition hover:-translate-y-0.5">
                            Lihat Riwayat →
                        </a>
                    </div>
                </div>
            </section>

            {{-- FOOTER --}}
            <footer class="mt-12 border-t border-slate-200 py-7">
                <div class="flex flex-col gap-3 text-xs text-slate-400 sm:flex-row sm:items-center sm:justify-between">
                    <p>© {{ date('Y') }} VikensaTrans. All rights reserved.</p>
                    <p>Your Journey, Our Priority.</p>
                </div>
            </footer>
        </div>
    </main>
</div>

</body>
</html>