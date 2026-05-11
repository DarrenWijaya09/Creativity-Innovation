@extends('layouts.app')

@section('title', 'Edit Jasa - VEXORA Seller')

@section('content')
<div class="min-h-screen bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-8">

        <!-- ==================== HEADER ==================== -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-8">
            <div>
                <div class="flex items-center gap-2 text-sm text-gray-400 mb-2">
                    <a href="{{ route('seller.dashboard') }}" class="hover:text-primary transition">Dashboard</a>
                    <i class="fas fa-chevron-right text-xs"></i>
                    <a href="{{ route('seller.dashboard') }}" class="hover:text-primary transition">Kelola Jasa</a>
                    <i class="fas fa-chevron-right text-xs"></i>
                    <span class="text-gray-600">Edit Jasa</span>
                </div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">Edit Jasa</h1>
                <p class="text-gray-500 mt-1">Perbarui informasi jasa Anda agar lebih menarik pelanggan</p>
            </div>
        </div>

        <!-- ==================== UNSAVED CHANGES INDICATOR ==================== -->
        <div id="unsavedIndicator" class="fixed bottom-6 right-6 z-50 bg-yellow-500 text-white px-4 py-2 rounded-full text-sm font-medium shadow-lg flex items-center gap-2 hidden transition-all">
            <i class="fas fa-exclamation-triangle"></i>
            <span>Perubahan belum disimpan</span>
        </div>

        <!-- ==================== MAIN FORM ==================== -->
        <form id="editServiceForm" action="{{ route('services.update', $service->slug) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            @csrf
            @method('PUT')

            <!-- Hidden Status Input -->
            <input type="hidden" name="status" id="serviceStatus" value="{{ old('status', $service->status) }}">

            <!-- LEFT COLUMN: Main Edit Form -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Thumbnail Upload Card -->
                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-100">
                        <h2 class="text-lg font-bold text-gray-900">Thumbnail Jasa</h2>
                        <p class="text-sm text-gray-500 mt-0.5">Gambar utama akan ditampilkan di halaman pencarian</p>
                    </div>
                    <div class="p-6">
                        <div class="flex flex-col md:flex-row gap-6">
                            <!-- Preview Image -->
                            <div class="relative group">
                                <img id="thumbnailPreview"
                                     src="{{ $service->image ? asset('storage/' . $service->image) : 'https://placehold.co/400x300/png?text=No+Image' }}"
                                     class="w-48 h-32 rounded-xl object-cover shadow-sm">
                                <div class="absolute inset-0 bg-black/50 rounded-xl opacity-0 group-hover:opacity-100 transition flex items-center justify-center gap-2">
                                    <label for="imageUpload" class="p-2 bg-white rounded-lg text-gray-700 hover:text-primary transition cursor-pointer">
                                        <i class="fas fa-edit"></i>
                                    </label>
                                    <button type="button" id="removeImageBtn" class="p-2 bg-white rounded-lg text-red-500 hover:text-red-600 transition">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- Upload Area -->
                            <div class="flex-1 border-2 border-dashed border-gray-200 rounded-xl p-4 text-center hover:border-primary/50 transition cursor-pointer">
                                <input type="file" name="image" id="imageUpload" class="hidden" accept="image/*">
                                <label for="imageUpload" class="cursor-pointer block">
                                    <i class="fas fa-cloud-upload-alt text-gray-400 text-2xl mb-2"></i>
                                    <p class="text-sm font-medium text-gray-700">Ganti gambar</p>
                                    <p class="text-xs text-gray-400 mt-1">PNG, JPG up to 5MB</p>
                                </label>
                            </div>
                        </div>
                        @error('image')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Basic Info Card -->
                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-100">
                        <h2 class="text-lg font-bold text-gray-900">Informasi Dasar</h2>
                        <p class="text-sm text-gray-500 mt-0.5">Informasi utama jasa Anda</p>
                    </div>
                    <div class="p-6 space-y-5">
                        <!-- Judul Jasa -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Judul Jasa <span class="text-red-500">*</span></label>
                            <input type="text" name="title" id="titleInput" value="{{ old('title', $service->title) }}"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-transparent @error('title') border-red-500 @enderror">
                            <div class="flex justify-between items-center mt-1">
                                <p class="text-xs text-gray-400">Buat judul yang jelas dan menarik</p>
                                <p class="text-xs text-gray-400"><span id="titleCounter">{{ strlen(old('title', $service->title)) }}</span>/100</p>
                            </div>
                            @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <!-- Kategori -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Kategori <span class="text-red-500">*</span></label>
                                <select name="category" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 bg-white @error('category') border-red-500 @enderror">
                                    <option value="les_privat" {{ old('category', $service->category) == 'les_privat' ? 'selected' : '' }}>Les Privat</option>
                                    <option value="desain_kreatif" {{ old('category', $service->category) == 'desain_kreatif' ? 'selected' : '' }}>Desain & Kreatif</option>
                                    <option value="teknologi_it" {{ old('category', $service->category) == 'teknologi_it' ? 'selected' : '' }}>Teknologi & IT</option>
                                    <option value="perbaikan_rumah" {{ old('category', $service->category) == 'perbaikan_rumah' ? 'selected' : '' }}>Perbaikan Rumah</option>
                                </select>
                                @error('category')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- Harga -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Harga <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">Rp</span>
                                    <input type="number" name="price" id="priceInput" value="{{ old('price', $service->price) }}"
                                           class="w-full pl-8 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-transparent @error('price') border-red-500 @enderror">
                                </div>
                                <p class="text-xs text-gray-400 mt-1">Harga per sesi / per proyek</p>
                                @error('price')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Tipe Layanan -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Layanan</label>
                            <div class="flex gap-3">
                                <label class="flex items-center gap-2 px-4 py-2 bg-gray-50 rounded-xl cursor-pointer has-[:checked]:bg-primary/10 has-[:checked]:border-primary has-[:checked]:text-primary">
                                    <input type="radio" name="type" value="online" {{ old('type', $service->type) == 'online' ? 'checked' : '' }} class="hidden">
                                    <i class="fas fa-globe"></i>
                                    <span class="text-sm">Online</span>
                                </label>
                                <label class="flex items-center gap-2 px-4 py-2 bg-gray-50 rounded-xl cursor-pointer has-[:checked]:bg-primary/10 has-[:checked]:border-primary">
                                    <input type="radio" name="type" value="offline" {{ old('type', $service->type) == 'offline' ? 'checked' : '' }} class="hidden">
                                    <i class="fas fa-building"></i>
                                    <span class="text-sm">Offline</span>
                                </label>
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi Jasa <span class="text-red-500">*</span></label>
                            <textarea name="description" id="descInput" rows="6"
                                      class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-transparent resize-none @error('description') border-red-500 @enderror">{{ old('description', $service->description) }}</textarea>
                            <div class="flex justify-between items-center mt-1">
                                <p class="text-xs text-gray-400">Minimal 50 karakter</p>
                                <p class="text-xs text-gray-400"><span id="descCounter">{{ strlen(old('description', $service->description)) }}</span>/1000</p>
                            </div>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Service Settings Card -->
                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-100">
                        <h2 class="text-lg font-bold text-gray-900">Pengaturan Layanan</h2>
                        <p class="text-sm text-gray-500 mt-0.5">Estimasi dan revisi</p>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Estimasi Pengerjaan</label>
                                <select name="duration" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 bg-white">
                                    <option value="1-2_hari" {{ old('duration', $service->duration) == '1-2_hari' ? 'selected' : '' }}>1-2 hari kerja</option>
                                    <option value="3-5_hari" {{ old('duration', $service->duration) == '3-5_hari' ? 'selected' : '' }}>3-5 hari kerja</option>
                                    <option value="1_minggu" {{ old('duration', $service->duration) == '1_minggu' ? 'selected' : '' }}>1 minggu</option>
                                    <option value="2_minggu" {{ old('duration', $service->duration) == '2_minggu' ? 'selected' : '' }}>2 minggu</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Jumlah Revisi</label>
                                <select name="revision" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 bg-white">
                                    <option value="1x" {{ old('revision', $service->revision) == '1x' ? 'selected' : '' }}>1x revisi</option>
                                    <option value="2x" {{ old('revision', $service->revision) == '2x' ? 'selected' : '' }}>Maksimal 2x</option>
                                    <option value="3x" {{ old('revision', $service->revision) == '3x' ? 'selected' : '' }}>3x revisi</option>
                                    <option value="unlimited" {{ old('revision', $service->revision) == 'unlimited' ? 'selected' : '' }}>Revisi tak terbatas</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Danger Zone -->
                <div class="bg-red-50/50 rounded-3xl border border-red-200 overflow-hidden">
                    <div class="px-6 py-5">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <div>
                                <h3 class="font-semibold text-red-700">Danger Zone</h3>
                                <p class="text-sm text-red-600/70 mt-0.5">Tindakan ini tidak dapat dibatalkan</p>
                            </div>
                            <div class="flex gap-3">
                                <button type="button" id="hideServiceBtn" class="px-4 py-2 bg-white border border-red-300 text-red-600 text-sm font-medium rounded-xl hover:bg-red-50 transition">
                                    <i class="fas fa-eye-slash mr-2"></i> Sembunyikan Jasa
                                </button>
                                <button type="button" id="deleteServiceBtn" class="px-4 py-2 bg-red-500 text-white text-sm font-medium rounded-xl hover:bg-red-600 transition">
                                    <i class="fas fa-trash-alt mr-2"></i> Hapus Jasa
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 pt-4">
                    <button type="button" id="draftBtn" class="px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-xl hover:bg-gray-50 transition">
                        <i class="fas fa-save mr-2"></i> Simpan Draft
                    </button>
                    <button type="button" id="previewBtn" class="px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-xl hover:bg-gray-50 transition">
                        <i class="fas fa-eye mr-2"></i> Preview
                    </button>
                    <button type="submit" id="publishBtn" class="px-6 py-3 bg-primary text-white font-medium rounded-xl hover:bg-primary/90 transition shadow-sm">
                        <i class="fas fa-cloud-upload-alt mr-2"></i> Update & Publish
                    </button>
                </div>

            </div>

            <!-- RIGHT COLUMN: Sticky Sidebar -->
            <div class="lg:col-span-1 space-y-5">

                <!-- Status Card -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 sticky top-24">
                    <h3 class="font-semibold text-gray-900 mb-4">Status Jasa</h3>
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full
                            {{ $service->status == 'published' ? 'bg-green-500' : ($service->status == 'draft' ? 'bg-yellow-500' : 'bg-gray-400') }}"></span>
                        <span class="text-sm font-medium text-gray-700 capitalize">{{ $service->status }}</span>
                        <span class="text-xs text-gray-400 ml-auto">Terakhir update: {{ $service->updated_at->diffForHumans() }}</span>
                    </div>
                </div>

                <!-- Quick Stats Card -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                    <h3 class="font-semibold text-gray-900 mb-4">Statistik Cepat</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">Total Dilihat</span>
                            <span class="font-semibold text-gray-900">{{ number_format($service->views ?? 0) }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">Total Klik</span>
                            <span class="font-semibold text-gray-900">{{ number_format($service->clicks ?? 0) }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">Total Pesanan</span>
                            <span class="font-semibold text-gray-900">{{ number_format($service->orders_count ?? 0) }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">Rating</span>
                            <div class="flex items-center gap-1">
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <span class="font-semibold text-gray-900">{{ number_format($service->rating ?? 0, 1) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Live Preview Card -->
                <div class="bg-gradient-to-br from-gray-50 to-white rounded-2xl border border-gray-100 p-5">
                    <h3 class="font-semibold text-gray-900 mb-3">Live Preview</h3>
                    <div class="bg-white rounded-xl border border-gray-100 p-3">
                        <img id="previewImage" src="{{ $service->image ? asset('storage/' . $service->image) : 'https://placehold.co/400x300/png?text=No+Image' }}" class="w-full h-24 rounded-lg object-cover mb-3">
                        <p id="previewTitle" class="font-medium text-gray-800 text-sm truncate">{{ $service->title }}</p>
                        <div class="flex items-center gap-1 mt-1">
                            <i class="fas fa-star text-yellow-400 text-xs"></i>
                            <span class="text-xs font-semibold">{{ number_format($service->rating ?? 0, 1) }}</span>
                            <span class="text-xs text-gray-400">({{ number_format($service->orders_count ?? 0) }})</span>
                        </div>
                        <p id="previewPrice" class="text-primary font-bold text-sm mt-2">Rp{{ number_format($service->price, 0, ',', '.') }}</p>
                        <p class="text-xs text-gray-400 mt-1">{{ optional($service->provider)->name ?? 'Seller Name' }}</p>
                    </div>
                </div>

                <!-- SEO Preview Card -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                    <h3 class="font-semibold text-gray-900 mb-3">SEO Preview</h3>
                    <div class="space-y-2">
                        <p class="text-primary text-sm font-medium truncate">vexora.com/jasa/{{ Str::slug($service->title) }}</p>
                        <p id="seoTitle" class="text-lg font-medium text-gray-800 truncate">{{ $service->title }}</p>
                        <p id="seoDesc" class="text-xs text-gray-400 line-clamp-2">{{ Str::limit($service->description, 120) }}</p>
                    </div>
                </div>

                <!-- Tips Card -->
                <div class="bg-blue-50 rounded-2xl border border-blue-100 p-5">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-lightbulb text-primary text-lg"></i>
                        <div>
                            <h3 class="font-semibold text-gray-800 text-sm">Tips Optimasi</h3>
                            <ul class="mt-2 space-y-1 text-xs text-gray-600">
                                <li class="flex items-center gap-1"><i class="fas fa-check-circle text-green-500 text-xs"></i> Judul yang baik meningkatkan klik hingga 40%</li>
                                <li class="flex items-center gap-1"><i class="fas fa-check-circle text-gray-300 text-xs"></i> Gunakan gambar berkualitas tinggi</li>
                                <li class="flex items-center gap-1"><i class="fas fa-check-circle text-gray-300 text-xs"></i> Deskripsi yang detail membangun kepercayaan</li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // DOM Elements
    const form = document.getElementById('editServiceForm');
    const titleInput = document.getElementById('titleInput');
    const priceInput = document.getElementById('priceInput');
    const descInput = document.getElementById('descInput');
    const previewTitle = document.getElementById('previewTitle');
    const previewPrice = document.getElementById('previewPrice');
    const seoTitle = document.getElementById('seoTitle');
    const seoDesc = document.getElementById('seoDesc');
    const titleCounter = document.getElementById('titleCounter');
    const descCounter = document.getElementById('descCounter');
    const thumbnailPreview = document.getElementById('thumbnailPreview');
    const previewImage = document.getElementById('previewImage');
    const imageUpload = document.getElementById('imageUpload');
    const removeImageBtn = document.getElementById('removeImageBtn');
    const draftBtn = document.getElementById('draftBtn');
    const publishBtn = document.getElementById('publishBtn');
    const hideServiceBtn = document.getElementById('hideServiceBtn');
    const deleteServiceBtn = document.getElementById('deleteServiceBtn');
    const statusInput = document.getElementById('serviceStatus');

    let unsavedTimeout;
    let isDraftSaved = false;

    // Show unsaved indicator
    function showUnsavedIndicator() {
        const indicator = document.getElementById('unsavedIndicator');
        if (!isDraftSaved) {
            indicator.classList.remove('hidden');
            clearTimeout(unsavedTimeout);
            unsavedTimeout = setTimeout(() => {
                indicator.classList.add('hidden');
            }, 3000);
        }
    }

    // Update previews
    function updatePreviews() {
        const title = titleInput.value;
        const price = parseInt(priceInput.value) || 0;
        const description = descInput.value;

        previewTitle.textContent = title || 'Judul jasa Anda';
        seoTitle.textContent = title || 'Judul jasa Anda';
        previewPrice.textContent = `Rp${price.toLocaleString('id-ID')}`;
        seoDesc.textContent = description.substring(0, 120) + (description.length > 120 ? '...' : '');
        titleCounter.textContent = title.length;
        descCounter.textContent = description.length;
    }

    // Set status and submit
    function setStatusAndSubmit(status) {
        statusInput.value = status;
        form.submit();
    }

    // Event Listeners
    titleInput.addEventListener('input', () => {
        updatePreviews();
        showUnsavedIndicator();
    });

    priceInput.addEventListener('input', () => {
        updatePreviews();
        showUnsavedIndicator();
    });

    descInput.addEventListener('input', () => {
        updatePreviews();
        showUnsavedIndicator();
    });

    // Image upload preview
    imageUpload.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (event) => {
                thumbnailPreview.src = event.target.result;
                previewImage.src = event.target.result;
                showUnsavedIndicator();
            };
            reader.readAsDataURL(file);
        }
    });

    // Remove image
    removeImageBtn.addEventListener('click', () => {
        thumbnailPreview.src = 'https://placehold.co/400x300/png?text=No+Image';
        previewImage.src = 'https://placehold.co/400x300/png?text=No+Image';
        imageUpload.value = '';
        showUnsavedIndicator();
    });

    // Draft button
    draftBtn.addEventListener('click', () => {
        isDraftSaved = true;
        setStatusAndSubmit('draft');
    });

    // Publish button
    publishBtn.addEventListener('click', (e) => {
        e.preventDefault();
        setStatusAndSubmit('published');
    });

    // Hide service button
    hideServiceBtn.addEventListener('click', () => {
        if (confirm('Apakah Anda yakin ingin menyembunyikan jasa ini?')) {
            setStatusAndSubmit('hidden');
        }
    });

    // Delete service button
    deleteServiceBtn.addEventListener('click', () => {
        if (confirm('Apakah Anda yakin ingin menghapus jasa ini? Tindakan ini tidak dapat dibatalkan.')) {
            const deleteForm = document.createElement('form');
            deleteForm.method = 'POST';
            deleteForm.action = '{{ route("services.destroy", $service->slug) }}';
            deleteForm.innerHTML = `
                @csrf
                @method('DELETE')
            `;
            document.body.appendChild(deleteForm);
            deleteForm.submit();
        }
    });

    // Preview button - open in new tab
    previewBtn.addEventListener('click', () => {
        const slug = '{{ Str::slug($service->title) }}';
        window.open('{{ url("/catalog") }}/' + slug, '_blank');
    });

    // Initial update
    updatePreviews();
</script>
@endpush

@push('styles')
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    input:focus, textarea:focus, select:focus {
        transition: all 0.2s ease;
    }
</style>
@endpush

@endsection
