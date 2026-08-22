<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <meta name="description"
          content="Panel Administrator VikensaTrans">

    <title>Admin Dashboard - VikensaTrans</title>

    <link rel="icon"
          href="{{ asset('favicon.ico') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

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

        ::selection {
            background: #0ea5e9;
            color: white;
        }

        .stat-card {
            transition:
                transform .25s ease,
                box-shadow .25s ease,
                border-color .25s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            border-color: rgba(14, 165, 233, .25);
            box-shadow: 0 20px 50px rgba(15, 23, 42, .07);
        }
    </style>
</head>


<body
    class="bg-slate-100 text-slate-900 antialiased"
    x-data="{
        sidebarOpen: false
    }"
>

@php

    /*
    |--------------------------------------------------------------------------
    | DATA STATISTIK
    |--------------------------------------------------------------------------
    */

    $totalSchedules = $schedules->count();

    $totalUnits = $schedules
        ->pluck('shuttle_id')
        ->unique()
        ->count();

    $availableCount = $schedules
        ->filter(function ($schedule) {
            return (bool) $schedule->is_available;
        })
        ->count();

    $unavailableCount = $schedules
        ->filter(function ($schedule) {
            return !(bool) $schedule->is_available;
        })
        ->count();

    $averagePrice = $schedules->count() > 0
        ? $schedules->avg('price')
        : 0;

@endphp



{{-- ========================================================= --}}
{{-- MOBILE SIDEBAR OVERLAY --}}
{{-- ========================================================= --}}

<div
    x-show="sidebarOpen"
    x-cloak
    x-transition.opacity

    @click="sidebarOpen = false"

    class="
        fixed
        inset-0
        z-40
        bg-slate-950/60
        backdrop-blur-sm
        lg:hidden
    "
></div>



{{-- ========================================================= --}}
{{-- SIDEBAR --}}
{{-- ========================================================= --}}

<aside

    :class="
        sidebarOpen
            ? 'translate-x-0'
            : '-translate-x-full'
    "

    class="
        fixed
        inset-y-0
        left-0
        z-50

        flex
        w-[285px]
        flex-col

        border-r
        border-white/10

        bg-slate-950
        text-white

        transition-transform
        duration-300

        lg:translate-x-0
    "
