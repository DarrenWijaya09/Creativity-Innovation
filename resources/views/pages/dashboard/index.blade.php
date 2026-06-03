@extends('layouts.app')

@section('title', 'Dashboard - VEXORA')

@section('content')
<div class="min-h-screen bg-white dark:bg-gray-950">

    <main class="max-w-7xl mx-auto px-6 lg:px-8 py-8 lg:py-12">

        <!-- ==================== DASHBOARD HEADER ==================== -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 mb-10">
            <div>
                <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white">
                    Halo, {{ auth()->user()->name }} <span class="inline-block animate-wave">👋</span>
                </h1>
                <p class="text-gray-500 dark:text-gray-400 mt-1">Kelola aktivitas, jasa tersimpan, dan pesananmu di satu tempat.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('catalog.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white text-sm font-medium rounded-full hover:bg-primary/90 transition shadow-sm">
                    <i class="fas fa-search text-sm"></i> Cari Jasa
                </a>
                <a href="{{ route('saved.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-50 dark:bg-slate-800 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-full hover:bg-gray-100 dark:hover:bg-slate-700 transition border border-gray-200 dark:border-slate-700">
                    <i class="fas fa-heart text-sm"></i> Wishlist
                </a>
                <a href="" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-50 dark:bg-slate-800 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-full hover:bg-gray-100 dark:hover:bg-slate-700 transition border border-gray-200 dark:border-slate-700">
                    <i class="fas fa-shopping-bag text-sm"></i> Lihat Pesanan
                </a>
            </div>
        </div>

        <!-- ==================== SUMMARY STATS CARDS ==================== -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-12">
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-700 hover:shadow-md transition group">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Total Pesanan</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ number_format($totalOrders) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-50 dark:bg-blue-950/30 rounded-xl flex items-center justify-center group-hover:bg-blue-100 dark:group-hover:bg-blue-950/50 transition">
                        <i class="fas fa-shopping-bag text-primary text-xl"></i>
                    </div>
                </div>
                @if($newOrders > 0)
                    <p class="text-xs text-green-600 dark:text-green-400 mt-3">↑ +{{ $newOrders }} dari bulan lalu</p>
                @else
                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-3">Tidak ada pesanan baru</p>
                @endif
            </div>
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-700 hover:shadow-md transition group">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Wishlist</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ number_format($totalSaved) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-pink-50 dark:bg-pink-950/30 rounded-xl flex items-center justify-center group-hover:bg-pink-100 dark:group-hover:bg-pink-950/50 transition">
                        <i class="fas fa-heart text-pink-500 text-xl"></i>
                    </div>
                </div>
                @if($newSaved > 0)
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-3">+{{ $newSaved }} jasa baru ditambahkan</p>
                @else
                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-3">Belum ada jasa baru</p>
                @endif
            </div>
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-700 hover:shadow-md transition group">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Pesanan Aktif</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ number_format($activeOrders) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-50 dark:bg-green-950/30 rounded-xl flex items-center justify-center group-hover:bg-green-100 dark:group-hover:bg-green-950/50 transition">
                        <i class="fas fa-clock text-green-500 text-xl"></i>
                    </div>
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-3">Sedang diproses</p>
            </div>
        </div>

        <!-- ==================== PESANAN TERBARU ==================== -->
        <div class="mb-12">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">Pesanan Terbaru</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Update status pesanan Anda</p>
                </div>
                <a href="" class="text-primary text-sm font-medium hover:underline">Lihat semua →</a>
            </div>
            <div class="space-y-3">
                @forelse($recentOrders as $order)
                <div class="bg-white dark:bg-slate-900 rounded-xl p-4 border border-gray-100 dark:border-slate-700 hover:shadow-md transition">
                    <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
                        <div class="flex gap-4 flex-1">
                            <img src="{{ optional($order->service)->image ? asset('storage/' . $order->service->image) : 'https://placehold.co/60x60/png?text=No+Image' }}"
                                 alt="{{ optional($order->service)->title }}"
                                 class="w-14 h-14 rounded-xl object-cover">
                            <div>
                                <h3 class="font-semibold text-gray-900 dark:text-white">{{ optional($order->service)->title ?? 'Jasa tidak tersedia' }}</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ optional(optional($order->service)->provider)->name ?? 'Penyedia' }}</p>
                                <div class="flex items-center gap-3 mt-1">
                                    <span class="text-xs text-gray-400 dark:text-gray-500"><i class="far fa-calendar-alt mr-1"></i> {{ $order->created_at->format('d M Y') }}</span>
                                    <span class="text-sm font-semibold text-primary">Rp{{ number_format($order->total_price, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            @php
                                $statusColors = [
                                    'pending' => 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400',
                                    'processing' => 'bg-yellow-100 dark:bg-yellow-950/30 text-yellow-700 dark:text-yellow-400',
                                    'completed' => 'bg-green-100 dark:bg-green-950/30 text-green-700 dark:text-green-400',
                                    'cancelled' => 'bg-red-100 dark:bg-red-950/30 text-red-700 dark:text-red-400',
                                ];
                            @endphp
                            <span class="px-3 py-1.5 {{ $statusColors[$order->status] ?? 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400' }} text-xs font-medium rounded-full">
                                {{ ucfirst($order->status) }}
                            </span>
                            <a href="{{ route('orders.show', $order->id) }}" class="text-primary text-sm font-medium hover:underline">Detail →</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-8 bg-gray-50 dark:bg-slate-800 rounded-xl">
                    <i class="fas fa-shopping-bag text-gray-300 dark:text-gray-600 text-3xl mb-2"></i>
                    <p class="text-gray-500 dark:text-gray-400 text-sm">Belum ada pesanan</p>
                    <a href="{{ route('catalog.index') }}" class="text-primary text-sm hover:underline mt-1 inline-block">Mulai berbelanja →</a>
                </div>
                @endforelse
            </div>
        </div>

        <!-- ==================== SAVED SERVICES + CONTINUE BROWSING GRID ==================== -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">

            <!-- Saved Services Preview (Wishlist) -->
            <div>
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white">Jasa Tersimpan</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Jasa yang Anda simpan</p>
                    </div>
                    <a href="{{ route('saved.index') }}" class="text-primary text-sm font-medium hover:underline">Lihat semua →</a>
                </div>
                <div class="space-y-3">
                    @forelse($savedServices as $service)
                    <div class="bg-white dark:bg-slate-900 rounded-xl p-3 border border-gray-100 dark:border-slate-700 flex items-center gap-3 hover:shadow-sm transition group">
                        <img src="{{ $service->image ? asset('storage/' . $service->image) : 'https://placehold.co/50x50/png?text=No+Image' }}"
                             alt="{{ $service->title }}"
                             class="w-12 h-12 rounded-lg object-cover">
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-900 dark:text-white text-sm line-clamp-1">{{ $service->title }}</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ optional($service->provider)->name ?? 'Penyedia' }}</p>
                            <p class="font-bold text-primary text-sm mt-1">Rp{{ number_format($service->price, 0, ',', '.') }}</p>
                        </div>
                        <form action="{{ route('saved.destroy', $service->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-600 dark:text-red-400 dark:hover:text-red-300 transition p-1">
                                <i class="fas fa-heart"></i>
                            </button>
                        </form>
                    </div>
                    @empty
                    <div class="bg-white dark:bg-slate-900 rounded-xl p-8 border border-gray-100 dark:border-slate-700 text-center">
                        <i class="fas fa-heart text-gray-300 dark:text-gray-600 text-3xl mb-2"></i>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">Belum ada jasa tersimpan</p>
                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Simpan jasa favoritmu untuk dilihat nanti</p>
                        <a href="{{ route('catalog.index') }}" class="inline-block mt-3 text-primary text-sm hover:underline">Cari Jasa →</a>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Continue Browsing / Recently Viewed -->
            <div>
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white">Terakhir Dilihat</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Lanjutkan eksplorasi Anda</p>
                    </div>
                    <a href="{{ route('catalog.index') }}" class="text-primary text-sm font-medium hover:underline">Lihat semua →</a>
                </div>
                <div class="space-y-3">
                    @forelse($recentlyViewed as $service)
                    <div class="bg-white dark:bg-slate-900 rounded-xl p-3 border border-gray-100 dark:border-slate-700 flex items-center gap-3 hover:shadow-sm transition group">
                        <img src="{{ $service->image ? asset('storage/' . $service->image) : 'https://placehold.co/50x50/png?text=No+Image' }}"
                             alt="{{ $service->title }}"
                             class="w-12 h-12 rounded-lg object-cover">
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-900 dark:text-white text-sm line-clamp-1">{{ $service->title }}</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ optional($service->provider)->name ?? 'Penyedia' }}</p>
                            <p class="font-bold text-primary text-sm mt-1">Rp{{ number_format($service->price, 0, ',', '.') }}</p>
                        </div>
                        <a href="{{ route('catalog.show', $service->slug) }}" class="text-primary text-sm font-medium hover:underline">Lihat</a>
                    </div>
                    @empty
                    <div class="bg-white dark:bg-slate-900 rounded-xl p-8 border border-gray-100 dark:border-slate-700 text-center">
                        <i class="fas fa-history text-gray-300 dark:text-gray-600 text-3xl mb-2"></i>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">Belum ada riwayat dilihat</p>
                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Jelajahi jasa yang Anda minati</p>
                        <a href="{{ route('catalog.index') }}" class="inline-block mt-3 text-primary text-sm hover:underline">Mulai Jelajahi →</a>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- ==================== NOTIFICATION FEED ==================== -->
        <div class="mb-12">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">Notifikasi Terbaru</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Update aktivitas Anda</p>
                </div>
                <a href="" class="text-primary text-sm font-medium hover:underline">Lihat semua →</a>
            </div>
            <div class="space-y-2">
                @forelse($notifications as $notification)
                <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-slate-800 transition">
                    <div class="w-8 h-8 {{ $notification->bg_color ?? 'bg-blue-50 dark:bg-blue-950/30' }} rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="{{ $notification->icon ?? 'fas fa-bell' }} {{ $notification->icon_color ?? 'text-primary' }} text-xs"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-gray-800 dark:text-gray-200">{!! $notification->message !!}</p>
                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">{{ $notification->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                @empty
                <div class="text-center py-8 bg-gray-50 dark:bg-slate-800 rounded-xl">
                    <i class="fas fa-bell-slash text-gray-300 dark:text-gray-600 text-3xl mb-2"></i>
                    <p class="text-gray-500 dark:text-gray-400 text-sm">Belum ada notifikasi</p>
                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Kami akan memberitahu Anda jika ada update</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- ==================== QUICK ACTION STRIP ==================== -->
        <div class="bg-gradient-to-r from-primary/5 to-blue-50 dark:from-primary/10 dark:to-blue-950/30 rounded-2xl p-6 border border-primary/10 dark:border-primary/20">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div>
                    <h3 class="font-semibold text-gray-900 dark:text-white">Butuh bantuan cepat?</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Akses fitur favorit Anda dengan mudah</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('saved.index') }}" class="px-4 py-2 bg-white dark:bg-slate-900 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-full hover:bg-gray-50 dark:hover:bg-slate-800 transition shadow-sm border border-gray-200 dark:border-slate-700">
                        <i class="fas fa-heart mr-2 text-pink-500"></i> Wishlist
                    </a>
                    <a href="{{ route('catalog.index') }}" class="px-4 py-2 bg-white dark:bg-slate-900 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-full hover:bg-gray-50 dark:hover:bg-slate-800 transition shadow-sm border border-gray-200 dark:border-slate-700">
                        <i class="fas fa-search mr-2 text-primary"></i> Cari Jasa
                    </a>
                    <a href="" class="px-4 py-2 bg-white dark:bg-slate-900 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-full hover:bg-gray-50 dark:hover:bg-slate-800 transition shadow-sm border border-gray-200 dark:border-slate-700">
                        <i class="fas fa-user-edit mr-2 text-gray-500 dark:text-gray-400"></i> Edit Profil
                    </a>
                    <a href="{{ route('cart.index') }}" class="px-4 py-2 bg-white dark:bg-slate-900 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-full hover:bg-gray-50 dark:hover:bg-slate-800 transition shadow-sm border border-gray-200 dark:border-slate-700">
                        <i class="fas fa-shopping-cart mr-2 text-primary"></i> Keranjang
                    </a>
                </div>
            </div>
        </div>

    </main>
</div>

@push('styles')
<style>
    @keyframes wave {
        0%, 100% { transform: rotate(0deg); }
        25% { transform: rotate(15deg); }
        75% { transform: rotate(-10deg); }
    }

    .animate-wave {
        animation: wave 0.6s ease-in-out;
        display: inline-block;
    }

    .animate-wave:hover {
        animation: wave 0.6s ease-in-out;
    }

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
    // Simple hover animation for wave emoji
    const waveEmoji = document.querySelector('.animate-wave');
    if (waveEmoji) {
        waveEmoji.addEventListener('mouseenter', function() {
            this.style.animation = 'none';
            setTimeout(() => {
                this.style.animation = 'wave 0.6s ease-in-out';
            }, 10);
        });
    }
</script>
@endpush

@endsection
