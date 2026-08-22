<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Form Pemesanan Charter') }}
        </h2>
    </x-slot>

    <!-- TAMBAHKAN LIBRARY SELECT2 UNTUK DROPDOWN PENCARIAN -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
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
                        <p class="text-sm text-gray-500">Kapasitas: {{ $schedule->shuttle->seat_capacity }} Penumpang | Sewa Per Hari: Rp {{ number_format($schedule->price, 0, ',', '.') }}</p>
                    </div>

                    <form action="{{ route('book.store') }}" method="POST" id="bookingForm">
                        @csrf
                        
                        <!-- Input Tersembunyi -->
                        <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
                        <input type="hidden" name="custom_origin" id="hidden_origin">
                        <input type="hidden" name="custom_destination" id="hidden_destination">
                        <input type="hidden" name="calculated_total_price" id="hidden_total_price" value="{{ $schedule->price }}">

                        {{-- FORM DATA PEMESAN & KONTAK --}}
                        <div class="mb-6 rounded-2xl bg-blue-50/50 p-6 border border-blue-100">
                            <h4 class="font-bold text-blue-900 mb-4 flex items-center gap-2">
                                <span class="bg-blue-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs">1</span>
                                Informasi Pemesan & Kontak Jemput
                            </h4>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Nama Pemesan</label>
                                    <input type="text" name="booker_name" value="{{ Auth::user()->name ?? '' }}" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                </div>

                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">No. WhatsApp / HP</label>
                                    <input type="text" name="phone_number" placeholder="Cth: 081234567890" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                </div>
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Alamat Detail Titik Jemput</label>
                                <textarea name="pickup_address" rows="2" placeholder="Sebutkan nama jalan, no rumah, RT/RW, atau patokan yang jelas..." required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"></textarea>
                            </div>
                        </div>

                        <!-- Grid Pilih Kota Asal & Kota Tujuan -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="origin_city">Kota Jemput (Asal)</label>
                                <select id="origin_city" required class="w-full">
                                    <option value="">-- Ketik / Pilih Kota Asal --</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="destination_city">Kota Tujuan</label>
                                <select id="destination_city" required disabled class="w-full">
                                    <option value="">-- Ketik / Pilih Kota Tujuan --</option>
                                </select>
                            </div>
                        </div>

                        <!-- Grid Waktu Berangkat & Waktu Selesai -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="custom_departure_time">Rencana Waktu Keberangkatan</label>
                                <input class="shadow appearance-none border rounded w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                    id="custom_departure_time" type="datetime-local" name="custom_departure_time" required>
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="custom_arrival_time">Rencana Waktu Selesai (Kembali)</label>
                                <input class="shadow appearance-none border rounded w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                    id="custom_arrival_time" type="datetime-local" name="custom_arrival_time" required>
                            </div>
                        </div>

                        <!-- RINCIAN BIAYA (KALKULATOR OTOMATIS) -->
                        <div class="bg-blue-50 rounded-xl p-6 mb-8 border border-blue-100">
                            <h4 class="font-bold text-blue-900 mb-4 border-b border-blue-200 pb-2">Kalkulasi Rincian Biaya</h4>
                            
                            <div class="flex justify-between text-sm text-gray-700 mb-2">
                                <span>Harga Sewa Armada Per Hari:</span>
                                <span id="label_base_price" data-price="{{ $schedule->price }}" class="font-medium">Rp {{ number_format($schedule->price, 0, ',', '.') }}</span>
                            </div>
                            
                            <div class="flex justify-between text-sm text-gray-700 mb-4">
                                <span>Jumlah Hari (Durasi Sewa):</span>
                                <span id="label_days_count" class="font-medium text-amber-600">1 Hari</span>
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

    <!-- SCRIPT KALKULATOR HARIAN REAL-TIME -->
    <script>
        $(document).ready(function() {
            const routesData = @json($routes);

            const originSelect = $('#origin_city');
            const destinationSelect = $('#destination_city');
            
            const departureInput = $('#custom_departure_time');
            const arrivalInput = $('#custom_arrival_time');

            const labelDaysCount = $('#label_days_count');
            const labelTotalPrice = $('#label_total_price');
            
            const hiddenOrigin = $('#hidden_origin');
            const hiddenDestination = $('#hidden_destination');
            const hiddenTotalPrice = $('#hidden_total_price');

            const basePrice = parseInt($('#label_base_price').data('price'));
            let totalDays = 1;

            originSelect.select2({ width: '100%', placeholder: '-- Ketik / Pilih Kota Asal --' });
            destinationSelect.select2({ width: '100%', placeholder: '-- Ketik / Pilih Kota Tujuan --' });

            function formatRupiah(number) {
                return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number).replace("Rp", "Rp ").replace(",00", "");
            }

            // 1. Ekstrak data asal rute
            const uniqueOrigins = [...new Set(routesData.map(item => item.origin))];
            uniqueOrigins.forEach(origin => {
                originSelect.append(new Option(origin, origin));
            });

            // 2. Fungsi Hitung Jumlah Hari
            function calculateDays() {
                const depVal = departureInput.val();
                const arrVal = arrivalInput.val();

                if (depVal && arrVal) {
                    const depDate = new Date(depVal);
                    const arrDate = new Date(arrVal);

                    if (arrDate > depDate) {
                        const diffTime = Math.abs(arrDate - depDate);
                        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
                        totalDays = diffDays === 0 ? 1 : diffDays; // Minimal 1 hari
                    } else {
                        totalDays = 1; // Jika tanggal kembali lebih kecil/sama dengan tanggal berangkat
                    }
                } else {
                    totalDays = 1;
                }

                labelDaysCount.text(totalDays + " Hari");
                updateTotalPrice();
            }

            // 3. Fungsi Update Total Harga
            function updateTotalPrice() {
                const total = basePrice * totalDays;
                hiddenTotalPrice.val(total);
                labelTotalPrice.text(formatRupiah(total));
            }

            // Listeners untuk kalender
            departureInput.on('change', calculateDays);
            arrivalInput.on('change', calculateDays);

            // 4. Saat Kota Asal dipilih
            originSelect.on('change', function() {
                const selectedOrigin = $(this).val();
                destinationSelect.empty().append(new Option('-- Ketik / Pilih Kota Tujuan --', ''));
                
                const availableDestinations = routesData.filter(item => item.origin === selectedOrigin);

                availableDestinations.forEach(route => {
                    let displayDestination = route.destination;
                    try {
                        let parsedDest = JSON.parse(route.destination);
                        if (Array.isArray(parsedDest)) {
                            displayDestination = parsedDest.join(' ➔ '); 
                        }
                    } catch (e) {}

                    destinationSelect.append(new Option(displayDestination, displayDestination));
                });

                destinationSelect.prop('disabled', false).trigger('change.select2');
                hiddenOrigin.val(selectedOrigin);
            });

            // 5. Saat Kota Tujuan dipilih
            destinationSelect.on('change', function() {
                hiddenDestination.val($(this).val());
            });
        });
    </script>
</x-app-layout>