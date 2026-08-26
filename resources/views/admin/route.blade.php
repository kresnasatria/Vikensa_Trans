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

    <title>Manajemen Rute - VikensaTrans</title>

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

    $totalRoutes = $routes->count();

    $totalStops = $routes->sum(function ($route) {

        $destinations = is_string($route->destination)
            ? json_decode($route->destination, true)
            : $route->destination;

        return is_array($destinations)
            ? count($destinations)
            : 1;

    });

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
    x-transition.opacity

    @click="sidebarOpen = false"

    class="
        fixed
        inset-0
        z-40
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
        fixed
        inset-y-0
        left-0
        z-50

        flex
        w-[280px]
        flex-col

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
            flex
            h-24
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


        {{-- ROUTE ACTIVE --}}

        <a
            href="{{ route('admin.route.index') }}"

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

                <circle cx="6" cy="18" r="2"/>
                <circle cx="18" cy="6" r="2"/>

                <path
                    d="M7.5 16.5c2-4 7-4 9-8.5"
                />

            </svg>

            Manajemen Rute

        </a>


        {{-- SERVICE --}}

        <a
            href="{{ route('admin.services.index') }}"

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

                <path d="m14 7 3-3 3 3-3 3"/>

                <path
                    d="M17 4c-4 0-7 3-7 7"
                />

                <path d="M4 20 14 10"/>

            </svg>

            Catatan Servis

        </a>


        {{-- ADD VEHICLE --}}

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

                <circle
                    cx="12"
                    cy="8"
                    r="4"
                />

                <path
                    d="M4 21c0-5 3-8 8-8s8 3 8 8"
                />

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
    {{-- ADMIN ACCOUNT --}}
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

<div
    class="lg:pl-[280px]"
