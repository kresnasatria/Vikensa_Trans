<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <meta name="description"
          content="Masuk ke akun VikensaTrans untuk melakukan pemesanan perjalanan.">

    <title>Masuk - VikensaTrans</title>

    {{-- FAVICON --}}
    <link
        rel="icon"
        type="image/png"
        href="{{ asset('images/vikensa_trans_logo.png') }}"
    >

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

        .login-grid {
            background-image:
                linear-gradient(
                    rgba(255, 255, 255, .035) 1px,
                    transparent 1px
                ),
                linear-gradient(
                    90deg,
                    rgba(255, 255, 255, .035) 1px,
                    transparent 1px
                );

            background-size: 45px 45px;
        }

        .glass {
            background: rgba(255, 255, 255, .06);
            border: 1px solid rgba(255, 255, 255, .10);

            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
        }

        ::selection {
            background: #0ea5e9;
            color: white;
        }
    </style>

</head>


<body
    class="min-h-screen bg-white text-slate-900 antialiased"
>


<div
    class="grid min-h-screen lg:grid-cols-[1.05fr_.95fr]"
>


    {{-- ========================================================= --}}
    {{-- LEFT SIDE --}}
    {{-- ========================================================= --}}

    <section
        class="
            login-grid
            relative
            hidden
            overflow-hidden
            bg-slate-950
            text-white
            lg:flex
            lg:flex-col
        "
    >


        {{-- BACKGROUND GLOW --}}

        <div
            class="
                pointer-events-none
                absolute
                -left-36
                top-24
                h-96
                w-96
                rounded-full
                bg-sky-500/20
                blur-[130px]
            "
        ></div>


        <div
            class="
                pointer-events-none
                absolute
                -bottom-40
                -right-28
                h-[500px]
                w-[500px]
                rounded-full
                bg-blue-500/20
                blur-[150px]
            "
        ></div>



        {{-- ===================================================== --}}
        {{-- BRAND --}}
        {{-- ===================================================== --}}

        <div
            class="
                relative
                z-10
                flex
                h-24
                items-center
                px-10
                xl:px-16
            "
        >

            <a
                href="{{ url('/') }}"
                class="inline-flex items-center"
                aria-label="VikensaTrans"
            >

                
                @if(file_exists(public_path('images/vikensa_trans_logo.png')))

                    <img
                        src="{{ asset('images/vikensa_trans_logo.png') }}"
                        alt="VikensaTrans"
                        class="h-16 w-auto max-w-[420px] object-contain sm:h-20 md:h-24"
                    >

                @elseif(file_exists(public_path('images/logo.png')))

                    <img
                        src="{{ asset('images/logo.png') }}"
                        alt="VikensaTrans"
                        class="h-16 w-auto max-w-[420px] object-contain sm:h-20 md:h-24"
                    >

                @else

                    {{-- FALLBACK JIKA LOGO BELUM ADA --}}
                    <div class="flex items-center gap-3">

                        <div
                            class="
                                flex
                                h-11
                                w-11
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
                                stroke-width="2"
                                class="h-6 w-6"
                            >
                                <path
                                    d="M3 13l2-5a3 3 0 0 1 2.8-2h8.4A3 3 0 0 1 19 8l2 5"
                                />

                                <path
                                    d="M5 13h14a2 2 0 0 1 2 2v3H3v-3a2 2 0 0 1 2-2Z"
                                />

                                <circle
                                    cx="7"
                                    cy="18"
                                    r="1.5"
                                />

                                <circle
                                    cx="17"
                                    cy="18"
                                    r="1.5"
                                />
                            </svg>

                        </div>


                        <div>

                            <span
                                class="
                                    block
                                    text-2xl
                                    font-black
                                    tracking-tight
                                    text-white
                                "
                            >
                                Vikensa<span class="text-sky-400">Trans</span>
                            </span>


                            <span
                                class="
                                    block
                                    text-[9px]
                                    font-semibold
                                    uppercase
                                    tracking-[.24em]
                                    text-slate-400
                                "
                            >
                                Travel & Shuttle
                            </span>

                        </div>

                    </div>

                @endif

            </a>

        </div>



        {{-- ===================================================== --}}
        {{-- LEFT CONTENT --}}
        {{-- ===================================================== --}}

        <div
            class="
                relative
                z-10
                flex
                flex-1
                items-center
                px-10
                pb-20
                xl:px-16
            "
        >

            <div
                class="w-full max-w-xl"
            >


                {{-- BADGE --}}

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
                        text-sm
                        font-semibold
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

                    Perjalanan nyaman dimulai di sini

                </div>



                {{-- HEADING --}}

                <h1
                    class="
                        mt-7
                        max-w-xl
                        text-5xl
                        font-black
                        leading-[1.08]
                        tracking-tight
                        xl:text-6xl
                    "
                >

                    Selamat datang kembali di

                    <span
                        class="text-sky-400"
                    >
                        VikensaTrans.
                    </span>

                </h1>



                <p
                    class="
                        mt-6
                        max-w-lg
                        text-base
                        leading-8
                        text-slate-400
                    "
                >
                    Masuk ke akunmu untuk memilih armada,
                    melakukan pemesanan, memantau status perjalanan,
                    dan melihat riwayat pesanan.
                </p>



                {{-- ================================================= --}}
                {{-- FEATURE LIST --}}
                {{-- ================================================= --}}

                <div
                    class="
                        mt-10
                        space-y-4
                    "
                >


                    {{-- FEATURE 1 --}}

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
                                h-11
                                w-11
                                shrink-0
                                items-center
                                justify-center
                                rounded-xl
                                bg-sky-500/10
                                text-sky-400
                                ring-1
                                ring-sky-400/15
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
                                    font-bold
                                    text-white
                                "
                            >
                                Pilih Toyota Hiace
                            </p>

                            <p
                                class="
                                    mt-0.5
                                    text-sm
                                    text-slate-500
                                "
                            >
                                Temukan unit dan jadwal yang tersedia.
                            </p>

                        </div>

                    </div>



                    {{-- FEATURE 2 --}}

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
                                h-11
                                w-11
                                shrink-0
                                items-center
                                justify-center
                                rounded-xl
                                bg-sky-500/10
                                text-sky-400
                                ring-1
                                ring-sky-400/15
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
                                    d="M12 2v20"
                                />

                                <path
                                    d="M17 5H9.5a3.5 3.5 0 0 0 0 7H14a3.5 3.5 0 0 1 0 7H6"
                                />
                            </svg>

                        </div>


                        <div>

                            <p
                                class="
                                    font-bold
                                    text-white
                                "
                            >
                                Pembayaran mudah
                            </p>

                            <p
                                class="
                                    mt-0.5
                                    text-sm
                                    text-slate-500
                                "
                            >
                                Selesaikan transaksi melalui sistem.
                            </p>

                        </div>

                    </div>



                    {{-- FEATURE 3 --}}

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
                                h-11
                                w-11
                                shrink-0
                                items-center
                                justify-center
                                rounded-xl
                                bg-sky-500/10
                                text-sky-400
                                ring-1
                                ring-sky-400/15
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
                                    d="M3 3v18h18"
                                />

                                <path
                                    d="m7 15 4-4 3 3 5-6"
                                />
                            </svg>

                        </div>


                        <div>

                            <p
                                class="
                                    font-bold
                                    text-white
                                "
                            >
                                Pantau pesanan
                            </p>

                            <p
                                class="
                                    mt-0.5
                                    text-sm
                                    text-slate-500
                                "
                            >
                                Riwayat perjalanan tersimpan dalam akunmu.
                            </p>

                        </div>

                    </div>

                </div>



                {{-- ================================================= --}}
                {{-- TRAVEL CARD --}}
                {{-- ================================================= --}}

                <div
                    class="
                        glass
                        mt-12
                        max-w-lg
                        rounded-3xl
                        p-5
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
                                    font-semibold
                                    uppercase
                                    tracking-[.16em]
                                    text-slate-500
                                "
                            >
                                Armada
                            </p>

                            <p
                                class="
                                    mt-1
                                    text-lg
                                    font-black
                                    text-white
                                "
                            >
                                Toyota Hiace
                            </p>

                        </div>


                        <div
                            class="
                                inline-flex
                                items-center
                                gap-2
                                rounded-full
                                bg-emerald-400/10
                                px-3
                                py-2
                                text-xs
                                font-bold
                                text-emerald-300
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

                            Ready

                        </div>

                    </div>



                    <div
                        class="
                            mt-5
                            flex
                            items-center
                            gap-4
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
                                bg-white/5
                                text-sky-400
                            "
                        >

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
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


                        <div>

                            <p
                                class="
                                    text-sm
                                    font-bold
                                    text-white
                                "
                            >
                                Booking lebih praktis
                            </p>

                            <p
                                class="
                                    mt-0.5
                                    text-xs
                                    text-slate-500
                                "
                            >
                                Masuk untuk melihat jadwal perjalanan.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        {{-- LEFT FOOTER --}}

        <div
            class="
                relative
                z-10
                flex
                items-center
                justify-between
                px-10
                pb-8
                text-xs
                text-slate-600
                xl:px-16
            "
        >

            <span>
                © {{ date('Y') }} VikensaTrans
            </span>

            <span>
                Travel & Shuttle
            </span>

        </div>

    </section>



    {{-- ========================================================= --}}
    {{-- RIGHT SIDE / FORM --}}
    {{-- ========================================================= --}}

    <section
        class="
            relative
            flex
            min-h-screen
            items-center
            justify-center
            bg-white
            px-5
            py-10
            sm:px-8
            lg:px-12
        "
    >


        {{-- MOBILE BACKGROUND DECORATION --}}

        <div
            class="
                pointer-events-none
                absolute
                right-0
                top-0
                h-72
                w-72
                rounded-full
                bg-sky-100/60
                blur-[100px]
                lg:hidden
            "
        ></div>



        <div
            class="
                relative
                z-10
                w-full
                max-w-[460px]
            "
        >


            {{-- ===================================================== --}}
            {{-- MOBILE BRAND --}}
            {{-- ===================================================== --}}

            <div
                class="
                    mb-10
                    flex
                    items-center
                    justify-between
                    lg:hidden
                "
            >

                <a
                    href="{{ url('/') }}"
                    class="inline-flex items-center"
                >

                    @if(file_exists(public_path('images/logo.png')))

                        <img
                            src="{{ asset('images/logo.png') }}"
                            alt="VikensaTrans"
                            class="h-11 w-auto max-w-[190px] object-contain"
                        >

                    @else

                        <div
                            class="flex items-center gap-3"
                        >

                            <div
                                class="
                                    flex
                                    h-10
                                    w-10
                                    items-center
                                    justify-center
                                    rounded-xl
                                    bg-sky-500
                                    text-white
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
                                        d="M3 13l2-5a3 3 0 0 1 2.8-2h8.4A3 3 0 0 1 19 8l2 5"
                                    />

                                    <path
                                        d="M5 13h14a2 2 0 0 1 2 2v3H3v-3a2 2 0 0 1 2-2Z"
                                    />
                                </svg>

                            </div>


                            <span
                                class="
                                    text-xl
                                    font-black
                                    tracking-tight
                                    text-slate-950
                                "
                            >
                                Vikensa<span class="text-sky-500">Trans</span>
                            </span>

                        </div>

                    @endif

                </a>


                <a
                    href="{{ url('/') }}"
                    class="
                        text-sm
                        font-semibold
                        text-slate-500
                        transition
                        hover:text-sky-600
                    "
                >
                    ← Beranda
                </a>

            </div>



            {{-- ===================================================== --}}
            {{-- BACK TO HOME DESKTOP --}}
            {{-- ===================================================== --}}

            <a
                href="{{ url('/') }}"
                class="
                    mb-10
                    hidden
                    w-fit
                    items-center
                    gap-2
                    text-sm
                    font-semibold
                    text-slate-500
                    transition
                    hover:text-sky-600
                    lg:inline-flex
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

                Kembali ke beranda

            </a>



            {{-- ===================================================== --}}
            {{-- FORM HEADING --}}
            {{-- ===================================================== --}}

            <div>

                <p
                    class="
                        text-sm
                        font-black
                        uppercase
                        tracking-[.18em]
                        text-sky-600
                    "
                >
                    Selamat datang kembali
                </p>


                <h1
                    class="
                        mt-3
                        text-4xl
                        font-black
                        tracking-tight
                        text-slate-950
                        sm:text-5xl
                    "
                >
                    Masuk ke akunmu.
                </h1>


                <p
                    class="
                        mt-4
                        text-sm
                        leading-7
                        text-slate-500
                        sm:text-base
                    "
                >
                    Masukkan email dan password yang telah terdaftar
                    untuk melanjutkan perjalananmu bersama VikensaTrans.
                </p>

            </div>



            {{-- ===================================================== --}}
            {{-- SESSION STATUS --}}
            {{-- ===================================================== --}}

            @if (session('status'))

                <div
                    class="
                        mt-7
                        flex
                        items-start
                        gap-3
                        rounded-2xl
                        border
                        border-emerald-200
                        bg-emerald-50
                        p-4
                        text-sm
                        font-medium
                        text-emerald-700
                    "
                >

                    <div
                        class="
                            mt-0.5
                            flex
                            h-6
                            w-6
                            shrink-0
                            items-center
                            justify-center
                            rounded-full
                            bg-emerald-100
                        "
                    >
                        ✓
                    </div>

                    <p>
                        {{ session('status') }}
                    </p>

                </div>

            @endif



            {{-- ===================================================== --}}
            {{-- FORM --}}
            {{-- ===================================================== --}}

            <form
                method="POST"
                action="{{ route('login') }}"
                class="mt-8"
            >

                @csrf



                {{-- ================================================= --}}
                {{-- EMAIL --}}
                {{-- ================================================= --}}

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
                        Email
                    </label>


                    <div
                        class="
                            relative
                            mt-2
                        "
                    >

                        {{-- EMAIL ICON --}}
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

                                <path
                                    d="m3 7 9 6 9-6"
                                />
                            </svg>

                        </div>


                        <input
                            id="email"
                            name="email"
                            type="email"

                            value="{{ old('email') }}"

                            required
                            autofocus
                            autocomplete="username"

                            placeholder="nama@email.com"

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



                    @error('email')

                        <div
                            class="
                                mt-2
                                flex
                                items-center
                                gap-2
                                text-sm
                                font-medium
                                text-red-500
                            "
                        >

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                class="h-4 w-4"
                            >
                                <circle
                                    cx="12"
                                    cy="12"
                                    r="9"
                                />

                                <path
                                    d="M12 8v4"
                                />

                                <path
                                    d="M12 16h.01"
                                />
                            </svg>

                            {{ $message }}

                        </div>

                    @enderror

                </div>



                {{-- ================================================= --}}
                {{-- PASSWORD --}}
                {{-- ================================================= --}}

                <div
                    class="mt-5"
                    x-data="{ showPassword: false }"
                >

                    <label
                        for="password"
                        class="
                            block
                            text-sm
                            font-bold
                            text-slate-700
                        "
                    >
                        Password
                    </label>


                    <div
                        class="
                            relative
                            mt-2
                        "
                    >

                        {{-- LOCK ICON --}}
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

                        </div>



                        <input
                            id="password"
                            name="password"

                            :type="showPassword
                                ? 'text'
                                : 'password'"

                            required
                            autocomplete="current-password"

                            placeholder="Masukkan password"

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
                                pr-14
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



                        {{-- SHOW / HIDE PASSWORD --}}
                        <button
                            type="button"

                            @click="
                                showPassword = !showPassword
                            "

                            class="
                                absolute
                                inset-y-0
                                right-0
                                flex
                                w-14
                                items-center
                                justify-center
                                text-slate-400
                                transition
                                hover:text-sky-600
                            "

                            aria-label="Tampilkan password"
                        >


                            {{-- EYE OPEN --}}
                            <svg
                                x-show="!showPassword"

                                viewBox="0 0 24 24"

                                fill="none"

                                stroke="currentColor"

                                stroke-width="1.8"

                                class="h-5 w-5"
                            >
                                <path
                                    d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z"
                                />

                                <circle
                                    cx="12"
                                    cy="12"
                                    r="3"
                                />
                            </svg>



                            {{-- EYE CLOSED --}}
                            <svg
                                x-show="showPassword"
                                x-cloak

                                viewBox="0 0 24 24"

                                fill="none"

                                stroke="currentColor"

                                stroke-width="1.8"

                                class="h-5 w-5"
                            >
                                <path
                                    d="m3 3 18 18"
                                />

                                <path
                                    d="M10.6 10.6a2 2 0 0 0 2.8 2.8"
                                />

                                <path
                                    d="M9.8 5.2A10.7 10.7 0 0 1 12 5c6.5 0 10 7 10 7a18 18 0 0 1-2.2 3.1"
                                />

                                <path
                                    d="M6.6 6.6C3.7 8.5 2 12 2 12s3.5 7 10 7a10 10 0 0 0 4.1-.8"
                                />
                            </svg>

                        </button>

                    </div>



                    @error('password')

                        <div
                            class="
                                mt-2
                                flex
                                items-center
                                gap-2
                                text-sm
                                font-medium
                                text-red-500
                            "
                        >

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                class="h-4 w-4"
                            >
                                <circle
                                    cx="12"
                                    cy="12"
                                    r="9"
                                />

                                <path
                                    d="M12 8v4"
                                />

                                <path
                                    d="M12 16h.01"
                                />
                            </svg>

                            {{ $message }}

                        </div>

                    @enderror

                </div>



                {{-- ================================================= --}}
                {{-- REMEMBER + FORGOT PASSWORD --}}
                {{-- ================================================= --}}

                <div
                    class="
                        mt-5
                        flex
                        items-center
                        justify-between
                        gap-4
                    "
                >

                    <label
                        for="remember_me"
                        class="
                            flex
                            cursor-pointer
                            items-center
                            gap-3
                        "
                    >

                        <input
                            id="remember_me"
                            name="remember"
                            type="checkbox"

                            class="
                                h-4
                                w-4
                                rounded
                                border-slate-300
                                text-sky-500
                                focus:ring-sky-500
                            "
                        >

                        <span
                            class="
                                text-sm
                                font-medium
                                text-slate-600
                            "
                        >
                            Ingat saya
                        </span>

                    </label>



                    @if (Route::has('password.request'))

                        <a
                            href="{{ route('password.request') }}"

                            class="
                                text-sm
                                font-bold
                                text-sky-600
                                transition
                                hover:text-sky-500
                            "
                        >
                            Lupa password?
                        </a>

                    @endif

                </div>



                {{-- ================================================= --}}
                {{-- LOGIN BUTTON --}}
                {{-- ================================================= --}}

                <button
                    type="submit"

                    class="
                        group
                        mt-8
                        flex
                        h-14
                        w-full
                        items-center
                        justify-center
                        gap-3
                        rounded-2xl
                        bg-slate-950
                        px-6
                        text-sm
                        font-black
                        text-white
                        shadow-xl
                        shadow-slate-950/10
                        transition
                        duration-300

                        hover:-translate-y-0.5
                        hover:bg-sky-600
                        hover:shadow-sky-500/20

                        focus:outline-none
                        focus:ring-4
                        focus:ring-sky-500/20
                    "
                >

                    Masuk ke VikensaTrans


                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        class="
                            h-5
                            w-5
                            transition
                            duration-300
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

                {{-- ================================================= --}}
                {{-- LOGIN WITH GOOGLE --}}
                {{-- ================================================= --}}

                <div class="mt-8 flex items-center justify-between">
                    <span class="w-1/5 border-b border-slate-200 lg:w-1/4"></span>
                    <span class="text-[11px] font-bold uppercase tracking-widest text-slate-400 text-center">
                        Atau masuk dengan
                    </span>
                    <span class="w-1/5 border-b border-slate-200 lg:w-1/4"></span>
                </div>

                <div class="mt-6">
                    <a
                        href="{{ route('auth.google') }}"
                        class="
                            group
                            flex
                            h-14
                            w-full
                            items-center
                            justify-center
                            gap-3
                            rounded-2xl
                            border
                            border-slate-200
                            bg-white
                            px-6
                            text-sm
                            font-black
                            text-slate-700
                            shadow-sm
                            transition
                            duration-300
                            hover:-translate-y-0.5
                            hover:bg-slate-50
                            hover:shadow-md
                            focus:outline-none
                            focus:ring-4
                            focus:ring-slate-100
                        "
                    >
                        <svg class="h-5 w-5 transition duration-300 group-hover:scale-110" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/>
                            <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.11-6.72-4.95H1.14v3.15C3.15 21.36 7.23 24 12 24z"/>
                            <path fill="#FBBC05" d="M5.28 14.25c-.25-.72-.38-1.49-.38-2.25s.13-1.53.38-2.25V6.6H1.14C.41 8.09 0 9.77 0 12s.41 3.91 1.14 5.4l4.14-3.15z"/>
                            <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.23 0 3.15 2.64 1.14 6.6l4.14 3.15c.95-2.84 3.6-4.95 6.72-4.95z"/>
                        </svg>
                        Google
                    </a>
                </div>



                {{-- ================================================= --}}
                {{-- REGISTER --}}
                {{-- ================================================= --}}

                @if (Route::has('register'))

                    <div
                        class="
                            mt-7
                            text-center
                        "
                    >

                        <p
                            class="
                                text-sm
                                text-slate-500
                            "
                        >
                            Belum memiliki akun?

                            <a
                                href="{{ route('register') }}"

                                class="
                                    ml-1
                                    font-black
                                    text-sky-600
                                    transition
                                    hover:text-sky-500
                                "
                            >
                                Daftar sekarang
                            </a>

                        </p>

                    </div>

                @endif

            </form>



            {{-- ===================================================== --}}
            {{-- SECURITY INFO --}}
            {{-- ===================================================== --}}

            <div
                class="
                    mt-10
                    flex
                    items-center
                    justify-center
                    gap-2
                    text-xs
                    text-slate-400
                "
            >

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    class="h-4 w-4"
                >
                    <path
                        d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"
                    />

                    <path
                        d="m9 12 2 2 4-4"
                    />
                </svg>

                Data akunmu dilindungi oleh sistem VikensaTrans.

            </div>

        </div>

    </section>

</div>


</body>

</html>