<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Order Masuk - VikensaTrans</title>

    <link
        rel="icon"
        type="image/png"
        href="{{ asset('images/vikensa_trans_logo.png') }}?v=3"
    >

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] {
            display: none !important;
        }

        body {
            font-family: Inter, ui-sans-serif, system-ui, -apple-system,
                BlinkMacSystemFont, "Segoe UI", sans-serif;
        }
    </style>
</head>

@php
    $totalOrders = $orders->count();

    $unreadOrders = $orders
        ->filter(fn ($order) => !(bool) $order->is_read)
        ->count();

    $pendingOrders = $orders
        ->where('payment_status', 'pending')
        ->count();

    $paidOrders = $orders
        ->where('payment_status', 'paid')
        ->count();
@endphp


<body
    class="bg-slate-100 text-slate-900"
    x-data="{ sidebarOpen: false, profileOpen: false }"
>

{{-- ========================================================= --}}
{{-- OVERLAY MOBILE --}}
{{-- ========================================================= --}}

<div
    x-show="sidebarOpen"
    x-cloak
    @click="sidebarOpen = false"
    class="fixed inset-0 z-40 bg-slate-950/60 lg:hidden"
></div>


{{-- ========================================================= --}}
{{-- SIDEBAR --}}
{{-- ========================================================= --}}

