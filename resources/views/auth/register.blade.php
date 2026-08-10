<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <meta name="description"
          content="Daftar akun VikensaTrans untuk memesan perjalanan dengan mudah.">

    <title>Daftar - VikensaTrans</title>


    {{-- FAVICON --}}
    @if(file_exists(public_path('images/favicon.png')))
        <link
            rel="icon"
            type="image/png"
            href="{{ asset('images/favicon.png') }}"
        >
    @endif


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


        .register-grid {
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
            register-grid
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

                @if(file_exists(public_path('images/logo.png')))

                    <img
                        src="{{ asset('images/logo.png') }}"
                        alt="VikensaTrans"
                        class="
                            h-12
                            w-auto
                            max-w-[220px]
                            object-contain
                        "
                    >

                @else

                    {{-- FALLBACK LOGO --}}
                    <div
                        class="flex items-center gap-3"
                    >

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
                pb-16
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

                    Bergabung dengan VikensaTrans

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

                    Perjalanan lebih mudah

                    <span
                        class="text-sky-400"
                    >
                        dimulai dari akunmu.
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
                    Buat akun VikensaTrans dan nikmati proses
                    pemesanan Toyota Hiace yang lebih praktis,
                    mulai dari memilih jadwal hingga melihat
                    status perjalanan.
                </p>



                {{-- ================================================= --}}
                {{-- BENEFITS --}}
                {{-- ================================================= --}}

                <div
                    class="mt-10 space-y-4"
                >


                    {{-- BENEFIT 1 --}}

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


                        <div>

                            <p
                                class="
                                    font-bold
                                    text-white
                                "
                            >
                                Akun pribadi
                            </p>


                            <p
                                class="
                                    mt-0.5
                                    text-sm
                                    text-slate-500
                                "
                            >
                                Simpan informasi dan riwayat perjalananmu.
                            </p>

                        </div>

                    </div>



                    {{-- BENEFIT 2 --}}

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
                                Booking Toyota Hiace
                            </p>


                            <p
                                class="
                                    mt-0.5
                                    text-sm
                                    text-slate-500
                                "
                            >
                                Pilih unit dan jadwal yang tersedia.
                            </p>

                        </div>

                    </div>



                    {{-- BENEFIT 3 --}}

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
                                <rect
                                    x="3"
                                    y="5"
                                    width="18"
                                    height="14"
                                    rx="2"
                                />

                                <path
                                    d="M3 10h18"
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
                                Pembayaran praktis
                            </p>


                            <p
                                class="
                                    mt-0.5
                                    text-sm
                                    text-slate-500
                                "
                            >
                                Transaksi lebih mudah melalui sistem.
                            </p>

                        </div>

                    </div>

                </div>



                {{-- ================================================= --}}
                {{-- INFO CARD --}}
                {{-- ================================================= --}}

                <div
                    class="
                        glass
                        mt-12
                        rounded-3xl
                        p-6
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
                                h-12
                                w-12
                                shrink-0
                                items-center
                                justify-center
                                rounded-2xl
                                bg-sky-500/10
                                text-sky-400
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
                                    font-black
                                    text-white
                                "
                            >
                                Akunmu, perjalananmu.
                            </p>


                            <p
                                class="
                                    mt-2
                                    text-sm
                                    leading-6
                                    text-slate-400
                                "
                            >
                                Data akun digunakan untuk mempermudah
                                proses pemesanan dan pengelolaan perjalanan
                                bersama VikensaTrans.
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
    {{-- RIGHT SIDE / REGISTER FORM --}}
    {{-- ========================================================= --}}

    <section
        class="
            relative
            flex
            min-h-screen
            items-center
            justify-center
            overflow-hidden
            bg-white
            px-5
            py-10
            sm:px-8
            lg:px-12
        "
    >


        {{-- DECORATION MOBILE --}}

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
            {{-- MOBILE HEADER --}}
            {{-- ===================================================== --}}

            <div
                class="
                    mb-8
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
                            class="
                                h-11
                                w-auto
                                max-w-[190px]
                                object-contain
                            "
                        >

                    @else

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
                    mb-7
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
            {{-- HEADING --}}
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
                    Buat akun baru
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
                    Daftar VikensaTrans.
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
                    Isi data berikut untuk membuat akun dan
                    mulai memesan perjalanan bersama VikensaTrans.
                </p>

            </div>



            {{-- ===================================================== --}}
            {{-- REGISTER FORM --}}
            {{-- ===================================================== --}}

            <form
                method="POST"
                action="{{ route('register') }}"
                class="mt-7"
            >

                @csrf



                {{-- ================================================= --}}
                {{-- NAME --}}
                {{-- ================================================= --}}

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
                            id="name"
                            name="name"
                            type="text"

                            value="{{ old('name') }}"

                            required
                            autofocus
                            autocomplete="name"

                            placeholder="Masukkan nama lengkap"

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


                    @error('name')

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
                {{-- EMAIL --}}
                {{-- ================================================= --}}

                <div
                    class="mt-5"
                >

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

                        {{-- LOCK --}}
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

                            :type="
                                showPassword
                                    ? 'text'
                                    : 'password'
                            "

                            required
                            autocomplete="new-password"

                            placeholder="Buat password"

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



                        {{-- PASSWORD EYE --}}
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
                        >

                            {{-- OPEN --}}
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


                            {{-- CLOSED --}}
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


                    <p
                        class="
                            mt-2
                            text-xs
                            text-slate-400
                        "
                    >
                        Gunakan password yang mudah kamu ingat dan sulit ditebak.
                    </p>


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
                {{-- CONFIRM PASSWORD --}}
                {{-- ================================================= --}}

                <div
                    class="mt-5"
                    x-data="{ showConfirmation: false }"
                >

                    <label
                        for="password_confirmation"
                        class="
                            block
                            text-sm
                            font-bold
                            text-slate-700
                        "
                    >
                        Konfirmasi Password
                    </label>


                    <div
                        class="
                            relative
                            mt-2
                        "
                    >

                        {{-- LOCK --}}
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
                            id="password_confirmation"

                            name="password_confirmation"

                            :type="
                                showConfirmation
                                    ? 'text'
                                    : 'password'
                            "

                            required

                            autocomplete="new-password"

                            placeholder="Ulangi password"

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



                        {{-- EYE --}}
                        <button
                            type="button"

                            @click="
                                showConfirmation = !showConfirmation
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
                        >

                            <svg
                                x-show="!showConfirmation"

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


                            <svg
                                x-show="showConfirmation"
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


                    @error('password_confirmation')

                        <p
                            class="
                                mt-2
                                text-sm
                                font-medium
                                text-red-500
                            "
                        >
                            {{ $message }}
                        </p>

                    @enderror

                </div>



                {{-- ================================================= --}}
                {{-- REGISTER BUTTON --}}
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

                    Buat Akun VikensaTrans


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
                {{-- LOGIN LINK --}}
                {{-- ================================================= --}}

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
                        Sudah memiliki akun?

                        <a
                            href="{{ route('login') }}"

                            class="
                                ml-1
                                font-black
                                text-sky-600
                                transition
                                hover:text-sky-500
                            "
                        >
                            Masuk sekarang
                        </a>

                    </p>

                </div>

            </form>



            {{-- ===================================================== --}}
            {{-- SECURITY --}}
            {{-- ===================================================== --}}

            <div
                class="
                    mt-8
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

                Data akunmu disimpan dengan aman oleh VikensaTrans.

            </div>

        </div>

    </section>


</div>


</body>

</html>