<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="VikensaTrans - Layanan travel dan shuttle nyaman, aman, dan terpercaya untuk perjalanan wisata, keluarga, bisnis, dan rombongan.">
    <title>VikensaTrans - Your Journey, Our Priority</title>

    {{-- FAVICON --}}
    <link rel="icon" type="image/png" href="{{ asset('images/vikensa_trans_logo.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
        body { font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; }
        
        .hero-grid {
            background-image:
                linear-gradient(rgba(255,255,255,.035) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.035) 1px, transparent 1px);
            background-size: 45px 45px;
        }

        .glass {
            background: rgba(255, 255, 255, .075);
            border: 1px solid rgba(255, 255, 255, .12);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
        }

        .shadow-soft { box-shadow: 0 24px 80px rgba(15, 23, 42, .10); }

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

        ::selection { background: #0ea5e9; color: white; }
    </style>
</head>

<body class="bg-slate-50 text-slate-900 antialiased" x-data="{ mobileMenu: false }">

{{-- ========================================================= --}}
{{-- NAVBAR --}}
{{-- ========================================================= --}}
<header
    x-data="{
        lastScroll: 0,
        navbarHidden: false,
        handleScroll() {
            const currentScroll = window.pageYOffset;
            if (currentScroll <= 80) { this.navbarHidden = false; }
            else if (currentScroll > this.lastScroll) { this.navbarHidden = true; this.mobileMenu = false; }
            else { this.navbarHidden = false; }
            this.lastScroll = currentScroll;
        }
    }"
    @scroll.window="handleScroll()"
    :class="navbarHidden ? '-translate-y-full' : 'translate-y-0'"
    class="fixed inset-x-0 top-0 z-50 transition-transform duration-300 ease-in-out"
>
    <nav class="mx-auto w-full max-w-6xl rounded-b-2xl rounded-br-3xl bg-gradient-to-r from-slate-900 via-slate-800 to-blue-600 shadow-lg flex h-16 items-center justify-between px-6">
        
        {{-- LOGO --}}
        <a href="#home" class="group flex shrink-0 items-center gap-3" aria-label="VikensaTrans">
            <img src="{{ asset('images/vikensa_trans_logo.png') }}" alt="VikensaTrans" class="h-10 w-auto max-w-[180px] object-contain sm:h-12">
            <span class="hidden text-[9px] font-semibold uppercase tracking-[0.22em] text-slate-400 sm:block">
                Your Journey, Our Priority.
            </span>
        </a>

        {{-- DESKTOP MENU --}}
        <div class="hidden items-center gap-8 lg:flex">
            <a href="#home" class="text-sm font-medium text-white transition duration-200 hover:text-sky-200">Beranda</a>
            <a href="#armada" class="text-sm font-medium text-white transition duration-200 hover:text-sky-200">Armada</a>
            <a href="#keunggulan" class="text-sm font-medium text-white transition duration-200 hover:text-sky-200">Keunggulan</a>
            <a href="#cara-pesan" class="text-sm font-medium text-white transition duration-200 hover:text-sky-200">Cara Pesan</a>
            <a href="#faq" class="text-sm font-medium text-white transition duration-200 hover:text-sky-200">FAQ</a>
        </div>

        {{-- DESKTOP LOGIN / REGISTER --}}
        <div class="hidden items-center gap-3 lg:flex">
            @auth
                <a href="{{ route('dashboard') }}" class="rounded-xl bg-sky-500 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-sky-500/20 transition duration-200 hover:bg-sky-400">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="px-4 py-3 text-sm font-semibold text-white transition duration-200 hover:text-sky-400">
                    Masuk
                </a>
                <a href="{{ route('register') }}" class="rounded-xl bg-sky-500 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-sky-500/20 transition duration-200 hover:-translate-y-0.5 hover:bg-sky-400">
                    Daftar Sekarang
                </a>
            @endauth
        </div>

        {{-- MOBILE MENU BUTTON --}}
        <button @click="mobileMenu = !mobileMenu" type="button" class="flex h-11 w-11 items-center justify-center rounded-xl text-white transition hover:bg-white/10 lg:hidden" aria-label="Menu">
            <svg x-show="!mobileMenu" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" class="h-7 w-7"><path d="M4 6h16"/><path d="M4 12h16"/><path d="M4 18h16"/></svg>
            <svg x-show="mobileMenu" x-cloak viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" class="h-7 w-7"><path d="M6 6l12 12"/><path d="M18 6L6 18"/></svg>
        </button>
    </nav>

    {{-- MOBILE MENU --}}
    <div x-show="mobileMenu" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2" class="border-t border-white/10 bg-slate-950 px-5 pb-6 pt-3 shadow-2xl lg:hidden">
        <div class="flex flex-col">
            <a @click="mobileMenu = false" href="#home" class="border-b border-white/10 py-4 font-semibold text-slate-300 transition hover:text-sky-400">Beranda</a>
            <a @click="mobileMenu = false" href="#armada" class="border-b border-white/10 py-4 font-semibold text-slate-300 transition hover:text-sky-400">Armada</a>
            <a @click="mobileMenu = false" href="#keunggulan" class="border-b border-white/10 py-4 font-semibold text-slate-300 transition hover:text-sky-400">Keunggulan</a>
            <a @click="mobileMenu = false" href="#cara-pesan" class="border-b border-white/10 py-4 font-semibold text-slate-300 transition hover:text-sky-400">Cara Pesan</a>
            <a @click="mobileMenu = false" href="#faq" class="py-4 font-semibold text-slate-300 transition hover:text-sky-400">FAQ</a>
        </div>
        <div class="mt-4 grid grid-cols-2 gap-3">
            @auth
                <a href="{{ route('dashboard') }}" class="col-span-2 rounded-xl bg-sky-500 px-5 py-3 text-center font-bold text-white transition hover:bg-sky-400">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="rounded-xl border border-white/20 px-5 py-3 text-center font-bold text-white transition hover:bg-white/10">Masuk</a>
                <a href="{{ route('register') }}" class="rounded-xl bg-sky-500 px-5 py-3 text-center font-bold text-white transition hover:bg-sky-400">Daftar</a>
            @endauth
        </div>
    </div>
