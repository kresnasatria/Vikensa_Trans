<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Edit Catatan Servis') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-[2rem] border border-slate-200 p-8">
                
                <div class="mb-6 border-b border-slate-100 pb-5">
                    <h3 class="text-xl font-black text-slate-900">Form Edit Servis Kendaraan</h3>
                    <p class="text-sm text-slate-400 mt-1">Perbarui kerusakan, kendala, atau data servis armada.</p>
                </div>

                <form action="{{ route('admin.services.update', $service->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    {{-- Pilih Armada --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Kendaraan yang Diservis <span class="text-red-500">*</span></label>
                        <select name="shuttle_id" required class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm font-medium focus:border-sky-500 focus:ring-sky-500/20">
                            <option value="">-- Pilih Armada --</option>
                            @foreach($shuttles as $shuttle)
                                <option value="{{ $shuttle->id }}" {{ $service->shuttle_id == $shuttle->id ? 'selected' : '' }}>
                                    {{ $shuttle->name }} ({{ $shuttle->license_plate }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Kendala --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Kendalanya apa saja? <span class="text-red-500">*</span></label>
                        <textarea name="kendala" rows="2" required placeholder="Contoh: Mesin sering brebet saat tanjakan..." class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-sky-500 focus:ring-sky-500/20">{{ old('kendala', $service->kendala) }}</textarea>
                    </div>

                    {{-- Kerusakan --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Rusaknya apa saja? <span class="text-red-500">*</span></label>
                        <textarea name="kerusakan" rows="2" required placeholder="Contoh: Kampas rem habis, busi mati..." class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-sky-500 focus:ring-sky-500/20">{{ old('kerusakan', $service->kerusakan) }}</textarea>
                    </div>

                    {{-- Suku Cadang --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Suku Cadang yang Diganti <span class="text-red-500">*</span></label>
                        <textarea name="suku_cadang" rows="2" required placeholder="Contoh: 4 Pcs Busi, 1 Set Kampas Rem Depan..." class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-sky-500 focus:ring-sky-500/20">{{ old('suku_cadang', $service->suku_cadang) }}</textarea>
                    </div>

                    {{-- Jadwal Berikutnya --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Jadwal Servis Berikutnya (Bulan / KM) <span class="text-red-500">*</span></label>
                        <input type="text" name="estimasi_waktu" value="{{ old('estimasi_waktu', $service->estimasi_waktu) }}" required placeholder="Contoh: 6 Bulan / 10.000 KM" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm font-medium focus:border-sky-500 focus:ring-sky-500/20">
                    </div>

                    {{-- Estimasi Harga --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Estimasi Biaya / Harga Servis <span class="text-red-500">*</span></label>
                        <input type="text" name="estimasi_harga" value="{{ old('estimasi_harga', $service->estimasi_harga) }}" required placeholder="Contoh: Rp 1.500.000" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 text-sm font-medium focus:border-sky-500 focus:ring-sky-500/20">
                    </div>

                    <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
                        <a href="{{ route('admin.services.index') }}" class="px-5 py-3 text-sm font-bold text-slate-500 hover:text-slate-800 transition">Batal</a>
                        <button type="submit" class="bg-sky-500 hover:bg-sky-400 text-white text-sm font-black px-6 py-3 rounded-xl shadow-lg shadow-sky-500/20 transition">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>