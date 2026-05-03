@extends('layouts.app')
@section('content')
<div class="animate-fade-in">
    <!-- Hero Section with Large Search Bar -->
    <section class="mb-12 text-center">
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">Temukan Penyedia Jasa Terbaik</h1>
        <p class="text-gray-500 text-lg max-w-2xl mx-auto mb-8">Jelajahi ribuan penyedia jasa terpercaya sesuai kebutuhan Anda</p>

        <!-- Large Search Bar -->
        <div class="max-w-3xl mx-auto relative">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden flex items-center p-1 focus-within:ring-2 focus-within:ring-primary/50">
                <i class="fas fa-search text-gray-400 ml-4"></i>
                <input type="text" placeholder="Cari jasa atau penyedia (contoh: les matematika, desain logo)" class="flex-1 px-4 py-4 outline-none text-gray-700 placeholder-gray-400">
                <button class="bg-primary hover:bg-primary/90 text-white font-medium px-6 py-3 rounded-xl transition mr-1">Cari</button>
            </div>
            <div class="flex justify-center gap-3 mt-4 text-xs text-gray-500">
                <span class="flex items-center gap-1"><i class="fas fa-check-circle text-primary text-xs"></i> 10.000+ Penyedia</span>
                <span class="flex items-center gap-1"><i class="fas fa-star text-yellow-400 text-xs"></i> 4.8 Rating Rata-rata</span>
                <span class="flex items-center gap-1"><i class="fas fa-clock text-primary text-xs"></i> Respon Cepat</span>
            </div>
        </div>
    </section>

    <!-- Filter & Category Bar (Sticky) -->
    <section class="sticky top-20 z-40 bg-white/95 backdrop-blur-sm rounded-2xl shadow-sm border border-gray-100 p-4 mb-8">
        <div class="flex flex-wrap items-center gap-4 justify-between">
            <div class="flex flex-wrap gap-3">
                <select class="px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-1 focus:ring-primary">
                    <option>Semua Kategori</option>
                    <option>Les Privat</option>
                    <option>Desain & Kreatif</option>
                    <option>Teknologi & IT</option>
                    <option>Perbaikan Rumah</option>
                </select>
                <select class="px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-1 focus:ring-primary">
                    <option>Rating 4+ ⭐</option>
                    <option>Rating 3+ ⭐</option>
                    <option>Rating 2+ ⭐</option>
                </select>
                <div class="flex items-center gap-2 px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm">
                    <span class="text-gray-500">Harga:</span>
                    <input type="number" placeholder="Min" class="w-20 bg-transparent outline-none text-sm">
                    <span>-</span>
                    <input type="number" placeholder="Max" class="w-20 bg-transparent outline-none text-sm">
                </div>
                <select class="px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-1 focus:ring-primary">
                    <option>Semua Lokasi</option>
                    <option>Jakarta</option>
                    <option>Bandung</option>
                    <option>Surabaya</option>
                    <option>Online</option>
                </select>
            </div>
            <button class="text-sm text-primary font-medium hover:underline">Reset Filter</button>
        </div>
        <!-- Category Pills -->
        <div class="flex flex-wrap gap-2 mt-4 pt-3 border-t border-gray-100">
            <span class="px-4 py-1.5 bg-primary/10 text-primary rounded-full text-sm font-medium cursor-pointer hover:bg-primary hover:text-white transition">Les Privat</span>
            <span class="px-4 py-1.5 bg-gray-100 text-gray-600 rounded-full text-sm cursor-pointer hover:bg-primary hover:text-white transition">Desain</span>
            <span class="px-4 py-1.5 bg-gray-100 text-gray-600 rounded-full text-sm cursor-pointer hover:bg-primary hover:text-white transition">Teknologi</span>
            <span class="px-4 py-1.5 bg-gray-100 text-gray-600 rounded-full text-sm cursor-pointer hover:bg-primary hover:text-white transition">Perbaikan Rumah</span>
            <span class="px-4 py-1.5 bg-gray-100 text-gray-600 rounded-full text-sm cursor-pointer hover:bg-primary hover:text-white transition">Kesehatan</span>
            <span class="px-4 py-1.5 bg-gray-100 text-gray-600 rounded-full text-sm cursor-pointer hover:bg-primary hover:text-white transition">Fotografi</span>
        </div>
    </section>

    <!-- Section 1: Top Providers -->
    <section class="mb-16">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900">🏆 Penyedia Terbaik</h2>
                <p class="text-gray-500 mt-1">Dipilih berdasarkan rating dan performa terbaik</p>
            </div>
            <a href="#" class="text-primary text-sm font-medium hover:underline">Lihat semua →</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($topProviders as $provider)
            <div class="bg-white rounded-2xl p-5 shadow-sm hover:shadow-xl transition-all duration-300 hover-lift border border-gray-100 cursor-pointer">
                <div class="flex items-start gap-4">
                    <img src="{{ $provider['avatar'] ?? 'https://via.placeholder.com/100' }}" class="w-16 h-16 rounded-full object-cover border-2 border-primary/20">
                    <div class="flex-1">
                        <div class="flex items-center justify-between">
                            <h3 class="font-bold text-gray-900">{{ $provider['name'] ?? 'Nama tidak tersedia' }}</h3>
                            <span class="bg-yellow-100 text-yellow-700 text-xs font-bold px-2 py-0.5 rounded-full">{{ $provider['badge'] ?? 'Baru' }}</span>
                        </div>
                        <div class="flex items-center gap-1 mt-1">
                            <i class="fas fa-star text-yellow-400 text-sm"></i>
                            <span class="font-semibold text-sm">{{ $provider['rating'] ?? 0 }}</span>
                            <span class="text-gray-400 text-xs">({{ $provider['reviews'] ?? 0 }} ulasan)</span>
                        </div>
                        <p class="text-gray-500 text-xs mt-1">{{ $provider['category'] ?? 'Lainnya' }}</p>
                        <p class="text-primary font-bold text-lg mt-2">Mulai Rp{{ number_format($provider['price'] ?? 0,0,',','.') }}</p>
                    </div>
                </div>
                <div class="mt-3 pt-3 border-t border-gray-100 flex justify-between items-center">
                    <span class="text-xs text-gray-400"><i class="fas fa-shopping-bag"></i> {{ $provider['orders'] ?? 0 }} pesanan</span>
                    <button class="text-primary text-sm font-medium hover:underline">Lihat Profil →</button>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Section 2: New Providers -->
    <section class="mb-16">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900">🆕 Penyedia Baru</h2>
                <p class="text-gray-500 mt-1">Temukan talenta baru dengan potensi besar</p>
            </div>
            <a href="#" class="text-primary text-sm font-medium hover:underline">Lihat semua →</a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
            @foreach($newProviders as $provider)
            <div class="bg-white rounded-xl p-4 shadow-sm hover:shadow-md transition-all duration-300 cursor-pointer border border-gray-100">
                <div class="relative">
                    <img src="{{ $provider['avatar'] ?? 'https://via.placeholder.com/100' }}" class="w-16 h-16 rounded-full mx-auto object-cover border-2 border-primary/20">
                    <span class="absolute -top-1 -right-1 bg-green-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">Baru</span>
                </div>
                <h3 class="font-semibold text-gray-800 text-center mt-2 text-sm">{{ $provider['name'] ?? 'Nama tidak tersedia' }}</h3>
                <p class="text-gray-400 text-xs text-center">{{ $provider['category'] ?? 'Lainnya' }}</p>
                <div class="flex justify-center items-center gap-1 mt-1">
                    <i class="fas fa-star text-yellow-400 text-xs"></i>
                    <span class="text-xs font-semibold">{{ $provider['rating'] ?? 0 }}</span>
                </div>
                <p class="text-primary font-bold text-center text-sm mt-2">Rp{{ number_format($provider['price'] ?? 0,0,',','.') }}</p>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Section 3: Active Providers -->
    <section class="mb-16">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900">⚡ Penyedia Aktif</h2>
                <p class="text-gray-500 mt-1">Respon cepat & siap melayani</p>
            </div>
            <a href="#" class="text-primary text-sm font-medium hover:underline">Lihat semua →</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($activeProviders as $provider)
            <div class="bg-white rounded-2xl p-5 shadow-sm hover:shadow-xl transition-all duration-300 hover-lift border border-gray-100 cursor-pointer">
                <div class="flex gap-4">
                    <img src="{{ $provider['avatar'] ?? 'https://via.placeholder.com/100' }}" class="w-14 h-14 rounded-full object-cover">
                    <div class="flex-1">
                        <div class="flex items-center justify-between">
                            <h3 class="font-bold text-gray-900">{{ $provider['name'] ?? 'Nama tidak tersedia' }}</h3>
                            <span class="bg-green-100 text-green-700 text-xs font-bold px-2 py-0.5 rounded-full">{{ $provider['badge'] ?? 'Aktif' }}</span>
                        </div>
                        <div class="flex items-center gap-2 mt-1">
                            <div class="flex items-center gap-1">
                                <i class="fas fa-star text-yellow-400 text-xs"></i>
                                <span class="font-semibold text-sm">{{ $provider['rating'] ?? 0 }}</span>
                            </div>
                            <span class="text-gray-300">|</span>
                            <span class="text-gray-500 text-xs">{{ $provider['category'] ?? 'Lainnya' }}</span>
                        </div>
                        <div class="flex items-center gap-3 mt-2">
                            <span class="text-primary font-bold">Rp{{ number_format($provider['price'] ?? 0,0,',','.') }}</span>
                            <span class="text-xs text-green-600"><i class="fas fa-clock"></i> Respon {{ $provider['response'] ?? '< 1 jam' }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Main Provider List (Core) -->
    <section class="mb-16">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Semua Penyedia Jasa</h2>
                <p class="text-gray-500 mt-1">Menampilkan {{ count($allProviders) }} penyedia berdasarkan rating & aktivitas terbaru</p>
            </div>
            <select class="px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm">
                <option>Urutkan: Rating Tertinggi</option>
                <option>Urutkan: Harga Terendah</option>
                <option>Urutkan: Terbaru</option>
                <option>Urutkan: Paling Aktif</option>
            </select>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($allProviders as $provider)
            <div class="group bg-white rounded-2xl p-5 shadow-sm hover:shadow-xl transition-all duration-300 hover:scale-[1.02] border border-gray-100">
                <div class="flex gap-4">
                    <img src="{{ $provider['avatar'] ?? 'https://via.placeholder.com/100' }}" class="w-16 h-16 rounded-full object-cover border-2 border-primary/10">
                    <div class="flex-1">
                        <div class="flex items-center justify-between flex-wrap gap-1">
                            <h3 class="font-bold text-gray-900">{{ $provider['name'] ?? 'Nama tidak tersedia' }}</h3>
                            @if(isset($provider['badge']))
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full
                                    @if($provider['badge'] == 'Top Rated') bg-yellow-100 text-yellow-700
                                    @elseif($provider['badge'] == 'Aktif') bg-green-100 text-green-700
                                    @else bg-blue-100 text-blue-700 @endif">
                                    {{ $provider['badge'] }}
                                </span>
                            @endif
                        </div>
                        <div class="flex items-center gap-2 mt-1">
                            <div class="flex items-center gap-1">
                                <i class="fas fa-star text-yellow-400 text-xs"></i>
                                <span class="font-semibold text-sm">{{ $provider['rating'] ?? 0 }}</span>
                            </div>
                            <span class="text-gray-400 text-xs">({{ $provider['reviews'] ?? 0 }} ulasan)</span>
                            <span class="text-gray-300">•</span>
                            <span class="text-gray-500 text-xs">{{ $provider['category'] ?? 'Lainnya' }}</span>
                        </div>
                        <p class="text-gray-500 text-xs mt-1 line-clamp-1">{{ $provider['desc'] ?? 'Deskripsi tidak tersedia' }}</p>
                        <div class="flex items-center gap-3 mt-2">
                            <span class="text-primary font-bold text-lg">Rp{{ number_format($provider['price'] ?? 0,0,',','.') }}</span>
                            <span class="text-xs text-gray-400"><i class="fas fa-map-marker-alt"></i> {{ $provider['location'] ?? '-' }}</span>
                        </div>
                        <div class="mt-3 pt-2 border-t border-gray-100 flex justify-between items-center">
                            <span class="text-xs text-gray-400"><i class="fas fa-shopping-bag"></i> {{ $provider['orders'] ?? 0 }} pesanan</span>
                            <button class="px-4 py-1.5 bg-primary/10 text-primary text-sm font-medium rounded-full hover:bg-primary hover:text-white transition-all duration-200">Lihat Profil →</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- Pagination -->
        <div class="flex justify-center gap-2 mt-10">
            <button class="px-3 py-2 rounded-lg border border-gray-200 text-gray-500 hover:bg-gray-50"><i class="fas fa-chevron-left text-sm"></i></button>
            <button class="px-3 py-2 rounded-lg bg-primary text-white">1</button>
            <button class="px-3 py-2 rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50">2</button>
            <button class="px-3 py-2 rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50">3</button>
            <button class="px-3 py-2 rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50">4</button>
            <button class="px-3 py-2 rounded-lg border border-gray-200 text-gray-500 hover:bg-gray-50"><i class="fas fa-chevron-right text-sm"></i></button>
        </div>
    </section>

    <!-- Provider Detail Preview Section -->
    <section class="mb-16 bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden" id="providerDetail">
        <div class="bg-gradient-to-r from-primary to-blue-600 px-8 py-8 text-white">
            <div class="flex items-center gap-6 flex-wrap">
                <img src="https://randomuser.me/api/portraits/women/44.jpg" class="w-24 h-24 rounded-full border-4 border-white shadow-lg">
                <div>
                    <div class="flex items-center gap-3 flex-wrap">
                        <h2 class="text-2xl font-bold">Bunda Sari</h2>
                        <span class="bg-yellow-400 text-yellow-800 text-xs font-bold px-2 py-1 rounded-full">Top Rated</span>
                        <span class="bg-green-400/30 text-white text-xs px-2 py-1 rounded-full">Aktif</span>
                    </div>
                    <div class="flex items-center gap-2 mt-2">
                        <i class="fas fa-star text-yellow-300"></i>
                        <span class="font-semibold">5.0</span>
                        <span class="text-white/80 text-sm">(342 ulasan)</span>
                        <span class="text-white/50">•</span>
                        <span class="text-sm">Les Privat - Matematika</span>
                    </div>
                    <p class="mt-2 text-white/90 max-w-2xl">Guru matematika berpengalaman dengan metode belajar yang mudah dipahami. Tersedia untuk SD, SMP, dan SMA.</p>
                </div>
            </div>
        </div>
        <div class="p-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <h3 class="font-bold text-xl mb-4">📋 Layanan yang Ditawarkan</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center p-4 bg-gray-50 rounded-xl">
                            <div><p class="font-semibold">Les Matematika SD</p><p class="text-sm text-gray-500">4 sesi per bulan</p></div>
                            <span class="text-primary font-bold">Rp200.000/bulan</span>
                        </div>
                        <div class="flex justify-between items-center p-4 bg-gray-50 rounded-xl">
                            <div><p class="font-semibold">Les Matematika SMP</p><p class="text-sm text-gray-500">4 sesi per bulan</p></div>
                            <span class="text-primary font-bold">Rp250.000/bulan</span>
                        </div>
                        <div class="flex justify-between items-center p-4 bg-gray-50 rounded-xl">
                            <div><p class="font-semibold">Les Matematika SMA</p><p class="text-sm text-gray-500">4 sesi per bulan</p></div>
                            <span class="text-primary font-bold">Rp300.000/bulan</span>
                        </div>
                    </div>
                    <div class="mt-8">
                        <h3 class="font-bold text-xl mb-4">⭐ Ulasan Terbaru</h3>
                        <div class="space-y-4">
                            <div class="border-b border-gray-100 pb-4">
                                <div class="flex items-center gap-2"><img src="https://randomuser.me/api/portraits/men/1.jpg" class="w-8 h-8 rounded-full"><div><p class="font-semibold text-sm">Andi Prasetyo</p><div class="flex items-center gap-1"><i class="fas fa-star text-yellow-400 text-xs"></i><i class="fas fa-star text-yellow-400 text-xs"></i><i class="fas fa-star text-yellow-400 text-xs"></i><i class="fas fa-star text-yellow-400 text-xs"></i><i class="fas fa-star text-yellow-400 text-xs"></i></div></div></div>
                                <p class="text-gray-600 text-sm mt-2">Sangat membantu anak saya yang kesulitan matematika. Nilainya meningkat drastis!</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 rounded-2xl p-6 h-fit sticky top-32">
                    <h3 class="font-bold text-lg mb-4">💳 Mulai dari</h3>
                    <p class="text-3xl font-bold text-primary">Rp50.000<span class="text-sm text-gray-500 font-normal">/ sesi</span></p>
                    <button class="w-full mt-4 bg-primary hover:bg-primary/90 text-white font-semibold py-3 rounded-xl transition shadow-md">Pesan Sekarang</button>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <p class="text-sm text-gray-500 flex items-center gap-2"><i class="fas fa-check-circle text-primary"></i> Garansi kepuasan</p>
                        <p class="text-sm text-gray-500 flex items-center gap-2 mt-2"><i class="fas fa-clock text-primary"></i> Respon cepat</p>
                        <p class="text-sm text-gray-500 flex items-center gap-2 mt-2"><i class="fas fa-shield-alt text-primary"></i> Pembayaran aman</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bottom CTA Section -->
    <section class="py-16">
        <div class="bg-gradient-to-r from-primary to-blue-600 rounded-3xl p-12 md:p-16 text-center text-white shadow-xl">
            <i class="fas fa-store text-5xl mb-4 opacity-80"></i>
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Mulai Menawarkan Jasa Anda di VEXORA</h2>
            <p class="text-blue-100 text-lg max-w-xl mx-auto mb-8">Jangkau ribuan pengguna dan kembangkan bisnis Anda bersama VEXORA</p>
            <a href="#" class="inline-block bg-white text-primary font-semibold px-8 py-3 rounded-full hover:bg-gray-100 transition shadow-md">Daftar Sebagai Penyedia →</a>
        </div>
    </section>
</div>

@push('styles')
<style>
    .animate-fade-in {
        animation: fadeIn 0.5s ease-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    .hover-lift {
        transition: all 0.35s cubic-bezier(0.2, 0, 0, 1);
    }
    .hover-lift:hover {
        transform: translateY(-6px);
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
    document.addEventListener('DOMContentLoaded', function() {
        // Category pill click handler
        document.querySelectorAll('.bg-gray-100.text-gray-600, .bg-primary\\/10.text-primary').forEach(function(el) {
            el.addEventListener('click', function() {
                document.querySelectorAll('.bg-gray-100.text-gray-600, .bg-primary\\/10.text-primary').forEach(function(p) {
                    p.classList.remove('bg-primary/10', 'text-primary');
                    p.classList.add('bg-gray-100', 'text-gray-600');
                });
                this.classList.remove('bg-gray-100', 'text-gray-600');
                this.classList.add('bg-primary/10', 'text-primary');
            });
        });
    });
</script>
@endpush
@endsection
