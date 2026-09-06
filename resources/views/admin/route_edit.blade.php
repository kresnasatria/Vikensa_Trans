<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>Edit Rute - VikensaTrans</title>

    <link
        rel="icon"
        type="image/png"
        href="{{ asset('images/vikensa_trans_logo.png') }}?v=3"
    >

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    <style>
        [x-cloak] {
            display: none !important;
        }

        body {
            font-family:
                Inter,
                ui-sans-serif,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;
        }
    </style>
</head>

<body
    class="bg-slate-100 text-slate-900 antialiased"

    x-data="{
        sidebarOpen: false,
        profileOpen: false
    }"
>

{{-- ========================================================= --}}
{{-- MOBILE OVERLAY --}}
{{-- ========================================================= --}}

<div
    x-show="sidebarOpen"
    x-cloak
    x-transition.opacity
    @click="sidebarOpen = false"
    class="fixed inset-0 z-40 bg-slate-950/60 lg:hidden"
></div>

{{-- ========================================================= --}}
{{-- SIDEBAR --}}
{{-- ========================================================= --}}

<aside
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 z-50 flex w-[280px] flex-col bg-slate-950 text-white transition-transform duration-300 lg:translate-x-0"
>
    {{-- LOGO --}}
    <div class="flex h-24 items-center justify-between border-b border-white/10 px-6">
        <a href="{{ route('admin.dashboard') }}">
            <img
                src="{{ asset('images/vikensa_trans_logo.png') }}"
                alt="VikensaTrans"
                class="h-16 w-auto max-w-[190px] object-contain"
            >
        </a>
        <button
            type="button"
            @click="sidebarOpen = false"
            class="text-slate-400 lg:hidden"
        >
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5">
                <path d="M6 6l12 12M18 6L6 18"/>
            </svg>
        </button>
    </div>

    {{-- MENU --}}
    <nav class="flex-1 overflow-y-auto px-4 py-6">
        <p class="mb-3 px-4 text-[10px] font-bold uppercase tracking-[.2em] text-slate-500">
            Administrator
        </p>

        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-400 transition hover:bg-white/5 hover:text-white">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5">
                <rect x="3" y="3" width="7" height="7" rx="1"/>
                <rect x="14" y="3" width="7" height="7" rx="1"/>
                <rect x="3" y="14" width="7" height="7" rx="1"/>
                <rect x="14" y="14" width="7" height="7" rx="1"/>
            </svg>
            Dashboard
        </a>

        <a href="{{ route('admin.orders.index') }}" class="mt-2 flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-400 transition hover:bg-white/5 hover:text-white">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5">
                <path d="M5 4h14v16l-3-2-4 2-4-2-3 2Z"/>
                <path d="M8 8h8M8 12h6"/>
            </svg>
            Order Masuk
        </a>

        <a href="{{ route('admin.route.index') }}" class="mt-2 flex items-center gap-3 rounded-xl bg-sky-500 px-4 py-3 text-sm font-bold text-white shadow-lg shadow-sky-500/10">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5">
                <circle cx="6" cy="18" r="2"/>
                <circle cx="18" cy="6" r="2"/>
                <path d="M7.5 16.5c2-4 7-4 9-8.5"/>
            </svg>
            Manajemen Rute
        </a>

        <a href="{{ route('admin.services.index') }}" class="mt-2 flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-400 transition hover:bg-white/5 hover:text-white">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5">
                <path d="m14 7 3-3 3 3-3 3"/>
                <path d="M17 4c-4 0-7 3-7 7"/>
                <path d="M4 20 14 10"/>
            </svg>
            Catatan Servis
        </a>

        <a href="{{ route('admin.create') }}" class="mt-2 flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-400 transition hover:bg-white/5 hover:text-white">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5">
                <path d="M12 5v14"/>
                <path d="M5 12h14"/>
            </svg>
            Tambah Armada
        </a>

        <p class="mb-3 mt-8 px-4 text-[10px] font-bold uppercase tracking-[.2em] text-slate-500">
            Website
        </p>

        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-400 transition hover:bg-white/5 hover:text-white">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5">
                <circle cx="12" cy="8" r="4"/>
                <path d="M4 21c0-5 3-8 8-8s8 3 8 8"/>
            </svg>
            Dashboard User
        </a>
    </nav>
</aside>


{{-- ========================================================= --}}
{{-- MAIN --}}
{{-- ========================================================= --}}