</header>

<main>

{{-- ========================================================= --}}
{{-- HERO --}}
{{-- ========================================================= --}}
<section id="home" class="relative min-h-screen overflow-hidden bg-slate-950 text-white" style="background-image: url('{{ asset('images/main foto.jpeg') }}'); background-size: cover; background-position: center;">
    <div class="absolute inset-0 bg-slate-950/60"></div>
    <div class="relative mx-auto max-w-7xl px-5 py-28 sm:py-32 lg:py-36">
        <div class="max-w-2xl mx-auto text-center">
            <div class="inline-flex items-center gap-2 rounded-full bg-white/5 px-4 py-2 text-sm font-semibold text-sky-200 mb-6">
                <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                Armada siap menemani perjalananmu
            </div>
            <h1 class="text-4xl font-extrabold leading-tight tracking-tight sm:text-5xl lg:text-6xl">
                Perjalanan nyaman, <span class="block text-sky-400">tanpa ribet.</span>
            </h1>
            <p class="mt-5 text-lg text-slate-200">
                Bersama VikensaTrans, nikmati perjalanan yang aman, nyaman, dan terpercaya untuk wisata, keluarga, bisnis maupun rombongan.
            </p>
            <div class="mt-8 flex justify-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="rounded-2xl bg-sky-500 px-6 py-3 font-bold text-white shadow-lg">Pilih Armada</a>
                @else
                    <a href="{{ route('register') }}" class="rounded-2xl bg-sky-500 px-6 py-3 font-bold text-white shadow-lg">Mulai Perjalanan</a>
                @endauth
                <a href="#armada" class="rounded-2xl border border-white/20 bg-white/5 px-6 py-3 font-bold text-white">Lihat Armada</a>
            </div>
        </div>
    </div>
</section>

