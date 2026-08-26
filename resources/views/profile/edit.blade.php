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

    <title>Profil Saya - VikensaTrans</title>

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

    $isAdmin =
        ($user->role ?? 'user') === 'admin';


    $initialTab = 'profile';


    if ($errors->userDeletion->isNotEmpty()) {

        $initialTab = 'danger';

    } elseif (
        $errors->updatePassword->isNotEmpty()
        || session('status') === 'password-updated'
    ) {

        $initialTab = 'security';

    }


    $deleteModalOpen =
        $errors->userDeletion->isNotEmpty()
            ? 'true'
            : 'false';

@endphp


<body
    class="bg-slate-100 text-slate-900 antialiased"

    x-data="{
        sidebarOpen: false,
        profileOpen: false,

        activeTab: '{{ $initialTab }}',

        deleteModal: {{ $deleteModalOpen }},

        showCurrentPassword: false,
        showNewPassword: false,
        showConfirmPassword: false
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

        <a href="{{ url('/') }}">

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
                flex
                h-9
                w-9
                items-center
                justify-center

                rounded-lg

                text-slate-400

                hover:bg-white/5
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
                <path d="M6 6l12 12M18 6 6 18"/>
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
                font-bold
                uppercase
                tracking-[.2em]

                text-slate-500
            "
        >
            Menu Utama
        </p>



        {{-- DASHBOARD USER --}}

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

            Dashboard

        </a>



        {{-- RIWAYAT --}}

        <a
            href="{{ route('riwayat') }}"

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

            Riwayat Pesanan

        </a>



        {{-- PROFILE ACTIVE --}}

        <a
            href="{{ route('profile.edit') }}"

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

                <circle
                    cx="12"
                    cy="8"
                    r="4"
                />

                <path
                    d="M4 21c0-5 3-8 8-8s8 3 8 8"
                />

            </svg>

            Profil Saya

        </a>



        {{-- ADMIN PANEL --}}

        @if($isAdmin)

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
                Administrator
            </p>


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

                    <path
                        d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"
                    />

                    <path
                        d="m9 12 2 2 4-4"
                    />

                </svg>

                Admin Panel

            </a>

        @endif



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
            href="{{ url('/') }}"

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

                <path d="m3 11 9-8 9 8"/>

                <path
                    d="M5 10v10h14V10"
                />

            </svg>

            Kembali ke Beranda

        </a>

    </nav>



    {{-- ===================================================== --}}
    {{-- USER ACCOUNT --}}
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
                        text-white
                    "
                >
                    {{ mb_substr($user->name, 0, 1) }}
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
                        {{ $user->name }}
                    </p>


                    <p
                        class="
                            mt-0.5

                            truncate

                            text-xs
                            text-slate-500
                        "
                    >
                        {{ $user->email }}
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
                x-transition

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
                    Pengaturan Akun
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
                        Akun VikensaTrans
                    </p>


                    <h2
                        class="
                            text-lg
                            font-black
                            text-slate-900
                        "
                    >
                        Profil Saya
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

                    <path
                        d="m11 18-6-6 6-6"
                    />

                </svg>

                <span class="hidden sm:inline">
                    Dashboard
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
            {{-- HERO PROFILE --}}
            {{-- ================================================= --}}

            <section
                class="
                    overflow-hidden

                    rounded-2xl

                    border
                    border-slate-200

                    bg-white
                "
            >

                <div
                    class="
                        h-28

                        bg-gradient-to-r
                        from-slate-950
                        via-blue-950
                        to-slate-900
                    "
                ></div>


                <div
                    class="
                        px-6
                        pb-6

                        sm:px-8
                    "
                >

                    <div
                        class="
                            flex
                            flex-col
                            gap-4

                            sm:flex-row
                            sm:items-end
                            sm:justify-between
                        "
                    >

                        <div
                            class="
                                flex
                                flex-col
                                gap-4

                                sm:flex-row
                                sm:items-end
                            "
                        >

                            {{-- AVATAR --}}
                            <div
                                class="
                                    -mt-12

                                    flex
                                    h-24
                                    w-24
                                    shrink-0
                                    items-center
                                    justify-center

                                    rounded-2xl

                                    border-4
                                    border-white

                                    bg-sky-500

                                    text-3xl
                                    font-black
                                    uppercase
                                    text-white

                                    shadow-lg
                                "
                            >
                                {{ mb_substr($user->name, 0, 1) }}
                            </div>


                            <div class="sm:pb-1">

                                <h1
                                    class="
                                        text-2xl
                                        font-black
                                        text-slate-950
                                    "
                                >
                                    {{ $user->name }}
                                </h1>


                                <p
                                    class="
                                        mt-1

                                        text-sm
                                        text-slate-500
                                    "
                                >
                                    {{ $user->email }}
                                </p>


                                <div
                                    class="
                                        mt-3

                                        flex
                                        flex-wrap
                                        gap-2
                                    "
                                >

                                    <span
                                        class="
                                            inline-flex
                                            items-center

                                            rounded-full

                                            bg-slate-100

                                            px-3
                                            py-1.5

                                            text-[10px]
                                            font-black
                                            uppercase
                                            tracking-wider
                                            text-slate-600
                                        "
                                    >
                                        {{ $isAdmin ? 'Administrator' : 'Pengguna' }}
                                    </span>


                                    @if(
                                        !(
                                            $user instanceof
                                            \Illuminate\Contracts\Auth\MustVerifyEmail
                                        )
                                        ||
                                        $user->hasVerifiedEmail()
                                    )

                                        <span
                                            class="
                                                inline-flex
                                                items-center
                                                gap-1.5

                                                rounded-full

                                                bg-emerald-50

                                                px-3
                                                py-1.5

                                                text-[10px]
                                                font-black
                                                uppercase
                                                tracking-wider
                                                text-emerald-600
                                            "
                                        >

                                            <span
                                                class="
                                                    h-1.5
                                                    w-1.5

                                                    rounded-full

                                                    bg-emerald-500
                                                "
                                            ></span>

                                            Email Terverifikasi

                                        </span>


                                    @else

                                        <span
                                            class="
                                                inline-flex
                                                items-center
                                                gap-1.5

                                                rounded-full

                                                bg-amber-50

                                                px-3
                                                py-1.5

                                                text-[10px]
                                                font-black
                                                uppercase
                                                tracking-wider
                                                text-amber-600
                                            "
                                        >

                                            <span
                                                class="
                                                    h-1.5
                                                    w-1.5

                                                    rounded-full

                                                    bg-amber-500
                                                "
                                            ></span>

                                            Belum Terverifikasi

                                        </span>

                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </section>



            {{-- ================================================= --}}
            {{-- SUCCESS STATUS --}}
            {{-- ================================================= --}}

            @if(session('status') === 'profile-updated')

                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition

                    x-init="
                        setTimeout(
                            () => show = false,
                            3500
                        )
                    "

                    class="
                        mt-5

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
                            Informasi profil berhasil diperbarui.
                        </p>

                    </div>


                    <button
                        type="button"

                        @click="show = false"

                        class="text-emerald-600"
                    >
                        ×
                    </button>

                </div>

            @endif



            @if(session('status') === 'password-updated')

                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition

                    x-init="
                        setTimeout(
                            () => show = false,
                            3500
                        )
                    "

                    class="
                        mt-5

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
                            Password berhasil diperbarui.
                        </p>

                    </div>


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
            {{-- PROFILE LAYOUT --}}
            {{-- ================================================= --}}

            <div
                class="
                    mt-6

                    grid
                    gap-6

                    lg:grid-cols-[240px_minmax(0,1fr)]
                "
            >


                {{-- ================================================= --}}
                {{-- SETTINGS MENU --}}
                {{-- ================================================= --}}

                <aside
                    class="
                        h-fit

                        rounded-2xl

                        border
                        border-slate-200

                        bg-white

                        p-3
                    "
                >

                    <button
                        type="button"

                        @click="
                            activeTab = 'profile'
                        "

                        :class="
                            activeTab === 'profile'
                                ? 'bg-sky-50 text-sky-700'
                                : 'text-slate-600 hover:bg-slate-50'
                        "

                        class="
                            flex
                            w-full
                            items-center
                            gap-3

                            rounded-xl

                            px-4
                            py-3.5

                            text-left
                            text-sm
                            font-bold

                            transition
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

                        Informasi Akun

                    </button>



                    <button
                        type="button"

                        @click="
                            activeTab = 'security'
                        "

                        :class="
                            activeTab === 'security'
                                ? 'bg-sky-50 text-sky-700'
                                : 'text-slate-600 hover:bg-slate-50'
                        "

                        class="
                            mt-1

                            flex
                            w-full
                            items-center
                            gap-3

                            rounded-xl

                            px-4
                            py-3.5

                            text-left
                            text-sm
                            font-bold

                            transition
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

                        Keamanan

                    </button>



                    <button
                        type="button"

                        @click="
                            activeTab = 'danger'
                        "

                        :class="
                            activeTab === 'danger'
                                ? 'bg-red-50 text-red-600'
                                : 'text-slate-600 hover:bg-slate-50'
                        "

                        class="
                            mt-1

                            flex
                            w-full
                            items-center
                            gap-3

                            rounded-xl

                            px-4
                            py-3.5

                            text-left
                            text-sm
                            font-bold

                            transition
                        "
                    >

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"

                            class="h-5 w-5"
                        >

                            <path d="M3 6h18"/>
                            <path d="M8 6V4h8v2"/>
                            <path d="m19 6-1 14H6L5 6"/>
                            <path d="M10 11v5M14 11v5"/>

                        </svg>

                        Hapus Akun

                    </button>

                </aside>



                {{-- ================================================= --}}
                {{-- SETTINGS CONTENT --}}
                {{-- ================================================= --}}

                <div>


                    {{-- ================================================= --}}
                    {{-- PROFILE INFORMATION --}}
                    {{-- ================================================= --}}

                    <section
                        x-show="
                            activeTab === 'profile'
                        "

                        x-cloak

                        class="
                            overflow-hidden

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

                                sm:px-7
                            "
                        >

                            <h2
                                class="
                                    text-lg
                                    font-black
                                    text-slate-900
                                "
                            >
                                Informasi Akun
                            </h2>


                            <p
                                class="
                                    mt-1

                                    text-sm
                                    leading-6
                                    text-slate-500
                                "
                            >
                                Perbarui nama dan alamat email
                                yang digunakan pada akun VikensaTrans.
                            </p>

                        </div>



                        {{-- VERIFICATION FORM --}}

                        <form
                            id="send-verification"

                            method="POST"

                            action="{{ route('verification.send') }}"
                        >
                            @csrf
                        </form>



                        {{-- UPDATE PROFILE FORM --}}

                        <form
                            method="POST"

                            action="{{ route('profile.update') }}"
                        >

                            @csrf
                            @method('PATCH')


                            <div
                                class="
                                    space-y-5

                                    p-6

                                    sm:p-7
                                "
                            >


                                {{-- NAME --}}

                                <div>

                                    <label
                                        for="name"

                                        class="
                                            block

                                            text-sm
                                            font-bold
                                            text-slate-700
                                        "
                                    >
                                        Nama Lengkap
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
                                                <circle cx="12" cy="8" r="4"/>
                                                <path d="M4 21c0-5 3-8 8-8s8 3 8 8"/>
                                            </svg>

                                        </div>


                                        <input
                                            id="name"

                                            type="text"

                                            name="name"

                                            value="{{ old(
                                                'name',
                                                $user->name
                                            ) }}"

                                            required
                                            autofocus
                                            autocomplete="name"

                                            class="
                                                h-12
                                                w-full

                                                rounded-xl

                                                border
                                                border-slate-200

                                                bg-slate-50

                                                pl-12
                                                pr-4

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

                                    </div>


                                    @error('name')

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



                                {{-- EMAIL --}}

                                <div>

                                    <label
                                        for="email"

                                        class="
                                            block

                                            text-sm
                                            font-bold
                                            text-slate-700
                                        "
                                    >
                                        Alamat Email
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
                                                <rect
                                                    x="3"
                                                    y="5"
                                                    width="18"
                                                    height="14"
                                                    rx="2"
                                                />
                                                <path d="m3 7 9 6 9-6"/>
                                            </svg>

                                        </div>


                                        <input
                                            id="email"

                                            type="email"

                                            name="email"

                                            value="{{ old(
                                                'email',
                                                $user->email
                                            ) }}"

                                            required
                                            autocomplete="username"

                                            class="
                                                h-12
                                                w-full

                                                rounded-xl

                                                border
                                                border-slate-200

                                                bg-slate-50

                                                pl-12
                                                pr-4

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

                                    </div>


                                    @error('email')

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



                                    {{-- EMAIL VERIFICATION --}}

                                    @if(
                                        $user instanceof
                                        \Illuminate\Contracts\Auth\MustVerifyEmail
                                        &&
                                        ! $user->hasVerifiedEmail()
                                    )

                                        <div
                                            class="
                                                mt-4

                                                rounded-xl

                                                border
                                                border-amber-200

                                                bg-amber-50

                                                p-4
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
                                                    <circle cx="12" cy="12" r="9"/>
                                                    <path d="M12 8v5"/>
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
                                                        Email belum diverifikasi
                                                    </p>


                                                    <p
                                                        class="
                                                            mt-1

                                                            text-xs
                                                            leading-5
                                                            text-amber-700
                                                        "
                                                    >
                                                        Verifikasi email untuk
                                                        menjaga keamanan akunmu.
                                                    </p>


                                                    <button
                                                        type="submit"

                                                        form="send-verification"

                                                        class="
                                                            mt-3

                                                            text-xs
                                                            font-black
                                                            text-amber-800

                                                            underline
                                                            underline-offset-4
                                                        "
                                                    >
                                                        Kirim ulang email verifikasi
                                                    </button>



                                                    @if(
                                                        session('status')
                                                        ===
                                                        'verification-link-sent'
                                                    )

                                                        <p
                                                            class="
                                                                mt-3

                                                                text-xs
                                                                font-semibold
                                                                text-emerald-600
                                                            "
                                                        >
                                                            Link verifikasi baru
                                                            sudah dikirim.
                                                        </p>

                                                    @endif

                                                </div>

                                            </div>

                                        </div>

                                    @endif

                                </div>



                                {{-- ROLE --}}

                                <div>

                                    <label
                                        class="
                                            block

                                            text-sm
                                            font-bold
                                            text-slate-700
                                        "
                                    >
                                        Tipe Akun
                                    </label>


                                    <div
                                        class="
                                            mt-2

                                            flex
                                            h-12
                                            items-center
                                            justify-between

                                            rounded-xl

                                            border
                                            border-slate-200

                                            bg-slate-100

                                            px-4
                                        "
                                    >

                                        <span
                                            class="
                                                text-sm
                                                font-semibold
                                                text-slate-600
                                            "
                                        >
                                            {{ $isAdmin ? 'Administrator' : 'Pengguna VikensaTrans' }}
                                        </span>


                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"

                                            class="
                                                h-4
                                                w-4
                                                text-slate-400
                                            "
                                        >
                                            <rect
                                                x="5"
                                                y="10"
                                                width="14"
                                                height="10"
                                                rx="2"
                                            />
                                            <path d="M8 10V7a4 4 0 0 1 8 0v3"/>
                                        </svg>

                                    </div>


                                    <p
                                        class="
                                            mt-2

                                            text-xs
                                            text-slate-400
                                        "
                                    >
                                        Tipe akun tidak dapat diubah melalui halaman profil.
                                    </p>

                                </div>

                            </div>



                            {{-- ACTION --}}

                            <div
                                class="
                                    flex
                                    justify-end

                                    border-t
                                    border-slate-100

                                    bg-slate-50/60

                                    px-6
                                    py-5

                                    sm:px-7
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
                                        <path d="m5 12 4 4L19 6"/>
                                    </svg>

                                    Simpan Perubahan

                                </button>

                            </div>

                        </form>

                    </section>



                    {{-- ================================================= --}}
                    {{-- PASSWORD --}}
                    {{-- ================================================= --}}

                    <section
                        x-show="
                            activeTab === 'security'
                        "

                        x-cloak

                        class="
                            overflow-hidden

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

                                sm:px-7
                            "
                        >

                            <h2
                                class="
                                    text-lg
                                    font-black
                                    text-slate-900
                                "
                            >
                                Keamanan Akun
                            </h2>


                            <p
                                class="
                                    mt-1

                                    text-sm
                                    leading-6
                                    text-slate-500
                                "
                            >
                                Gunakan password yang kuat dan
                                tidak digunakan pada akun lainnya.
                            </p>

                        </div>



                        <form
                            method="POST"

                            action="{{ route('password.update') }}"
                        >

                            @csrf
                            @method('PUT')


                            <div
                                class="
                                    space-y-5

                                    p-6

                                    sm:p-7
                                "
                            >


                                {{-- CURRENT PASSWORD --}}

                                <div>

                                    <label
                                        for="update_password_current_password"

                                        class="
                                            block

                                            text-sm
                                            font-bold
                                            text-slate-700
                                        "
                                    >
                                        Password Saat Ini
                                    </label>


                                    <div
                                        class="
                                            relative
                                            mt-2
                                        "
                                    >

                                        <input
                                            id="update_password_current_password"

                                            :type="
                                                showCurrentPassword
                                                    ? 'text'
                                                    : 'password'
                                            "

                                            name="current_password"

                                            autocomplete="current-password"

                                            placeholder="Masukkan password saat ini"

                                            class="
                                                h-12
                                                w-full

                                                rounded-xl

                                                border
                                                border-slate-200

                                                bg-slate-50

                                                px-4
                                                pr-12

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

                                            @click="
                                                showCurrentPassword =
                                                !showCurrentPassword
                                            "

                                            class="
                                                absolute
                                                inset-y-0
                                                right-0

                                                flex
                                                w-12
                                                items-center
                                                justify-center

                                                text-slate-400

                                                hover:text-slate-700
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
                                                    d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z"
                                                />
                                                <circle cx="12" cy="12" r="2.5"/>
                                            </svg>

                                        </button>

                                    </div>


                                    @error(
                                        'current_password',
                                        'updatePassword'
                                    )

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



                                {{-- NEW PASSWORD --}}

                                <div>

                                    <label
                                        for="update_password_password"

                                        class="
                                            block

                                            text-sm
                                            font-bold
                                            text-slate-700
                                        "
                                    >
                                        Password Baru
                                    </label>


                                    <div
                                        class="
                                            relative
                                            mt-2
                                        "
                                    >

                                        <input
                                            id="update_password_password"

                                            :type="
                                                showNewPassword
                                                    ? 'text'
                                                    : 'password'
                                            "

                                            name="password"

                                            autocomplete="new-password"

                                            placeholder="Masukkan password baru"

                                            class="
                                                h-12
                                                w-full

                                                rounded-xl

                                                border
                                                border-slate-200

                                                bg-slate-50

                                                px-4
                                                pr-12

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

                                            @click="
                                                showNewPassword =
                                                !showNewPassword
                                            "

                                            class="
                                                absolute
                                                inset-y-0
                                                right-0

                                                flex
                                                w-12
                                                items-center
                                                justify-center

                                                text-slate-400

                                                hover:text-slate-700
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
                                                    d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z"
                                                />
                                                <circle cx="12" cy="12" r="2.5"/>
                                            </svg>

                                        </button>

                                    </div>


                                    @error(
                                        'password',
                                        'updatePassword'
                                    )

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



                                {{-- CONFIRM PASSWORD --}}

                                <div>

                                    <label
                                        for="update_password_password_confirmation"

                                        class="
                                            block

                                            text-sm
                                            font-bold
                                            text-slate-700
                                        "
                                    >
                                        Konfirmasi Password Baru
                                    </label>


                                    <div
                                        class="
                                            relative
                                            mt-2
                                        "
                                    >

                                        <input
                                            id="update_password_password_confirmation"

                                            :type="
                                                showConfirmPassword
                                                    ? 'text'
                                                    : 'password'
                                            "

                                            name="password_confirmation"

                                            autocomplete="new-password"

                                            placeholder="Ulangi password baru"

                                            class="
                                                h-12
                                                w-full

                                                rounded-xl

                                                border
                                                border-slate-200

                                                bg-slate-50

                                                px-4
                                                pr-12

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

                                            @click="
                                                showConfirmPassword =
                                                !showConfirmPassword
                                            "

                                            class="
                                                absolute
                                                inset-y-0
                                                right-0

                                                flex
                                                w-12
                                                items-center
                                                justify-center

                                                text-slate-400

                                                hover:text-slate-700
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
                                                    d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z"
                                                />
                                                <circle cx="12" cy="12" r="2.5"/>
                                            </svg>

                                        </button>

                                    </div>


                                    @error(
                                        'password_confirmation',
                                        'updatePassword'
                                    )

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



                                {{-- INFO --}}

                                <div
                                    class="
                                        rounded-xl

                                        bg-slate-50

                                        p-4
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

                                                text-sky-500
                                            "
                                        >
                                            <path
                                                d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"
                                            />
                                            <path d="m9 12 2 2 4-4"/>
                                        </svg>


                                        <p
                                            class="
                                                text-xs
                                                leading-6
                                                text-slate-500
                                            "
                                        >
                                            Gunakan kombinasi huruf,
                                            angka, dan karakter yang
                                            sulit ditebak untuk menjaga
                                            keamanan akun.
                                        </p>

                                    </div>

                                </div>

                            </div>



                            {{-- ACTION --}}

                            <div
                                class="
                                    flex
                                    justify-end

                                    border-t
                                    border-slate-100

                                    bg-slate-50/60

                                    px-6
                                    py-5

                                    sm:px-7
                                "
                            >

                                <button
                                    type="submit"

                                    class="
                                        inline-flex
                                        items-center
                                        gap-2

                                        rounded-xl

                                        bg-slate-950

                                        px-6
                                        py-3

                                        text-sm
                                        font-bold
                                        text-white

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
                                        <path d="m5 12 4 4L19 6"/>
                                    </svg>

                                    Perbarui Password

                                </button>

                            </div>

                        </form>

                    </section>



                    {{-- ================================================= --}}
                    {{-- DELETE ACCOUNT --}}
                    {{-- ================================================= --}}

                    <section
                        x-show="
                            activeTab === 'danger'
                        "

                        x-cloak

                        class="
                            overflow-hidden

                            rounded-2xl

                            border
                            border-red-200

                            bg-white
                        "
                    >

                        <div
                            class="
                                border-b
                                border-red-100

                                bg-red-50/50

                                px-6
                                py-5

                                sm:px-7
                            "
                        >

                            <h2
                                class="
                                    text-lg
                                    font-black
                                    text-red-600
                                "
                            >
                                Hapus Akun
                            </h2>


                            <p
                                class="
                                    mt-1

                                    text-sm
                                    leading-6
                                    text-slate-500
                                "
                            >
                                Penghapusan akun bersifat permanen
                                dan tidak dapat dibatalkan.
                            </p>

                        </div>



                        <div
                            class="
                                p-6

                                sm:p-7
                            "
                        >

                            <div
                                class="
                                    flex
                                    items-start
                                    gap-4

                                    rounded-xl

                                    border
                                    border-red-100

                                    bg-red-50

                                    p-5
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

                                        text-red-500
                                    "
                                >

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"

                                        class="h-5 w-5"
                                    >
                                        <path d="M12 3 2 21h20Z"/>
                                        <path d="M12 9v4"/>
                                        <path d="M12 17h.01"/>
                                    </svg>

                                </div>


                                <div>

                                    <p
                                        class="
                                            text-sm
                                            font-black
                                            text-red-700
                                        "
                                    >
                                        Sebelum menghapus akun
                                    </p>


                                    <p
                                        class="
                                            mt-1

                                            text-xs
                                            leading-6
                                            text-red-600
                                        "
                                    >
                                        Seluruh data yang berkaitan
                                        dengan akun ini dapat ikut
                                        terhapus secara permanen.
                                        Pastikan kamu benar-benar
                                        ingin melanjutkan.
                                    </p>

                                </div>

                            </div>


                            <button
                                type="button"

                                @click="
                                    deleteModal = true
                                "

                                class="
                                    mt-6

                                    inline-flex
                                    items-center
                                    gap-2

                                    rounded-xl

                                    bg-red-500

                                    px-5
                                    py-3

                                    text-sm
                                    font-bold
                                    text-white

                                    transition

                                    hover:bg-red-600
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

                                Hapus Akun Saya

                            </button>

                        </div>

                    </section>

                </div>

            </div>



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
                    Your Journey, Our Priority.
                </p>

            </footer>

        </div>

    </main>