>


    {{-- ===================================================== --}}
    {{-- TOPBAR --}}
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

                    @click="
                        sidebarOpen = true
                    "

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
                        Manajemen Rute
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
            {{-- SUCCESS --}}
            {{-- ================================================= --}}

            @if(session('success'))

                <div
                    x-data="{ show: true }"

                    x-show="show"

                    x-transition

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
            {{-- VALIDATION ERROR --}}
            {{-- ================================================= --}}

            @if($errors->any())

                <div
                    class="
                        mb-6

                        rounded-xl

                        border
                        border-red-200

                        bg-red-50

                        px-5
                        py-4
                    "
                >

                    <p
                        class="
                            text-sm
                            font-bold
                            text-red-700
                        "
                    >
                        Ada data yang belum benar.
                    </p>


                    <ul
                        class="
                            mt-2

                            list-inside
                            list-disc

                            text-sm
                            text-red-600
                        "
                    >

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- ================================================= --}}
            {{-- PAGE HEADING --}}
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
                        Data Perjalanan
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
                        Manajemen Rute
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
                        Tambahkan kota asal dan beberapa kota
                        tujuan atau titik transit yang bisa dipilih
                        pelanggan saat melakukan pemesanan.
                    </p>

                </div>


                <div
                    class="
                        flex
                        gap-3
                    "
                >

                    <div
                        class="
                            rounded-xl

                            border
                            border-slate-200

                            bg-white

                            px-5
                            py-3
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
                            Total Rute
                        </p>


                        <p
                            class="
                                mt-1

                                text-xl
                                font-black
                                text-slate-900
                            "
                        >
                            {{ $totalRoutes }}
                        </p>

                    </div>


                    <div
                        class="
                            rounded-xl

                            border
                            border-slate-200

                            bg-white

                            px-5
                            py-3
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
                            Titik Tujuan
                        </p>


                        <p
                            class="
                                mt-1

                                text-xl
                                font-black
                                text-sky-600
                            "
                        >
                            {{ $totalStops }}
                        </p>

                    </div>

                </div>

            </div>


            {{-- ================================================= --}}
            {{-- FORM + INFO --}}
            {{-- ================================================= --}}

            <div
                class="
                    mt-8

                    grid
                    gap-6

                    xl:grid-cols-[minmax(0,1fr)_320px]
                "
            >


                {{-- ================================================= --}}
                {{-- ADD ROUTE --}}
                {{-- ================================================= --}}

                <section
                    class="
                        rounded-2xl

                        border
                        border-slate-200

                        bg-white
                    "
                >

                    <div
                        class="
                            border-b
                            border-slate-100

                            px-6
                            py-5
                        "
                    >

                        <h2
                            class="
                                text-lg
                                font-black
                                text-slate-900
                            "
                        >
                            Tambah Rute Baru
                        </h2>


                        <p
                            class="
                                mt-1

                                text-sm
                                text-slate-500
                            "
                        >
                            Satu kota asal dapat memiliki beberapa
                            tujuan atau titik transit.
                        </p>

                    </div>


                    <form
                        action="{{ route('admin.route.store') }}"

                        method="POST"

                        x-data="{
                            destinations:
                                {{ Illuminate\Support\Js::from(
                                    old(
                                        'destinations',
                                        ['']
                                    )
                                ) }}
                        }"

                        class="p-6"
                    >

                        @csrf


                        <div
                            class="
                                grid
                                gap-6

                                lg:grid-cols-2
                            "
                        >


                            {{-- ================================================= --}}
                            {{-- ORIGIN --}}
                            {{-- ================================================= --}}

                            <div>

                                <label
                                    for="origin"

                                    class="
                                        block

                                        text-sm
                                        font-bold
                                        text-slate-700
                                    "
                                >
                                    Kota Asal

                                    <span class="text-red-500">
                                        *
                                    </span>
                                </label>


                                <p
                                    class="
                                        mt-1
                                        text-xs
                                        text-slate-400
                                    "
                                >
                                    Titik awal perjalanan.
                                </p>


                                <div
                                    class="
                                        relative
                                        mt-3
                                    "
                                >

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"

                                        class="
                                            absolute
                                            left-4
                                            top-1/2

                                            h-5
                                            w-5

                                            -translate-y-1/2

                                            text-sky-500
                                        "
                                    >

                                        <circle
                                            cx="12"
                                            cy="12"
                                            r="9"
                                        />

                                        <circle
                                            cx="12"
                                            cy="12"
                                            r="3"
                                        />

                                    </svg>


                                    <input
                                        id="origin"

                                        type="text"

                                        name="origin"

                                        value="{{ old('origin') }}"

                                        placeholder="Contoh: Bandung"

                                        maxlength="255"

                                        required

                                        class="
                                            h-13
                                            w-full

                                            rounded-xl

                                            border
                                            border-slate-200

                                            bg-slate-50

                                            py-3.5
                                            pl-12
                                            pr-4

                                            text-sm
                                            font-semibold
                                            text-slate-800

                                            outline-none

                                            transition

                                            placeholder:font-normal
                                            placeholder:text-slate-400

                                            focus:border-sky-500
                                            focus:bg-white
                                            focus:ring-4
                                            focus:ring-sky-500/10
                                        "
                                    >

                                </div>


                                @error('origin')

                                    <p
                                        class="
                                            mt-2

                                            text-xs
                                            font-semibold
                                            text-red-500
                                        "
                                    >
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>


                            {{-- ================================================= --}}
                            {{-- DESTINATION --}}
                            {{-- ================================================= --}}

                            <div>

                                <div
                                    class="
                                        flex
                                        items-start
                                        justify-between
                                        gap-4
                                    "
                                >

                                    <div>

                                        <label
                                            class="
                                                block

                                                text-sm
                                                font-bold
                                                text-slate-700
                                            "
                                        >
                                            Kota Tujuan / Transit

                                            <span class="text-red-500">
                                                *
                                            </span>
                                        </label>


                                        <p
                                            class="
                                                mt-1

                                                text-xs
                                                text-slate-400
                                            "
                                        >
                                            Urutkan sesuai perjalanan.
                                        </p>

                                    </div>


                                    <button
                                        type="button"

                                        @click="
                                            destinations.push('')
                                        "

                                        class="
                                            shrink-0

                                            rounded-lg

                                            bg-sky-50

                                            px-3
                                            py-2

                                            text-xs
                                            font-bold
                                            text-sky-600

                                            transition

                                            hover:bg-sky-100
                                        "
                                    >
                                        + Tambah
                                    </button>

                                </div>


                                <div
                                    class="
                                        mt-3
                                        space-y-3
                                    "
                                >

                                    <template
                                        x-for="
                                            (destination, index)
                                            in destinations
                                        "

                                        :key="index"
                                    >

                                        <div
                                            class="
                                                flex
                                                items-center
                                                gap-2
                                            "
                                        >

                                            <div
                                                class="
                                                    flex
                                                    h-11
                                                    w-8
                                                    shrink-0
                                                    items-center
                                                    justify-center

                                                    text-xs
                                                    font-black
                                                    text-slate-400
                                                "

                                                x-text="
                                                    index + 1
                                                "
                                            ></div>


                                            <input
                                                type="text"

                                                name="destinations[]"

                                                x-model="
                                                    destinations[index]
                                                "

                                                placeholder="Contoh: Jakarta"

                                                maxlength="255"

                                                required

                                                class="
                                                    h-12
                                                    min-w-0
                                                    flex-1

                                                    rounded-xl

                                                    border
                                                    border-slate-200

                                                    bg-slate-50

                                                    px-4

                                                    text-sm
                                                    font-semibold
                                                    text-slate-800

                                                    outline-none

                                                    transition

                                                    placeholder:font-normal
                                                    placeholder:text-slate-400

                                                    focus:border-sky-500
                                                    focus:bg-white
                                                    focus:ring-4
                                                    focus:ring-sky-500/10
                                                "
                                            >


                                            <button
                                                type="button"

                                                x-show="
                                                    destinations.length > 1
                                                "

                                                @click="
                                                    destinations.splice(
                                                        index,
                                                        1
                                                    )
                                                "

                                                title="Hapus titik"

                                                class="
                                                    flex
                                                    h-11
                                                    w-11
                                                    shrink-0
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
                                                    stroke-width="2"

                                                    class="h-4 w-4"
                                                >
                                                    <path
                                                        d="M6 6l12 12M18 6 6 18"
                                                    />
                                                </svg>

                                            </button>

                                        </div>

                                    </template>

                                </div>


                                @error('destinations')

                                    <p
                                        class="
                                            mt-2

                                            text-xs
                                            font-semibold
                                            text-red-500
                                        "
                                    >
                                        {{ $message }}
                                    </p>

                                @enderror


                                @error('destinations.*')

                                    <p
                                        class="
                                            mt-2

                                            text-xs
                                            font-semibold
                                            text-red-500
                                        "
                                    >
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>

                        </div>


                        {{-- ================================================= --}}
                        {{-- ACTION --}}
                        {{-- ================================================= --}}

                        <div
                            class="
                                mt-7

                                flex
                                justify-end

                                border-t
                                border-slate-100

                                pt-5
                            "
                        >

                            <button
                                type="submit"

                                class="
                                    inline-flex
                                    items-center
                                    gap-2

                                    rounded-xl

                                    bg-sky-500

                                    px-6
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

                                Simpan Rute

                            </button>

                        </div>

                    </form>

                </section>


                {{-- ================================================= --}}
                {{-- SIDE INFO --}}
                {{-- ================================================= --}}

                <aside
                    class="
                        rounded-2xl

                        border
                        border-slate-200

                        bg-white

                        p-6
                    "
                >

                    <h3
                        class="
                            text-base
                            font-black
                            text-slate-900
                        "
                    >
                        Contoh penyusunan rute
                    </h3>


                    <p
                        class="
                            mt-2

                            text-sm
                            leading-6
                            text-slate-500
                        "
                    >
                        Kalau perjalanan melewati beberapa kota,
                        masukkan sesuai urutan perjalanan.
                    </p>


                    <div
                        class="
                            mt-6
                            space-y-0
                        "
                    >

                        <div
                            class="
                                flex
                                items-center
                                gap-3
                            "
                        >

                            <span
                                class="
                                    flex
                                    h-8
                                    w-8
                                    items-center
                                    justify-center

                                    rounded-full

                                    bg-sky-500

                                    text-xs
                                    font-black
                                    text-white
                                "
                            >
                                A
                            </span>


                            <div>

                                <p
                                    class="
                                        text-xs
                                        text-slate-400
                                    "
                                >
                                    Kota asal
                                </p>


                                <p
                                    class="
                                        text-sm
                                        font-bold
                                        text-slate-800
                                    "
                                >
                                    Bandung
                                </p>

                            </div>

                        </div>


                        <div
                            class="
                                ml-[15px]

                                h-8
                                w-px

                                bg-slate-200
                            "
                        ></div>


                        <div
                            class="
                                flex
                                items-center
                                gap-3
                            "
                        >

                            <span
                                class="
                                    flex
                                    h-8
                                    w-8
                                    items-center
                                    justify-center

                                    rounded-full

                                    border-2
                                    border-sky-300

                                    bg-white

                                    text-xs
                                    font-black
                                    text-sky-600
                                "
                            >
                                1
                            </span>


                            <div>

                                <p
                                    class="
                                        text-xs
                                        text-slate-400
                                    "
                                >
                                    Transit
                                </p>


                                <p
                                    class="
                                        text-sm
                                        font-bold
                                        text-slate-800
                                    "
                                >
                                    Bekasi
                                </p>

                            </div>

                        </div>


                        <div
                            class="
                                ml-[15px]

                                h-8
                                w-px

                                bg-slate-200
                            "
                        ></div>


                        <div
                            class="
                                flex
                                items-center
                                gap-3
                            "
                        >

                            <span
                                class="
                                    flex
                                    h-8
                                    w-8
                                    items-center
                                    justify-center

                                    rounded-full

                                    bg-slate-950

                                    text-xs
                                    font-black
                                    text-white
                                "
                            >
                                2
                            </span>


                            <div>

                                <p
                                    class="
                                        text-xs
                                        text-slate-400
                                    "
                                >
                                    Tujuan akhir
                                </p>


                                <p
                                    class="
                                        text-sm
                                        font-bold
                                        text-slate-800
                                    "
                                >
                                    Jakarta
                                </p>

                            </div>

                        </div>

                    </div>


                    <div
                        class="
                            mt-6

                            rounded-xl

                            bg-slate-50

                            p-4
                        "
                    >

                        <p
                            class="
                                text-xs
                                leading-6
                                text-slate-500
                            "
                        >
                            Rute yang disimpan di sini akan
                            menjadi pilihan kota pada form
                            booking pelanggan.
                        </p>

                    </div>

                </aside>

            </div>


            {{-- ================================================= --}}
            {{-- ROUTE LIST --}}
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

                        sm:flex-row
                        sm:items-center
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
                            Daftar Rute
                        </h2>


                        <p
                            class="
                                mt-1

                                text-sm
                                text-slate-500
                            "
                        >
                            {{ $totalRoutes }}
                            rute sudah terdaftar.
                        </p>

                    </div>


                    {{-- SEARCH --}}

                    <div
                        class="
                            relative
                            w-full

                            sm:w-72
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

                            <circle
                                cx="11"
                                cy="11"
                                r="7"
                            />

                            <path
                                d="m20 20-3.5-3.5"
                            />

                        </svg>


                        <input
                            type="text"

                            id="liveSearchInput"

                            placeholder="Cari kota..."

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

                        md:block
                    "
                >

                    <table
                        class="
                            w-full
                            min-w-[760px]
                        "
                    >

                        <thead>

                            <tr
                                class="
                                    border-b
                                    border-slate-200

                                    bg-slate-50
                                "
                            >

                                <th
                                    class="
                                        w-20

                                        px-6
                                        py-4

                                        text-left
                                        text-[10px]
                                        font-black
                                        uppercase
                                        tracking-wider
                                        text-slate-400
                                    "
                                >
                                    No.
                                </th>


                                <th
                                    class="
                                        px-6
                                        py-4

                                        text-left
                                        text-[10px]
                                        font-black
                                        uppercase
                                        tracking-wider
                                        text-slate-400
                                    "
                                >
                                    Rute Perjalanan
                                </th>


                                <th
                                    class="
                                        w-36

                                        px-6
                                        py-4

                                        text-center
                                        text-[10px]
                                        font-black
                                        uppercase
                                        tracking-wider
                                        text-slate-400
                                    "
                                >
                                    Titik
                                </th>


                                <th
                                    class="
                                        w-32

                                        px-6
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

                            @forelse($routes as $rute)

                                @php

                                    $destinations =
                                        is_string(
                                            $rute->destination
                                        )
                                            ? json_decode(
                                                $rute->destination,
                                                true
                                            )
                                            : $rute->destination;


                                    if (
                                        !is_array(
                                            $destinations
                                        )
                                    ) {

                                        $destinations = [
                                            $rute->destination
                                        ];

                                    }

                                    $routeSearch =
                                        strtolower(
                                            trim(
                                                $rute->origin .
                                                ' ' .
                                                implode(
                                                    ' ',
                                                    $destinations
                                                )
                                            )
                                        );

                                @endphp


                                <tr
                                    class="
                                        route-row

                                        border-b
                                        border-slate-100

                                        last:border-0

                                        transition

                                        hover:bg-slate-50/70
                                    "

                                    data-search="{{ $routeSearch }}"
                                >


                                    {{-- NUMBER --}}

                                    <td
                                        class="
                                            px-6
                                            py-5

                                            align-top
                                        "
                                    >

                                        <span
                                            class="
                                                flex
                                                h-8
                                                w-8
                                                items-center
                                                justify-center

                                                rounded-lg

                                                bg-slate-100

                                                text-xs
                                                font-black
                                                text-slate-500
                                            "
                                        >
                                            {{ $loop->iteration }}
                                        </span>

                                    </td>


                                    {{-- ROUTE --}}

                                    <td
                                        class="
                                            route-text

                                            px-6
                                            py-5
                                        "
                                    >

                                        <div
                                            class="
                                                flex
                                                flex-wrap
                                                items-center
                                                gap-2
                                            "
                                        >

                                            {{-- ORIGIN --}}

                                            <span
                                                class="
                                                    inline-flex
                                                    items-center
                                                    gap-2

                                                    rounded-lg

                                                    bg-sky-50

                                                    px-3
                                                    py-2

                                                    text-sm
                                                    font-black
                                                    text-sky-700
                                                "
                                            >

                                                <span
                                                    class="
                                                        h-2
                                                        w-2

                                                        rounded-full

                                                        bg-sky-500
                                                    "
                                                ></span>

                                                {{ $rute->origin }}

                                            </span>


                                            @foreach(
                                                $destinations
                                                as $index => $destination
                                            )

                                                <svg
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"

                                                    class="
                                                        h-4
                                                        w-4
                                                        shrink-0
                                                        text-slate-300
                                                    "
                                                >

                                                    <path d="M5 12h14"/>
                                                    <path d="m13 6 6 6-6 6"/>

                                                </svg>


                                                <span
                                                    class="
                                                        inline-flex
                                                        items-center
                                                        gap-2

                                                        rounded-lg

                                                        border
                                                        border-slate-200

                                                        bg-white

                                                        px-3
                                                        py-2

                                                        text-sm
                                                        font-bold
                                                        text-slate-700
                                                    "
                                                >

                                                    {{ $destination }}

                                                </span>

                                            @endforeach

                                        </div>


                                        <p
                                            class="
                                                mt-2

                                                text-xs
                                                text-slate-400
                                            "
                                        >
                                            Dibuat
                                            {{ $rute->created_at->format('d M Y') }}
                                        </p>

                                    </td>


                                    {{-- STOPS --}}

                                    <td
                                        class="
                                            px-6
                                            py-5

                                            text-center
                                            align-top
                                        "
                                    >

                                        <span
                                            class="
                                                inline-flex

                                                rounded-full

                                                bg-slate-100

                                                px-3
                                                py-1.5

                                                text-xs
                                                font-bold
                                                text-slate-600
                                            "
                                        >
                                            {{ count($destinations) }}
                                            tujuan
                                        </span>

                                    </td>


                                    {{-- DELETE --}}

                                    <td
                                        class="
                                            px-6
                                            py-5

                                            text-right
                                            align-top
                                        "
                                    >

                                        <form
                                            action="{{ route(
                                                'admin.route.destroy',
                                                $rute->id
                                            ) }}"

                                            method="POST"

                                            onsubmit="
                                                return confirm(
                                                    'Yakin ingin menghapus rute {{ addslashes($rute->origin) }} ini?'
                                                );
                                            "
                                        >

                                            @csrf
                                            @method('DELETE')


                                            <button
                                                type="submit"

                                                class="
                                                    inline-flex
                                                    items-center
                                                    gap-2

                                                    rounded-lg

                                                    bg-red-50

                                                    px-3
                                                    py-2

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
                                                    <path d="M10 11v5M14 11v5"/>

                                                </svg>

                                                Hapus

                                            </button>

                                        </form>

                                    </td>

                                </tr>


                            @empty

                                <tr>

                                    <td
                                        colspan="4"

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

                                                <circle cx="6" cy="18" r="2"/>
                                                <circle cx="18" cy="6" r="2"/>

                                                <path
                                                    d="M7.5 16.5c2-4 7-4 9-8.5"
                                                />

                                            </svg>

                                        </div>


                                        <p
                                            class="
                                                mt-4
                                                font-bold
                                                text-slate-800
                                            "
                                        >
                                            Belum ada rute
                                        </p>


                                        <p
                                            class="
                                                mt-1
                                                text-sm
                                                text-slate-400
                                            "
                                        >
                                            Tambahkan rute perjalanan pertama
                                            menggunakan form di atas.
                                        </p>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- ================================================= --}}
                {{-- MOBILE ROUTE LIST --}}
                {{-- ================================================= --}}

                <div
                    class="
                        divide-y
                        divide-slate-100

                        md:hidden
                    "
                >

                    @forelse($routes as $rute)

                        @php

                            $destinations =
                                is_string(
                                    $rute->destination
                                )
                                    ? json_decode(
                                        $rute->destination,
                                        true
                                    )
                                    : $rute->destination;


                            if (
                                !is_array(
                                    $destinations
                                )
                            ) {

                                $destinations = [
                                    $rute->destination
                                ];

                            }


                            $routeSearch =
                                strtolower(
                                    trim(
                                        $rute->origin .
                                        ' ' .
                                        implode(
                                            ' ',
                                            $destinations
                                        )
                                    )
                                );

                        @endphp


                        <div
                            class="
                                route-mobile

                                p-5
                            "

                            data-search="{{ $routeSearch }}"
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
                                            text-[10px]
                                            font-black
                                            uppercase
                                            tracking-wider
                                            text-slate-400
                                        "
                                    >
                                        Kota Asal
                                    </p>


                                    <p
                                        class="
                                            mt-1

                                            text-base
                                            font-black
                                            text-sky-700
                                        "
                                    >
                                        {{ $rute->origin }}
                                    </p>

                                </div>


                                <span
                                    class="
                                        shrink-0

                                        rounded-full

                                        bg-slate-100

                                        px-3
                                        py-1.5

                                        text-[10px]
                                        font-bold
                                        text-slate-600
                                    "
                                >
                                    {{ count($destinations) }}
                                    tujuan
                                </span>

                            </div>


                            <div
                                class="
                                    mt-4
                                    space-y-2
                                "
                            >

                                @foreach(
                                    $destinations
                                    as $index => $destination
                                )

                                    <div
                                        class="
                                            flex
                                            items-center
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

                                                rounded-lg

                                                bg-slate-100

                                                text-[10px]
                                                font-black
                                                text-slate-500
                                            "
                                        >
                                            {{ $index + 1 }}
                                        </span>


                                        <p
                                            class="
                                                text-sm
                                                font-semibold
                                                text-slate-700
                                            "
                                        >
                                            {{ $destination }}
                                        </p>

                                    </div>

                                @endforeach

                            </div>


                            <div
                                class="
                                    mt-5

                                    flex
                                    items-center
                                    justify-between
                                    gap-4

                                    border-t
                                    border-slate-100

                                    pt-4
                                "
                            >

                                <p
                                    class="
                                        text-xs
                                        text-slate-400
                                    "
                                >
                                    {{ $rute->created_at->format('d M Y') }}
                                </p>


                                <form
                                    action="{{ route(
                                        'admin.route.destroy',
                                        $rute->id
                                    ) }}"

                                    method="POST"

                                    onsubmit="
                                        return confirm(
                                            'Yakin ingin menghapus rute ini?'
                                        );
                                    "
                                >

                                    @csrf
                                    @method('DELETE')


                                    <button
                                        type="submit"

                                        class="
                                            rounded-lg

                                            bg-red-50

                                            px-4
                                            py-2

                                            text-xs
                                            font-bold
                                            text-red-500
                                        "
                                    >
                                        Hapus
                                    </button>

                                </form>

                            </div>

                        </div>


                    @empty

                        <div
                            class="
                                px-6
                                py-14

                                text-center
                                text-sm
                                text-slate-400
                            "
                        >
                            Belum ada rute perjalanan.
                        </div>

                    @endforelse

                </div>


                {{-- ================================================= --}}
                {{-- SEARCH EMPTY --}}
                {{-- ================================================= --}}

                <div
                    id="searchEmpty"

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
                        Rute tidak ditemukan
                    </p>


                    <p
                        class="
                            mt-1

                            text-sm
                            text-slate-400
                        "
                    >
                        Coba cari menggunakan nama kota lain.
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
{{-- SEARCH --}}
{{-- ========================================================= --}}

