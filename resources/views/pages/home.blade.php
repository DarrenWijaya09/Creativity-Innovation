@php
    use Illuminate\Support\Str;
@endphp

@extends('layouts.app')

@section('title', 'VEXORA — Temukan Jasa Terbaik untuk Kebutuhan Anda')

@section('content')
    <!-- ==================== HERO SECTION ==================== -->
    <section class="relative overflow-hidden bg-white dark:bg-gray-950 transition-theme">
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-blue-400/15 dark:bg-blue-500/5 rounded-full blur-[120px] -z-10"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-indigo-400/10 dark:bg-indigo-500/5 rounded-full blur-[100px] -z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24 lg:py-28">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">

                <div class="text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-secondary dark:bg-primary/10 rounded-full mb-6">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-primary"></span>
                        </span>
                        <span class="text-xs font-medium text-primary">Platform Jasa Terpercaya</span>
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-bold tracking-tight text-gray-900 dark:text-white leading-[1.15] mb-6">
                        Temukan
                        <span class="bg-gradient-to-r from-primary to-blue-600 bg-clip-text text-transparent">Jasa Terbaik</span>
                        <br>untuk Kebutuhan Anda
                    </h1>

                    <p class="text-gray-500 dark:text-gray-400 text-base md:text-lg max-w-lg mx-auto lg:mx-0 leading-relaxed mb-8">
                        Dari les privat hingga layanan profesional, VEXORA menghubungkan Anda dengan penyedia jasa terpercaya dengan mudah dan cepat.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start mb-8">
                        <a href="{{ url('/catalog') }}"
                           class="inline-flex items-center justify-center gap-2 bg-primary hover:bg-primary/90 text-white font-semibold px-8 py-3.5 rounded-full transition-all duration-200 shadow-md hover:shadow-lg hover:-translate-y-0.5">
                            <span>Cari Jasa Sekarang</span>
                            <i class="fas fa-arrow-right text-sm"></i>
                        </a>
                        <a href="{{ route('provider.create') }}"
                           class="inline-flex items-center justify-center gap-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 font-semibold px-8 py-3.5 rounded-full transition-all duration-200 shadow-sm hover:shadow-md">
                            <span>Jadi Penyedia</span>
                        </a>
                    </div>

                    <div class="flex flex-wrap gap-6 justify-center lg:justify-start">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-full bg-green-50 dark:bg-green-900/20 flex items-center justify-center">
                                <i class="fas fa-check-circle text-green-600 dark:text-green-400 text-sm"></i>
                            </div>
                            <div class="text-left">
                                <p class="text-sm font-semibold text-gray-900 dark:text-white">10.000+</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Penyedia Aktif</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-full bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center">
                                <i class="fas fa-star text-yellow-500 dark:text-yellow-400 text-sm"></i>
                            </div>
                            <div class="text-left">
                                <p class="text-sm font-semibold text-gray-900 dark:text-white">4.9/5</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Rating Pengguna</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-full bg-purple-50 dark:bg-purple-900/20 flex items-center justify-center">
                                <i class="fas fa-shield-alt text-purple-500 dark:text-purple-400 text-sm"></i>
                            </div>
                            <div class="text-left">
                                <p class="text-sm font-semibold text-gray-900 dark:text-white">100%</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Garansi Aman</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative flex justify-center lg:justify-end">
                    <div class="relative w-full max-w-md lg:max-w-lg">
                        <div class="absolute inset-0 bg-gradient-to-tr from-primary/10 via-blue-400/5 to-transparent rounded-full blur-2xl scale-110"></div>

                        <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                            <img src="https://images.unsplash.com/photo-1521791136064-7986c2920216?w=600&h=600&fit=crop"
                                 alt="Layanan profesional"
                                 class="w-full h-auto object-contain relative z-0 transform transition-transform duration-500 hover:scale-105 dark:brightness-95">
                        </div>

                        <div class="absolute -bottom-3 -right-3 bg-white/95 dark:bg-gray-900/95 backdrop-blur-sm rounded-2xl px-4 py-2.5 shadow-lg border border-gray-100 dark:border-gray-800 flex items-center gap-2">
                            <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center">
                                <i class="fas fa-check-circle text-primary text-sm"></i>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-800 dark:text-white">10.000+</p>
                                <p class="text-[10px] text-gray-500 dark:text-gray-400">Penyedia Terverifikasi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== CATEGORY SHORTCUTS ==================== -->
    <section class="py-12 border-t border-gray-100 dark:border-gray-800 bg-white dark:bg-gray-950 transition-theme">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <h2 class="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-white">Jelajahi Kategori</h2>
                <p class="text-gray-500 dark:text-gray-400 mt-2 text-sm">Temukan layanan berdasarkan kebutuhan Anda</p>
            </div>

            <div class="overflow-x-auto scrollbar-hide pb-4">
                <div class="flex gap-3 md:justify-center min-w-max">
                    @php
                        $categoryIcons = [
                            'Desain' => 'fas fa-palette',
                            'Programming' => 'fas fa-code',
                            'Marketing' => 'fas fa-chart-line',
                            'Video' => 'fas fa-video',
                            'Writing' => 'fas fa-pen-fancy',
                            'Music' => 'fas fa-music',
                            'Business' => 'fas fa-briefcase',
                            'Les Privat' => 'fas fa-chalkboard-user',
                            'Fotografi' => 'fas fa-camera',
                            'UI/UX' => 'fas fa-object-group',
                        ];
                    @endphp
                    @foreach($categories as $category)
                        <a href="{{ route('catalog.index', ['category[]' => $category]) }}"
                           class="category-pill flex-shrink-0 inline-flex items-center gap-2 px-5 py-2.5 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-full text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-primary hover:text-white hover:border-primary transition-all duration-200 shadow-sm hover:shadow-md hover:-translate-y-0.5">
                            <i class="{{ $categoryIcons[$category] ?? 'fas fa-tag' }} text-sm"></i>
                            <span>{{ $category }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== POPULAR SERVICES ==================== -->
    <section class="py-16 bg-gray-50 dark:bg-gray-900 transition-theme">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between flex-wrap mb-10">
                <div>
                    <h2 class="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-white">🔥 Layanan Populer</h2>
                    <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Temukan layanan yang sedang banyak dicari</p>
                </div>
                <a href="{{ url('/catalog') }}"
                    class="text-primary text-sm font-medium border-b border-primary/30 hover:border-primary transition">Lihat semua <i class="fas fa-arrow-right ml-1 text-xs"></i></a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($popularServices as $service)
                    <div class="group bg-white dark:bg-gray-950 rounded-2xl hover:shadow-xl dark:hover:shadow-black/40 transition-all duration-300 hover:-translate-y-1 border border-gray-100 dark:border-gray-800 overflow-hidden relative">
                        @auth
                            @php
                                $isSaved = in_array($service->id, $savedServiceIds ?? []);
                            @endphp
                            @if($isSaved)
                                <form action="{{ route('saved.destroy', $service->id) }}" method="POST" class="absolute top-3 right-3 z-10">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-8 h-8 rounded-full bg-white/90 dark:bg-gray-800/90 backdrop-blur shadow-sm flex items-center justify-center text-red-500 hover:text-red-600 transition hover:scale-110">
                                        <i class="fas fa-heart text-sm"></i>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('saved.store', $service->id) }}" method="POST" class="absolute top-3 right-3 z-10">
                                    @csrf
                                    <button type="submit" class="w-8 h-8 rounded-full bg-white/90 dark:bg-gray-800/90 backdrop-blur shadow-sm flex items-center justify-center text-gray-400 dark:text-gray-500 hover:text-red-500 transition hover:scale-110">
                                        <i class="far fa-heart text-sm"></i>
                                    </button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="absolute top-3 right-3 z-10">
                                <div class="w-8 h-8 rounded-full bg-white/90 dark:bg-gray-800/90 backdrop-blur shadow-sm flex items-center justify-center text-gray-400 dark:text-gray-500 hover:text-red-500 transition hover:scale-110">
                                    <i class="far fa-heart text-sm"></i>
                                </div>
                            </a>
                        @endauth

                        <a href="{{ route('catalog.show', $service->slug) }}" class="block">
                            <div class="card-image-zoom">
                                <img src="{{ $service->image ? (Str::startsWith($service->image, 'http') ? $service->image : asset('storage/' . $service->image)) : 'https://placehold.co/400x300/png?text=No+Image' }}"
                                    alt="{{ $service->title }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500 dark:brightness-95">
                            </div>
                            <div class="p-5">
                                <h3 class="font-bold text-gray-900 dark:text-white text-lg line-clamp-1 group-hover:text-primary transition">{{ $service->title }}</h3>
                                <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">{{ optional($service->provider)->name ?? 'Penyedia' }}</p>
                                <div class="flex items-center gap-2 mt-2">
                                    <div class="flex items-center gap-1">
                                        <i class="fas fa-star text-yellow-400 text-sm"></i>
                                        <span class="font-semibold text-gray-800 dark:text-gray-200">{{ number_format($service->rating ?? 0, 1) }}</span>
                                    </div>
                                    <span class="text-xs text-gray-400 dark:text-gray-500">({{ number_format($service->total_orders ?? 0) }} pesanan)</span>
                                </div>
                                <div class="mt-3">
                                    <span class="text-xl font-bold text-primary">Rp{{ number_format($service->price, 0, ',', '.') }}</span>
                                    <span class="text-xs text-gray-400 dark:text-gray-500 ml-1">/ sesi</span>
                                </div>
                                <div class="mt-4 block text-center text-primary text-sm font-medium border border-primary/30 rounded-full py-2 hover:bg-primary hover:text-white transition group-hover:shadow-md">
                                    Pesan Layanan
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    @foreach(range(1, 4) as $i)
                        <div class="bg-white dark:bg-gray-950 rounded-2xl border border-gray-100 dark:border-gray-800 overflow-hidden animate-pulse">
                            <div class="w-full h-48 bg-gray-200 dark:bg-gray-800"></div>
                            <div class="p-5">
                                <div class="h-5 bg-gray-200 dark:bg-gray-800 rounded w-3/4 mb-2"></div>
                                <div class="h-4 bg-gray-200 dark:bg-gray-800 rounded w-1/2 mb-3"></div>
                                <div class="flex gap-2 mb-3">
                                    <div class="h-4 bg-gray-200 dark:bg-gray-800 rounded w-16"></div>
                                    <div class="h-4 bg-gray-200 dark:bg-gray-800 rounded w-20"></div>
                                </div>
                                <div class="h-6 bg-gray-200 dark:bg-gray-800 rounded w-24 mb-4"></div>
                                <div class="h-10 bg-gray-200 dark:bg-gray-800 rounded-full w-full"></div>
                            </div>
                        </div>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

    <!-- PROMO BANNER -->
    <section class="py-12 bg-white dark:bg-gray-950 transition-theme">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gray-50 dark:bg-gray-900 rounded-3xl p-8 md:p-12 flex flex-col md:flex-row items-center justify-between gap-10 border border-gray-100 dark:border-gray-800 shadow-sm transition-theme">
                <div class="flex-1 text-center md:text-left space-y-4">
                    <h3 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white">Temukan Jasa Berkualitas<br>dengan Harga Terjangkau</h3>
                    <p class="text-gray-600 dark:text-gray-400 max-w-sm mx-auto md:mx-0">Dapatkan penawaran terbaik dari penyedia jasa terpercaya di berbagai bidang.</p>
                    <div class="flex justify-center md:justify-start gap-3 pt-2">
                        <div class="bg-white dark:bg-gray-800 rounded-xl px-4 py-2 shadow-sm text-center min-w-[60px] border border-gray-100 dark:border-gray-700">
                            <span class="text-2xl font-bold text-primary" id="days">00</span>
                            <p class="text-[10px] uppercase tracking-wide text-gray-500 dark:text-gray-400">Hari</p>
                        </div>
                        <div class="bg-white dark:bg-gray-800 rounded-xl px-4 py-2 shadow-sm text-center min-w-[60px] border border-gray-100 dark:border-gray-700">
                            <span class="text-2xl font-bold text-primary" id="hours">00</span>
                            <p class="text-[10px] uppercase tracking-wide text-gray-500 dark:text-gray-400">Jam</p>
                        </div>
                        <div class="bg-white dark:bg-gray-800 rounded-xl px-4 py-2 shadow-sm text-center min-w-[60px] border border-gray-100 dark:border-gray-700">
                            <span class="text-2xl font-bold text-primary" id="minutes">00</span>
                            <p class="text-[10px] uppercase tracking-wide text-gray-500 dark:text-gray-400">Menit</p>
                        </div>
                        <div class="bg-white dark:bg-gray-800 rounded-xl px-4 py-2 shadow-sm text-center min-w-[60px] border border-gray-100 dark:border-gray-700">
                            <span class="text-2xl font-bold text-primary" id="seconds">00</span>
                            <p class="text-[10px] uppercase tracking-wide text-gray-500 dark:text-gray-400">Detik</p>
                        </div>
                    </div>
                    <a href="{{ url('/catalog') }}" class="inline-block bg-primary text-white px-7 py-3 rounded-full text-sm font-medium hover:bg-primary/90 transition shadow-sm mt-2">Lihat Semua Jasa →</a>
                </div>
                <div class="flex-1 flex justify-center md:justify-end">
                    <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?w=400&h=400&fit=crop"
                        alt="Penyedia jasa"
                        class="w-56 md:w-64 object-contain drop-shadow-md rounded-2xl hover:scale-105 transition duration-500 dark:brightness-95">
                </div>
            </div>
        </div>
    </section>

    <!-- RECOMMENDED SERVICES -->
    <section class="py-16 bg-gray-50 dark:bg-gray-900 transition-theme">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between flex-wrap mb-10">
                <div>
                    <h2 class="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-white">✨ Rekomendasi untuk Anda</h2>
                    <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Berdasarkan aktivitas dan preferensi Anda</p>
                </div>
                <a href="{{ url('/catalog') }}" class="text-primary text-sm font-medium border-b border-primary/30 hover:border-primary transition">Lihat semua <i class="fas fa-arrow-right ml-1 text-xs"></i></a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($recommendedServices as $service)
                    <div class="group bg-white dark:bg-gray-950 rounded-2xl hover:shadow-xl dark:hover:shadow-black/40 transition-all duration-300 hover:-translate-y-1 border border-gray-100 dark:border-gray-800 overflow-hidden relative">
                        @auth
                            @php
                                $isSaved = in_array($service->id, $savedServiceIds ?? []);
                            @endphp
                            @if($isSaved)
                                <form action="{{ route('saved.destroy', $service->id) }}" method="POST" class="absolute top-3 right-3 z-10">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-8 h-8 rounded-full bg-white/90 dark:bg-gray-800/90 backdrop-blur shadow-sm flex items-center justify-center text-red-500 hover:text-red-600 transition hover:scale-110">
                                        <i class="fas fa-heart text-sm"></i>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('saved.store', $service->id) }}" method="POST" class="absolute top-3 right-3 z-10">
                                    @csrf
                                    <button type="submit" class="w-8 h-8 rounded-full bg-white/90 dark:bg-gray-800/90 backdrop-blur shadow-sm flex items-center justify-center text-gray-400 dark:text-gray-500 hover:text-red-500 transition hover:scale-110">
                                        <i class="far fa-heart text-sm"></i>
                                    </button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="absolute top-3 right-3 z-10">
                                <div class="w-8 h-8 rounded-full bg-white/90 dark:bg-gray-800/90 backdrop-blur shadow-sm flex items-center justify-center text-gray-400 dark:text-gray-500 hover:text-red-500 transition hover:scale-110">
                                    <i class="far fa-heart text-sm"></i>
                                </div>
                            </a>
                        @endauth

                        <a href="{{ route('catalog.show', $service->slug) }}" class="block">
                            <div class="card-image-zoom">
                                <img src="{{ $service->image ? (Str::startsWith($service->image, 'http') ? $service->image : asset('storage/' . $service->image)) : 'https://placehold.co/400x300/png?text=No+Image' }}"
                                    alt="{{ $service->title }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500 dark:brightness-95">
                            </div>
                            <div class="p-5">
                                <h3 class="font-bold text-gray-900 dark:text-white text-lg line-clamp-1 group-hover:text-primary transition">{{ $service->title }}</h3>
                                <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">{{ optional($service->provider)->name ?? 'Penyedia' }}</p>
                                <div class="flex items-center gap-2 mt-2">
                                    <div class="flex items-center gap-1">
                                        <i class="fas fa-star text-yellow-400 text-sm"></i>
                                        <span class="font-semibold text-gray-800 dark:text-gray-200">{{ number_format($service->rating ?? 0, 1) }}</span>
                                    </div>
                                    <span class="text-xs text-gray-400 dark:text-gray-500">({{ number_format($service->total_orders ?? 0) }} pesanan)</span>
                                </div>
                                <div class="mt-3">
                                    <span class="text-xl font-bold text-primary">Rp{{ number_format($service->price, 0, ',', '.') }}</span>
                                    <span class="text-xs text-gray-400 dark:text-gray-500 ml-1">/ sesi</span>
                                </div>
                                <div class="mt-4 block text-center text-primary text-sm font-medium border border-primary/30 rounded-full py-2 hover:bg-primary hover:text-white transition group-hover:shadow-md">
                                    Pesan Layanan
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    @foreach(range(1, 4) as $i)
                        <div class="bg-white dark:bg-gray-950 rounded-2xl border border-gray-100 dark:border-gray-800 overflow-hidden animate-pulse">
                            <div class="w-full h-48 bg-gray-200 dark:bg-gray-800"></div>
                            <div class="p-5">
                                <div class="h-5 bg-gray-200 dark:bg-gray-800 rounded w-3/4 mb-2"></div>
                                <div class="h-4 bg-gray-200 dark:bg-gray-800 rounded w-1/2 mb-3"></div>
                                <div class="flex gap-2 mb-3">
                                    <div class="h-4 bg-gray-200 dark:bg-gray-800 rounded w-16"></div>
                                    <div class="h-4 bg-gray-200 dark:bg-gray-800 rounded w-20"></div>
                                </div>
                                <div class="h-6 bg-gray-200 dark:bg-gray-800 rounded w-24 mb-4"></div>
                                <div class="h-10 bg-gray-200 dark:bg-gray-800 rounded-full w-full"></div>
                            </div>
                        </div>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

    <!-- TESTIMONIALS -->
    <section class="py-16 bg-white dark:bg-gray-950 transition-theme">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-white">Apa Kata Pengguna</h2>
                <p class="text-gray-500 dark:text-gray-400 mt-2 text-sm">Dipercaya ribuan pengguna setiap hari</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @php
                    $testimonials = [
                        ['name' => 'Anita Wijaya', 'feedback' => 'VEXORA sangat membantu saya menemukan guru les dengan cepat dan terpercaya.', 'rating' => 5, 'avatar' => 'https://randomuser.me/api/portraits/women/44.jpg'],
                        ['name' => 'Budi Santoso', 'feedback' => 'Saya cari tukang perbaikan AC di sini, dalam 1 jam langsung datang.', 'rating' => 5, 'avatar' => 'https://randomuser.me/api/portraits/men/32.jpg'],
                        ['name' => 'Citra Lestari', 'feedback' => 'Desain logo saya dikerjakan dengan sangat baik. Penyedia jasa responsif.', 'rating' => 4, 'avatar' => 'https://randomuser.me/api/portraits/women/68.jpg'],
                    ];
                @endphp
                @foreach ($testimonials as $t)
                    <div class="bg-white dark:bg-gray-900 rounded-2xl p-6 shadow-sm hover:shadow-md transition border border-gray-100 dark:border-gray-800">
                        <div class="flex items-center gap-4 mb-4">
                            <img src="{{ $t['avatar'] }}" class="w-12 h-12 rounded-full object-cover border-2 border-primary/20 dark:brightness-95">
                            <div>
                                <h4 class="font-bold text-gray-800 dark:text-white">{{ $t['name'] }}</h4>
                                <div class="flex items-center gap-1 mt-1">
                                    @for ($i = 0; $i < 5; $i++)
                                        @if ($i < $t['rating'])
                                            <i class="fas fa-star text-yellow-400 text-xs"></i>
                                        @else
                                            <i class="far fa-star text-gray-300 dark:text-gray-600 text-xs"></i>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400">"{{ $t['feedback'] }}"</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- HOW IT WORKS -->
    <section class="py-16 bg-gray-50 dark:bg-gray-900 transition-theme">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-white">Cara Kerja VEXORA</h2>
                <p class="text-gray-500 dark:text-gray-400 mt-2 text-sm">Mudah, cepat, dan terpercaya</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @php
                    $steps = [
                        ['icon' => 'fas fa-search', 'title' => 'Cari Jasa', 'desc' => 'Temukan layanan yang Anda butuhkan dari berbagai kategori', 'number' => '01'],
                        ['icon' => 'fas fa-handshake', 'title' => 'Pilih Penyedia', 'desc' => 'Lihat profil, rating, dan pilih penyedia terbaik', 'number' => '02'],
                        ['icon' => 'fas fa-check-circle', 'title' => 'Pesan & Selesai', 'desc' => 'Lakukan pemesanan dan nikmati layanan berkualitas', 'number' => '03'],
                    ];
                @endphp
                @foreach ($steps as $step)
                    <div class="text-center group">
                        <div class="relative inline-block mb-6">
                            <div class="w-24 h-24 bg-secondary dark:bg-primary/10 rounded-2xl flex items-center justify-center mx-auto group-hover:bg-primary/10 transition">
                                <i class="{{ $step['icon'] }} text-3xl text-primary"></i>
                            </div>
                            <span class="absolute -top-3 -right-3 bg-white dark:bg-gray-900 text-primary font-bold text-sm w-8 h-8 rounded-full border border-primary/20 flex items-center justify-center shadow-sm">{{ $step['number'] }}</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">{{ $step['title'] }}</h3>
                        <p class="text-gray-500 dark:text-gray-400 max-w-xs mx-auto">{{ $step['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- STATISTICS -->
    <section class="py-16 bg-primary/5 dark:bg-primary/10 transition-theme">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 text-center">
                @php
                    $stats = [
                        ['value' => '10.000+', 'label' => 'Penyedia Jasa', 'icon' => 'fas fa-users'],
                        ['value' => '50.000+', 'label' => 'Pengguna Aktif', 'icon' => 'fas fa-user-check'],
                        ['value' => '100.000+', 'label' => 'Transaksi Berhasil', 'icon' => 'fas fa-chart-line'],
                        ['value' => '4.9/5', 'label' => 'Rating Pengguna', 'icon' => 'fas fa-star'],
                    ];
                @endphp
                @foreach ($stats as $stat)
                    <div class="p-6">
                        <div class="w-14 h-14 bg-white dark:bg-gray-900 rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm">
                            <i class="{{ $stat['icon'] }} text-primary text-xl"></i>
                        </div>
                        <div class="text-3xl md:text-4xl font-extrabold text-gray-900 dark:text-white">{{ $stat['value'] }}</div>
                        <div class="text-gray-500 dark:text-gray-400 text-sm mt-1">{{ $stat['label'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA SECTION -->
    <section class="py-16 bg-white dark:bg-gray-950 transition-theme">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-primary to-blue-600 rounded-3xl p-12 md:p-16 text-center text-white shadow-xl dark:shadow-black/30">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Siap Menemukan Jasa Terbaik?</h2>
                <p class="text-blue-100 text-lg max-w-xl mx-auto mb-8">Mulai sekarang dan temukan layanan terpercaya hanya di VEXORA.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ url('/catalog') }}" class="inline-block bg-white text-primary font-semibold px-8 py-3 rounded-full hover:bg-gray-100 transition shadow-md hover:shadow-lg hover:-translate-y-0.5">Cari Jasa</a>
                    @guest
                        <a href="{{ route('login') }}" class="inline-block bg-primary/20 border border-white/40 text-white font-semibold px-8 py-3 rounded-full hover:bg-white/10 transition hover:-translate-y-0.5">Jadi Penyedia</a>
                    @endguest
                    @auth
                        @if (auth()->user()->role != 1)
                            <a href="{{ route('provider.create') }}" class="inline-block bg-primary/20 border border-white/40 text-white font-semibold px-8 py-3 rounded-full hover:bg-white/10 transition hover:-translate-y-0.5">Jadi Penyedia</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }

    .card-image-zoom { overflow: hidden; }
    .card-image-zoom img { transition: transform 0.6s ease; }
    .card-image-zoom:hover img { transform: scale(1.06); }

    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in { animation: fadeIn 0.5s ease-out; }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        initCountdown({
            days: 'days',
            hours: 'hours',
            minutes: 'minutes',
            seconds: 'seconds'
        });
    });
</script>
@endpush
