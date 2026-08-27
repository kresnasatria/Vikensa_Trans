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

    <title>Catatan Servis - VikensaTrans</title>

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


@php
    $totalServices = $services->count();

    $totalVehicles = $services
        ->pluck('shuttle_id')
        ->unique()
        ->count();

    $thisMonthServices = $services
        ->filter(function ($service) {
            return $service->created_at
                && $service->created_at->isCurrentMonth();
        })
        ->count();

    $latestService = $services->first();
@endphp


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

    @click="sidebarOpen = false"

    class="
        fixed inset-0 z-40
        bg-slate-950/60
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
        fixed inset-y-0 left-0 z-50

        flex w-[280px] flex-col

        bg-slate-950
        text-white

        transition-transform
        duration-300

        lg:translate-x-0
    "
>

    {{-- LOGO --}}
    <div
        class="
            flex h-24
            items-center
            justify-between

            border-b
            border-white/10

            px-6
        "
    >

        <a href="{{ route('admin.dashboard') }}">

            <img
                src="{{ asset('images/vikensa_trans_logo.png') }}"
                alt="VikensaTrans"

                class="
                    h-16
                    w-auto
                    max-w-[190px]
                    object-contain
                "
            >

        </a>


        <button
            type="button"

            @click="sidebarOpen = false"

            class="
                text-slate-400
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
    {{-- MENU --}}
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
                font-bold
                uppercase
                tracking-[.2em]

                text-slate-500
            "
        >
            Administrator
        </p>


        {{-- DASHBOARD --}}
        <a
            href="{{ route('admin.dashboard') }}"

            class="
                flex
                items-center
                gap-3

                rounded-xl

                px-4
                py-3

                text-sm
                font-semibold
                text-slate-400

                transition

                hover:bg-white/5
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
                mt-2

                flex
                items-center
                gap-3

                rounded-xl

                px-4
                py-3

                text-sm
                font-semibold
                text-slate-400

                transition

                hover:bg-white/5
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
                <path d="M5 4h14v16l-3-2-4 2-4-2-3 2Z"/>
                <path d="M8 8h8M8 12h6"/>
            </svg>

            Order Masuk

        </a>


        {{-- ROUTE --}}
        <a
            href="{{ route('admin.route.index') }}"

            class="
                mt-2

                flex
                items-center
                gap-3

                rounded-xl

                px-4
                py-3

                text-sm
                font-semibold
                text-slate-400

                transition

                hover:bg-white/5
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

                <circle cx="6" cy="18" r="2"/>
                <circle cx="18" cy="6" r="2"/>

                <path
                    d="M7.5 16.5c2-4 7-4 9-8.5"
                />

            </svg>

            Manajemen Rute

        </a>


        {{-- SERVICE ACTIVE --}}
        <a
            href="{{ route('admin.services.index') }}"

            class="
                mt-2

                flex
                items-center
                gap-3

                rounded-xl

                bg-sky-500

                px-4
                py-3

                text-sm
                font-bold
                text-white

                shadow-lg
                shadow-sky-500/10
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
                mt-2

                flex
                items-center
                gap-3

                rounded-xl

                px-4
                py-3

                text-sm
                font-semibold
                text-slate-400

                transition

                hover:bg-white/5
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
                <path d="M12 5v14"/>
                <path d="M5 12h14"/>
            </svg>

            Tambah Armada

        </a>


        {{-- WEBSITE --}}
        <p
            class="
                mb-3
                mt-8

                px-4

                text-[10px]
                font-bold
                uppercase
                tracking-[.2em]

                text-slate-500
            "
        >
            Website
        </p>


        <a
            href="{{ route('dashboard') }}"

            class="
                flex
                items-center
                gap-3

                rounded-xl

                px-4
                py-3

                text-sm
                font-semibold
                text-slate-400

                transition

                hover:bg-white/5
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
                <circle cx="12" cy="8" r="4"/>
                <path d="M4 21c0-5 3-8 8-8s8 3 8 8"/>
            </svg>

            Dashboard User

        </a>


        <a
            href="{{ url('/') }}"

            class="
                mt-2

                flex
                items-center
                gap-3

                rounded-xl

                px-4
                py-3

                text-sm
                font-semibold
                text-slate-400

                transition

                hover:bg-white/5
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
                <path d="m3 11 9-8 9 8"/>
                <path d="M5 10v10h14V10"/>
            </svg>

            Lihat Website

        </a>

    </nav>


    {{-- ===================================================== --}}
    {{-- ACCOUNT --}}
    {{-- ===================================================== --}}

    <div
        class="
            border-t
            border-white/10

            p-4
        "
    >

        <div class="relative">

            <button
                type="button"

                @click="
                    profileOpen =
                    !profileOpen
                "

                class="
                    flex
                    w-full
                    items-center
                    gap-3

                    rounded-xl

                    p-3

                    text-left

                    transition

                    hover:bg-white/5
                "
            >

                <div
                    class="
                        flex
                        h-10
                        w-10
                        shrink-0
                        items-center
                        justify-center

                        rounded-xl

                        bg-sky-500

                        text-sm
                        font-black
                        uppercase
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
                            text-[10px]
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
                        profileOpen
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


            <div
                x-show="profileOpen"
                x-cloak

                @click.outside="
                    profileOpen = false
                "

                class="
                    absolute
                    bottom-full
                    left-0
                    right-0

                    mb-2

                    rounded-xl

                    border
                    border-slate-200

                    bg-white

                    p-2

                    shadow-xl
                "
            >

                <a
                    href="{{ route('profile.edit') }}"

                    class="
                        block

                        rounded-lg

                        px-4
                        py-3

                        text-sm
                        font-semibold
                        text-slate-600

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
                            w-full

                            rounded-lg

                            px-4
                            py-3

                            text-left
                            text-sm
                            font-semibold
                            text-red-500

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


    {{-- ===================================================== --}}
    {{-- TOP BAR --}}
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
            "
        >

            <div
                class="
                    flex
                    items-center
                    gap-4
                "
            >

                <button
                    type="button"

                    @click="sidebarOpen = true"

                    class="
                        flex
                        h-10
                        w-10
                        items-center
                        justify-center

                        rounded-xl

                        border
                        border-slate-200

                        text-slate-600

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
                        <path d="M4 6h16"/>
                        <path d="M4 12h16"/>
                        <path d="M4 18h16"/>
                    </svg>

                </button>


                <div>

                    <p
                        class="
                            text-xs
                            font-medium
                            text-slate-400
                        "
                    >
                        Administrator
                    </p>


                    <h2
                        class="
                            text-lg
                            font-black
                            text-slate-900
                        "
                    >
                        Catatan Servis
                    </h2>

                </div>

            </div>


            <div
                class="
                    flex
                    h-10
                    w-10
                    items-center
                    justify-center

                    rounded-xl

                    bg-slate-950

                    text-sm
                    font-black
                    text-white
                "
            >
                {{ mb_substr(Auth::user()->name, 0, 1) }}
            </div>

        </div>

    </header>


    {{-- ===================================================== --}}
    {{-- CONTENT --}}
    {{-- ===================================================== --}}

    <main
        class="
            px-5
            py-8

            sm:px-7
            lg:px-10
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

                    class="
                        mb-6

                        flex
                        items-center
                        justify-between
                        gap-4

                        rounded-xl

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
                            items-center
                            gap-3
                        "
                    >

                        <div
                            class="
                                flex
                                h-8
                                w-8
                                items-center
                                justify-center

                                rounded-lg

                                bg-emerald-100

                                text-emerald-600
                            "
                        >
                            ✓
                        </div>


                        <p
                            class="
                                text-sm
                                font-semibold
                                text-emerald-700
                            "
                        >
                            {{ session('success') }}
                        </p>

                    </div>


                    <button
                        type="button"

                        @click="show = false"

                        class="
                            text-lg
                            text-emerald-600
                        "
                    >
                        ×
                    </button>

                </div>

            @endif


            {{-- ================================================= --}}
            {{-- PAGE TITLE --}}
            {{-- ================================================= --}}

            <div
                class="
                    flex
                    flex-col
                    justify-between
                    gap-5

                    md:flex-row
                    md:items-end
                "
            >

                <div>

                    <p
                        class="
                            text-xs
                            font-bold
                            uppercase
                            tracking-[.15em]

                            text-sky-600
                        "
                    >
                        Perawatan Armada
                    </p>


                    <h1
                        class="
                            mt-2

                            text-3xl
                            font-black
                            tracking-tight
                            text-slate-950
                        "
                    >
                        Riwayat Servis Kendaraan
                    </h1>


                    <p
                        class="
                            mt-2

                            max-w-2xl

                            text-sm
                            leading-6
                            text-slate-500
                        "
                    >
                        Simpan dan pantau riwayat kendala,
                        kerusakan, penggantian suku cadang,
                        serta jadwal servis armada.
                    </p>

                </div>


                <a
                    href="{{ route('admin.services.create') }}"

                    class="
                        inline-flex
                        w-fit
                        items-center
                        gap-2

                        rounded-xl

                        bg-sky-500

                        px-5
                        py-3

                        text-sm
                        font-bold
                        text-white

                        shadow-lg
                        shadow-sky-500/15

                        transition

                        hover:bg-sky-600
                    "
                >

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"

                        class="h-4 w-4"
                    >
                        <path d="M12 5v14"/>
                        <path d="M5 12h14"/>
                    </svg>

                    Tambah Catatan Servis

                </a>

            </div>


            {{-- ================================================= --}}
            {{-- STATISTICS --}}
            {{-- ================================================= --}}

            <div
                class="
                    mt-7

                    grid
                    gap-4

                    sm:grid-cols-2
                    lg:grid-cols-4
                "
            >


                {{-- TOTAL SERVICE --}}

                <div
                    class="
                        rounded-2xl

                        border
                        border-slate-200

                        bg-white

                        p-5
                    "
                >

                    <p
                        class="
                            text-xs
                            font-semibold
                            text-slate-400
                        "
                    >
                        Total Catatan
                    </p>


                    <p
                        class="
                            mt-2

                            text-2xl
                            font-black
                            text-slate-900
                        "
                    >
                        {{ $totalServices }}
                    </p>


                    <p
                        class="
                            mt-1
                            text-xs
                            text-slate-400
                        "
                    >
                        Riwayat servis
                    </p>

                </div>


                {{-- VEHICLES --}}

                <div
                    class="
                        rounded-2xl

                        border
                        border-slate-200

                        bg-white

                        p-5
                    "
                >

                    <p
                        class="
                            text-xs
                            font-semibold
                            text-slate-400
                        "
                    >
                        Armada Tercatat
                    </p>


                    <p
                        class="
                            mt-2

                            text-2xl
                            font-black
                            text-sky-600
                        "
                    >
                        {{ $totalVehicles }}
                    </p>


                    <p
                        class="
                            mt-1
                            text-xs
                            text-slate-400
                        "
                    >
                        Kendaraan
                    </p>

                </div>


                {{-- THIS MONTH --}}

                <div
                    class="
                        rounded-2xl

                        border
                        border-slate-200

                        bg-white

                        p-5
                    "
                >

                    <p
                        class="
                            text-xs
                            font-semibold
                            text-slate-400
                        "
                    >
                        Servis Bulan Ini
                    </p>


                    <p
                        class="
                            mt-2

                            text-2xl
                            font-black
                            text-amber-500
                        "
                    >
                        {{ $thisMonthServices }}
                    </p>


                    <p
                        class="
                            mt-1
                            text-xs
                            text-slate-400
                        "
                    >
                        Catatan baru
                    </p>

                </div>


                {{-- LATEST --}}

                <div
                    class="
                        rounded-2xl

                        border
                        border-slate-200

                        bg-white

                        p-5
                    "
                >

                    <p
                        class="
                            text-xs
                            font-semibold
                            text-slate-400
                        "
                    >
                        Servis Terakhir
                    </p>


                    <p
                        class="
                            mt-2

                            text-lg
                            font-black
                            text-emerald-600
                        "
                    >
                        @if($latestService)

                            {{
                                $latestService
                                    ->created_at
                                    ->format('d M Y')
                            }}

                        @else

                            -

                        @endif
                    </p>


                    <p
                        class="
                            mt-1
                            text-xs
                            text-slate-400
                        "
                    >
                        Catatan terbaru
                    </p>

                </div>

            </div>


            {{-- ================================================= --}}
            {{-- SERVICE LIST --}}
            {{-- ================================================= --}}

            <section
                class="
                    mt-8

                    overflow-hidden

                    rounded-2xl

                    border
                    border-slate-200

                    bg-white
                "
            >


                {{-- HEADER --}}

                <div
                    class="
                        flex
                        flex-col
                        justify-between
                        gap-4

                        border-b
                        border-slate-100

                        px-6
                        py-5

                        md:flex-row
                        md:items-center
                    "
                >

                    <div>

                        <h2
                            class="
                                text-lg
                                font-black
                                text-slate-900
                            "
                        >
                            Catatan Servis
                        </h2>


                        <p
                            class="
                                mt-1

                                text-sm
                                text-slate-500
                            "
                        >
                            Data diurutkan dari catatan terbaru.
                        </p>

                    </div>


                    {{-- SEARCH --}}

                    <div
                        class="
                            relative
                            w-full

                            md:w-80
                        "
                    >

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"

                            class="
                                absolute
                                left-4
                                top-1/2

                                h-4
                                w-4

                                -translate-y-1/2

                                text-slate-400
                            "
                        >

                            <circle cx="11" cy="11" r="7"/>

                            <path
                                d="m20 20-3.5-3.5"
                            />

                        </svg>


                        <input
                            id="serviceSearch"

                            type="text"

                            placeholder="Cari armada, kerusakan..."

                            class="
                                h-11
                                w-full

                                rounded-xl

                                border
                                border-slate-200

                                bg-slate-50

                                pl-11
                                pr-4

                                text-sm
                                text-slate-700

                                outline-none

                                transition

                                placeholder:text-slate-400

                                focus:border-sky-500
                                focus:bg-white
                                focus:ring-4
                                focus:ring-sky-500/10
                            "
                        >

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- DESKTOP TABLE --}}
                {{-- ================================================= --}}

                <div
                    class="
                        hidden
                        overflow-x-auto

                        lg:block
                    "
                >

                    <table
                        class="
                            w-full
                            min-w-[1150px]
                        "
                    >

                        <thead
                            class="bg-slate-50"
                        >

                            <tr
                                class="
                                    border-b
                                    border-slate-200
                                "
                            >

                                <th
                                    class="
                                        px-5
                                        py-4

                                        text-left
                                        text-[10px]
                                        font-black
                                        uppercase
                                        tracking-wider
                                        text-slate-400
                                    "
                                >
                                    Tanggal
                                </th>


                                <th
                                    class="
                                        px-5
                                        py-4

                                        text-left
                                        text-[10px]
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
                                        px-5
                                        py-4

                                        text-left
                                        text-[10px]
                                        font-black
                                        uppercase
                                        tracking-wider
                                        text-slate-400
                                    "
                                >
                                    KM Awal
                                </th>


                                <th
                                    class="
                                        px-5
                                        py-4

                                        text-left
                                        text-[10px]
                                        font-black
                                        uppercase
                                        tracking-wider
                                        text-slate-400
                                    "
                                >
                                    Kendala
                                </th>


                                <th
                                    class="
                                        px-5
                                        py-4

                                        text-left
                                        text-[10px]
                                        font-black
                                        uppercase
                                        tracking-wider
                                        text-slate-400
                                    "
                                >
                                    Kerusakan
                                </th>


                                <th
                                    class="
                                        px-5
                                        py-4

                                        text-left
                                        text-[10px]
                                        font-black
                                        uppercase
                                        tracking-wider
                                        text-slate-400
                                    "
                                >
                                    Suku Cadang
                                </th>


                                <th
                                    class="
                                        px-5
                                        py-4

                                        text-left
                                        text-[10px]
                                        font-black
                                        uppercase
                                        tracking-wider
                                        text-slate-400
                                    "
                                >
                                    Servis Berikutnya
                                </th>


                                <th
                                    class="
                                        px-5
                                        py-4

                                        text-left
                                        text-[10px]
                                        font-black
                                        uppercase
                                        tracking-wider
                                        text-slate-400
                                    "
                                >
                                    Estimasi Biaya
                                </th>


                                <th
                                    class="
                                        px-5
                                        py-4

                                        text-right
                                        text-[10px]
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

                            @forelse($services as $service)

                                @php
                                    $searchText = strtolower(
                                        trim(
                                            ($service->shuttle?->name ?? '') . ' ' .
                                            ($service->shuttle?->license_plate ?? '') . ' ' .
                                            ($service->kendala ?? '') . ' ' .
                                            ($service->kerusakan ?? '') . ' ' .
                                            ($service->suku_cadang ?? '') . ' ' .
                                            ($service->estimasi_waktu ?? '') . ' ' .
                                            ($service->estimasi_harga ?? '')
                                        )
                                    );
                                @endphp


                                <tr
                                    class="
                                        service-row

                                        border-b
                                        border-slate-100

                                        last:border-0

                                        transition

                                        hover:bg-slate-50/70
                                    "

                                    data-search="{{ $searchText }}"
                                >


                                    {{-- DATE --}}

                                    <td
                                        class="
                                            whitespace-nowrap

                                            px-5
                                            py-5

                                            align-top
                                        "
                                    >

                                        <p
                                            class="
                                                text-sm
                                                font-bold
                                                text-slate-800
                                            "
                                        >
                                            {{
                                                $service
                                                    ->created_at
                                                    ->format('d M Y')
                                            }}
                                        </p>


                                        <p
                                            class="
                                                mt-1

                                                text-[11px]
                                                text-slate-400
                                            "
                                        >
                                            {{
                                                $service
                                                    ->created_at
                                                    ->format('H:i')
                                            }}
                                        </p>

                                    </td>


                                    {{-- VEHICLE --}}

                                    <td
                                        class="
                                            px-5
                                            py-5

                                            align-top
                                        "
                                    >

                                        <p
                                            class="
                                                max-w-[180px]

                                                font-black
                                                text-sky-600
                                            "
                                        >
                                            {{
                                                $service
                                                    ->shuttle
                                                    ?->name
                                                ?? 'Armada'
                                            }}
                                        </p>


                                        <p
                                            class="
                                                mt-1

                                                text-xs
                                                font-semibold
                                                uppercase
                                                text-slate-400
                                            "
                                        >
                                            {{
                                                $service
                                                    ->shuttle
                                                    ?->license_plate
                                                ?? '-'
                                            }}
                                        </p>

                                    </td>

                                    {{-- KM AWAL --}}
                                    <td
                                        class="
                                            px-5
                                            py-5

                                            align-top
                                        "
                                    >
                                        <p
                                            class="
                                                text-sm
                                                font-black
                                                text-slate-700
                                            "
                                        >
                                            {{ number_format($service->km_awal, 0, ',', '.') }}
                                        </p>
                                        <p
                                            class="
                                                mt-1

                                                text-[11px]
                                                font-semibold
                                                uppercase
                                                text-slate-400
                                            "
                                        >
                                            KM
                                        </p>
                                    </td>


                                    {{-- KENDALA --}}

                                    <td
                                        class="
                                            px-5
                                            py-5

                                            align-top
                                        "
                                    >

                                        <p
                                            class="
                                                max-w-[210px]

                                                text-sm
                                                leading-6
                                                text-slate-600
                                            "
                                        >
                                            {{ $service->kendala }}
                                        </p>

                                    </td>


                                    {{-- DAMAGE --}}

                                    <td
                                        class="
                                            px-5
                                            py-5

                                            align-top
                                        "
                                    >

                                        <p
                                            class="
                                                max-w-[210px]

                                                text-sm
                                                font-semibold
                                                leading-6
                                                text-red-500
                                            "
                                        >
                                            {{ $service->kerusakan }}
                                        </p>

                                    </td>


                                    {{-- SPARE PART --}}

                                    <td
                                        class="
                                            px-5
                                            py-5

                                            align-top
                                        "
                                    >

                                        <p
                                            class="
                                                max-w-[200px]

                                                text-sm
                                                leading-6
                                                text-slate-600
                                            "
                                        >
                                            {{ $service->suku_cadang }}
                                        </p>

                                    </td>


                                    {{-- NEXT SERVICE --}}

                                    <td
                                        class="
                                            px-5
                                            py-5

                                            align-top
                                        "
                                    >

                                        <span
                                            class="
                                                inline-flex

                                                rounded-lg

                                                bg-amber-50

                                                px-3
                                                py-2

                                                text-xs
                                                font-bold
                                                text-amber-700
                                            "
                                        >
                                            {{ $service->estimasi_waktu }}
                                        </span>

                                    </td>


                                    {{-- COST --}}

                                    <td
                                        class="
                                            px-5
                                            py-5

                                            align-top
                                        "
                                    >

                                        <p
                                            class="
                                                whitespace-nowrap

                                                text-sm
                                                font-black
                                                text-emerald-600
                                            "
                                        >
                                            {{ $service->estimasi_harga }}
                                        </p>

                                    </td>


                                    {{-- ACTION --}}

                                    <td
                                        class="
                                            px-5
                                            py-5

                                            text-right
                                            align-top
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
                                                    'admin.services.edit',
                                                    $service->id
                                                ) }}"

                                                title="Edit catatan"

                                                class="
                                                    inline-flex
                                                    h-9
                                                    items-center
                                                    gap-2

                                                    rounded-lg

                                                    bg-sky-50

                                                    px-3

                                                    text-xs
                                                    font-bold
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

                                                    class="h-4 w-4"
                                                >
                                                    <path d="M12 20h9"/>
                                                    <path
                                                        d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4Z"
                                                    />
                                                </svg>

                                                Edit

                                            </a>


                                            {{-- DELETE --}}

                                            <form
                                                action="{{ route(
                                                    'admin.services.destroy',
                                                    $service->id
                                                ) }}"

                                                method="POST"

                                                onsubmit="
                                                    return confirm(
                                                        'Yakin ingin menghapus catatan servis ini?'
                                                    );
                                                "
                                            >

                                                @csrf
                                                @method('DELETE')


                                                <button
                                                    type="submit"

                                                    title="Hapus catatan"

                                                    class="
                                                        inline-flex
                                                        h-9
                                                        items-center
                                                        gap-2

                                                        rounded-lg

                                                        bg-red-50

                                                        px-3

                                                        text-xs
                                                        font-bold
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

                                                        class="h-4 w-4"
                                                    >
                                                        <path d="M3 6h18"/>
                                                        <path d="M8 6V4h8v2"/>
                                                        <path d="m19 6-1 14H6L5 6"/>
                                                    </svg>

                                                    Hapus

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>


                            @empty

                                <tr>

                                    <td
                                        colspan="8"

                                        class="
                                            px-6
                                            py-16

                                            text-center
                                        "
                                    >

                                        <div
                                            class="
                                                mx-auto

                                                flex
                                                h-14
                                                w-14
                                                items-center
                                                justify-center

                                                rounded-2xl

                                                bg-slate-100

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
                                                <path d="M14 7l3-3 3 3-3 3"/>
                                                <path d="M17 4c-4 0-7 3-7 7"/>
                                                <path d="M4 20 14 10"/>
                                            </svg>

                                        </div>


                                        <p
                                            class="
                                                mt-4

                                                font-bold
                                                text-slate-800
                                            "
                                        >
                                            Belum ada catatan servis
                                        </p>


                                        <p
                                            class="
                                                mt-1

                                                text-sm
                                                text-slate-400
                                            "
                                        >
                                            Tambahkan riwayat perawatan
                                            kendaraan pertama.
                                        </p>


                                        <a
                                            href="{{ route(
                                                'admin.services.create'
                                            ) }}"

                                            class="
                                                mt-5

                                                inline-flex

                                                rounded-xl

                                                bg-sky-500

                                                px-5
                                                py-3

                                                text-sm
                                                font-bold
                                                text-white
                                            "
                                        >
                                            + Tambah Catatan
                                        </a>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- ================================================= --}}
                {{-- MOBILE / TABLET --}}
                {{-- ================================================= --}}

                <div
                    class="
                        divide-y
                        divide-slate-100

                        lg:hidden
                    "
                >

                    @forelse($services as $service)

                        @php
                            $mobileSearchText = strtolower(
                                trim(
                                    ($service->shuttle?->name ?? '') . ' ' .
                                    ($service->shuttle?->license_plate ?? '') . ' ' .
                                    ($service->km_awal ?? '') . ' ' .
                                    ($service->kendala ?? '') . ' ' .
                                    ($service->kerusakan ?? '') . ' ' .
                                    ($service->suku_cadang ?? '') . ' ' .
                                    ($service->estimasi_waktu ?? '') . ' ' .
                                    ($service->estimasi_harga ?? '')
                                )
                            );
                        @endphp


                        <article
                            class="
                                service-mobile

                                p-5

                                sm:p-6
                            "

                            data-search="{{ $mobileSearchText }}"
                        >


                            {{-- TOP --}}

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
                                            text-xs
                                            font-semibold
                                            text-slate-400
                                        "
                                    >
                                        {{
                                            $service
                                                ->created_at
                                                ->format('d M Y')
                                        }}
                                    </p>


                                    <h3
                                        class="
                                            mt-1

                                            text-base
                                            font-black
                                            text-sky-600
                                        "
                                    >
                                        {{
                                            $service
                                                ->shuttle
                                                ?->name
                                            ?? 'Armada'
                                        }}
                                    </h3>


                                    <p
                                        class="
                                            mt-1

                                            text-xs
                                            font-semibold
                                            uppercase
                                            text-slate-400
                                        "
                                    >
                                        {{
                                            $service
                                                ->shuttle
                                                ?->license_plate
                                        ?? '-'
                                        }}
                                        &bull; 
                                        {{ number_format($service->km_awal, 0, ',', '.') }} KM
                                    </p>

                                </div>


                                <span
                                    class="
                                        shrink-0

                                        rounded-lg

                                        bg-amber-50

                                        px-3
                                        py-2

                                        text-[10px]
                                        font-bold
                                        text-amber-700
                                    "
                                >
                                    {{ $service->estimasi_waktu }}
                                </span>

                            </div>


                            {{-- DETAIL --}}

                            <div
                                class="
                                    mt-5

                                    grid
                                    gap-4

                                    sm:grid-cols-2
                                "
                            >


                                <div>

                                    <p
                                        class="
                                            text-[10px]
                                            font-bold
                                            uppercase
                                            tracking-wider
                                            text-slate-400
                                        "
                                    >
                                        Kendala
                                    </p>


                                    <p
                                        class="
                                            mt-1

                                            text-sm
                                            leading-6
                                            text-slate-700
                                        "
                                    >
                                        {{ $service->kendala }}
                                    </p>

                                </div>


                                <div>

                                    <p
                                        class="
                                            text-[10px]
                                            font-bold
                                            uppercase
                                            tracking-wider
                                            text-slate-400
                                        "
                                    >
                                        Kerusakan
                                    </p>


                                    <p
                                        class="
                                            mt-1

                                            text-sm
                                            font-semibold
                                            leading-6
                                            text-red-500
                                        "
                                    >
                                        {{ $service->kerusakan }}
                                    </p>

                                </div>


                                <div>

                                    <p
                                        class="
                                            text-[10px]
                                            font-bold
                                            uppercase
                                            tracking-wider
                                            text-slate-400
                                        "
                                    >
                                        Suku Cadang
                                    </p>


                                    <p
                                        class="
                                            mt-1

                                            text-sm
                                            leading-6
                                            text-slate-700
                                        "
                                    >
                                        {{ $service->suku_cadang }}
                                    </p>

                                </div>


                                <div>

                                    <p
                                        class="
                                            text-[10px]
                                            font-bold
                                            uppercase
                                            tracking-wider
                                            text-slate-400
                                        "
                                    >
                                        Estimasi Biaya
                                    </p>


                                    <p
                                        class="
                                            mt-1

                                            text-sm
                                            font-black
                                            text-emerald-600
                                        "
                                    >
                                        {{ $service->estimasi_harga }}
                                    </p>

                                </div>

                            </div>


                            {{-- ACTION --}}

                            <div
                                class="
                                    mt-5

                                    flex
                                    gap-2

                                    border-t
                                    border-slate-100

                                    pt-4
                                "
                            >

                                <a
                                    href="{{ route(
                                        'admin.services.edit',
                                        $service->id
                                    ) }}"

                                    class="
                                        inline-flex
                                        flex-1
                                        items-center
                                        justify-center

                                        rounded-lg

                                        bg-sky-50

                                        px-4
                                        py-2.5

                                        text-xs
                                        font-bold
                                        text-sky-600
                                    "
                                >
                                    Edit
                                </a>


                                <form
                                    action="{{ route(
                                        'admin.services.destroy',
                                        $service->id
                                    ) }}"

                                    method="POST"

                                    class="flex-1"

                                    onsubmit="
                                        return confirm(
                                            'Yakin ingin menghapus catatan servis ini?'
                                        );
                                    "
                                >

                                    @csrf
                                    @method('DELETE')


                                    <button
                                        type="submit"

                                        class="
                                            w-full

                                            rounded-lg

                                            bg-red-50

                                            px-4
                                            py-2.5

                                            text-xs
                                            font-bold
                                            text-red-500
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
                                px-6
                                py-14

                                text-center
                            "
                        >

                            <p
                                class="
                                    font-bold
                                    text-slate-800
                                "
                            >
                                Belum ada catatan servis
                            </p>


                            <p
                                class="
                                    mt-1

                                    text-sm
                                    text-slate-400
                                "
                            >
                                Tambahkan catatan servis pertama.
                            </p>

                        </div>

                    @endforelse

                </div>


                {{-- SEARCH EMPTY --}}

                <div
                    id="serviceSearchEmpty"

                    class="
                        hidden

                        border-t
                        border-slate-100

                        px-6
                        py-12

                        text-center
                    "
                >

                    <p
                        class="
                            font-bold
                            text-slate-700
                        "
                    >
                        Catatan tidak ditemukan
                    </p>


                    <p
                        class="
                            mt-1

                            text-sm
                            text-slate-400
                        "
                    >
                        Coba cari menggunakan nama armada,
                        plat nomor atau jenis kerusakan.
                    </p>

                </div>

            </section>


            {{-- ================================================= --}}
            {{-- FOOTER --}}
            {{-- ================================================= --}}

            <footer
                class="
                    mt-10

                    flex
                    flex-col
                    gap-2

                    border-t
                    border-slate-200

                    py-6

                    text-xs
                    text-slate-400

                    sm:flex-row
                    sm:justify-between
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
{{-- SEARCH SCRIPT --}}
{{-- ========================================================= --}}

