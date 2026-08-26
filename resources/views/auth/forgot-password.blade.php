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

    <title>Lupa Password - VikensaTrans</title>

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

            lg:flex
            lg:flex-col
            lg:justify-between

            px-12
            py-10

            xl:px-16
        "
    >


        {{-- GLOW --}}
        <div
            class="
                pointer-events-none

                absolute
                -left-28
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

            <a href="{{ url('/') }}">

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

                Pemulihan Akun

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
                Lupa password?

                <span
                    class="
                        block
                        text-sky-400
                    "
                >
                    Tidak masalah.
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
                Masukkan email yang terdaftar pada akun VikensaTrans.
                Kami akan mengirimkan link untuk membuat password baru.
            </p>



            {{-- STEPS --}}
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

                            text-sm
                            font-black
                            text-sky-400
                        "
                    >
                        1
                    </div>


                    <div>

                        <p
                            class="
                                text-sm
                                font-bold
                                text-white
                            "
                        >
                            Masukkan email
                        </p>

                        <p
                            class="
                                mt-1
                                text-xs
                                text-slate-500
                            "
                        >
                            Gunakan email yang terhubung dengan akunmu.
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

                            text-sm
                            font-black
                            text-sky-400
                        "
                    >
                        2
                    </div>


                    <div>

                        <p
                            class="
                                text-sm
                                font-bold
                                text-white
                            "
                        >
                            Cek inbox email
                        </p>

                        <p
                            class="
                                mt-1
                                text-xs
                                text-slate-500
                            "
                        >
                            Buka link reset password yang kami kirimkan.
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

                            text-sm
                            font-black
                            text-sky-400
                        "
                    >
                        3
                    </div>


                    <div>

                        <p
                            class="
                                text-sm
                                font-bold
                                text-white
                            "
                        >
                            Buat password baru
                        </p>

                        <p
                            class="
                                mt-1
                                text-xs
                                text-slate-500
                            "
                        >
                            Setelah selesai, kamu bisa login kembali.
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


            {{-- MOBILE LOGO --}}
            <div
                class="
                    mb-10

                    flex
                    justify-center

                    lg:hidden
                "
            >

                <a href="{{ url('/') }}">

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



            {{-- BACK TO LOGIN --}}
            <a
                href="{{ route('login') }}"

                class="
                    inline-flex
                    items-center
                    gap-2

                    text-sm
                    font-semibold
                    text-slate-500

                    transition

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

                Kembali ke Login

            </a>



            {{-- TITLE --}}
            <div
                class="
                    mt-7
                "
            >

                <p
                    class="
                        text-xs
                        font-black
                        uppercase
                        tracking-[.18em]
                        text-sky-600
                    "
                >
                    Reset Password
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
                    Lupa Password?
                </h2>


                <p
                    class="
                        mt-3

                        text-sm
                        leading-7
                        text-slate-500
                    "
                >
                    Masukkan alamat email yang kamu gunakan
                    saat mendaftar. Link reset password akan
                    dikirim ke email tersebut.
                </p>

            </div>



            {{-- ================================================= --}}
            {{-- SUCCESS STATUS --}}
            {{-- ================================================= --}}

            @if(session('status'))

                <div
                    class="
                        mt-6

                        flex
                        items-start
                        gap-3

                        rounded-xl

                        border
                        border-emerald-200

                        bg-emerald-50

                        p-4
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

                            bg-emerald-100

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
                                d="m5 12 4 4L19 6"
                            />

                        </svg>

                    </div>


                    <div>

                        <p
                            class="
                                text-sm
                                font-bold
                                text-emerald-800
                            "
                        >
                            Email berhasil dikirim
                        </p>


                        <p
                            class="
                                mt-1

                                text-xs
                                leading-5
                                text-emerald-700
                            "
                        >
                            {{ session('status') }}
                        </p>

                    </div>

                </div>

            @endif



            {{-- ================================================= --}}
            {{-- FORM --}}
            {{-- ================================================= --}}

            <form
                method="POST"

                action="{{ route('password.email') }}"

                class="
                    mt-7
                "
            >

                @csrf



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

                                <path
                                    d="m3 7 9 6 9-6"
                                />

                            </svg>

                        </div>


                        <input
                            id="email"

                            type="email"

                            name="email"

                            value="{{ old('email') }}"

                            required
                            autofocus
                            autocomplete="email"

                            placeholder="contoh@email.com"

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



                {{-- BUTTON --}}
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

                    Kirim Link Reset Password


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
            {{-- INFO --}}
            {{-- ================================================= --}}

            <div
                class="
                    mt-6

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

                        <circle
                            cx="12"
                            cy="12"
                            r="9"
                        />

                        <path
                            d="M12 11v5"
                        />

                        <path
                            d="M12 8h.01"
                        />

                    </svg>


                    <p
                        class="
                            text-xs
                            leading-6
                            text-slate-500
                        "
                    >
                        Jika email tidak ditemukan di inbox,
                        periksa juga folder spam atau junk.
                        Pastikan email yang dimasukkan sama
                        dengan email saat mendaftar.
                    </p>

                </div>

            </div>



            {{-- LOGIN --}}
            <p
                class="
                    mt-8

                    text-center

                    text-sm
                    text-slate-500
                "
            >
                Sudah ingat password?

                <a
                    href="{{ route('login') }}"

                    class="
                        font-black
                        text-sky-600

                        transition

                        hover:text-sky-700
                    "
                >
                    Login sekarang
                </a>
            </p>



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