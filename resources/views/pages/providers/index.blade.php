@extends('layouts.app')

@section('title', 'Penyedia Jasa Terpercaya - VEXORA')

@section('content')
    <div class="animate-fade-in">
        <!-- Hero Section with Large Search Bar -->
        <section class="mb-12 text-center">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4">Temukan Penyedia Jasa Terbaik</h1>
            <p class="text-gray-500 dark:text-gray-400 text-lg max-w-2xl mx-auto mb-8">Jelajahi ribuan penyedia jasa terpercaya sesuai kebutuhan
                Anda</p>

            <!-- Large Search Bar -->
            <div class="max-w-3xl mx-auto relative">
                <form method="GET" action="{{ route('providers.index') }}"
                    class="bg-white dark:bg-slate-900 rounded-2xl shadow-lg border border-gray-200 dark:border-slate-700 overflow-hidden flex items-center p-1 focus-within:ring-2 focus-within:ring-primary/50">
                    <i class="fas fa-search text-gray-400 dark:text-gray-500 ml-4"></i>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari jasa atau penyedia (contoh: les matematika, desain logo)"
                        class="flex-1 px-4 py-4 outline-none text-gray-700 dark:text-gray-200 placeholder-gray-400 dark:placeholder-gray-500 bg-white dark:bg-slate-900">
                    <button type="submit"
                        class="bg-primary hover:bg-primary/90 text-white font-medium px-6 py-3 rounded-xl mr-1">Cari</button>
                </form>
                <div class="flex justify-center gap-3 mt-4 text-xs text-gray-500 dark:text-gray-400">
                    <span class="flex items-center gap-1"><i class="fas fa-check-circle text-primary text-xs"></i>
                        {{ number_format($totalProviders ?? 0) }}+ Penyedia</span>
                    <span class="flex items-center gap-1"><i class="fas fa-star text-yellow-400 text-xs"></i>
                        {{ number_format($averageRating ?? 0, 1) }} Rating Rata-rata</span>
                    <span class="flex items-center gap-1"><i class="fas fa-clock text-primary text-xs"></i> Respon
                        Cepat</span>
                </div>
            </div>
        </section>

        <!-- Filter & Category Bar (Sticky) -->
        <section
            class="sticky top-20 z-40 bg-white/95 dark:bg-slate-900/95 backdrop-blur-sm rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 p-4 mb-8">
            <div class="flex flex-wrap items-center gap-4 justify-between">
                <div class="flex flex-wrap gap-3">
                    <select name="category"
                        class="filter-select px-4 py-2 bg-gray-50 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-1 focus:ring-primary text-gray-700 dark:text-gray-300">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('_', ' ', $cat)) }}</option>
                        @endforeach
                    </select>
                    <select name="rating"
                        class="filter-select px-4 py-2 bg-gray-50 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-1 focus:ring-primary text-gray-700 dark:text-gray-300">
                        <option value="">Semua Rating</option>
                        <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>Rating 4+ ⭐</option>
                        <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>Rating 3+ ⭐</option>
                    </select>
                    <select name="location"
                        class="filter-select px-4 py-2 bg-gray-50 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-1 focus:ring-primary text-gray-700 dark:text-gray-300">
                        <option value="">Semua Lokasi</option>
                        @foreach ($locations as $loc)
                            <option value="{{ $loc }}" {{ request('location') == $loc ? 'selected' : '' }}>
                                {{ $loc }}</option>
                        @endforeach
                        <option value="Online" {{ request('location') == 'Online' ? 'selected' : '' }}>Online</option>
                    </select>
                </div>
                <a href="{{ route('providers.index') }}" class="text-sm text-primary font-medium hover:underline">Reset
                    Filter</a>
            </div>
            <!-- Category Pills -->
            <div class="flex flex-wrap gap-2 mt-4 pt-3 border-t border-gray-100 dark:border-slate-700">
                @foreach ($categories->take(8) as $cat)
                    <a href="{{ route('providers.index', array_merge(request()->query(), ['category' => $cat])) }}"
                        class="px-4 py-1.5 {{ request('category') == $cat ? 'bg-primary/10 text-primary' : 'bg-gray-100 dark:bg-slate-800 text-gray-600 dark:text-gray-300' }} rounded-full text-sm font-medium cursor-pointer hover:bg-primary hover:text-white">
                        {{ ucfirst(str_replace('_', ' ', $cat)) }}
                    </a>
                @endforeach
            </div>
        </section>

        <!-- Section 1: Top Providers -->
        @if (isset($topProviders) && $topProviders->count() > 0)
            <section class="mb-16">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white">🏆 Penyedia Terbaik</h2>
                        <p class="text-gray-500 dark:text-gray-400 mt-1">Dipilih berdasarkan rating dan performa terbaik</p>
                    </div>
                    <a href="{{ route('providers.index', ['sort' => 'rating']) }}"
                        class="text-primary text-sm font-medium hover:underline">Lihat semua →</a>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($topProviders as $provider)
                        <a href="{{ route('providers.show', $provider->slug) }}"
                            class="group bg-white dark:bg-slate-900 rounded-2xl p-5 shadow-sm hover:shadow-xl hover:scale-[1.02] border border-gray-100 dark:border-slate-700 block">
                            <div class="flex items-start gap-4">
                                <!-- Avatar -->
                                <div
                                    class="w-16 h-16 rounded-full bg-gradient-to-br from-primary/20 to-blue-100 dark:from-primary/10 dark:to-blue-900/20 overflow-hidden flex-shrink-0">
                                    @if (!empty($provider->avatar))
                                        <img src="{{ \Illuminate\Support\Str::startsWith($provider->avatar, 'http')
                                            ? $provider->avatar
                                            : asset('storage/' . $provider->avatar) }}"
                                            alt="{{ $provider->name }}" class="w-full h-full object-cover">
                                    @else
                                        @php
                                            $initials = collect(explode(' ', trim($provider->name)))
                                                ->map(fn($word) => strtoupper(substr($word, 0, 1)))
                                                ->take(2)
                                                ->implode('');
                                        @endphp
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($initials) }}&background=0D8ABC&color=fff&size=128"
                                            alt="{{ $provider->name }}" class="w-full h-full object-cover">
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between">
                                        <h3 class="font-bold text-gray-900 dark:text-white group-hover:text-primary">
                                            {{ $provider->name }}</h3>
                                        <span
                                            class="bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400 text-xs font-bold px-2 py-0.5 rounded-full">Top
                                            Rated</span>
                                    </div>
                                    <div class="flex items-center gap-1 mt-1">
                                        <i class="fas fa-star text-yellow-400 text-sm"></i>
                                        <span
                                            class="font-semibold text-sm text-gray-800 dark:text-gray-200">{{ number_format($provider->average_rating, 1) }}</span>
                                        <span class="text-gray-400 dark:text-gray-500 text-xs">({{ number_format($provider->total_reviews) }}
                                            ulasan)</span>
                                    </div>
                                    <p class="text-gray-500 dark:text-gray-400 text-xs mt-1 line-clamp-1">
                                        {{ $provider->category ? ucfirst(str_replace('_', ' ', $provider->category)) : 'Penyedia Jasa' }}
                                    </p>
                                    <div class="flex items-center gap-2 mt-2">
                                        <span class="text-xs text-gray-400 dark:text-gray-500"><i class="fas fa-briefcase"></i>
                                            {{ $provider->services_count }} jasa</span>
                                        <span class="text-xs text-gray-400 dark:text-gray-500"><i class="fas fa-shopping-bag"></i>
                                            {{ number_format($provider->total_orders) }} pesanan</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Section 2: New Providers -->
        @if (isset($newProviders) && $newProviders->count() > 0)
            <section class="mb-16">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white">🆕 Penyedia Baru</h2>
                        <p class="text-gray-500 dark:text-gray-400 mt-1">Temukan talenta baru dengan potensi besar</p>
                    </div>
                    <a href="{{ route('providers.index', ['sort' => 'newest']) }}"
                        class="text-primary text-sm font-medium hover:underline">Lihat semua →</a>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                    @foreach ($newProviders as $provider)
                        <a href="{{ route('providers.show', $provider->slug) }}"
                            class="group bg-white dark:bg-slate-900 rounded-xl p-4 shadow-sm hover:shadow-md hover:scale-[1.02] border border-gray-100 dark:border-slate-700 block">
                            <div class="relative">
                                <div
                                    class="w-16 h-16 rounded-full mx-auto bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 overflow-hidden">
                                    @if (!empty($provider->avatar))
                                        <img src="{{ \Illuminate\Support\Str::startsWith($provider->avatar, 'http')
                                            ? $provider->avatar
                                            : asset('storage/' . $provider->avatar) }}"
                                            alt="{{ $provider->name }}" class="w-full h-full object-cover">
                                    @else
                                        @php
                                            $initials = collect(explode(' ', trim($provider->name)))
                                                ->map(fn($word) => strtoupper(substr($word, 0, 1)))
                                                ->take(2)
                                                ->implode('');
                                        @endphp
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($initials) }}&background=E5E7EB&color=4B5563&size=128"
                                            alt="{{ $provider->name }}" class="w-full h-full object-cover">
                                    @endif
                                </div>
                                <span
                                    class="absolute -top-1 -right-1 bg-green-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">Baru</span>
                            </div>
                            <h3
                                class="font-semibold text-gray-800 dark:text-gray-200 text-center mt-2 text-sm line-clamp-1 group-hover:text-primary">
                                {{ $provider->name }}</h3>
                            <div class="flex justify-center items-center gap-1 mt-1">
                                <i class="fas fa-star text-yellow-400 text-xs"></i>
                                <span
                                    class="text-xs font-semibold text-gray-800 dark:text-gray-200">{{ number_format($provider->average_rating, 1) }}</span>
                            </div>
                            <p class="text-primary font-bold text-center text-sm mt-2">{{ $provider->services_count }} jasa
                            </p>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Section 3: Active Providers -->
        @if (isset($activeProviders) && $activeProviders->count() > 0)
            <section class="mb-16">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white">⚡ Penyedia Aktif</h2>
                        <p class="text-gray-500 dark:text-gray-400 mt-1">Respon cepat & siap melayani</p>
                    </div>
                    <a href="{{ route('providers.index', ['sort' => 'active']) }}"
                        class="text-primary text-sm font-medium hover:underline">Lihat semua →</a>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($activeProviders as $provider)
                        <a href="{{ route('providers.show', $provider->slug) }}"
                            class="group bg-white dark:bg-slate-900 rounded-2xl p-5 shadow-sm hover:shadow-xl hover:scale-[1.02] border border-gray-100 dark:border-slate-700 block">
                            <div class="flex gap-4">
                                <div
                                    class="w-14 h-14 rounded-full bg-gradient-to-br from-green-100 to-green-200 dark:from-green-900/30 dark:to-green-800/20 overflow-hidden flex-shrink-0">
                                    @if (!empty($provider->avatar))
                                        <img src="{{ \Illuminate\Support\Str::startsWith($provider->avatar, 'http')
                                            ? $provider->avatar
                                            : asset('storage/' . $provider->avatar) }}"
                                            alt="{{ $provider->name }}" class="w-full h-full object-cover">
                                    @else
                                        @php
                                            $initials = collect(explode(' ', trim($provider->name)))
                                                ->map(fn($word) => strtoupper(substr($word, 0, 1)))
                                                ->take(2)
                                                ->implode('');
                                        @endphp
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($initials) }}&background=DCFCE7&color=16A34A&size=128"
                                            alt="{{ $provider->name }}" class="w-full h-full object-cover">
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between">
                                        <h3 class="font-bold text-gray-900 dark:text-white group-hover:text-primary">
                                            {{ $provider->name }}</h3>
                                        <span
                                            class="bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-xs font-bold px-2 py-0.5 rounded-full">Aktif</span>
                                    </div>
                                    <div class="flex items-center gap-2 mt-1">
                                        <div class="flex items-center gap-1">
                                            <i class="fas fa-star text-yellow-400 text-xs"></i>
                                            <span
                                                class="font-semibold text-sm text-gray-800 dark:text-gray-200">{{ number_format($provider->average_rating, 1) }}</span>
                                        </div>
                                        <span class="text-gray-300 dark:text-gray-600">|</span>
                                        <span
                                            class="text-gray-500 dark:text-gray-400 text-xs">{{ $provider->category ? ucfirst(str_replace('_', ' ', $provider->category)) : 'Penyedia' }}</span>
                                    </div>
                                    <div class="flex items-center gap-3 mt-2">
                                        <span class="text-primary font-bold">{{ $provider->services_count }} jasa</span>
                                        <span class="text-xs text-green-600 dark:text-green-400"><i class="fas fa-clock"></i> Aktif</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Main Provider List (Core) -->
        <section class="mb-16">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white">Semua Penyedia Jasa</h2>
                    <p class="text-gray-500 dark:text-gray-400 mt-1">Menampilkan {{ $providers->total() }} penyedia berdasarkan rating &
                        aktivitas terbaru</p>
                </div>
                <select name="sort"
                    class="sort-select px-4 py-2 bg-gray-50 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-1 focus:ring-primary text-gray-700 dark:text-gray-300">
                    <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Urutkan: Rating Tertinggi
                    </option>
                    <option value="orders" {{ request('sort') == 'orders' ? 'selected' : '' }}>Urutkan: Paling Banyak
                        Pesanan</option>
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Urutkan: Terbaru</option>
                    <option value="active" {{ request('sort') == 'active' ? 'selected' : '' }}>Urutkan: Paling Aktif
                    </option>
                </select>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($providers as $provider)
                    <a href="{{ route('providers.show', $provider->slug) }}"
                        class="group bg-white dark:bg-slate-900 rounded-2xl p-5 shadow-sm hover:shadow-xl hover:scale-[1.02] border border-gray-100 dark:border-slate-700 block">
                        <div class="flex gap-4">
                            <div
                                class="w-16 h-16 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 overflow-hidden flex-shrink-0">
                                @if (!empty($provider->avatar))
                                    <img src="{{ \Illuminate\Support\Str::startsWith($provider->avatar, 'http')
                                        ? $provider->avatar
                                        : asset('storage/' . $provider->avatar) }}"
                                        alt="{{ $provider->name }}" class="w-full h-full object-cover">
                                @else
                                    @php
                                        $initials = collect(explode(' ', trim($provider->name)))
                                            ->map(fn($word) => strtoupper(substr($word, 0, 1)))
                                            ->take(2)
                                            ->implode('');
                                    @endphp
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($initials) }}&background=E5E7EB&color=4B5563&size=128"
                                        alt="{{ $provider->name }}" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between flex-wrap gap-1">
                                    <h3 class="font-bold text-gray-900 dark:text-white group-hover:text-primary">
                                        {{ $provider->name }}</h3>
                                    @if ($provider->average_rating >= 4.8)
                                        <span
                                            class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400">Top
                                            Rated</span>
                                    @elseif($provider->status === 'active')
                                        <span
                                            class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400">Aktif</span>
                                    @endif
                                </div>
                                <div class="flex items-center gap-2 mt-1">
                                    <div class="flex items-center gap-1">
                                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                                        <span
                                            class="font-semibold text-sm text-gray-800 dark:text-gray-200">{{ number_format($provider->average_rating, 1) }}</span>
                                    </div>
                                    <span class="text-gray-400 dark:text-gray-500 text-xs">({{ number_format($provider->total_reviews) }}
                                        ulasan)</span>
                                    <span class="text-gray-300 dark:text-gray-600">•</span>
                                    <span class="text-gray-500 dark:text-gray-400 text-xs">{{ $provider->services_count }} jasa</span>
                                </div>
                                <p class="text-gray-500 dark:text-gray-400 text-xs mt-2 line-clamp-1">
                                    {{ Str::limit($provider->bio ?? 'Penyedia jasa profesional siap membantu kebutuhan Anda', 80) }}
                                </p>
                                <div class="flex items-center gap-3 mt-2">
                                    <span class="text-xs text-gray-400 dark:text-gray-500"><i class="fas fa-map-marker-alt"></i>
                                        {{ $provider->location ?? 'Online' }}</span>
                                    <span class="text-xs text-gray-400 dark:text-gray-500"><i class="fas fa-shopping-bag"></i>
                                        {{ number_format($provider->total_orders) }} pesanan</span>
                                </div>
                                <div class="mt-3 pt-2 border-t border-gray-100 dark:border-slate-700">
                                    <span class="text-xs text-primary font-medium group-hover:underline">Lihat Profil
                                        →</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-3 text-center py-16">
                        <i class="fas fa-store text-gray-300 dark:text-gray-600 text-5xl mb-4"></i>
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">Belum ada penyedia tersedia</h2>
                        <p class="text-gray-500 dark:text-gray-400 text-sm mb-4 max-w-md mx-auto">Saat ini belum ada penyedia jasa yang
                            terdaftar. Silakan cek kembali nanti.</p>
                        <a href="{{ route('providers.index') }}"
                            class="inline-block px-5 py-2 bg-primary text-white rounded-lg hover:bg-primary/90">Refresh
                            Halaman</a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($providers->hasPages())
                <div class="flex justify-center mt-10">
                    {{ $providers->appends(request()->query())->links() }}
                </div>
            @endif
        </section>
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

            .line-clamp-1 {
                display: -webkit-box;
                -webkit-line-clamp: 1;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            /* Pagination styling */
            .pagination {
                display: flex;
                gap: 0.5rem;
                justify-content: center;
                flex-wrap: wrap;
            }

            .pagination .page-item .page-link {
                padding: 0.5rem 0.75rem;
                border-radius: 0.5rem;
                border: 1px solid #e5e7eb;
                color: #4b5563;
            }

            .dark .pagination .page-item .page-link {
                background-color: #0f172a;
                border-color: #1e293b;
                color: #cbd5e1;
            }

            .pagination .page-item.active .page-link {
                background-color: #3B82F6;
                border-color: #3B82F6;
                color: white;
            }

            .pagination .page-item .page-link:hover {
                background-color: #f3f4f6;
            }

            .dark .pagination .page-item .page-link:hover:not(.active) {
                background-color: #1e293b;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Filter select auto-submit
                const filters = document.querySelectorAll('.filter-select');

                filters.forEach(filter => {
                    filter.addEventListener('change', () => {
                        const url = new URL(window.location.href);
                        filters.forEach(f => {
                            if (f.value) url.searchParams.set(f.name, f.value);
                            else url.searchParams.delete(f.name);
                        });
                        window.location.href = url.toString();
                    });
                });

                // Sort select auto-submit
                const sortSelect = document.querySelector('.sort-select');
                if (sortSelect) {
                    sortSelect.addEventListener('change', () => {
                        const url = new URL(window.location.href);
                        if (sortSelect.value) url.searchParams.set('sort', sortSelect.value);
                        else url.searchParams.delete('sort');
                        window.location.href = url.toString();
                    });
                }

                // Search form auto-submit
                const searchInput = document.querySelector('input[name="search"]');
                const searchForm = searchInput?.closest('form');
                if (searchInput && searchForm) {
                    let searchTimeout;
                    searchInput.addEventListener('input', () => {
                        clearTimeout(searchTimeout);
                        searchTimeout = setTimeout(() => {
                            searchForm.submit();
                        }, 500);
                    });
                }
            });
        </script>
    @endpush

@endsection
