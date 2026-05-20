@extends('layouts.app')

@section('title', $service->title . ' - VEXORA')

@section('content')
    <div class="bg-white min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-8">

            <!-- ==================== BREADCRUMB ==================== -->
            <nav class="flex items-center gap-2 text-sm mb-6 overflow-x-auto pb-2">
                <a href="{{ url('/') }}" class="text-gray-400 hover:text-primary transition">Home</a>
                <i class="fas fa-chevron-right text-gray-300 text-xs"></i>
                <a href="{{ url('/catalog') }}" class="text-gray-400 hover:text-primary transition">Catalog</a>
                <i class="fas fa-chevron-right text-gray-300 text-xs"></i>
                <a href="{{ url('/catalog?category=' . $service->category) }}"
                    class="text-gray-400 hover:text-primary transition">
                    {{ ucfirst(str_replace('_', ' ', $service->category)) }}
                </a>
                <i class="fas fa-chevron-right text-gray-300 text-xs"></i>
                <span class="text-gray-600 font-medium truncate">{{ $service->title }}</span>
            </nav>

            <!-- ==================== MAIN TWO COLUMN LAYOUT ==================== -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-10">

                <!-- LEFT COLUMN: Service Preview & Details -->
                <div class="lg:col-span-2 space-y-8">

                    <!-- Hero Image Gallery -->
                    <div class="space-y-4">
                        <div class="relative group overflow-hidden rounded-2xl bg-gray-100">
                            <img id="mainImage"
                                src="{{ Str::startsWith($service->image, 'http') ? $service->image : asset('storage/' . $service->image) }}"
                                alt="{{ $service->title }}"
                                class="w-full aspect-[16/10] object-cover rounded-2xl transition-transform duration-500 group-hover:scale-105 cursor-pointer">
                            <div class="absolute top-4 left-4 flex gap-2">
                                <span
                                    class="px-3 py-1 bg-green-500 text-white text-xs font-medium rounded-full">Published</span>
                                @if ($service->rating >= 4.5)
                                    <span class="px-3 py-1 bg-yellow-500 text-white text-xs font-medium rounded-full">Top
                                        Rated</span>
                                @endif
                                @if (optional($service->provider)->is_verified)
                                    <span class="px-3 py-1 bg-primary text-white text-xs font-medium rounded-full">Verified
                                        Seller</span>
                                @endif
                            </div>
                        </div>

                        <!-- Thumbnail Gallery -->
                        <div class="thumbnail-gallery flex gap-3 overflow-x-auto pb-2">
                            <div
                                class="w-20 h-20 rounded-xl overflow-hidden cursor-pointer border-2 border-primary flex-shrink-0">
                                <img src="{{ Str::startsWith($service->image, 'http') ? $service->image : asset('storage/' . $service->image) }}"
                                    class="w-full h-full object-cover">
                            </div>
                            @if ($service->images && $service->images->count() > 0)
                                @foreach ($service->images as $img)
                                    <div
                                        class="w-20 h-20 rounded-xl overflow-hidden cursor-pointer border-2 border-transparent hover:border-primary transition flex-shrink-0">
                                        <img src="{{ asset('storage/' . $img->image) }}" class="w-full h-full object-cover">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <!-- Service Title & Meta -->
                    <div class="space-y-4">
                        <div>
                            <div class="flex items-center gap-2 mb-3">
                                <span class="px-3 py-1 bg-primary/10 text-primary text-xs font-medium rounded-full">
                                    {{ ucfirst(str_replace('_', ' ', $service->category)) }}
                                </span>
                            </div>
                            <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-3">{{ $service->title }}</h1>
                            <div class="flex flex-wrap items-center gap-4 text-sm">
                                <div class="flex items-center gap-2">
                                    <div class="flex items-center gap-1">
                                        @php
                                            $avgRating = number_format($service->average_rating ?? 0, 1);
                                            $fullStars = floor($avgRating);
                                            $hasHalf = $avgRating - $fullStars >= 0.5;
                                        @endphp
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $fullStars)
                                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                            @elseif($i == $fullStars + 1 && $hasHalf)
                                                <i class="fas fa-star-half-alt text-yellow-400 text-sm"></i>
                                            @else
                                                <i class="far fa-star text-gray-300 text-sm"></i>
                                            @endif
                                        @endfor
                                        <span class="font-semibold text-gray-800 ml-1">{{ $avgRating }}</span>
                                    </div>
                                    <span class="text-gray-400">({{ number_format($service->reviews_count ?? 0) }}
                                        ulasan)</span>
                                    <span class="text-gray-300">•</span>
                                    <span class="text-gray-500">{{ number_format($service->total_orders ?? 0) }}
                                        pesanan</span>
                                    <span class="text-gray-300">•</span>
                                    <span class="text-gray-500 flex items-center gap-1">
                                        <i class="fas fa-eye text-xs"></i> {{ number_format($service->total_views ?? 0) }}
                                        dilihat
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabs Section -->
                    <div class="border-b border-gray-100">
                        <div class="flex gap-6 overflow-x-auto">
                            <button
                                class="tab-btn active px-1 py-3 text-sm font-medium text-primary border-b-2 border-primary transition">Deskripsi</button>
                            <button
                                class="tab-btn px-1 py-3 text-sm font-medium text-gray-500 hover:text-gray-700 transition">Fitur</button>
                            <button
                                class="tab-btn px-1 py-3 text-sm font-medium text-gray-500 hover:text-gray-700 transition">FAQ</button>
                            <button
                                class="tab-btn px-1 py-3 text-sm font-medium text-gray-500 hover:text-gray-700 transition">Ulasan</button>
                            <button
                                class="tab-btn px-1 py-3 text-sm font-medium text-gray-500 hover:text-gray-700 transition">Tentang
                                Seller</button>
                        </div>
                    </div>

                    <!-- Tab Content: Deskripsi -->
                    <div id="tab-deskripsi" class="tab-content space-y-6">
                        <div class="prose max-w-none">
                            <p class="text-gray-600 leading-relaxed whitespace-pre-line">
                                {{ $service->description ?? 'Deskripsi layanan tidak tersedia.' }}</p>
                        </div>
                    </div>

                    <!-- Tab Content: Fitur -->
                    <div id="tab-fitur" class="tab-content hidden">
                        <div class="bg-gray-50 rounded-2xl p-6">
                            <h3 class="font-semibold text-gray-900 mb-4">Apa yang akan Anda dapatkan?</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @php $features = $service->features ?? ['Konsultasi gratis', 'Revisi maksimal 2x', 'Pengerjaan sesuai deadline', 'Garansi kepuasan 100%']; @endphp
                                @foreach ($features as $feature)
                                    <div class="flex items-center gap-2 text-sm text-gray-600">
                                        <i class="fas fa-check-circle text-primary text-sm"></i> {{ $feature }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Tab Content: FAQ -->
                    <div id="tab-faq" class="tab-content hidden">
                        <div class="space-y-3">
                            @php $faqs = $service->faqs ?? [['question' => 'Berapa lama waktu pengerjaan?', 'answer' => 'Waktu pengerjaan sekitar 3-5 hari kerja tergantung kompleksitas proyek.'], ['question' => 'Apakah bisa request revisi?', 'answer' => 'Ya, maksimal 2x revisi gratis. Revisi tambahan dikenakan biaya.']]; @endphp
                            @foreach ($faqs as $faq)
                                <div class="border border-gray-100 rounded-xl overflow-hidden">
                                    <button
                                        class="faq-question w-full flex items-center justify-between p-4 text-left hover:bg-gray-50 transition">
                                        <span class="font-medium text-gray-800">{{ $faq['question'] }}</span>
                                        <i class="fas fa-chevron-down text-gray-400 text-sm transition-transform"></i>
                                    </button>
                                    <div class="faq-answer hidden px-4 pb-4 text-sm text-gray-500">{{ $faq['answer'] }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Tab Content: Ulasan -->
                    <div id="tab-ulasan" class="tab-content hidden">
                        <!-- Rating Summary -->
                        <div class="flex flex-col md:flex-row gap-8 p-6 bg-gray-50 rounded-2xl mb-6">
                            <div class="text-center">
                                <div class="text-4xl font-bold text-gray-900">
                                    {{ number_format($service->average_rating ?? 0, 1) }}</div>
                                <div class="flex items-center justify-center gap-1 my-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i
                                            class="fas fa-star text-sm {{ $i <= round($service->average_rating ?? 0) ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                    @endfor
                                </div>
                                <div class="text-sm text-gray-500">{{ number_format($service->reviews_count ?? 0) }} ulasan
                                </div>
                            </div>
                            <div class="flex-1 space-y-2">
                                <div class="flex items-center gap-2"><span class="text-xs text-gray-500 w-8">5 ★</span>
                                    <div class="flex-1 h-2 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="h-full bg-yellow-400 rounded-full" style="width: 80%"></div>
                                    </div><span class="text-xs text-gray-500">80%</span>
                                </div>
                                <div class="flex items-center gap-2"><span class="text-xs text-gray-500 w-8">4 ★</span>
                                    <div class="flex-1 h-2 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="h-full bg-yellow-400 rounded-full" style="width: 15%"></div>
                                    </div><span class="text-xs text-gray-500">15%</span>
                                </div>
                                <div class="flex items-center gap-2"><span class="text-xs text-gray-500 w-8">3 ★</span>
                                    <div class="flex-1 h-2 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="h-full bg-yellow-400 rounded-full" style="width: 3%"></div>
                                    </div><span class="text-xs text-gray-500">3%</span>
                                </div>
                            </div>
                        </div>

                        <!-- Review List -->
                        <div class="space-y-4" id="reviewsContainer">
                            @forelse($service->reviews ?? [] as $review)
                                <div class="bg-white rounded-xl p-5 border border-gray-100">
                                    <div class="flex items-start gap-3 mb-3">
                                        <div
                                            class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 font-semibold text-sm overflow-hidden">
                                            @if ($review->user && $review->user->avatar)
                                                <img src="{{ filter_var($review->user->avatar, FILTER_VALIDATE_URL) ? $review->user->avatar : asset('storage/' . $review->user->avatar) }}"
                                                    class="w-full h-full object-cover">
                                            @else
                                                {{ strtoupper(substr($review->user->name ?? 'U', 0, 1)) }}
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center justify-between flex-wrap gap-2">
                                                <h4 class="font-semibold text-gray-800">
                                                    {{ $review->user->name ?? 'Pengguna' }}</h4>
                                                <span
                                                    class="text-xs text-gray-400">{{ $review->created_at->diffForHumans() }}</span>
                                            </div>
                                            <div class="flex items-center gap-1 my-1">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i
                                                        class="fas fa-star text-xs {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                                @endfor
                                            </div>
                                            <p class="text-sm text-gray-600 mt-2">{{ $review->comment }}</p>
                                            @if ($review->is_verified_purchase)
                                                <div class="mt-2"><span class="text-xs text-green-600"><i
                                                            class="fas fa-check-circle"></i> Verified Purchase</span></div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <i class="fas fa-comment-dots text-gray-300 text-4xl mb-3"></i>
                                    <p class="text-gray-500">Belum ada ulasan untuk jasa ini</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Tab Content: Tentang Seller (FULLY DYNAMIC - NO HARDCODED) -->
                    <div id="tab-tentang-seller" class="tab-content hidden">
                        <div class="flex flex-col md:flex-row gap-6 p-6 bg-gray-50 rounded-2xl">
                            <!-- Provider Avatar -->
                            <div
                                class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 text-2xl font-bold overflow-hidden flex-shrink-0">
                                @php $provider = $service->provider; @endphp
                                @if ($provider && $provider->avatar)
                                    @if (filter_var($provider->avatar, FILTER_VALIDATE_URL))
                                        <img src="{{ $provider->avatar }}" class="w-full h-full object-cover">
                                    @else
                                        <img src="{{ asset('storage/' . $provider->avatar) }}"
                                            class="w-full h-full object-cover">
                                    @endif
                                @else
                                    {{ strtoupper(substr($provider->name ?? 'S', 0, 2)) }}
                                @endif
                            </div>

                            <div class="flex-1">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <h3 class="text-xl font-bold text-gray-900">{{ $provider->name ?? 'Seller Name' }}
                                    </h3>
                                    @if ($provider && $provider->is_verified)
                                        <span class="px-2 py-0.5 bg-primary/10 text-primary text-xs rounded-full"><i
                                                class="fas fa-check-circle"></i> Verified</span>
                                    @endif
                                </div>
                                <p class="text-sm text-gray-500 mt-1">Bergabung sejak
                                    {{ $provider && $provider->created_at ? $provider->created_at->translatedFormat('F Y') : '2024' }}
                                </p>
                                <p class="text-sm text-gray-600 mt-3">
                                    {{ $provider->bio ?? 'Penyedia jasa profesional yang siap membantu kebutuhan Anda.' }}
                                </p>

                                <div class="flex flex-wrap gap-4 mt-4">
                                    <div><span
                                            class="text-sm font-semibold text-gray-800">{{ number_format($provider->services->count()) }}</span><span
                                            class="text-xs text-gray-500 ml-1">jasa</span></div>
                                    <div><span
                                            class="text-sm font-semibold text-gray-800">{{ number_format($provider->services->sum('total_orders')) }}</span><span
                                            class="text-xs text-gray-500 ml-1">pesanan</span></div>
                                    <div><span
                                            class="text-sm font-semibold text-gray-800">{{ number_format($provider->services->avg('rating')) }}</span><span
                                            class="text-xs text-gray-500 ml-1">rating</span></div>
                                    <div><span
                                            class="text-sm font-semibold text-gray-800">{{ $provider->response_rate ?? 98 }}%</span><span
                                            class="text-xs text-gray-500 ml-1">respon rate</span></div>
                                </div>

                                <a href=""
                                    class="inline-block mt-4 text-primary text-sm font-medium hover:underline">Lihat Profil
                                    Lengkap →</a>
                            </div>
                        </div>
                    </div>

                    <!-- Recommended Services -->
                    <div class="pt-8 border-t border-gray-100">
                        <h2 class="text-xl font-bold text-gray-900 mb-5">Jasa Serupa Lainnya</h2>
                        @if (isset($recommended) && $recommended->count() > 0)
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @foreach ($recommended as $item)
                                    <a href="{{ route('catalog.show', $item->slug) }}"
                                        class="group bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300">
                                        <div class="overflow-hidden"><img
                                                src="{{ $item->image
                                                    ? (Str::startsWith($item->image, 'http')
                                                        ? $item->image
                                                        : asset('storage/' . $item->image))
                                                    : 'https://placehold.co/300x180/png?text=No+Image' }}"
                                                class="w-full h-32 object-cover group-hover:scale-105 transition duration-300">
                                        </div>
                                        <div class="p-4">
                                            <div class="mb-2"><span
                                                    class="text-xs text-primary font-medium bg-primary/10 px-2 py-1 rounded-full">{{ ucfirst(str_replace('_', ' ', $item->category)) }}</span>
                                            </div>
                                            <h3 class="font-semibold text-gray-800 text-sm line-clamp-2">
                                                {{ $item->title }}</h3>
                                            <p class="text-xs text-gray-500 mt-1">{{ optional($item->provider)->name }}
                                            </p>
                                            <div class="flex items-center gap-2 mt-2">
                                                <div class="flex items-center gap-1"><i
                                                        class="fas fa-star text-yellow-400 text-xs"></i><span
                                                        class="text-xs font-semibold">{{ number_format($item->average_rating ?? 0, 1) }}</span>
                                                </div><span
                                                    class="text-xs text-gray-400">({{ number_format($item->total_orders ?? 0) }}
                                                    pesanan)</span>
                                            </div>
                                            <p class="text-primary font-bold text-sm mt-3">
                                                Rp{{ number_format($item->price, 0, ',', '.') }}</p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <div class="bg-gray-50 rounded-2xl p-8 text-center">
                                <i class="fas fa-store text-gray-300 text-4xl mb-3"></i>
                                <h3 class="font-semibold text-gray-800 mb-2">Belum Ada Jasa Serupa</h3>
                                <p class="text-sm text-gray-500">Saat ini belum ada layanan lain dalam kategori yang sama.
                                </p>
                            </div>
                        @endif
                    </div>

                </div>

                <!-- RIGHT COLUMN: Sticky Booking Card -->
                <div class="lg:col-span-1">
                    <div class="sticky top-24 space-y-5">

                        <!-- Main Booking Card -->
                        <div class="bg-white rounded-3xl border border-gray-100 shadow-lg overflow-hidden">
                            <div class="p-6 border-b border-gray-100">
                                <div class="mb-2">
                                    <span class="text-sm text-gray-500">Mulai dari</span>
                                    <div class="text-4xl font-bold text-primary">
                                        Rp{{ number_format($service->price ?? 0, 0, ',', '.') }}</div>
                                    <span class="text-xs text-gray-400">/ sesi</span>
                                </div>
                                <div class="space-y-3 mt-4">
                                    {{-- BUY NOW --}}
                                    <button
                                        class="w-full bg-primary hover:bg-primary/90 text-white font-semibold py-3.5 rounded-2xl transition shadow-md">
                                        Pesan Sekarang
                                    </button>

                                    {{-- ADD TO CART --}}
                                    <form action="{{ route('cart.store', $service->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="w-full border border-gray-200 hover:border-primary hover:bg-primary/5 text-gray-700 hover:text-primary font-semibold py-3.5 rounded-2xl transition flex items-center justify-center gap-2">
                                            <i class="fas fa-shopping-cart text-sm"></i>
                                            Tambah ke Keranjang
                                        </button>
                                    </form>

                                    {{-- CHAT SELLER (Internal Marketplace Messaging) --}}
                                    @if(optional($service->provider)->user_id)
                                        <form action="{{ route('chat.start', ['provider' => $service->provider->user_id]) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="service_id" value="{{ $service->id }}">
                                            <button type="submit"
                                                class="w-full border border-gray-300 text-gray-700 font-medium py-3 rounded-2xl hover:bg-gray-50 transition flex items-center justify-center gap-2">
                                                <i class="fas fa-comments text-primary"></i>
                                                Chat Seller
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            <div class="p-6 space-y-4">
                                <div class="flex items-center justify-between text-sm"><span
                                        class="text-gray-500">Estimasi Pengerjaan</span><span
                                        class="font-medium text-gray-800">{{ $service->duration ?? '3-5 hari kerja' }}</span>
                                </div>
                                <div class="flex items-center justify-between text-sm"><span
                                        class="text-gray-500">Revisi</span><span
                                        class="font-medium text-gray-800">{{ $service->revision ?? 'Maksimal 2x' }}</span>
                                </div>
                                <div class="flex items-center justify-between text-sm"><span
                                        class="text-gray-500">Pengiriman</span><span
                                        class="font-medium text-gray-800">Digital delivery</span></div>
                                <div class="pt-3 border-t border-gray-100">
                                    <div class="flex items-center gap-2 text-sm text-green-600"><i
                                            class="fas fa-shield-alt"></i><span>Pembayaran Aman & Terjamin</span></div>
                                </div>
                            </div>

                            <!-- Mini Seller Profile (FULLY DYNAMIC) -->
                            <div class="bg-gray-50 p-6">
                                <h4 class="font-semibold text-gray-800 text-sm mb-3">Tentang Penyedia</h4>
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 font-semibold text-sm overflow-hidden flex-shrink-0">
                                        @php $provider = $service->provider; @endphp
                                        @if ($provider && $provider->avatar)
                                            @if (filter_var($provider->avatar, FILTER_VALIDATE_URL))
                                                <img src="{{ $provider->avatar }}" class="w-full h-full object-cover">
                                            @else
                                                <img src="{{ asset('storage/' . $provider->avatar) }}"
                                                    class="w-full h-full object-cover">
                                            @endif
                                        @else
                                            {{ strtoupper(substr($provider->name ?? 'S', 0, 2)) }}
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center gap-1">
                                            <p class="font-medium text-gray-800">{{ $provider->name ?? 'Seller Name' }}
                                            </p>
                                            @if ($provider && $provider->is_verified)
                                                <i class="fas fa-check-circle text-primary text-xs"></i>
                                            @endif
                                        </div>
                                        <div class="flex items-center gap-3 mt-1 text-xs text-gray-500">
                                            <span><i class="fas fa-reply"></i> Respon
                                                {{ $provider->response_rate ?? 'cepat' }}</span>
                                            <span><i class="fas fa-calendar-alt"></i> Sejak
                                                {{ $provider && $provider->created_at ? $provider->created_at->format('Y') : '2024' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Trust Badges -->
                        <div class="bg-white rounded-2xl border border-gray-100 p-4 text-center">
                            <div class="flex items-center justify-center gap-4">
                                <div class="flex items-center gap-1 text-xs text-gray-500"><i
                                        class="fas fa-lock text-primary"></i> Pembayaran Aman</div>
                                <div class="flex items-center gap-1 text-xs text-gray-500"><i
                                        class="fas fa-headset text-primary"></i> Dukungan 24/7</div>
                                <div class="flex items-center gap-1 text-xs text-gray-500"><i
                                        class="fas fa-undo-alt text-primary"></i> Garansi</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Sticky Bottom CTA -->
        <div class="lg:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-gray-100 p-4 shadow-lg z-40">
            <div class="flex items-center justify-between gap-3">
                <div><span class="text-xs text-gray-500">Mulai dari</span>
                    <p class="text-xl font-bold text-primary">Rp{{ number_format($service->price ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="flex gap-2">
                    <button
                        class="flex-1 bg-primary hover:bg-primary/90 text-white font-semibold py-3 rounded-xl transition shadow-md">
                        Pesan Sekarang
                    </button>
                    @if(optional($service->provider)->user_id)
                        <form action="{{ route('chat.start', ['provider' => $service->provider->user_id]) }}" method="POST" class="flex">
                            @csrf
                            <input type="hidden" name="service_id" value="{{ $service->id }}">
                            <button type="submit"
                                class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center hover:bg-gray-200 transition">
                                <i class="fas fa-comments text-primary text-xl"></i>
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        <div class="lg:hidden h-24"></div>
    </div>

    @push('styles')
        <style>
            .prose {
                line-height: 1.6;
            }

            .tab-btn.active {
                color: #3B82F6;
                border-bottom-color: #3B82F6;
            }

            .faq-question.active i {
                transform: rotate(180deg);
            }

            .line-clamp-2 {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            const tabBtns = document.querySelectorAll('.tab-btn');
            const tabContents = document.querySelectorAll('.tab-content');

            tabBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    const tabName = btn.textContent.trim().toLowerCase().replace(/\s+/g, '-');
                    tabBtns.forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');
                    tabContents.forEach(content => content.classList.add('hidden'));
                    const targetContent = document.getElementById(
                        `tab-${tabName === 'ulasan' ? 'ulasan' : tabName === 'tentang seller' ? 'tentang-seller' : tabName}`
                    );
                    if (targetContent) targetContent.classList.remove('hidden');
                });
            });

            document.querySelectorAll('.faq-question').forEach(question => {
                question.addEventListener('click', () => {
                    question.classList.toggle('active');
                    question.nextElementSibling.classList.toggle('hidden');
                });
            });

            const thumbnails = document.querySelectorAll('.thumbnail-gallery img');
            const mainImage = document.getElementById('mainImage');
            thumbnails.forEach(thumb => {
                thumb.addEventListener('click', () => {
                    mainImage.src = thumb.src;
                });
            });
        </script>
    @endpush

@endsection
