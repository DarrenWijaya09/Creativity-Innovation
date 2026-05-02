<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>VEXORA — Temukan Penyedia Jasa Terbaik</title>
    <!-- Tailwind CSS CDN + Google Fonts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap"
        rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        primary: '#3B82F6',
                        secondary: '#EFF6FF',
                        accent: '#FEF9C3',
                    },
                }
            }
        }
    </script>
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

        .filter-sidebar {
            scrollbar-width: thin;
        }
    </style>
</head>

<body class="font-sans text-gray-800 bg-gray-50">

    <!-- ==================== STICKY NAVBAR (SAME AS HOMEPAGE) ==================== -->
    <header
        class="sticky top-0 z-50 bg-white/95 backdrop-blur-sm border-b border-gray-100 transition-all duration-300 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-4 flex items-center justify-between">
            <div class="flex items-center">
                <img src="{{ asset('assets/images/logo-copy.jpeg') }}" alt="VEXORA"
                    class="h-8 md:h-10 w-auto object-contain">
            </div>
            <nav class="hidden md:flex items-center space-x-8 text-gray-600 font-medium">
                <a href="/" class="hover:text-primary transition text-sm">Beranda</a>
                <a href="/catalog" class="hover:text-primary transition text-sm">Cari Jasa</a>
                <a href="#" class="hover:text-primary transition text-sm">Penyedia</a>
                <a href="#" class="hover:text-primary transition text-sm">Tentang</a>
                <a href="#" class="hover:text-primary transition text-sm">Blog</a>
                <a href="#" class="hover:text-primary transition text-sm">Kontak</a>
            </nav>
            <div class="flex items-center gap-5">

                <!-- Search -->
                <div class="relative hidden md:block">
                    <input type="text" placeholder="Cari jasa..."
                        class="pl-10 pr-4 py-2 rounded-full border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-primary w-48">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                </div>

                <!-- Calendar -->
                {{-- <i class="fas fa-calendar-alt text-lg text-gray-500 hover:text-primary cursor-pointer transition"></i> --}}

                <!-- Auth -->
                @guest
                    <div class="flex items-center gap-2">
                        <a href="/login" class="text-sm text-gray-600 hover:text-primary">Sign In</a>
                        <a href="/register" class="text-sm bg-primary text-white px-3 py-1.5 rounded-full">Sign Up</a>
                    </div>
                @endguest

                @auth
                    <div class="relative group">
                        <i class="fas fa-user-circle text-xl text-gray-600 cursor-pointer"></i>

                        <div
                            class="absolute right-0 mt-2 w-40 bg-white border rounded-xl shadow-lg opacity-0 group-hover:opacity-100 transition">
                            <a href="/dashboard" class="block px-4 py-2 text-sm hover:bg-gray-50">Dashboard</a>
                            <form method="POST" action="/logout">
                                @csrf
                                <button class="w-full text-left px-4 py-2 text-sm hover:bg-gray-50">Logout</button>
                            </form>
                        </div>
                    </div>
                @endauth

                <!-- Mobile menu -->
                <button class="block md:hidden text-gray-700">
                    <i class="fas fa-bars text-xl"></i>
                </button>

            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 lg:px-8 py-10">

        <!-- ==================== PAGE TITLE ==================== -->
        <div class="mb-8 text-center md:text-left">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Temukan Penyedia Jasa Terbaik</h1>
            <p class="text-gray-500 mt-2">Jelajahi berbagai layanan profesional sesuai kebutuhan Anda</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- ==================== LEFT SIDEBAR (FILTERS) ==================== -->
            <aside class="lg:w-80 flex-shrink-0">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-24 filter-sidebar">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="font-bold text-lg text-gray-900">Filter</h2>
                        <button class="text-primary text-sm font-medium hover:underline">Reset Filter</button>
                    </div>

                    <!-- Kategori Jasa -->
                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-800 mb-3">Kategori Jasa</h3>
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer"><input
                                    type="checkbox" class="rounded text-primary focus:ring-primary/20"><span>Les
                                    Privat</span></label>
                            <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer"><input
                                    type="checkbox" class="rounded text-primary"><span>Desain & Kreatif</span></label>
                            <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer"><input
                                    type="checkbox" class="rounded text-primary"><span>Teknologi & IT</span></label>
                            <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer"><input
                                    type="checkbox" class="rounded text-primary"><span>Perbaikan Rumah</span></label>
                            <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer"><input
                                    type="checkbox" class="rounded text-primary"><span>Kesehatan &
                                    Fitness</span></label>
                            <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer"><input
                                    type="checkbox" class="rounded text-primary"><span>Jasa Harian</span></label>
                        </div>
                    </div>

                    <!-- Lokasi -->
                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-800 mb-3">Lokasi</h3>
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer"><input
                                    type="checkbox" class="rounded text-primary"><span>Jakarta</span></label>
                            <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer"><input
                                    type="checkbox" class="rounded text-primary"><span>Bandung</span></label>
                            <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer"><input
                                    type="checkbox" class="rounded text-primary"><span>Surabaya</span></label>
                            <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer"><input
                                    type="checkbox" class="rounded text-primary"><span>Online</span></label>
                        </div>
                    </div>

                    <!-- Rating -->
                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-800 mb-3">Rating</h3>
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer"><input
                                    type="radio" name="rating" class="text-primary"><span
                                    class="flex items-center">⭐ 4 ke atas</span></label>
                            <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer"><input
                                    type="radio" name="rating" class="text-primary"><span
                                    class="flex items-center">⭐ 3 ke atas</span></label>
                        </div>
                    </div>

                    <!-- Harga -->
                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-800 mb-3">Harga</h3>
                        <div class="flex gap-2 items-center">
                            <input type="number" placeholder="Min"
                                class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-1 focus:ring-primary">
                            <span class="text-gray-400">—</span>
                            <input type="number" placeholder="Max"
                                class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-1 focus:ring-primary">
                        </div>
                    </div>

                    <!-- Tipe Layanan -->
                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-800 mb-3">Tipe Layanan</h3>
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer"><input
                                    type="checkbox" class="rounded text-primary"><span>Online</span></label>
                            <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer"><input
                                    type="checkbox" class="rounded text-primary"><span>Offline (Datang ke
                                    lokasi)</span></label>
                        </div>
                    </div>

                    <button
                        class="w-full mt-4 px-4 py-2.5 border border-gray-200 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-50 transition">Reset
                        Filter</button>
                </div>
            </aside>

            <!-- ==================== RIGHT CONTENT (SERVICE LISTINGS) ==================== -->
            <div class="flex-1">
                <!-- TOP BAR: Result info + Sorting -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                    <p class="text-gray-600 text-sm">Menampilkan <span class="font-semibold text-gray-900">120</span>
                        penyedia jasa</p>
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-gray-500">Urutkan:</span>
                        <select
                            class="border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-primary bg-white">
                            <option>Terpopuler</option>
                            <option>Rating Tertinggi</option>
                            <option>Harga Terendah</option>
                            <option>Harga Tertinggi</option>
                        </select>
                    </div>
                </div>

                <!-- SERVICE CARDS GRID -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @php
                        $services = [
                            [
                                'title' => 'Les Matematika SMA',
                                'provider' => 'Bunda Sari',
                                'rating' => 5,
                                'reviews' => 128,
                                'location' => 'Jakarta Selatan',
                                'price' => 50000,
                                'desc' => 'Metode mudah dan menyenangkan, guru berpengalaman 10+ tahun',
                                'img' =>
                                    'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=400&h=300&fit=crop',
                                'badge' => 'Online & Offline',
                            ],
                            [
                                'title' => 'Desain Logo Profesional',
                                'provider' => 'Design Studio ID',
                                'rating' => 5,
                                'reviews' => 342,
                                'location' => 'Online',
                                'price' => 250000,
                                'desc' => 'Desain modern dan unik sesuai identitas brand Anda',
                                'img' =>
                                    'https://images.unsplash.com/photo-1626785774573-4b799315345d?w=400&h=300&fit=crop',
                                'badge' => 'Online',
                            ],
                            [
                                'title' => 'Perbaikan AC & Kulkas',
                                'provider' => 'Technician Plus',
                                'rating' => 4,
                                'reviews' => 89,
                                'location' => 'Jabodetabek',
                                'price' => 150000,
                                'desc' => 'Teknisi profesional, garansi 30 hari',
                                'img' =>
                                    'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?w=400&h=300&fit=crop',
                                'badge' => 'Offline',
                            ],
                            [
                                'title' => 'Les Bahasa Inggris',
                                'provider' => 'English Buddy',
                                'rating' => 5,
                                'reviews' => 256,
                                'location' => 'Jakarta Utara',
                                'price' => 75000,
                                'desc' => 'Native speaker, jadwal fleksibel',
                                'img' =>
                                    'https://images.unsplash.com/photo-1543269865-cbf427effbad?w=400&h=300&fit=crop',
                                'badge' => 'Online & Offline',
                            ],
                            [
                                'title' => 'Website Company Profile',
                                'provider' => 'WebDev Expert',
                                'rating' => 5,
                                'reviews' => 94,
                                'location' => 'Online',
                                'price' => 1500000,
                                'desc' => 'Responsif, SEO friendly, cepat selesai',
                                'img' =>
                                    'https://images.unsplash.com/photo-1547658719-da2b51169166?w=400&h=300&fit=crop',
                                'badge' => 'Online',
                            ],
                            [
                                'title' => 'Pijat Kebugaran',
                                'provider' => 'Sehat Sejati',
                                'rating' => 4,
                                'reviews' => 67,
                                'location' => 'Jakarta Pusat',
                                'price' => 120000,
                                'desc' => 'Terapis profesional, alat lengkap',
                                'img' =>
                                    'https://images.unsplash.com/photo-1519823551278-64ac92734fb1?w=400&h=300&fit=crop',
                                'badge' => 'Offline',
                            ],
                        ];
                    @endphp
                    @foreach ($services as $service)
                        <div
                            class="group bg-white rounded-2xl hover:shadow-xl transition-all duration-300 hover-lift border border-gray-100 overflow-hidden">
                            <div class="card-image-zoom relative">
                                <img src="{{ $service['img'] }}" alt="{{ $service['title'] }}"
                                    class="w-full h-48 object-cover">
                                <span
                                    class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-xs font-medium px-2 py-1 rounded-full text-gray-700 shadow-sm">{{ $service['badge'] }}</span>
                            </div>
                            <div class="p-5">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <h3 class="font-bold text-gray-900 text-lg">{{ $service['title'] }}</h3>
                                        <p class="text-gray-500 text-sm mt-0.5">{{ $service['provider'] }}</p>
                                    </div>
                                    <div class="flex items-center gap-1 bg-green-50 px-2 py-1 rounded-full">
                                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                                        <span
                                            class="text-sm font-semibold text-gray-800">{{ $service['rating'] }}</span>
                                        <span class="text-xs text-gray-500">({{ $service['reviews'] }})</span>
                                    </div>
                                </div>
                                <p class="text-gray-500 text-sm line-clamp-2 mb-3">{{ $service['desc'] }}</p>
                                <div class="flex items-center gap-3 text-xs text-gray-500 mb-4">
                                    <span class="flex items-center gap-1"><i
                                            class="fas fa-map-marker-alt text-primary/70 text-xs"></i>
                                        {{ $service['location'] }}</span>
                                    <span class="flex items-center gap-1"><i
                                            class="fas fa-credit-card text-primary/70 text-xs"></i> Mulai</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span
                                            class="text-2xl font-extrabold text-primary">Rp{{ number_format($service['price'], 0, ',', '.') }}</span>
                                        @if ($service['price'] < 200000)
                                            <span class="text-xs text-gray-400 ml-1">/ sesi</span>
                                        @endif
                                    </div>
                                    <a href="#"
                                        class="px-5 py-2 bg-primary/10 text-primary font-semibold text-sm rounded-xl hover:bg-primary hover:text-white transition-all duration-200">Pesan
                                        Sekarang</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- EMPTY STATE (hidden, shown only if no results) - optional -->
                <!-- <div class="text-center py-16">
                    <i class="fas fa-search text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-700">Jasa tidak ditemukan</h3>
                    <p class="text-gray-400 mt-1">Coba ubah filter atau cari dengan kata kunci lain</p>
                    <button class="mt-4 text-primary font-medium">Reset Filter</button>
                </div> -->

                <!-- PAGINATION (simple) -->
                <div class="flex justify-center gap-2 mt-10">
                    <button class="px-3 py-2 rounded-lg border border-gray-200 text-gray-500 hover:bg-gray-50"><i
                            class="fas fa-chevron-left text-sm"></i></button>
                    <button class="px-3 py-2 rounded-lg bg-primary text-white">1</button>
                    <button
                        class="px-3 py-2 rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50">2</button>
                    <button
                        class="px-3 py-2 rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50">3</button>
                    <button
                        class="px-3 py-2 rounded-lg border border-gray-200 text-gray-500 hover:bg-gray-50">...</button>
                    <button class="px-3 py-2 rounded-lg border border-gray-200 text-gray-500 hover:bg-gray-50"><i
                            class="fas fa-chevron-right text-sm"></i></button>
                </div>

                <!-- ==================== PROMO / CTA SECTION (JADI PENYEDIA) ==================== -->
                <div
                    class="mt-12 bg-gradient-to-r from-primary to-blue-600 rounded-3xl p-8 md:p-10 text-center text-white shadow-lg">
                    <i class="fas fa-store text-4xl mb-4 opacity-80"></i>
                    <h2 class="text-2xl md:text-3xl font-bold mb-2">Jadi Penyedia di VEXORA</h2>
                    <p class="text-blue-100 max-w-lg mx-auto mb-6">Gabung dan tawarkan jasa Anda kepada ribuan pengguna
                        yang membutuhkan layanan profesional.</p>
                    <a href="#"
                        class="inline-block bg-white text-primary font-semibold px-8 py-3 rounded-full hover:bg-gray-100 transition shadow-md">Daftar
                        Sekarang →</a>
                </div>
            </div>
        </div>
    </main>

    <!-- ==================== FULL FOOTER (SAME AS HOMEPAGE) ==================== -->
    <footer class="bg-gray-900 text-gray-300 mt-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-10">
                <div>
                    <div class="text-2xl font-bold text-white mb-4">VEXORA</div>
                    <p class="text-sm text-gray-400 mb-4">Platform jasa terpercaya yang menghubungkan Anda dengan
                        penyedia layanan profesional.</p>
                    <div class="flex gap-4">
                        <a href="#" class="text-gray-400 hover:text-white transition"><i
                                class="fab fa-instagram text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition"><i
                                class="fab fa-twitter text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition"><i
                                class="fab fa-facebook text-xl"></i></a>
                    </div>
                </div>
                <div>
                    <h3 class="font-semibold text-white mb-4">Layanan</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition">Cari Jasa</a></li>
                        <li><a href="#" class="hover:text-white transition">Kategori</a></li>
                        <li><a href="#" class="hover:text-white transition">Promo</a></li>
                        <li><a href="#" class="hover:text-white transition">Layanan Populer</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold text-white mb-4">Bantuan</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition">Pusat Bantuan</a></li>
                        <li><a href="#" class="hover:text-white transition">Kebijakan Privasi</a></li>
                        <li><a href="#" class="hover:text-white transition">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="hover:text-white transition">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold text-white mb-4">Penyedia</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition">Daftar Penyedia</a></li>
                        <li><a href="#" class="hover:text-white transition">Dashboard</a></li>
                        <li><a href="#" class="hover:text-white transition">Tips & Panduan</a></li>
                        <li><a href="#" class="hover:text-white transition">Komisi</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold text-white mb-4">Kontak</h3>
                    <ul class="space-y-2 text-sm">
                        <li class="flex gap-2"><i
                                class="fas fa-envelope mt-0.5 text-primary"></i><span>hello@vexora.com</span></li>
                        <li class="flex gap-2"><i class="fas fa-map-marker-alt mt-0.5 text-primary"></i><span>Jakarta,
                                Indonesia</span></li>
                        <li class="flex gap-2"><i class="fas fa-phone mt-0.5 text-primary"></i><span>+62 21 1234
                                5678</span></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-500 text-xs">© 2025 VEXORA — Platform
                Jasa Terpercaya. Hubungkan kebutuhan Anda dengan penyedia terbaik.</div>
        </div>
    </footer>

    <!-- Simple script for filter reset behavior (optional) -->
    <script>
        // Just for demo reset buttons - would connect to real filtering logic
        document.querySelectorAll('.reset-filter-btn, button:contains("Reset Filter")').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('input[type="checkbox"], input[type="radio"]').forEach(input =>
                    input.checked = false);
                document.querySelectorAll('input[type="number"]').forEach(input => input.value = '');
            });
        });
    </script>
</body>

</html>
