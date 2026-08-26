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

    <title>Verifikasi Email - VikensaTrans</title>

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


<body class="min-h-screen bg-slate-950 antialiased">


<div class="grid min-h-screen lg:grid-cols-[1.05fr_.95fr]">


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

        {{-- BACKGROUND --}}
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
        <div class="relative z-10">

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
                        x="3"
                        y="5"
                        width="18"
                        height="14"
                        rx="2"
                    />

                    <path d="m3 7 9 6 9-6"/>

                </svg>

                Verifikasi Akun

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
                Tinggal satu langkah

                <span class="block text-sky-400">
                    sebelum mulai perjalanan.
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
                Kami telah mengirimkan link verifikasi
                ke alamat email yang kamu gunakan saat mendaftar.
                Buka email tersebut untuk mengaktifkan akun VikensaTrans.
            </p>



            {{-- SIMPLE INFO --}}
            <div class="mt-9 max-w-lg">

                <div
                    class="
                        flex
                        items-start
                        gap-4

                        rounded-2xl

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
                                d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"
                            />

                            <path d="m9 12 2 2 4-4"/>
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
                            Kenapa perlu verifikasi?
                        </p>


                        <p
                            class="
                                mt-1

                                text-xs
                                leading-6
                                text-slate-500
                            "
                        >
                            Verifikasi membantu memastikan email
                            benar-benar milikmu dan menjaga keamanan
                            akun saat melakukan pemesanan.
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

        <div class="w-full max-w-md">


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



            {{-- MAIL ICON --}}
            <div
                class="
                    flex
                    h-14
                    w-14
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

                    class="h-7 w-7"
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



            {{-- TITLE --}}
            <div class="mt-6">

                <p
                    class="
                        text-xs
                        font-black
                        uppercase
                        tracking-[.18em]

                        text-sky-600
                    "
                >
                    Verifikasi Email
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
                    Cek email kamu
                </h2>


                <p
                    class="
                        mt-3

                        text-sm
                        leading-7
                        text-slate-500
                    "
                >
                    Link verifikasi sudah dikirim ke email
                    yang terdaftar pada akunmu.
                </p>

            </div>



            {{-- ================================================= --}}
            {{-- EMAIL USER --}}
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
                                text-slate-500
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

                            bg-amber-50

                            text-amber-500
                        "
                    >

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"

                            class="h-4 w-4"
                        >
                            <path d="M12 8v5"/>
                            <path d="M12 17h.01"/>
                            <circle cx="12" cy="12" r="9"/>
                        </svg>

                    </div>

                </div>

            @endauth



            {{-- ================================================= --}}
            {{-- SUCCESS RESEND --}}
            {{-- ================================================= --}}

            @if(session('status') === 'verification-link-sent')

                <div
                    class="
                        mt-5

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
                            <path d="m5 12 4 4L19 6"/>
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
                            Link verifikasi baru telah dikirim
                            ke alamat email kamu.
                        </p>

                    </div>

                </div>

            @endif



            {{-- ================================================= --}}
            {{-- INSTRUCTION --}}
            {{-- ================================================= --}}

            <div
                class="
                    mt-6

                    rounded-xl

                    border
                    border-slate-200

                    p-5
                "
            >

                <p
                    class="
                        text-sm
                        font-bold
                        text-slate-800
                    "
                >
                    Yang perlu kamu lakukan:
                </p>


                <div class="mt-4 space-y-4">

                    <div class="flex items-center gap-3">

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


                        <p class="text-sm text-slate-600">
                            Buka inbox email kamu.
                        </p>

                    </div>


                    <div class="flex items-center gap-3">

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


                        <p class="text-sm text-slate-600">
                            Cari email verifikasi dari VikensaTrans.
                        </p>

                    </div>


                    <div class="flex items-center gap-3">

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


                        <p class="text-sm text-slate-600">
                            Klik tombol verifikasi di dalam email.
                        </p>

                    </div>

                </div>

            </div>



            {{-- ================================================= --}}
            {{-- RESEND --}}
            {{-- ================================================= --}}

            <form
                method="POST"
                action="{{ route('verification.send') }}"

                class="mt-6"
            >

                @csrf


                <button
                    type="submit"

                    class="
                        group

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

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"

                        class="
                            h-4
                            w-4

                            transition

                            group-hover:rotate-12
                        "
                    >
                        <path d="M20 6v5h-5"/>
                        <path d="M4 18v-5h5"/>
                        <path d="M18.5 9A7 7 0 0 0 6 7"/>
                        <path d="M5.5 15A7 7 0 0 0 18 17"/>
                    </svg>

                    Kirim Ulang Email Verifikasi

                </button>

            </form>



            {{-- ================================================= --}}
            {{-- NOT RECEIVED --}}
            {{-- ================================================= --}}

            <div
                class="
                    mt-5

                    rounded-xl

                    bg-slate-50

                    p-4
                "
            >

                <div class="flex items-start gap-3">

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

                            text-slate-400
                        "
                    >

                        <circle cx="12" cy="12" r="9"/>
                        <path d="M12 11v5"/>
                        <path d="M12 8h.01"/>

                    </svg>


                    <p
                        class="
                            text-xs
                            leading-6
                            text-slate-500
                        "
                    >
                        Belum menerima email? Periksa folder
                        spam atau junk. Kamu juga bisa menggunakan
                        tombol di atas untuk mengirim link baru.
                    </p>

                </div>

            </div>



            {{-- ================================================= --}}
            {{-- LOGOUT --}}
            {{-- ================================================= --}}

            <div
                class="
                    mt-7

                    border-t
                    border-slate-200

                    pt-6

                    text-center
                "
            >

                <p
                    class="
                        text-sm
                        text-slate-500
                    "
                >
                    Bukan akun yang ingin kamu gunakan?
                </p>


                <form
                    method="POST"
                    action="{{ route('logout') }}"

                    class="mt-2"
                >

                    @csrf


                    <button
                        type="submit"

                        class="
                            inline-flex
                            items-center
                            gap-2

                            text-sm
                            font-black
                            text-slate-700

                            transition

                            hover:text-red-500
                        "
                    >

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"

                            class="h-4 w-4"
                        >

                            <path d="M10 17l5-5-5-5"/>
                            <path d="M15 12H3"/>
                            <path d="M14 3h5a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-5"/>

                        </svg>

                        Keluar dan gunakan akun lain

                    </button>

                </form>

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