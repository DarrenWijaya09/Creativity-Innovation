@extends('layouts.app')

@section('title', $provider->name . ' - VEXORA')

@section('content')
    <div class="bg-white dark:bg-gray-950 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-8">

            <!-- ==================== 1. PROVIDER HERO SECTION ==================== -->
            <div
                class="relative bg-gradient-to-r from-primary/5 via-transparent to-blue-50/30 dark:from-primary/10 dark:via-transparent dark:to-blue-950/20 rounded-3xl p-6 md:p-8 mb-8 overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-primary/5 dark:bg-primary/10 rounded-full blur-3xl -z-0"></div>

                <div class="flex flex-col lg:flex-row gap-6 items-start">
                    <!-- Avatar & Basic Info -->
                    <div class="flex items-center gap-5 flex-1">
                        <div class="relative">
                            <div
                                class="w-24 h-24 lg:w-32 lg:h-32 rounded-full bg-gradient-to-br from-primary/20 to-blue-100 dark:from-primary/10 dark:to-blue-900/30 flex items-center justify-center text-primary text-3xl font-bold overflow-hidden">
                                @if ($provider->avatar)
                                    @if (filter_var($provider->avatar, FILTER_VALIDATE_URL))
                                        <img src="{{ $provider->avatar }}" class="w-full h-full object-cover">
                                    @else
                                        <img src="{{ asset('storage/' . $provider->avatar) }}"
                                            class="w-full h-full object-cover">
                                    @endif
                                @else
                                    {{ strtoupper(substr($provider->name, 0, 2)) }}
                                @endif
                            </div>
                            <div class="absolute bottom-1 right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white dark:border-gray-950">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <div class="flex items-center gap-2 flex-wrap">
                                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white">{{ $provider->name }}</h1>
                                @if ($provider->is_verified)
                                    <span
                                        class="inline-flex items-center gap-1 px-2 py-0.5 bg-primary/10 dark:bg-primary/20 text-primary text-xs rounded-full">
                                        <i class="fas fa-check-circle text-xs"></i> Verified
                                    </span>
                                @endif
                            </div>
                            <p class="text-gray-500 dark:text-gray-400 text-sm">
                                {{ $provider->category ? ucfirst(str_replace('_', ' ', $provider->category)) : 'Penyedia Jasa Profesional' }}
                            </p>
                            <div class="flex flex-wrap items-center gap-3 text-sm text-gray-500 dark:text-gray-400">
                                <span class="flex items-center gap-1"><i
                                        class="fas fa-map-marker-alt text-primary text-xs"></i>
                                    {{ $provider->location ?? 'Online' }}</span>
                                <span class="flex items-center gap-1"><i
                                        class="fas fa-calendar-alt text-primary text-xs"></i> Bergabung
                                    {{ optional($provider->created_at)->format('M Y') ?? '2024' }}</span>
                                <span class="flex items-center gap-1"><i class="fas fa-circle text-green-500 text-xs"></i>
                                    Aktif</span>
                            </div>
                        </div>
                    </div>

                    <!-- Rating & Stats -->
                    <div class="flex flex-wrap gap-4 lg:gap-6">
                        <div class="text-center min-w-[80px]">
                            <div class="flex items-center gap-1 justify-center">
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <span
                                    class="text-xl font-bold text-gray-900 dark:text-white">{{ number_format($provider->average_rating, 1) }}</span>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ number_format($provider->total_reviews) }} ulasan</p>
                        </div>
                        <div class="text-center min-w-[80px]">
                            <div class="text-xl font-bold text-gray-900 dark:text-white">{{ number_format($provider->total_orders) }}</div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Total Pesanan</p>
                        </div>
                        <div class="text-center min-w-[80px]">
                            <div class="text-xl font-bold text-gray-900 dark:text-white">{{ $provider->services_count }}</div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Jasa</p>
                        </div>
                        <div class="text-center min-w-[80px]">
                            <div class="text-xl font-bold text-gray-900 dark:text-white">{{ $provider->response_time ?? '< 1 jam' }}</div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Respon</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-wrap gap-3 mt-6 pt-4 border-t border-gray-100 dark:border-slate-700">
                    <button
                        class="flex-1 sm:flex-none px-6 py-2.5 bg-primary text-white font-semibold rounded-xl hover:bg-primary/90 shadow-sm">
                        <i class="fas fa-paper-plane mr-2"></i> Pesan Jasa
                    </button>
                    <button
                        class="flex-1 sm:flex-none px-6 py-2.5 border border-gray-300 dark:border-slate-600 text-gray-700 dark:text-gray-300 font-medium rounded-xl hover:bg-gray-50 dark:hover:bg-slate-800">
                        <i class="fab fa-whatsapp mr-2"></i> Hubungi
                    </button>
                    <button
                        class="px-6 py-2.5 border border-gray-300 dark:border-slate-600 text-gray-700 dark:text-gray-300 font-medium rounded-xl hover:bg-gray-50 dark:hover:bg-slate-800">
                        <i class="far fa-heart mr-2"></i> Simpan
                    </button>
                </div>
            </div>

            <!-- ==================== 2. PROVIDER STATS SECTION ==================== -->
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-10">
                <div class="bg-white dark:bg-slate-900 rounded-xl p-4 text-center border border-gray-100 dark:border-slate-700 shadow-sm">
                    <i class="fas fa-briefcase text-primary text-xl mb-2"></i>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $provider->services_count }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Total Jasa</p>
                </div>
                <div class="bg-white dark:bg-slate-900 rounded-xl p-4 text-center border border-gray-100 dark:border-slate-700 shadow-sm">
                    <i class="fas fa-shopping-bag text-primary text-xl mb-2"></i>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($provider->total_orders) }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Pesanan Selesai</p>
                </div>
                <div class="bg-white dark:bg-slate-900 rounded-xl p-4 text-center border border-gray-100 dark:border-slate-700 shadow-sm">
                    <i class="fas fa-star text-primary text-xl mb-2"></i>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($provider->average_rating, 1) }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Rating Rata-rata</p>
                </div>
                <div class="bg-white dark:bg-slate-900 rounded-xl p-4 text-center border border-gray-100 dark:border-slate-700 shadow-sm">
                    <i class="fas fa-smile text-primary text-xl mb-2"></i>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $provider->satisfaction_rate ?? 98 }}%</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Kepuasan</p>
                </div>
                <div class="bg-white dark:bg-slate-900 rounded-xl p-4 text-center border border-gray-100 dark:border-slate-700 shadow-sm">
                    <i class="fas fa-calendar-week text-primary text-xl mb-2"></i>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">
                        {{ optional($provider->created_at)->format('Y') ?? '2024' }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Member Sejak</p>
                </div>
            </div>

            <!-- ==================== 3. ABOUT PROVIDER ==================== -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
                <!-- Left Column: About & Gallery -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- About Section -->
                    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-gray-100 dark:border-slate-700 shadow-sm p-6">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Tentang {{ $provider->name }}</h2>
                        <div class="prose max-w-none dark:prose-invert">
                            <p class="text-gray-600 dark:text-gray-300 leading-relaxed" id="providerBio">
                                {{ Str::limit($provider->bio ?? 'Penyedia jasa profesional yang berdedikasi memberikan layanan terbaik untuk setiap pelanggan. Dengan pengalaman dan keahlian yang mumpuni, siap membantu mewujudkan kebutuhan Anda.', 300) }}
                            </p>
                            @if (strlen($provider->bio ?? '') > 300)
                                <button id="readMoreBtn" class="text-primary text-sm font-medium mt-2 hover:underline">Baca
                                    Selengkapnya →</button>
                            @endif
                        </div>

                        <!-- Specializations -->
                        <div class="mt-6 pt-4 border-t border-gray-100 dark:border-slate-700">
                            <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-3">Spesialisasi</h3>
                            <div class="flex flex-wrap gap-2">
                                @php $specializations = explode(',', $provider->specializations ?? 'Desain Grafis, Web Development, UI/UX Design, Branding'); @endphp
                                @foreach ($specializations as $spec)
                                    <span
                                        class="px-3 py-1 bg-gray-100 dark:bg-slate-800 text-gray-600 dark:text-gray-400 text-xs rounded-full">{{ trim($spec) }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Portfolio Section -->
                    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-gray-100 dark:border-slate-700 shadow-sm p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Portfolio</h2>
                            <a href="#" class="text-primary text-sm font-medium hover:underline">Lihat semua →</a>
                        </div>

                        @if (isset($portfolios) && $portfolios->count() > 0)
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                @foreach ($portfolios as $portfolio)
                                    <div class="group relative rounded-xl overflow-hidden cursor-pointer aspect-square">
                                        <img src="{{ asset('storage/' . $portfolio->image) }}"
                                            class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                                        <div
                                            class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                                            <i class="fas fa-search-plus text-white text-xl"></i>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <i class="fas fa-images text-gray-300 dark:text-gray-600 text-4xl mb-3"></i>
                                <p class="text-gray-500 dark:text-gray-400">Belum ada portfolio yang ditampilkan</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Right Column: Trust & Information Sidebar -->
                <div class="space-y-5">
                    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-gray-100 dark:border-slate-700 shadow-sm p-5 sticky top-24">
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-4">Informasi Penyedia</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500 dark:text-gray-400">Verifikasi</span>
                                <span class="flex items-center gap-1 text-green-600 dark:text-green-400"><i class="fas fa-check-circle"></i>
                                    Terverifikasi</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500 dark:text-gray-400">Kecepatan Respon</span>
                                <span class="font-medium text-gray-800 dark:text-gray-200">{{ $provider->response_time ?? '< 1 jam' }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500 dark:text-gray-400">Terakhir Aktif</span>
                                <span
                                    class="font-medium text-gray-800 dark:text-gray-200">{{ $provider->last_active_at ? $provider->last_active_at->diffForHumans() : 'Hari ini' }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500 dark:text-gray-400">Tingkat Penyelesaian</span>
                                <span class="font-medium text-gray-800 dark:text-gray-200">{{ $provider->completion_rate ?? 98 }}%</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500 dark:text-gray-400">Bahasa</span>
                                <span class="font-medium text-gray-800 dark:text-gray-200">Indonesia, English</span>
                            </div>
                            <div class="pt-3 border-t border-gray-100 dark:border-slate-700">
                                <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                                    <i class="fas fa-shield-alt text-primary"></i>
                                    <span>Garansi kepuasan 100%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==================== 4. FEATURED SERVICES ==================== -->
            <div class="mb-10">
                <div class="flex items-center justify-between flex-wrap gap-4 mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Layanan yang Ditawarkan</h2>
                        <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Jasa unggulan dari {{ $provider->name }}</p>
                    </div>
                    <div class="flex gap-2">
                        <button
                            class="service-tab active px-4 py-2 text-sm font-medium rounded-lg bg-primary/10 dark:bg-primary/20 text-primary">Terbaru</button>
                        <button
                            class="service-tab px-4 py-2 text-sm font-medium rounded-lg text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-slate-800">Populer</button>
                    </div>
                </div>

                @if (isset($services) && $services->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($services as $service)
                            <a href="{{ route('catalog.show', $service->id) }}"
                                class="group bg-white dark:bg-slate-900 rounded-2xl border border-gray-100 dark:border-slate-700 overflow-hidden hover:shadow-xl hover:scale-[1.02]">
                                <div class="relative overflow-hidden h-48">
                                    <img src="{{ $service->image ? asset('storage/' . $service->image) : 'https://placehold.co/400x300/png?text=No+Image' }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                    <div class="absolute top-3 left-3">
                                        <span
                                            class="px-2 py-1 bg-white/90 dark:bg-slate-800/90 backdrop-blur-sm text-xs font-medium rounded-full text-gray-700 dark:text-gray-200">
                                            {{ ucfirst(str_replace('_', ' ', $service->category)) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="p-5">
                                    <h3
                                        class="font-bold text-gray-900 dark:text-white text-lg line-clamp-1 group-hover:text-primary">
                                        {{ $service->title }}</h3>
                                    <div class="flex items-center gap-2 mt-2">
                                        <div class="flex items-center gap-1">
                                            <i class="fas fa-star text-yellow-400 text-xs"></i>
                                            <span
                                                class="text-sm font-semibold text-gray-800 dark:text-gray-200">{{ number_format($service->average_rating, 1) }}</span>
                                        </div>
                                        <span class="text-xs text-gray-400 dark:text-gray-500">({{ number_format($service->orders_count) }}
                                            pesanan)</span>
                                    </div>
                                    <div class="mt-3 flex items-center justify-between">
                                        <div>
                                            <span
                                                class="text-2xl font-bold text-primary">Rp{{ number_format($service->price, 0, ',', '.') }}</span>
                                            <span class="text-xs text-gray-400 dark:text-gray-500 ml-1">/ sesi</span>
                                        </div>
                                        <span class="text-primary text-sm font-medium group-hover:underline">Lihat Detail
                                            →</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="bg-gray-50 dark:bg-slate-800/50 rounded-2xl p-12 text-center">
                        <i class="fas fa-store text-gray-300 dark:text-gray-600 text-5xl mb-4"></i>
                        <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-2">Belum ada jasa yang ditawarkan</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Penyedia jasa ini belum menambahkan layanan apapun</p>
                    </div>
                @endif
            </div>

            <!-- ==================== 5. REVIEW & RATING SECTION ==================== -->
            <div class="mb-10">
                <div class="flex items-center justify-between flex-wrap gap-4 mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Ulasan Pelanggan</h2>
                        <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Apa kata mereka tentang {{ $provider->name }}</p>
                    </div>
                    <div class="flex gap-2">
                        <select
                            class="review-sort px-3 py-2 border border-gray-200 dark:border-slate-700 rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-primary bg-white dark:bg-slate-800 text-gray-700 dark:text-gray-300">
                            <option value="latest">Terbaru</option>
                            <option value="highest">Rating Tertinggi</option>
                            <option value="lowest">Rating Terendah</option>
                        </select>
                    </div>
                </div>

                <!-- Rating Summary -->
                <div class="bg-gray-50 dark:bg-slate-800/50 rounded-2xl p-6 mb-6">
                    <div class="flex flex-col md:flex-row gap-6 items-center">
                        <div class="text-center">
                            <div class="text-4xl font-bold text-gray-900 dark:text-white">
                                {{ number_format($provider->average_rating, 1) }}</div>
                            <div class="flex items-center justify-center gap-1 my-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i
                                        class="fas fa-star text-sm {{ $i <= round($provider->average_rating) ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}"></i>
                                @endfor
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ number_format($provider->total_reviews) }} ulasan</div>
                        </div>
                        <div class="flex-1 space-y-2">
                            @foreach ([5, 4, 3, 2, 1] as $star)
                                @php
                                    $count = $ratingDistribution[$star] ?? 0;
                                    $percentage = $provider->total_reviews > 0 ? ($count / $provider->total_reviews) * 100 : 0;
                                @endphp
                                <div class="flex items-center gap-2">
                                    <span class="text-xs text-gray-500 dark:text-gray-400 w-8">{{ $star }} ★</span>
                                    <div class="flex-1 h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                        <div class="h-full bg-yellow-400 rounded-full"
                                            style="width: {{ $percentage }}%"></div>
                                    </div>
                                    <span class="text-xs text-gray-500 dark:text-gray-400 w-12">{{ number_format($percentage, 0) }}%</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Reviews List -->
                @if (isset($reviews) && $reviews->count() > 0)
                    <div class="space-y-4" id="reviewsContainer">
                        @foreach ($reviews as $review)
                            <div class="bg-white dark:bg-slate-900 rounded-xl p-5 border border-gray-100 dark:border-slate-700 hover:shadow-sm">
                                <div class="flex items-start gap-3">
                                    <div
                                        class="w-10 h-10 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-300 font-semibold text-sm overflow-hidden flex-shrink-0">
                                        @if ($review->user && $review->user->avatar)
                                            <img src="{{ $review->user->avatar }}" class="w-full h-full object-cover">
                                        @else
                                            {{ strtoupper(substr($review->user->name ?? 'U', 0, 1)) }}
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between flex-wrap gap-2">
                                            <h4 class="font-semibold text-gray-800 dark:text-white">
                                                {{ $review->user->name ?? 'Pengguna' }}</h4>
                                            <span
                                                class="text-xs text-gray-400 dark:text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                                        </div>
                                        <div class="flex items-center gap-1 my-1">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i
                                                    class="fas fa-star text-xs {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}"></i>
                                            @endfor
                                        </div>
                                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">{{ $review->comment }}</p>
                                        @if ($review->is_verified_purchase)
                                            <div class="mt-2"><span class="text-xs text-green-600 dark:text-green-400"><i
                                                        class="fas fa-check-circle"></i> Verified Purchase</span></div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12 bg-gray-50 dark:bg-slate-800/50 rounded-2xl">
                        <i class="fas fa-comment-dots text-gray-300 dark:text-gray-600 text-4xl mb-3"></i>
                        <p class="text-gray-500 dark:text-gray-400">Belum ada ulasan untuk penyedia ini</p>
                        <p class="text-sm text-gray-400 dark:text-gray-500 mt-1">Jadilah yang pertama memberikan ulasan</p>
                    </div>
                @endif
            </div>

            <!-- ==================== 6. RELATED PROVIDERS ==================== -->
            @if (isset($relatedProviders) && $relatedProviders->count() > 0)
                <div class="mb-10">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Penyedia Serupa</h2>
                            <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Provider lain yang mungkin Anda minati</p>
                        </div>
                        <a href="{{ route('providers.index') }}"
                            class="text-primary text-sm font-medium hover:underline">Lihat semua →</a>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach ($relatedProviders as $related)
                            <a href="{{ route('providers.show', $related->id) }}"
                                class="bg-white dark:bg-slate-900 rounded-xl p-4 border border-gray-100 dark:border-slate-700 hover:shadow-md text-center group">
                                <div
                                    class="w-16 h-16 rounded-full mx-auto bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 flex items-center justify-center text-gray-500 dark:text-gray-400 text-lg font-bold overflow-hidden">
                                    @if ($related->avatar)
                                        @if (filter_var($related->avatar, FILTER_VALIDATE_URL))
                                            <img src="{{ $related->avatar }}" class="w-full h-full object-cover">
                                        @else
                                            <img src="{{ asset('storage/' . $related->avatar) }}"
                                                class="w-full h-full object-cover">
                                        @endif
                                    @else
                                        {{ strtoupper(substr($related->name, 0, 2)) }}
                                    @endif
                                </div>
                                <h3 class="font-semibold text-gray-800 dark:text-gray-200 text-sm mt-2 group-hover:text-primary">
                                    {{ $related->name }}</h3>
                                <div class="flex items-center justify-center gap-1 mt-1">
                                    <i class="fas fa-star text-yellow-400 text-xs"></i>
                                    <span
                                        class="text-xs font-semibold text-gray-800 dark:text-gray-200">{{ number_format($related->average_rating, 1) }}</span>
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $related->services_count }} jasa</p>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>

        <!-- Mobile Sticky Bottom CTA -->
        <div class="lg:hidden fixed bottom-0 left-0 right-0 bg-white dark:bg-slate-900 border-t border-gray-100 dark:border-slate-700 p-4 shadow-lg z-40">
            <div class="flex gap-3">
                <button
                    class="flex-1 bg-primary hover:bg-primary/90 text-white font-semibold py-3 rounded-xl shadow-md">
                    <i class="fas fa-paper-plane mr-2"></i> Pesan
                </button>
                <button
                    class="w-12 h-12 bg-gray-100 dark:bg-slate-800 rounded-xl flex items-center justify-center hover:bg-gray-200 dark:hover:bg-slate-700">
                    <i class="fab fa-whatsapp text-primary text-xl"></i>
                </button>
                <button
                    class="w-12 h-12 bg-gray-100 dark:bg-slate-800 rounded-xl flex items-center justify-center hover:bg-gray-200 dark:hover:bg-slate-700">
                    <i class="far fa-heart text-primary text-xl"></i>
                </button>
            </div>
        </div>
        <div class="lg:hidden h-20"></div>
    </div>

    @push('scripts')
        <script>
            // Read more functionality
            const readMoreBtn = document.getElementById('readMoreBtn');
            const providerBio = document.getElementById('providerBio');
            if (readMoreBtn && providerBio) {
                const fullBio = "{{ addslashes($provider->bio ?? '') }}";
                readMoreBtn.addEventListener('click', () => {
                    if (readMoreBtn.textContent.includes('Selengkapnya')) {
                        providerBio.textContent = fullBio;
                        readMoreBtn.textContent = 'Sembunyikan ↑';
                    } else {
                        providerBio.textContent = fullBio.substring(0, 300) + '...';
                        readMoreBtn.textContent = 'Baca Selengkapnya →';
                    }
                });
            }

            // Service tabs
            const serviceTabs = document.querySelectorAll('.service-tab');
            serviceTabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    serviceTabs.forEach(t => {
                        t.classList.remove('active', 'bg-primary/10', 'text-primary');
                        t.classList.add('text-gray-500');
                    });
                    tab.classList.add('active', 'bg-primary/10', 'text-primary');
                    tab.classList.remove('text-gray-500');
                });
            });
        </script>
    @endpush

    @push('styles')
        <style>
            .prose {
                line-height: 1.6;
            }

            .dark .prose {
                color: #d1d5db;
            }

            .dark .prose p {
                color: #d1d5db;
            }

            .line-clamp-1 {
                display: -webkit-box;
                -webkit-line-clamp: 1;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            .service-tab.active {
                background-color: rgba(59, 130, 246, 0.1);
                color: #3B82F6;
            }

            .dark .service-tab.active {
                background-color: rgba(59, 130, 246, 0.2);
                color: #3B82F6;
            }
        </style>
    @endpush

@endsection
