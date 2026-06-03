@extends('layouts.app')

@section('title', 'Mulai Jadi Penyedia - VEXORA')

@section('content')
    <div class="min-h-screen py-12 md:py-16 lg:py-20 bg-white dark:bg-gray-950">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-start">

                <!-- LEFT SIDE: Branding & Context -->
                <div class="sticky top-28 space-y-6">
                    <div class="space-y-3">
                        <div class="inline-flex items-center gap-2 px-3 py-1 bg-primary/10 dark:bg-primary/20 rounded-full">
                            <i class="fas fa-store text-primary text-sm"></i>
                            <span class="text-primary text-xs font-semibold tracking-wide">VEXORA PROVIDER</span>
                        </div>
                        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white leading-tight">
                            Mulai Jadi Penyedia<br>di <span class="text-primary">VEXORA</span>
                        </h1>
                        <p class="text-gray-500 dark:text-gray-400 text-base leading-relaxed">
                            Bergabunglah dengan ribuan penyedia jasa terpercaya dan kembangkan bisnis Anda bersama platform
                            jasa terbaik di Indonesia.
                        </p>
                    </div>

                    <div class="hidden md:block bg-gradient-to-br from-primary/5 to-blue-50 dark:from-primary/10 dark:to-blue-950/20 rounded-3xl p-6 text-center">
                        <i class="fas fa-chalkboard-user text-primary text-5xl mb-3"></i>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">"Lebih dari 10.000+ penyedia telah bergabung dan berkembang bersama
                            VEXORA"</p>
                    </div>

                    <div class="space-y-4 pt-4">
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i class="fas fa-check text-green-600 dark:text-green-400 text-xs"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800 dark:text-gray-200">Jangkau lebih banyak pelanggan</h3>
                                <p class="text-gray-500 dark:text-gray-400 text-sm">Akses ke ribuan pengguna aktif yang mencari jasa setiap hari</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i class="fas fa-check text-green-600 dark:text-green-400 text-xs"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800 dark:text-gray-200">Kelola jasa dengan mudah</h3>
                                <p class="text-gray-500 dark:text-gray-400 text-sm">Dashboard intuitif untuk mengelola layanan, pesanan, dan jadwal</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i class="fas fa-check text-green-600 dark:text-green-400 text-xs"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800 dark:text-gray-200">Bangun reputasi profesional</h3>
                                <p class="text-gray-500 dark:text-gray-400 text-sm">Dapatkan rating dan ulasan dari pelanggan untuk meningkatkan kredibilitas</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-4 pt-4 border-t border-gray-100 dark:border-slate-700">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-shield-alt text-primary text-sm"></i>
                            <span class="text-xs text-gray-500 dark:text-gray-400">Pembayaran Aman</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fas fa-headset text-primary text-sm"></i>
                            <span class="text-xs text-gray-500 dark:text-gray-400">Dukungan 24/7</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fas fa-chart-line text-primary text-sm"></i>
                            <span class="text-xs text-gray-500 dark:text-gray-400">Analitik Lengkap</span>
                        </div>
                    </div>
                </div>

                <!-- RIGHT SIDE: Form Card -->
                <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-xl dark:shadow-black/30 border border-gray-100 dark:border-slate-700 overflow-hidden">
                    <div class="p-6 md:p-8">
                        <!-- Single Step Indicator -->
                        <div class="mb-6">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-primary">Pendaftaran Penyedia</span>
                                <span class="text-xs text-gray-400 dark:text-gray-500">Lengkapi data diri Anda</span>
                            </div>
                            <div class="w-full bg-gray-100 dark:bg-slate-800 rounded-full h-1.5">
                                <div class="bg-primary rounded-full h-1.5 w-full"></div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Informasi Penyedia</h2>
                            <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Isi detail untuk memulai berjualan di VEXORA</p>
                        </div>

                        <form action="{{ route('provider.store') }}" method="POST" class="space-y-5">
                            @csrf

                            <!-- Nama Jasa / Nama Bisnis -->
                            <div>
                                <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1.5">
                                    Nama Jasa / Nama Bisnis <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="name" value="{{ old('name') }}" required
                                    placeholder="Contoh: Les Privat Bunda Sari, Desain Studio ID"
                                    class="w-full px-4 py-3 border border-gray-200 dark:border-slate-700 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-transparent transition bg-white dark:bg-slate-800 text-gray-900 dark:text-white placeholder:text-gray-400 dark:placeholder:text-gray-500 @error('name') border-red-500 @enderror">
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @else
                                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Nama ini akan ditampilkan ke pelanggan</p>
                                @enderror
                            </div>

                            <!-- Kategori Jasa -->
                            <div>
                                <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1.5">
                                    Kategori Jasa <span class="text-red-500">*</span>
                                </label>
                                <select name="category" required
                                    class="w-full px-4 py-3 border border-gray-200 dark:border-slate-700 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 bg-white dark:bg-slate-800 text-gray-900 dark:text-white @error('category') border-red-500 @enderror">
                                    <option value="" disabled {{ old('category') ? '' : 'selected' }}>Pilih kategori jasa</option>
                                    <option value="les_private" {{ old('category') == 'les_private' ? 'selected' : '' }}>Les Privat</option>
                                    <option value="desain_kreatif" {{ old('category') == 'desain_kreatif' ? 'selected' : '' }}>Desain & Kreatif</option>
                                    <option value="teknologi_it" {{ old('category') == 'teknologi_it' ? 'selected' : '' }}>Teknologi & IT</option>
                                    <option value="perbaikan_rumah" {{ old('category') == 'perbaikan_rumah' ? 'selected' : '' }}>Perbaikan Rumah</option>
                                    <option value="kesehatan_fitness" {{ old('category') == 'kesehatan_fitness' ? 'selected' : '' }}>Kesehatan & Fitness</option>
                                    <option value="jasa_harian" {{ old('category') == 'jasa_harian' ? 'selected' : '' }}>Jasa Harian</option>
                                    <option value="fotografi" {{ old('category') == 'fotografi' ? 'selected' : '' }}>Fotografi & Video</option>
                                    <option value="konsultan" {{ old('category') == 'konsultan' ? 'selected' : '' }}>Konsultan & Bisnis</option>
                                </select>
                                @error('category')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Deskripsi Singkat (bio) -->
                            <div>
                                <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1.5">
                                    Deskripsi Singkat <span class="text-red-500">*</span>
                                </label>
                                <textarea name="bio" rows="4" required
                                    placeholder="Ceritakan layanan yang Anda tawarkan, keahlian, dan pengalaman Anda..."
                                    class="w-full px-4 py-3 border border-gray-200 dark:border-slate-700 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 resize-none bg-white dark:bg-slate-800 text-gray-900 dark:text-white placeholder:text-gray-400 dark:placeholder:text-gray-500 @error('bio') border-red-500 @enderror">{{ old('bio') }}</textarea>
                                @error('bio')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @else
                                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Minimal 20 karakter. Jelaskan yang membuat jasa Anda unik</p>
                                @enderror
                            </div>

                            <!-- Lokasi -->
                            <div>
                                <label class="block text-gray-700 dark:text-gray-300 font-medium mb-1.5">
                                    Lokasi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="location" value="{{ old('location') }}" required
                                    placeholder="Contoh: Jakarta Selatan, Bandung, Online"
                                    class="w-full px-4 py-3 border border-gray-200 dark:border-slate-700 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-transparent transition bg-white dark:bg-slate-800 text-gray-900 dark:text-white placeholder:text-gray-400 dark:placeholder:text-gray-500 @error('location') border-red-500 @enderror">
                                @error('location')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @else
                                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Kota atau wilayah tempat Anda melayani jasa</p>
                                @enderror
                            </div>

                            <!-- Tipe Layanan (type) -->
                            <div>
                                <label class="block text-gray-700 dark:text-gray-300 font-medium mb-2">
                                    Tipe Layanan <span class="text-red-500">*</span>
                                </label>
                                <div class="flex flex-col sm:flex-row gap-4">
                                    <label class="flex items-center gap-3 p-3 border border-gray-200 dark:border-slate-700 rounded-xl cursor-pointer hover:bg-gray-50 dark:hover:bg-slate-800 transition flex-1 @error('type') border-red-500 @enderror">
                                        <input type="radio" name="type" value="online"
                                            {{ old('type') == 'online' ? 'checked' : '' }}
                                            class="text-primary focus:ring-primary dark:bg-slate-800">
                                        <div>
                                            <span class="font-medium text-gray-800 dark:text-gray-200 block">Online</span>
                                            <span class="text-xs text-gray-400 dark:text-gray-500">Layanan via video call, chat, atau digital</span>
                                        </div>
                                    </label>
                                    <label class="flex items-center gap-3 p-3 border border-gray-200 dark:border-slate-700 rounded-xl cursor-pointer hover:bg-gray-50 dark:hover:bg-slate-800 transition flex-1 @error('type') border-red-500 @enderror">
                                        <input type="radio" name="type" value="offline"
                                            {{ old('type') == 'offline' ? 'checked' : '' }}
                                            class="text-primary focus:ring-primary dark:bg-slate-800">
                                        <div>
                                            <span class="font-medium text-gray-800 dark:text-gray-200 block">Offline</span>
                                            <span class="text-xs text-gray-400 dark:text-gray-500">Layanan tatap muka di lokasi pelanggan</span>
                                        </div>
                                    </label>
                                </div>
                                @error('type')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Terms & Agreement -->
                            <div class="pt-2">
                                <label class="flex items-start gap-3 cursor-pointer">
                                    <input type="checkbox" name="terms" required
                                        {{ old('terms') ? 'checked' : '' }}
                                        class="mt-0.5 text-primary focus:ring-primary rounded border-gray-300 dark:border-slate-600 dark:bg-slate-800">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">
                                        Saya menyetujui
                                        <a href="{{ route('syarat-ketentuan') }}" target="_blank" rel="noopener noreferrer" class="text-primary hover:underline">
                                            Syarat & Ketentuan Penyedia
                                        </a>
                                        dan
                                        <a href="{{ route('syarat-ketentuan') }}" target="_blank" rel="noopener noreferrer" class="text-primary hover:underline">
                                            Kebijakan Privasi
                                        </a> VEXORA
                                    </span>
                                </label>
                                @error('terms')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit"
                                class="w-full mt-4 bg-primary hover:bg-primary/90 text-white font-semibold py-3.5 rounded-xl transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                Mulai Jadi Penyedia
                                <i class="fas fa-arrow-right ml-2 text-sm"></i>
                            </button>

                            <p class="text-center text-xs text-gray-400 dark:text-gray-500 pt-2">
                                <i class="fas fa-lock text-xs"></i> Data Anda aman dan kami tidak akan membagikannya
                            </p>
                        </form>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12 pt-6 border-t border-gray-100 dark:border-slate-700">
                <p class="text-xs text-gray-400 dark:text-gray-500">
                    Sudah punya akun penyedia?
                    <a href="{{ route('login') }}" class="text-primary font-medium hover:underline">Masuk di sini</a>
                </p>
            </div>

        </div>
    </div>
@endsection

@push('styles')
    <style>
        input:focus,
        textarea:focus,
        select:focus {
            transition: all 0.2s ease;
        }

        input[type="radio"]:checked {
            background-color: #3B82F6;
            border-color: #3B82F6;
        }
    </style>
@endpush

@push('scripts')
    <script>
        const descriptionTextarea = document.querySelector('textarea[name="bio"]');
        if (descriptionTextarea) {
            const helperText = descriptionTextarea.closest('div')?.querySelector('.text-xs:not(.text-red-500)');
            descriptionTextarea.addEventListener('input', function() {
                const length = this.value.length;
                if (helperText && length < 20 && length > 0) {
                    helperText.innerHTML = `Minimal 20 karakter (${length}/20)`;
                    helperText.classList.add('text-orange-500');
                } else if (helperText && length >= 20) {
                    helperText.innerHTML = 'Jelaskan yang membuat jasa Anda unik';
                    helperText.classList.remove('text-orange-500');
                } else if (helperText && length === 0) {
                    helperText.innerHTML = 'Minimal 20 karakter. Jelaskan yang membuat jasa Anda unik';
                    helperText.classList.remove('text-orange-500');
                }
            });
        }
    </script>
@endpush
