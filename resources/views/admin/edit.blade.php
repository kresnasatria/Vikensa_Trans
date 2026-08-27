<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Armada - VikensaTrans Admin</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: Inter, ui-sans-serif, system-ui, sans-serif; }
        .form-card { box-shadow: 0 20px 60px rgba(15, 23, 42, .06); }
    </style>
</head>

<body class="bg-slate-100 text-slate-900 antialiased" x-data="{ sidebarOpen: false }">

    <div x-show="sidebarOpen" x-cloak x-transition.opacity @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-slate-950/60 backdrop-blur-sm lg:hidden"></div>

    {{-- SIDEBAR --}}
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 flex w-[285px] flex-col border-r border-white/10 bg-slate-950 text-white transition-transform duration-300 lg:translate-x-0">
        <div class="flex h-24 items-center justify-between border-b border-white/10 px-6">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-sky-500 text-white shadow-lg shadow-sky-500/20">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-6 w-6"><path d="M12 2 20 6v6c0 5-3.5 8.5-8 10-4.5-1.5-8-5-8-10V6Z"/><path d="m9 12 2 2 4-4"/></svg>
                </div>
                <div>
                    <p class="text-xl font-black tracking-tight text-white">Vikensa<span class="text-sky-400">Trans</span></p>
                    <p class="mt-0.5 text-[9px] font-bold uppercase tracking-[.22em] text-slate-500">Administrator</p>
                </div>
            </a>
        </div>
        <nav class="flex-1 overflow-y-auto px-4 py-6">
            <p class="mb-3 px-4 text-[10px] font-black uppercase tracking-[.2em] text-slate-500">Administrasi</p>
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3.5 text-sm font-semibold text-slate-400 transition hover:bg-white/5 hover:text-white">Dashboard Admin</a>
            <a href="{{ route('admin.create') }}" class="mt-2 flex items-center gap-3 rounded-2xl px-4 py-3.5 text-sm font-semibold text-slate-400 transition hover:bg-white/5 hover:text-white">Tambah Armada</a>
        </nav>
    </aside>

    <div class="lg:pl-[285px]">
        <header class="sticky top-0 z-30 flex h-20 items-center border-b border-slate-200 bg-white/90 px-5 backdrop-blur-xl sm:px-7 lg:px-10">
            <div class="flex w-full items-center justify-between">
                <h2 class="text-lg font-black text-slate-950">Edit Armada</h2>
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-bold text-slate-600 transition hover:bg-sky-50 hover:text-sky-600">Kembali</a>
            </div>
        </header>

        <main class="px-5 py-8 sm:px-7 lg:px-10 lg:py-10">
            <div class="mx-auto max-w-6xl">

                <div class="mb-7">
                    <h1 class="text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">{{ $schedule->shuttle->name }}</h1>
                    <p class="mt-2 text-sm text-slate-500">Sesuaikan informasi kendaraan dan kelola galeri fotonya.</p>
                </div>

                @if($errors->any())
                    <div class="mb-7 rounded-2xl border border-red-200 bg-red-50 p-5">
                        <ul class="list-inside list-disc space-y-1 text-sm text-red-600">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- FORM UTAMA EDIT (INFORMASI + FOTO BARU + HARGA) --}}
                <form action="{{ route('admin.update', $schedule->id) }}" method="POST" enctype="multipart/form-data" class="space-y-7">
                    @csrf
                    @method('PUT')

                    <div class="grid gap-7 lg:grid-cols-[1fr_340px]">
                        
                        <div class="space-y-7">
                            {{-- INFORMASI DASAR --}}
                            <section class="form-card overflow-hidden rounded-[2rem] border border-slate-200 bg-white p-6 sm:p-7">
                                <h2 class="text-lg font-black text-slate-950 mb-5">Informasi Kendaraan</h2>
                                <div class="grid gap-5 md:grid-cols-2">
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-bold text-slate-700">Nama Armada *</label>
                                        <input type="text" name="shuttle_name" value="{{ old('shuttle_name', $schedule->shuttle->name) }}" required class="mt-2 block h-14 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 text-sm font-medium text-slate-900 outline-none focus:border-sky-500 focus:bg-white">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700">Plat Nomor *</label>
                                        <input type="text" name="license_plate" value="{{ old('license_plate', $schedule->shuttle->license_plate) }}" required class="mt-2 block h-14 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 text-sm font-black uppercase text-slate-900 outline-none focus:border-sky-500 focus:bg-white">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700">Kapasitas Penumpang *</label>
                                        <input type="number" name="seat_capacity" value="{{ old('seat_capacity', $schedule->shuttle->seat_capacity) }}" min="1" required class="mt-2 block h-14 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 text-sm font-medium text-slate-900 outline-none focus:border-sky-500 focus:bg-white">
                                    </div>
                                </div>
                            </section>

                            {{-- KELOLA FOTO LAMA (DENGAN TOMBOL HAPUS LANGSUNG DI ATAS GAMBAR) --}}
                            <section class="form-card overflow-hidden rounded-[2rem] border border-slate-200 bg-white p-6 sm:p-7">
                                <h2 class="text-lg font-black text-slate-950 mb-1">Galeri Foto Tersimpan</h2>
                                <p class="text-xs text-slate-400 mb-5">Arahkan kursor ke foto lalu klik tombol silang merah untuk menghapusnya.</p>

                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                                    @forelse($schedule->shuttle->photos ?? [] as $photo)
                                        <div class="group relative aspect-square rounded-2xl overflow-hidden border border-slate-200 bg-slate-50 shadow-sm">
                                            <img src="{{ asset('storage/' . $photo->photo_path) }}" class="w-full h-full object-cover">
                                            <div class="absolute inset-0 bg-slate-950/40 opacity-0 group-hover:opacity-100 transition duration-300"></div>
                                        </div>
                                    @empty
                                        <div class="col-span-full rounded-xl bg-slate-50 p-6 text-center text-xs text-slate-400 border border-dashed border-slate-200">
                                            Belum ada foto yang diunggah untuk unit ini.
                                        </div>
                                    @endforelse
                                </div>
                            </section>

                            {{-- TAMBAH FOTO BARU (DENGAN PREVIEW) --}}
                            <section class="form-card overflow-hidden rounded-[2rem] border border-slate-200 bg-white p-6 sm:p-7" x-data="fileUploadEdit()">
                                <div class="flex items-end justify-between gap-4 mb-4">
                                    <div>
                                        <h2 class="text-lg font-black text-slate-950">Tambah Foto Baru</h2>
                                        <p class="mt-1 text-xs text-slate-400">Pilih beberapa foto sekaligus untuk ditambahkan ke galeri.</p>
                                    </div>
                                    <div>
                                        <input type="file" id="photoInputEdit" name="photos[]" multiple accept="image/*" @change="handleFileSelect" class="hidden">
                                        <label for="photoInputEdit" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-sky-50 text-sky-600 font-bold text-sm cursor-pointer hover:bg-sky-100 transition shadow-sm">
                                            + Pilih Foto
                                        </label>
                                    </div>
                                </div>

                                {{-- Preview Foto Baru --}}
                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4" x-show="files.length > 0" x-cloak>
                                    <template x-for="(item, index) in files" :key="index">
                                        <div class="group relative aspect-square rounded-2xl overflow-hidden border border-sky-200 bg-sky-50 shadow-sm">
                                            <img :src="item.url" class="w-full h-full object-cover">
                                            <button type="button" @click="removeFile(index)" class="absolute top-2 right-2 flex h-7 w-7 items-center justify-center rounded-full bg-red-500 text-white shadow-md hover:bg-red-600 transition">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="w-4 h-4"><path d="M18 6L6 18M6 6l12 12"/></svg>
                                            </button>
                                        </div>
                                    </template>
                                </div>
                            </section>

                            {{-- HARGA & STATUS --}}
                            <section class="form-card overflow-hidden rounded-[2rem] border border-slate-200 bg-white p-6 sm:p-7">
                                <h2 class="text-lg font-black text-slate-950 mb-5">Harga & Ketersediaan</h2>
                                <div class="grid gap-5 md:grid-cols-2">
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700">Harga Sewa *</label>
                                        <div class="relative mt-2">
                                            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-sm font-black text-slate-500">Rp</span>
                                            <input type="number" name="price" value="{{ old('price', $schedule->price) }}" min="0" step="1000" required class="block h-14 w-full rounded-2xl border border-slate-200 bg-slate-50 py-3 pl-12 pr-4 text-sm font-medium text-slate-900 outline-none focus:border-sky-500 focus:bg-white">
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700">Status Ketersediaan *</label>
                                        <select name="is_available" required class="mt-2 block h-14 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 text-sm font-medium text-slate-900 outline-none focus:border-sky-500 focus:bg-white">
                                            <option value="1" {{ old('is_available', $schedule->is_available ? '1' : '0') == '1' ? 'selected' : '' }}>Tersedia — Bisa Dipesan</option>
                                            <option value="0" {{ old('is_available', $schedule->is_available ? '1' : '0') == '0' ? 'selected' : '' }}>Tidak Tersedia / Sedang Disewa</option>
                                        </select>
                                    </div>
                                </div>
                            </section>
                        </div>

                        {{-- RIGHT BUTTONS --}}
                        <div>
                            <div class="sticky top-28 space-y-5">
                                <div class="rounded-[2rem] border border-slate-200 bg-white p-5">
                                    <button type="submit" class="flex w-full items-center justify-center gap-3 rounded-2xl bg-sky-500 px-6 py-4 text-sm font-black text-white shadow-xl shadow-sky-500/20 transition hover:bg-sky-400">
                                        Simpan Perubahan
                                    </button>
                                    <a href="{{ route('admin.dashboard') }}" class="mt-3 flex w-full items-center justify-center rounded-2xl border border-slate-200 px-6 py-4 text-sm font-bold text-slate-500 transition hover:bg-slate-50">
                                        Batal
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        function fileUploadEdit() {
            return {
                files: [],
                handleFileSelect(event) {
                    const selectedFiles = Array.from(event.target.files);
                    if (this.files.length + selectedFiles.length > 8) {
                        alert('Maksimal hanya boleh menambah 8 foto!');
                        event.target.value = '';
                        return;
                    }
                    selectedFiles.forEach(file => {
                        this.files.push({ file: file, url: URL.createObjectURL(file), name: file.name });
                    });
                    this.updateInput();
                },
                removeFile(index) {
                    URL.revokeObjectURL(this.files[index].url);
                    this.files.splice(index, 1);
                    this.updateInput();
                },
                updateInput() {
                    const dataTransfer = new DataTransfer();
                    this.files.forEach(f => dataTransfer.items.add(f.file));
                    document.getElementById('photoInputEdit').files = dataTransfer.files;
                }
            }
        }
    </script>
</body>
</html>