<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Selesaikan Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg border-t-4 border-blue-500">
                <div class="p-8 text-gray-900 text-center">
                    
                    <h3 class="text-sm font-bold text-gray-500 uppercase tracking-widest mb-2">Total Tagihan</h3>
                    <p class="text-4xl font-extrabold text-gray-900 mb-8">
                        Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                    </p>

                    <div class="text-left bg-gray-50 p-6 rounded-md mb-8 border border-gray-200">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-gray-500 uppercase">Kode Booking</p>
                                <p class="font-bold text-gray-800">{{ $booking->booking_code }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase">Armada Charter</p>
                                <p class="font-bold text-gray-800">{{ $booking->schedule->shuttle->name }}</p>
                            </div>
                            <div class="col-span-1 md:col-span-2 mt-2 pt-4 border-t border-gray-200">
                                <p class="text-xs text-gray-500 uppercase">Rute Perjalanan</p>
                                <p class="font-bold text-gray-700 mt-1">
                                    🚩 {{ $booking->schedule->route->origin->city }} ➔ {{ $booking->schedule->route->destination->city }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Pemicu Midtrans Snap -->
                    <button id="pay-button" class="inline-flex items-center justify-center w-full px-6 py-4 bg-blue-600 border border-transparent rounded-md font-bold text-base text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 cursor-pointer shadow-md">
                        💳 Pilih Metode Pembayaran
                    </button>
                    
                    <p class="text-xs text-gray-400 mt-4">Secured by Midtrans</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Midtrans Snap (Sandbox) -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    
    <!-- Logika untuk memunculkan Pop-up -->
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function(){
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result){
                    // Arahkan ke rute konfirmasi yang akan mengupdate database
                    window.location.href = "{{ route('payment.success', $booking->id) }}";
                },
                onPending: function(result){
                    window.location.href = "{{ route('riwayat') }}";
                },
                onError: function(result){
                    alert("Maaf, pembayaran Anda gagal diproses!");
                },
                onClose: function(){
                    console.log('Customer menutup kotak pop-up tanpa menyelesaikan pembayaran');
                }
            });
        };
    </script>
</x-app-layout>