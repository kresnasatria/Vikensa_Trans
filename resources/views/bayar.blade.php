<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Pembayaran pemesanan VikensaTrans">

    <title>Pembayaran - VikensaTrans</title>

    <link rel="icon" href="{{ asset('images/vikensa_trans_logo.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] {
            display: none !important;
        }

        body {
            font-family: Inter, ui-sans-serif, system-ui, -apple-system,
                BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        ::selection {
            background: #0ea5e9;
            color: white;
        }

        .payment-card {
            box-shadow: 0 20px 60px rgba(15, 23, 42, .055);
        }
    </style>
</head>

@php
    $userName = Auth::user()?->name ?? 'Pengguna';
@endphp

<body
    class="bg-slate-100 text-slate-900 antialiased"
    x-data="{
        sidebarOpen: false,
        profileOpen: false
    }"
>

    {{-- MOBILE OVERLAY --}}
    <div
        x-show="sidebarOpen"
        x-cloak
        x-transition.opacity
        @click="sidebarOpen = false"
        class="fixed inset-0 z-40 bg-slate-950/60 backdrop-blur-sm lg:hidden"
    ></div>


    {{-- SIDEBAR --}}
    <aside
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed inset-y-0 left-0 z-50 flex w-[280px] flex-col
               border-r border-white/10 bg-slate-950 text-white
               transition-transform duration-300 lg:translate-x-0"
    >

        {{-- LOGO --}}
        <div
            class="flex h-24 items-center justify-between
                   border-b border-white/10 px-6"
        >
            <a href="{{ url('/') }}" class="flex items-center">
                <img
                    src="{{ asset('images/vikensa_trans_logo.png') }}"
                    alt="VikensaTrans"
                    class="h-16 w-auto max-w-[200px] object-contain"
                >
            </a>

            <button
                @click="sidebarOpen = false"
                type="button"
                class="flex h-10 w-10 items-center justify-center
                       rounded-xl text-slate-400 transition
                       hover:bg-white/10 hover:text-white lg:hidden"
                aria-label="Tutup menu"
            >
                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    class="h-5 w-5"
                >
                    <path d="M6 6l12 12M18 6 6 18"/>
                </svg>
            </button>
        </div>


        {{-- NAVIGATION --}}
        <nav class="flex-1 overflow-y-auto px-4 py-6">

            <p
                class="mb-3 px-4 text-[10px] font-black uppercase
                       tracking-[.2em] text-slate-500"
            >
                Menu Utama
            </p>


            {{-- DASHBOARD --}}
            <a
                href="{{ route('dashboard') }}"
                class="flex items-center gap-3 rounded-2xl
                       px-4 py-3.5 text-sm font-semibold
                       text-slate-400 transition
                       hover:bg-white/5 hover:text-white"
            >
                <div
                    class="flex h-9 w-9 items-center justify-center
                           rounded-xl bg-white/5"
                >
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="h-5 w-5"
                    >
                        <rect x="3" y="3" width="7" height="7" rx="1"/>
                        <rect x="14" y="3" width="7" height="7" rx="1"/>
                        <rect x="3" y="14" width="7" height="7" rx="1"/>
                        <rect x="14" y="14" width="7" height="7" rx="1"/>
                    </svg>
                </div>

                Dashboard
            </a>


            {{-- PEMBAYARAN ACTIVE --}}
            <div
                class="mt-2 flex items-center gap-3 rounded-2xl
                       bg-sky-500 px-4 py-3.5
                       text-sm font-bold text-white
                       shadow-lg shadow-sky-500/10"
            >
                <div
                    class="flex h-9 w-9 items-center justify-center
                           rounded-xl bg-white/15"
                >
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="h-5 w-5"
                    >
                        <rect x="3" y="5" width="18" height="14" rx="2"/>
                        <path d="M3 10h18"/>
                        <path d="M7 15h4"/>
                    </svg>
                </div>

                Pembayaran
            </div>


            {{-- RIWAYAT --}}
            <a
                href="{{ route('riwayat') }}"
                class="mt-2 flex items-center gap-3 rounded-2xl
                       px-4 py-3.5 text-sm font-semibold
                       text-slate-400 transition
                       hover:bg-white/5 hover:text-white"
            >
                <div
                    class="flex h-9 w-9 items-center justify-center
                           rounded-xl bg-white/5"
                >
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="h-5 w-5"
                    >
                        <path d="M3 12a9 9 0 1 0 3-6.7"/>
                        <path d="M3 4v6h6"/>
                        <path d="M12 7v5l3 2"/>
                    </svg>
                </div>

                Riwayat Pesanan
            </a>


            {{-- PROFILE --}}
            @auth
                <a
                    href="{{ route('profile.edit') }}"
                    class="mt-2 flex items-center gap-3 rounded-2xl
                           px-4 py-3.5 text-sm font-semibold
                           text-slate-400 transition
                           hover:bg-white/5 hover:text-white"
                >
                    <div
                        class="flex h-9 w-9 items-center justify-center
                               rounded-xl bg-white/5"
                    >
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            class="h-5 w-5"
                        >
                            <circle cx="12" cy="8" r="4"/>
                            <path d="M4 21c0-5 3-8 8-8s8 3 8 8"/>
                        </svg>
                    </div>

                    Profil Saya
                </a>
            @endauth


            {{-- ADMIN --}}
            @if((Auth::user()->role ?? null) === 'admin')

                <p
                    class="mb-3 mt-8 px-4 text-[10px]
                           font-black uppercase tracking-[.2em]
                           text-slate-500"
                >
                    Administrator
                </p>

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 rounded-2xl
                           px-4 py-3.5 text-sm font-semibold
                           text-slate-400 transition
                           hover:bg-white/5 hover:text-white"
                >
                    <div
                        class="flex h-9 w-9 items-center justify-center
                               rounded-xl bg-white/5"
                    >
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            class="h-5 w-5"
                        >
                            <path d="M12 2 20 6v6c0 5-3.5 8.5-8 10-4.5-1.5-8-5-8-10V6Z"/>
                            <path d="m9 12 2 2 4-4"/>
                        </svg>
                    </div>

                    Panel Admin
                </a>

            @endif


            {{-- WEBSITE --}}
            <p
                class="mb-3 mt-8 px-4 text-[10px]
                       font-black uppercase tracking-[.2em]
                       text-slate-500"
            >
                Website
            </p>

            <a
                href="{{ url('/') }}"
                class="flex items-center gap-3 rounded-2xl
                       px-4 py-3.5 text-sm font-semibold
                       text-slate-400 transition
                       hover:bg-white/5 hover:text-white"
            >
                <div
                    class="flex h-9 w-9 items-center justify-center
                           rounded-xl bg-white/5"
                >
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="h-5 w-5"
                    >
                        <path d="m3 11 9-8 9 8"/>
                        <path d="M5 10v10h14V10"/>
                        <path d="M9 20v-6h6v6"/>
                    </svg>
                </div>

                Kembali ke Beranda
            </a>


            {{-- INFO --}}
            <div
                class="mt-9 rounded-3xl border border-white/10
                       bg-white/[.04] p-5"
            >
                <div
                    class="flex h-10 w-10 items-center justify-center
                           rounded-xl bg-emerald-500/10 text-emerald-400"
                >
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="h-5 w-5"
                    >
                        <path d="M12 22s7-5 7-12a7 7 0 1 0-14 0c0 7 7 12 7 12Z"/>
                        <circle cx="12" cy="10" r="2"/>
                    </svg>
                </div>

                <p class="mt-4 text-sm font-black text-white">
                    Pembayaran Aman
                </p>

                <p class="mt-2 text-xs leading-6 text-slate-500">
                    Transaksi diproses melalui Midtrans.
                    Pilih metode pembayaran yang paling nyaman untukmu.
                </p>
            </div>

        </nav>


        {{-- PROFILE BOTTOM --}}
        @auth
            <div class="border-t border-white/10 p-4">
                <div class="relative">

                    <button
                        @click="profileOpen = !profileOpen"
                        type="button"
                        class="flex w-full items-center gap-3
                               rounded-2xl p-3 text-left transition
                               hover:bg-white/5"
                    >

                        <div
                            class="flex h-11 w-11 shrink-0
                                   items-center justify-center rounded-xl
                                   bg-sky-500 text-sm font-black
                                   uppercase text-white"
                        >
                            {{ mb_substr($userName, 0, 1) }}
                        </div>


                        <div class="min-w-0 flex-1">

                            <p class="truncate text-sm font-bold text-white">
                                {{ Auth::user()->name }}
                            </p>

                            <p
                                class="mt-0.5 truncate
                                       text-xs text-slate-500"
                            >
                                {{ Auth::user()->email }}
                            </p>

                        </div>


                        <svg
                            :class="profileOpen ? 'rotate-180' : ''"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            class="h-4 w-4 text-slate-500 transition"
                        >
                            <path d="m6 9 6 6 6-6"/>
                        </svg>

                    </button>


                    {{-- DROPDOWN --}}
                    <div
                        x-show="profileOpen"
                        x-cloak
                        x-transition
                        @click.outside="profileOpen = false"
                        class="absolute bottom-full left-0 right-0 mb-2
                               overflow-hidden rounded-2xl
                               border border-slate-200 bg-white
                               p-2 shadow-2xl"
                    >

                        <a
                            href="{{ route('profile.edit') }}"
                            class="block rounded-xl px-4 py-3
                                   text-sm font-semibold text-slate-600
                                   transition hover:bg-slate-50"
                        >
                            Edit Profil
                        </a>


                        <form
                            method="POST"
                            action="{{ route('logout') }}"
                        >
                            @csrf

                            <button
                                type="submit"
                                class="block w-full rounded-xl
                                       px-4 py-3 text-left
                                       text-sm font-semibold text-red-500
                                       transition hover:bg-red-50"
                            >
                                Keluar
                            </button>
                        </form>

                    </div>

                </div>
            </div>
        @endauth

    </aside>


    {{-- MAIN CONTENT --}}
    <div class="lg:pl-[280px]">

        {{-- TOPBAR --}}
        <header
            class="sticky top-0 z-30 flex h-20 items-center
                   border-b border-slate-200 bg-white/90
                   px-5 backdrop-blur-xl sm:px-7 lg:px-10"
        >

            <div
                class="flex w-full items-center
                       justify-between gap-4"
            >

                <div class="flex items-center gap-4">

                    {{-- MOBILE MENU --}}
                    <button
                        @click="sidebarOpen = true"
                        type="button"
                        class="flex h-11 w-11 items-center justify-center
                               rounded-xl border border-slate-200
                               text-slate-600 transition
                               hover:bg-slate-50 lg:hidden"
                        aria-label="Buka menu"
                    >
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            class="h-6 w-6"
                        >
                            <path d="M4 6h16"/>
                            <path d="M4 12h16"/>
                            <path d="M4 18h16"/>
                        </svg>
                    </button>


                    <div>
                        <p class="text-xs font-semibold text-slate-400">
                            VikensaTrans
                        </p>

                        <h2 class="text-lg font-black text-slate-950">
                            Pembayaran
                        </h2>
                    </div>

                </div>


                {{-- RIWAYAT BUTTON --}}
                <a
                    href="{{ route('riwayat') }}"
                    class="inline-flex items-center gap-2
                           rounded-xl border border-slate-200
                           px-4 py-2.5 text-sm font-bold
                           text-slate-600 transition
                           hover:border-sky-200
                           hover:bg-sky-50 hover:text-sky-600"
                >
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        class="h-4 w-4"
                    >
                        <path d="M19 12H5"/>
                        <path d="m11 18-6-6 6-6"/>
                    </svg>

                    <span class="hidden sm:inline">
                        Riwayat Pesanan
                    </span>
                </a>

            </div>

        </header>


        {{-- CONTENT --}}
        <main
            class="px-5 py-8
                   sm:px-7
                   lg:px-10 lg:py-10"
        >

            <div class="mx-auto max-w-6xl">

                {{-- PAGE TITLE --}}
                <div
                    class="flex flex-col justify-between gap-5
                           lg:flex-row lg:items-end"
                >

                    <div>

                        <div
                            class="inline-flex items-center gap-2
                                   rounded-full bg-emerald-100
                                   px-4 py-2 text-xs font-black
                                   uppercase tracking-[.15em]
                                   text-emerald-700"
                        >
                            <span
                                class="h-2 w-2 rounded-full
                                       bg-emerald-500"
                            ></span>

                            Booking Dibuat
                        </div>


                        <h1
                            class="mt-4 text-3xl font-black
                                   tracking-tight text-slate-950
                                   sm:text-4xl"
                        >
                            Selesaikan pembayaranmu.
                        </h1>


                        <p
                            class="mt-3 max-w-2xl
                                   text-sm leading-7 text-slate-500
                                   sm:text-base"
                        >
                            Periksa kembali detail perjalanan sebelum
                            memilih metode pembayaran melalui Midtrans.
                        </p>

                    </div>


                    <div
                        class="inline-flex w-fit items-center gap-2
                               rounded-full bg-white px-4 py-2
                               text-xs font-bold text-slate-500
                               shadow-sm ring-1 ring-slate-200"
                    >

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            class="h-4 w-4 text-emerald-500"
                        >
                            <path d="M12 22s8-3 8-10V5l-8-3-8 3v7c0 7 8 10 8 10Z"/>
                            <path d="m9 12 2 2 4-4"/>
                        </svg>

                        Transaksi aman melalui Midtrans

                    </div>

                </div>


                {{-- GRID --}}
                <div
                    class="mt-8 grid gap-7
                           xl:grid-cols-[minmax(0,1fr)_380px]"
                >

                    {{-- DETAIL BOOKING --}}
                    <section
                        class="payment-card overflow-hidden
                               rounded-[2rem]
                               border border-slate-200 bg-white"
                    >

                        {{-- CARD HEADER --}}
                        <div
                            class="flex items-center justify-between gap-4
                                   border-b border-slate-100
                                   px-6 py-5 sm:px-7"
                        >

                            <div class="flex items-center gap-4">

                                <div
                                    class="flex h-11 w-11 shrink-0
                                           items-center justify-center
                                           rounded-xl bg-sky-500 text-white
                                           shadow-lg shadow-sky-500/20"
                                >
                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        class="h-5 w-5"
                                    >
                                        <path d="M6 2v4M18 2v4"/>
                                        <rect
                                            x="3"
                                            y="5"
                                            width="18"
                                            height="16"
                                            rx="2"
                                        />
                                        <path d="M3 10h18"/>
                                        <path d="m9 15 2 2 4-4"/>
                                    </svg>
                                </div>


                                <div>

                                    <h2
                                        class="text-lg font-black
                                               text-slate-950"
                                    >
                                        Detail Perjalanan
                                    </h2>

                                    <p
                                        class="mt-1 text-xs
                                               text-slate-400"
                                    >
                                        Pastikan data booking sudah sesuai.
                                    </p>

                                </div>

                            </div>


                            <span
                                class="hidden rounded-full
                                       bg-sky-50 px-3 py-1.5
                                       text-[11px] font-black
                                       uppercase tracking-wider
                                       text-sky-600 sm:inline-flex"
                            >
                                {{ $booking->booking_code }}
                            </span>

                        </div>


                        {{-- CARD BODY --}}
                        <div class="p-6 sm:p-7">

                            {{-- DETAIL TOP --}}
                            <div class="grid gap-4 sm:grid-cols-2">

                                {{-- BOOKING CODE --}}
                                <div
                                    class="rounded-2xl
                                           border border-slate-200
                                           bg-slate-50 p-5"
                                >

                                    <p
                                        class="text-[11px] font-black
                                               uppercase tracking-[.14em]
                                               text-slate-400"
                                    >
                                        Kode Booking
                                    </p>

                                    <p
                                        class="mt-2 break-all
                                               text-base font-black
                                               text-slate-950"
                                    >
                                        {{ $booking->booking_code }}
                                    </p>

                                </div>


                                {{-- ARMADA --}}
                                <div
                                    class="rounded-2xl
                                           border border-slate-200
                                           bg-slate-50 p-5"
                                >

                                    <p
                                        class="text-[11px] font-black
                                               uppercase tracking-[.14em]
                                               text-slate-400"
                                    >
                                        Armada Charter
                                    </p>

                                    <p
                                        class="mt-2 text-base
                                               font-black text-slate-950"
                                    >
                                        {{ $booking->schedule->shuttle->name }}
                                    </p>

                                </div>

                            </div>


                            {{-- ROUTE --}}
                            <div
                                class="mt-5 rounded-3xl
                                       bg-slate-950 p-5
                                       text-white sm:p-6"
                            >

                                <p
                                    class="text-[11px] font-black
                                           uppercase tracking-[.16em]
                                           text-slate-500"
                                >
                                    Rute Perjalanan
                                </p>


                                <div
                                    class="mt-5 grid gap-4
                                           sm:grid-cols-[1fr_auto_1fr]
                                           sm:items-center"
                                >

                                    {{-- ORIGIN --}}
                                    <div>

                                        <div
                                            class="flex h-10 w-10
                                                   items-center justify-center
                                                   rounded-xl
                                                   bg-sky-500/15
                                                   text-sky-400"
                                        >
                                            <svg
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                                class="h-5 w-5"
                                            >
                                                <circle cx="12" cy="12" r="3"/>
                                                <circle cx="12" cy="12" r="8"/>
                                            </svg>
                                        </div>


                                        <p
                                            class="mt-3 text-[10px]
                                                   font-black uppercase
                                                   tracking-[.16em]
                                                   text-slate-500"
                                        >
                                            Kota Jemput
                                        </p>


                                        <p
                                            class="mt-1 text-base
                                                   font-black leading-6
                                                   text-white"
                                        >
                                            {{ $booking->custom_origin }}
                                        </p>

                                    </div>


                                    {{-- ARROW --}}
                                    <div
                                        class="hidden items-center gap-2
                                               text-slate-600 sm:flex"
                                    >

                                        <span
                                            class="h-px w-5
                                                   bg-slate-700"
                                        ></span>

                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            class="h-5 w-5"
                                        >
                                            <path d="M5 12h14"/>
                                            <path d="m13 6 6 6-6 6"/>
                                        </svg>

                                        <span
                                            class="h-px w-5
                                                   bg-slate-700"
                                        ></span>

                                    </div>


                                    {{-- DESTINATION --}}
                                    <div class="sm:text-right">

                                        <div
                                            class="flex h-10 w-10
                                                   items-center justify-center
                                                   rounded-xl
                                                   bg-emerald-500/15
                                                   text-emerald-400
                                                   sm:ml-auto"
                                        >
                                            <svg
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                                class="h-5 w-5"
                                            >
                                                <path
                                                    d="M12 22s7-5 7-12
                                                       a7 7 0 1 0-14 0
                                                       c0 7 7 12 7 12Z"
                                                />
                                                <circle
                                                    cx="12"
                                                    cy="10"
                                                    r="2"
                                                />
                                            </svg>
                                        </div>


                                        <p
                                            class="mt-3 text-[10px]
                                                   font-black uppercase
                                                   tracking-[.16em]
                                                   text-slate-500"
                                        >
                                            Kota Tujuan
                                        </p>


                                        <p
                                            class="mt-1 text-base
                                                   font-black leading-6
                                                   text-white"
                                        >
                                            {{ $booking->custom_destination }}
                                        </p>

                                    </div>

                                </div>

                            </div>


                            {{-- INFO --}}
                            <div
                                class="mt-6 flex items-start gap-3
                                       rounded-2xl
                                       border border-sky-100
                                       bg-sky-50 p-4"
                            >

                                <div
                                    class="mt-0.5 flex h-8 w-8
                                           shrink-0 items-center
                                           justify-center rounded-lg
                                           bg-sky-100 text-sky-600"
                                >
                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        class="h-4 w-4"
                                    >
                                        <circle cx="12" cy="12" r="9"/>
                                        <path d="M12 11v5"/>
                                        <path d="M12 8h.01"/>
                                    </svg>
                                </div>


                                <p
                                    class="text-xs leading-6
                                           text-sky-800"
                                >
                                    Setelah pembayaran berhasil, status
                                    pesanan akan diperbarui dan kamu akan
                                    diarahkan kembali ke halaman riwayat
                                    pesanan.
                                </p>

                            </div>

                        </div>

                    </section>


                    {{-- PAYMENT PANEL --}}
                    <aside
                        class="payment-card h-fit overflow-hidden
                               rounded-[2rem]
                               border border-slate-200
                               bg-white
                               xl:sticky xl:top-28"
                    >

                        {{-- TOTAL --}}
                        <div
                            class="border-b border-slate-100
                                   p-6 sm:p-7"
                        >

                            <p
                                class="text-[11px] font-black
                                       uppercase tracking-[.16em]
                                       text-slate-400"
                            >
                                Total Tagihan
                            </p>


                            <div
                                class="mt-3 flex items-end gap-2"
                            >

                                <span
                                    class="pb-1 text-sm font-bold
                                           text-slate-400"
                                >
                                    Rp
                                </span>


                                <p
                                    class="text-3xl font-black
                                           tracking-tight text-slate-950
                                           sm:text-4xl"
                                >
                                    {{ number_format(
                                        $booking->total_price,
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                                </p>

                            </div>


                            <p
                                class="mt-3 text-xs leading-5
                                       text-slate-400"
                            >
                                Nominal di atas merupakan total
                                pembayaran untuk booking ini.
                            </p>

                        </div>


                        {{-- PAYMENT BODY --}}
                        <div class="p-6 sm:p-7">

                            {{-- PAY BUTTON --}}
                            <button
                                id="pay-button"
                                type="button"
                                class="group inline-flex min-h-14
                                       w-full items-center justify-center
                                       gap-3 rounded-2xl bg-sky-500
                                       px-5 py-4 text-sm font-black
                                       text-white
                                       shadow-lg shadow-sky-500/20
                                       transition
                                       hover:bg-sky-600
                                       focus:outline-none
                                       focus:ring-4
                                       focus:ring-sky-500/20
                                       disabled:cursor-not-allowed
                                       disabled:opacity-70"
                            >

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    class="h-5 w-5"
                                >
                                    <rect
                                        x="3"
                                        y="5"
                                        width="18"
                                        height="14"
                                        rx="2"
                                    />
                                    <path d="M3 10h18"/>
                                    <path d="M7 15h4"/>
                                </svg>


                                <span id="pay-button-text">
                                    Pilih Metode Pembayaran
                                </span>


                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    class="h-4 w-4 transition
                                           group-hover:translate-x-0.5"
                                >
                                    <path d="M5 12h14"/>
                                    <path d="m13 6 6 6-6 6"/>
                                </svg>

                            </button>


                            {{-- MIDTRANS INFO --}}
                            <div
                                class="mt-5 flex items-center
                                       justify-center gap-2
                                       text-xs font-semibold
                                       text-slate-400"
                            >

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    class="h-4 w-4 text-emerald-500"
                                >
                                    <rect
                                        x="5"
                                        y="10"
                                        width="14"
                                        height="10"
                                        rx="2"
                                    />
                                    <path
                                        d="M8 10V7a4 4 0 0 1 8 0v3"
                                    />
                                </svg>

                                Secured by Midtrans

                            </div>


                            {{-- STEPS --}}
                            <div
                                class="mt-6 border-t
                                       border-slate-100 pt-6"
                            >

                                <p
                                    class="text-xs font-black uppercase
                                           tracking-[.14em]
                                           text-slate-400"
                                >
                                    Yang perlu kamu lakukan
                                </p>


                                <div class="mt-4 space-y-4">

                                    {{-- STEP 1 --}}
                                    <div class="flex gap-3">

                                        <div
                                            class="flex h-7 w-7 shrink-0
                                                   items-center justify-center
                                                   rounded-lg bg-slate-100
                                                   text-[11px] font-black
                                                   text-slate-600"
                                        >
                                            1
                                        </div>

                                        <p
                                            class="text-xs leading-5
                                                   text-slate-500"
                                        >
                                            Klik tombol pembayaran dan
                                            pilih metode yang tersedia.
                                        </p>

                                    </div>


                                    {{-- STEP 2 --}}
                                    <div class="flex gap-3">

                                        <div
                                            class="flex h-7 w-7 shrink-0
                                                   items-center justify-center
                                                   rounded-lg bg-slate-100
                                                   text-[11px] font-black
                                                   text-slate-600"
                                        >
                                            2
                                        </div>

                                        <p
                                            class="text-xs leading-5
                                                   text-slate-500"
                                        >
                                            Selesaikan instruksi
                                            pembayaran pada jendela
                                            Midtrans.
                                        </p>

                                    </div>


                                    {{-- STEP 3 --}}
                                    <div class="flex gap-3">

                                        <div
                                            class="flex h-7 w-7 shrink-0
                                                   items-center justify-center
                                                   rounded-lg bg-slate-100
                                                   text-[11px] font-black
                                                   text-slate-600"
                                        >
                                            3
                                        </div>

                                        <p
                                            class="text-xs leading-5
                                                   text-slate-500"
                                        >
                                            Kamu akan diarahkan ke
                                            halaman pesanan setelah
                                            transaksi selesai.
                                        </p>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </aside>

                </div>

            </div>

        </main>

    </div>


    {{-- MIDTRANS SNAP --}}
    <script
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"
    ></script>


    <script type="text/javascript">

        const payButton =
            document.getElementById('pay-button');

        const payButtonText =
            document.getElementById('pay-button-text');


        payButton.addEventListener('click', function () {

            payButton.disabled = true;

            payButtonText.textContent =
                'Membuka Pembayaran...';


            snap.pay('{{ $snapToken }}', {

                onSuccess: function (result) {

                    window.location.href =
                        "{{ route('payment.success', $booking->id) }}";

                },


                onPending: function (result) {

                    window.location.href =
                        "{{ route('riwayat') }}";

                },


                onError: function (result) {

                    payButton.disabled = false;

                    payButtonText.textContent =
                        'Pilih Metode Pembayaran';

                    alert(
                        'Maaf, pembayaran Anda gagal diproses!'
                    );

                },


                onClose: function () {

                    payButton.disabled = false;

                    payButtonText.textContent =
                        'Pilih Metode Pembayaran';

                    console.log(
                        'Customer menutup kotak pop-up tanpa menyelesaikan pembayaran'
                    );

                }

            });

        });

    </script>

</body>
</html>