<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @if(request()->is('admin*'))
        <!-- WADAH UNTUK POP-UP NOTIFIKASI (HANYA MUNCUL DI ADMIN) -->
        <div id="toast-container" class="fixed top-5 right-5 z-[9999] flex flex-col gap-3 pointer-events-none"></div>

        <!-- SCRIPT AJAX POLLING NOTIFIKASI -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let lastOrderId = null;

                function showNotification(title, message) {
                    const toast = document.createElement('div');
                    toast.className = `
                        transform transition-all duration-500 translate-x-full opacity-0
                        bg-white border-l-4 border-sky-500 rounded-xl shadow-2xl p-4 flex items-start gap-4 max-w-sm pointer-events-auto
                    `;
                    
                    toast.innerHTML = `
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-sky-100 text-sky-600">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-black text-slate-900">${title}</h4>
                            <p class="mt-1 text-xs text-slate-500">${message}</p>
                        </div>
                        <button onclick="this.parentElement.remove()" class="text-slate-400 hover:text-slate-600">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4"><path d="M18 6L6 18M6 6l12 12"/></svg>
                        </button>
                    `;

                    document.getElementById('toast-container').appendChild(toast);

                    setTimeout(() => {
                        toast.classList.remove('translate-x-full', 'opacity-0');
                        // Efek suara Ting! kecil saat ada notifikasi
                        let audio = new Audio('https://assets.mixkit.co/active_storage/sfx/2869/2869-preview.mp3');
                        audio.volume = 0.5;
                        audio.play().catch(e => console.log('Autoplay audio diblokir browser.'));
                    }, 100);

                    setTimeout(() => {
                        toast.classList.add('translate-x-full', 'opacity-0');
                        setTimeout(() => toast.remove(), 500);
                    }, 7000);
                }

                setInterval(() => {
                    // Menggunakan URL statis agar tidak kena error RouteNotFound
                    fetch('/admin/cek-pesanan-baru')
                        .then(response => response.json())
                        .then(data => {
                            if (lastOrderId === null) {
                                lastOrderId = data.latest_id;
                            } 
                            else if (data.latest_id > lastOrderId) {
                                showNotification(
                                    'Pesanan Baru Masuk! 🎉', 
                                    'Seseorang baru saja menyewa armada. Segera cek riwayat pesanan Anda.'
                                );
                                lastOrderId = data.latest_id;
                            }
                        })
                        .catch(error => console.log('Standby mengecek pesanan...'));
                }, 10000); 
            });
        </script>
    @endif
    </body>
</html>
