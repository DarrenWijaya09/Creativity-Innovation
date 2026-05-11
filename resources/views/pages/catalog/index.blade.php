@extends('layouts.app')

@section('title', 'Temukan Layanan Jasa Terbaik - VEXORA')

@section('content')
    <div class="min-h-screen bg-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Page Header -->
            <div class="mb-8">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Temukan Layanan Jasa Terbaik</h1>
                <p class="text-gray-500 mt-2">Jelajahi berbagai layanan profesional sesuai kebutuhan Anda</p>
            </div>

            <!-- Filter + Content Layout -->
            <div class="flex flex-col lg:flex-row gap-8">

                <!-- Left Sidebar (Filters) -->
                <aside class="lg:w-80 flex-shrink-0">
                    <form method="GET" action="{{ route('catalog') }}" class="sticky top-24">
                        <!-- Preserve search query -->
                        @if (request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif

                        <!-- Preserve sorting query -->
                        @if (request('sort'))
                            <input type="hidden" name="sort" value="{{ request('sort') }}">
                        @endif

                        <!-- Preserve rating query -->
                        @if (request('rating'))
                            <input type="hidden" name="rating" value="{{ request('rating') }}">
                        @endif

                        <!-- Preserve price range queries -->
                        @if (request('min_price'))
                            <input type="hidden" name="min_price" value="{{ request('min_price') }}">
                        @endif
                        @if (request('max_price'))
                            <input type="hidden" name="max_price" value="{{ request('max_price') }}">
                        @endif

                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="font-bold text-lg text-gray-900">Filter</h2>
                                <a href="{{ route('catalog') }}" class="text-primary text-sm font-medium hover:underline">
                                    Reset Filter
                                </a>
                            </div>

                            <!-- Category Filter (Checkboxes - Multi-select) -->
                            <div class="mb-6">
                                <h3 class="font-semibold text-gray-800 mb-3">Kategori Jasa</h3>
                                <div class="space-y-2">
                                    @foreach ($categories as $category)
                                        @php
                                            $selectedCategories = request('category', []);
                                            $isChecked =
                                                is_array($selectedCategories) &&
                                                in_array($category, $selectedCategories);
                                        @endphp
                                        <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer">
                                            <input type="checkbox" name="category[]" value="{{ $category }}"
                                                {{ $isChecked ? 'checked' : '' }}
                                                class="rounded text-primary focus:ring-primary">
                                            <span>{{ $category }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Rating Filter -->
                            <div class="mb-6">
                                <h3 class="font-semibold text-gray-800 mb-3">Rating</h3>
                                <div class="space-y-2">
                                    <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer">
                                        <input type="radio" name="rating" value="4"
                                            {{ request('rating') == '4' ? 'checked' : '' }}
                                            class="text-primary focus:ring-primary" onclick="this.form.submit()">
                                        <span class="flex items-center">⭐ 4 ke atas</span>
                                    </label>
                                    <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer">
                                        <input type="radio" name="rating" value="3"
                                            {{ request('rating') == '3' ? 'checked' : '' }}
                                            class="text-primary focus:ring-primary" onclick="this.form.submit()">
                                        <span class="flex items-center">⭐ 3 ke atas</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Price Filter -->
                            <div class="mb-6">
                                <h3 class="font-semibold text-gray-800 mb-3">Harga</h3>
                                <div class="flex gap-2 items-center">
                                    <input type="number" name="min_price" value="{{ request('min_price') }}"
                                        placeholder="Min"
                                        class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-1 focus:ring-primary">
                                    <span class="text-gray-400">—</span>
                                    <input type="number" name="max_price" value="{{ request('max_price') }}"
                                        placeholder="Max"
                                        class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-1 focus:ring-primary">
                                </div>
                            </div>

                            <!-- Sorting Filter -->
                            <div class="mb-6">
                                <h3 class="font-semibold text-gray-800 mb-3">Urutkan</h3>
                                <select name="sort"
                                    class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-1 focus:ring-primary bg-white"
                                    onchange="this.form.submit()">
                                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru
                                    </option>
                                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga
                                        Terendah</option>
                                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>
                                        Harga Tertinggi</option>
                                    <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Rating
                                        Tertinggi</option>
                                </select>
                            </div>

                            <button type="submit"
                                class="w-full mt-4 px-4 py-2.5 bg-primary text-white rounded-xl text-sm font-medium hover:bg-primary/90 transition">
                                Terapkan Filter
                            </button>
                        </div>
                    </form>
                </aside>

                <!-- Right Content: Service Results -->
                <div class="flex-1">
                    <!-- Result Info -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                        <p class="text-gray-600 text-sm">
                            Menampilkan <span class="font-semibold text-gray-900">{{ $services->total() }}</span> layanan
                        </p>
                    </div>

                    <!-- Service Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @forelse($services as $service)
                            <div
                                class="group bg-white rounded-2xl hover:shadow-xl transition-all duration-300 hover-lift border border-gray-100 overflow-hidden">
                                <a href="{{ route('catalog.show', $service->slug) }}">
                                    <div class="card-image-zoom relative">
                                        <img src="{{ $service->image ?? 'https://placehold.co/400x300/png?text=No+Image' }}"
                                            alt="{{ $service->title }}" class="w-full h-48 object-cover">
                                        <span
                                            class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-xs font-medium px-2 py-1 rounded-full text-gray-700 shadow-sm">
                                            {{ $service->type ?? 'Online' }}
                                        </span>
                                    </div>
                                    <div class="p-5">
                                        <div class="flex justify-between items-start mb-2">
                                            <div>
                                                <h3 class="font-bold text-gray-900 text-lg line-clamp-1">
                                                    {{ $service->title }}</h3>
                                                <p class="text-gray-500 text-sm mt-0.5">
                                                    {{ optional($service->provider)->name ?? 'Penyedia' }}</p>
                                            </div>
                                            <div class="flex items-center gap-1 bg-green-50 px-2 py-1 rounded-full">
                                                <i class="fas fa-star text-yellow-400 text-xs"></i>
                                                <span
                                                    class="text-sm font-semibold text-gray-800">{{ number_format($service->rating ?? 0, 1) }}</span>
                                                <span
                                                    class="text-xs text-gray-500">({{ $service->reviews_count ?? 0 }})</span>
                                            </div>
                                        </div>
                                        <p class="text-gray-500 text-sm line-clamp-2 mb-3">
                                            {{ Str::limit($service->description, 100) }}</p>
                                        <div class="flex items-center gap-3 text-xs text-gray-500 mb-4">
                                            <span class="flex items-center gap-1">
                                                <i class="fas fa-map-marker-alt text-primary/70 text-xs"></i>
                                                {{ $service->location ?? 'Online' }}
                                            </span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <span
                                                    class="text-2xl font-extrabold text-primary">Rp{{ number_format($service->price, 0, ',', '.') }}</span>
                                                <span class="text-xs text-gray-400 ml-1">/ sesi</span>
                                            </div>
                                            <a href="{{ route('catalog.show', $service->slug) }}"
                                                class="px-5 py-2 bg-primary/10 text-primary font-semibold text-sm rounded-xl hover:bg-primary hover:text-white transition-all duration-200">
                                                Lihat Detail
                                            </a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <div class="col-span-2 text-center py-16">
                                <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png"
                                    class="w-24 mx-auto mb-4 opacity-80">
                                <h2 class="text-lg font-semibold text-gray-800 mb-2">Tidak ada layanan ditemukan</h2>
                                <p class="text-gray-500 text-sm mb-4 max-w-md mx-auto">
                                    Coba ubah filter atau kata kunci pencarian Anda
                                </p>
                                <a href="{{ route('catalog') }}"
                                    class="inline-block px-5 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition">
                                    Reset Filter
                                </a>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    @if ($services->hasPages())
                        <div class="mt-10">
                            {{ $services->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .hover-lift {
                transition: all 0.35s cubic-bezier(0.2, 0, 0, 1);
            }

            .hover-lift:hover {
                transform: translateY(-6px);
            }

            .card-image-zoom {
                overflow: hidden;
            }

            .card-image-zoom img {
                transition: transform 0.6s ease;
            }

            .card-image-zoom:hover img {
                transform: scale(1.06);
            }

            .line-clamp-2 {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            .line-clamp-1 {
                display: -webkit-box;
                -webkit-line-clamp: 1;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
        </style>
    @endpush

@endsection
