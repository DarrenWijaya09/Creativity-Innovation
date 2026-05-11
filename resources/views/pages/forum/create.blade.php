@extends('layouts.app')

@section('title', 'Buat Diskusi Baru - Forum VEXORA')

@section('content')
    <div class="animate-fade-in max-w-3xl mx-auto">

        <!-- Back Button -->
        <a href="{{ route('forum.index') }}"
            class="inline-flex items-center gap-2 text-gray-500 hover:text-primary mb-6 transition">
            <i class="fas fa-arrow-left"></i> Kembali ke Forum
        </a>

        <!-- Create Thread Form -->
        <div class="bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-gray-100">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center">
                    <i class="fas fa-pen text-primary text-xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Buat Diskusi Baru</h1>
                    <p class="text-gray-500 text-sm">Bagikan pertanyaan atau insight seputar teknologi</p>
                </div>
            </div>

            <form action="{{ route('forum.store') }}" method="POST" id="createThreadForm">
                @csrf

                <!-- Title -->
                <div class="mb-5">
                    <label class="block text-gray-700 font-medium mb-2">
                        Judul Diskusi <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" value="{{ old('title') }}" maxlength="255"
                        placeholder="Contoh: Best practices untuk deployment Laravel di production?"
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-transparent transition @error('title') border-red-500 @enderror">
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @else
                        <p class="text-xs text-gray-400 mt-1">Buat judul yang jelas dan spesifik agar mudah ditemukan (maksimal
                            255 karakter)</p>
                    @enderror
                </div>

                <!-- Category -->
                <div class="mb-5">
                    <label class="block text-gray-700 font-medium mb-2">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select name="category_id"
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-transparent bg-white transition @error('category_id') border-red-500 @enderror">
                        <option value="">Pilih kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @endif
                    </div>

                    <!-- Content -->
                    <div class="mb-5">
                        <label class="block text-gray-700 font-medium mb-2">
                            Isi Diskusi <span class="text-red-500">*</span>
                        </label>
                        <div
                            class="border border-gray-200 rounded-xl overflow-hidden transition @error('content') border-red-500 @enderror">
                            <div class="bg-gray-50 px-4 py-2 border-b border-gray-200 flex gap-3">
                                <button type="button" class="text-gray-500 hover:text-primary transition"><i
                                        class="fas fa-bold"></i></button>
                                <button type="button" class="text-gray-500 hover:text-primary transition"><i
                                        class="fas fa-italic"></i></button>
                                <button type="button" class="text-gray-500 hover:text-primary transition"><i
                                        class="fas fa-link"></i></button>
                                <button type="button" class="text-gray-500 hover:text-primary transition"><i
                                        class="fas fa-code"></i></button>
                                <button type="button" class="text-gray-500 hover:text-primary transition"><i
                                        class="fas fa-list-ul"></i></button>
                            </div>
                            <textarea name="content" rows="10"
                                placeholder="Jelaskan pertanyaan atau topik diskusi Anda secara detail...&#10;&#10;Contoh:&#10;- Apa yang sudah Anda coba?&#10;- Apa yang diharapkan?&#10;- Lampirkan kode atau screenshot jika perlu"
                                class="w-full px-4 py-3 focus:outline-none resize-none transition">{{ old('content') }}</textarea>
                        </div>
                        @error('content')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @else
                            <p class="text-xs text-gray-400 mt-1">Minimal 20 karakter. Gunakan format teks sederhana. Jangan
                                sertakan informasi pribadi.</p>
                        @enderror
                    </div>

                    <!-- Tags (Optional) - Future Feature -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-2">Tag (Opsional)</label>
                        <input type="text" name="tags" value="{{ old('tags') }}"
                            placeholder="laravel, deployment, production, best-practices"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-transparent transition">
                        <p class="text-xs text-gray-400 mt-1">Pisahkan tag dengan koma. Maksimal 5 tag.</p>
                    </div>

                    <!-- Auth Info -->
                    <div class="mb-4 p-3 bg-gray-50 rounded-xl">
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <i class="fas fa-user-circle text-primary"></i>
                            <span>Diskusi akan dipublikasikan menggunakan akun:
                                <strong>{{ auth()->user()->name }}</strong></span>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex gap-3 pt-3 border-t border-gray-100">
                        <button type="submit" id="submitBtn"
                            class="bg-primary hover:bg-primary/90 text-white font-semibold px-6 py-2.5 rounded-xl transition shadow-sm focus:outline-none focus:ring-2 focus:ring-primary/50">
                            <i class="fas fa-paper-plane"></i> Publikasikan
                        </button>
                        <a href="{{ route('forum.index') }}"
                            class="px-6 py-2.5 border border-gray-300 text-gray-600 font-medium rounded-xl hover:bg-gray-50 transition">
                            Batal
                        </a>
                    </div>

                    <p class="text-xs text-gray-400 mt-4">
                        <i class="fas fa-info-circle"></i> Dengan mempublikasikan diskusi, Anda menyetujui
                        <a href="#" class="text-primary hover:underline">Panduan Komunitas</a> dan <a href="#"
                            class="text-primary hover:underline">Kebijakan Privasi</a> VEXORA.
                    </p>
                </form>
            </div>

            <!-- Guidelines Card -->
            <div class="mt-6 bg-blue-50 rounded-xl p-4 border border-blue-100">
                <div class="flex gap-3">
                    <i class="fas fa-lightbulb text-primary text-xl"></i>
                    <div>
                        <h4 class="font-semibold text-gray-800">Panduan Membuat Diskusi yang Baik</h4>
                        <ul class="text-xs text-gray-600 mt-1 space-y-1">
                            <li class="flex items-center gap-1">✓ Gunakan judul yang deskriptif dan spesifik</li>
                            <li class="flex items-center gap-1">✓ Jelaskan masalah atau topik dengan detail</li>
                            <li class="flex items-center gap-1">✓ Sertakan kode atau screenshot jika perlu</li>
                            <li class="flex items-center gap-1">✓ Hindari bahasa yang tidak sopan atau provokatif</li>
                            <li class="flex items-center gap-1">✓ Cek terlebih dahulu apakah topik serupa sudah ada</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>

        @push('styles')
            <style>
                .animate-fade-in {
                    animation: fadeIn 0.5s ease-out;
                }

                @keyframes fadeIn {
                    from {
                        opacity: 0;
                        transform: translateY(10px);
                    }

                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }

                textarea:focus,
                input:focus,
                select:focus {
                    transition: all 0.2s ease;
                }
            </style>
        @endpush

        @push('scripts')
            <script>
                // Prevent double form submission
                const form = document.getElementById('createThreadForm');
                const submitBtn = document.getElementById('submitBtn');

                if (form && submitBtn) {
                    form.addEventListener('submit', function() {
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mempublikasikan...';
                    });
                }
            </script>
        @endpush

    @endsection