>


    {{-- ===================================================== --}}
    {{-- BRAND --}}
    {{-- ===================================================== --}}

    <div
        class="
            flex
            h-24
            items-center
            justify-between

            border-b
            border-white/10

            px-6
        "
    >

        <a
            href="{{ route('admin.dashboard') }}"
            class="flex items-center gap-3"
        >

            <div
                class="
                    flex
                    h-11
                    w-11
                    shrink-0
                    items-center
                    justify-center

                    rounded-xl

                    bg-sky-500

                    text-white

                    shadow-lg
                    shadow-sky-500/20
                "
            >

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    class="h-6 w-6"
                >
                    <path
                        d="M12 2 20 6v6c0 5-3.5 8.5-8 10-4.5-1.5-8-5-8-10V6Z"
                    />

                    <path
                        d="m9 12 2 2 4-4"
                    />
                </svg>

            </div>


            <div>

                <p
                    class="
                        text-xl
                        font-black
                        tracking-tight
                        text-white
                    "
                >
                    Vikensa<span class="text-sky-400">Trans</span>
                </p>


                <p
                    class="
                        mt-0.5
                        text-[9px]
                        font-bold
                        uppercase
                        tracking-[.22em]
                        text-slate-500
                    "
                >
                    Administrator
                </p>

            </div>

        </a>


        <button
            @click="sidebarOpen = false"

            type="button"

            class="
                flex
                h-10
                w-10
                items-center
                justify-center

                rounded-xl

                text-slate-400

                transition

                hover:bg-white/10
                hover:text-white

                lg:hidden
            "
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



    {{-- ===================================================== --}}
    {{-- ADMIN NAVIGATION --}}
    {{-- ===================================================== --}}

    <nav
        class="
            flex-1
            overflow-y-auto

            px-4
            py-6
        "
    >

        <p
            class="
                mb-3
                px-4

                text-[10px]
                font-black
                uppercase
                tracking-[.2em]

                text-slate-500
            "
        >
            Administrasi
        </p>



        {{-- DASHBOARD ADMIN --}}

        <a
            href="{{ route('admin.dashboard') }}"

            class="
                flex
                items-center
                gap-3

                rounded-2xl

                bg-sky-500

                px-4
                py-3.5

                text-sm
                font-bold
                text-white

                shadow-lg
                shadow-sky-500/10
            "
        >

            <div
                class="
                    flex
                    h-9
                    w-9
                    items-center
                    justify-center

                    rounded-xl

                    bg-white/15
                "
            >

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    class="h-5 w-5"
                >
                    <rect
                        x="3"
                        y="3"
                        width="7"
                        height="7"
                        rx="1"
                    />

                    <rect
                        x="14"
                        y="3"
                        width="7"
                        height="7"
                        rx="1"
                    />

                    <rect
                        x="3"
                        y="14"
                        width="7"
                        height="7"
                        rx="1"
                    />

                    <rect
                        x="14"
                        y="14"
                        width="7"
                        height="7"
                        rx="1"
                    />
                </svg>

            </div>

            Dashboard Admin

        </a>



        {{-- TAMBAH ARMADA --}}

        <a
            href="{{ route('admin.create') }}"

            class="
                mt-2

                flex
                items-center
                gap-3

                rounded-2xl

                px-4
                py-3.5

                text-sm
                font-semibold
                text-slate-400

                transition

                hover:bg-white/5
                hover:text-white
            "
        >

            <div
                class="
                    flex
                    h-9
                    w-9
                    items-center
                    justify-center

                    rounded-xl

                    bg-white/5
                "
            >

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    class="h-5 w-5"
                >
                    <path d="M12 5v14"/>
                    <path d="M5 12h14"/>
                </svg>

            </div>

            Tambah Armada

        </a>
        
        {{-- MANAJEMEN RUTE --}}
        <a
            href="{{ route('admin.route.index') }}"
            class="
                mt-2
                flex
                items-center
                gap-3
                rounded-2xl
                px-4
                py-3.5
                text-sm
                font-semibold
                text-slate-400
                transition
                hover:bg-white/5
                hover:text-white
            "
        >
            <div
                class="
                    flex
                    h-9
                    w-9
                    items-center
                    justify-center
                    rounded-xl
                    bg-white/5
                "
            >
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                </svg>
            </div>
            Manajemen Rute
        </a>

       {{-- MENU DATA ORDER --}}
        @php
            $unreadOrdersCount = \App\Models\Booking::where('is_read', false)->count();
        @endphp
        <a
            href="{{ route('admin.orders.index') }}"
            class="
                mt-2
                flex
                items-center
                justify-between
                rounded-2xl
                px-4
                py-3.5
                text-sm
                font-semibold
                text-slate-400
                transition
                hover:bg-white/5
                hover:text-white
            "
        >
            <div class="flex items-center gap-3">
                <div
                    class="
                        flex
                        h-9
                        w-9
                        items-center
                        justify-center
                        rounded-xl
                        bg-white/5
                    "
                >
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012-2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                </div>
                Data Order
            </div>

            {{-- BADGE ANGKA ORDER MASUK --}}
            @if($unreadOrdersCount > 0)
                <span class="flex h-5 min-w-[20px] items-center justify-center rounded-full bg-sky-500 px-1.5 text-[10px] font-black text-white">
                    {{ $unreadOrdersCount }}
                </span>
            @endif
        </a>


        {{-- MENU CATATAN SERVIS --}}
        <a
            href="{{ route('admin.services.index') }}"
            class="
                mt-2
                flex
                items-center
                gap-3
                rounded-2xl
                px-4
                py-3.5
                text-sm
                font-semibold
                text-slate-400
                transition
                hover:bg-white/5
                hover:text-white
            "
        >
            <div
                class="
                    flex
                    h-9
                    w-9
                    items-center
                    justify-center
                    rounded-xl
                    bg-white/5
                "
            >
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z" />
                </svg>
            </div>
            Catatan Servis
        </a>



        {{-- DIVIDER --}}

        <p
            class="
                mb-3
                mt-8
                px-4

                text-[10px]
                font-black
                uppercase
                tracking-[.2em]

                text-slate-500
            "
        >
            Website
        </p>



        {{-- DASHBOARD USER --}}

        <a
            href="{{ route('dashboard') }}"

            class="
                flex
                items-center
                gap-3

                rounded-2xl

                px-4
                py-3.5

                text-sm
                font-semibold
                text-slate-400

                transition

                hover:bg-white/5
                hover:text-white
            "
        >

            <div
                class="
                    flex
                    h-9
                    w-9
                    items-center
                    justify-center

                    rounded-xl

                    bg-white/5
                "
            >

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    class="h-5 w-5"
                >
                    <circle
                        cx="12"
                        cy="8"
                        r="4"
                    />

                    <path
                        d="M4 21c0-5 3-8 8-8s8 3 8 8"
                    />
                </svg>

            </div>

            Dashboard User

        </a>



        {{-- LANDING PAGE --}}

        <a
            href="{{ url('/') }}"

            class="
                mt-2

                flex
                items-center
                gap-3

                rounded-2xl

                px-4
                py-3.5

                text-sm
                font-semibold
                text-slate-400

                transition

                hover:bg-white/5
                hover:text-white
            "
        >

            <div
                class="
                    flex
                    h-9
                    w-9
                    items-center
                    justify-center

                    rounded-xl

                    bg-white/5
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

                    <path d="M9 20v-6h6v6"/>
                </svg>

            </div>

            Lihat Website

        </a>



        {{-- ===================================================== --}}
        {{-- ADMIN INFO --}}
        {{-- ===================================================== --}}

        <div
            class="
                mt-9

                rounded-3xl

                border
                border-white/10

                bg-white/[.04]

                p-5
            "
        >

            <div
                class="
                    flex
                    h-10
                    w-10
                    items-center
                    justify-center

                    rounded-xl

                    bg-amber-400/10

                    text-amber-400
                "
            >

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    class="h-5 w-5"
                >
                    <path
                        d="M12 3 2 21h20Z"
                    />

                    <path
                        d="M12 9v4"
                    />

                    <path
                        d="M12 17h.01"
                    />
                </svg>

            </div>


            <p
                class="
                    mt-4
                    text-sm
                    font-black
                    text-white
                "
            >
                Area Administrator
            </p>


            <p
                class="
                    mt-2
                    text-xs
                    leading-6
                    text-slate-500
                "
            >
                Perubahan data armada dan jadwal akan langsung
                memengaruhi informasi yang dilihat pengguna.
            </p>

        </div>

    </nav>



    {{-- ===================================================== --}}
    {{-- ADMIN ACCOUNT --}}
    {{-- ===================================================== --}}

    <div
        class="
            border-t
            border-white/10
            p-4
        "
    >

        <div
            x-data="{ adminMenu: false }"

            class="relative"
        >

            <button
                @click="adminMenu = !adminMenu"

                type="button"

                class="
                    flex
                    w-full
                    items-center
                    gap-3

                    rounded-2xl

                    p-3

                    text-left

                    transition

                    hover:bg-white/5
                "
            >

                <div
                    class="
                        flex
                        h-11
                        w-11
                        shrink-0
                        items-center
                        justify-center

                        rounded-xl

                        bg-sky-500

                        text-sm
                        font-black
                        uppercase
                        text-white
                    "
                >
                    {{ mb_substr(Auth::user()->name, 0, 1) }}
                </div>


                <div
                    class="
                        min-w-0
                        flex-1
                    "
                >

                    <p
                        class="
                            truncate
                            text-sm
                            font-bold
                            text-white
                        "
                    >
                        {{ Auth::user()->name }}
                    </p>


                    <p
                        class="
                            mt-0.5
                            text-[10px]
                            font-bold
                            uppercase
                            tracking-wider
                            text-sky-400
                        "
                    >
                        Administrator
                    </p>

                </div>


                <svg
                    :class="
                        adminMenu
                            ? 'rotate-180'
                            : ''
                    "

                    viewBox="0 0 24 24"

                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"

                    class="
                        h-4
                        w-4

                        text-slate-500

                        transition
                    "
                >
                    <path d="m6 9 6 6 6-6"/>
                </svg>

            </button>



            {{-- ADMIN DROPDOWN --}}

            <div
                x-show="adminMenu"
                x-cloak
                x-transition

                @click.outside="adminMenu = false"

                class="
                    absolute
                    bottom-full
                    left-0
                    right-0

                    mb-2

                    overflow-hidden

                    rounded-2xl

                    border
                    border-slate-200

                    bg-white

                    p-2

                    shadow-2xl
                "
            >

                <a
                    href="{{ route('profile.edit') }}"

                    class="
                        block

                        rounded-xl

                        px-4
                        py-3

                        text-sm
                        font-semibold
                        text-slate-600

                        transition

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
                            block
                            w-full

                            rounded-xl

                            px-4
                            py-3

                            text-left
                            text-sm
                            font-semibold
                            text-red-500

                            transition

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
{{-- MAIN CONTENT WRAPPER --}}
{{-- ========================================================= --}}

