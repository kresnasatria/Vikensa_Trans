<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Form Pemesanan Charter') }}
        </h2>
    </x-slot>

    <!-- TAMBAHKAN LIBRARY SELECT2 UNTUK DROPDOWN PENCARIAN -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* Kustomisasi Select2 agar persis dengan desain Tailwind bawaan Anda */
        .select2-container .select2-selection--single {
            height: 46px !important;
            border-radius: 0.375rem !important;
            border-color: #e5e7eb !important;
            background-color: #f9fafb !important;
            display: flex;
            align-items: center;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 44px !important;
            right: 10px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #374151 !important;
            font-weight: 500 !important;
            padding-left: 12px !important;
        }
        .select2-container--default.select2-container--disabled .select2-selection--single {
            background-color: #e5e7eb !important;
            cursor: not-allowed !important;
        }
        .select2-container--default.select2-container--open .select2-selection--single {
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5) !important;
        }
        .select2-search__field {
            outline: none !important;
            border-radius: 0.25rem !important;
        }
    </style>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-t-4 border-blue-500">
                <div class="p-8 text-gray-900">
                    
                    <div class="mb-8 border-b pb-4">
                        <h3 class="text-xl font-bold">Armada Pilihan: {{ $schedule->shuttle->name }}</h3>
                        <p class="text-sm text-gray-500">Kapasitas: {{ $schedule->shuttle->seat_capacity }} Penumpang | Harga Dasar: Rp {{ number_format($schedule->price, 0, ',', '.') }}</p>
                    </div>

                    <form action="{{ route('book.store') }}" method="POST" id="bookingForm">
                        @csrf
                        <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
                        
                        <!-- Input Tersembunyi Untuk Menyimpan Data Asal dan Tujuan -->
                        <input type="hidden" name="custom_origin" id="hidden_origin">
                        <input type="hidden" name="custom_destination" id="hidden_destination">
                        <!-- Input Tersembunyi Untuk Menyimpan Total Harga Kalkulasi -->
                        <input type="hidden" name="calculated_total_price" id="hidden_total_price" value="{{ $schedule->price }}">

                        <!-- Grid Pilih Kota Asal & Kota Tujuan (DENGAN PENCARIAN) -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="origin_city">
                                    Kota Jemput (Asal)
                                </label>
                                <select id="origin_city" required class="w-full">
                                    <option value="">-- Ketik / Pilih Kota Asal --</option>
                                    <!-- Opsi diisi otomatis oleh JavaScript -->
                                </select>
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="destination_city">
                                    Kota Tujuan
                                </label>
                                <select id="destination_city" required disabled class="w-full">
                                    <option value="">-- Ketik / Pilih Kota Tujuan --</option>
                                    <!-- Opsi diisi otomatis oleh JavaScript berdasarkan Kota Asal -->
                                </select>
                            </div>
                        </div>

                        <!-- Grid Waktu Berangkat & Waktu Selesai -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="custom_departure_time">
                                    Rencana Waktu Keberangkatan
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                    id="custom_departure_time" type="datetime-local" name="custom_departure_time" required>
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="custom_arrival_time">
                                    Rencana Waktu Selesai (Kembali)
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                    id="custom_arrival_time" type="datetime-local" name="custom_arrival_time" required>
                            </div>
                        </div>

                        <!-- RINCIAN BIAYA (KALKULATOR OTOMATIS) -->
                        <div class="bg-blue-50 rounded-xl p-6 mb-8 border border-blue-100">
                            <h4 class="font-bold text-blue-900 mb-4 border-b border-blue-200 pb-2">Kalkulasi Rincian Biaya</h4>
                            
                            <div class="flex justify-between text-sm text-gray-700 mb-2">
                                <span>Harga Dasar Sewa Armada:</span>
                                <span id="label_base_price" data-price="{{ $schedule->price }}" class="font-medium">Rp {{ number_format($schedule->price, 0, ',', '.') }}</span>
                            </div>
                            
                            <div class="flex justify-between text-sm text-gray-700 mb-2">
                                <span>Ongkos Rute Perjalanan:</span>
                                <span id="label_route_cost" class="font-medium text-amber-600">Rp 0</span>
                            </div>
                            
                            <div class="flex justify-between text-sm text-gray-700 mb-4">
                                <span>Estimasi Biaya Bensin:</span>
                                <span id="label_fuel_cost" class="font-medium text-amber-600">Rp 0</span>
                            </div>
                            
                            <div class="flex justify-between text-lg font-black text-blue-700 border-t border-blue-200 pt-4">
                                <span>Total Pembayaran:</span>
                                <span id="label_total_price">Rp {{ number_format($schedule->price, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="flex justify-end pt-4 border-t">
                            <button type="submit" class="bg-blue-600 text-white font-bold py-3 px-8 rounded shadow hover:bg-blue-700 transition">
                                Konfirmasi & Pesan Sekarang
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPT JQUERY & SELECT2 -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- SCRIPT KALKULATOR REAL-TIME -->
    <script>
        $(document).ready(function() {
            // Ambil data rute dari backend PHP
            const routesData = @json($routes);

            const originSelect = $('#origin_city');
            const destinationSelect = $('#destination_city');
            
            const labelRouteCost = $('#label_route_cost');
            const labelFuelCost = $('#label_fuel_cost');
            const labelTotalPrice = $('#label_total_price');
            
            const hiddenOrigin = $('#hidden_origin');
            const hiddenDestination = $('#hidden_destination');
            const hiddenTotalPrice = $('#hidden_total_price');

            const basePrice = parseInt($('#label_base_price').data('price'));

            // INISIALISASI FITUR KETIK (SEARCH) PADA DROPDOWN
            originSelect.select2({ width: '100%', placeholder: '-- Ketik / Pilih Kota Asal --' });
            destinationSelect.select2({ width: '100%', placeholder: '-- Ketik / Pilih Kota Tujuan --' });

            // Format angka menjadi bentuk Rupiah
            function formatRupiah(number) {
                return new Intl.NumberFormat('id-ID', { 
                    style: 'currency', 
                    currency: 'IDR', 
                    minimumFractionDigits: 0 
                }).format(number).replace("Rp", "Rp ").replace(",00", "");
            }

            // 1. Ekstrak kota asal (origin) yang unik dan masukkan ke dropdown asal
            const uniqueOrigins = [...new Set(routesData.map(item => item.origin))];
            uniqueOrigins.forEach(origin => {
                originSelect.append(new Option(origin, origin));
            });

            // 2. Fungsi untuk reset kalkulasi
            function resetCalculation() {
                hiddenOrigin.val(originSelect.val());
                hiddenDestination.val("");
                hiddenTotalPrice.val(basePrice);
                
                labelRouteCost.text("Rp 0");
                labelFuelCost.text("Rp 0");
                labelTotalPrice.text(formatRupiah(basePrice));
            }

            // 3. Saat Kota Asal dipilih / diketik
            originSelect.on('change', function() {
                const selectedOrigin = $(this).val();

                // Bersihkan dan matikan sementara dropdown tujuan
                destinationSelect.empty().append(new Option('-- Ketik / Pilih Kota Tujuan --', ''));
                
                // Filter rute yang tujuan akhirnya tersedia dari kota asal ini
                const availableDestinations = routesData.filter(item => item.origin === selectedOrigin);

                availableDestinations.forEach(route => {
                    let opt = new Option(route.destination, route.destination);
                    $(opt).attr('data-route-cost', route.route_cost);
                    $(opt).attr('data-fuel-cost', route.fuel_cost);
                    destinationSelect.append(opt);
                });

                // Aktifkan dropdown tujuan
                destinationSelect.prop('disabled', false).trigger('change.select2');

                resetCalculation();
            });

            // 4. Saat Kota Tujuan dipilih / diketik
            destinationSelect.on('change', function() {
                const selectedOption = $(this).find(':selected');
                
                if (!selectedOption.val()) return; // Hindari kalkulasi jika opsi kosong

                const routeCost = parseInt(selectedOption.attr('data-route-cost')) || 0;
                const fuelCost = parseInt(selectedOption.attr('data-fuel-cost')) || 0;
                
                // Isi input tersembunyi
                hiddenOrigin.val(originSelect.val());
                hiddenDestination.val($(this).val());

                // Kalkulasi Total
                const total = basePrice + routeCost + fuelCost;
                hiddenTotalPrice.val(total);

                // Tampilkan di layar
                labelRouteCost.text(formatRupiah(routeCost));
                labelFuelCost.text(formatRupiah(fuelCost));
                labelTotalPrice.text(formatRupiah(total));
            });
        });
    </script>
</x-app-layout>