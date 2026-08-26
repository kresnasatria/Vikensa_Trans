<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <meta name="description"
          content="Form Pemesanan VikensaTrans">

    <title>Booking - VikensaTrans</title>

    <link rel="icon"
          href="{{ asset('images/vikensa_trans_logo.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- SELECT2 --}}
    <link
        href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
        rel="stylesheet"
    >

    <style>

        [x-cloak] {
            display: none !important;
        }

        html {
            scroll-behavior: smooth;
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

        .booking-card {
            box-shadow:
                0 20px 60px rgba(15, 23, 42, .055);
        }

        .vehicle-image {
            transition: transform .5s ease;
        }

        .vehicle-wrapper:hover .vehicle-image {
            transform: scale(1.04);
        }


        /* ===================================================== */
        /* SELECT2 VIKENSATRANS */
        /* ===================================================== */

        .select2-container {
            width: 100% !important;
        }

        .select2-container--default
        .select2-selection--single {

            height: 56px !important;

            border: 1px solid #e2e8f0 !important;

            border-radius: 16px !important;

            background: #f8fafc !important;

            display: flex !important;

            align-items: center !important;

            transition:
                border-color .2s ease,
                box-shadow .2s ease,
                background .2s ease;
        }

        .select2-container--default.select2-container--focus
        .select2-selection--single,
        .select2-container--default.select2-container--open
        .select2-selection--single {

            border-color: #0ea5e9 !important;

            background: #ffffff !important;

            box-shadow:
                0 0 0 4px rgba(14, 165, 233, .10) !important;
        }

        .select2-container--default
        .select2-selection--single
        .select2-selection__rendered {

            color: #0f172a !important;

            line-height: 54px !important;

            padding-left: 16px !important;

            padding-right: 45px !important;

            font-size: 14px !important;

            font-weight: 600 !important;
        }

        .select2-container--default
        .select2-selection--single
        .select2-selection__placeholder {

            color: #94a3b8 !important;

            font-weight: 500 !important;
        }

        .select2-container--default
        .select2-selection--single
        .select2-selection__arrow {

            height: 54px !important;

            right: 12px !important;
        }

        .select2-container--default.select2-container--disabled
        .select2-selection--single {

            background: #f1f5f9 !important;

            cursor: not-allowed;
        }

        .select2-dropdown {

            border: 1px solid #e2e8f0 !important;

            border-radius: 16px !important;

            overflow: hidden !important;

            box-shadow:
                0 20px 45px rgba(15, 23, 42, .12) !important;
        }

        .select2-search--dropdown {
            padding: 12px !important;
        }

        .select2-search__field {

            height: 42px !important;

            border: 1px solid #e2e8f0 !important;

            border-radius: 12px !important;

            padding: 0 12px !important;

            outline: none !important;
        }

        .select2-search__field:focus {

            border-color: #0ea5e9 !important;

            box-shadow:
                0 0 0 3px rgba(14, 165, 233, .10) !important;
        }

        .select2-results__option {

            padding: 11px 14px !important;

            font-size: 14px !important;
        }

        .select2-container--default
        .select2-results__option--highlighted[aria-selected] {

            background: #0ea5e9 !important;

            color: white !important;
        }

    </style>

</head>


@php

    $userName =
        Auth::user()?->name
        ?? 'Pengguna';


    $shuttleName =
        strtolower(
            $schedule->shuttle->name ?? ''
        );


    /*
    |--------------------------------------------------------------------------
    | FOTO ARMADA
    |--------------------------------------------------------------------------
    */

    if (str_contains($shuttleName, 'wuling')) {

        $vehicleImage =
            'images/wuling.PNG';

    } elseif (
        ($schedule->shuttle->id ?? 1) % 2 === 0
    ) {

        $vehicleImage =
            'images/v02.jpeg';

    } else {

        $vehicleImage =
            'images/v01.jpeg';

    }

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
        w-[280px]
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
    {{-- LOGO --}}
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
            href="{{ url('/') }}"

            class="
                flex
                items-center
            "
        >

            <img
                src="{{ asset('images/vikensa_trans_logo.png') }}"

                alt="VikensaTrans"

                class="
                    h-16
                    w-auto
                    max-w-[200px]

                    object-contain
                "
            >

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

                <path
                    d="M6 6l12 12M18 6L6 18"
                />

            </svg>

        </button>

    </div>



    {{-- ===================================================== --}}
    {{-- NAVIGATION --}}
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
            Menu Utama
        </p>



        {{-- DASHBOARD --}}

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

            Dashboard

        </a>



        {{-- BOOKING ACTIVE --}}

        <div
            class="
                mt-2

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
                    stroke-width="1.8"

                    class="h-5 w-5"
                >

                    <path
                        d="M6 2v4M18 2v4"
                    />

                    <rect
                        x="3"
                        y="5"
                        width="18"
                        height="16"
                        rx="2"
                    />

                    <path
                        d="M3 10h18"
                    />

                    <path
                        d="m9 15 2 2 4-4"
                    />

                </svg>

            </div>

            Pemesanan

        </div>



        {{-- RIWAYAT --}}

        <a
            href="{{ route('riwayat') }}"

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

                    <path
                        d="M3 12a9 9 0 1 0 3-6.7"
                    />

                    <path
                        d="M3 4v6h6"
                    />

                    <path
                        d="M12 7v5l3 2"
                    />

                </svg>

            </div>

            Riwayat Pesanan

        </a>



        {{-- PROFILE --}}

        @auth

            <a
                href="{{ route('profile.edit') }}"

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

                Profil Saya

            </a>

        @endauth



        {{-- WEBSITE --}}

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


        <a
            href="{{ url('/') }}"

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

                    <path
                        d="m3 11 9-8 9 8"
                    />

                    <path
                        d="M5 10v10h14V10"
                    />

                    <path
                        d="M9 20v-6h6v6"
                    />

                </svg>

            </div>

            Kembali ke Beranda

        </a>



        {{-- BOOKING INFO --}}

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

                    bg-sky-500/10

                    text-sky-400
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
                        d="M12 22s7-5 7-12a7 7 0 1 0-14 0c0 7 7 12 7 12Z"
                    />

                    <circle
                        cx="12"
                        cy="10"
                        r="2"
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
                Charter VikensaTrans
            </p>


            <p
                class="
                    mt-2

                    text-xs
                    leading-6
                    text-slate-500
                "
            >
                Tentukan sendiri kota jemput,
                tujuan, serta waktu perjalanan
                sesuai kebutuhanmu.
            </p>

        </div>

    </nav>



    {{-- ===================================================== --}}
    {{-- USER --}}
    {{-- ===================================================== --}}

    @auth

        <div
            class="
                border-t
                border-white/10

                p-4
            "
        >

            <div
                class="relative"
            >

                <button
                    @click="profileOpen = !profileOpen"

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

                        {{ mb_substr($userName, 0, 1) }}

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
                                truncate

                                text-xs
                                text-slate-500
                            "
                        >
                            {{ Auth::user()->email }}
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

                        <path
                            d="m6 9 6 6 6-6"
                        />

                    </svg>

                </button>



                <div
                    x-show="profileOpen"

                    x-cloak

                    x-transition

                    @click.outside="profileOpen = false"

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
                        Edit Profil
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

    @endauth

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
                gap-4
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
                        VikensaTrans
                    </p>


                    <h2
                        class="
                            text-lg
                            font-black
                            text-slate-950
                        "
                    >
                        Pemesanan
                    </h2>

                </div>

            </div>



            <a
                href="{{ route('dashboard') }}"

                class="
                    inline-flex
                    items-center
                    gap-2

                    rounded-xl

                    border
                    border-slate-200

                    px-4
                    py-2.5

                    text-sm
                    font-bold
                    text-slate-600

                    transition

                    hover:border-sky-200
                    hover:bg-sky-50
                    hover:text-sky-600
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
                        d="M19 12H5"
                    />

                    <path
                        d="m11 18-6-6 6-6"
                    />

                </svg>

                <span class="hidden sm:inline">
                    Kembali ke Dashboard
                </span>

            </a>

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
            {{-- PAGE HEADING --}}
            {{-- ================================================= --}}

            <div
                class="
                    flex
                    flex-col
                    justify-between
                    gap-5

                    lg:flex-row
                    lg:items-end
                "
            >

                <div>

                    <div
                        class="
                            inline-flex
                            items-center
                            gap-2

                            rounded-full

                            bg-sky-100

                            px-4
                            py-2

                            text-xs
                            font-black
                            uppercase
                            tracking-[.15em]
                            text-sky-700
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

                        Armada Tersedia

                    </div>


                    <h1
                        class="
                            mt-4

                            text-3xl
                            font-black
                            tracking-tight
                            text-slate-950

                            sm:text-4xl
                        "
                    >
                        Atur perjalananmu.
                    </h1>


                    <p
                        class="
                            mt-3

                            max-w-2xl

                            text-sm
                            leading-7
                            text-slate-500

                            sm:text-base
                        "
                    >
                        Lengkapi informasi pemesan,
                        tentukan kota jemput dan tujuan,
                        lalu pilih waktu perjalanan.
                    </p>

                </div>


                <div
                    class="
                        inline-flex
                        w-fit
                        items-center
                        gap-2

                        rounded-full

                        bg-white

                        px-4
                        py-2

                        text-xs
                        font-bold
                        text-slate-500

                        shadow-sm
                        ring-1
                        ring-slate-200
                    "
                >

                    <svg
                        viewBox="0 0 24 24"

                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"

                        class="
                            h-4
                            w-4

                            text-emerald-500
                        "
                    >

                        <path
                            d="m5 12 4 4L19 6"
                        />

                    </svg>

                    Booking aman melalui VikensaTrans

                </div>

            </div>



            {{-- ================================================= --}}
            {{-- VALIDATION --}}
            {{-- ================================================= --}}

            @if($errors->any())

                <div
                    class="
                        mt-7

                        rounded-2xl

                        border
                        border-red-200

                        bg-red-50

                        p-5
                    "
                >

                    <div
                        class="
                            flex
                            items-start
                            gap-3
                        "
                    >

                        <div
                            class="
                                flex
                                h-9
                                w-9
                                shrink-0
                                items-center
                                justify-center

                                rounded-xl

                                bg-red-100

                                font-black
                                text-red-500
                            "
                        >
                            !
                        </div>


                        <div>

                            <p
                                class="
                                    font-black
                                    text-red-700
                                "
                            >
                                Data pemesanan belum lengkap
                            </p>


                            <p
                                class="
                                    mt-1

                                    text-sm
                                    text-red-600
                                "
                            >
                                Periksa kembali data berikut:
                            </p>


                            <ul
                                class="
                                    mt-3

                                    list-inside
                                    list-disc
                                    space-y-1

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

                    </div>

                </div>

            @endif



            {{-- ================================================= --}}
            {{-- FORM --}}
            {{-- ================================================= --}}

            <form
                action="{{ route('book.store') }}"

                method="POST"

                id="bookingForm"

                class="mt-8"
            >

                @csrf


                {{-- BACKEND DATA --}}

                <input
                    type="hidden"

                    name="schedule_id"

                    value="{{ $schedule->id }}"
                >


                <input
                    type="hidden"

                    name="custom_origin"

                    id="hidden_origin"

                    value="{{ old('custom_origin') }}"
                >


                <input
                    type="hidden"

                    name="custom_destination"

                    id="hidden_destination"

                    value="{{ old('custom_destination') }}"
                >


                <input
                    type="hidden"

                    name="calculated_total_price"

                    id="hidden_total_price"

                    value="{{ $schedule->price }}"
                >



                <div
                    class="
                        grid
                        gap-7

                        xl:grid-cols-[minmax(0,1fr)_380px]
                    "
                >


                    {{-- ================================================= --}}
                    {{-- LEFT --}}
                    {{-- ================================================= --}}

                    <div
                        class="space-y-7"
                    >


                        {{-- ================================================= --}}
                        {{-- STEP 1 --}}
                        {{-- ================================================= --}}

                        <section
                            class="
                                booking-card

                                overflow-hidden

                                rounded-[2rem]

                                border
                                border-slate-200

                                bg-white
                            "
                        >

                            <div
                                class="
                                    flex
                                    items-center
                                    gap-4

                                    border-b
                                    border-slate-100

                                    px-6
                                    py-5

                                    sm:px-7
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
                                        text-white

                                        shadow-lg
                                        shadow-sky-500/20
                                    "
                                >
                                    01
                                </div>


                                <div>

                                    <h2
                                        class="
                                            text-lg
                                            font-black
                                            text-slate-950
                                        "
                                    >
                                        Informasi Pemesan
                                    </h2>


                                    <p
                                        class="
                                            mt-1

                                            text-xs
                                            text-slate-400
                                        "
                                    >
                                        Data yang dapat dihubungi terkait perjalanan.
                                    </p>

                                </div>

                            </div>



                            <div
                                class="
                                    grid
                                    gap-5

                                    p-6

                                    sm:p-7
                                    md:grid-cols-2
                                "
                            >


                                {{-- NAME --}}

                                <div>

                                    <label
                                        for="booker_name"

                                        class="
                                            block

                                            text-sm
                                            font-bold
                                            text-slate-700
                                        "
                                    >
                                        Nama Pemesan

                                        <span class="text-red-500">
                                            *
                                        </span>
                                    </label>


                                    <div
                                        class="
                                            relative
                                            mt-2
                                        "
                                    >

                                        <div
                                            class="
                                                pointer-events-none

                                                absolute
                                                inset-y-0
                                                left-0

                                                flex
                                                items-center

                                                pl-4

                                                text-slate-400
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


                                        <input
                                            id="booker_name"

                                            type="text"

                                            name="booker_name"

                                            value="{{ old(
                                                'booker_name',
                                                Auth::user()?->name ?? ''
                                            ) }}"

                                            required

                                            placeholder="Nama lengkap pemesan"

                                            class="
                                                block
                                                h-14
                                                w-full

                                                rounded-2xl

                                                border
                                                border-slate-200

                                                bg-slate-50

                                                py-3
                                                pl-12
                                                pr-4

                                                text-sm
                                                font-medium
                                                text-slate-900

                                                outline-none

                                                transition

                                                placeholder:text-slate-400

                                                hover:border-slate-300

                                                focus:border-sky-500
                                                focus:bg-white
                                                focus:ring-4
                                                focus:ring-sky-500/10
                                            "
                                        >

                                    </div>


                                    @error('booker_name')

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



                                {{-- PHONE --}}

                                <div>

                                    <label
                                        for="phone_number"

                                        class="
                                            block

                                            text-sm
                                            font-bold
                                            text-slate-700
                                        "
                                    >
                                        No. WhatsApp / HP

                                        <span class="text-red-500">
                                            *
                                        </span>
                                    </label>


                                    <div
                                        class="
                                            relative
                                            mt-2
                                        "
                                    >

                                        <div
                                            class="
                                                pointer-events-none

                                                absolute
                                                inset-y-0
                                                left-0

                                                flex
                                                items-center

                                                pl-4

                                                text-slate-400
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
                                                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.12.9.33 1.78.62 2.63a2 2 0 0 1-.45 2.11L8 9.73a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.85.29 1.73.5 2.63.62A2 2 0 0 1 22 16.92Z"
                                                />

                                            </svg>

                                        </div>


                                        <input
                                            id="phone_number"

                                            type="text"

                                            inputmode="tel"

                                            name="phone_number"

                                            value="{{ old('phone_number') }}"

                                            maxlength="20"

                                            required

                                            placeholder="Contoh: 081234567890"

                                            class="
                                                block
                                                h-14
                                                w-full

                                                rounded-2xl

                                                border
                                                border-slate-200

                                                bg-slate-50

                                                py-3
                                                pl-12
                                                pr-4

                                                text-sm
                                                font-medium
                                                text-slate-900

                                                outline-none

                                                transition

                                                placeholder:text-slate-400

                                                hover:border-slate-300

                                                focus:border-sky-500
                                                focus:bg-white
                                                focus:ring-4
                                                focus:ring-sky-500/10
                                            "
                                        >

                                    </div>


                                    @error('phone_number')

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



                                {{-- PICKUP ADDRESS --}}

                                <div
                                    class="md:col-span-2"
                                >

                                    <label
                                        for="pickup_address"

                                        class="
                                            block

                                            text-sm
                                            font-bold
                                            text-slate-700
                                        "
                                    >
                                        Alamat Detail Titik Jemput

                                        <span class="text-red-500">
                                            *
                                        </span>
                                    </label>


                                    <div
                                        class="
                                            relative
                                            mt-2
                                        "
                                    >

                                        <div
                                            class="
                                                pointer-events-none

                                                absolute
                                                left-4
                                                top-4

                                                text-slate-400
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
                                                    d="M12 22s7-5 7-12a7 7 0 1 0-14 0c0 7 7 12 7 12Z"
                                                />

                                                <circle
                                                    cx="12"
                                                    cy="10"
                                                    r="2"
                                                />

                                            </svg>

                                        </div>


                                        <textarea
                                            id="pickup_address"

                                            name="pickup_address"

                                            rows="4"

                                            required

                                            placeholder="Contoh: Jl. Ahmad Yani No. 20, depan minimarket, pagar warna hitam..."

                                            class="
                                                block
                                                w-full

                                                resize-none

                                                rounded-2xl

                                                border
                                                border-slate-200

                                                bg-slate-50

                                                py-4
                                                pl-12
                                                pr-4

                                                text-sm
                                                font-medium
                                                leading-6
                                                text-slate-900

                                                outline-none

                                                transition

                                                placeholder:text-slate-400

                                                hover:border-slate-300

                                                focus:border-sky-500
                                                focus:bg-white
                                                focus:ring-4
                                                focus:ring-sky-500/10
                                            "
                                        >{{ old('pickup_address') }}</textarea>

                                    </div>


                                    <p
                                        class="
                                            mt-2

                                            text-xs
                                            leading-5
                                            text-slate-400
                                        "
                                    >
                                        Tambahkan nama jalan, nomor rumah,
                                        RT/RW, hotel, atau patokan yang jelas.
                                    </p>


                                    @error('pickup_address')

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

                        </section>



                        {{-- ================================================= --}}
                        {{-- STEP 2 --}}
                        {{-- ================================================= --}}

                        <section
                            class="
                                booking-card

                                overflow-hidden

                                rounded-[2rem]

                                border
                                border-slate-200

                                bg-white
                            "
                        >

                            <div
                                class="
                                    flex
                                    items-center
                                    gap-4

                                    border-b
                                    border-slate-100

                                    px-6
                                    py-5

                                    sm:px-7
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
                                        text-white

                                        shadow-lg
                                        shadow-sky-500/20
                                    "
                                >
                                    02
                                </div>


                                <div>

                                    <h2
                                        class="
                                            text-lg
                                            font-black
                                            text-slate-950
                                        "
                                    >
                                        Rute Perjalanan
                                    </h2>


                                    <p
                                        class="
                                            mt-1

                                            text-xs
                                            text-slate-400
                                        "
                                    >
                                        Pilih kota jemput dan kota tujuan.
                                    </p>

                                </div>

                            </div>



                            <div
                                class="
                                    grid
                                    gap-5

                                    p-6

                                    sm:p-7
                                    md:grid-cols-2
                                "
                            >


                                {{-- ORIGIN --}}

                                <div>

                                    <label
                                        for="origin_city"

                                        class="
                                            block

                                            text-sm
                                            font-bold
                                            text-slate-700
                                        "
                                    >
                                        Kota Jemput

                                        <span class="text-red-500">
                                            *
                                        </span>
                                    </label>


                                    <select
                                        id="origin_city"

                                        required

                                        class="w-full"
                                    >

                                        <option value="">
                                            Pilih kota jemput
                                        </option>

                                    </select>


                                    <p
                                        class="
                                            mt-2

                                            text-xs
                                            text-slate-400
                                        "
                                    >
                                        Ketik untuk mencari kota.
                                    </p>


                                    @error('custom_origin')

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



                                {{-- DESTINATION --}}

                                <div>

                                    <label
                                        for="destination_city"

                                        class="
                                            block

                                            text-sm
                                            font-bold
                                            text-slate-700
                                        "
                                    >
                                        Kota Tujuan

                                        <span class="text-red-500">
                                            *
                                        </span>
                                    </label>


                                    <select
                                        id="destination_city"

                                        required
                                        disabled

                                        class="w-full"
                                    >

                                        <option value="">
                                            Pilih kota tujuan
                                        </option>

                                    </select>


                                    <p
                                        class="
                                            mt-2

                                            text-xs
                                            text-slate-400
                                        "
                                    >
                                        Pilihan muncul setelah kota jemput dipilih.
                                    </p>


                                    @error('custom_destination')

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



                                {{-- ROUTE VISUAL --}}

                                <div
                                    class="
                                        md:col-span-2

                                        rounded-2xl

                                        border
                                        border-sky-100

                                        bg-sky-50

                                        p-5
                                    "
                                >

                                    <div
                                        class="
                                            flex
                                            items-start
                                            gap-4
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

                                                bg-white

                                                text-sky-600

                                                shadow-sm
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
                                                    d="M5 19c0-7 14-7 14-14"
                                                />

                                                <circle
                                                    cx="5"
                                                    cy="19"
                                                    r="2"
                                                />

                                                <circle
                                                    cx="19"
                                                    cy="5"
                                                    r="2"
                                                />

                                            </svg>

                                        </div>


                                        <div>

                                            <p
                                                class="
                                                    text-sm
                                                    font-black
                                                    text-sky-900
                                                "
                                            >
                                                Rute charter fleksibel
                                            </p>


                                            <p
                                                class="
                                                    mt-1

                                                    text-xs
                                                    leading-6
                                                    text-sky-700
                                                "
                                            >
                                                Kota yang tersedia mengikuti
                                                data rute yang sudah dikelola
                                                administrator VikensaTrans.
                                            </p>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </section>



                        {{-- ================================================= --}}
                        {{-- STEP 3 --}}
                        {{-- ================================================= --}}

                        <section
                            class="
                                booking-card

                                overflow-hidden

                                rounded-[2rem]

                                border
                                border-slate-200

                                bg-white
                            "
                        >

                            <div
                                class="
                                    flex
                                    items-center
                                    gap-4

                                    border-b
                                    border-slate-100

                                    px-6
                                    py-5

                                    sm:px-7
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
                                        text-white

                                        shadow-lg
                                        shadow-sky-500/20
                                    "
                                >
                                    03
                                </div>


                                <div>

                                    <h2
                                        class="
                                            text-lg
                                            font-black
                                            text-slate-950
                                        "
                                    >
                                        Waktu Perjalanan
                                    </h2>


                                    <p
                                        class="
                                            mt-1

                                            text-xs
                                            text-slate-400
                                        "
                                    >
                                        Tentukan waktu mulai dan selesai sewa.
                                    </p>

                                </div>

                            </div>



                            <div
                                class="
                                    grid
                                    gap-5

                                    p-6

                                    sm:p-7
                                    md:grid-cols-2
                                "
                            >


                                {{-- DEPARTURE --}}

                                <div>

                                    <label
                                        for="custom_departure_time"

                                        class="
                                            block

                                            text-sm
                                            font-bold
                                            text-slate-700
                                        "
                                    >
                                        Waktu Keberangkatan

                                        <span class="text-red-500">
                                            *
                                        </span>
                                    </label>


                                    <input
                                        id="custom_departure_time"

                                        type="datetime-local"

                                        name="custom_departure_time"

                                        value="{{ old(
                                            'custom_departure_time'
                                        ) }}"

                                        required

                                        class="
                                            mt-2

                                            block
                                            h-14
                                            w-full

                                            rounded-2xl

                                            border
                                            border-slate-200

                                            bg-slate-50

                                            px-4

                                            text-sm
                                            font-medium
                                            text-slate-900

                                            outline-none

                                            transition

                                            hover:border-slate-300

                                            focus:border-sky-500
                                            focus:bg-white
                                            focus:ring-4
                                            focus:ring-sky-500/10
                                        "
                                    >


                                    @error('custom_departure_time')

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



                                {{-- ARRIVAL --}}

                                <div>

                                    <label
                                        for="custom_arrival_time"

                                        class="
                                            block

                                            text-sm
                                            font-bold
                                            text-slate-700
                                        "
                                    >
                                        Waktu Selesai / Kembali

                                        <span class="text-red-500">
                                            *
                                        </span>
                                    </label>


                                    <input
                                        id="custom_arrival_time"

                                        type="datetime-local"

                                        name="custom_arrival_time"

                                        value="{{ old(
                                            'custom_arrival_time'
                                        ) }}"

                                        required

                                        class="
                                            mt-2

                                            block
                                            h-14
                                            w-full

                                            rounded-2xl

                                            border
                                            border-slate-200

                                            bg-slate-50

                                            px-4

                                            text-sm
                                            font-medium
                                            text-slate-900

                                            outline-none

                                            transition

                                            hover:border-slate-300

                                            focus:border-sky-500
                                            focus:bg-white
                                            focus:ring-4
                                            focus:ring-sky-500/10
                                        "
                                    >


                                    @error('custom_arrival_time')

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



                                {{-- TIME INFO --}}

                                <div
                                    class="
                                        md:col-span-2

                                        flex
                                        items-start
                                        gap-3

                                        rounded-2xl

                                        bg-slate-50

                                        p-4
                                    "
                                >

                                    <div
                                        class="
                                            mt-0.5

                                            text-sky-500
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
                                                cy="12"
                                                r="9"
                                            />

                                            <path
                                                d="M12 7v5l3 2"
                                            />

                                        </svg>

                                    </div>


                                    <p
                                        class="
                                            text-xs
                                            leading-6
                                            text-slate-500
                                        "
                                    >
                                        Durasi sewa akan dihitung otomatis
                                        berdasarkan waktu keberangkatan dan
                                        waktu selesai perjalanan.
                                    </p>

                                </div>

                            </div>

                        </section>

                    </div>



                    {{-- ================================================= --}}
                    {{-- RIGHT SUMMARY --}}
                    {{-- ================================================= --}}

                    <div>

                        <div
                            class="
                                sticky
                                top-28

                                space-y-5
                            "
                        >


                            {{-- ================================================= --}}
                            {{-- VEHICLE --}}
                            {{-- ================================================= --}}

                            <article
                                class="
                                    booking-card

                                    overflow-hidden

                                    rounded-[2rem]

                                    border
                                    border-slate-200

                                    bg-white
                                "
                            >

                                <div
                                    class="
                                        vehicle-wrapper

                                        relative

                                        h-[220px]

                                        overflow-hidden

                                        bg-slate-200
                                    "
                                >

                                    <img
                                        src="{{ asset($vehicleImage) }}"

                                        alt="{{ $schedule->shuttle->name }}"

                                        class="
                                            vehicle-image

                                            h-full
                                            w-full

                                            object-cover
                                        "
                                    >


                                    <div
                                        class="
                                            absolute
                                            inset-0

                                            bg-gradient-to-t

                                            from-slate-950/85
                                            via-slate-950/10
                                            to-transparent
                                        "
                                    ></div>



                                    <div
                                        class="
                                            absolute
                                            left-4
                                            top-4

                                            inline-flex
                                            items-center
                                            gap-2

                                            rounded-full

                                            bg-emerald-500

                                            px-3
                                            py-2

                                            text-[10px]
                                            font-black
                                            uppercase
                                            tracking-wider
                                            text-white

                                            shadow-lg
                                        "
                                    >

                                        <span
                                            class="
                                                h-2
                                                w-2

                                                rounded-full

                                                bg-white
                                            "
                                        ></span>

                                        Tersedia

                                    </div>



                                    <div
                                        class="
                                            absolute
                                            bottom-5
                                            left-5
                                            right-5
                                        "
                                    >

                                        <p
                                            class="
                                                text-[10px]
                                                font-black
                                                uppercase
                                                tracking-[.15em]
                                                text-sky-300
                                            "
                                        >
                                            Armada Pilihan
                                        </p>


                                        <h3
                                            class="
                                                mt-1

                                                text-2xl
                                                font-black
                                                text-white
                                            "
                                        >
                                            {{ $schedule->shuttle->name }}
                                        </h3>


                                        <p
                                            class="
                                                mt-1

                                                text-xs
                                                text-slate-300
                                            "
                                        >
                                            {{ $schedule->shuttle->license_plate }}
                                        </p>

                                    </div>

                                </div>



                                <div
                                    class="p-6"
                                >

                                    <div
                                        class="
                                            flex
                                            items-center
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
                                                Kapasitas
                                            </p>


                                            <p
                                                class="
                                                    mt-1

                                                    text-sm
                                                    font-black
                                                    text-slate-900
                                                "
                                            >
                                                {{ $schedule->shuttle->seat_capacity }}
                                                Penumpang
                                            </p>

                                        </div>


                                        <div
                                            class="text-right"
                                        >

                                            <p
                                                class="
                                                    text-xs
                                                    font-semibold
                                                    text-slate-400
                                                "
                                            >
                                                Sewa / Hari
                                            </p>


                                            <p
                                                id="label_base_price"

                                                data-price="{{ $schedule->price }}"

                                                class="
                                                    mt-1

                                                    text-lg
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

                                </div>

                            </article>



                            {{-- ================================================= --}}
                            {{-- PRICE --}}
                            {{-- ================================================= --}}

                            <section
                                class="
                                    overflow-hidden

                                    rounded-[2rem]

                                    bg-slate-950

                                    p-6

                                    text-white

                                    shadow-xl
                                "
                            >

                                <div
                                    class="
                                        flex
                                        items-center
                                        justify-between
                                        gap-4
                                    "
                                >

                                    <div>

                                        <p
                                            class="
                                                text-xs
                                                font-black
                                                uppercase
                                                tracking-[.15em]
                                                text-sky-400
                                            "
                                        >
                                            Ringkasan Biaya
                                        </p>


                                        <h3
                                            class="
                                                mt-1

                                                text-lg
                                                font-black
                                            "
                                        >
                                            Estimasi Pemesanan
                                        </h3>

                                    </div>


                                    <div
                                        class="
                                            flex
                                            h-11
                                            w-11
                                            items-center
                                            justify-center

                                            rounded-xl

                                            bg-white/10

                                            text-sky-400
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
                                                d="M12 2v20"
                                            />

                                            <path
                                                d="M17 5H9.5a3.5 3.5 0 0 0 0 7H14a3.5 3.5 0 0 1 0 7H6"
                                            />

                                        </svg>

                                    </div>

                                </div>



                                <div
                                    class="
                                        mt-6

                                        space-y-4
                                    "
                                >

                                    <div
                                        class="
                                            flex
                                            items-center
                                            justify-between
                                            gap-4

                                            text-sm
                                        "
                                    >

                                        <span
                                            class="text-slate-400"
                                        >
                                            Harga per hari
                                        </span>


                                        <span
                                            class="
                                                font-bold
                                                text-white
                                            "
                                        >
                                            Rp {{ number_format(
                                                $schedule->price,
                                                0,
                                                ',',
                                                '.'
                                            ) }}
                                        </span>

                                    </div>



                                    <div
                                        class="
                                            flex
                                            items-center
                                            justify-between
                                            gap-4

                                            text-sm
                                        "
                                    >

                                        <span
                                            class="text-slate-400"
                                        >
                                            Durasi sewa
                                        </span>


                                        <span
                                            id="label_days_count"

                                            class="
                                                rounded-lg

                                                bg-amber-400/10

                                                px-3
                                                py-1.5

                                                text-xs
                                                font-black
                                                text-amber-300
                                            "
                                        >
                                            1 Hari
                                        </span>

                                    </div>

                                </div>



                                <div
                                    class="
                                        mt-6

                                        border-t
                                        border-white/10

                                        pt-5
                                    "
                                >

                                    <p
                                        class="
                                            text-xs
                                            font-semibold
                                            text-slate-400
                                        "
                                    >
                                        Total Pembayaran
                                    </p>


                                    <p
                                        id="label_total_price"

                                        class="
                                            mt-2

                                            text-3xl
                                            font-black
                                            tracking-tight
                                            text-sky-400
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
                                            mt-2

                                            text-[11px]
                                            leading-5
                                            text-slate-500
                                        "
                                    >
                                        Total akan dihitung kembali
                                        oleh sistem saat pesanan dibuat.
                                    </p>

                                </div>

                            </section>



                            {{-- ================================================= --}}
                            {{-- CONFIRM --}}
                            {{-- ================================================= --}}

                            <section
                                class="
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
                                        gap-3
                                    "
                                >

                                    <div
                                        class="
                                            flex
                                            h-9
                                            w-9
                                            shrink-0
                                            items-center
                                            justify-center

                                            rounded-xl

                                            bg-emerald-50

                                            text-emerald-600
                                        "
                                    >

                                        <svg
                                            viewBox="0 0 24 24"

                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"

                                            class="h-5 w-5"
                                        >

                                            <path
                                                d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"
                                            />

                                            <path
                                                d="m9 12 2 2 4-4"
                                            />

                                        </svg>

                                    </div>


                                    <div>

                                        <p
                                            class="
                                                text-sm
                                                font-black
                                                text-slate-900
                                            "
                                        >
                                            Periksa sebelum memesan
                                        </p>


                                        <p
                                            class="
                                                mt-1

                                                text-xs
                                                leading-6
                                                text-slate-500
                                            "
                                        >
                                            Pastikan nomor WhatsApp,
                                            titik jemput, tujuan, serta
                                            waktu perjalanan sudah benar.
                                        </p>

                                    </div>

                                </div>



                                @auth

                                    <button
                                        type="submit"

                                        class="
                                            group

                                            mt-5

                                            flex
                                            w-full
                                            items-center
                                            justify-center
                                            gap-3

                                            rounded-2xl

                                            bg-sky-500

                                            px-5
                                            py-4

                                            text-sm
                                            font-black
                                            text-white

                                            shadow-xl
                                            shadow-sky-500/20

                                            transition
                                            duration-300

                                            hover:-translate-y-0.5
                                            hover:bg-sky-400

                                            focus:outline-none
                                            focus:ring-4
                                            focus:ring-sky-500/20
                                        "
                                    >

                                        Konfirmasi & Pesan


                                        <svg
                                            viewBox="0 0 24 24"

                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"

                                            class="
                                                h-5
                                                w-5

                                                transition

                                                group-hover:translate-x-1
                                            "
                                        >

                                            <path
                                                d="M5 12h14"
                                            />

                                            <path
                                                d="m13 6 6 6-6 6"
                                            />

                                        </svg>

                                    </button>

                                @else

                                    <a
                                        href="{{ route('login') }}"

                                        class="
                                            mt-5

                                            flex
                                            w-full
                                            items-center
                                            justify-center

                                            rounded-2xl

                                            bg-sky-500

                                            px-5
                                            py-4

                                            text-sm
                                            font-black
                                            text-white

                                            transition

                                            hover:bg-sky-400
                                        "
                                    >
                                        Login untuk Melanjutkan
                                    </a>

                                @endauth



                                <a
                                    href="{{ route('dashboard') }}"

                                    class="
                                        mt-3

                                        flex
                                        w-full
                                        items-center
                                        justify-center

                                        rounded-2xl

                                        border
                                        border-slate-200

                                        px-5
                                        py-4

                                        text-sm
                                        font-bold
                                        text-slate-500

                                        transition

                                        hover:bg-slate-50
                                        hover:text-slate-900
                                    "
                                >
                                    Pilih Armada Lain
                                </a>

                            </section>

                        </div>

                    </div>

                </div>

            </form>



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
                        © {{ date('Y') }} VikensaTrans.
                        All rights reserved.
                    </p>


                    <p>
                        Your Journey, Our Priority.
                    </p>

                </div>

            </footer>

        </div>

    </main>