<aside
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="
        fixed inset-y-0 left-0 z-50
        flex w-[280px] flex-col
        bg-slate-950 text-white
        transition-transform duration-300
        lg:translate-x-0
    "
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
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                class="h-5 w-5"
            >
                <path d="M6 6l12 12M18 6L6 18"/>
            </svg>
        </button>

    </div>


    {{-- MENU --}}
    <nav class="flex-1 overflow-y-auto px-4 py-6">

        <p class="mb-3 px-4 text-[10px] font-bold uppercase tracking-[.2em] text-slate-500">
            Administrator
        </p>


        {{-- DASHBOARD --}}
        <a
            href="{{ route('admin.dashboard') }}"
            class="
                flex items-center gap-3 rounded-xl
                px-4 py-3 text-sm font-semibold text-slate-400
                transition hover:bg-white/5 hover:text-white
            "
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

            Dashboard
        </a>


        {{-- ORDER --}}
        <a
            href="{{ route('admin.orders.index') }}"
            class="
                mt-2 flex items-center justify-between
                rounded-xl bg-sky-500
                px-4 py-3 text-sm font-bold text-white
            "
        >
            <div class="flex items-center gap-3">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    class="h-5 w-5"
                >
                    <path d="M5 4h14v16l-3-2-4 2-4-2-3 2Z"/>
                    <path d="M8 8h8M8 12h6"/>
                </svg>

                Order Masuk
            </div>

            @if($unreadOrders > 0)
                <span
                    class="
                        flex min-w-[24px] items-center justify-center
                        rounded-full bg-white px-2 py-1
                        text-[10px] font-black text-sky-600
                    "
                >
                    {{ $unreadOrders }}
                </span>
            @endif
        </a>


        {{-- RUTE --}}
        <a
            href="{{ route('admin.route.index') }}"
            class="
                mt-2 flex items-center gap-3 rounded-xl
                px-4 py-3 text-sm font-semibold text-slate-400
                transition hover:bg-white/5 hover:text-white
            "
        >
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                class="h-5 w-5"
            >
                <circle cx="6" cy="18" r="2"/>
                <circle cx="18" cy="6" r="2"/>
                <path d="M7.5 16.5c2-4 7-4 9-8.5"/>
            </svg>

            Manajemen Rute
        </a>


        {{-- SERVICE --}}
        <a
            href="{{ route('admin.services.index') }}"
            class="
                mt-2 flex items-center gap-3 rounded-xl
                px-4 py-3 text-sm font-semibold text-slate-400
                transition hover:bg-white/5 hover:text-white
            "
        >
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                class="h-5 w-5"
            >
                <path d="m14 7 3-3 3 3-3 3"/>
                <path d="M17 4c-4 0-7 3-7 7"/>
                <path d="M4 20 14 10"/>
            </svg>

            Catatan Servis
        </a>


        {{-- TAMBAH ARMADA --}}
        <a
            href="{{ route('admin.create') }}"
            class="
                mt-2 flex items-center gap-3 rounded-xl
                px-4 py-3 text-sm font-semibold text-slate-400
                transition hover:bg-white/5 hover:text-white
            "
        >
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                class="h-5 w-5"
            >
                <path d="M12 5v14M5 12h14"/>
            </svg>

            Tambah Armada
        </a>


        <p class="mb-3 mt-8 px-4 text-[10px] font-bold uppercase tracking-[.2em] text-slate-500">
            Website
        </p>


        {{-- USER DASHBOARD --}}
        <a
            href="{{ route('dashboard') }}"
            class="
                flex items-center gap-3 rounded-xl
                px-4 py-3 text-sm font-semibold text-slate-400
                transition hover:bg-white/5 hover:text-white
            "
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

            Dashboard User
        </a>


        {{-- LANDING --}}
        <a
            href="{{ url('/') }}"
            class="
                mt-2 flex items-center gap-3 rounded-xl
                px-4 py-3 text-sm font-semibold text-slate-400
                transition hover:bg-white/5 hover:text-white
            "
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
            </svg>

            Lihat Website
        </a>

    </nav>


    {{-- ACCOUNT --}}
    <div class="border-t border-white/10 p-4">

        <div class="relative">

            <button
                type="button"
                @click="profileOpen = !profileOpen"
                class="
                    flex w-full items-center gap-3 rounded-xl
                    p-3 text-left transition hover:bg-white/5
                "
            >

                <div
                    class="
                        flex h-10 w-10 shrink-0 items-center justify-center
                        rounded-xl bg-sky-500
                        text-sm font-black uppercase
                    "
                >
                    {{ mb_substr(Auth::user()->name, 0, 1) }}
                </div>

                <div class="min-w-0 flex-1">

                    <p class="truncate text-sm font-bold text-white">
                        {{ Auth::user()->name }}
                    </p>

                    <p class="text-[10px] uppercase tracking-wider text-sky-400">
                        Administrator
                    </p>

                </div>

            </button>


            <div
                x-show="profileOpen"
                x-cloak
                @click.outside="profileOpen = false"
                class="
                    absolute bottom-full left-0 right-0 mb-2
                    rounded-xl border border-slate-200
                    bg-white p-2 shadow-xl
                "
            >

                <a
                    href="{{ route('profile.edit') }}"
                    class="
                        block rounded-lg px-4 py-3
                        text-sm font-semibold text-slate-600
                        hover:bg-slate-50
                    "
                >
                    Profil Saya
                </a>

                <form
                    method="POST"
                    action="{{ route('logout') }}"
                >
                    @csrf

                    <button
                        type="submit"
                        class="
                            w-full rounded-lg px-4 py-3
                            text-left text-sm font-semibold text-red-500
                            hover:bg-red-50
                        "
                    >
                        Keluar
                    </button>
                </form>

            </div>

        </div>

    </div>

</aside>


{{-- ========================================================= --}}
{{-- MAIN --}}
{{-- ========================================================= --}}