{{-- ========================================================= --}}
{{-- STATISTICS --}}
{{-- ========================================================= --}}
<section class="relative z-20">
    <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">
        <div class="grid gap-px overflow-hidden rounded-3xl border border-slate-200 bg-slate-200 shadow-soft sm:grid-cols-2 lg:grid-cols-4">
            <div class="bg-white px-7 py-7 text-center">
                <p class="text-3xl font-black text-slate-950">3+</p>
                <p class="mt-1 text-sm font-medium text-slate-500">Pilihan Armada</p>
            </div>
            <div class="bg-white px-7 py-7 text-center">
                <p class="text-3xl font-black text-slate-950">100%</p>
                <p class="mt-1 text-sm font-medium text-slate-500">Booking Online</p>
            </div>
            <div class="bg-white px-7 py-7 text-center">
                <p class="text-3xl font-black text-slate-950">24/7</p>
                <p class="mt-1 text-sm font-medium text-slate-500">Akses Pemesanan</p>
            </div>
            <div class="bg-white px-7 py-7 text-center">
                <p class="text-3xl font-black text-slate-950">Easy</p>
                <p class="mt-1 text-sm font-medium text-slate-500">Pembayaran</p>
            </div>
        </div>
    </div>
</section>

{{-- ========================================================= --}}
{{-- ARMADA (DISERAGAMKAN DENGAN DASHBOARD USER) --}}
{{-- ========================================================= --}}
<section id="armada" class="py-24 sm:py-28">
    <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl text-center">
            <span class="inline-flex rounded-full bg-sky-100 px-4 py-2 text-xs font-black uppercase tracking-[.18em] text-sky-700">
                Armada VikensaTrans
            </span>
            <h2 class="mt-5 text-4xl font-black tracking-tight text-slate-950 sm:text-5xl">
                Armada nyaman untuk <span class="text-sky-600">perjalananmu.</span>
            </h2>
            <p class="mt-5 text-base leading-8 text-slate-600">
                VikensaTrans memiliki beberapa unit kendaraan yang siap menemani perjalanan wisata, keluarga, bisnis, maupun rombongan.
            </p>
        </div>

        <div class="mx-auto mt-14 grid max-w-6xl grid-cols-1 gap-7 xl:grid-cols-2">
            @forelse($schedules as $schedule)
                @php
                    $firstPhoto = $schedule->shuttle->photos->first();
                    $vehicleImage = $firstPhoto ? asset('storage/' . $firstPhoto->photo_path) : asset('images/v01.jpeg');
                @endphp

                <article class="dashboard-card relative flex flex-col overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm transition-all duration-300" :class="showGallery ? '!transform-none !shadow-sm pointer-events-auto' : ''" x-data="{ showGallery: false }">
                    
                    {{-- FOTO UTAMA --}}
                    <div class="relative h-[240px] shrink-0 overflow-hidden bg-slate-200 sm:h-[280px]">
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

                        {{-- TOMBOL PESAN / PILIH --}}
                        <div>
                            @if($schedule->is_available)
                                @auth
                                    <a href="{{ route('dashboard') }}" class="group flex w-full items-center justify-center gap-3 rounded-2xl bg-slate-950 px-6 py-4 text-sm font-black text-white shadow-xl shadow-slate-900/10 transition hover:-translate-y-0.5 hover:bg-sky-600">
                                        Pilih Armada
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5 transition group-hover:translate-x-1"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg>
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="group flex w-full items-center justify-center gap-3 rounded-2xl bg-slate-950 px-6 py-4 text-sm font-black text-white shadow-xl shadow-slate-900/10 transition hover:-translate-y-0.5 hover:bg-sky-600">
                                        Pesan Sekarang
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5 transition group-hover:translate-x-1"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg>
                                    </a>
                                @endauth
                            @else
                                <button type="button" disabled class="flex w-full cursor-not-allowed items-center justify-center gap-2 rounded-2xl bg-slate-100 px-6 py-4 text-sm font-black text-slate-400">
                                    Unit Sedang Disewa
                                </button>
                            @endif
                        </div>

                    </div>

                    {{-- MODAL GALERI FOTO --}}
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
            @empty
                <div class="col-span-full py-10 text-center">
                    <p class="font-bold text-slate-500">Belum ada armada yang tersedia saat ini.</p>
                </div>
            @endforelse
            
        </div>
    </div>
</section>