<script>

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            const searchInput =
                document.getElementById(
                    'serviceSearch'
                );


            const desktopRows =
                document.querySelectorAll(
                    '.service-row'
                );


            const mobileRows =
                document.querySelectorAll(
                    '.service-mobile'
                );


            const emptyState =
                document.getElementById(
                    'serviceSearchEmpty'
                );


            if (!searchInput) {
                return;
            }


            function filterServices() {

                const keyword =
                    searchInput.value
                        .toLowerCase()
                        .trim();


                let visibleCount = 0;


                desktopRows.forEach(
                    function (row) {

                        const text =
                            row.dataset.search || '';


                        const match =
                            text.includes(keyword);


                        row.style.display =
                            match
                                ? ''
                                : 'none';


                        if (match) {
                            visibleCount++;
                        }

                    }
                );


                mobileRows.forEach(
                    function (row) {

                        const text =
                            row.dataset.search || '';


                        const match =
                            text.includes(keyword);


                        row.style.display =
                            match
                                ? ''
                                : 'none';

                    }
                );


                if (
                    desktopRows.length > 0 &&
                    visibleCount === 0
                ) {

                    emptyState.classList.remove(
                        'hidden'
                    );

                } else {

                    emptyState.classList.add(
                        'hidden'
                    );

                }

            }


            searchInput.addEventListener(
                'input',
                filterServices
            );

        }
    );

</script>


</body>

</html>