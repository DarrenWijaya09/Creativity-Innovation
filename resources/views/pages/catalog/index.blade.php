@extends('layouts.app')

@section('title', 'Temukan Layanan Jasa Terbaik - VEXORA')

@section('content')
    <div class="min-h-screen bg-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- ==================== MOBILE SEARCH (Visible only on mobile) ==================== -->
            <div class="md:hidden mb-6">
                <form method="GET" action="{{ route('catalog.index') }}" class="relative">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari jasa atau penyedia..."
                        class="w-full pl-11 pr-12 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-transparent text-sm">
                    @if(request('search'))
                        <a href="{{ route('catalog.index') }}" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times-circle text-sm"></i>
                        </a>
                    @endif
                </form>
            </div>

            <!-- Page Header -->
            <div class="mb-8">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Temukan Layanan Jasa Terbaik</h1>
                <p class="text-gray-500 mt-2">Jelajahi berbagai layanan profesional sesuai kebutuhan Anda</p>
            </div>

            <!-- Trending Keywords (Only show when no active search) -->
            @if(!request('search') && !request('category') && !request('rating') && !request('min_price'))
            <div class="mb-8 flex flex-wrap items-center gap-2">
                <span class="text-xs text-gray-400 font-medium">POPULAR</span>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('catalog.index', ['search' => 'Logo Design']) }}" class="px-3 py-1.5 rounded-full bg-gray-100 text-gray-600 text-xs hover:bg-primary hover:text-white transition">Logo Design</a>
                    <a href="{{ route('catalog.index', ['search' => 'Website']) }}" class="px-3 py-1.5 rounded-full bg-gray-100 text-gray-600 text-xs hover:bg-primary hover:text-white transition">Website Development</a>
                    <a href="{{ route('catalog.index', ['search' => 'UI/UX']) }}" class="px-3 py-1.5 rounded-full bg-gray-100 text-gray-600 text-xs hover:bg-primary hover:text-white transition">UI/UX Design</a>
                    <a href="{{ route('catalog.index', ['search' => 'Video Editor']) }}" class="px-3 py-1.5 rounded-full bg-gray-100 text-gray-600 text-xs hover:bg-primary hover:text-white transition">Video Editor</a>
                    <a href="{{ route('catalog.index', ['search' => 'Ilustrasi']) }}" class="px-3 py-1.5 rounded-full bg-gray-100 text-gray-600 text-xs hover:bg-primary hover:text-white transition">Ilustrasi</a>
                </div>
            </div>
            @endif

            <!-- Filter + Content Layout -->
            <div class="flex flex-col lg:flex-row gap-8">

                <!-- Left Sidebar (Filters) -->
                <aside class="lg:w-80 flex-shrink-0">
                    <form method="GET" action="{{ route('catalog.index') }}" class="sticky top-24" id="filterForm">
                        <!-- Preserve search query -->
                        @if (request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif

                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="font-bold text-lg text-gray-900">Filter</h2>
                                <a href="{{ route('catalog.index') }}" class="text-primary text-sm font-medium hover:underline">
                                    Reset Filter
                                </a>
                            </div>

                            <!-- Category Filter (Checkboxes - Multi-select) -->
                            <div class="mb-6 pb-4 border-b border-gray-100">
                                <h3 class="font-semibold text-gray-800 mb-3 text-sm">Kategori Jasa</h3>
                                <div class="space-y-2.5">
                                    @foreach ($categories as $category)
                                        @php
                                            $selectedCategories = request('category', []);
                                            $isChecked = is_array($selectedCategories) && in_array($category, $selectedCategories);
                                        @endphp
                                        <label class="flex items-center gap-2.5 text-sm text-gray-600 cursor-pointer group">
                                            <input type="checkbox" name="category[]" value="{{ $category }}"
                                                {{ $isChecked ? 'checked' : '' }}
                                                class="rounded text-primary focus:ring-primary/20 w-4 h-4">
                                            <span class="group-hover:text-gray-900 transition">{{ $category }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Rating Filter -->
                            <div class="mb-6 pb-4 border-b border-gray-100">
                                <h3 class="font-semibold text-gray-800 mb-3 text-sm">Rating</h3>
                                <div class="space-y-2.5">
                                    <label class="flex items-center gap-2.5 text-sm text-gray-600 cursor-pointer group">
                                        <input type="radio" name="rating" value="4"
                                            {{ request('rating') == '4' ? 'checked' : '' }}
                                            class="text-primary focus:ring-primary/20 w-4 h-4"
                                            onclick="document.getElementById('filterForm').submit()">
                                        <span class="group-hover:text-gray-900 transition flex items-center gap-1">⭐ 4 ke atas</span>
                                    </label>
                                    <label class="flex items-center gap-2.5 text-sm text-gray-600 cursor-pointer group">
                                        <input type="radio" name="rating" value="3"
                                            {{ request('rating') == '3' ? 'checked' : '' }}
                                            class="text-primary focus:ring-primary/20 w-4 h-4"
                                            onclick="document.getElementById('filterForm').submit()">
                                        <span class="group-hover:text-gray-900 transition flex items-center gap-1">⭐ 3 ke atas</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Price Filter -->
                            <div class="mb-6 pb-4 border-b border-gray-100">
                                <h3 class="font-semibold text-gray-800 mb-3 text-sm">Harga</h3>
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
                            <div>
                                <h3 class="font-semibold text-gray-800 mb-3 text-sm">Urutkan</h3>
                                <select name="sort" id="sortSelect"
                                    class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-1 focus:ring-primary bg-white"
                                    onchange="document.getElementById('filterForm').submit()">
                                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga Terendah</option>
                                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga Tertinggi</option>
                                    <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Rating Tertinggi</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </aside>

                <!-- Right Content: Service Results -->
                <div class="flex-1">

                    <!-- SEARCH RESULT HEADER (when search active) -->
                    @if(request('search'))
                    <div class="mb-8 pb-4 border-b border-gray-100">
                        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
                            <div>
                                <p class="text-sm text-primary font-medium mb-1">Hasil pencarian</p>
                                <h1 class="text-2xl md:text-3xl font-bold text-gray-900">"{{ request('search') }}"</h1>
                                <p class="text-gray-500 text-sm mt-2">
                                    {{ $services->total() }} layanan ditemukan di VEXORA
                                </p>
                            </div>
                            <a href="{{ route('catalog.index') }}" class="inline-flex items-center gap-1.5 text-sm text-gray-400 hover:text-primary transition">
                                <i class="fas fa-times-circle"></i>
                                Hapus pencarian
                            </a>
                        </div>
                    </div>
                    @endif

                    <!-- ACTIVE FILTER CHIPS -->
                    @php
                        $hasActiveFilters = request('search') || request('category') || request('rating') || request('sort') || request('min_price') || request('max_price');
                    @endphp

                    @if($hasActiveFilters)
                    <div class="mb-6 flex flex-wrap gap-2">
                        @if(request('search'))
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-primary/10 text-primary text-xs font-medium rounded-full">
                                <i class="fas fa-search text-xs"></i>
                                {{ request('search') }}
                                <a href="{{ route('catalog.index', array_merge(request()->except('search'), ['page' => null])) }}" class="text-primary/60 hover:text-primary ml-1">
                                    <i class="fas fa-times-circle text-xs"></i>
                                </a>
                            </span>
                        @endif

                        @if(request('category'))
                            @foreach(request('category') as $cat)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 text-blue-700 text-xs font-medium rounded-full">
                                    <i class="fas fa-tag text-xs"></i>
                                    {{ $cat }}
                                    <a href="{{ route('catalog.index', array_merge(request()->except('category'), ['page' => null])) }}" class="text-blue-400 hover:text-blue-600 ml-1">
                                        <i class="fas fa-times-circle text-xs"></i>
                                    </a>
                                </span>
                            @endforeach
                        @endif

                        @if(request('rating'))
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-yellow-50 text-yellow-700 text-xs font-medium rounded-full">
                                <i class="fas fa-star text-xs"></i>
                                ⭐ {{ request('rating') }}+
                                <a href="{{ route('catalog.index', array_merge(request()->except('rating'), ['page' => null])) }}" class="text-yellow-500 hover:text-yellow-700 ml-1">
                                    <i class="fas fa-times-circle text-xs"></i>
                                </a>
                            </span>
                        @endif

                        @if(request('min_price') || request('max_price'))
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-green-50 text-green-700 text-xs font-medium rounded-full">
                                <i class="fas fa-rupiah-sign text-xs"></i>
                                @php
                                    $min = request('min_price') ? 'Rp' . number_format(request('min_price'), 0, ',', '.') : 'Rp0';
                                    $max = request('max_price') ? 'Rp' . number_format(request('max_price'), 0, ',', '.') : '∞';
                                @endphp
                                {{ $min }} - {{ $max }}
                                <a href="{{ route('catalog.index', array_merge(request()->except(['min_price', 'max_price']), ['page' => null])) }}" class="text-green-500 hover:text-green-700 ml-1">
                                    <i class="fas fa-times-circle text-xs"></i>
                                </a>
                            </span>
                        @endif

                        @if(request('sort'))
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gray-100 text-gray-700 text-xs font-medium rounded-full">
                                <i class="fas fa-arrow-down-wide-short text-xs"></i>
                                @php
                                    $sortLabels = [
                                        'latest' => 'Terbaru',
                                        'price_low' => 'Harga Terendah',
                                        'price_high' => 'Harga Tertinggi',
                                        'rating' => 'Rating Tertinggi'
                                    ];
                                @endphp
                                {{ $sortLabels[request('sort')] ?? request('sort') }}
                                <a href="{{ route('catalog.index', array_merge(request()->except('sort'), ['page' => null])) }}" class="text-gray-400 hover:text-gray-600 ml-1">
                                    <i class="fas fa-times-circle text-xs"></i>
                                </a>
                            </span>
                        @endif

                        <a href="{{ route('catalog.index') }}" class="text-xs text-gray-400 hover:text-primary transition ml-1">
                            Reset semua filter
                        </a>
                    </div>
                    @endif

                    <!-- Result Info -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                        <p class="text-gray-500 text-sm">
                            Menampilkan <span class="font-semibold text-gray-900">{{ $services->firstItem() ?? 0 }}-{{ $services->lastItem() ?? 0 }}</span> dari <span class="font-semibold text-gray-900">{{ $services->total() }}</span> layanan
                        </p>
                    </div>

                    <!-- Service Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @forelse($services as $service)
                            <div class="group bg-white rounded-2xl hover:shadow-xl transition-all duration-300 hover-lift border border-gray-100 overflow-hidden relative">
                                <!-- Save/Bookmark Button -->
                                @auth
                                    @php
                                        $isSaved = in_array($service->id, $savedServiceIds ?? []);
                                    @endphp
                                    @if($isSaved)
                                        <form action="{{ route('saved.destroy', $service->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="absolute top-3 right-3 w-10 h-10 rounded-full bg-white/90 backdrop-blur shadow-sm hover:shadow-md flex items-center justify-center text-red-500 hover:text-red-600 transition-all duration-200 z-10">
                                                <i class="fas fa-heart text-sm"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('saved.store', $service->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="absolute top-3 right-3 w-10 h-10 rounded-full bg-white/90 backdrop-blur shadow-sm hover:shadow-md flex items-center justify-center text-gray-400 hover:text-red-500 transition-all duration-200 z-10">
                                                <i class="far fa-heart text-sm"></i>
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}"
                                        class="absolute top-3 right-3 w-10 h-10 rounded-full bg-white/90 backdrop-blur shadow-sm hover:shadow-md flex items-center justify-center text-gray-400 hover:text-red-500 transition-all duration-200 z-10">
                                        <i class="far fa-heart text-sm"></i>
                                    </a>
                                @endauth

                                <a href="{{ route('catalog.show', $service->slug) }}">
                                    <div class="card-image-zoom relative">
                                        <img src="{{ $service->image ?? 'https://placehold.co/400x300/png?text=No+Image' }}"
                                            alt="{{ $service->title }}" class="w-full h-48 object-cover">
                                        <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-xs font-medium px-2 py-1 rounded-full text-gray-700 shadow-sm">
                                            {{ $service->type ?? 'Online' }}
                                        </span>
                                    </div>
                                    <div class="p-5">
                                        <div class="flex justify-between items-start mb-2">
                                            <div>
                                                <h3 class="font-bold text-gray-900 text-lg line-clamp-1 group-hover:text-primary transition">
                                                    {{ $service->title }}
                                                </h3>
                                                <p class="text-gray-500 text-sm mt-0.5 flex items-center gap-1">
                                                    <i class="fas fa-user-circle text-gray-400 text-xs"></i>
                                                    {{ optional($service->provider)->name ?? 'Penyedia' }}
                                                </p>
                                            </div>
                                            <div class="flex items-center gap-1 bg-green-50 px-2 py-1 rounded-full">
                                                <i class="fas fa-star text-yellow-400 text-xs"></i>
                                                <span class="text-sm font-semibold text-gray-800">{{ number_format($service->rating ?? 0, 1) }}</span>
                                                <span class="text-xs text-gray-500">({{ $service->reviews_count ?? 0 }})</span>
                                            </div>
                                        </div>
                                        <p class="text-gray-500 text-sm line-clamp-2 mb-3">
                                            {{ Str::limit($service->description, 100) }}
                                        </p>
                                        <div class="flex items-center gap-3 text-xs text-gray-500 mb-4">
                                            <span class="flex items-center gap-1">
                                                <i class="fas fa-map-marker-alt text-primary/70 text-xs"></i>
                                                {{ $service->location ?? 'Online' }}
                                            </span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <span class="text-2xl font-extrabold text-primary">Rp{{ number_format($service->price, 0, ',', '.') }}</span>
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
                                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-search text-gray-300 text-3xl"></i>
                                </div>
                                <h2 class="text-xl font-semibold text-gray-800 mb-2">Tidak ada layanan ditemukan</h2>
                                <p class="text-gray-500 text-sm mb-4 max-w-md mx-auto">
                                    @if(request('search'))
                                        Maaf, tidak ada hasil untuk pencarian "<span class="font-medium">{{ request('search') }}</span>"
                                    @elseif(request('category') || request('rating') || request('min_price') || request('max_price'))
                                        Tidak ada layanan yang sesuai dengan filter yang Anda pilih
                                    @else
                                        Coba ubah filter atau kata kunci pencarian Anda
                                    @endif
                                </p>
                                <div class="flex flex-wrap gap-3 justify-center">
                                    <a href="{{ route('catalog.index') }}"
                                        class="inline-block px-5 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition">
                                        Reset Filter
                                    </a>
                                    @if(request('search'))
                                        <a href="{{ route('catalog.index') }}"
                                            class="inline-block px-5 py-2 border border-gray-300 text-gray-600 rounded-lg hover:bg-gray-50 transition">
                                            Hapus Pencarian
                                        </a>
                                    @endif
                                </div>
                                <!-- Popular Suggestions when empty -->
                                <div class="mt-6 pt-4 border-t border-gray-100">
                                    <p class="text-xs text-gray-400 mb-3">Atau coba kategori populer:</p>
                                    <div class="flex flex-wrap gap-2 justify-center">
                                        <a href="{{ route('catalog.index', ['category' => ['Desain']]) }}" class="text-xs px-3 py-1.5 bg-gray-100 text-gray-600 rounded-full hover:bg-primary hover:text-white transition">Desain</a>
                                        <a href="{{ route('catalog.index', ['category' => ['Programming']]) }}" class="text-xs px-3 py-1.5 bg-gray-100 text-gray-600 rounded-full hover:bg-primary hover:text-white transition">Programming</a>
                                        <a href="{{ route('catalog.index', ['category' => ['Fotografi']]) }}" class="text-xs px-3 py-1.5 bg-gray-100 text-gray-600 rounded-full hover:bg-primary hover:text-white transition">Fotografi</a>
                                        <a href="{{ route('catalog.index', ['search' => 'UI/UX']) }}" class="text-xs px-3 py-1.5 bg-gray-100 text-gray-600 rounded-full hover:bg-primary hover:text-white transition">UI/UX Design</a>
                                    </div>
                                </div>
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
            input[type="checkbox"]:checked {
                background-color: #3B82F6;
                border-color: #3B82F6;
            }
            input[type="radio"]:checked {
                background-color: #3B82F6;
                border-color: #3B82F6;
            }
        </style>
    @endpush

@endsection