<div class="lg:pl-[280px]">


    {{-- TOPBAR --}}
    <header
        class="
            sticky top-0 z-30
            flex h-20 items-center
            border-b border-slate-200
            bg-white/90 px-5 backdrop-blur-xl
            sm:px-7 lg:px-10
        "
    >

        <div class="flex w-full items-center justify-between">

            <div class="flex items-center gap-4">

                <button
                    type="button"
                    @click="sidebarOpen = true"
                    class="
                        flex h-10 w-10 items-center justify-center
                        rounded-xl border border-slate-200
                        text-slate-600 lg:hidden
                    "
                >
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        class="h-5 w-5"
                    >
                        <path d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <div>
                    <p class="text-xs font-medium text-slate-400">
                        Administrator
                    </p>

                    <h2 class="text-lg font-black text-slate-900">
                        Order Masuk
                    </h2>
                </div>

            </div>


            <div
                class="
                    flex h-10 w-10 items-center justify-center
                    rounded-xl bg-slate-950
                    text-sm font-black text-white
                "
            >
                {{ mb_substr(Auth::user()->name, 0, 1) }}
            </div>

        </div>

    </header>


    {{-- ===================================================== --}}
    {{-- CONTENT --}}
    {{-- ===================================================== --}}

    <main class="px-5 py-8 sm:px-7 lg:px-10">

        <div class="mx-auto max-w-7xl">


            {{-- SUCCESS --}}
            @if(session('success'))

                <div
                    x-data="{ show: true }"
                    x-show="show"
                    class="
                        mb-6 flex items-center justify-between gap-4
                        rounded-xl border border-emerald-200
                        bg-emerald-50 px-5 py-4
                    "
                >

                    <p class="text-sm font-semibold text-emerald-700">
                        {{ session('success') }}
                    </p>

                    <button
                        type="button"
                        @click="show = false"
                        class="text-emerald-600"
                    >
                        ×
                    </button>

                </div>

            @endif


            {{-- ================================================= --}}
            {{-- HEADER --}}
            {{-- ================================================= --}}

            <div
                class="
                    flex flex-col justify-between gap-5
                    md:flex-row md:items-end
                "
            >

                <div>

                    <p class="text-xs font-bold uppercase tracking-[.15em] text-sky-600">
                        Manajemen Pesanan
                    </p>

                    <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-950">
                        Pesanan yang masuk
                    </h1>

                    <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500">
                        Cek data pemesan, perjalanan dan status pembayaran
                        dari seluruh order VikensaTrans.
                    </p>

                </div>


                @if($unreadOrders > 0)

                    <form
                        action="{{ route('admin.orders.markRead') }}"
                        method="POST"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="
                                inline-flex items-center gap-2
                                rounded-xl border border-slate-200
                                bg-white px-4 py-3
                                text-xs font-bold text-slate-700
                                transition hover:border-sky-300 hover:text-sky-600
                            "
                        >

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                class="h-4 w-4"
                            >
                                <path d="m5 12 4 4L19 6"/>
                            </svg>

                            Tandai Semua Dibaca

                        </button>
                    </form>

                @endif

            </div>


            {{-- ================================================= --}}
            {{-- STAT --}}
            {{-- ================================================= --}}

            <div
                class="
                    mt-7 grid gap-4
                    sm:grid-cols-2 lg:grid-cols-4
                "
            >

                <div class="rounded-2xl border border-slate-200 bg-white p-5">
                    <p class="text-xs font-semibold text-slate-400">
                        Total Order
                    </p>

                    <p class="mt-2 text-2xl font-black text-slate-900">
                        {{ $totalOrders }}
                    </p>
                </div>


                <div class="rounded-2xl border border-slate-200 bg-white p-5">
                    <p class="text-xs font-semibold text-slate-400">
                        Order Baru
                    </p>

                    <p class="mt-2 text-2xl font-black text-sky-600">
                        {{ $unreadOrders }}
                    </p>
                </div>


                <div class="rounded-2xl border border-slate-200 bg-white p-5">
                    <p class="text-xs font-semibold text-slate-400">
                        Pending
                    </p>

                    <p class="mt-2 text-2xl font-black text-amber-500">
                        {{ $pendingOrders }}
                    </p>
                </div>


                <div class="rounded-2xl border border-slate-200 bg-white p-5">
                    <p class="text-xs font-semibold text-slate-400">
                        Lunas
                    </p>

                    <p class="mt-2 text-2xl font-black text-emerald-600">
                        {{ $paidOrders }}
                    </p>
                </div>

            </div>


            {{-- ================================================= --}}
            {{-- FILTER --}}
            {{-- ================================================= --}}

            <div
                class="
                    mt-8 flex flex-col gap-4
                    rounded-2xl border border-slate-200
                    bg-white p-4
                    md:flex-row md:items-center md:justify-between
                "
            >

                <div class="relative w-full md:max-w-sm">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        class="
                            absolute left-4 top-1/2
                            h-4 w-4 -translate-y-1/2
                            text-slate-400
                        "
                    >
                        <circle cx="11" cy="11" r="7"/>
                        <path d="m20 20-3.5-3.5"/>
                    </svg>

                    <input
                        type="text"
                        id="orderSearch"
                        placeholder="Cari kode, nama, nomor HP..."
                        class="
                            h-11 w-full rounded-xl
                            border border-slate-200 bg-slate-50
                            pl-11 pr-4
                            text-sm outline-none
                            focus:border-sky-500
                            focus:ring-2 focus:ring-sky-500/10
                        "
                    >

                </div>


                <div class="flex gap-2 overflow-x-auto">

                    <button
                        type="button"
                        data-filter="all"
                        class="
                            order-filter whitespace-nowrap
                            rounded-lg bg-slate-950
                            px-4 py-2.5
                            text-xs font-bold text-white
                        "
                    >
                        Semua
                    </button>

                    <button
                        type="button"
                        data-filter="unread"
                        class="
                            order-filter whitespace-nowrap
                            rounded-lg bg-slate-100
                            px-4 py-2.5
                            text-xs font-bold text-slate-600
                        "
                    >
                        Baru
                    </button>

                    <button
                        type="button"
                        data-filter="pending"
                        class="
                            order-filter whitespace-nowrap
                            rounded-lg bg-slate-100
                            px-4 py-2.5
                            text-xs font-bold text-slate-600
                        "
                    >
                        Pending
                    </button>

                    <button
                        type="button"
                        data-filter="paid"
                        class="
                            order-filter whitespace-nowrap
                            rounded-lg bg-slate-100
                            px-4 py-2.5
                            text-xs font-bold text-slate-600
                        "
                    >
                        Lunas
                    </button>

                </div>

            </div>


            {{-- ================================================= --}}
            {{-- ORDER TABLE --}}
            {{-- ================================================= --}}

            <div
                class="
                    mt-5 overflow-hidden
                    rounded-2xl
                    border border-slate-200
                    bg-white
                "
            >

                <div class="overflow-x-auto">

                    <table class="w-full min-w-[1180px]">

                        <thead class="bg-slate-50">

                            <tr
                                class="
                                    border-b border-slate-200
                                    text-left
                                "
                            >

                                <th class="px-5 py-4 text-[10px] font-black uppercase tracking-wider text-slate-400">
                                    Booking
                                </th>

                                <th class="px-5 py-4 text-[10px] font-black uppercase tracking-wider text-slate-400">
                                    Pemesan
                                </th>

                                <th class="px-5 py-4 text-[10px] font-black uppercase tracking-wider text-slate-400">
                                    Perjalanan
                                </th>

                                <th class="px-5 py-4 text-[10px] font-black uppercase tracking-wider text-slate-400">
                                    Armada
                                </th>

                                <th class="px-5 py-4 text-[10px] font-black uppercase tracking-wider text-slate-400">
                                    Harga
                                </th>

                                <th class="px-5 py-4 text-[10px] font-black uppercase tracking-wider text-slate-400">
                                    Status
                                </th>

                                <th class="px-5 py-4 text-right text-[10px] font-black uppercase tracking-wider text-slate-400">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody id="orderTableBody">

                            @forelse($orders as $order)

                                @php
                                    $departure = $order->custom_departure_time
                                        ? \Carbon\Carbon::parse($order->custom_departure_time)
                                        : null;

                                    $arrival = $order->custom_arrival_time
                                        ? \Carbon\Carbon::parse($order->custom_arrival_time)
                                        : null;

                                    $isUnread = !(bool) $order->is_read;
                                @endphp


                                <tr
                                    class="
                                        order-row
                                        border-b border-slate-100
                                        last:border-0

                                        {{ $isUnread
                                            ? 'bg-sky-50/40'
                                            : 'bg-white'
                                        }}

                                        hover:bg-slate-50
                                    "

                                    data-status="{{ $order->payment_status }}"
                                    data-read="{{ $isUnread ? 'unread' : 'read' }}"

                                    data-search="{{
                                        strtolower(
                                            ($order->booking_code ?? '') . ' ' .
                                            ($order->booker_name ?? '') . ' ' .
                                            ($order->phone_number ?? '') . ' ' .
                                            ($order->custom_origin ?? '') . ' ' .
                                            ($order->custom_destination ?? '')
                                        )
                                    }}"
                                >


                                    {{-- BOOKING --}}
                                    <td class="px-5 py-5 align-top">

                                        <div class="flex items-start gap-3">

                                            @if($isUnread)

                                                <span
                                                    class="
                                                        mt-1.5 h-2.5 w-2.5 shrink-0
                                                        rounded-full bg-sky-500
                                                    "
                                                    title="Pesanan baru"
                                                ></span>

                                            @else

                                                <span
                                                    class="
                                                        mt-1.5 h-2.5 w-2.5 shrink-0
                                                        rounded-full bg-slate-200
                                                    "
                                                ></span>

                                            @endif


                                            <div>

                                                <p class="font-black text-sky-600">
                                                    {{ $order->booking_code }}
                                                </p>


                                                <p class="mt-1 text-xs font-semibold text-slate-500">
                                                    {{ $order->created_at->format('d M Y') }}
                                                </p>


                                                <p class="mt-0.5 text-[11px] text-slate-400">
                                                    {{ $order->created_at->format('H:i') }} WIB
                                                </p>

                                            </div>

                                        </div>

                                    </td>



                                    {{-- PEMESAN --}}
                                    <td class="px-5 py-5 align-top">

                                        <p class="font-bold text-slate-900">
                                            {{
                                                $order->booker_name
                                                ?? ($order->user->name ?? 'Pengguna')
                                            }}
                                        </p>


                                        <p class="mt-1 text-xs font-semibold text-slate-500">
                                            {{ $order->phone_number ?? '-' }}
                                        </p>


                                        <p
                                            class="
                                                mt-2 max-w-[220px]
                                                truncate text-xs text-slate-400
                                            "
                                            title="{{ $order->pickup_address }}"
                                        >
                                            {{ $order->pickup_address ?? 'Alamat jemput belum ada' }}
                                        </p>

                                    </td>



                                    {{-- PERJALANAN --}}
                                    <td class="px-5 py-5 align-top">

                                        <div class="flex items-center gap-2">

                                            <span class="font-bold text-slate-800">
                                                {{ $order->custom_origin ?? '-' }}
                                            </span>

                                            <svg
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                class="h-4 w-4 shrink-0 text-sky-500"
                                            >
                                                <path d="M5 12h14"/>
                                                <path d="m13 6 6 6-6 6"/>
                                            </svg>

                                            <span class="font-bold text-slate-800">
                                                {{ $order->custom_destination ?? '-' }}
                                            </span>

                                        </div>


                                        @if($departure)

                                            <p class="mt-2 text-xs text-slate-500">
                                                {{ $departure->format('d M Y, H:i') }} WIB
                                            </p>

                                        @endif


                                        @if($arrival)

                                            <p class="mt-1 text-[11px] text-slate-400">
                                                Selesai:
                                                {{ $arrival->format('d M Y, H:i') }} WIB
                                            </p>

                                        @endif

                                    </td>



                                    {{-- ARMADA --}}
                                    <td class="px-5 py-5 align-top">

                                        <p class="font-bold text-slate-800">
                                            {{
                                                $order->schedule?->shuttle?->name
                                                ?? 'Armada Charter'
                                            }}
                                        </p>


                                        @if(
                                            $order->schedule?->shuttle?->license_plate
                                        )

                                            <p
                                                class="
                                                    mt-1 text-xs font-semibold
                                                    uppercase text-slate-400
                                                "
                                            >
                                                {{
                                                    $order
                                                        ->schedule
                                                        ->shuttle
                                                        ->license_plate
                                                }}
                                            </p>

                                        @endif

                                    </td>



                                    {{-- HARGA --}}
                                    <td class="px-5 py-5 align-top">

                                        <p class="whitespace-nowrap font-black text-slate-900">
                                            Rp {{ number_format(
                                                $order->total_price,
                                                0,
                                                ',',
                                                '.'
                                            ) }}
                                        </p>

                                    </td>



                                    {{-- STATUS --}}
                                    <td class="px-5 py-5 align-top">

                                        @if($order->payment_status === 'paid')

                                            <span
                                                class="
                                                    inline-flex items-center gap-1.5
                                                    rounded-full bg-emerald-100
                                                    px-3 py-1.5
                                                    text-[10px] font-black
                                                    uppercase text-emerald-700
                                                "
                                            >
                                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                                Lunas
                                            </span>

                                        @elseif($order->payment_status === 'cancelled')

                                            <span
                                                class="
                                                    inline-flex items-center gap-1.5
                                                    rounded-full bg-red-100
                                                    px-3 py-1.5
                                                    text-[10px] font-black
                                                    uppercase text-red-600
                                                "
                                            >
                                                <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>
                                                Dibatalkan
                                            </span>

                                        @else

                                            <span
                                                class="
                                                    inline-flex items-center gap-1.5
                                                    rounded-full bg-amber-100
                                                    px-3 py-1.5
                                                    text-[10px] font-black
                                                    uppercase text-amber-700
                                                "
                                            >
                                                <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                                Pending
                                            </span>

                                        @endif

                                    </td>



                                    {{-- ACTION --}}
                                    <td class="px-5 py-5 align-top">

                                        <div class="flex items-center justify-end gap-2">


                                            {{-- UPDATE STATUS --}}
                                            @if($order->payment_status !== 'cancelled')

                                                <form
                                                    action="{{ route(
                                                        'admin.orders.updateStatus',
                                                        $order->id
                                                    ) }}"
                                                    method="POST"
                                                    class="flex items-center gap-2"
                                                >

                                                    @csrf
                                                    @method('PUT')


                                                    <select
                                                        name="payment_status"
                                                        class="
                                                            h-9 rounded-lg
                                                            border border-slate-200
                                                            bg-white
                                                            px-3 pr-8
                                                            text-xs font-bold
                                                            text-slate-600
                                                            focus:border-sky-500
                                                            focus:ring-sky-500
                                                        "
                                                    >

                                                        <option
                                                            value="pending"
                                                            {{
                                                                $order->payment_status === 'pending'
                                                                    ? 'selected'
                                                                    : ''
                                                            }}
                                                        >
                                                            Pending
                                                        </option>


                                                        <option
                                                            value="paid"
                                                            {{
                                                                $order->payment_status === 'paid'
                                                                    ? 'selected'
                                                                    : ''
                                                            }}
                                                        >
                                                            Lunas
                                                        </option>

                                                    </select>


                                                    <button
                                                        type="submit"
                                                        class="
                                                            h-9 rounded-lg
                                                            bg-slate-950
                                                            px-3
                                                            text-xs font-bold
                                                            text-white
                                                            transition
                                                            hover:bg-sky-600
                                                        "
                                                    >
                                                        Simpan
                                                    </button>

                                                </form>

                                            @endif



                                            {{-- RECEIPT --}}
                                            @if($order->payment_status === 'paid')

                                                <a
                                                    href="{{ route(
                                                        'booking.receipt',
                                                        $order->id
                                                    ) }}"
                                                    target="_blank"
                                                    title="Kwitansi"

                                                    class="
                                                        flex h-9 w-9
                                                        shrink-0 items-center justify-center
                                                        rounded-lg
                                                        bg-sky-50 text-sky-600
                                                        transition
                                                        hover:bg-sky-500
                                                        hover:text-white
                                                    "
                                                >

                                                    <svg
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="1.8"
                                                        class="h-4 w-4"
                                                    >
                                                        <path d="M6 2h9l4 4v16H6Z"/>
                                                        <path d="M14 2v5h5"/>
                                                        <path d="M9 13h6M9 17h6"/>
                                                    </svg>

                                                </a>

                                            @endif

                                        </div>

                                    </td>

                                </tr>


                            @empty

                                <tr>

                                    <td
                                        colspan="7"
                                        class="px-6 py-16 text-center"
                                    >

                                        <div
                                            class="
                                                mx-auto flex h-14 w-14
                                                items-center justify-center
                                                rounded-2xl bg-slate-100
                                                text-slate-400
                                            "
                                        >
                                            <svg
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.7"
                                                class="h-6 w-6"
                                            >
                                                <path d="M5 4h14v16l-3-2-4 2-4-2-3 2Z"/>
                                                <path d="M8 8h8M8 12h6"/>
                                            </svg>
                                        </div>

                                        <p class="mt-4 font-bold text-slate-800">
                                            Belum ada order masuk
                                        </p>

                                        <p class="mt-1 text-sm text-slate-400">
                                            Pesanan pelanggan akan muncul di sini.
                                        </p>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- NO SEARCH RESULT --}}
                <div
                    id="emptySearch"
                    class="hidden px-6 py-14 text-center"
                >
                    <p class="font-bold text-slate-700">
                        Pesanan tidak ditemukan
                    </p>

                    <p class="mt-1 text-sm text-slate-400">
                        Coba gunakan kata pencarian atau filter yang lain.
                    </p>
                </div>

            </div>


            {{-- FOOTER --}}
            <footer
                class="
                    mt-10 flex flex-col gap-2
                    border-t border-slate-200 py-6
                    text-xs text-slate-400
                    sm:flex-row sm:justify-between
                "
            >
                <p>
                    © {{ date('Y') }} VikensaTrans.
                </p>

                <p>
                    Administrator Panel
                </p>
            </footer>

        </div>

    </main>

