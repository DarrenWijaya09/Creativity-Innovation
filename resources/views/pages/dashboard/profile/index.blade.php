@extends('layouts.app')

@section('title', 'Profil Saya - VEXORA')

@section('content')
    <div class="min-h-screen bg-white dark:bg-gray-950 py-8 lg:py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <!-- Page Header -->
            <div class="mb-8">
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white">Profil Saya</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-1">Kelola informasi akun dan preferensi Anda</p>
            </div>

            <!-- Two Column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- ==================== LEFT COLUMN: PROFILE CARD ==================== -->
                <div class="lg:col-span-1">
                    <div class="sticky top-24 space-y-6">

                        <!-- Main Profile Card -->
                        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-gray-100 dark:border-slate-700 shadow-sm overflow-hidden">
                            <div class="relative h-24 bg-gradient-to-r from-primary/20 to-blue-100 dark:from-primary/10 dark:to-blue-900/30"></div>

                            <div class="px-6 pb-6">

                                <!-- Avatar -->
                                <div class="flex justify-center -mt-12 mb-4">
                                    <div class="relative">

                                        <!-- HIDDEN FILE INPUT -->
                                        {{-- <input type="file" name="avatar" id="avatarInput" accept="image/*"
                                            class="hidden"> --}}

                                        <!-- AVATAR -->
                                        @if (Auth::user()->avatar)
                                            <img id="avatarPreview"
                                                src="{{ Str::startsWith(Auth::user()->avatar, 'http')
                                                    ? Auth::user()->avatar
                                                    : asset('storage/' . Auth::user()->avatar) }}"
                                                alt="{{ Auth::user()->name }}"
                                                class="w-24 h-24 rounded-full object-cover border-4 border-white dark:border-slate-800 shadow-md">
                                        @else
                                            <!-- PLACEHOLDER -->
                                            <div id="avatarPlaceholder"
                                                class="w-24 h-24 rounded-full bg-primary text-white flex items-center justify-center text-3xl font-bold border-4 border-white dark:border-slate-800 shadow-md">

                                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

                                            </div>

                                            <!-- HIDDEN IMAGE PREVIEW -->
                                            <img id="avatarPreview"
                                                class="hidden w-24 h-24 rounded-full object-cover border-4 border-white dark:border-slate-800 shadow-md">
                                        @endif

                                        <!-- CAMERA BUTTON -->
                                        <button type="button" onclick="document.getElementById('avatarInput').click()"
                                            class="absolute bottom-0 right-0 w-8 h-8 bg-primary rounded-full flex items-center justify-center text-white hover:bg-primary/90 transition shadow-sm">
                                            <i class="fas fa-camera text-xs"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- User Info -->
                                <div class="text-center">
                                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                                        {{ Auth::user()->name }}
                                    </h2>

                                    <p class="text-gray-500 dark:text-gray-400 text-sm mt-0.5">
                                        {{ Auth::user()->email }}
                                    </p>

                                    <!-- Badges -->
                                    <div class="flex items-center justify-center gap-2 mt-3">

                                        {{-- Role Badge --}}
                                        @if (Auth::user()->role == 0)
                                            <span
                                                class="px-2.5 py-1 bg-red-100 dark:bg-red-950/30 text-red-600 dark:text-red-400 text-xs font-medium rounded-full">
                                                <i class="fas fa-shield-alt mr-1 text-xs"></i> Admin
                                            </span>
                                        @elseif(Auth::user()->role == 1)
                                            <span
                                                class="px-2.5 py-1 bg-primary/10 dark:bg-primary/20 text-primary text-xs font-medium rounded-full">
                                                <i class="fas fa-store mr-1 text-xs"></i> Penyedia
                                            </span>
                                        @else
                                            <span
                                                class="px-2.5 py-1 bg-primary/10 dark:bg-primary/20 text-primary text-xs font-medium rounded-full">
                                                <i class="fas fa-user mr-1 text-xs"></i> User
                                            </span>
                                        @endif

                                        {{-- Verification --}}
                                        @if (Auth::user()->email_verified_at)
                                            <span
                                                class="px-2.5 py-1 bg-green-100 dark:bg-green-950/30 text-green-700 dark:text-green-400 text-xs font-medium rounded-full">
                                                <i class="fas fa-check-circle mr-1 text-xs"></i> Verified
                                            </span>
                                        @else
                                            <span
                                                class="px-2.5 py-1 bg-yellow-100 dark:bg-yellow-950/30 text-yellow-700 dark:text-yellow-400 text-xs font-medium rounded-full">
                                                <i class="fas fa-clock mr-1 text-xs"></i> Unverified
                                            </span>
                                        @endif

                                    </div>
                                </div>

                                <!-- Profile Completion -->
                                @php
                                    $completion = 40;

                                    if (Auth::user()->avatar) {
                                        $completion += 20;
                                    }
                                    if (Auth::user()->phone) {
                                        $completion += 20;
                                    }
                                    if (Auth::user()->birth_date) {
                                        $completion += 20;
                                    }
                                @endphp

                                <div class="mt-5 pt-4 border-t border-gray-100 dark:border-slate-700">
                                    <div class="flex justify-between text-sm mb-2">
                                        <span class="text-gray-600 dark:text-gray-400">Kelengkapan Profil</span>
                                        <span class="text-primary font-medium">{{ $completion }}%</span>
                                    </div>

                                    <div class="w-full bg-gray-100 dark:bg-slate-700 rounded-full h-2">
                                        <div class="bg-primary rounded-full h-2" style="width: {{ $completion }}%">
                                        </div>
                                    </div>

                                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-2">
                                        Lengkapi profil untuk meningkatkan kepercayaan
                                    </p>
                                </div>

                            </div>
                        </div>

                        <!-- Status Badges Card -->
                        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-gray-100 dark:border-slate-700 shadow-sm p-5">
                            <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-3">Status Akun</h3>
                            <div class="space-y-2">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-envelope text-green-500 text-sm"></i>
                                        <span class="text-sm text-gray-600 dark:text-gray-400">Email Terverifikasi</span>
                                    </div>
                                    <i class="fas fa-check-circle text-green-500 text-sm"></i>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <i class="fab fa-google text-orange-500 text-sm"></i>
                                        <span class="text-sm text-gray-600 dark:text-gray-400">Google Terhubung</span>
                                    </div>
                                    <i class="fas fa-check-circle text-green-500 text-sm"></i>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-shield-alt text-primary text-sm"></i>
                                        <span class="text-sm text-gray-600 dark:text-gray-400">2FA</span>
                                    </div>
                                    <span class="text-xs text-gray-400 dark:text-gray-500">Nonaktif</span>
                                </div>
                            </div>
                        </div>

                        <!-- Bio / Status Card -->
                        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-gray-100 dark:border-slate-700 shadow-sm p-5">
                            <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-2">Tentang Saya</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
                                Freelance web developer dan digital enthusiast. Suka belajar hal baru dan berbagi
                                pengalaman.
                            </p>
                            <div class="flex items-center gap-3 mt-4">
                                <div class="flex items-center gap-1 text-xs text-gray-400 dark:text-gray-500">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span>Bergabung 2024</span>
                                </div>
                                <div class="flex items-center gap-1 text-xs text-gray-400 dark:text-gray-500">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>Jakarta, Indonesia</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- ==================== RIGHT COLUMN: EDITABLE SECTIONS ==================== -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Personal Information Section -->
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        @method('PUT')
                        <input type="file" name="avatar" id="avatarInput" accept="image/*" class="hidden">
                        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-gray-100 dark:border-slate-700 shadow-sm overflow-hidden">

                            <!-- HEADER -->
                            <div class="px-6 py-5 border-b border-gray-100 dark:border-slate-700">
                                <div class="flex items-center justify-between">

                                    <div>
                                        <h2 class="text-lg font-bold text-gray-900 dark:text-white">
                                            Informasi Pribadi
                                        </h2>

                                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">
                                            Data diri yang akan ditampilkan kepada penyedia jasa
                                        </p>
                                    </div>

                                    <button type="submit"
                                        class="px-4 py-2 bg-primary text-white text-sm font-medium rounded-xl hover:bg-primary/90 transition shadow-sm">
                                        Simpan Perubahan
                                    </button>

                                </div>
                            </div>

                            <!-- BODY -->
                            <div class="p-6">

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                    <!-- NAME -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                                            Nama Lengkap
                                        </label>

                                        <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}"
                                            class="w-full px-4 py-2.5 border border-gray-200 dark:border-slate-700 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-transparent dark:bg-slate-900 dark:text-white dark:placeholder-gray-500">

                                        @error('name')
                                            <p class="text-red-500 text-xs mt-1">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <!-- EMAIL -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                                            Email
                                        </label>

                                        <input type="email" name="email" value="{{ Auth::user()->email }}" readonly
                                            class="w-full px-4 py-2.5 border border-gray-200 dark:border-slate-700 rounded-xl bg-gray-50 dark:bg-slate-800 text-gray-500 dark:text-gray-400 focus:outline-none">

                                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                                            Email tidak dapat diubah
                                        </p>
                                    </div>

                                    <!-- PHONE -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                                            Nomor HP
                                        </label>

                                        <input type="tel" name="phone"
                                            value="{{ old('phone', Auth::user()->phone) }}"
                                            class="w-full px-4 py-2.5 border border-gray-200 dark:border-slate-700 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-transparent dark:bg-slate-900 dark:text-white dark:placeholder-gray-500">

                                        @error('phone')
                                            <p class="text-red-500 text-xs mt-1">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <!-- BIRTH DATE -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                                            Tanggal Lahir
                                        </label>

                                        <input type="date" name="birth_date"
                                            value="{{ old('birth_date', Auth::user()->birth_date ? date('Y-m-d', strtotime(Auth::user()->birth_date)) : '') }}"
                                            class="w-full px-4 py-2.5 border border-gray-200 dark:border-slate-700 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-transparent dark:bg-slate-900 dark:text-white dark:placeholder-gray-500">

                                        @error('birth_date')
                                            <p class="text-red-500 text-xs mt-1">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <!-- LOCATION -->
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                                            Lokasi
                                        </label>

                                        <input type="text" name="location"
                                            value="{{ old('location', Auth::user()->location) }}"
                                            class="w-full px-4 py-2.5 border border-gray-200 dark:border-slate-700 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-transparent dark:bg-slate-900 dark:text-white dark:placeholder-gray-500">

                                        @error('location')
                                            <p class="text-red-500 text-xs mt-1">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Account Security Section -->
                    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-gray-100 dark:border-slate-700 shadow-sm overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-100 dark:border-slate-700">
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white">Keamanan Akun</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Kelola keamanan dan akses ke akun Anda</p>
                        </div>
                        <div class="divide-y divide-gray-100 dark:divide-slate-700">
                            <div class="px-6 py-4 flex items-center justify-between">
                                <div>
                                    <h3 class="font-medium text-gray-800 dark:text-gray-200">Ubah Password</h3>
                                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">Perbarui password secara berkala</p>
                                </div>
                                <button
                                    class="px-4 py-2 border border-gray-200 dark:border-slate-700 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-xl hover:bg-gray-50 dark:hover:bg-slate-800 transition">
                                    Ubah
                                </button>
                            </div>
                            <div class="px-6 py-4 flex items-center justify-between">
                                <div>
                                    <h3 class="font-medium text-gray-800 dark:text-gray-200">Two-Factor Authentication</h3>
                                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">Tingkatkan keamanan akun Anda</p>
                                </div>
                                <button
                                    class="px-4 py-2 border border-gray-200 dark:border-slate-700 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-xl hover:bg-gray-50 dark:hover:bg-slate-800 transition">
                                    Aktifkan
                                </button>
                            </div>
                            <div class="px-6 py-4 flex items-center justify-between">
                                <div>
                                    <h3 class="font-medium text-gray-800 dark:text-gray-200">Login Terakhir</h3>
                                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">2 Mei 2025, 14:30 WIB • Perangkat: Chrome /
                                        Windows</p>
                                </div>
                                <i class="fas fa-shield-alt text-primary text-sm"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Provider / Seller Status Section -->
                    <div
                        class="bg-gradient-to-r from-primary/5 to-blue-50 dark:from-primary/10 dark:to-blue-950/30 rounded-2xl border border-primary/20 dark:border-primary/30 shadow-sm overflow-hidden">
                        <div class="px-6 py-6">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                <div>
                                    <div class="flex items-center gap-2 mb-2">
                                        <i class="fas fa-store text-primary text-xl"></i>
                                        <h2 class="text-lg font-bold text-gray-900 dark:text-white">Status Penyedia</h2>
                                    </div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        Anda belum menjadi penyedia jasa. Mulai jual jasa Anda di VEXORA!
                                    </p>
                                </div>
                                <a href=""
                                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white text-sm font-medium rounded-xl hover:bg-primary/90 transition shadow-sm whitespace-nowrap">
                                    <i class="fas fa-rocket text-sm"></i> Jadi Penyedia
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Preferences Section -->
                    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-gray-100 dark:border-slate-700 shadow-sm overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-100 dark:border-slate-700">
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white">Preferensi</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Atur notifikasi dan tampilan sesuai kebutuhan</p>
                        </div>
                        <div class="divide-y divide-gray-100 dark:divide-slate-700">
                            <div class="px-6 py-4 flex items-center justify-between">
                                <div>
                                    <h3 class="font-medium text-gray-800 dark:text-gray-200">Notifikasi Email</h3>
                                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">Terima update pesanan dan promo via email</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" checked class="sr-only peer">
                                    <div
                                        class="w-11 h-6 bg-gray-200 dark:bg-slate-700 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-primary/50 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary">
                                    </div>
                                </label>
                            </div>
                            <div class="px-6 py-4 flex items-center justify-between">
                                <div>
                                    <h3 class="font-medium text-gray-800 dark:text-gray-200">Bahasa</h3>
                                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">Preferensi bahasa tampilan</p>
                                </div>
                                <select
                                    class="px-3 py-1.5 border border-gray-200 dark:border-slate-700 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 dark:bg-slate-900 dark:text-white">
                                    <option>Bahasa Indonesia</option>
                                    <option>English</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Danger Zone (Optional) -->
                    <div class="bg-red-50/30 dark:bg-red-950/20 rounded-2xl border border-red-200 dark:border-red-900/50 overflow-hidden">
                        <div class="px-6 py-5">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                <div>
                                    <h3 class="font-semibold text-red-700 dark:text-red-400">Hapus Akun</h3>
                                    <p class="text-sm text-red-600/70 dark:text-red-400/70 mt-0.5">Tindakan ini tidak dapat dibatalkan</p>
                                </div>
                                <button
                                    class="px-4 py-2 bg-white dark:bg-slate-900 border border-red-300 dark:border-red-800 text-red-600 dark:text-red-400 text-sm font-medium rounded-xl hover:bg-red-50 dark:hover:bg-red-950/30 transition">
                                    Hapus Akun
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            /* Smooth transitions */
            .transition {
                transition: all 0.2s ease;
            }

            /* Custom toggle switch styling */
            .peer:checked~.peer-checked\:bg-primary {
                background-color: #3B82F6;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            const avatarInput = document.getElementById('avatarInput');
            const avatarPreview = document.getElementById('avatarPreview');
            const avatarPlaceholder = document.getElementById('avatarPlaceholder');

            avatarInput?.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (!file) return;
                const reader = new FileReader();
                reader.onload = function(event) {
                    avatarPreview.src = event.target.result;
                    avatarPreview.classList.remove('hidden')
                    if (avatarPlaceholder) {
                        avatarPlaceholder.classList.add('hidden');
                    }
                };
                reader.readAsDataURL(file);
            });


            // Optional: Profile completion calculation demo
            document.addEventListener('DOMContentLoaded', function() {
                const inputs = document.querySelectorAll('.personal-info-section input, .personal-info-section select');
                // This would be connected to real form logic in production
            });
        </script>
    @endpush

@endsection