<div
    class="lg:pl-[285px]"
>


    {{-- ===================================================== --}}
    {{-- ADMIN TOPBAR --}}
    {{-- ===================================================== --}}

    <header
        class="
            sticky
            top-0
            z-30

            flex
            h-20
            items-center

            border-b
            border-slate-200

            bg-white/90

            px-5

            backdrop-blur-xl

            sm:px-7
            lg:px-10
        "
    >

        <div
            class="
                flex
                w-full
                items-center
                justify-between
                gap-5
            "
        >

            <div
                class="
                    flex
                    items-center
                    gap-4
                "
            >

                {{-- MOBILE MENU --}}

                <button
                    @click="sidebarOpen = true"

                    type="button"

                    class="
                        flex
                        h-11
                        w-11
                        items-center
                        justify-center

                        rounded-xl

                        border
                        border-slate-200

                        text-slate-600

                        transition

                        hover:bg-slate-50

                        lg:hidden
                    "
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

                    <p
                        class="
                            text-xs
                            font-semibold
                            text-slate-400
                        "
                    >
                        Administrator Panel
                    </p>


                    <h2
                        class="
                            text-lg
                            font-black
                            text-slate-950
                        "
                    >
                        Manajemen Armada
                    </h2>

                </div>

            </div>



            <div
                class="
                    flex
                    items-center
                    gap-3
                "
            >

                <a
                    href="{{ route('admin.create') }}"

                    class="
                        hidden

                        items-center
                        gap-2

                        rounded-xl

                        bg-sky-500

                        px-5
                        py-3

                        text-sm
                        font-black
                        text-white

                        shadow-lg
                        shadow-sky-500/20

                        transition

                        hover:bg-sky-400

                        sm:flex
                    "
                >

                    <span class="text-lg leading-none">
                        +
                    </span>

                    Tambah Data

                </a>


                <div
                    class="
                        flex
                        h-11
                        w-11
                        items-center
                        justify-center

                        rounded-xl

                        bg-slate-950

                        text-sm
                        font-black
                        uppercase
                        text-white
                    "
                >
                    {{ mb_substr(Auth::user()->name, 0, 1) }}
                </div>

            </div>

        </div>

    </header>



    {{-- ===================================================== --}}
    {{-- MAIN --}}
    {{-- ===================================================== --}}

    <main
        class="
            px-5
            py-8

            sm:px-7

            lg:px-10
            lg:py-10
        "
    >

        <div
            class="
                mx-auto
                max-w-7xl
            "
        >


            {{-- ================================================= --}}
            {{-- SUCCESS MESSAGE --}}
            {{-- ================================================= --}}

            @if(session('success'))

                <div
                    x-data="{ show: true }"

                    x-show="show"

                    x-transition

                    class="
                        mb-7

                        flex
                        items-start
                        justify-between
                        gap-4

                        rounded-2xl

                        border
                        border-emerald-200

                        bg-emerald-50

                        px-5
                        py-4
                    "
                >

                    <div
                        class="
                            flex
                            items-start
                            gap-3
                        "
                    >

                        <span
                            class="
                                flex
                                h-7
                                w-7
                                shrink-0
                                items-center
                                justify-center

                                rounded-full

                                bg-emerald-100

                                text-sm
                                font-black
                                text-emerald-600
                            "
                        >
                            ✓
                        </span>


                        <div>

                            <p
                                class="
                                    text-sm
                                    font-black
                                    text-emerald-700
                                "
                            >
                                Berhasil
                            </p>


                            <p
                                class="
                                    mt-1
                                    text-sm
                                    text-emerald-600
                                "
                            >
                                {{ session('success') }}
                            </p>

                        </div>

                    </div>


                    <button
                        @click="show = false"

                        class="
                            text-lg
                            text-emerald-500
                        "
                    >
                        ×
                    </button>

                </div>

            @endif



            {{-- ================================================= --}}
            {{-- ADMIN HERO --}}
            {{-- ================================================= --}}

            <section
                class="
                    relative

                    overflow-hidden

                    rounded-[2rem]

                    bg-gradient-to-r
                    from-slate-950
                    via-slate-900
                    to-blue-950

                    px-6
                    py-9

                    text-white

                    sm:px-9
                    lg:px-11
                    lg:py-11
                "
            >

                <div
                    class="
                        pointer-events-none

                        absolute
                        -right-24
                        -top-28

                        h-80
                        w-80

                        rounded-full

                        bg-sky-500/20

                        blur-[100px]
                    "
                ></div>


                <div
                    class="
                        relative
                        z-10

                        flex
                        flex-col
                        justify-between
                        gap-8

                        lg:flex-row
                        lg:items-end
                    "
                >

                    <div
                        class="max-w-2xl"
                    >

                        <div
                            class="
                                inline-flex
                                items-center
                                gap-2

                                rounded-full

                                border
                                border-sky-400/20

                                bg-sky-400/10

                                px-4
                                py-2

                                text-xs
                                font-bold
                                text-sky-300
                            "
                        >

                            <span
                                class="
                                    h-2
                                    w-2
                                    rounded-full
                                    bg-emerald-400
                                "
                            ></span>

                            Sistem Administrator Aktif

                        </div>


                        <h1
                            class="
                                mt-5

                                text-3xl
                                font-black
                                tracking-tight

                                sm:text-4xl
                                lg:text-5xl
                            "
                        >
                            Halo,

                            <span class="text-sky-400">
                                {{ Auth::user()->name }}.
                            </span>
                        </h1>


                        <p
                            class="
                                mt-4

                                max-w-xl

                                text-sm
                                leading-7
                                text-slate-400

                                sm:text-base
                            "
                        >
                            Kelola armada, jadwal, harga sewa,
                            rute perjalanan dan status ketersediaan
                            VikensaTrans dari satu halaman.
                        </p>

                    </div>



                    <a
                        href="{{ route('admin.create') }}"

                        class="
                            inline-flex
                            shrink-0

                            items-center
                            justify-center
                            gap-3

                            rounded-2xl

                            bg-sky-500

                            px-6
                            py-4

                            text-sm
                            font-black
                            text-white

                            shadow-xl
                            shadow-sky-500/20

                            transition

                            hover:-translate-y-1
                            hover:bg-sky-400
                        "
                    >

                        <span class="text-xl leading-none">
                            +
                        </span>

                        Tambah Armada & Jadwal

                    </a>

                </div>

            </section>



            {{-- ================================================= --}}
            {{-- STATISTICS --}}
            {{-- ================================================= --}}

            <section
                class="
                    mt-7

                    grid
                    gap-4

                    sm:grid-cols-2
                    xl:grid-cols-4
                "
            >


                {{-- TOTAL ARMADA --}}

                <div
                    class="
                        stat-card

                        rounded-3xl

                        border
                        border-slate-200

                        bg-white

                        p-6
                    "
                >

                    <div
                        class="
                            flex
                            items-start
                            justify-between
                            gap-4
                        "
                    >

                        <div>

                            <p
                                class="
                                    text-sm
                                    font-semibold
                                    text-slate-500
                                "
                            >
                                Total Armada
                            </p>


                            <p
                                class="
                                    mt-3

                                    text-3xl
                                    font-black
                                    text-slate-950
                                "
                            >
                                {{ $totalUnits }}
                            </p>


                            <p
                                class="
                                    mt-1
                                    text-xs
                                    text-slate-400
                                "
                            >
                                Unit terdaftar
                            </p>

                        </div>


                        <div
                            class="
                                flex
                                h-12
                                w-12
                                items-center
                                justify-center

                                rounded-2xl

                                bg-sky-50

                                text-sky-600
                            "
                        >

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                class="h-6 w-6"
                            >
                                <path
                                    d="M3 13l2-5a3 3 0 0 1 2.8-2h8.4A3 3 0 0 1 19 8l2 5"
                                />

                                <path
                                    d="M5 13h14a2 2 0 0 1 2 2v3H3v-3a2 2 0 0 1 2-2Z"
                                />
                            </svg>

                        </div>

                    </div>

                </div>



                {{-- AVAILABLE --}}

                <div
                    class="
                        stat-card

                        rounded-3xl

                        border
                        border-slate-200

                        bg-white

                        p-6
                    "
                >

                    <div
                        class="
                            flex
                            items-start
                            justify-between
                            gap-4
                        "
                    >

                        <div>

                            <p
                                class="
                                    text-sm
                                    font-semibold
                                    text-slate-500
                                "
                            >
                                Tersedia
                            </p>


                            <p
                                class="
                                    mt-3

                                    text-3xl
                                    font-black
                                    text-emerald-600
                                "
                            >
                                {{ $availableCount }}
                            </p>


                            <p
                                class="
                                    mt-1
                                    text-xs
                                    text-slate-400
                                "
                            >
                                Bisa dipesan
                            </p>

                        </div>


                        <div
                            class="
                                flex
                                h-12
                                w-12
                                items-center
                                justify-center

                                rounded-2xl

                                bg-emerald-50

                                font-black
                                text-emerald-600
                            "
                        >
                            ✓
                        </div>

                    </div>

                </div>



                {{-- RENTED --}}

                <div
                    class="
                        stat-card

                        rounded-3xl

                        border
                        border-slate-200

                        bg-white

                        p-6
                    "
                >

                    <div
                        class="
                            flex
                            items-start
                            justify-between
                            gap-4
                        "
                    >

                        <div>

                            <p
                                class="
                                    text-sm
                                    font-semibold
                                    text-slate-500
                                "
                            >
                                Sedang Disewa
                            </p>


                            <p
                                class="
                                    mt-3

                                    text-3xl
                                    font-black
                                    text-amber-500
                                "
                            >
                                {{ $unavailableCount }}
                            </p>


                            <p
                                class="
                                    mt-1
                                    text-xs
                                    text-slate-400
                                "
                            >
                                Tidak tersedia
                            </p>

                        </div>


                        <div
                            class="
                                flex
                                h-12
                                w-12
                                items-center
                                justify-center

                                rounded-2xl

                                bg-amber-50

                                text-amber-500
                            "
                        >

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                class="h-6 w-6"
                            >
                                <circle
                                    cx="12"
                                    cy="12"
                                    r="9"
                                />

                                <path
                                    d="M12 7v5l3 2"
                                />
                            </svg>

                        </div>

                    </div>

                </div>



                {{-- AVG PRICE --}}

                <div
                    class="
                        stat-card

                        rounded-3xl

                        border
                        border-slate-200

                        bg-white

                        p-6
                    "
                >

                    <div
                        class="
                            flex
                            items-start
                            justify-between
                            gap-4
                        "
                    >

                        <div>

                            <p
                                class="
                                    text-sm
                                    font-semibold
                                    text-slate-500
                                "
                            >
                                Rata-rata Harga
                            </p>


                            <p
                                class="
                                    mt-3

                                    text-xl
                                    font-black
                                    text-slate-950
                                "
                            >
                                Rp {{ number_format(
                                    $averagePrice,
                                    0,
                                    ',',
                                    '.'
                                ) }}
                            </p>


                            <p
                                class="
                                    mt-1
                                    text-xs
                                    text-slate-400
                                "
                            >
                                {{ $totalSchedules }} jadwal
                            </p>

                        </div>


                        <div
                            class="
                                flex
                                h-12
                                w-12
                                items-center
                                justify-center

                                rounded-2xl

                                bg-indigo-50

                                text-indigo-600
                            "
                        >

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                class="h-6 w-6"
                            >
                                <path
                                    d="M12 2v20"
                                />

                                <path
                                    d="M17 5H9.5a3.5 3.5 0 0 0 0 7H14a3.5 3.5 0 0 1 0 7H6"
                                />
                            </svg>

                        </div>

                    </div>

                </div>

            </section>



            {{-- ================================================= --}}
            {{-- DATA MANAGEMENT HEADING --}}
            {{-- ================================================= --}}

            <section
                class="mt-12"
            >

                <div
                    class="
                        flex
                        flex-col
                        justify-between
                        gap-5

                        sm:flex-row
                        sm:items-end
                    "
                >

                    <div>

                        <p
                            class="
                                text-xs
                                font-black
                                uppercase
                                tracking-[.18em]
                                text-sky-600
                            "
                        >
                            Manajemen Data
                        </p>


                        <h2
                            class="
                                mt-2

                                text-2xl
                                font-black
                                tracking-tight
                                text-slate-950

                                sm:text-3xl
                            "
                        >
                            Daftar Armada & Jadwal
                        </h2>


                        <p
                            class="
                                mt-2

                                text-sm
                                leading-7
                                text-slate-500
                            "
                        >
                            Edit informasi kendaraan, jadwal,
                            harga dan ketersediaan armada.
                        </p>

                    </div>



                    <a
                        href="{{ route('admin.create') }}"

                        class="
                            inline-flex
                            w-fit
                            items-center
                            gap-2

                            rounded-xl

                            bg-slate-950

                            px-5
                            py-3

                            text-sm
                            font-black
                            text-white

                            transition

                            hover:bg-sky-600

                            sm:hidden
                        "
                    >
                        + Tambah Data
                    </a>

                </div>



                {{-- ================================================= --}}
                {{-- DESKTOP TABLE --}}
                {{-- ================================================= --}}

                <div
                    class="
                        mt-7

                        hidden

                        overflow-hidden

                        rounded-[2rem]

                        border
                        border-slate-200

                        bg-white

                        xl:block
                    "
                >

                    <div
                        class="overflow-x-auto"
                    >

                        <table
                            class="
                                w-full
                                min-w-[1000px]
                            "
                        >

                            <thead>

                                <tr
                                    class="
                                        border-b
                                        border-slate-200

                                        bg-slate-50

                                        text-left
                                    "
                                >

                                    <th
                                        class="
                                            px-6
                                            py-5

                                            text-[11px]
                                            font-black
                                            uppercase
                                            tracking-wider
                                            text-slate-400
                                        "
                                    >
                                        Armada
                                    </th>
                                   

                                    <th
                                        class="
                                            px-6
                                            py-5

                                            text-[11px]
                                            font-black
                                            uppercase
                                            tracking-wider
                                            text-slate-400
                                        "
                                    >
                                        Harga
                                    </th>


                                    <th
                                        class="
                                            px-6
                                            py-5

                                            text-center
                                            text-[11px]
                                            font-black
                                            uppercase
                                            tracking-wider
                                            text-slate-400
                                        "
                                    >
                                        Status
                                    </th>


                                    <th
                                        class="
                                            px-6
                                            py-5

                                            text-right
                                            text-[11px]
                                            font-black
                                            uppercase
                                            tracking-wider
                                            text-slate-400
                                        "
                                    >
                                        Aksi
                                    </th>

                                </tr>

                            </thead>



                            <tbody>

                                @forelse($schedules as $schedule)

                                    @php

                                        $departure =
                                            \Carbon\Carbon::parse(
                                                $schedule->departure_time
                                            );

                                        $arrival =
                                            $schedule->arrival_time
                                                ? \Carbon\Carbon::parse(
                                                    $schedule->arrival_time
                                                )
                                                : null;

                                    @endphp


                                    <tr
                                        class="
                                            border-b
                                            border-slate-100

                                            transition

                                            last:border-b-0

                                            hover:bg-slate-50/70
                                        "
                                    >

                                        {{-- ARMADA --}}

                                        <td
                                            class="
                                                px-6
                                                py-5
                                            "
                                        >

                                            <div
                                                class="
                                                    flex
                                                    items-center
                                                    gap-4
                                                "
                                            >

                                                <div
                                                    class="
                                                        flex
                                                        h-12
                                                        w-12
                                                        shrink-0
                                                        items-center
                                                        justify-center

                                                        rounded-2xl

                                                        bg-sky-50

                                                        text-sky-600
                                                    "
                                                >

                                                    <svg
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="1.8"
                                                        class="h-6 w-6"
                                                    >
                                                        <path
                                                            d="M3 13l2-5a3 3 0 0 1 2.8-2h8.4A3 3 0 0 1 19 8l2 5"
                                                        />

                                                        <path
                                                            d="M5 13h14a2 2 0 0 1 2 2v3H3v-3a2 2 0 0 1 2-2Z"
                                                        />
                                                    </svg>

                                                </div>


                                                <div>

                                                    <p
                                                        class="
                                                            max-w-[220px]
                                                            font-black
                                                            text-slate-900
                                                        "
                                                    >
                                                        {{ $schedule->shuttle?->name ?? 'Armada' }}
                                                    </p>


                                                    <p
                                                        class="
                                                            mt-1
                                                            text-xs
                                                            text-slate-400
                                                        "
                                                    >
                                                        {{ $schedule->shuttle?->license_plate ?? '-' }}
                                                    </p>


                                                    <p
                                                        class="
                                                            mt-1
                                                            text-xs
                                                            text-slate-400
                                                        "
                                                    >
                                                        {{ $schedule->shuttle?->seat_capacity ?? '-' }}
                                                        Penumpang
                                                    </p>

                                                </div>

                                            </div>

                                        </td>

                                        {{-- PRICE --}}

                                        <td
                                            class="
                                                px-6
                                                py-5
                                            "
                                        >

                                            <p
                                                class="
                                                    whitespace-nowrap

                                                    font-black
                                                    text-sky-600
                                                "
                                            >
                                                Rp {{ number_format(
                                                    $schedule->price,
                                                    0,
                                                    ',',
                                                    '.'
                                                ) }}
                                            </p>


                                            <p
                                                class="
                                                    mt-1
                                                    text-xs
                                                    text-slate-400
                                                "
                                            >
                                                / unit
                                            </p>

                                        </td>



                                        {{-- STATUS --}}

                                        <td
                                            class="
                                                px-6
                                                py-5
                                                text-center
                                            "
                                        >

                                            @if($schedule->is_available)

                                                <span
                                                    class="
                                                        inline-flex
                                                        items-center
                                                        gap-2

                                                        rounded-full

                                                        bg-emerald-50

                                                        px-3
                                                        py-2

                                                        text-xs
                                                        font-black
                                                        text-emerald-600
                                                    "
                                                >

                                                    <span
                                                        class="
                                                            h-2
                                                            w-2

                                                            rounded-full

                                                            bg-emerald-500
                                                        "
                                                    ></span>

                                                    Tersedia

                                                </span>

                                            @else

                                                <span
                                                    class="
                                                        inline-flex
                                                        items-center
                                                        gap-2

                                                        rounded-full

                                                        bg-red-50

                                                        px-3
                                                        py-2

                                                        text-xs
                                                        font-black
                                                        text-red-500
                                                    "
                                                >

                                                    <span
                                                        class="
                                                            h-2
                                                            w-2

                                                            rounded-full

                                                            bg-red-500
                                                        "
                                                    ></span>

                                                    Disewa

                                                </span>

                                            @endif

                                        </td>



                                        {{-- ACTION --}}

                                        <td
                                            class="
                                                px-6
                                                py-5
                                            "
                                        >

                                            <div
                                                class="
                                                    flex
                                                    items-center
                                                    justify-end
                                                    gap-2
                                                "
                                            >


                                                {{-- EDIT --}}

                                                <a
                                                    href="{{ route(
                                                        'admin.edit',
                                                        $schedule->id
                                                    ) }}"

                                                    title="Edit Data"

                                                    class="
                                                        flex
                                                        h-10
                                                        w-10
                                                        items-center
                                                        justify-center

                                                        rounded-xl

                                                        bg-sky-50

                                                        text-sky-600

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
                                                        class="h-5 w-5"
                                                    >
                                                        <path
                                                            d="M12 20h9"
                                                        />

                                                        <path
                                                            d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4Z"
                                                        />
                                                    </svg>

                                                </a>



                                                {{-- DELETE --}}

                                                <form
                                                    action="{{ route(
                                                        'admin.destroy',
                                                        $schedule->id
                                                    ) }}"

                                                    method="POST"

                                                    onsubmit="
                                                        return confirm(
                                                            'Yakin ingin menghapus data ini? Data yang dihapus tidak dapat dikembalikan.'
                                                        );
                                                    "
                                                >

                                                    @csrf
                                                    @method('DELETE')


                                                    <button
                                                        type="submit"

                                                        title="Hapus Data"

                                                        class="
                                                            flex
                                                            h-10
                                                            w-10
                                                            items-center
                                                            justify-center

                                                            rounded-xl

                                                            bg-red-50

                                                            text-red-500

                                                            transition

                                                            hover:bg-red-500
                                                            hover:text-white
                                                        "
                                                    >

                                                        <svg
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            stroke-width="1.8"
                                                            class="h-5 w-5"
                                                        >
                                                            <path
                                                                d="M3 6h18"
                                                            />

                                                            <path
                                                                d="M8 6V4h8v2"
                                                            />

                                                            <path
                                                                d="m19 6-1 14H6L5 6"
                                                            />

                                                            <path
                                                                d="M10 11v5M14 11v5"
                                                            />
                                                        </svg>

                                                    </button>

                                                </form>

                                            </div>

                                        </td>

                                    </tr>


                                @empty

                                    <tr>

                                        <td
                                            colspan="6"

                                            class="
                                                px-6
                                                py-16
                                                text-center
                                            "
                                        >

                                            <p
                                                class="
                                                    font-black
                                                    text-slate-800
                                                "
                                            >
                                                Belum ada data armada.
                                            </p>


                                            <p
                                                class="
                                                    mt-2
                                                    text-sm
                                                    text-slate-400
                                                "
                                            >
                                                Tambahkan armada dan jadwal
                                                pertama VikensaTrans.
                                            </p>

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>



                {{-- ================================================= --}}
                {{-- MOBILE / TABLET CARDS --}}
                {{-- ================================================= --}}

                <div
                    class="
                        mt-7
                        grid
                        gap-5
                        xl:hidden
                    "
                >

                    @forelse($schedules as $schedule)

                        @php

                            $departure =
                                \Carbon\Carbon::parse(
                                    $schedule->departure_time
                                );

                            $arrival =
                                $schedule->arrival_time
                                    ? \Carbon\Carbon::parse(
                                        $schedule->arrival_time
                                    )
                                    : null;

                        @endphp


                        <article
                            class="
                                overflow-hidden

                                rounded-[2rem]

                                border
                                border-slate-200

                                bg-white

                                p-5
                            "
                        >

                            <div
                                class="
                                    flex
                                    items-start
                                    justify-between
                                    gap-4
                                "
                            >

                                <div
                                    class="
                                        flex
                                        min-w-0
                                        items-center
                                        gap-3
                                    "
                                >

                                    <div
                                        class="
                                            flex
                                            h-11
                                            w-11
                                            shrink-0
                                            items-center
                                            justify-center

                                            rounded-xl

                                            bg-sky-50

                                            text-sky-600
                                        "
                                    >

                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            class="h-5 w-5"
                                        >
                                            <path
                                                d="M3 13l2-5a3 3 0 0 1 2.8-2h8.4A3 3 0 0 1 19 8l2 5"
                                            />

                                            <path
                                                d="M5 13h14a2 2 0 0 1 2 2v3H3v-3a2 2 0 0 1 2-2Z"
                                            />
                                        </svg>

                                    </div>


                                    <div class="min-w-0">

                                        <h3
                                            class="
                                                truncate
                                                font-black
                                                text-slate-900
                                            "
                                        >
                                            {{ $schedule->shuttle?->name ?? 'Armada' }}
                                        </h3>


                                        <p
                                            class="
                                                mt-1
                                                text-xs
                                                text-slate-400
                                            "
                                        >
                                            {{ $schedule->shuttle?->license_plate ?? '-' }}
                                        </p>

                                    </div>

                                </div>



                                @if($schedule->is_available)

                                    <span
                                        class="
                                            shrink-0

                                            rounded-full

                                            bg-emerald-50

                                            px-3
                                            py-2

                                            text-[10px]
                                            font-black
                                            text-emerald-600
                                        "
                                    >
                                        TERSEDIA
                                    </span>

                                @else

                                    <span
                                        class="
                                            shrink-0

                                            rounded-full

                                            bg-red-50

                                            px-3
                                            py-2

                                            text-[10px]
                                            font-black
                                            text-red-500
                                        "
                                    >
                                        DISEWA
                                    </span>

                                @endif

                            </div>



                            <div
                                class="
                                    mt-5

                                    grid
                                    gap-3

                                    sm:grid-cols-2
                                "
                            >

                                <div
                                    class="
                                        rounded-2xl

                                        bg-slate-50

                                        p-4
                                    "
                                >

                                    <p
                                        class="
                                            text-[10px]
                                            font-bold
                                            uppercase
                                            tracking-wider
                                            text-slate-400
                                        "
                                    >
                                        Rute
                                    </p>


                                    <p
                                        class="
                                            mt-1
                                            text-sm
                                            font-bold
                                            text-slate-800
                                        "
                                    >
                                        {{ $schedule->route?->origin?->city ?? '-' }}

                                        →

                                        {{ $schedule->route?->destination?->city ?? '-' }}
                                    </p>

                                </div>



                                <div
                                    class="
                                        rounded-2xl

                                        bg-slate-50

                                        p-4
                                    "
                                >

                                    <p
                                        class="
                                            text-[10px]
                                            font-bold
                                            uppercase
                                            tracking-wider
                                            text-slate-400
                                        "
                                    >
                                        Jadwal
                                    </p>


                                    <p
                                        class="
                                            mt-1
                                            text-sm
                                            font-bold
                                            text-slate-800
                                        "
                                    >
                                        {{ $departure->format('d M Y') }}
                                    </p>


                                    <p
                                        class="
                                            mt-1
                                            text-xs
                                            text-slate-400
                                        "
                                    >
                                        {{ $departure->format('H:i') }}

                                        @if($arrival)

                                            -

                                            {{ $arrival->format('H:i') }}

                                        @endif
                                    </p>

                                </div>



                                <div
                                    class="
                                        rounded-2xl

                                        bg-slate-50

                                        p-4
                                    "
                                >

                                    <p
                                        class="
                                            text-[10px]
                                            font-bold
                                            uppercase
                                            tracking-wider
                                            text-slate-400
                                        "
                                    >
                                        Kapasitas
                                    </p>


                                    <p
                                        class="
                                            mt-1
                                            text-sm
                                            font-bold
                                            text-slate-800
                                        "
                                    >
                                        {{ $schedule->shuttle?->seat_capacity ?? '-' }}
                                        Penumpang
                                    </p>

                                </div>



                                <div
                                    class="
                                        rounded-2xl

                                        bg-slate-50

                                        p-4
                                    "
                                >

                                    <p
                                        class="
                                            text-[10px]
                                            font-bold
                                            uppercase
                                            tracking-wider
                                            text-slate-400
                                        "
                                    >
                                        Harga
                                    </p>


                                    <p
                                        class="
                                            mt-1
                                            text-sm
                                            font-black
                                            text-sky-600
                                        "
                                    >
                                        Rp {{ number_format(
                                            $schedule->price,
                                            0,
                                            ',',
                                            '.'
                                        ) }}
                                    </p>

                                </div>

                            </div>



                            <div
                                class="
                                    mt-5

                                    flex
                                    gap-3

                                    border-t
                                    border-slate-100

                                    pt-5
                                "
                            >

                                <a
                                    href="{{ route(
                                        'admin.edit',
                                        $schedule->id
                                    ) }}"

                                    class="
                                        flex
                                        flex-1
                                        items-center
                                        justify-center
                                        gap-2

                                        rounded-xl

                                        bg-sky-50

                                        px-4
                                        py-3

                                        text-sm
                                        font-black
                                        text-sky-600

                                        transition

                                        hover:bg-sky-500
                                        hover:text-white
                                    "
                                >
                                    Edit
                                </a>



                                <form
                                    action="{{ route(
                                        'admin.destroy',
                                        $schedule->id
                                    ) }}"

                                    method="POST"

                                    class="flex-1"

                                    onsubmit="
                                        return confirm(
                                            'Yakin ingin menghapus data ini?'
                                        );
                                    "
                                >

                                    @csrf
                                    @method('DELETE')


                                    <button
                                        type="submit"

                                        class="
                                            w-full

                                            rounded-xl

                                            bg-red-50

                                            px-4
                                            py-3

                                            text-sm
                                            font-black
                                            text-red-500

                                            transition

                                            hover:bg-red-500
                                            hover:text-white
                                        "
                                    >
                                        Hapus
                                    </button>

                                </form>

                            </div>

                        </article>


                    @empty

                        <div
                            class="
                                rounded-[2rem]

                                border
                                border-dashed
                                border-slate-300

                                bg-white

                                px-6
                                py-14

                                text-center
                            "
                        >

                            <h3
                                class="
                                    text-lg
                                    font-black
                                    text-slate-900
                                "
                            >
                                Belum ada data
                            </h3>


                            <p
                                class="
                                    mt-2
                                    text-sm
                                    text-slate-500
                                "
                            >
                                Silakan tambahkan armada pertama.
                            </p>


                            <a
                                href="{{ route('admin.create') }}"

                                class="
                                    mt-5

                                    inline-flex

                                    rounded-xl

                                    bg-sky-500

                                    px-5
                                    py-3

                                    text-sm
                                    font-black
                                    text-white
                                "
                            >
                                + Tambah Armada
                            </a>

                        </div>

                    @endforelse

                </div>

            </section>



            {{-- ================================================= --}}
            {{-- ADMIN NOTICE --}}
            {{-- ================================================= --}}

            <section
                class="
                    mt-10

                    rounded-[2rem]

                    border
                    border-amber-200

                    bg-amber-50

                    p-6

                    sm:p-7
                "
            >

                <div
                    class="
                        flex
                        flex-col
                        gap-4

                        sm:flex-row
                        sm:items-start
                    "
                >

                    <div
                        class="
                            flex
                            h-11
                            w-11
                            shrink-0
                            items-center
                            justify-center

                            rounded-xl

                            bg-amber-100

                            text-amber-600
                        "
                    >

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            class="h-5 w-5"
                        >
                            <path
                                d="M12 3 2 21h20Z"
                            />

                            <path
                                d="M12 9v4"
                            />

                            <path
                                d="M12 17h.01"
                            />
                        </svg>

                    </div>


                    <div>

                        <h3
                            class="
                                font-black
                                text-amber-900
                            "
                        >
                            Perhatian saat mengelola data
                        </h3>


                        <p
                            class="
                                mt-2

                                max-w-3xl

                                text-sm
                                leading-7
                                text-amber-700
                            "
                        >
                            Tombol hapus akan menghapus data jadwal
                            dari database. Pastikan data yang dipilih
                            benar sebelum melakukan penghapusan,
                            terutama apabila jadwal sudah pernah
                            digunakan untuk pemesanan.
                        </p>

                    </div>

                </div>

            </section>



            {{-- ================================================= --}}
            {{-- FOOTER --}}
            {{-- ================================================= --}}

            <footer
                class="
                    mt-12

                    border-t
                    border-slate-200

                    py-7
                "
            >

                <div
                    class="
                        flex
                        flex-col
                        gap-3

                        text-xs
                        text-slate-400

                        sm:flex-row
                        sm:items-center
                        sm:justify-between
                    "
                >

                    <p>
                        © {{ date('Y') }} VikensaTrans Admin Panel.
                    </p>


                    <p>
                        Administrator Access
                    </p>

                </div>

            </footer>

        </div>

    </main>

</div>


</body>

</html>