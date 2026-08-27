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

    <title>Tambah Catatan Servis - VikensaTrans</title>

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

        textarea {
            resize: vertical;
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



        {{-- ORDERS --}}

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
                        Catatan Servis
                    </p>


                    <h2
                        class="
                            text-lg
                            font-black
                            text-slate-900
                        "
                    >
                        Tambah Catatan
                    </h2>

                </div>

            </div>


            <a
                href="{{ route('admin.services.index') }}"

                class="
                    inline-flex
                    items-center
                    gap-2

                    rounded-xl

                    border
                    border-slate-200

                    bg-white

                    px-4
                    py-2.5

                    text-sm
                    font-bold
                    text-slate-600

                    transition

                    hover:border-sky-300
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
                    <path d="M19 12H5"/>
                    <path d="m11 18-6-6 6-6"/>
                </svg>

                <span class="hidden sm:inline">
                    Kembali
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
        "
    >

        <div
            class="
                mx-auto
                max-w-6xl
            "
        >


            {{-- ================================================= --}}
            {{-- PAGE HEADING --}}
            {{-- ================================================= --}}

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
                    Tambah Catatan Servis
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
                    Catat kondisi kendaraan, kerusakan,
                    suku cadang yang diganti, biaya, dan
                    rencana servis berikutnya.
                </p>

            </div>



            {{-- ================================================= --}}
            {{-- VALIDATION --}}
            {{-- ================================================= --}}

            @if($errors->any())

                <div
                    class="
                        mt-6

                        rounded-xl

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
                                h-8
                                w-8
                                shrink-0
                                items-center
                                justify-center

                                rounded-lg

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
                                    text-sm
                                    font-bold
                                    text-red-700
                                "
                            >
                                Catatan belum dapat disimpan.
                            </p>


                            <ul
                                class="
                                    mt-2

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
                action="{{ route('admin.services.store') }}"

                method="POST"

                class="mt-7"
            >

                @csrf


                <div
                    class="
                        grid
                        gap-6

                        lg:grid-cols-[minmax(0,1fr)_300px]
                    "
                >


                    {{-- ================================================= --}}
                    {{-- MAIN FORM --}}
                    {{-- ================================================= --}}

                    <div
                        class="
                            overflow-hidden

                            rounded-2xl

                            border
                            border-slate-200

                            bg-white
                        "
                    >


                        {{-- FORM HEADER --}}

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
                                Informasi Servis
                            </h2>


                            <p
                                class="
                                    mt-1

                                    text-sm
                                    text-slate-500
                                "
                            >
                                Isi data sesuai hasil pemeriksaan kendaraan.
                            </p>

                        </div>



                        <div
                            class="
                                space-y-6

                                p-6

                                sm:p-7
                            "
                        >


                            {{-- ================================================= --}}
                            {{-- SHUTTLE --}}
                            {{-- ================================================= --}}

                            <div>

                                <label
                                    for="shuttle_id"

                                    class="
                                        block

                                        text-sm
                                        font-bold
                                        text-slate-700
                                    "
                                >
                                    Kendaraan yang Diservis

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
                                    Hanya armada aktif yang tampil pada pilihan ini.
                                </p>


                                <div
                                    class="
                                        relative
                                        mt-3
                                    "
                                >

                                    <select
                                        id="shuttle_id"

                                        name="shuttle_id"

                                        required

                                        class="
                                            h-13
                                            w-full

                                            appearance-none

                                            rounded-xl

                                            border
                                            border-slate-200

                                            bg-slate-50

                                            px-4
                                            py-3.5
                                            pr-12

                                            text-sm
                                            font-semibold
                                            text-slate-800

                                            outline-none

                                            transition

                                            focus:border-sky-500
                                            focus:bg-white
                                            focus:ring-4
                                            focus:ring-sky-500/10
                                        "
                                    >

                                        <option value="">
                                            Pilih armada
                                        </option>


                                        @foreach($shuttles as $shuttle)

                                            <option
                                                value="{{ $shuttle->id }}"

                                                {{
                                                    old('shuttle_id')
                                                    == $shuttle->id

                                                        ? 'selected'
                                                        : ''
                                                }}
                                            >
                                                {{ $shuttle->name }}
                                                —
                                                {{ $shuttle->license_plate }}
                                            </option>

                                        @endforeach

                                    </select>


                                    <div
                                        class="
                                            pointer-events-none

                                            absolute
                                            inset-y-0
                                            right-4

                                            flex
                                            items-center

                                            text-slate-400
                                        "
                                    >

                                        <svg
                                            viewBox="0 0 24 24"

                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"

                                            class="h-4 w-4"
                                        >
                                            <path d="m6 9 6 6 6-6"/>
                                        </svg>

                                    </div>

                                </div>


                                @error('shuttle_id')

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
                            {{-- KM AWAL --}}
                            {{-- ================================================= --}}
                            <div>
                                <label for="km_awal" class="block text-sm font-bold text-slate-700">
                                    Kilometer Awal (KM) <span class="text-red-500">*</span>
                                </label>

                                <p class="mt-1 text-xs text-slate-400">
                                    Angka odometer kendaraan saat masuk bengkel.
                                </p>

                                <input
                                    id="km_awal"
                                    type="number"
                                    name="km_awal"
                                    value="{{ old('km_awal') }}"
                                    required
                                    placeholder="Contoh: 85000"
                                    class="mt-3 h-12 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 text-sm font-semibold text-slate-700 outline-none transition placeholder:font-normal placeholder:text-slate-400 focus:border-sky-500 focus:bg-white focus:ring-4 focus:ring-sky-500/10"
                                >

                                @error('km_awal')
                                    <p class="mt-2 text-xs font-semibold text-red-500">{{ $message }}</p>
                                @enderror
                            </div>



                            {{-- ================================================= --}}
                            {{-- KENDALA --}}
                            {{-- ================================================= --}}

                            <div>

                                <label
                                    for="kendala"

                                    class="
                                        block

                                        text-sm
                                        font-bold
                                        text-slate-700
                                    "
                                >
                                    Kendala yang Dirasakan

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
                                    Tulis gejala atau masalah yang muncul pada kendaraan.
                                </p>


                                <textarea
                                    id="kendala"

                                    name="kendala"

                                    rows="3"

                                    required

                                    placeholder="Contoh: Mesin terasa brebet saat tanjakan dan tarikan mulai berat..."

                                    class="
                                        mt-3

                                        w-full

                                        rounded-xl

                                        border
                                        border-slate-200

                                        bg-slate-50

                                        px-4
                                        py-3

                                        text-sm
                                        leading-6
                                        text-slate-700

                                        outline-none

                                        transition

                                        placeholder:text-slate-400

                                        focus:border-sky-500
                                        focus:bg-white
                                        focus:ring-4
                                        focus:ring-sky-500/10
                                    "
                                >{{ old('kendala') }}</textarea>


                                @error('kendala')

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
                            {{-- KERUSAKAN --}}
                            {{-- ================================================= --}}

                            <div>

                                <label
                                    for="kerusakan"

                                    class="
                                        block

                                        text-sm
                                        font-bold
                                        text-slate-700
                                    "
                                >
                                    Kerusakan yang Ditemukan

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
                                    Isi hasil pemeriksaan atau diagnosis kerusakan.
                                </p>


                                <textarea
                                    id="kerusakan"

                                    name="kerusakan"

                                    rows="3"

                                    required

                                    placeholder="Contoh: Kampas rem depan menipis dan dua busi sudah tidak bekerja optimal..."

                                    class="
                                        mt-3

                                        w-full

                                        rounded-xl

                                        border
                                        border-slate-200

                                        bg-slate-50

                                        px-4
                                        py-3

                                        text-sm
                                        leading-6
                                        text-slate-700

                                        outline-none

                                        transition

                                        placeholder:text-slate-400

                                        focus:border-sky-500
                                        focus:bg-white
                                        focus:ring-4
                                        focus:ring-sky-500/10
                                    "
                                >{{ old('kerusakan') }}</textarea>


                                @error('kerusakan')

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
                            {{-- SPARE PART --}}
                            {{-- ================================================= --}}

                            <div>

                                <label
                                    for="suku_cadang"

                                    class="
                                        block

                                        text-sm
                                        font-bold
                                        text-slate-700
                                    "
                                >
                                    Suku Cadang yang Diganti

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
                                    Tuliskan komponen yang diganti saat servis.
                                </p>


                                <textarea
                                    id="suku_cadang"

                                    name="suku_cadang"

                                    rows="3"

                                    required

                                    placeholder="Contoh: 1 set kampas rem depan, 4 pcs busi, oli mesin 7 liter..."

                                    class="
                                        mt-3

                                        w-full

                                        rounded-xl

                                        border
                                        border-slate-200

                                        bg-slate-50

                                        px-4
                                        py-3

                                        text-sm
                                        leading-6
                                        text-slate-700

                                        outline-none

                                        transition

                                        placeholder:text-slate-400

                                        focus:border-sky-500
                                        focus:bg-white
                                        focus:ring-4
                                        focus:ring-sky-500/10
                                    "
                                >{{ old('suku_cadang') }}</textarea>


                                @error('suku_cadang')

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
                            {{-- NEXT SERVICE & COST --}}
                            {{-- ================================================= --}}

                            <div
                                class="
                                    grid
                                    gap-5

                                    md:grid-cols-2
                                "
                            >


                                {{-- NEXT SERVICE --}}

                                <div>

                                    <label
                                        for="estimasi_waktu"

                                        class="
                                            block

                                            text-sm
                                            font-bold
                                            text-slate-700
                                        "
                                    >
                                        Servis Berikutnya

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
                                        Berdasarkan bulan atau kilometer.
                                    </p>


                                    <input
                                        id="estimasi_waktu"

                                        type="text"

                                        name="estimasi_waktu"

                                        value="{{ old('estimasi_waktu') }}"

                                        required

                                        placeholder="6 Bulan / 10.000 KM"

                                        class="
                                            mt-3

                                            h-12
                                            w-full

                                            rounded-xl

                                            border
                                            border-slate-200

                                            bg-slate-50

                                            px-4

                                            text-sm
                                            font-semibold
                                            text-slate-700

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


                                    @error('estimasi_waktu')

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



                                {{-- PRICE --}}

                                <div>

                                    <label
                                        for="estimasi_harga"

                                        class="
                                            block

                                            text-sm
                                            font-bold
                                            text-slate-700
                                        "
                                    >
                                        Biaya Servis

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
                                        Total atau estimasi biaya servis.
                                    </p>


                                    <input
                                        id="estimasi_harga"

                                        type="text"

                                        inputmode="numeric"

                                        name="estimasi_harga"

                                        value="{{ old('estimasi_harga') }}"

                                        required

                                        placeholder="Rp 1.500.000"

                                        class="
                                            mt-3

                                            h-12
                                            w-full

                                            rounded-xl

                                            border
                                            border-slate-200

                                            bg-slate-50

                                            px-4

                                            text-sm
                                            font-semibold
                                            text-slate-700

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


                                    @error('estimasi_harga')

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

                        </div>



                        {{-- ================================================= --}}
                        {{-- FORM FOOTER --}}
                        {{-- ================================================= --}}

                        <div
                            class="
                                flex
                                flex-col-reverse
                                gap-3

                                border-t
                                border-slate-100

                                bg-slate-50/60

                                px-6
                                py-5

                                sm:flex-row
                                sm:items-center
                                sm:justify-end
                            "
                        >

                            <a
                                href="{{ route('admin.services.index') }}"

                                class="
                                    inline-flex
                                    items-center
                                    justify-center

                                    rounded-xl

                                    border
                                    border-slate-200

                                    bg-white

                                    px-5
                                    py-3

                                    text-sm
                                    font-bold
                                    text-slate-600

                                    transition

                                    hover:bg-slate-50
                                    hover:text-slate-900
                                "
                            >
                                Batal
                            </a>


                            <button
                                type="submit"

                                class="
                                    inline-flex
                                    items-center
                                    justify-center
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
                                    <path d="M5 12h14"/>
                                    <path d="m13 6 6 6-6 6"/>
                                </svg>

                                Simpan Catatan

                            </button>

                        </div>

                    </div>



                    {{-- ================================================= --}}
                    {{-- RIGHT SIDE --}}
                    {{-- ================================================= --}}

                    <aside
                        class="
                            space-y-5
                        "
                    >


                        {{-- INFO --}}

                        <div
                            class="
                                rounded-2xl

                                border
                                border-slate-200

                                bg-white

                                p-5
                            "
                        >

                            <h3
                                class="
                                    text-sm
                                    font-black
                                    text-slate-900
                                "
                            >
                                Data yang dicatat
                            </h3>


                            <div
                                class="
                                    mt-5
                                    space-y-4
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

                                            rounded-lg

                                            bg-sky-50

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
                                                text-sm
                                                font-bold
                                                text-slate-700
                                            "
                                        >
                                            Kondisi awal
                                        </p>


                                        <p
                                            class="
                                                mt-1

                                                text-xs
                                                leading-5
                                                text-slate-400
                                            "
                                        >
                                            Kendala yang dilaporkan saat kendaraan masuk servis.
                                        </p>

                                    </div>

                                </div>



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

                                            rounded-lg

                                            bg-sky-50

                                            text-xs
                                            font-black
                                            text-sky-600
                                        "
                                    >
                                        2
                                    </span>


                                    <div>

                                        <p
                                            class="
                                                text-sm
                                                font-bold
                                                text-slate-700
                                            "
                                        >
                                            Hasil pemeriksaan
                                        </p>


                                        <p
                                            class="
                                                mt-1

                                                text-xs
                                                leading-5
                                                text-slate-400
                                            "
                                        >
                                            Kerusakan yang ditemukan setelah kendaraan diperiksa.
                                        </p>

                                    </div>

                                </div>



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

                                            rounded-lg

                                            bg-sky-50

                                            text-xs
                                            font-black
                                            text-sky-600
                                        "
                                    >
                                        3
                                    </span>


                                    <div>

                                        <p
                                            class="
                                                text-sm
                                                font-bold
                                                text-slate-700
                                            "
                                        >
                                            Perbaikan
                                        </p>


                                        <p
                                            class="
                                                mt-1

                                                text-xs
                                                leading-5
                                                text-slate-400
                                            "
                                        >
                                            Suku cadang, biaya dan jadwal perawatan berikutnya.
                                        </p>

                                    </div>

                                </div>

                            </div>

                        </div>



                        {{-- NOTE --}}

                        <div
                            class="
                                rounded-2xl

                                border
                                border-amber-200

                                bg-amber-50

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

                                <svg
                                    viewBox="0 0 24 24"

                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"

                                    class="
                                        mt-0.5
                                        h-5
                                        w-5
                                        shrink-0

                                        text-amber-600
                                    "
                                >
                                    <path d="M12 3 2 21h20Z"/>
                                    <path d="M12 9v4"/>
                                    <path d="M12 17h.01"/>
                                </svg>


                                <div>

                                    <p
                                        class="
                                            text-sm
                                            font-bold
                                            text-amber-900
                                        "
                                    >
                                        Isi data dengan jelas
                                    </p>


                                    <p
                                        class="
                                            mt-1

                                            text-xs
                                            leading-6
                                            text-amber-700
                                        "
                                    >
                                        Catatan ini nantinya menjadi
                                        riwayat perawatan armada, jadi
                                        sebaiknya gunakan keterangan yang
                                        mudah dipahami saat dicek kembali.
                                    </p>

                                </div>

                            </div>

                        </div>



                        {{-- ACTIVE VEHICLE INFO --}}

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
                                    font-bold
                                    uppercase
                                    tracking-wider
                                    text-slate-400
                                "
                            >
                                Armada Aktif
                            </p>


                            <p
                                class="
                                    mt-2

                                    text-2xl
                                    font-black
                                    text-slate-900
                                "
                            >
                                {{ $shuttles->count() }}
                            </p>


                            <p
                                class="
                                    mt-1

                                    text-xs
                                    leading-5
                                    text-slate-400
                                "
                            >
                                kendaraan dapat dipilih untuk
                                pencatatan servis saat ini.
                            </p>

                        </div>

                    </aside>

                </div>

            </form>



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
{{-- FORMAT RUPIAH --}}
{{-- ========================================================= --}}

<script>

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            const priceInput =
                document.getElementById(
                    'estimasi_harga'
                );


            if (!priceInput) {
                return;
            }


            function formatRupiah(value) {

                const number =
                    value.replace(
                        /[^0-9]/g,
                        ''
                    );


                if (!number) {
                    return '';
                }


                return 'Rp ' +
                    new Intl.NumberFormat(
                        'id-ID'
                    ).format(number);

            }


            priceInput.addEventListener(
                'input',
                function () {

                    const cursorPosition =
                        this.selectionStart;


                    const previousLength =
                        this.value.length;


                    this.value =
                        formatRupiah(
                            this.value
                        );


                    const newLength =
                        this.value.length;


                    const difference =
                        newLength -
                        previousLength;


                    try {

                        this.setSelectionRange(
                            cursorPosition +
                                difference,

                            cursorPosition +
                                difference
                        );

                    } catch (error) {
                        //
                    }

                }
            );


            /*
            |--------------------------------------------------------------------------
            | FORMAT OLD VALUE JIKA ADA
            |--------------------------------------------------------------------------
            */

            if (priceInput.value) {

                priceInput.value =
                    formatRupiah(
                        priceInput.value
                    );

            }

        }
    );

</script>


</body>

</html>