</div>



{{-- ========================================================= --}}
{{-- JQUERY + SELECT2 --}}
{{-- ========================================================= --}}

<script
    src="https://code.jquery.com/jquery-3.7.1.min.js"
></script>

<script
    src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"
></script>



{{-- ========================================================= --}}
{{-- BOOKING SCRIPT --}}
{{-- ========================================================= --}}

<script>

    $(document).ready(function () {

        /*
        |--------------------------------------------------------------------------
        | DATA
        |--------------------------------------------------------------------------
        */

        const routesData =
            @json($routes);


        const oldOrigin =
            @json(old('custom_origin'));


        const oldDestination =
            @json(old('custom_destination'));



        const originSelect =
            $('#origin_city');


        const destinationSelect =
            $('#destination_city');


        const departureInput =
            $('#custom_departure_time');


        const arrivalInput =
            $('#custom_arrival_time');


        const hiddenOrigin =
            $('#hidden_origin');


        const hiddenDestination =
            $('#hidden_destination');


        const hiddenTotalPrice =
            $('#hidden_total_price');


        const labelDaysCount =
            $('#label_days_count');


        const labelTotalPrice =
            $('#label_total_price');


        const basePrice =
            parseInt(
                $('#label_base_price')
                    .data('price')
            );


        let totalDays = 1;



        /*
        |--------------------------------------------------------------------------
        | SELECT2
        |--------------------------------------------------------------------------
        */

        originSelect.select2({

            width: '100%',

            placeholder:
                'Pilih kota jemput',

            allowClear: true

        });


        destinationSelect.select2({

            width: '100%',

            placeholder:
                'Pilih kota tujuan',

            allowClear: true

        });



        /*
        |--------------------------------------------------------------------------
        | FORMAT DESTINATION
        |--------------------------------------------------------------------------
        */

        function formatDestination(value) {

            if (!value) {
                return '';
            }


            let result = value;


            try {

                const parsed =
                    JSON.parse(value);


                if (Array.isArray(parsed)) {

                    result =
                        parsed.join(' → ');

                }

            } catch (e) {

                result = value;

            }


            return result;

        }



        /*
        |--------------------------------------------------------------------------
        | ORIGIN LIST
        |--------------------------------------------------------------------------
        */

        const uniqueOrigins = [

            ...new Set(

                routesData

                    .map(item => item.origin)

                    .filter(Boolean)

            )

        ];


        uniqueOrigins.forEach(function (origin) {

            originSelect.append(

                new Option(
                    origin,
                    origin
                )

            );

        });



        /*
        |--------------------------------------------------------------------------
        | DESTINATION LIST
        |--------------------------------------------------------------------------
        */

        function populateDestinations(
            selectedOrigin,
            selectedDestination = null
        ) {

            destinationSelect

                .empty()

                .append(

                    new Option(
                        'Pilih kota tujuan',
                        ''
                    )

                );


            if (!selectedOrigin) {

                destinationSelect

                    .prop(
                        'disabled',
                        true
                    )

                    .trigger(
                        'change.select2'
                    );


                return;

            }


            const availableDestinations =
                routesData.filter(

                    item =>
                        item.origin === selectedOrigin

                );


            availableDestinations.forEach(
                function (route) {

                    const destination =
                        formatDestination(
                            route.destination
                        );


                    destinationSelect.append(

                        new Option(
                            destination,
                            destination
                        )

                    );

                }
            );


            destinationSelect

                .prop(
                    'disabled',
                    false
                );


            if (selectedDestination) {

                destinationSelect

                    .val(
                        selectedDestination
                    );

            }


            destinationSelect

                .trigger(
                    'change.select2'
                );

        }



        /*
        |--------------------------------------------------------------------------
        | OLD INPUT
        |--------------------------------------------------------------------------
        */

        if (oldOrigin) {

            originSelect

                .val(oldOrigin)

                .trigger(
                    'change.select2'
                );


            hiddenOrigin.val(
                oldOrigin
            );


            populateDestinations(
                oldOrigin,
                oldDestination
            );


            if (oldDestination) {

                hiddenDestination.val(
                    oldDestination
                );

            }

        }



        /*
        |--------------------------------------------------------------------------
        | ORIGIN CHANGE
        |--------------------------------------------------------------------------
        */

        originSelect.on(
            'change',
            function () {

                const selectedOrigin =
                    $(this).val();


                hiddenOrigin.val(
                    selectedOrigin || ''
                );


                hiddenDestination.val('');


                populateDestinations(
                    selectedOrigin
                );

            }
        );



        /*
        |--------------------------------------------------------------------------
        | DESTINATION CHANGE
        |--------------------------------------------------------------------------
        */

        destinationSelect.on(
            'change',
            function () {

                hiddenDestination.val(

                    $(this).val() || ''

                );

            }
        );



        /*
        |--------------------------------------------------------------------------
        | RUPIAH FORMAT
        |--------------------------------------------------------------------------
        */

        function formatRupiah(number) {

            return new Intl.NumberFormat(

                'id-ID',

                {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                }

            ).format(number);

        }



        /*
        |--------------------------------------------------------------------------
        | UPDATE PRICE
        |--------------------------------------------------------------------------
        */

        function updateTotalPrice() {

            const total =
                basePrice * totalDays;


            hiddenTotalPrice.val(
                total
            );


            labelTotalPrice.text(

                formatRupiah(total)

            );

        }



        /*
        |--------------------------------------------------------------------------
        | CALCULATE DAYS
        |--------------------------------------------------------------------------
        */

        function calculateDays() {

            const departureValue =
                departureInput.val();


            const arrivalValue =
                arrivalInput.val();


            totalDays = 1;


            if (
                departureValue &&
                arrivalValue
            ) {

                const departureDate =
                    new Date(
                        departureValue
                    );


                const arrivalDate =
                    new Date(
                        arrivalValue
                    );


                if (
                    arrivalDate >
                    departureDate
                ) {

                    const difference =
                        arrivalDate -
                        departureDate;


                    const dayInMilliseconds =
                        1000 *
                        60 *
                        60 *
                        24;


                    totalDays =
                        Math.ceil(

                            difference /
                            dayInMilliseconds

                        );


                    totalDays =
                        Math.max(
                            1,
                            totalDays
                        );

                }

            }


            labelDaysCount.text(

                totalDays +
                (
                    totalDays === 1
                        ? ' Hari'
                        : ' Hari'
                )

            );


            updateTotalPrice();

        }



        /*
        |--------------------------------------------------------------------------
        | DEPARTURE CHANGE
        |--------------------------------------------------------------------------
        */

        departureInput.on(
            'change',
            function () {

                const departureValue =
                    $(this).val();


                if (departureValue) {

                    arrivalInput.attr(

                        'min',
                        departureValue

                    );

                }


                calculateDays();

            }
        );



        /*
        |--------------------------------------------------------------------------
        | ARRIVAL CHANGE
        |--------------------------------------------------------------------------
        */

        arrivalInput.on(
            'change',
            calculateDays
        );



        /*
        |--------------------------------------------------------------------------
        | INITIAL CALCULATION
        |--------------------------------------------------------------------------
        */

        calculateDays();

    });

</script>


</body>

</html>