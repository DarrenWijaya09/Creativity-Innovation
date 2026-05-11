@extends('layouts.app')

@section('title', 'Dashboard - VEXORA')

@section('content')
<div class="min-h-screen bg-white">

    <!-- ==================== SINGLE MAIN NAVBAR ONLY ==================== -->
    <!-- Navbar is already in layouts/app.blade.php -->
    <!-- This ensures NO duplicate navigation -->

    <main class="max-w-7xl mx-auto px-6 lg:px-8 py-8 lg:py-12">

        <!-- ==================== DASHBOARD HEADER ==================== -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 mb-10">
            <div>
                <h1 class="text-3xl lg:text-4xl font-bold text-gray-900">
                    Halo, Darren <span class="inline-block animate-wave">👋</span>
                </h1>
                <p class="text-gray-500 mt-1">Senang melihat Anda kembali. Ada 3 update baru untuk Anda.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="#" class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white text-sm font-medium rounded-full hover:bg-primary/90 transition shadow-sm">
                    <i class="fas fa-search text-sm"></i> Cari Jasa
                </a>
                <a href="#" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-50 text-gray-700 text-sm font-medium rounded-full hover:bg-gray-100 transition border border-gray-200">
                    <i class="fas fa-heart text-sm"></i> Wishlist
                </a>
                <a href="#" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-50 text-gray-700 text-sm font-medium rounded-full hover:bg-gray-100 transition border border-gray-200">
                    <i class="fas fa-shopping-bag text-sm"></i> Lihat Pesanan
                </a>
            </div>
        </div>

        <!-- ==================== SUMMARY STATS CARDS ==================== -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-12">
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition group">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Total Pesanan</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">8</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center group-hover:bg-blue-100 transition">
                        <i class="fas fa-shopping-bag text-primary text-xl"></i>
                    </div>
                </div>
                <p class="text-xs text-green-600 mt-3">↑ +2 dari bulan lalu</p>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition group">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Wishlist</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">12</p>
                    </div>
                    <div class="w-12 h-12 bg-pink-50 rounded-xl flex items-center justify-center group-hover:bg-pink-100 transition">
                        <i class="fas fa-heart text-pink-500 text-xl"></i>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-3">3 jasa baru ditambahkan</p>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition group">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Pesanan Aktif</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">3</p>
                    </div>
                    <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center group-hover:bg-green-100 transition">
                        <i class="fas fa-clock text-green-500 text-xl"></i>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-3">Sedang diproses</p>
            </div>
        </div>

        <!-- ==================== PESANAN TERBARU ==================== -->
        <div class="mb-12">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Pesanan Terbaru</h2>
                    <p class="text-sm text-gray-500 mt-0.5">Update status pesanan Anda</p>
                </div>
                <a href="#" class="text-primary text-sm font-medium hover:underline">Lihat semua →</a>
            </div>
            <div class="space-y-3">
                <!-- Order 1 -->
                <div class="bg-white rounded-xl p-4 border border-gray-100 hover:shadow-md transition">
                    <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
                        <div class="flex gap-4 flex-1">
                            <img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=60&h=60&fit=crop" alt="Service" class="w-14 h-14 rounded-xl object-cover">
                            <div>
                                <h3 class="font-semibold text-gray-900">Les Matematika SMA</h3>
                                <p class="text-sm text-gray-500">Bunda Sari</p>
                                <div class="flex items-center gap-3 mt-1">
                                    <span class="text-xs text-gray-400"><i class="far fa-calendar-alt mr-1"></i> 2 Mei 2025</span>
                                    <span class="text-sm font-semibold text-primary">Rp50.000</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="px-3 py-1.5 bg-yellow-100 text-yellow-700 text-xs font-medium rounded-full">Diproses</span>
                            <button class="text-primary text-sm font-medium hover:underline">Detail →</button>
                        </div>
                    </div>
                </div>
                <!-- Order 2 -->
                <div class="bg-white rounded-xl p-4 border border-gray-100 hover:shadow-md transition">
                    <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
                        <div class="flex gap-4 flex-1">
                            <img src="https://images.unsplash.com/photo-1626785774573-4b799315345d?w=60&h=60&fit=crop" alt="Service" class="w-14 h-14 rounded-xl object-cover">
                            <div>
                                <h3 class="font-semibold text-gray-900">Desain Logo Profesional</h3>
                                <p class="text-sm text-gray-500">Design Studio ID</p>
                                <div class="flex items-center gap-3 mt-1">
                                    <span class="text-xs text-gray-400"><i class="far fa-calendar-alt mr-1"></i> 28 April 2025</span>
                                    <span class="text-sm font-semibold text-primary">Rp250.000</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="px-3 py-1.5 bg-green-100 text-green-700 text-xs font-medium rounded-full">Selesai</span>
                            <button class="text-primary text-sm font-medium hover:underline">Detail →</button>
                        </div>
                    </div>
                </div>
                <!-- Order 3 -->
                <div class="bg-white rounded-xl p-4 border border-gray-100 hover:shadow-md transition">
                    <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
                        <div class="flex gap-4 flex-1">
                            <img src="https://images.unsplash.com/photo-1621905251189-08b45d6a269e?w=60&h=60&fit=crop" alt="Service" class="w-14 h-14 rounded-xl object-cover">
                            <div>
                                <h3 class="font-semibold text-gray-900">Perbaikan AC & Kulkas</h3>
                                <p class="text-sm text-gray-500">Technician Plus</p>
                                <div class="flex items-center gap-3 mt-1">
                                    <span class="text-xs text-gray-400"><i class="far fa-calendar-alt mr-1"></i> 25 April 2025</span>
                                    <span class="text-sm font-semibold text-primary">Rp150.000</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="px-3 py-1.5 bg-gray-100 text-gray-600 text-xs font-medium rounded-full">Pending</span>
                            <button class="text-primary text-sm font-medium hover:underline">Detail →</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ==================== WISHLIST + CONTINUE BROWSING GRID ==================== -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">

            <!-- Wishlist Preview -->
            <div>
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">Wishlist</h2>
                        <p class="text-sm text-gray-500 mt-0.5">Jasa yang Anda simpan</p>
                    </div>
                    <a href="#" class="text-primary text-sm font-medium hover:underline">Lihat semua →</a>
                </div>
                <div class="space-y-3">
                    <div class="bg-white rounded-xl p-3 border border-gray-100 flex items-center gap-3 hover:shadow-sm transition">
                        <img src="https://images.unsplash.com/photo-1543269865-cbf427effbad?w=50&h=50&fit=crop" alt="Service" class="w-12 h-12 rounded-lg object-cover">
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-900 text-sm">Les Bahasa Inggris</h4>
                            <p class="text-xs text-gray-500">English Buddy</p>
                            <p class="font-bold text-primary text-sm mt-1">Rp75.000</p>
                        </div>
                        <button class="text-red-500 hover:text-red-600 transition"><i class="fas fa-heart"></i></button>
                    </div>
                    <div class="bg-white rounded-xl p-3 border border-gray-100 flex items-center gap-3 hover:shadow-sm transition">
                        <img src="https://images.unsplash.com/photo-1547658719-da2b51169166?w=50&h=50&fit=crop" alt="Service" class="w-12 h-12 rounded-lg object-cover">
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-900 text-sm">Website Company Profile</h4>
                            <p class="text-xs text-gray-500">WebDev Expert</p>
                            <p class="font-bold text-primary text-sm mt-1">Rp1.500.000</p>
                        </div>
                        <button class="text-red-500 hover:text-red-600 transition"><i class="fas fa-heart"></i></button>
                    </div>
                    <div class="bg-white rounded-xl p-3 border border-gray-100 flex items-center gap-3 hover:shadow-sm transition">
                        <img src="https://images.unsplash.com/photo-1519823551278-64ac92734fb1?w=50&h=50&fit=crop" alt="Service" class="w-12 h-12 rounded-lg object-cover">
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-900 text-sm">Pijat Kebugaran</h4>
                            <p class="text-xs text-gray-500">Sehat Sejati</p>
                            <p class="font-bold text-primary text-sm mt-1">Rp120.000</p>
                        </div>
                        <button class="text-gray-300 hover:text-red-500 transition"><i class="far fa-heart"></i></button>
                    </div>
                </div>
            </div>

            <!-- Continue Browsing / Recently Viewed -->
            <div>
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">Terakhir Dilihat</h2>
                        <p class="text-sm text-gray-500 mt-0.5">Lanjutkan eksplorasi Anda</p>
                    </div>
                    <a href="#" class="text-primary text-sm font-medium hover:underline">Lihat semua →</a>
                </div>
                <div class="space-y-3">
                    <div class="bg-white rounded-xl p-3 border border-gray-100 flex items-center gap-3 hover:shadow-sm transition">
                        <img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=50&h=50&fit=crop" alt="Service" class="w-12 h-12 rounded-lg object-cover">
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-900 text-sm">Les Matematika SD</h4>
                            <p class="text-xs text-gray-500">Bunda Sari</p>
                            <p class="font-bold text-primary text-sm mt-1">Rp40.000</p>
                        </div>
                        <button class="text-primary text-sm font-medium hover:underline">Lihat</button>
                    </div>
                    <div class="bg-white rounded-xl p-3 border border-gray-100 flex items-center gap-3 hover:shadow-sm transition">
                        <img src="https://images.unsplash.com/photo-1626785774573-4b799315345d?w=50&h=50&fit=crop" alt="Service" class="w-12 h-12 rounded-lg object-cover">
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-900 text-sm">Desain UI/UX</h4>
                            <p class="text-xs text-gray-500">Creative Studio</p>
                            <p class="font-bold text-primary text-sm mt-1">Rp350.000</p>
                        </div>
                        <button class="text-primary text-sm font-medium hover:underline">Lihat</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ==================== NOTIFICATION FEED ==================== -->
        <div class="mb-12">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Notifikasi Terbaru</h2>
                    <p class="text-sm text-gray-500 mt-0.5">Update aktivitas Anda</p>
                </div>
                <a href="#" class="text-primary text-sm font-medium hover:underline">Lihat semua →</a>
            </div>
            <div class="space-y-2">
                <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-gray-50 transition">
                    <div class="w-8 h-8 bg-blue-50 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-check text-primary text-xs"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-gray-800">Pesanan Anda <span class="font-medium">Les Matematika SMA</span> telah selesai</p>
                        <p class="text-xs text-gray-400 mt-0.5">2 jam yang lalu</p>
                    </div>
                </div>
                <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-gray-50 transition">
                    <div class="w-8 h-8 bg-green-50 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-tag text-green-500 text-xs"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-gray-800">Promo spesial: <span class="font-medium">diskon 20%</span> untuk jasa desain</p>
                        <p class="text-xs text-gray-400 mt-0.5">5 jam yang lalu</p>
                    </div>
                </div>
                <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-gray-50 transition">
                    <div class="w-8 h-8 bg-purple-50 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-comment text-purple-500 text-xs"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-gray-800"><span class="font-medium">Design Studio ID</span> merespon pesan Anda</p>
                        <p class="text-xs text-gray-400 mt-0.5">1 hari yang lalu</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- ==================== QUICK ACTION STRIP ==================== -->
        <div class="bg-gradient-to-r from-primary/5 to-blue-50 rounded-2xl p-6 border border-primary/10">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div>
                    <h3 class="font-semibold text-gray-900">Butuh bantuan cepat?</h3>
                    <p class="text-sm text-gray-500 mt-0.5">Akses fitur favorit Anda dengan mudah</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="#" class="px-4 py-2 bg-white text-gray-700 text-sm font-medium rounded-full hover:bg-gray-50 transition shadow-sm border border-gray-200">
                        <i class="fas fa-heart mr-2 text-pink-500"></i> Wishlist
                    </a>
                    <a href="#" class="px-4 py-2 bg-white text-gray-700 text-sm font-medium rounded-full hover:bg-gray-50 transition shadow-sm border border-gray-200">
                        <i class="fas fa-search mr-2 text-primary"></i> Cari Jasa
                    </a>
                    <a href="#" class="px-4 py-2 bg-white text-gray-700 text-sm font-medium rounded-full hover:bg-gray-50 transition shadow-sm border border-gray-200">
                        <i class="fas fa-user-edit mr-2 text-gray-500"></i> Edit Profil
                    </a>
                    <a href="#" class="px-4 py-2 bg-white text-gray-700 text-sm font-medium rounded-full hover:bg-gray-50 transition shadow-sm border border-gray-200">
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