{{-- ========================================================= --}}
{{-- KEUNGGULAN --}}
{{-- ========================================================= --}}
<section id="keunggulan" class="overflow-hidden bg-slate-950 py-24 text-white sm:py-28">
    <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">
        <div class="grid gap-14 lg:grid-cols-[.8fr_1.2fr] lg:items-center">
            {{-- LEFT --}}
            <div>
                <span class="inline-flex rounded-full bg-sky-400/10 px-4 py-2 text-xs font-black uppercase tracking-[.18em] text-sky-300">
                    Kenapa VikensaTrans?
                </span>
                <h2 class="mt-5 text-4xl font-black tracking-tight sm:text-5xl">
                    Bukan hanya sampai tujuan.
                    <span class="text-sky-400">Perjalanan juga harus nyaman.</span>
                </h2>
                <p class="mt-6 max-w-xl leading-8 text-slate-400">
                    VikensaTrans membuat proses pemesanan kendaraan menjadi lebih sederhana, mulai dari memilih armada hingga proses pembayaran.
                </p>
                @auth
                    <a href="{{ route('dashboard') }}" class="mt-8 inline-flex rounded-xl bg-sky-500 px-6 py-4 font-bold transition hover:bg-sky-400">Cek Armada Sekarang →</a>
                @else
                    <a href="{{ route('register') }}" class="mt-8 inline-flex rounded-xl bg-sky-500 px-6 py-4 font-bold transition hover:bg-sky-400">Daftar Sekarang →</a>
                @endauth
            </div>

            {{-- RIGHT --}}
            <div class="grid gap-4 sm:grid-cols-2">
                {{-- CARD 1 --}}
                <div class="group rounded-3xl border border-white/10 bg-white/[.05] p-7 transition hover:-translate-y-1 hover:bg-white/[.09]">
                    <span class="text-sm font-black tracking-wider text-sky-400">01</span>
                    <h3 class="mt-8 text-xl font-black">Pilihan Armada</h3>
                    <p class="mt-3 text-sm leading-7 text-slate-400">Pilih kendaraan sesuai jumlah penumpang dan kebutuhan perjalanan.</p>
                </div>
                {{-- CARD 2 --}}
                <div class="group rounded-3xl border border-white/10 bg-white/[.05] p-7 transition hover:-translate-y-1 hover:bg-white/[.09]">
                    <span class="text-sm font-black tracking-wider text-sky-400">02</span>
                    <h3 class="mt-8 text-xl font-black">Harga Transparan</h3>
                    <p class="mt-3 text-sm leading-7 text-slate-400">Informasi biaya perjalanan dapat dilihat sebelum melakukan pemesanan.</p>
                </div>
                {{-- CARD 3 --}}
                <div class="group rounded-3xl border border-white/10 bg-white/[.05] p-7 transition hover:-translate-y-1 hover:bg-white/[.09]">
                    <span class="text-sm font-black tracking-wider text-sky-400">03</span>
                    <h3 class="mt-8 text-xl font-black">Booking Online</h3>
                    <p class="mt-3 text-sm leading-7 text-slate-400">Pemesanan dapat dilakukan langsung melalui website dengan proses yang sederhana.</p>
                </div>
                {{-- CARD 4 --}}
                <div class="group rounded-3xl border border-white/10 bg-white/[.05] p-7 transition hover:-translate-y-1 hover:bg-white/[.09]">
                    <span class="text-sm font-black tracking-wider text-sky-400">04</span>
                    <h3 class="mt-8 text-xl font-black">Pembayaran Praktis</h3>
                    <p class="mt-3 text-sm leading-7 text-slate-400">Proses pembayaran terintegrasi sehingga transaksi menjadi lebih mudah.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ========================================================= --}}
{{-- CARA PESAN --}}
{{-- ========================================================= --}}
<section id="cara-pesan" class="bg-white py-24 sm:py-28">
    <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl text-center">
            <span class="inline-flex rounded-full bg-sky-100 px-4 py-2 text-xs font-black uppercase tracking-[.18em] text-sky-700">Cara Pemesanan</span>
            <h2 class="mt-5 text-4xl font-black tracking-tight sm:text-5xl">Empat langkah, <span class="text-sky-600">langsung jalan.</span></h2>
            <p class="mt-5 leading-8 text-slate-600">Proses pemesanan VikensaTrans dibuat sederhana agar perjalanan dapat direncanakan dengan cepat.</p>
        </div>

        <div class="relative mt-16">
            <div class="absolute left-[12%] right-[12%] top-9 hidden h-px bg-slate-200 lg:block"></div>
            <div class="relative grid gap-8 md:grid-cols-2 lg:grid-cols-4">
                {{-- STEP 1 --}}
                <div class="relative text-center">
                    <div class="relative z-10 mx-auto flex h-[72px] w-[72px] items-center justify-center rounded-2xl bg-slate-950 text-lg font-black text-white shadow-xl">01</div>
                    <h3 class="mt-7 text-xl font-black">Masuk / Daftar</h3>
                    <p class="mx-auto mt-3 max-w-[250px] text-sm leading-7 text-slate-500">Buat akun atau masuk ke akun VikensaTrans.</p>
                </div>
                {{-- STEP 2 --}}
                <div class="relative text-center">
                    <div class="relative z-10 mx-auto flex h-[72px] w-[72px] items-center justify-center rounded-2xl bg-slate-950 text-lg font-black text-white shadow-xl">02</div>
                    <h3 class="mt-7 text-xl font-black">Pilih Armada</h3>
                    <p class="mx-auto mt-3 max-w-[250px] text-sm leading-7 text-slate-500">Pilih kendaraan dan jadwal sesuai kebutuhan.</p>
                </div>
                {{-- STEP 3 --}}
                <div class="relative text-center">
                    <div class="relative z-10 mx-auto flex h-[72px] w-[72px] items-center justify-center rounded-2xl bg-slate-950 text-lg font-black text-white shadow-xl">03</div>
                    <h3 class="mt-7 text-xl font-black">Isi Data</h3>
                    <p class="mx-auto mt-3 max-w-[250px] text-sm leading-7 text-slate-500">Lengkapi informasi pemesanan perjalananmu.</p>
                </div>
                {{-- STEP 4 --}}
                <div class="relative text-center">
                    <div class="relative z-10 mx-auto flex h-[72px] w-[72px] items-center justify-center rounded-2xl bg-slate-950 text-lg font-black text-white shadow-xl">04</div>
                    <h3 class="mt-7 text-xl font-black">Bayar</h3>
                    <p class="mx-auto mt-3 max-w-[250px] text-sm leading-7 text-slate-500">Selesaikan pembayaran dan cek status pesanan.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ========================================================= --}}
{{-- JENIS PERJALANAN --}}
{{-- ========================================================= --}}
<section class="bg-slate-100 py-24">
    <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">
        <div class="flex flex-col justify-between gap-6 lg:flex-row lg:items-end">
            <div class="max-w-2xl">
                <p class="text-sm font-black uppercase tracking-[.2em] text-sky-600">Untuk berbagai kebutuhan</p>
                <h2 class="mt-4 text-4xl font-black sm:text-5xl">Satu perjalanan, <span class="text-slate-400">banyak cerita.</span></h2>
            </div>
            <p class="max-w-md leading-7 text-slate-600">Dari liburan keluarga sampai perjalanan perusahaan, VikensaTrans siap menemani perjalananmu.</p>
        </div>

        <div class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
            {{-- FAMILY TRIP --}}
            <div class="relative min-h-[340px] overflow-hidden rounded-[2rem] bg-sky-600 p-7 text-white">
                <div class="absolute -right-10 -top-10 h-48 w-48 rounded-full bg-white/10"></div>
                <div class="relative flex h-full flex-col justify-between">
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white/15">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-7 w-7"><circle cx="9" cy="7" r="3"/><circle cx="17" cy="8" r="2"/><path d="M3 20c0-4 2-7 6-7s6 3 6 7"/><path d="M15 14c3 0 5 2 5 6"/></svg>
                    </div>
                    <div class="mt-28">
                        <p class="text-sm font-bold text-sky-100">Untuk orang tersayang</p>
                        <h3 class="mt-2 text-2xl font-black">Family Trip</h3>
                        <p class="mt-3 text-sm leading-6 text-sky-100">Perjalanan keluarga lebih nyaman dengan ruang kendaraan yang lega.</p>
                    </div>
                </div>
            </div>

            {{-- COMPANY TRIP --}}
            <div class="relative min-h-[340px] overflow-hidden rounded-[2rem] bg-slate-900 p-7 text-white">
                <div class="absolute -right-10 -top-10 h-48 w-48 rounded-full bg-white/5"></div>
                <div class="relative flex h-full flex-col justify-between">
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white/10">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-7 w-7"><rect x="3" y="7" width="18" height="13" rx="2"/><path d="M8 7V4h8v3M3 12h18"/></svg>
                    </div>
                    <div class="mt-28">
                        <p class="text-sm font-bold text-slate-400">Perjalanan bisnis</p>
                        <h3 class="mt-2 text-2xl font-black">Company Trip</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-400">Cocok untuk meeting, acara perusahaan dan perjalanan tim.</p>
                    </div>
                </div>
            </div>

            {{-- AIRPORT --}}
            <div class="relative min-h-[340px] overflow-hidden rounded-[2rem] bg-white p-7">
                <div class="absolute -right-10 -top-10 h-48 w-48 rounded-full bg-sky-100"></div>
                <div class="relative flex h-full flex-col justify-between">
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-sky-100 text-sky-600">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-7 w-7"><path d="M2 16l20-5-1-3-8 1-5-6-2 1 3 6-5 1-2-2-2 1Z"/><path d="M3 21h18"/></svg>
                    </div>
                    <div class="mt-28">
                        <p class="text-sm font-bold text-sky-600">Perjalanan bandara</p>
                        <h3 class="mt-2 text-2xl font-black">Airport Transfer</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-500">Transportasi untuk perjalanan menuju atau dari bandara.</p>
                    </div>
                </div>
            </div>

            {{-- GROUP TOUR --}}
            <div class="relative min-h-[340px] overflow-hidden rounded-[2rem] bg-indigo-600 p-7 text-white">
                <div class="absolute -right-10 -top-10 h-48 w-48 rounded-full bg-white/10"></div>
                <div class="relative flex h-full flex-col justify-between">
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white/15">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-7 w-7"><path d="M3 11l9-7 9 7"/><path d="M5 10v10h14V10"/><path d="M9 20v-6h6v6"/></svg>
                    </div>
                    <div class="mt-28">
                        <p class="text-sm font-bold text-indigo-200">Jelajahi bersama</p>
                        <h3 class="mt-2 text-2xl font-black">Group Tour</h3>
                        <p class="mt-3 text-sm leading-6 text-indigo-100">Pilihan ideal untuk wisata dan perjalanan bersama rombongan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ========================================================= --}}
{{-- FAQ --}}
{{-- ========================================================= --}}
<section id="faq" class="bg-white py-24 sm:py-28">
    <div class="mx-auto max-w-5xl px-5 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl text-center">
            <span class="inline-flex rounded-full bg-sky-100 px-4 py-2 text-xs font-black uppercase tracking-[.18em] text-sky-700">Pertanyaan Umum</span>
            <h2 class="mt-5 text-4xl font-black sm:text-5xl">Masih ada yang ingin <span class="text-sky-600">ditanyakan?</span></h2>
        </div>

        <div class="mt-14 space-y-4">
            {{-- FAQ 1 --}}
            <div x-data="{ open: false }" class="overflow-hidden rounded-2xl border border-slate-200 bg-slate-50">
                <button @click="open = !open" class="flex w-full items-center justify-between gap-5 px-6 py-6 text-left sm:px-7">
                    <div class="flex items-center gap-4">
                        <span class="text-xs font-black text-sky-600">01</span>
                        <span class="font-bold text-slate-900">Bagaimana cara melakukan pemesanan?</span>
                    </div>
                    <div :class="open ? 'rotate-45 bg-sky-600 text-white' : 'bg-white text-slate-700'" class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full shadow-sm transition">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5"><path d="M12 5v14M5 12h14"/></svg>
                    </div>
                </button>
                <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="border-t border-slate-200 px-6 py-6 text-sm leading-7 text-slate-600 sm:px-7">
                    Silakan daftar atau login terlebih dahulu. Setelah itu pilih armada dan jadwal yang tersedia, lengkapi data pemesanan, kemudian lanjutkan ke proses pembayaran.
                </div>
            </div>

            {{-- FAQ 2 --}}
            <div x-data="{ open: false }" class="overflow-hidden rounded-2xl border border-slate-200 bg-slate-50">
                <button @click="open = !open" class="flex w-full items-center justify-between gap-5 px-6 py-6 text-left sm:px-7">
                    <div class="flex items-center gap-4">
                        <span class="text-xs font-black text-sky-600">02</span>
                        <span class="font-bold text-slate-900">Apakah harus memiliki akun untuk memesan?</span>
                    </div>
                    <div :class="open ? 'rotate-45 bg-sky-600 text-white' : 'bg-white text-slate-700'" class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full shadow-sm transition">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5"><path d="M12 5v14M5 12h14"/></svg>
                    </div>
                </button>
                <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="border-t border-slate-200 px-6 py-6 text-sm leading-7 text-slate-600 sm:px-7">
                    Ya. Akun diperlukan agar data pemesanan, transaksi dan riwayat perjalanan dapat tersimpan dengan aman pada sistem VikensaTrans.
                </div>
            </div>

            {{-- FAQ 3 --}}
            <div x-data="{ open: false }" class="overflow-hidden rounded-2xl border border-slate-200 bg-slate-50">
                <button @click="open = !open" class="flex w-full items-center justify-between gap-5 px-6 py-6 text-left sm:px-7">
                    <div class="flex items-center gap-4">
                        <span class="text-xs font-black text-sky-600">03</span>
                        <span class="font-bold text-slate-900">Armada apa saja yang tersedia?</span>
                    </div>
                    <div :class="open ? 'rotate-45 bg-sky-600 text-white' : 'bg-white text-slate-700'" class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full shadow-sm transition">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5"><path d="M12 5v14M5 12h14"/></svg>
                    </div>
                </button>
                <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="border-t border-slate-200 px-6 py-6 text-sm leading-7 text-slate-600 sm:px-7">
                    VikensaTrans menyediakan beberapa pilihan armada berkualitas. Ketersediaan aktual dan fasilitasnya dapat dilihat langsung pada galeri foto masing-masing unit.
                </div>
            </div>

            {{-- FAQ 4 --}}
            <div x-data="{ open: false }" class="overflow-hidden rounded-2xl border border-slate-200 bg-slate-50">
                <button @click="open = !open" class="flex w-full items-center justify-between gap-5 px-6 py-6 text-left sm:px-7">
                    <div class="flex items-center gap-4">
                        <span class="text-xs font-black text-sky-600">04</span>
                        <span class="font-bold text-slate-900">Bagaimana mengetahui status pemesanan?</span>
                    </div>
                    <div :class="open ? 'rotate-45 bg-sky-600 text-white' : 'bg-white text-slate-700'" class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full shadow-sm transition">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5"><path d="M12 5v14M5 12h14"/></svg>
                    </div>
                </button>
                <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="border-t border-slate-200 px-6 py-6 text-sm leading-7 text-slate-600 sm:px-7">
                    Setelah login, informasi perjalanan dan status pemesanan dapat dilihat melalui dashboard atau halaman riwayat pemesanan.
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ========================================================= --}}
{{-- CTA --}}
{{-- ========================================================= --}}
<section class="px-5 pb-24 sm:px-6 lg:px-8">
    <div class="relative mx-auto max-w-7xl overflow-hidden rounded-[2.5rem] bg-sky-600 px-6 py-16 text-center text-white sm:px-12 sm:py-20">
        <div class="absolute -left-20 -top-20 h-72 w-72 rounded-full bg-white/10"></div>
        <div class="absolute -bottom-28 -right-20 h-80 w-80 rounded-full bg-slate-950/10"></div>

        <div class="relative mx-auto max-w-3xl">
            <p class="text-sm font-black uppercase tracking-[.2em] text-sky-100">VikensaTrans</p>
            <h2 class="mt-5 text-4xl font-black tracking-tight sm:text-5xl lg:text-6xl">Perjalanan berikutnya dimulai dari sini.</h2>
            <p class="mx-auto mt-6 max-w-2xl leading-8 text-sky-100">Temukan armada yang sesuai dan atur perjalananmu bersama VikensaTrans dengan proses pemesanan yang mudah.</p>

            <div class="mt-9 flex flex-col justify-center gap-3 sm:flex-row">
                @auth
                    <a href="{{ route('dashboard') }}" class="rounded-2xl bg-white px-8 py-4 font-black text-slate-950 shadow-xl transition hover:-translate-y-1">Pilih Armada</a>
                @else
                    <a href="{{ route('register') }}" class="rounded-2xl bg-white px-8 py-4 font-black text-slate-950 shadow-xl transition hover:-translate-y-1">Daftar Sekarang</a>
                    <a href="{{ route('login') }}" class="rounded-2xl border border-white/30 bg-white/10 px-8 py-4 font-black backdrop-blur transition hover:bg-white/20">Masuk</a>
                @endauth
            </div>
        </div>
    </div>
