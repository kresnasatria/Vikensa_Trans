<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Reset Password - VikensaTrans</title>

    <link
        rel="icon"
        type="image/png"
        href="{{ asset('images/vikensa_trans_logo.png') }}?v=3"
    >

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] {
            display: none !important;
        }

        body {
            font-family: Inter, ui-sans-serif, system-ui, -apple-system,
                BlinkMacSystemFont, "Segoe UI", sans-serif;
        }
    </style>
</head>


<body class="min-h-screen bg-slate-950 antialiased">

<div
    class="grid min-h-screen lg:grid-cols-[1.05fr_.95fr]"
    x-data="{
        showPassword: false,
        showConfirmation: false,
        password: '',
        confirmation: ''
    }"
>


    {{-- ===================================================== --}}
    {{-- LEFT SIDE --}}
    {{-- ===================================================== --}}

    <section
        class="
            relative hidden overflow-hidden
            bg-slate-950
            px-12 py-10
            lg:flex lg:flex-col lg:justify-between
            xl:px-16
        "
    >

        {{-- BACKGROUND LIGHT --}}
        <div
            class="
                pointer-events-none
                absolute -left-32 top-1/3
                h-96 w-96 rounded-full
                bg-sky-500/15 blur-[120px]
            "
        ></div>

        <div
            class="
                pointer-events-none
                absolute -bottom-32 right-0
                h-80 w-80 rounded-full
                bg-blue-600/10 blur-[110px]
            "
        ></div>


        {{-- LOGO --}}
        <div class="relative z-10">

            <a href="{{ url('/') }}">
                <img
                    src="{{ asset('images/vikensa_trans_logo.png') }}"
                    alt="VikensaTrans"
                    class="h-20 w-auto object-contain"
                >
            </a>

        </div>


        {{-- CONTENT --}}
        <div class="relative z-10 max-w-xl">

            <div
                class="
                    inline-flex items-center gap-2
                    rounded-full border border-white/10
                    bg-white/5 px-4 py-2
                    text-xs font-semibold text-sky-300
                "
            >

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    class="h-4 w-4"
                >
                    <rect x="5" y="10" width="14" height="10" rx="2"/>
                    <path d="M8 10V7a4 4 0 0 1 8 0v3"/>
                </svg>

                Keamanan Akun

            </div>


            <h1
                class="
                    mt-6
                    text-4xl font-black
                    leading-tight tracking-tight
                    text-white
                    xl:text-5xl
                "
            >
                Buat password

                <span class="block text-sky-400">
                    baru untuk akunmu.
                </span>
            </h1>


            <p
                class="
                    mt-5 max-w-lg
                    text-base leading-8
                    text-slate-400
                "
            >
                Gunakan password yang kuat dan mudah kamu ingat.
                Setelah password berhasil diperbarui, kamu dapat
                kembali masuk ke akun VikensaTrans.
            </p>


            {{-- SECURITY TIPS --}}
            <div class="mt-9 space-y-5">

                <div class="flex items-center gap-4">

                    <div
                        class="
                            flex h-10 w-10 shrink-0
                            items-center justify-center
                            rounded-xl bg-sky-500/10
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
                            <path d="m5 12 4 4L19 6"/>
                        </svg>
                    </div>

                    <div>
                        <p class="text-sm font-bold text-white">
                            Minimal 8 karakter
                        </p>

                        <p class="mt-1 text-xs text-slate-500">
                            Hindari password yang terlalu pendek.
                        </p>
                    </div>

                </div>


                <div class="flex items-center gap-4">

                    <div
                        class="
                            flex h-10 w-10 shrink-0
                            items-center justify-center
                            rounded-xl bg-sky-500/10
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
                            <path d="m5 12 4 4L19 6"/>
                        </svg>
                    </div>

                    <div>
                        <p class="text-sm font-bold text-white">
                            Gunakan kombinasi karakter
                        </p>

                        <p class="mt-1 text-xs text-slate-500">
                            Kombinasikan huruf, angka, atau simbol.
                        </p>
                    </div>

                </div>


                <div class="flex items-center gap-4">

                    <div
                        class="
                            flex h-10 w-10 shrink-0
                            items-center justify-center
                            rounded-xl bg-sky-500/10
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
                            <path d="m5 12 4 4L19 6"/>
                        </svg>
                    </div>

                    <div>
                        <p class="text-sm font-bold text-white">
                            Gunakan password berbeda
                        </p>

                        <p class="mt-1 text-xs text-slate-500">
                            Jangan gunakan password yang sama dengan akun lain.
                        </p>
                    </div>

                </div>

            </div>

        </div>


        {{-- FOOTER --}}
        <div
            class="
                relative z-10
                flex items-center justify-between
                text-xs text-slate-600
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
            flex min-h-screen
            items-center justify-center
            bg-white
            px-5 py-10
            sm:px-8
            lg:px-12
        "
    >

        <div class="w-full max-w-md">


            {{-- MOBILE LOGO --}}
            <div class="mb-9 flex justify-center lg:hidden">

                <a href="{{ url('/') }}">
                    <img
                        src="{{ asset('images/vikensa_trans_logo.png') }}"
                        alt="VikensaTrans"
                        class="h-20 w-auto object-contain"
                    >
                </a>

            </div>


            {{-- BACK --}}
            <a
                href="{{ route('login') }}"
                class="
                    inline-flex items-center gap-2
                    text-sm font-semibold text-slate-500
                    transition hover:text-sky-600
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

                Kembali ke Login

            </a>


            {{-- TITLE --}}
            <div class="mt-7">

                <p
                    class="
                        text-xs font-black uppercase
                        tracking-[.18em] text-sky-600
                    "
                >
                    Password Baru
                </p>

                <h2
                    class="
                        mt-2 text-3xl
                        font-black tracking-tight
                        text-slate-950
                    "
                >
                    Reset Password
                </h2>

                <p
                    class="
                        mt-3 text-sm
                        leading-7 text-slate-500
                    "
                >
                    Masukkan password baru untuk akun
                    <span class="font-semibold text-slate-700">
                        {{ old('email', $request->email) }}
                    </span>.
                </p>

            </div>



            {{-- ================================================= --}}
            {{-- FORM --}}
            {{-- ================================================= --}}

            <form
                method="POST"
                action="{{ route('password.store') }}"
                class="mt-7"
            >

                @csrf


                {{-- ================================================= --}}
                {{-- RESET TOKEN - WAJIB --}}
                {{-- ================================================= --}}

                <input
                    type="hidden"
                    name="token"
                    value="{{ $request->route('token') }}"
                >



                {{-- ================================================= --}}
                {{-- EMAIL --}}
                {{-- ================================================= --}}

                <div>

                    <label
                        for="email"
                        class="block text-sm font-bold text-slate-700"
                    >
                        Alamat Email
                    </label>


                    <div class="relative mt-2">

                        <div
                            class="
                                pointer-events-none
                                absolute inset-y-0 left-0
                                flex items-center pl-4
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
                                <rect x="3" y="5" width="18" height="14" rx="2"/>
                                <path d="m3 7 9 6 9-6"/>
                            </svg>

                        </div>


                        <input
                            id="email"
                            type="email"
                            name="email"

                            value="{{ old('email', $request->email) }}"

                            required
                            autofocus
                            autocomplete="username"

                            class="
                                h-12 w-full
                                rounded-xl
                                border border-slate-200
                                bg-slate-100
                                pl-12 pr-4
                                text-sm font-semibold
                                text-slate-600
                                outline-none
                                focus:border-sky-500
                                focus:ring-4
                                focus:ring-sky-500/10
                            "
                        >

                    </div>


                    @error('email')

                        <div
                            class="
                                mt-2 flex items-center gap-2
                                text-xs font-semibold text-red-500
                            "
                        >

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                class="h-4 w-4"
                            >
                                <circle cx="12" cy="12" r="9"/>
                                <path d="M12 8v5"/>
                                <path d="M12 17h.01"/>
                            </svg>

                            {{ $message }}

                        </div>

                    @enderror

                </div>



                {{-- ================================================= --}}
                {{-- PASSWORD --}}
                {{-- ================================================= --}}

                <div class="mt-5">

                    <label
                        for="password"
                        class="block text-sm font-bold text-slate-700"
                    >
                        Password Baru
                    </label>


                    <div class="relative mt-2">

                        <div
                            class="
                                pointer-events-none
                                absolute inset-y-0 left-0
                                flex items-center pl-4
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
                                <rect x="5" y="10" width="14" height="10" rx="2"/>
                                <path d="M8 10V7a4 4 0 0 1 8 0v3"/>
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

                            x-model="password"

                            required
                            autocomplete="new-password"

                            placeholder="Masukkan password baru"

                            class="
                                h-12 w-full
                                rounded-xl
                                border border-slate-200
                                bg-slate-50
                                pl-12 pr-12
                                text-sm font-semibold
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


                        {{-- SHOW PASSWORD --}}
                        <button
                            type="button"

                            @click="
                                showPassword =
                                !showPassword
                            "

                            class="
                                absolute inset-y-0 right-0
                                flex w-12
                                items-center justify-center
                                text-slate-400
                                transition hover:text-sky-600
                            "
                        >

                            <svg
                                x-show="!showPassword"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                class="h-5 w-5"
                            >
                                <path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z"/>
                                <circle cx="12" cy="12" r="2.5"/>
                            </svg>


                            <svg
                                x-show="showPassword"
                                x-cloak
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                class="h-5 w-5"
                            >
                                <path d="m3 3 18 18"/>
                                <path d="M10.5 10.5a2 2 0 0 0 3 3"/>
                                <path d="M9.8 4.4A10.7 10.7 0 0 1 12 4c6.5 0 10 8 10 8a17 17 0 0 1-2 3"/>
                                <path d="M6.5 6.5C3.5 8.3 2 12 2 12s3.5 8 10 8a10 10 0 0 0 4-.8"/>
                            </svg>

                        </button>

                    </div>


                    {{-- SIMPLE PASSWORD STRENGTH --}}
                    <div
                        x-show="password.length > 0"
                        x-cloak
                        class="mt-3"
                    >

                        <div class="flex gap-1.5">

                            <div
                                class="h-1.5 flex-1 rounded-full"
                                :class="
                                    password.length >= 1
                                        ? 'bg-red-400'
                                        : 'bg-slate-200'
                                "
                            ></div>

                            <div
                                class="h-1.5 flex-1 rounded-full"
                                :class="
                                    password.length >= 8
                                        ? 'bg-amber-400'
                                        : 'bg-slate-200'
                                "
                            ></div>

                            <div
                                class="h-1.5 flex-1 rounded-full"
                                :class="
                                    password.length >= 10
                                    && /[0-9]/.test(password)
                                        ? 'bg-sky-500'
                                        : 'bg-slate-200'
                                "
                            ></div>

                            <div
                                class="h-1.5 flex-1 rounded-full"
                                :class="
                                    password.length >= 10
                                    && /[A-Za-z]/.test(password)
                                    && /[0-9]/.test(password)
                                        ? 'bg-emerald-500'
                                        : 'bg-slate-200'
                                "
                            ></div>

                        </div>


                        <p
                            class="
                                mt-2 text-xs font-semibold
                            "

                            :class="{
                                'text-red-500':
                                    password.length < 8,

                                'text-amber-500':
                                    password.length >= 8
                                    && password.length < 10,

                                'text-sky-600':
                                    password.length >= 10
                                    && !(/[A-Za-z]/.test(password)
                                    && /[0-9]/.test(password)),

                                'text-emerald-600':
                                    password.length >= 10
                                    && /[A-Za-z]/.test(password)
                                    && /[0-9]/.test(password)
                            }"

                            x-text="
                                password.length < 8
                                    ? 'Password masih terlalu pendek'
                                : password.length < 10
                                    ? 'Kekuatan password cukup'
                                : (
                                    /[A-Za-z]/.test(password)
                                    && /[0-9]/.test(password)
                                )
                                    ? 'Password kuat'
                                    : 'Tambahkan kombinasi huruf dan angka'
                            "
                        ></p>

                    </div>


                    @error('password')

                        <div
                            class="
                                mt-2 flex items-center gap-2
                                text-xs font-semibold text-red-500
                            "
                        >

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                class="h-4 w-4"
                            >
                                <circle cx="12" cy="12" r="9"/>
                                <path d="M12 8v5"/>
                                <path d="M12 17h.01"/>
                            </svg>

                            {{ $message }}

                        </div>

                    @enderror

                </div>



                {{-- ================================================= --}}
                {{-- CONFIRM PASSWORD --}}
                {{-- ================================================= --}}

                <div class="mt-5">

                    <label
                        for="password_confirmation"
                        class="block text-sm font-bold text-slate-700"
                    >
                        Konfirmasi Password Baru
                    </label>


                    <div class="relative mt-2">

                        <div
                            class="
                                pointer-events-none
                                absolute inset-y-0 left-0
                                flex items-center pl-4
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
                                <rect x="5" y="10" width="14" height="10" rx="2"/>
                                <path d="M8 10V7a4 4 0 0 1 8 0v3"/>
                            </svg>

                        </div>


                        <input
                            id="password_confirmation"

                            :type="
                                showConfirmation
                                    ? 'text'
                                    : 'password'
                            "

                            name="password_confirmation"

                            x-model="confirmation"

                            required
                            autocomplete="new-password"

                            placeholder="Ulangi password baru"

                            class="
                                h-12 w-full
                                rounded-xl
                                border border-slate-200
                                bg-slate-50
                                pl-12 pr-12
                                text-sm font-semibold
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


                        <button
                            type="button"

                            @click="
                                showConfirmation =
                                !showConfirmation
                            "

                            class="
                                absolute inset-y-0 right-0
                                flex w-12
                                items-center justify-center
                                text-slate-400
                                transition hover:text-sky-600
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
                                <path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z"/>
                                <circle cx="12" cy="12" r="2.5"/>
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
                                <path d="m3 3 18 18"/>
                                <path d="M10.5 10.5a2 2 0 0 0 3 3"/>
                                <path d="M9.8 4.4A10.7 10.7 0 0 1 12 4c6.5 0 10 8 10 8"/>
                            </svg>

                        </button>

                    </div>


                    {{-- PASSWORD MATCH --}}
                    <div
                        x-show="
                            confirmation.length > 0
                        "

                        x-cloak

                        class="mt-2"
                    >

                        <p
                            x-show="
                                password === confirmation
                            "

                            class="
                                flex items-center gap-2
                                text-xs font-semibold
                                text-emerald-600
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

                            Password sudah sama

                        </p>


                        <p
                            x-show="
                                password !== confirmation
                            "

                            class="
                                flex items-center gap-2
                                text-xs font-semibold
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
                                <path d="M6 6l12 12M18 6 6 18"/>
                            </svg>

                            Password belum sama

                        </p>

                    </div>


                    @error('password_confirmation')

                        <p
                            class="
                                mt-2
                                text-xs font-semibold
                                text-red-500
                            "
                        >
                            {{ $message }}
                        </p>

                    @enderror

                </div>



                {{-- ================================================= --}}
                {{-- BUTTON --}}
                {{-- ================================================= --}}

                <button
                    type="submit"

                    :disabled="
                        password.length < 8
                        || password !== confirmation
                    "

                    :class="
                        password.length >= 8
                        && password === confirmation

                            ? 'bg-sky-500 hover:bg-sky-600 cursor-pointer'
                            : 'bg-slate-300 cursor-not-allowed'
                    "

                    class="
                        group

                        mt-7

                        flex w-full
                        items-center justify-center
                        gap-3

                        rounded-xl

                        px-5 py-3.5

                        text-sm
                        font-black
                        text-white

                        shadow-lg

                        transition

                        focus:outline-none
                        focus:ring-4
                        focus:ring-sky-500/20
                    "
                >

                    Simpan Password Baru


                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"

                        class="
                            h-4 w-4
                            transition
                            group-hover:translate-x-1
                        "
                    >
                        <path d="M5 12h14"/>
                        <path d="m13 6 6 6-6 6"/>
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

                <div class="flex items-start gap-3">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"

                        class="
                            mt-0.5
                            h-5 w-5 shrink-0
                            text-sky-500
                        "
                    >
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/>
                        <path d="m9 12 2 2 4-4"/>
                    </svg>


                    <p
                        class="
                            text-xs leading-6
                            text-slate-500
                        "
                    >
                        Setelah password berhasil diubah,
                        link reset yang digunakan tidak dapat
                        digunakan kembali.
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