<div class="lg:pl-[280px]">

    {{-- TOPBAR --}}
    <header class="sticky top-0 z-30 flex h-20 items-center border-b border-slate-200 bg-white/90 px-5 backdrop-blur-xl sm:px-7 lg:px-10">
        <div class="flex w-full items-center justify-between">
            <div class="flex items-center gap-4">
                <button
                    type="button"
                    @click="sidebarOpen = true"
                    class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 text-slate-600 lg:hidden"
                >
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5">
                        <path d="M4 6h16"/>
                        <path d="M4 12h16"/>
                        <path d="M4 18h16"/>
                    </svg>
                </button>
                <div>
                    <p class="text-xs font-medium text-slate-400">Administrator</p>
                    <h2 class="text-lg font-black text-slate-900">Edit Rute</h2>
                </div>
            </div>

            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-950 text-sm font-black text-white">
                {{ mb_substr(Auth::user()->name, 0, 1) }}
            </div>
        </div>
    </header>


    {{-- CONTENT --}}
    <main class="px-5 py-8 sm:px-7 lg:px-10">
        <div class="mx-auto max-w-4xl">

            {{-- VALIDATION ERROR --}}
            @if($errors->any())
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4">
                    <p class="text-sm font-bold text-red-700">Ada data yang belum benar.</p>
                    <ul class="mt-2 list-inside list-disc text-sm text-red-600">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- FORM EDIT RUTE --}}
            <section class="rounded-2xl border border-slate-200 bg-white">
                
                <div class="border-b border-slate-100 px-6 py-5 flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-black text-slate-900">Ubah Data Rute</h2>
                        <p class="mt-1 text-sm text-slate-500">Silakan sesuaikan kota, tujuan transit, maupun biayanya.</p>
                    </div>
                </div>

                {{-- FORM MULAI --}}
                <form
                    action="{{ route('admin.route.update', $rute->id) }}"
                    method="POST"
                    x-data="{
                        destinations: {{ Illuminate\Support\Js::from(old('destinations', $destinations)) }}
                    }"
                    class="p-6"
                >
                    @csrf
                    @method('PUT')

                    <div class="grid gap-6 lg:grid-cols-2">

                        {{-- ORIGIN --}}
                        <div>
                            <label for="origin" class="block text-sm font-bold text-slate-700">
                                Kota Asal <span class="text-red-500">*</span>
                            </label>
                            <p class="mt-1 text-xs text-slate-400">Titik awal perjalanan.</p>
                            <div class="relative mt-3">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-sky-500">
                                    <circle cx="12" cy="12" r="9"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                                <input
                                    id="origin"
                                    type="text"
                                    name="origin"
                                    value="{{ old('origin', $rute->origin) }}"
                                    placeholder="Contoh: Bandung"
                                    maxlength="255"
                                    required
                                    class="h-13 w-full rounded-xl border border-slate-200 bg-slate-50 py-3.5 pl-12 pr-4 text-sm font-semibold text-slate-800 outline-none transition focus:border-sky-500 focus:bg-white focus:ring-4 focus:ring-sky-500/10"
                                >
                            </div>
                        </div>

                        {{-- DESTINATION --}}
                        <div>
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <label class="block text-sm font-bold text-slate-700">
                                        Kota Tujuan / Transit <span class="text-red-500">*</span>
                                    </label>
                                    <p class="mt-1 text-xs text-slate-400">Urutkan sesuai perjalanan.</p>
                                </div>
                                <button
                                    type="button"
                                    @click="destinations.push('')"
                                    class="shrink-0 rounded-lg bg-sky-50 px-3 py-2 text-xs font-bold text-sky-600 transition hover:bg-sky-100"
                                >
                                    + Tambah
                                </button>
                            </div>

                            <div class="mt-3 space-y-3">
                                <template x-for="(destination, index) in destinations" :key="index">
                                    <div class="flex items-center gap-2">
                                        <div class="flex h-11 w-8 shrink-0 items-center justify-center text-xs font-black text-slate-400" x-text="index + 1"></div>
                                        <input
                                            type="text"
                                            name="destinations[]"
                                            x-model="destinations[index]"
                                            placeholder="Contoh: Jakarta"
                                            maxlength="255"
                                            required
                                            class="h-12 min-w-0 flex-1 rounded-xl border border-slate-200 bg-slate-50 px-4 text-sm font-semibold text-slate-800 outline-none transition focus:border-sky-500 focus:bg-white focus:ring-4 focus:ring-sky-500/10"
                                        >
                                        <button
                                            type="button"
                                            x-show="destinations.length > 1"
                                            @click="destinations.splice(index, 1)"
                                            title="Hapus titik"
                                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-red-50 text-red-500 transition hover:bg-red-500 hover:text-white"
                                        >
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4">
                                                <path d="M6 6l12 12M18 6 6 18"/>
                                            </svg>
                                        </button>
                                    </div>
                                </template>
                            </div>
                        </div>

                    </div>

                    {{-- BIAYA RUTE --}}
                    <div class="mt-6 border-t border-slate-100 pt-6">
                        <label for="biaya" class="block text-sm font-bold text-slate-700">
                            Biaya Rute (Opsional / Rahasia)
                        </label>
                        <p class="mt-1 text-xs text-slate-400">
                            Nominal ini akan dikalkulasikan ke total harga saat user booking, namun detail angkanya tidak akan ditampilkan.
                        </p>
                        <div class="relative mt-3">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm font-bold text-slate-400">
                                Rp
                            </span>
                            <input
                                id="biaya"
                                type="number"
                                name="biaya"
                                value="{{ old('biaya', $rute->biaya ?? 0) }}"
                                placeholder="Contoh: 150000"
                                min="0"
                                required
                                class="h-13 w-full rounded-xl border border-slate-200 bg-slate-50 py-3.5 pl-12 pr-4 text-sm font-semibold text-slate-800 outline-none transition placeholder:font-normal placeholder:text-slate-400 focus:border-sky-500 focus:bg-white focus:ring-4 focus:ring-sky-500/10"
                            >
                        </div>
                    </div>

                    {{-- ACTION BUTTONS --}}
                    <div class="mt-7 flex items-center justify-end gap-3 border-t border-slate-100 pt-5">
                        
                        <a href="{{ route('admin.route.index') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 px-6 py-3 text-sm font-bold text-slate-500 transition hover:bg-slate-50">
                            Batal
                        </a>

                        <button type="submit" class="group inline-flex items-center gap-2 rounded-xl bg-sky-500 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-sky-500/15 transition hover:bg-sky-600">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4">
                                <path d="M12 5v14"/>
                                <path d="M5 12h14"/>
                            </svg>
                            Simpan Perubahan
                        </button>

                    </div>

                </form>
            </section>

        </div>
    </main>

</div>

</body>
</html>