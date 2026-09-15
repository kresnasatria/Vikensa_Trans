<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Pengaturan Kontak Bantuan - Panel Administrator VikensaTrans">
    <title>Kontak Bantuan - Admin VikensaTrans</title>
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
    </style>
</head>

<body class="bg-slate-100 text-slate-900 antialiased" x-data="{ sidebarOpen: false }">

{{-- MOBILE SIDEBAR OVERLAY --}}
<div x-show="sidebarOpen" x-cloak x-transition.opacity @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-slate-950/60 backdrop-blur-sm lg:hidden"></div>

{{-- ========================================================= --}}
{{-- SIDEBAR ADMIN CERDAS --}}
{{-- ========================================================= --}}
<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 flex w-[285px] flex-col border-r border-white/10 bg-slate-950 text-white transition-transform duration-300 lg:translate-x-0">
    
    {{-- BRAND --}}
    <div class="flex h-24 items-center justify-between border-b border-white/10 px-6">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-sky-500 text-white shadow-lg shadow-sky-500/20">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-6 w-6">
                    <path d="M12 2 20 6v6c0 5-3.5 8.5-8 10-4.5-1.5-8-5-8-10V6Z"/><path d="m9 12 2 2 4-4"/>
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

    {{-- NAVIGASI ADMIN --}}
    <nav class="flex-1 overflow-y-auto px-4 py-6">
        <p class="mb-3 px-4 text-[10px] font-black uppercase tracking-[.2em] text-slate-500">Administrasi</p>

        {{-- 1. DASHBOARD --}}
        <a href="{{ route('admin.dashboard') }}" class="mt-2 flex items-center gap-3 rounded-2xl px-4 py-3.5 text-sm font-semibold transition {{ request()->routeIs('admin.dashboard') ? 'bg-sky-500 text-white shadow-lg shadow-sky-500/10' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
            <div class="flex h-9 w-9 items-center justify-center rounded-xl {{ request()->routeIs('admin.dashboard') ? 'bg-white/15' : 'bg-white/5' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
            </div>
            Dashboard Admin
        </a>

        {{-- 2. TAMBAH ARMADA --}}
        <a href="{{ route('admin.create') }}" class="mt-2 flex items-center gap-3 rounded-2xl px-4 py-3.5 text-sm font-semibold transition {{ request()->routeIs('admin.create') ? 'bg-sky-500 text-white shadow-lg shadow-sky-500/10' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
            <div class="flex h-9 w-9 items-center justify-center rounded-xl {{ request()->routeIs('admin.create') ? 'bg-white/15' : 'bg-white/5' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5"><path d="M12 5v14"/><path d="M5 12h14"/></svg>
            </div>
            Tambah Armada
        </a>
        
        {{-- 3. MANAJEMEN RUTE --}}
        <a href="{{ route('admin.route.index') }}" class="mt-2 flex items-center gap-3 rounded-2xl px-4 py-3.5 text-sm font-semibold transition {{ request()->routeIs('admin.route.*') ? 'bg-sky-500 text-white shadow-lg shadow-sky-500/10' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
            <div class="flex h-9 w-9 items-center justify-center rounded-xl {{ request()->routeIs('admin.route.*') ? 'bg-white/15' : 'bg-white/5' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
            </div>
            Manajemen Rute
        </a>

        {{-- 4. DATA ORDER --}}
        @php
            $unreadOrdersCount = \App\Models\Booking::where('is_read', false)->count();
        @endphp
        <a href="{{ route('admin.orders.index') }}" class="mt-2 flex items-center justify-between rounded-2xl px-4 py-3.5 text-sm font-semibold transition {{ request()->routeIs('admin.orders.*') ? 'bg-sky-500 text-white shadow-lg shadow-sky-500/10' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
            <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-xl {{ request()->routeIs('admin.orders.*') ? 'bg-white/15' : 'bg-white/5' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012-2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                </div>
                Data Order
            </div>
            @if($unreadOrdersCount > 0)
                <span class="flex h-5 min-w-[20px] items-center justify-center rounded-full bg-red-500 px-1.5 text-[10px] font-black text-white">
                    {{ $unreadOrdersCount }}
                </span>
            @endif
        </a>

        {{-- 5. CATATAN SERVIS --}}
        <a href="{{ route('admin.services.index') }}" class="mt-2 flex items-center gap-3 rounded-2xl px-4 py-3.5 text-sm font-semibold transition {{ request()->routeIs('admin.services.*') ? 'bg-sky-500 text-white shadow-lg shadow-sky-500/10' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
            <div class="flex h-9 w-9 items-center justify-center rounded-xl {{ request()->routeIs('admin.services.*') ? 'bg-white/15' : 'bg-white/5' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
            </div>
            Catatan Servis
        </a>

        {{-- 6. KONTAK BANTUAN --}}
        <a href="{{ route('admin.contacts.edit') }}" class="mt-2 flex items-center gap-3 rounded-2xl px-4 py-3.5 text-sm font-semibold transition {{ request()->routeIs('admin.contacts.*') ? 'bg-sky-500 text-white shadow-lg shadow-sky-500/10' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
            <div class="flex h-9 w-9 items-center justify-center rounded-xl {{ request()->routeIs('admin.contacts.*') ? 'bg-white/15' : 'bg-white/5' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.12.9.33 1.78.62 2.63a2 2 0 0 1-.45 2.11L8 9.73a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.85.29 1.73.5 2.63.62A2 2 0 0 1 22 16.92Z"/></svg>
            </div>
            Kontak Bantuan
        </a>

        <p class="mb-3 mt-8 px-4 text-[10px] font-black uppercase tracking-[.2em] text-slate-500">Website</p>
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3.5 text-sm font-semibold text-slate-400 transition hover:bg-white/5 hover:text-white">
            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/5"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-5 3-8 8-8s8 3 8 8"/></svg></div>
            Dashboard User
        </a>
        <a href="{{ url('/') }}" class="mt-2 flex items-center gap-3 rounded-2xl px-4 py-3.5 text-sm font-semibold text-slate-400 transition hover:bg-white/5 hover:text-white">
            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/5"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5"><path d="m3 11 9-8 9 8"/><path d="M5 10v10h14V10"/><path d="M9 20v-6h6v6"/></svg></div>
            Lihat Website
        </a>
    </nav>

    {{-- AKUN ADMIN --}}
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

{{-- KONTEN UTAMA --}}
<div class="lg:pl-[285px]">
    
    {{-- TOPBAR --}}
    <header class="sticky top-0 z-30 flex h-20 items-center border-b border-slate-200 bg-white/90 px-5 backdrop-blur-xl sm:px-7 lg:px-10">
        <div class="flex w-full items-center justify-between gap-5">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = true" type="button" class="flex h-11 w-11 items-center justify-center rounded-xl border border-slate-200 text-slate-600 transition hover:bg-slate-50 lg:hidden">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-6 w-6"><path d="M4 6h16"/><path d="M4 12h16"/><path d="M4 18h16"/></svg>
                </button>
                <div>
                    <p class="text-xs font-semibold text-slate-400">Administrator Panel</p>
                    <h2 class="text-lg font-black text-slate-950">Pengaturan Kontak Bantuan</h2>
                </div>
            </div>
            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-slate-950 text-sm font-black uppercase text-white">
                {{ mb_substr(Auth::user()->name, 0, 1) }}
            </div>
        </div>
    </header>

    {{-- MAIN CONTENT --}}
    <main class="px-5 py-8 sm:px-7 lg:px-10 lg:py-10">
        <div class="mx-auto max-w-4xl">

            {{-- NOTIFIKASI BERHASIL --}}
            @if(session('success'))
                <div class="mb-7 flex items-center gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-semibold text-emerald-700">
                    <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-emerald-100 font-black">✓</span>
                    {{ session('success') }}
                </div>
            @endif

            {{-- FORM KARTU --}}
            <div class="rounded-[2rem] border border-slate-200 bg-white p-6 sm:p-8 shadow-sm">
                <div class="border-b border-slate-100 pb-5 mb-6">
                    <h3 class="text-xl font-black text-slate-950">Informasi Kontak & Sosial Media</h3>
                    <p class="mt-1 text-xs text-slate-500">Kontak ini akan otomatis muncul pada halaman form pemesanan pengguna jika rute tidak ditemukan.</p>
                </div>

                <form action="{{ route('admin.contacts.update') }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">No. WhatsApp / HP Admin</label>
                        <input type="text" name="phone" value="{{ old('phone', $contact->phone) }}" placeholder="Contoh: 6281234567890" class="w-full rounded-xl border border-slate-200 p-3.5 text-sm focus:border-sky-500 focus:outline-none">
                        <p class="mt-1 text-xs text-slate-400">Gunakan format kode negara di depan (misal: 62 tanpa tanda +).</p>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Email Bantuan</label>
                        <input type="email" name="email" value="{{ old('email', $contact->email) }}" placeholder="admin@vikensatrans.com" class="w-full rounded-xl border border-slate-200 p-3.5 text-sm focus:border-sky-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Instagram</label>
                        <input type="text" name="instagram" value="{{ old('instagram', $contact->instagram) }}" placeholder="@vikensatrans" class="w-full rounded-xl border border-slate-200 p-3.5 text-sm focus:border-sky-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Facebook / Media Sosial Lain</label>
                        <input type="text" name="facebook" value="{{ old('facebook', $contact->facebook) }}" placeholder="VikensaTrans Official" class="w-full rounded-xl border border-slate-200 p-3.5 text-sm focus:border-sky-500 focus:outline-none">
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-sky-500 px-6 py-4 text-sm font-black text-white shadow-xl shadow-sky-500/20 transition hover:bg-sky-400 sm:w-auto">
                            Simpan Perubahan Kontak
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </main>
</div>

</body>
</html>