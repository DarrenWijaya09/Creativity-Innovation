@extends('layouts.app')

@section('title', 'Tentang VEXORA - Platform Jasa Terpercaya')

@section('content')
    <div class="animate-fade-in">

        <!-- Section 1: Hero -->
        <section class="py-16 md:py-24 text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6">
                Tentang <span class="text-primary">VEXORA</span>
            </h1>
            <p class="text-gray-500 text-lg max-w-2xl mx-auto leading-relaxed">
                Kami percaya bahwa setiap orang berhak mendapatkan layanan berkualitas dengan mudah dan cepat.
                VEXORA hadir sebagai jembatan antara kebutuhan Anda dan penyedia jasa terpercaya.
            </p>
            <div class="mt-8">
                <a href="#"
                    class="inline-block bg-primary hover:bg-primary/90 text-white font-semibold px-8 py-3 rounded-full transition shadow-md">
                    Mulai Cari Jasa
                </a>
            </div>
        </section>

        <!-- Section 2: Problem & Solution -->
        <section class="py-16 bg-gray-50/50 rounded-3xl">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Mengapa VEXORA?</h2>
                <p class="text-gray-500 mt-2">Kami hadir untuk menyelesaikan tantangan dalam mencari jasa</p>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Problems -->
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-exclamation-triangle text-red-500"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Masalah yang Sering Dihadapi</h3>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <i class="fas fa-times-circle text-red-400 mt-1"></i>
                            <p class="text-gray-600">Sulit menemukan penyedia jasa terpercaya</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <i class="fas fa-times-circle text-red-400 mt-1"></i>
                            <p class="text-gray-600">Harga tidak transparan dan sering berubah</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <i class="fas fa-times-circle text-red-400 mt-1"></i>
                            <p class="text-gray-600">Tidak ada jaminan kualitas layanan</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <i class="fas fa-times-circle text-red-400 mt-1"></i>
                            <p class="text-gray-600">Proses mencari memakan waktu lama</p>
                        </div>
                    </div>
                </div>

                <!-- Solutions -->
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-check-circle text-green-500"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Solusi dari VEXORA</h3>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <i class="fas fa-check-circle text-green-500 mt-1"></i>
                            <p class="text-gray-600">Penyedia jasa terverifikasi & berperingkat</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <i class="fas fa-check-circle text-green-500 mt-1"></i>
                            <p class="text-gray-600">Harga transparan mulai dari yang tertera</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <i class="fas fa-check-circle text-green-500 mt-1"></i>
                            <p class="text-gray-600">Sistem rating & ulasan dari pengguna asli</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <i class="fas fa-check-circle text-green-500 mt-1"></i>
                            <p class="text-gray-600">Temukan penyedia dalam hitungan menit</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 3: How It Works -->
        <section class="py-16">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Cara Kerja VEXORA</h2>
                <p class="text-gray-500 mt-2">Mudah, cepat, dan langsung bisa digunakan</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center group">
                    <div
                        class="w-20 h-20 bg-secondary rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-primary/10 transition">
                        <i class="fas fa-search text-2xl text-primary"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">1. Cari Jasa</h3>
                    <p class="text-gray-500">Temukan layanan yang Anda butuhkan dari berbagai kategori</p>
                </div>
                <div class="text-center group">
                    <div
                        class="w-20 h-20 bg-secondary rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-primary/10 transition">
                        <i class="fas fa-handshake text-2xl text-primary"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">2. Pilih Penyedia</h3>
                    <p class="text-gray-500">Lihat profil, rating, dan pilih penyedia terbaik</p>
                </div>
                <div class="text-center group">
                    <div
                        class="w-20 h-20 bg-secondary rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-primary/10 transition">
                        <i class="fas fa-check-circle text-2xl text-primary"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">3. Pesan & Selesai</h3>
                    <p class="text-gray-500">Lakukan pemesanan dan nikmati layanan berkualitas</p>
                </div>
            </div>
        </section>

        <!-- Section 4: Trust Stats -->
        <section class="py-16 bg-primary/5 rounded-3xl">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-4xl md:text-5xl font-extrabold text-primary">10.000+</div>
                    <p class="text-gray-500 mt-2">Penyedia Jasa</p>
                </div>
                <div>
                    <div class="text-4xl md:text-5xl font-extrabold text-primary">50.000+</div>
                    <p class="text-gray-500 mt-2">Pengguna Aktif</p>
                </div>
                <div>
                    <div class="text-4xl md:text-5xl font-extrabold text-primary">100.000+</div>
                    <p class="text-gray-500 mt-2">Transaksi Berhasil</p>
                </div>
                <div>
                    <div class="text-4xl md:text-5xl font-extrabold text-primary">4.9/5</div>
                    <p class="text-gray-500 mt-2">Rating Pengguna</p>
                </div>
            </div>
        </section>

        <!-- Section 5: Users vs Providers -->
        <section class="py-16">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900">VEXORA untuk Semua</h2>
                <p class="text-gray-500 mt-2">Baik Anda mencari jasa atau menawarkan jasa</p>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- For Users -->
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="w-14 h-14 bg-primary/10 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-user-circle text-2xl text-primary"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Untuk Pengguna</h3>
                    <p class="text-gray-500 mb-4">Temukan layanan terbaik sesuai kebutuhan Anda</p>
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-center gap-2 text-sm text-gray-600"><i
                                class="fas fa-check-circle text-primary text-xs"></i> Akses ke ribuan penyedia terverifikasi
                        </li>
                        <li class="flex items-center gap-2 text-sm text-gray-600"><i
                                class="fas fa-check-circle text-primary text-xs"></i> Lihat rating & ulasan asli</li>
                        <li class="flex items-center gap-2 text-sm text-gray-600"><i
                                class="fas fa-check-circle text-primary text-xs"></i> Harga transparan tanpa biaya
                            tersembunyi</li>
                        <li class="flex items-center gap-2 text-sm text-gray-600"><i
                                class="fas fa-check-circle text-primary text-xs"></i> Pembayaran aman dan terjamin</li>
                    </ul>
                    <a href="#"
                        class="inline-block bg-primary text-white font-medium px-6 py-2 rounded-full hover:bg-primary/90 transition">Cari
                        Jasa →</a>
                </div>

                <!-- For Providers -->
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="w-14 h-14 bg-primary/10 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-store text-2xl text-primary"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Untuk Penyedia</h3>
                    <p class="text-gray-500 mb-4">Kembangkan bisnis Anda bersama VEXORA</p>
                    <ul class="space-y-2 mb-6">
                        <li class="flex items-center gap-2 text-sm text-gray-600"><i
                                class="fas fa-check-circle text-primary text-xs"></i> Jangkau ribuan pengguna aktif</li>
                        <li class="flex items-center gap-2 text-sm text-gray-600"><i
                                class="fas fa-check-circle text-primary text-xs"></i> Dashboard analitik lengkap</li>
                        <li class="flex items-center gap-2 text-sm text-gray-600"><i
                                class="fas fa-check-circle text-primary text-xs"></i> Sistem promosi dan peningkatan
                            visibilitas</li>
                        <li class="flex items-center gap-2 text-sm text-gray-600"><i
                                class="fas fa-check-circle text-primary text-xs"></i> Komisi kompetitif dan transparan</li>
                    </ul>
                    <a href="#"
                        class="inline-block border border-primary text-primary font-medium px-6 py-2 rounded-full hover:bg-primary hover:text-white transition">Daftar
                        Sekarang →</a>
                </div>
            </div>
        </section>

        <!-- Section 6: CTA -->
        <section class="py-16">
            <div
                class="bg-gradient-to-r from-primary to-blue-600 rounded-3xl p-12 md:p-16 text-center text-white shadow-xl">
                <i class="fas fa-heart text-4xl mb-4 opacity-80"></i>
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Siap Menemukan atau Menawarkan Jasa?</h2>
                <p class="text-blue-100 text-lg max-w-xl mx-auto mb-8">
                    Bergabunglah dengan ribuan pengguna dan penyedia yang sudah percaya pada VEXORA
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#"
                        class="inline-block bg-white text-primary font-semibold px-8 py-3 rounded-full hover:bg-gray-100 transition shadow-md">
                        Cari Jasa
                    </a>
                    <a href="#"
                        class="inline-block bg-primary/20 border border-white/40 text-white font-semibold px-8 py-3 rounded-full hover:bg-white/10 transition">
                        Jadi Penyedia
                    </a>
                </div>
            </div>
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
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Smooth scroll for anchor links
                document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                    anchor.addEventListener('click', function(e) {
                        e.preventDefault();
                        const target = document.querySelector(this.getAttribute('href'));
                        if (target) {
                            target.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