<script>

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            const searchInput =
                document.getElementById(
                    'liveSearchInput'
                );


            const desktopRows =
                document.querySelectorAll(
                    '.route-row'
                );


            const mobileRows =
                document.querySelectorAll(
                    '.route-mobile'
                );


            const emptyState =
                document.getElementById(
                    'searchEmpty'
                );


            if (!searchInput) {
                return;
            }


            function searchRoutes() {

                const keyword =
                    searchInput.value
                        .toLowerCase()
                        .trim();


                let visibleCount = 0;



                /*
                |--------------------------------------------------------------------------
                | DESKTOP
                |--------------------------------------------------------------------------
                */

                desktopRows.forEach(
                    function (row) {

                        const text =
                            row.dataset.search
                            || '';


                        const match =
                            text.includes(
                                keyword
                            );


                        row.style.display =
                            match
                                ? ''
                                : 'none';


                        if (match) {
                            visibleCount++;
                        }

                    }
                );



                /*
                |--------------------------------------------------------------------------
                | MOBILE
                |--------------------------------------------------------------------------
                */

                mobileRows.forEach(
                    function (row) {

                        const text =
                            row.dataset.search
                            || '';


                        const match =
                            text.includes(
                                keyword
                            );


                        row.style.display =
                            match
                                ? ''
                                : 'none';

                    }
                );



                /*
                |--------------------------------------------------------------------------
                | EMPTY SEARCH
                |--------------------------------------------------------------------------
                */

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
                searchRoutes
            );

        }
    );

</script>


</body>

</html>