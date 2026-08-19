<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Tambah Armada & Jadwal - Administrator VikensaTrans">
    <title>Tambah Armada - VikensaTrans Admin</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
        body {
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }
        ::selection {
            background: #0ea5e9;
            color: white;
        }
        .form-card {
            box-shadow: 0 20px 60px rgba(15, 23, 42, .06);
        }
    </style>
</head>

<body class="bg-slate-100 text-slate-900 antialiased" x-data="{ sidebarOpen: false }">

{{-- MOBILE SIDEBAR OVERLAY --}}
<div x-show="sidebarOpen" x-cloak x-transition.opacity @click="sidebarOpen = false"
    class="fixed inset-0 z-40 bg-slate-950/60 backdrop-blur-sm lg:hidden"></div>

{{-- SIDEBAR --}}
<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 z-50 flex w-[285px] flex-col border-r border-white/10 bg-slate-950 text-white transition-transform duration-300 lg:translate-x-0">
    
    {{-- BRAND --}}
    <div class="flex h-24 items-center justify-between border-b border-white/10 px-6">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-sky-500 text-white shadow-lg shadow-sky-500/20">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-6 w-6">
                    <path d="M12 2 20 6v6c0 5-3.5 8.5-8 10-4.5-1.5-8-5-8-10V6Z" />
                    <path d="m9 12 2 2 4-4" />
                </svg>
            </div>
            <div>
                <p class="text-xl font-black tracking-tight text-white">Vikensa<span class="text-sky-400">Trans</span></p>
                <p class="mt-0.5 text-[9px] font-bold uppercase tracking-[.22em] text-slate-500">Administrator</p>
            </div>
        </a>
        <button @click="sidebarOpen = false" type="button" class="flex h-10 w-10 items-center justify-center rounded-xl text-slate-400 transition hover:bg-white/10 hover:text-white lg:hidden">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5"><path d="M6 6l12 12M18 6L6 18"/></svg>
        </button>
    </div>

    {{-- NAVIGATION --}}
    <nav class="flex-1 overflow-y-auto px-4 py-6">
        <p class="mb-3 px-4 text-[10px] font-black uppercase tracking-[.2em] text-slate-500">Administrasi</p>
        
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3.5 text-sm font-semibold text-slate-400 transition hover:bg-white/5 hover:text-white">
            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/5">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5">
                    <rect x="3" y="3" width="7" height="7" rx="1"/>
                    <rect x="14" y="3" width="7" height="7" rx="1"/>
                    <rect x="3" y="14" width="7" height="7" rx="1"/>
                    <rect x="14" y="14" width="7" height="7" rx="1"/>
                </svg>
            </div>
            Dashboard Admin
        </a>

        <a href="{{ route('admin.create') }}" class="mt-2 flex items-center gap-3 rounded-2xl bg-sky-500 px-4 py-3.5 text-sm font-bold text-white shadow-lg shadow-sky-500/10">
            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/15">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5"><path d="M12 5v14"/><path d="M5 12h14"/></svg>
            </div>
            Tambah Armada
        </a>

        <p class="mb-3 mt-8 px-4 text-[10px] font-black uppercase tracking-[.2em] text-slate-500">Website</p>
        
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3.5 text-sm font-semibold text-slate-400 transition hover:bg-white/5 hover:text-white">
            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/5">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-5 3-8 8-8s8 3 8 8"/></svg>
            </div>
            Dashboard User
        </a>

        <a href="{{ url('/') }}" class="mt-2 flex items-center gap-3 rounded-2xl px-4 py-3.5 text-sm font-semibold text-slate-400 transition hover:bg-white/5 hover:text-white">
            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/5">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5"><path d="m3 11 9-8 9 8"/><path d="M5 10v10h14V10"/><path d="M9 20v-6h6v6"/></svg>
            </div>
            Lihat Website
        </a>

        <div class="mt-9 rounded-3xl border border-white/10 bg-white/[.04] p-5">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-sky-500/10 text-sky-400">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5"><circle cx="12" cy="12" r="9"/><path d="M12 11v5"/><path d="M12 8h.01"/></svg>
            </div>
            <p class="mt-4 text-sm font-black text-white">Tambah Data Baru</p>
            <p class="mt-2 text-xs leading-6 text-slate-500">Armada yang ditambahkan akan tersimpan ke database bersama informasi harga dan status ketersediaannya.</p>
        </div>
    </nav>

    {{-- ADMIN PROFILE --}}
    <div class="border-t border-white/10 p-4">
        <div x-data="{ adminMenu: false }" class="relative">
            <button @click="adminMenu = !adminMenu" type="button" class="flex w-full items-center gap-3 rounded-2xl p-3 text-left transition hover:bg-white/5">
                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-sky-500 text-sm font-black uppercase text-white">
                    {{ mb_substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="min-w-0 flex-1">
                    <p class="truncate text-sm font-bold text-white">{{ Auth::user()->name }}</p>
                    <p class="mt-0.5 text-[10px] font-bold uppercase tracking-wider text-sky-400">Administrator</p>
                </div>
                <svg :class="adminMenu ? 'rotate-180' : ''" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4 text-slate-500 transition"><path d="m6 9 6 6 6-6"/></svg>
            </button>
            <div x-show="adminMenu" x-cloak x-transition @click.outside="adminMenu = false" class="absolute bottom-full left-0 right-0 mb-2 overflow-hidden rounded-2xl border border-slate-200 bg-white p-2 shadow-2xl">
                <a href="{{ route('profile.edit') }}" class="block rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">Profil Saya</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full rounded-xl px-4 py-3 text-left text-sm font-semibold text-red-500 transition hover:bg-red-50">Keluar</button>
                </form>
            </div>
        </div>
    </div>
</aside>

{{-- MAIN WRAPPER --}}
<div class="lg:pl-[285px]">
    {{-- TOP BAR --}}
    <header class="sticky top-0 z-30 flex h-20 items-center border-b border-slate-200 bg-white/90 px-5 backdrop-blur-xl sm:px-7 lg:px-10">
        <div class="flex w-full items-center justify-between gap-5">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = true" type="button" class="flex h-11 w-11 items-center justify-center rounded-xl border border-slate-200 text-slate-600 transition hover:bg-slate-50 lg:hidden">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-6 w-6"><path d="M4 6h16"/><path d="M4 12h16"/><path d="M4 18h16"/></svg>
                </button>
                <div>
                    <p class="text-xs font-semibold text-slate-400">Administrator Panel</p>
                    <h2 class="text-lg font-black text-slate-950">Tambah Armada</h2>
                </div>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-bold text-slate-600 transition hover:border-sky-200 hover:bg-sky-50 hover:text-sky-600">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4"><path d="M19 12H5"/><path d="m11 18-6-6 6-6"/></svg>
                <span class="hidden sm:inline">Kembali</span>
            </a>
        </div>
    </header>

    {{-- CONTENT --}}
    <main class="px-5 py-8 sm:px-7 lg:px-10 lg:py-10">
        <div class="mx-auto max-w-6xl">
            
            {{-- PAGE HEADING --}}
            <div class="flex flex-col justify-between gap-5 lg:flex-row lg:items-end">
                <div>
                    <div class="inline-flex items-center gap-2 rounded-full bg-sky-100 px-4 py-2 text-xs font-black uppercase tracking-[.15em] text-sky-700">
                        Data Baru
                    </div>
                    <h1 class="mt-4 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">Tambah Armada</h1>
                    <p class="mt-3 max-w-2xl text-sm leading-7 text-slate-500">Lengkapi data kendaraan dan harganya. Pastikan plat nomor belum pernah digunakan pada armada lain.</p>
                </div>
                <div class="inline-flex w-fit items-center gap-2 rounded-full bg-white px-4 py-2 text-xs font-semibold text-slate-500 shadow-sm ring-1 ring-slate-200">
                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span> Form Administrator
                </div>
            </div>

            {{-- VALIDATION ERROR SUMMARY --}}
            @if($errors->any())
                <div class="mt-7 rounded-2xl border border-red-200 bg-red-50 p-5">
                    <div class="flex items-start gap-3">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-red-100 font-black text-red-500">!</div>
                        <div>
                            <p class="font-black text-red-700">Data belum dapat disimpan</p>
                            <p class="mt-1 text-sm text-red-600">Periksa kembali beberapa input berikut:</p>
                            <ul class="mt-3 list-inside list-disc space-y-1 text-sm text-red-600">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            {{-- FORM --}}
            <form action="{{ route('admin.store') }}" method="POST" class="mt-8">
                @csrf
                <div class="grid gap-7 lg:grid-cols-[1fr_340px]">

                    {{-- LEFT FORM --}}
                    <div class="space-y-7">
                        
                        {{-- DATA ARMADA --}}
                        <section class="form-card overflow-hidden rounded-[2rem] border border-slate-200 bg-white">
                            <div class="flex items-center gap-4 border-b border-slate-100 px-6 py-5 sm:px-7">
                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-sky-50 text-sky-600">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-6 w-6"><path d="M3 13l2-5a3 3 0 0 1 2.8-2h8.4A3 3 0 0 1 19 8l2 5"/><path d="M5 13h14a2 2 0 0 1 2 2v3H3v-3a2 2 0 0 1 2-2Z"/></svg>
                                </div>
                                <div>
                                    <h2 class="text-lg font-black text-slate-950">Informasi Armada</h2>
                                    <p class="mt-1 text-xs text-slate-400">Data kendaraan yang akan ditambahkan.</p>
                                </div>
                            </div>
                            <div class="grid gap-5 p-6 sm:p-7 md:grid-cols-2">
                                <div class="md:col-span-2">
                                    <label for="shuttle_name" class="block text-sm font-bold text-slate-700">Nama Armada <span class="text-red-500">*</span></label>
                                    <div class="relative mt-2">
                                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5"><path d="M3 13l2-5a3 3 0 0 1 2.8-2h8.4A3 3 0 0 1 19 8l2 5"/><path d="M5 13h14a2 2 0 0 1 2 2v3H3v-3a2 2 0 0 1 2-2Z"/></svg>
                                        </div>
                                        <input id="shuttle_name" type="text" name="shuttle_name" value="{{ old('shuttle_name', 'Toyota Hiace') }}" placeholder="Contoh: Toyota Hiace" required
                                            class="block h-14 w-full rounded-2xl border border-slate-200 bg-slate-50 py-3 pl-12 pr-4 text-sm font-medium text-slate-900 outline-none transition placeholder:text-slate-400 hover:border-slate-300 focus:border-sky-500 focus:bg-white focus:ring-4 focus:ring-sky-500/10" />
                                    </div>
                                    @error('shuttle_name') <p class="mt-2 text-xs font-semibold text-red-500">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label for="license_plate" class="block text-sm font-bold text-slate-700">Plat Nomor <span class="text-red-500">*</span></label>
                                    <div class="relative mt-2">
                                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5"><rect x="3" y="6" width="18" height="12" rx="2"/><path d="M7 10h10M7 14h6"/></svg>
                                        </div>
                                        <input id="license_plate" type="text" name="license_plate" value="{{ old('license_plate') }}" placeholder="Contoh: KT 1234 ABC" maxlength="20" required
                                            class="block h-14 w-full rounded-2xl border border-slate-200 bg-slate-50 py-3 pl-12 pr-4 text-sm font-medium uppercase text-slate-900 outline-none transition placeholder:normal-case placeholder:text-slate-400 hover:border-slate-300 focus:border-sky-500 focus:bg-white focus:ring-4 focus:ring-sky-500/10" />
                                    </div>
                                    <p class="mt-2 text-xs text-slate-400">Plat nomor harus unik dan belum terdaftar.</p>
                                    @error('license_plate') <p class="mt-2 text-xs font-semibold text-red-500">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label for="seat_capacity" class="block text-sm font-bold text-slate-700">Kapasitas Penumpang <span class="text-red-500">*</span></label>
                                    <div class="relative mt-2">
                                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5"><circle cx="9" cy="8" r="3"/><circle cx="17" cy="9" r="2"/><path d="M3 20c0-4 2-7 6-7s6 3 6 7"/></svg>
                                        </div>
                                        <input id="seat_capacity" type="number" name="seat_capacity" value="{{ old('seat_capacity', 14) }}" placeholder="14" min="1" required
                                            class="block h-14 w-full rounded-2xl border border-slate-200 bg-slate-50 py-3 pl-12 pr-16 text-sm font-medium text-slate-900 outline-none transition focus:border-sky-500 focus:bg-white focus:ring-4 focus:ring-sky-500/10" />
                                        <span class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-xs font-semibold text-slate-400">Orang</span>
                                    </div>
                                    @error('seat_capacity') <p class="mt-2 text-xs font-semibold text-red-500">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </section>

                        {{-- PRICE & STATUS --}}
                        <section class="form-card overflow-hidden rounded-[2rem] border border-slate-200 bg-white">
                            <div class="flex items-center gap-4 border-b border-slate-100 px-6 py-5 sm:px-7">
                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-6 w-6"><path d="M12 2v20"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7H14a3.5 3.5 0 0 1 0 7H6"/></svg>
                                </div>
                                <div>
                                    <h2 class="text-lg font-black text-slate-950">Harga & Ketersediaan</h2>
                                    <p class="mt-1 text-xs text-slate-400">Tentukan harga dasar sewa dan status awal.</p>
                                </div>
                            </div>
                            <div class="grid gap-5 p-6 sm:p-7 md:grid-cols-2">
                                <div>
                                    <label for="price" class="block text-sm font-bold text-slate-700">Harga Dasar Sewa <span class="text-red-500">*</span></label>
                                    <div class="relative mt-2">
                                        <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-sm font-black text-slate-500">Rp</span>
                                        <input id="price" type="number" name="price" value="{{ old('price') }}" min="0" step="1000" placeholder="2500000" required
                                            class="block h-14 w-full rounded-2xl border border-slate-200 bg-slate-50 py-3 pl-12 pr-4 text-sm font-medium text-slate-900 outline-none transition placeholder:text-slate-400 hover:border-slate-300 focus:border-sky-500 focus:bg-white focus:ring-4 focus:ring-sky-500/10" />
                                    </div>
                                    <p class="mt-2 text-xs text-slate-400">Masukkan nominal tanpa titik atau koma.</p>
                                    @error('price') <p class="mt-2 text-xs font-semibold text-red-500">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label for="is_available" class="block text-sm font-bold text-slate-700">Status Ketersediaan <span class="text-red-500">*</span></label>
                                    <div class="relative mt-2">
                                        <select id="is_available" name="is_available" required
                                            class="block h-14 w-full appearance-none rounded-2xl border border-slate-200 bg-slate-50 py-3 pl-4 pr-12 text-sm font-medium text-slate-900 outline-none transition hover:border-slate-300 focus:border-sky-500 focus:bg-white focus:ring-4 focus:ring-sky-500/10">
                                            <option value="1" {{ old('is_available', '1') == '1' ? 'selected' : '' }}>Tersedia — Bisa Dipesan</option>
                                            <option value="0" {{ old('is_available') === '0' ? 'selected' : '' }}>Tidak Tersedia / Sedang Disewa</option>
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4"><path d="m6 9 6 6 6-6"/></svg>
                                        </div>
                                    </div>
                                    @error('is_available') <p class="mt-2 text-xs font-semibold text-red-500">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </section>
                    </div>

                    {{-- RIGHT SIDEBAR / SUMMARY --}}
                    <div>
                        <div class="sticky top-28 space-y-5">
                            {{-- SUMMARY --}}
                            <div class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white">
                                <div class="bg-slate-950 px-6 py-6 text-white">
                                    <p class="text-xs font-black uppercase tracking-[.18em] text-sky-400">Ringkasan</p>
                                    <h3 class="mt-2 text-xl font-black">Armada Baru</h3>
                                    <p class="mt-2 text-xs leading-6 text-slate-400">Data akan disimpan setelah tombol ditekan.</p>
                                </div>
                                <div class="space-y-5 p-6">
                                    <div class="flex gap-3">
                                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-sky-50 text-sky-600">1</div>
                                        <div>
                                            <p class="text-sm font-black text-slate-900">Data Armada</p>
                                            <p class="mt-1 text-xs leading-5 text-slate-400">Nama, plat nomor dan kapasitas.</p>
                                        </div>
                                    </div>
                                    <div class="flex gap-3">
                                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">2</div>
                                        <div>
                                            <p class="text-sm font-black text-slate-900">Harga & Status</p>
                                            <p class="mt-1 text-xs leading-5 text-slate-400">Harga sewa dan status ketersediaan.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- WARNING --}}
                            <div class="rounded-[2rem] border border-amber-200 bg-amber-50 p-5">
                                <div class="flex gap-3">
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-amber-100 text-amber-600">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5"><path d="M12 3 2 21h20Z"/><path d="M12 9v4"/><path d="M12 17h.01"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-black text-amber-900">Periksa sebelum menyimpan</p>
                                        <p class="mt-2 text-xs leading-6 text-amber-700">Plat nomor harus unik. Pastikan harga dasar sudah sesuai.</p>
                                    </div>
                                </div>
                            </div>

                            {{-- ACTION BUTTONS --}}
                            <div class="rounded-[2rem] border border-slate-200 bg-white p-5">
                                <button type="submit" class="group flex w-full items-center justify-center gap-3 rounded-2xl bg-sky-500 px-6 py-4 text-sm font-black text-white shadow-xl shadow-sky-500/20 transition duration-300 hover:-translate-y-0.5 hover:bg-sky-400">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5"><path d="M12 5v14"/><path d="M5 12h14"/></svg>
                                    Tambahkan Armada
                                </button>
                                <a href="{{ route('admin.dashboard') }}" class="mt-3 flex w-full items-center justify-center rounded-2xl border border-slate-200 px-6 py-4 text-sm font-bold text-slate-500 transition hover:bg-slate-50 hover:text-slate-900">
                                    Batal
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            {{-- FOOTER --}}
            <footer class="mt-12 border-t border-slate-200 py-7">
                <div class="flex flex-col gap-3 text-xs text-slate-400 sm:flex-row sm:items-center sm:justify-between">
                    <p>© {{ date('Y') }} VikensaTrans Admin Panel.</p>
                    <p>Administrator Access</p>
                </div>
            </footer>
        </div>
    </main>
</div>

</body>
</html>