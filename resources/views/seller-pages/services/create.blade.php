@extends('layouts.app')

@section('title', 'Tambah Jasa Baru - VEXORA Seller')

@section('content')
    <div class="min-h-screen bg-white py-8 lg:py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <!-- ==================== PAGE HEADER ==================== -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">Tambah Jasa Baru</h1>
                    <p class="text-gray-500 mt-1">Mulai tawarkan layanan Anda kepada pelanggan.</p>
                </div>
                <div class="text-sm text-gray-400">
                    Dashboard / <span class="text-gray-600">Jasa</span> / <span class="text-primary">Tambah</span>
                </div>
            </div>

            <!-- ==================== TWO COLUMN LAYOUT ==================== -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- LEFT/RIGHT COLUMN: MAIN FORM -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

                        <!-- Form Header -->
                        <div class="px-6 py-5 border-b border-gray-100">
                            <h2 class="text-lg font-bold text-gray-900">Informasi Jasa</h2>
                            <p class="text-sm text-gray-500 mt-0.5">Lengkapi detail layanan yang akan Anda tawarkan</p>
                        </div>

                        <!-- Form Content -->
                        <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data"
                            class="p-6 space-y-6" id="serviceForm">
                            @csrf
                            <input type="hidden" name="status" id="serviceStatus" value="draft">

                            <!-- 1. Judul Jasa -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Judul Jasa <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="title" value="{{ old('title') }}"
                                    placeholder="Contoh: Les Matematika untuk SD, SMP, SMA"
                                    class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-transparent @error('title') border-red-500 @enderror">
                                @error('title')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @else
                                    <p class="text-xs text-gray-400 mt-1">Buat judul yang jelas dan mudah dipahami oleh
                                        pelanggan</p>
                                @enderror
                            </div>

                            <!-- 2. Kategori -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Kategori <span class="text-red-500">*</span>
                                </label>
                                <select name="category"
                                    class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 bg-white @error('category') border-red-500 @enderror">
                                    <option value="" disabled {{ old('category') ? '' : 'selected' }}>Pilih kategori
                                        jasa</option>
                                    <option value="les_privat" {{ old('category') == 'les_privat' ? 'selected' : '' }}>Les
                                        Privat</option>
                                    <option value="desain_kreatif"
                                        {{ old('category') == 'desain_kreatif' ? 'selected' : '' }}>Desain & Kreatif
                                    </option>
                                    <option value="teknologi_it" {{ old('category') == 'teknologi_it' ? 'selected' : '' }}>
                                        Teknologi & IT</option>
                                    <option value="perbaikan_rumah"
                                        {{ old('category') == 'perbaikan_rumah' ? 'selected' : '' }}>Perbaikan Rumah
                                    </option>
                                    <option value="kesehatan_fitness"
                                        {{ old('category') == 'kesehatan_fitness' ? 'selected' : '' }}>Kesehatan & Fitness
                                    </option>
                                    <option value="jasa_harian" {{ old('category') == 'jasa_harian' ? 'selected' : '' }}>
                                        Jasa Harian</option>
                                    <option value="fotografi_video"
                                        {{ old('category') == 'fotografi_video' ? 'selected' : '' }}>Fotografi & Video
                                    </option>
                                    <option value="konsultan_bisnis"
                                        {{ old('category') == 'konsultan_bisnis' ? 'selected' : '' }}>Konsultan & Bisnis
                                    </option>
                                </select>
                                @error('category')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- 3. Harga -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Harga <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">Rp</span>
                                    <input type="number" name="price" value="{{ old('price') }}" placeholder="50000"
                                        class="w-full pl-8 pr-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-transparent @error('price') border-red-500 @enderror">
                                </div>
                                @error('price')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @else
                                    <p class="text-xs text-gray-400 mt-1">Harga per sesi / per proyek. Tentukan harga yang
                                        kompetitif.</p>
                                @enderror
                            </div>

                            <!-- 4. Deskripsi Jasa -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Deskripsi Jasa <span class="text-red-500">*</span>
                                </label>
                                <textarea name="description" rows="6"
                                    placeholder="Jelaskan layanan Anda secara detail...&#10;&#10;Contoh:&#10;- Apa yang akan didapatkan pelanggan&#10;- Keahlian dan pengalaman Anda&#10;- Proses pengerjaan"
                                    class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-transparent resize-none @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @else
                                    <div class="flex justify-between items-center mt-1">
                                        <p class="text-xs text-gray-400">Minimal 50 karakter</p>
                                        <p class="text-xs text-gray-400"><span
                                                class="text-primary">{{ strlen(old('description', '')) }}</span>/500</p>
                                    </div>
                                @enderror
                            </div>

                            <!-- 5. Thumbnail / Gambar -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Gambar Jasa
                                </label>
                                <div
                                    class="border-2 border-dashed border-gray-200 rounded-xl p-6 text-center hover:border-primary/50 transition cursor-pointer @error('image') border-red-500 @enderror">
                                    <input type="file" name="image" id="imageUpload" class="hidden" accept="image/*">
                                    <label for="imageUpload" class="cursor-pointer block">
                                        <div
                                            class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                            <i class="fas fa-cloud-upload-alt text-gray-400 text-2xl"></i>
                                        </div>
                                        <p class="text-sm font-medium text-gray-700">Upload gambar</p>
                                        <p class="text-xs text-gray-400 mt-1">PNG, JPG up to 5MB</p>
                                    </label>
                                </div>
                                <!-- Preview area -->
                                <div id="imagePreview" class="hidden mt-3">
                                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                                        <img id="previewImg" src="" alt="Preview"
                                            class="w-12 h-12 rounded-lg object-cover">
                                        <div class="flex-1">
                                            <p id="previewFileName" class="text-sm font-medium text-gray-700">preview.jpg
                                            </p>
                                            <p class="text-xs text-gray-400">File siap diupload</p>
                                        </div>
                                        <button type="button" id="removeImage" class="text-red-500 hover:text-red-600">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </div>
                                @error('image')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status Info Card -->
                            <div class="bg-blue-50 rounded-xl p-4 border border-blue-100">
                                <div class="flex items-start gap-3">
                                    <i class="fas fa-info-circle text-primary text-sm mt-0.5"></i>
                                    <div>
                                        <h3 class="text-sm font-semibold text-gray-800">Informasi Status</h3>
                                        <p class="text-xs text-gray-600 mt-0.5">
                                            Jasa baru akan disimpan sebagai <span
                                                class="font-medium text-primary">Draft</span>.
                                            Anda dapat mengeditnya kapan saja sebelum dipublikasikan.
                                            Jasa belum akan tampil di halaman publik sampai Anda mempublikasikannya.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-gray-100">
                                <button type="submit" onclick="document.getElementById('serviceStatus').value='draft'"
                                    class="submit-btn px-6 py-2.5 border border-gray-300 text-gray-700 font-medium rounded-xl hover:bg-gray-50 transition">

                                    <i class="fas fa-save mr-2"></i>
                                    Simpan Draft

                                </button>
                                <button type="submit"
                                    onclick="document.getElementById('serviceStatus').value='published'"
                                    class="submit-btn px-6 py-2.5 bg-primary text-white font-medium rounded-xl hover:bg-primary/90 transition shadow-sm">

                                    <i class="fas fa-paper-plane mr-2"></i>
                                    Publikasikan Jasa

                                </button>
                            </div>

                        </form>
                    </div>
                </div>

                <!-- RIGHT COLUMN: TIPS PANEL (Sticky) -->
                <div class="lg:col-span-1">
                    <div class="sticky top-24 space-y-6">

                        <!-- Tips Membuat Jasa Bagus -->
                        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                            <div class="flex items-center gap-2 mb-4">
                                <i class="fas fa-lightbulb text-primary text-lg"></i>
                                <h3 class="font-semibold text-gray-900">Tips Membuat Jasa Bagus</h3>
                            </div>
                            <div class="space-y-3">
                                <div class="flex items-start gap-2">
                                    <i class="fas fa-check-circle text-green-500 text-sm mt-0.5"></i>
                                    <div>
                                        <p class="text-sm font-medium text-gray-800">Judul yang jelas</p>
                                        <p class="text-xs text-gray-500">Buat judul spesifik tentang layanan Anda</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-2">
                                    <i class="fas fa-check-circle text-gray-300 text-sm mt-0.5"></i>
                                    <div>
                                        <p class="text-sm font-medium text-gray-400">Deskripsi lengkap</p>
                                        <p class="text-xs text-gray-400">Jelaskan detail dan manfaat layanan</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-2">
                                    <i class="fas fa-check-circle text-gray-300 text-sm mt-0.5"></i>
                                    <div>
                                        <p class="text-sm font-medium text-gray-400">Gambar menarik</p>
                                        <p class="text-xs text-gray-400">Gunakan gambar representatif berkualitas</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Service Preview Mockup -->
                        <div class="bg-gradient-to-br from-gray-50 to-white rounded-2xl border border-gray-100 p-5">
                            <h3 class="font-semibold text-gray-900 mb-3">Preview Jasa</h3>
                            <div class="bg-white rounded-xl border border-gray-100 p-3">
                                <div id="previewImageMockup"
                                    class="w-full h-32 bg-gray-100 rounded-lg flex items-center justify-center mb-3">
                                    <i class="fas fa-image text-gray-300 text-3xl"></i>
                                </div>
                                <p id="previewTitle" class="font-medium text-gray-800 text-sm truncate">Judul jasa Anda
                                    akan muncul di sini</p>
                                <p id="previewCategory" class="text-xs text-gray-400 mt-0.5">Kategori</p>
                                <p id="previewPrice" class="text-primary font-bold text-sm mt-2">Rp0</p>
                            </div>
                            <p class="text-xs text-gray-400 text-center mt-3">Ini adalah tampilan yang akan dilihat
                                pelanggan</p>
                        </div>

                        <!-- Need Help -->
                        <div class="bg-gray-50 rounded-xl p-4 text-center">
                            <i class="fas fa-headset text-primary text-lg mb-2"></i>
                            <h4 class="text-sm font-semibold text-gray-800">Butuh Bantuan?</h4>
                            <p class="text-xs text-gray-500 mt-1">Tim support siap membantu Anda</p>
                            <a href="#"
                                class="inline-block mt-2 text-primary text-xs font-medium hover:underline">Hubungi Support
                                →</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Image upload preview functionality
            const imageInput = document.getElementById('imageUpload');
            const previewContainer = document.getElementById('imagePreview');
            const previewImg = document.getElementById('previewImg');
            const previewFileName = document.getElementById('previewFileName');
            const removeBtn = document.getElementById('removeImage');

            // Preview mockup elements
            const previewTitle = document.getElementById('previewTitle');
            const previewCategory = document.getElementById('previewCategory');
            const previewPrice = document.getElementById('previewPrice');
            const previewImageMockup = document.getElementById('previewImageMockup');

            // Real-time preview update for form fields
            const titleInput = document.querySelector('input[name="title"]');
            const categorySelect = document.querySelector('select[name="category"]');
            const priceInput = document.querySelector('input[name="price"]');

            function updatePreview() {
                if (previewTitle) {
                    previewTitle.textContent = titleInput?.value || 'Judul jasa Anda akan muncul di sini';
                }
                if (previewCategory && categorySelect) {
                    const selectedOption = categorySelect.options[categorySelect.selectedIndex];
                    previewCategory.textContent = selectedOption?.text || 'Kategori';
                }
                if (previewPrice && priceInput) {
                    const price = priceInput.value;
                    previewPrice.textContent = price ? `Rp${parseInt(price).toLocaleString('id-ID')}` : 'Rp0';
                }
            }

            titleInput?.addEventListener('input', updatePreview);
            categorySelect?.addEventListener('change', updatePreview);
            priceInput?.addEventListener('input', updatePreview);

            // Image upload handler
            imageInput?.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        previewImg.src = event.target.result;
                        previewFileName.textContent = file.name;
                        previewContainer.classList.remove('hidden');

                        // Update mockup preview
                        if (previewImageMockup) {
                            previewImageMockup.innerHTML =
                                `<img src="${event.target.result}" class="w-full h-full object-cover rounded-lg">`;
                        }
                    };
                    reader.readAsDataURL(file);
                }
            });

            removeBtn?.addEventListener('click', function() {
                imageInput.value = '';
                previewContainer.classList.add('hidden');
                previewImg.src = '';

                // Reset mockup preview
                if (previewImageMockup) {
                    previewImageMockup.innerHTML = '<i class="fas fa-image text-gray-300 text-3xl"></i>';
                }
            });

            // Initial preview update
            updatePreview();

            const serviceForm = document.getElementById('serviceForm');

            serviceForm?.addEventListener('submit', function() {

                const buttons = document.querySelectorAll('.submit-btn');

                buttons.forEach(button => {

                    button.disabled = true;

                    button.classList.add(
                        'opacity-50',
                        'cursor-not-allowed'
                    );

                });

            });
        </script>
    @endpush

    @push('styles')
        <style>
            input[type="number"]::-webkit-inner-spin-button,
            input[type="number"]::-webkit-outer-spin-button {
                opacity: 1;
            }
        </style>
    @endpush

@endsection
