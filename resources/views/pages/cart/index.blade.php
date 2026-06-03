@extends('layouts.app')

@section('title', 'Keranjang - VEXORA')

@section('content')
    <div class="min-h-screen py-8 lg:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Page Header -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
                    <div>
                        <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white">Keranjang</h1>
                        <p class="text-gray-500 dark:text-gray-400 mt-1">
                            {{ $cartItems->count() }} {{ $cartItems->count() == 1 ? 'layanan' : 'layanan' }} siap untuk
                            checkout
                        </p>
                    </div>
                    <a href="{{ route('catalog.index') }}"
                        class="text-primary text-sm font-medium hover:underline inline-flex items-center gap-1">
                        <i class="fas fa-arrow-left text-xs"></i>
                        Lanjut Belanja
                    </a>
                </div>
            </div>

            @if ($cartItems->count() > 0)
                <div class="flex flex-col lg:flex-row gap-8">

                    <!-- LEFT COLUMN: Cart Items -->
                    <div class="flex-1 space-y-4">
                        @foreach ($cartItems as $item)
                            <div
                                class="bg-white dark:bg-slate-900 rounded-2xl border border-gray-100 dark:border-slate-700 shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden group">
                                <div class="p-5 sm:p-6">
                                    <div class="flex flex-col sm:flex-row gap-5">
                                        <!-- Thumbnail -->
                                        <div class="sm:w-32 sm:h-32 flex-shrink-0">
                                            <img src="{{ $item->service->image ?? 'https://placehold.co/128x128/png?text=No+Image' }}"
                                                alt="{{ $item->service->title }}"
                                                class="w-full h-32 sm:h-full rounded-xl object-cover">
                                        </div>

                                        <!-- Service Info -->
                                        <div class="flex-1 min-w-0">
                                            <div class="flex flex-wrap items-start justify-between gap-3">
                                                <div class="flex-1 min-w-0">
                                                    <div class="flex items-center gap-2 mb-2 flex-wrap">
                                                        <span
                                                            class="px-2 py-0.5 bg-primary/10 dark:bg-primary/20 text-primary text-xs font-medium rounded-full">
                                                            {{ ucfirst(str_replace('_', ' ', $item->service->category)) }}
                                                        </span>
                                                    </div>
                                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white line-clamp-1 mb-1">
                                                        <a href="{{ route('catalog.show', $item->service->slug) }}"
                                                            class="hover:text-primary transition">
                                                            {{ $item->service->title }}
                                                        </a>
                                                    </h3>

                                                    <!-- Provider Info -->
                                                    <div class="flex items-center gap-2 mb-3">
                                                        <div
                                                            class="w-5 h-5 rounded-full bg-gradient-to-br from-gray-200 to-gray-300 dark:from-slate-700 dark:to-slate-600 flex items-center justify-center text-gray-600 dark:text-gray-400 text-[10px] font-semibold overflow-hidden">
                                                            {{ strtoupper(substr(optional($item->service->provider)->name ?? 'PR', 0, 2)) }}
                                                        </div>
                                                        <span class="text-sm text-gray-600 dark:text-gray-400">
                                                            {{ optional($item->service->provider)->name ?? 'Penyedia' }}
                                                        </span>
                                                        @if (optional($item->service->provider)->is_verified)
                                                            <i class="fas fa-check-circle text-primary text-xs"></i>
                                                        @endif
                                                    </div>

                                                    <!-- Rating -->
                                                    <div class="flex items-center gap-2">
                                                        <div class="flex items-center gap-0.5">
                                                            <i class="fas fa-star text-yellow-400 text-xs"></i>
                                                            <span
                                                                class="text-sm font-semibold text-gray-800 dark:text-gray-200">{{ number_format($item->service->rating ?? 0, 1) }}</span>
                                                        </div>
                                                        <span
                                                            class="text-xs text-gray-400 dark:text-gray-500">({{ number_format($item->service->reviews_count ?? 0) }}
                                                            ulasan)</span>
                                                    </div>
                                                </div>

                                                <!-- Price & Remove -->
                                                <div class="text-right">
                                                    <div class="text-2xl font-bold text-primary">
                                                        Rp{{ number_format($item->service->price, 0, ',', '.') }}
                                                    </div>
                                                    <form action="{{ route('cart.destroy', $item->id) }}" method="POST"
                                                        onsubmit="return confirm('Hapus layanan ini dari keranjang?')">

                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit"
                                                            class="text-gray-400 dark:text-gray-500 hover:text-red-500 dark:hover:text-red-400 text-sm mt-2 transition flex items-center gap-1">

                                                            <i class="fas fa-trash-alt text-xs"></i>

                                                            <span>Hapus</span>

                                                        </button>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Continue Shopping Suggestion -->
                        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-gray-100 dark:border-slate-700 p-5 text-center">
                            <p class="text-gray-500 dark:text-gray-400 text-sm">Butuh layanan lain?</p>
                            <a href="{{ route('catalog.index') }}"
                                class="text-primary text-sm font-medium hover:underline inline-flex items-center gap-1 mt-1">
                                <i class="fas fa-search text-xs"></i>
                                Cari jasa lainnya
                            </a>
                        </div>
                    </div>

                    <!-- RIGHT COLUMN: Order Summary -->
                    <div class="lg:w-96 flex-shrink-0">
                        <div class="sticky top-24 bg-white dark:bg-slate-900 rounded-2xl border border-gray-100 dark:border-slate-700 shadow-sm overflow-hidden">
                            <div class="p-6">
                                <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Ringkasan Pesanan</h2>

                                <div class="space-y-3">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-500 dark:text-gray-400">Subtotal ({{ $cartItems->count() }} layanan)</span>
                                        <span
                                            class="font-semibold text-gray-900 dark:text-white">Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-500 dark:text-gray-400">Biaya layanan</span>
                                        <span class="text-gray-500 dark:text-gray-400">Rp0</span>
                                    </div>
                                    <div class="pt-3 border-t border-gray-100 dark:border-slate-700">
                                        <div class="flex justify-between">
                                            <span class="text-base font-semibold text-gray-900 dark:text-white">Total</span>
                                            <span
                                                class="text-xl font-bold text-primary">Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Checkout Button -->
                                <button id="checkoutBtn"
                                    class="w-full mt-6 bg-primary hover:bg-primary/90 text-white font-semibold py-3 rounded-xl transition shadow-md hover:shadow-lg">
                                    <i class="fas fa-lock mr-2 text-sm"></i>
                                    Lanjut ke Checkout
                                </button>

                                <!-- Trust Badges -->
                                <div class="mt-6 pt-4 border-t border-gray-100 dark:border-slate-700">
                                    <div class="flex justify-center gap-4">
                                        <div class="flex items-center gap-1 text-xs text-gray-500 dark:text-gray-400">
                                            <i class="fas fa-shield-alt text-primary text-sm"></i>
                                            Pembayaran Aman
                                        </div>
                                        <div class="flex items-center gap-1 text-xs text-gray-500 dark:text-gray-400">
                                            <i class="fas fa-headset text-primary text-sm"></i>
                                            Dukungan 24/7
                                        </div>
                                        <div class="flex items-center gap-1 text-xs text-gray-500 dark:text-gray-400">
                                            <i class="fas fa-check-circle text-primary text-sm"></i>
                                            Terpercaya
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @else
                <!-- Empty Cart State -->
                <div class="bg-white dark:bg-slate-900 rounded-2xl border border-gray-100 dark:border-slate-700 shadow-sm p-12 text-center">
                    <div class="w-24 h-24 bg-gray-100 dark:bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shopping-cart text-gray-300 dark:text-gray-600 text-3xl"></i>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">Keranjang Anda kosong</h2>
                    <p class="text-gray-500 dark:text-gray-400 text-sm mb-6 max-w-md mx-auto">
                        Belum ada layanan yang ditambahkan ke keranjang. Yuk, cari jasa yang Anda butuhkan!
                    </p>
                    <a href="{{ route('catalog.index') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-white font-medium rounded-xl hover:bg-primary/90 transition shadow-sm">
                        <i class="fas fa-search text-sm"></i>
                        Cari Jasa Sekarang
                    </a>
                    <!-- Trending categories -->
                    <div class="mt-8 pt-6 border-t border-gray-100 dark:border-slate-700">
                        <p class="text-xs text-gray-400 dark:text-gray-500 mb-3">Kategori populer:</p>
                        <div class="flex flex-wrap gap-2 justify-center">
                            <a href="{{ route('catalog.index', ['category' => ['Desain']]) }}"
                                class="px-3 py-1.5 bg-gray-100 dark:bg-slate-800 text-gray-600 dark:text-gray-400 text-xs rounded-full hover:bg-primary dark:hover:bg-primary hover:text-white transition">Desain</a>
                            <a href="{{ route('catalog.index', ['category' => ['Programming']]) }}"
                                class="px-3 py-1.5 bg-gray-100 dark:bg-slate-800 text-gray-600 dark:text-gray-400 text-xs rounded-full hover:bg-primary dark:hover:bg-primary hover:text-white transition">Programming</a>
                            <a href="{{ route('catalog.index', ['category' => ['Fotografi']]) }}"
                                class="px-3 py-1.5 bg-gray-100 dark:bg-slate-800 text-gray-600 dark:text-gray-400 text-xs rounded-full hover:bg-primary dark:hover:bg-primary hover:text-white transition">Fotografi</a>
                            <a href="{{ route('catalog.index', ['search' => 'UI/UX']) }}"
                                class="px-3 py-1.5 bg-gray-100 dark:bg-slate-800 text-gray-600 dark:text-gray-400 text-xs rounded-full hover:bg-primary dark:hover:bg-primary hover:text-white transition">UI/UX
                                Design</a>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>

    @push('styles')
        <style>
            .line-clamp-1 {
                display: -webkit-box;
                -webkit-line-clamp: 1;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            // Checkout button
            // Checkout feature coming soon
            document.getElementById('checkoutBtn')?.addEventListener('click', function() {

                alert('Checkout akan segera tersedia.');

            });
        </script>
    @endpush

@endsection