</div>


{{-- ========================================================= --}}
{{-- FILTER SCRIPT --}}
{{-- ========================================================= --}}

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const searchInput =
            document.getElementById('orderSearch');

        const filterButtons =
            document.querySelectorAll('.order-filter');

        const rows =
            document.querySelectorAll('.order-row');

        const emptySearch =
            document.getElementById('emptySearch');

        let activeFilter = 'all';


        function filterOrders() {

            const keyword =
                searchInput.value
                    .toLowerCase()
                    .trim();

            let visible = 0;


            rows.forEach(function (row) {

                const status =
                    row.dataset.status;

                const readStatus =
                    row.dataset.read;

                const searchText =
                    row.dataset.search || '';


                let filterMatch = false;


                if (activeFilter === 'all') {

                    filterMatch = true;

                } else if (activeFilter === 'unread') {

                    filterMatch =
                        readStatus === 'unread';

                } else {

                    filterMatch =
                        status === activeFilter;

                }


                const searchMatch =
                    searchText.includes(keyword);


                if (
                    filterMatch &&
                    searchMatch
                ) {

                    row.classList.remove('hidden');

                    visible++;

                } else {

                    row.classList.add('hidden');

                }

            });


            if (
                visible === 0 &&
                rows.length > 0
            ) {

                emptySearch.classList.remove('hidden');

            } else {

                emptySearch.classList.add('hidden');

            }

        }


        searchInput.addEventListener(
            'input',
            filterOrders
        );


        filterButtons.forEach(function (button) {

            button.addEventListener(
                'click',
                function () {

                    activeFilter =
                        button.dataset.filter;


                    filterButtons.forEach(
                        function (item) {

                            item.classList.remove(
                                'bg-slate-950',
                                'text-white'
                            );

                            item.classList.add(
                                'bg-slate-100',
                                'text-slate-600'
                            );

                        }
                    );


                    button.classList.remove(
                        'bg-slate-100',
                        'text-slate-600'
                    );

                    button.classList.add(
                        'bg-slate-950',
                        'text-white'
                    );


                    filterOrders();

                }
            );

        });

    });
</script>


</body>

</html>