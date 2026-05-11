@extends('layouts.app')

@section('title', 'Seller Dashboard - VEXORA')

@section('content')
    <div class="min-h-screen bg-white">

        <main class="max-w-7xl mx-auto px-6 lg:px-8 py-8 lg:py-12">

            <!-- ==================== DASHBOARD HEADER ==================== -->
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 mb-10">
                <div>
                    <h1 class="text-3xl lg:text-4xl font-bold text-gray-900">
                        Halo, Darren <span class="inline-block animate-wave">👋</span>
                    </h1>
                    <p class="text-gray-500 mt-1">Kelola jasa dan bangun reputasi penyedia Anda.</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="#"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white text-sm font-medium rounded-full hover:bg-primary/90 transition shadow-sm">
                        <i class="fas fa-plus-circle text-sm"></i> Tambah Jasa
                    </a>
                    <a href="#"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-50 text-gray-700 text-sm font-medium rounded-full hover:bg-gray-100 transition border border-gray-200">
                        <i class="fas fa-user-edit text-sm"></i> Lengkapi Profil
                    </a>
                    <a href="#"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-50 text-gray-700 text-sm font-medium rounded-full hover:bg-gray-100 transition border border-gray-200">
                        <i class="fas fa-store text-sm"></i> Lihat Catalog
                    </a>
                </div>
            </div>

            <!-- ==================== TWO COLUMN LAYOUT ==================== -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- LEFT COLUMN -->
                <div class="lg:col-span-1 space-y-6">

                    <!-- Seller Profile Card (Compact) -->
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                        <!-- Background gradient -->
                        <div class="h-16 bg-gradient-to-r from-primary/20 to-blue-100"></div>

                        <div class="px-5 pb-5">
                            <!-- Avatar -->
                            <div class="flex justify-start -mt-8 mb-3">
                                @if (Auth::user()->avatar)
                                    <img src="{{ Str::startsWith(Auth::user()->avatar, 'http')
                                        ? Auth::user()->avatar
                                        : asset('storage/' . Auth::user()->avatar) }}"
                                        alt="{{ Auth::user()->name }}"
                                        class="w-16 h-16 rounded-full object-cover border-4 border-white shadow-sm">
                                @else
                                    <div
                                        class="w-16 h-16 rounded-full border-4 border-white shadow-sm bg-primary text-white flex items-center justify-center text-xl font-bold">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                @endif
                            </div>

                            <div>
                                <h2 class="text-lg font-bold text-gray-900">
                                    {{ Auth::user()->name }}
                                </h2>

                                <p class="text-sm text-gray-500">
                                    {{ Auth::user()->provider->category ?? 'Pengguna VEXORA' }}
                                </p>

                                <div class="flex flex-wrap items-center gap-2 mt-2">

                                    {{-- ROLE BADGE --}}
                                    @if (Auth::user()->role == 1)
                                        <span
                                            class="px-2 py-0.5 bg-primary/10 text-primary text-xs font-medium rounded-full">
                                            <i class="fas fa-store mr-1 text-xs"></i> Penyedia
                                        </span>
                                    @elseif(Auth::user()->role == 0)
                                        <span class="px-2 py-0.5 bg-red-100 text-red-600 text-xs font-medium rounded-full">
                                            <i class="fas fa-shield-alt mr-1 text-xs"></i> Admin
                                        </span>
                                    @else
                                        <span
                                            class="px-2 py-0.5 bg-gray-100 text-gray-600 text-xs font-medium rounded-full">
                                            <i class="fas fa-user mr-1 text-xs"></i> User
                                        </span>
                                    @endif

                                    {{-- JOIN DATE --}}
                                    <span class="px-2 py-0.5 bg-gray-100 text-gray-600 text-xs font-medium rounded-full">
                                        <i class="fas fa-calendar-alt mr-1 text-xs"></i>
                                        Bergabung {{ Auth::user()->created_at->format('Y') }}
                                    </span>

                                    {{-- VERIFICATION --}}
                                    @if (Auth::user()->provider && Auth::user()->provider->verification_status == 'verified')
                                        <span
                                            class="px-2 py-0.5 bg-green-100 text-green-700 text-xs font-medium rounded-full">
                                            <i class="fas fa-check-circle mr-1 text-xs"></i> Terverifikasi
                                        </span>
                                    @elseif(Auth::user()->provider && Auth::user()->provider->verification_status == 'pending')
                                        <span
                                            class="px-2 py-0.5 bg-yellow-100 text-yellow-700 text-xs font-medium rounded-full">
                                            <i class="fas fa-clock mr-1 text-xs"></i> Menunggu Verifikasi
                                        </span>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Completion Card (Motivating) -->
                    <div class="bg-gradient-to-br from-primary/5 to-blue-50 rounded-2xl border border-primary/20 p-5">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="font-semibold text-gray-900">Kelengkapan Profil</h3>
                            <span class="text-sm font-bold text-primary">45%</span>
                        </div>
                        <div class="w-full bg-white/60 rounded-full h-2 mb-4">
                            <div class="bg-primary rounded-full h-2" style="width: 45%"></div>
                        </div>
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center gap-2 text-sm">
                                <i class="fas fa-check-circle text-green-500 text-xs"></i>
                                <span class="text-gray-600">Informasi Dasar</span>
                            </div>
                            <div class="flex items-center gap-2 text-sm">
                                <i class="far fa-circle text-gray-300 text-xs"></i>
                                <span class="text-gray-400">Pengalaman & Keahlian</span>
                            </div>
                            <div class="flex items-center gap-2 text-sm">
                                <i class="far fa-circle text-gray-300 text-xs"></i>
                                <span class="text-gray-400">Portofolio</span>
                            </div>
                            <div class="flex items-center gap-2 text-sm">
                                <i class="far fa-circle text-gray-300 text-xs"></i>
                                <span class="text-gray-400">Verifikasi Identitas</span>
                            </div>
                        </div>
                        <a href="#"
                            class="block text-center w-full px-4 py-2 bg-primary text-white text-sm font-medium rounded-xl hover:bg-primary/90 transition">
                            Lengkapi Sekarang →
                        </a>
                    </div>

                    <!-- Quick Stats (Minimal) -->
                    <div class="grid grid-cols-2 gap-3">
                        <div class="bg-white rounded-xl border border-gray-100 p-3 text-center">
                            <i class="fas fa-box text-primary text-base mb-1"></i>
                            <p class="text-xl font-bold text-gray-900">3</p>
                            <p class="text-xs text-gray-500">Total Jasa</p>
                        </div>
                        <div class="bg-white rounded-xl border border-gray-100 p-3 text-center">
                            <i class="fas fa-eye text-primary text-base mb-1"></i>
                            <p class="text-xl font-bold text-gray-900">1.2k</p>
                            <p class="text-xs text-gray-500">Total Dilihat</p>
                        </div>
                    </div>

                    <!-- Verification Status (Compact) -->
                    <div class="bg-white rounded-xl border border-gray-100 p-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-shield-alt text-primary text-sm"></i>
                                <span class="text-sm font-medium text-gray-700">Verifikasi</span>
                            </div>
                            <span
                                class="px-2 py-0.5 bg-yellow-100 text-yellow-700 text-xs font-medium rounded-full">Pending</span>
                        </div>
                        <p class="text-xs text-gray-400 mt-2">Sedang diproses, estimasi 2-3 hari</p>
                    </div>

                </div>

                <!-- RIGHT COLUMN -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Service Management Section (CORE) -->
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

                        <!-- HEADER -->
                        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between flex-wrap gap-3">

                            <div>
                                <h2 class="text-lg font-bold text-gray-900">
                                    Kelola Jasa
                                </h2>

                                <p class="text-sm text-gray-500">
                                    Atur dan kelola layanan yang Anda tawarkan
                                </p>
                            </div>

                            <a href="{{ route('services.create') }}"
                                class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-white text-sm font-medium rounded-xl hover:bg-primary/90 transition">

                                <i class="fas fa-plus-circle text-sm"></i>
                                Tambah Jasa

                            </a>

                        </div>

                        {{-- JIKA ADA JASA --}}
                        @if ($services->count() > 0)

                            <div class="divide-y divide-gray-100">

                                @foreach ($services as $service)
                                    <div class="p-6 flex flex-col lg:flex-row lg:items-center justify-between gap-5">

                                        <!-- LEFT -->
                                        <div class="flex items-start gap-4">

                                            <!-- IMAGE -->
                                            <div class="w-24 h-24 rounded-2xl overflow-hidden bg-gray-100 flex-shrink-0">

                                                @if ($service->image)
                                                    <img src="{{ asset('storage/' . $service->image) }}"
                                                        alt="{{ $service->title }}" class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center">

                                                        <i class="fas fa-image text-gray-300 text-xl"></i>

                                                    </div>
                                                @endif

                                            </div>

                                            <!-- INFO -->
                                            <div>

                                                <h3 class="font-semibold text-gray-900 text-lg">
                                                    {{ $service->title }}
                                                </h3>

                                                <p class="text-sm text-gray-500 mt-1">
                                                    {{ $service->category }}
                                                </p>

                                                <p class="text-primary font-bold mt-2">
                                                    Rp {{ number_format($service->price, 0, ',', '.') }}
                                                </p>

                                                <!-- STATUS -->
                                                <div class="mt-3">

                                                    @if ($service->status == 'published')
                                                        <span
                                                            class="px-3 py-1 bg-green-100 text-green-700 text-xs rounded-full font-medium">
                                                            Published
                                                        </span>
                                                    @elseif ($service->status == 'draft')
                                                        <span
                                                            class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs rounded-full font-medium">
                                                            Draft
                                                        </span>
                                                    @else
                                                        <span
                                                            class="px-3 py-1 bg-gray-100 text-gray-700 text-xs rounded-full font-medium">
                                                            Hidden
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- ACTION -->
                                        <div class="flex items-center gap-3">

                                            <a href="{{ route('services.edit', $service->slug) }}"
                                                class="px-4 py-2 border border-gray-200 rounded-xl text-sm hover:bg-gray-50  transition">
                                                Edit
                                            </a>
                                            <form action="{{ route('services.destroy', $service->slug) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    class="px-4 py-2 border border-red-100 text-red-500 rounded-xl text-sm hover:bg-red-50 transition">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <!-- EMPTY STATE -->
                            <div class="p-10 text-center">

                                <div
                                    class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">

                                    <i class="fas fa-store text-gray-400 text-2xl"></i>

                                </div>

                                <h3 class="font-semibold text-gray-800 text-lg mb-2">
                                    Anda belum memiliki jasa
                                </h3>

                                <p class="text-sm text-gray-500 mb-5 max-w-md mx-auto">
                                    Mulai tawarkan keahlian Anda dan dapatkan pelanggan pertama di
                                    VEXORA
                                </p>

                                <a href="{{ route('services.create') }}"
                                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white text-sm font-medium rounded-full hover:bg-primary/90 transition shadow-sm">

                                    <i class="fas fa-plus-circle"></i>
                                    Tambah Jasa Pertama

                                </a>

                            </div>

                        @endif

                    </div>

                    <!-- Recent Activity Section -->
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100">
                            <h2 class="text-lg font-bold text-gray-900">Aktivitas Terbaru</h2>
                            <p class="text-sm text-gray-500">Update terkait jasa dan profil Anda</p>
                        </div>
                        <div class="divide-y divide-gray-100">
                            <div class="px-6 py-3 flex items-start gap-3">
                                <div
                                    class="w-7 h-7 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-check text-green-600 text-xs"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-700">Profil penyedia <span class="font-medium">telah
                                            diperbarui</span></p>
                                    <p class="text-xs text-gray-400 mt-0.5">2 jam yang lalu</p>
                                </div>
                            </div>
                            <div class="px-6 py-3 flex items-start gap-3">
                                <div
                                    class="w-7 h-7 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-plus text-blue-600 text-xs"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-700">Jasa baru <span class="font-medium">"Les Matematika
                                            SMA"</span> berhasil dibuat</p>
                                    <p class="text-xs text-gray-400 mt-0.5">2 hari yang lalu</p>
                                </div>
                            </div>
                            <div class="px-6 py-3 flex items-start gap-3">
                                <div
                                    class="w-7 h-7 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-chart-line text-purple-600 text-xs"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-700">Jasa Anda <span class="font-medium">dilihat 50+
                                            kali</span> minggu ini</p>
                                    <p class="text-xs text-gray-400 mt-0.5">1 minggu yang lalu</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tips Card -->
                    <div class="bg-gray-50/80 rounded-xl border border-gray-100 p-4">
                        <div class="flex items-start gap-3">
                            <i class="fas fa-lightbulb text-primary text-lg"></i>
                            <div>
                                <h3 class="font-semibold text-gray-800 text-sm">Tips untuk Anda</h3>
                                <p class="text-xs text-gray-500 mt-0.5">Lengkapi profil dan tambahkan portofolio untuk
                                    meningkatkan kepercayaan pelanggan</p>
                                <a href="#"
                                    class="inline-block mt-2 text-primary text-xs font-medium hover:underline">Pelajari
                                    lebih lanjut →</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>

    @push('styles')
        <style>
            @keyframes wave {

                0%,
                100% {
                    transform: rotate(0deg);
                }

                25% {
                    transform: rotate(15deg);
                }

                75% {
                    transform: rotate(-10deg);
                }
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