</div>



{{-- ========================================================= --}}
{{-- DELETE ACCOUNT MODAL --}}
{{-- ========================================================= --}}

<div
    x-show="deleteModal"
    x-cloak
    x-transition.opacity

    @keydown.escape.window="
        deleteModal = false
    "

    class="
        fixed
        inset-0
        z-[100]

        flex
        items-center
        justify-center

        p-5
    "
>


    {{-- BACKDROP --}}

    <div
        class="
            absolute
            inset-0

            bg-slate-950/70

            backdrop-blur-sm
        "

        @click="
            deleteModal = false
        "
    ></div>



    {{-- MODAL --}}

    <div
        x-show="deleteModal"

        x-transition:enter="
            transition ease-out duration-200
        "

        x-transition:enter-start="
            opacity-0 scale-95
        "

        x-transition:enter-end="
            opacity-100 scale-100
        "

        x-transition:leave="
            transition ease-in duration-150
        "

        x-transition:leave-start="
            opacity-100 scale-100
        "

        x-transition:leave-end="
            opacity-0 scale-95
        "

        @click.stop

        class="
            relative
            z-10

            w-full
            max-w-md

            overflow-hidden

            rounded-2xl

            bg-white

            shadow-2xl
        "
    >

        <form
            method="POST"

            action="{{ route('profile.destroy') }}"
        >

            @csrf
            @method('DELETE')


            <div
                class="
                    px-6
                    pt-7
                    pb-5
                "
            >

                <div
                    class="
                        flex
                        h-12
                        w-12
                        items-center
                        justify-center

                        rounded-xl

                        bg-red-50

                        text-red-500
                    "
                >

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"

                        class="h-6 w-6"
                    >
                        <path d="M12 3 2 21h20Z"/>
                        <path d="M12 9v4"/>
                        <path d="M12 17h.01"/>
                    </svg>

                </div>


                <h3
                    class="
                        mt-5

                        text-xl
                        font-black
                        text-slate-950
                    "
                >
                    Hapus akun?
                </h3>


                <p
                    class="
                        mt-2

                        text-sm
                        leading-6
                        text-slate-500
                    "
                >
                    Tindakan ini tidak dapat dibatalkan.
                    Masukkan password akun untuk
                    mengonfirmasi penghapusan.
                </p>



                {{-- PASSWORD CONFIRM DELETE --}}

                <div class="mt-5">

                    <label
                        for="delete_password"

                        class="
                            block

                            text-sm
                            font-bold
                            text-slate-700
                        "
                    >
                        Password
                    </label>


                    <input
                        id="delete_password"

                        type="password"

                        name="password"

                        placeholder="Masukkan password"

                        autocomplete="current-password"

                        class="
                            mt-2

                            h-12
                            w-full

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

                            focus:border-red-400
                            focus:bg-white
                            focus:ring-4
                            focus:ring-red-500/10
                        "
                    >


                    @error(
                        'password',
                        'userDeletion'
                    )

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



            {{-- MODAL ACTION --}}

            <div
                class="
                    flex
                    gap-3

                    border-t
                    border-slate-100

                    bg-slate-50

                    px-6
                    py-5
                "
            >

                <button
                    type="button"

                    @click="
                        deleteModal = false
                    "

                    class="
                        flex-1

                        rounded-xl

                        border
                        border-slate-200

                        bg-white

                        px-4
                        py-3

                        text-sm
                        font-bold
                        text-slate-600

                        transition

                        hover:bg-slate-100
                    "
                >
                    Batal
                </button>


                <button
                    type="submit"

                    class="
                        flex-1

                        rounded-xl

                        bg-red-500

                        px-4
                        py-3

                        text-sm
                        font-bold
                        text-white

                        transition

                        hover:bg-red-600
                    "
                >
                    Ya, Hapus Akun
                </button>

            </div>

        </form>

    </div>

</div>


</body>

</html>