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

    <title>Konfirmasi Password - VikensaTrans</title>

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


<body
    class="
        min-h-screen
        bg-slate-950
        antialiased
    "
>


<div
    class="
        grid
        min-h-screen

        lg:grid-cols-[1.05fr_.95fr]
    "

    x-data="{
        showPassword: false
    }"
>


    {{-- ===================================================== --}}
    {{-- LEFT SIDE --}}
    {{-- ===================================================== --}}

    <section
        class="
            relative
            hidden
            overflow-hidden

            bg-slate-950

            px-12
            py-10

            lg:flex
            lg:flex-col
            lg:justify-between

            xl:px-16
        "
    >


        {{-- BACKGROUND GLOW --}}

        <div
            class="
                pointer-events-none

                absolute
                -left-32
                top-1/3

                h-96
                w-96

                rounded-full

                bg-sky-500/15

                blur-[120px]
            "
        ></div>


        <div
            class="
                pointer-events-none

                absolute
                -bottom-32
                right-0

                h-80
                w-80

                rounded-full

                bg-blue-600/10

                blur-[110px]
            "
        ></div>



        {{-- LOGO --}}

        <div
            class="
                relative
                z-10
            "
        >

            <a
                href="{{ url('/') }}"
            >

                <img
                    src="{{ asset('images/vikensa_trans_logo.png') }}"

                    alt="VikensaTrans"

                    class="
                        h-20
                        w-auto
                        object-contain
                    "
                >

            </a>

        </div>



        {{-- CONTENT --}}

        <div
            class="
                relative
                z-10

                max-w-xl
            "
        >

            <div
                class="
                    inline-flex
                    items-center
                    gap-2

                    rounded-full

                    border
                    border-white/10

                    bg-white/5

                    px-4
                    py-2

                    text-xs
                    font-semibold
                    text-sky-300
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

                Verifikasi Keamanan

            </div>


            <h1
                class="
                    mt-6

                    text-4xl
                    font-black
                    leading-tight
                    tracking-tight
                    text-white

                    xl:text-5xl
                "
            >
                Konfirmasi bahwa

                <span
                    class="
                        block
                        text-sky-400
                    "
                >
                    ini benar-benar kamu.
                </span>
            </h1>


            <p
                class="
                    mt-5

                    max-w-lg

                    text-base
                    leading-8
                    text-slate-400
                "
            >
                Untuk menjaga keamanan akun,
                VikensaTrans meminta kamu memasukkan
                kembali password sebelum melanjutkan
                ke tindakan yang bersifat sensitif.
            </p>



            {{-- INFO ITEMS --}}

            <div
                class="
                    mt-9
                    space-y-5
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
                            h-10
                            w-10
                            shrink-0
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


                    <div>

                        <p
                            class="
                                text-sm
                                font-bold
                                text-white
                            "
                        >
                            Perlindungan tambahan
                        </p>


                        <p
                            class="
                                mt-1

                                text-xs
                                text-slate-500
                            "
                        >
                            Password diminta kembali sebelum aksi penting.
                        </p>

                    </div>

                </div>



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
                            h-10
                            w-10
                            shrink-0
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

                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                            />

                            <path
                                d="m8 12 2.5 2.5L16 9"
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
                            Proses singkat
                        </p>


                        <p
                            class="
                                mt-1

                                text-xs
                                text-slate-500
                            "
                        >
                            Cukup masukkan password akun yang sedang digunakan.
                        </p>

                    </div>

                </div>



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
                            h-10
                            w-10
                            shrink-0
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
                                d="M12 3v18"
                            />

                            <path
                                d="m7 8 5-5 5 5"
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
                            Lanjut otomatis
                        </p>


                        <p
                            class="
                                mt-1

                                text-xs
                                text-slate-500
                            "
                        >
                            Setelah berhasil, kamu akan diarahkan kembali.
                        </p>

                    </div>

                </div>

            </div>

        </div>



        {{-- FOOTER --}}

        <div
            class="
                relative
                z-10

                flex
                items-center
                justify-between

                text-xs
                text-slate-600
            "
        >

            <span>
                © {{ date('Y') }} VikensaTrans
            </span>


            <span>
                Your Journey, Our Priority.
            </span>

        </div>

    </section>



    {{-- ===================================================== --}}
    {{-- RIGHT SIDE --}}
    {{-- ===================================================== --}}

    <section
        class="
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

        <div
            class="
                w-full
                max-w-md
            "
        >


            {{-- ================================================= --}}
            {{-- MOBILE LOGO --}}
            {{-- ================================================= --}}

            <div
                class="
                    mb-9

                    flex
                    justify-center

                    lg:hidden
                "
            >

                <a
                    href="{{ url('/') }}"
                >

                    <img
                        src="{{ asset('images/vikensa_trans_logo.png') }}"

                        alt="VikensaTrans"

                        class="
                            h-20
                            w-auto
                            object-contain
                        "
                    >

                </a>

            </div>



            {{-- ================================================= --}}
            {{-- TITLE --}}
            {{-- ================================================= --}}

            <div>

                <div
                    class="
                        flex
                        h-12
                        w-12
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

                        class="h-6 w-6"
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


                <p
                    class="
                        mt-6

                        text-xs
                        font-black
                        uppercase
                        tracking-[.18em]

                        text-sky-600
                    "
                >
                    Konfirmasi Keamanan
                </p>


                <h2
                    class="
                        mt-2

                        text-3xl
                        font-black
                        tracking-tight
                        text-slate-950
                    "
                >
                    Masukkan Password
                </h2>


                <p
                    class="
                        mt-3

                        text-sm
                        leading-7
                        text-slate-500
                    "
                >
                    Ini merupakan area aman.
                    Silakan konfirmasi password akunmu
                    sebelum melanjutkan.
                </p>

            </div>



            {{-- ================================================= --}}
            {{-- USER INFO --}}
            {{-- ================================================= --}}

            @auth

                <div
                    class="
                        mt-6

                        flex
                        items-center
                        gap-3

                        rounded-xl

                        border
                        border-slate-200

                        bg-slate-50

                        p-4
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
                                text-slate-800
                            "
                        >
                            {{ Auth::user()->name }}
                        </p>


                        <p
                            class="
                                mt-0.5

                                truncate

                                text-xs
                                text-slate-400
                            "
                        >
                            {{ Auth::user()->email }}
                        </p>

                    </div>


                    <div
                        class="
                            flex
                            h-8
                            w-8
                            shrink-0
                            items-center
                            justify-center

                            rounded-lg

                            bg-emerald-50

                            text-emerald-500
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

                    </div>

                </div>

            @endauth



            {{-- ================================================= --}}
            {{-- FORM --}}
            {{-- ================================================= --}}

            <form
                method="POST"

                action="{{ route('password.confirm') }}"

                class="mt-7"
            >

                @csrf



                {{-- PASSWORD --}}

                <div>

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

                            :type="
                                showPassword
                                    ? 'text'
                                    : 'password'
                            "

                            name="password"

                            required
                            autocomplete="current-password"

                            placeholder="Masukkan password akun"

                            class="
                                h-12
                                w-full

                                rounded-xl

                                border
                                border-slate-200

                                bg-slate-50

                                pl-12
                                pr-12

                                text-sm
                                font-semibold
                                text-slate-800

                                outline-none

                                transition

                                placeholder:font-normal
                                placeholder:text-slate-400

                                hover:border-slate-300

                                focus:border-sky-500
                                focus:bg-white
                                focus:ring-4
                                focus:ring-sky-500/10
                            "
                        >



                        {{-- SHOW / HIDE --}}

                        <button
                            type="button"

                            @click="
                                showPassword =
                                !showPassword
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

                                transition

                                hover:text-sky-600
                            "
                        >


                            {{-- SHOW ICON --}}

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
                                    r="2.5"
                                />

                            </svg>



                            {{-- HIDE ICON --}}

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
                                    d="M10.5 10.5a2 2 0 0 0 3 3"
                                />

                                <path
                                    d="M9.8 4.4A10.7 10.7 0 0 1 12 4c6.5 0 10 8 10 8a17 17 0 0 1-2 3"
                                />

                                <path
                                    d="M6.5 6.5C3.5 8.3 2 12 2 12s3.5 8 10 8a10 10 0 0 0 4-.8"
                                />

                            </svg>

                        </button>

                    </div>



                    {{-- ERROR --}}

                    @error('password')

                        <div
                            class="
                                mt-2

                                flex
                                items-center
                                gap-2

                                text-xs
                                font-semibold
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
                                    d="M12 8v5"
                                />

                                <path
                                    d="M12 17h.01"
                                />

                            </svg>

                            {{ $message }}

                        </div>

                    @enderror

                </div>



                {{-- ================================================= --}}
                {{-- CONFIRM BUTTON --}}
                {{-- ================================================= --}}

                <button
                    type="submit"

                    class="
                        group

                        mt-6

                        flex
                        w-full
                        items-center
                        justify-center
                        gap-3

                        rounded-xl

                        bg-sky-500

                        px-5
                        py-3.5

                        text-sm
                        font-black
                        text-white

                        shadow-lg
                        shadow-sky-500/20

                        transition

                        hover:bg-sky-600

                        focus:outline-none
                        focus:ring-4
                        focus:ring-sky-500/20
                    "
                >

                    Konfirmasi Password


                    <svg
                        viewBox="0 0 24 24"

                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"

                        class="
                            h-4
                            w-4

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

            </form>



            {{-- ================================================= --}}
            {{-- FORGOT PASSWORD --}}
            {{-- ================================================= --}}

            @if(Route::has('password.request'))

                <div
                    class="
                        mt-5
                        text-center
                    "
                >

                    <p
                        class="
                            text-sm
                            text-slate-500
                        "
                    >
                        Tidak ingat password?

                        <a
                            href="{{ route('password.request') }}"

                            class="
                                font-black
                                text-sky-600

                                transition

                                hover:text-sky-700
                            "
                        >
                            Reset password
                        </a>
                    </p>

                </div>

            @endif



            {{-- ================================================= --}}
            {{-- SECURITY INFO --}}
            {{-- ================================================= --}}

            <div
                class="
                    mt-7

                    rounded-xl

                    border
                    border-slate-200

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

                        <path
                            d="m9 12 2 2 4-4"
                        />

                    </svg>


                    <p
                        class="
                            text-xs
                            leading-6
                            text-slate-500
                        "
                    >
                        Konfirmasi password membantu mencegah
                        perubahan atau tindakan penting dilakukan
                        oleh orang lain saat akunmu sedang terbuka.
                    </p>

                </div>

            </div>



            {{-- MOBILE FOOTER --}}

            <div
                class="
                    mt-10

                    text-center

                    text-xs
                    text-slate-400

                    lg:hidden
                "
            >
                © {{ date('Y') }} VikensaTrans
            </div>

        </div>

    </section>

</div>


</body>

</html>