</section>

</main>

{{-- ========================================================= --}}
{{-- FOOTER --}}
{{-- ========================================================= --}}
<footer class="bg-slate-950 text-white">
    <div class="mx-auto max-w-7xl px-5 py-16 sm:px-6 lg:px-8">
        <div class="grid gap-12 lg:grid-cols-[1.4fr_.6fr_.6fr_.8fr]">
            
            {{-- FOOTER BRAND --}}
            <div class="max-w-sm">
                <a href="#home" class="inline-flex items-center">
                    <img src="{{ asset('images/vikensa_trans_logo.png') }}" alt="VikensaTrans" class="h-28 w-auto max-w-[420px] object-contain">
                </a>
                <p class="mt-6 text-sm leading-7 text-slate-400">VikensaTrans menyediakan layanan transportasi untuk perjalanan wisata, keluarga, bisnis dan berbagai kebutuhan perjalanan lainnya.</p>
            </div>

            {{-- NAVIGATION --}}
            <div>
                <h4 class="font-black">Navigasi</h4>
                <div class="mt-5 flex flex-col gap-3 text-sm text-slate-400">
                    <a href="#home" class="transition hover:text-sky-400">Beranda</a>
                    <a href="#armada" class="transition hover:text-sky-400">Armada</a>
                    <a href="#keunggulan" class="transition hover:text-sky-400">Keunggulan</a>
                    <a href="#cara-pesan" class="transition hover:text-sky-400">Cara Pesan</a>
                </div>
            </div>

            {{-- ACCOUNT --}}
            <div>
                <h4 class="font-black">Akun</h4>
                <div class="mt-5 flex flex-col gap-3 text-sm text-slate-400">
                    @auth
                        <a href="{{ route('dashboard') }}" class="transition hover:text-sky-400">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="transition hover:text-sky-400">Masuk</a>
                        <a href="{{ route('register') }}" class="transition hover:text-sky-400">Daftar</a>
                    @endauth
                    <a href="#faq" class="transition hover:text-sky-400">FAQ</a>
                </div>
            </div>

            {{-- FOOTER CTA --}}
            <div>
                <h4 class="font-black">Siap untuk perjalananmu?</h4>
                <p class="mt-5 text-sm leading-7 text-slate-400">Masuk ke akun VikensaTrans dan temukan jadwal serta armada yang tersedia.</p>
                @auth
                    <a href="{{ route('dashboard') }}" class="mt-5 inline-flex rounded-xl bg-sky-500 px-5 py-3 text-sm font-bold transition hover:bg-sky-400">Lihat Dashboard</a>
                @else
                    <a href="{{ route('register') }}" class="mt-5 inline-flex rounded-xl bg-sky-500 px-5 py-3 text-sm font-bold transition hover:bg-sky-400">Mulai Sekarang</a>
                @endauth
            </div>
        </div>

        {{-- COPYRIGHT --}}
        <div class="mt-14 flex flex-col gap-4 border-t border-white/10 pt-8 text-sm text-slate-500 sm:flex-row sm:items-center sm:justify-between">
            <p>© {{ date('Y') }} VikensaTrans. All rights reserved.</p>
            <p>Travel nyaman untuk perjalanan yang lebih menyenangkan.</p>
        </div>
    </div>
</footer>

{{-- ========================================================= --}}
{{-- BACK TO TOP --}}
{{-- ========================================================= --}}
<div x-data="{ show: false }" @scroll.window="show = window.scrollY > 600">
    <a x-show="show" x-cloak x-transition href="#home" class="fixed bottom-6 right-6 z-40 flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-950 text-white shadow-2xl transition hover:-translate-y-1 hover:bg-sky-600">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5"><path d="M12 19V5M6 11l6-6 6 6"/></svg>
    </a>
</div>

</body>
</html>