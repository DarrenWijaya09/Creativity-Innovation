@php
    use Illuminate\Support\Str;
@endphp

<header class="sticky top-0 z-50 bg-white/95 dark:bg-gray-950/95 backdrop-blur-sm border-b border-gray-100 dark:border-gray-800 shadow-sm transition-theme">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-4 flex items-center justify-between">

        <!-- Logo -->
        <a href="{{ url('/') }}" class="flex items-center gap-2">
            <img src="{{ asset('assets/images/vexora-logo.png') }}" class="h-10 dark:brightness-90">
        </a>

        <!-- Desktop Navigation -->
        <nav class="hidden md:flex items-center space-x-8 text-gray-600 dark:text-gray-300 font-medium">
            <a href="{{ url('/') }}" class="hover:text-primary dark:hover:text-primary transition {{ request()->is('/') ? 'text-primary dark:text-primary font-semibold' : '' }}">Beranda</a>
            <a href="{{ url('/catalog') }}"
                class="hover:text-primary dark:hover:text-primary transition {{ request()->is('catalog') ? 'text-primary dark:text-primary font-semibold' : '' }}">Cari Jasa</a>
            <a href="{{ route('providers.index') }}"
                class="hover:text-primary dark:hover:text-primary transition {{ request()->is('providers*') ? 'text-primary dark:text-primary font-semibold' : '' }}">Penyedia</a>
            <a href="{{ route('forum.index') }}"
                class="hover:text-primary dark:hover:text-primary transition {{ request()->is('forum*') ? 'text-primary dark:text-primary font-semibold' : '' }}">Forum</a>
            <a href="{{ route('contact.index') }}"
                class="hover:text-primary dark:hover:text-primary transition {{ request()->is('contact') ? 'text-primary dark:text-primary font-semibold' : '' }}">Kontak</a>
            <a href="{{ route('about') }}"
                class="hover:text-primary dark:hover:text-primary transition {{ request()->is('about') ? 'text-primary dark:text-primary font-semibold' : '' }}">Tentang</a>
        </nav>

        <!-- RIGHT SIDE -->
        <div class="flex items-center gap-4">

            <!-- SEARCH -->
            <form action="{{ route('catalog.index') }}" method="GET" class="relative hidden md:block">

                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari logo design, website, video editor..." autocomplete="off"
                    class="pl-11 pr-4 py-2.5 rounded-full border border-gray-200 dark:border-gray-700 text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary w-64 transition bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 placeholder:text-gray-400 dark:placeholder:text-gray-500">

                <button type="submit"
                    class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500 hover:text-primary dark:hover:text-primary transition">

                    <i class="fas fa-search text-sm"></i>

                </button>

            </form>

            <!-- DARK MODE TOGGLE - CLEAN & MODERN -->
            <button x-data
                @click="darkMode = !darkMode"
                class="relative w-9 h-9 rounded-full flex items-center justify-center transition-all duration-200
                       bg-gray-100 dark:bg-gray-800
                       text-gray-700 dark:text-gray-300
                       hover:bg-gray-200 dark:hover:bg-gray-700
                       hover:scale-105 active:scale-95"
                aria-label="Toggle Dark Mode">
                <!-- Sun Icon (Light Mode) -->
                <i x-show="!darkMode" class="fas fa-sun text-sm"></i>
                <!-- Moon Icon (Dark Mode) -->
                <i x-show="darkMode" class="fas fa-moon text-sm"></i>
            </button>

            <!-- 🛒 MINI CART -->
            <div class="relative">

                <!-- BUTTON -->
                <button id="cartBtn" class="relative text-gray-500 dark:text-gray-400 hover:text-primary dark:hover:text-primary transition">
                    <i class="fas fa-shopping-cart text-lg"></i>

                    <!-- Badge -->
                    @if ($cartCount > 0)
                        <span id="cartCount"
                            class="absolute -top-2 -right-2 min-w-[18px] h-[18px] px-1.5 bg-primary text-white text-[10px] rounded-full flex items-center justify-center font-medium">
                            {{ $cartCount }}
                        </span>
                    @endif
                </button>

                <!-- DROPDOWN -->
                <div id="cartDropdown"
                    class="absolute right-0 mt-3 w-96 bg-white dark:bg-gray-900 rounded-2xl shadow-xl dark:shadow-black/50 border border-gray-100 dark:border-gray-800 hidden z-50 transition-theme">

                    <!-- HEADER -->
                    <div class="flex justify-between items-center px-4 py-3 border-b border-gray-100 dark:border-gray-800">
                        <p class="font-semibold text-sm text-gray-900 dark:text-white flex items-center gap-2">
                            Keranjang
                            @if ($cartCount > 0)
                                <span
                                    class="min-w-[20px] h-5 px-1.5 rounded-full bg-primary text-white text-[11px] flex items-center justify-center">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        </p>

                        <a href="{{ route('cart.index') }}" class="text-primary text-sm font-medium hover:underline">
                            Lihat
                        </a>
                    </div>

                    <!-- LIST -->
                    @if ($globalCartItems->count() > 0)
                        <div class="max-h-80 overflow-y-auto">
                            @foreach ($globalCartItems as $item)
                                <div class="flex gap-3 px-4 py-3 border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                    {{-- IMAGE --}}
                                    <div class="w-14 h-14 rounded-xl overflow-hidden bg-gray-100 dark:bg-gray-800 flex-shrink-0">
                                        @if ($item->service?->image)
                                            @if (Str::startsWith($item->service->image, 'http'))
                                                <img src="{{ $item->service->image }}"
                                                    class="w-full h-full object-cover">
                                            @else
                                                <img src="{{ asset('storage/' . $item->service->image) }}"
                                                    class="w-full h-full object-cover">
                                            @endif
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-400 dark:text-gray-600">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- CONTENT --}}
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white line-clamp-1">
                                            {{ $item->service?->title }}</p>

                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5 line-clamp-1">
                                            {{ $item->service?->provider?->name }}</p>

                                        <div class="flex items-center justify-between mt-2">
                                            <p class="text-xs text-gray-400 dark:text-gray-500">{{ $item->quantity }}x</p>

                                            <p class="text-sm font-bold text-gray-900 dark:text-white">
                                                Rp{{ number_format($item->price_snapshot, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            {{-- FOOTER --}}
                            <div class="p-4 border-t border-gray-100 dark:border-gray-800 bg-white dark:bg-gray-900">
                                <a href="{{ route('cart.index') }}"
                                    class="w-full bg-primary hover:bg-primary/90 text-white font-semibold py-3 rounded-xl transition flex items-center justify-center gap-2">
                                    <i class="fas fa-shopping-cart text-sm"></i>
                                    Lihat Keranjang
                                </a>
                            </div>
                        </div>
                    @endif

                    <!-- EMPTY STATE -->
                    @if ($globalCartItems->count() === 0)
                        <div id="cartEmpty" class="p-6 text-center">

                            <img src="https://cdn-icons-png.flaticon.com/512/2038/2038854.png"
                                class="w-20 mx-auto mb-3 dark:brightness-90">

                            <p class="text-sm font-semibold text-gray-900 dark:text-white mb-1">
                                Wah, keranjang belanjamu kosong
                            </p>

                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">
                                Yuk, isi dengan jasa impianmu!
                            </p>

                            <a href="{{ url('/catalog') }}"
                                class="border border-primary text-primary px-4 py-2 rounded-lg hover:bg-primary hover:text-white transition text-sm">
                                Mulai Belanja
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- AUTH -->
            @guest
                <div class="hidden md:flex items-center gap-2">
                    <a href="/login" class="text-sm text-gray-600 dark:text-gray-400 hover:text-primary dark:hover:text-primary">Sign In</a>
                    <a href="/register" class="text-sm bg-primary text-white px-4 py-2 rounded-full hover:bg-primary/90">
                        Sign Up
                    </a>
                </div>
            @endguest

            @auth
                <div class="relative">
                    <button id="profileBtn" class="flex items-center gap-2">

                        @if (Auth::user()->avatar)
                            <img src="{{ Str::startsWith(Auth::user()->avatar, 'http')
                                ? Auth::user()->avatar
                                : asset('storage/' . Auth::user()->avatar) }}"
                                alt="{{ Auth::user()->name }}" class="w-9 h-9 rounded-full object-cover border dark:border-gray-700">
                        @else
                            <div
                                class="w-9 h-9 rounded-full bg-primary text-white flex items-center justify-center font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @endif

                        <span class="hidden md:block text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ Auth::user()->name }}
                        </span>
                        <i class="fas fa-chevron-down text-xs text-gray-500 dark:text-gray-400"></i>
                    </button>

                    <!-- Dropdown -->
                    <div id="dropdownMenu"
                        class="absolute right-0 mt-3 w-64 bg-white dark:bg-gray-900 rounded-2xl shadow-xl dark:shadow-black/50 border border-gray-100 dark:border-gray-800 hidden z-50 transition-theme">

                        <!-- USER INFO -->
                        <div class="p-4 border-b border-gray-100 dark:border-gray-800 flex items-center gap-3">
                            <div class="min-w-0">
                                <p class="font-semibold text-sm truncate text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ Auth::user()->email }}</p>
                            </div>
                        </div>

                        <div class="py-2 text-sm">

                            <!-- BASIC MENU -->
                            <a href="{{ route('profile.index') }}" class="block px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-800 text-gray-700 dark:text-gray-300 transition">Profile</a>
                            <a href="{{ auth()->user()->role == 1 ? '/seller/dashboard' : '/dashboard' }}"
                                class="block px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-800 text-gray-700 dark:text-gray-300 transition">
                                Dashboard
                            </a>

                            {{-- SELLER CTA / DASHBOARD LOGIC --}}
                            @if (Auth::user()->role == 1)
                                <!-- USER SUDAH SELLER -->
                                <a href="{{ route('services.create') }}" class="block px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-800 font-medium text-primary transition">
                                    Tambah Jasa
                                </a>

                                <a href="{{ route('seller.dashboard') }}" class="block px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-800 text-gray-700 dark:text-gray-300 transition">
                                    Dashboard Penyedia
                                </a>
                            @else
                                <!-- USER BELUM SELLER -->
                                <div class="border-t border-gray-100 dark:border-gray-800 my-2"></div>

                                <a href="{{ route('provider.create') }}"
                                    class="block px-4 py-3 hover:bg-blue-50 dark:hover:bg-blue-950/30 transition">

                                    <div class="flex items-start gap-3">

                                        <!-- ICON -->
                                        <div class="bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 p-2 rounded-lg">
                                            <i class="fas fa-store text-sm"></i>
                                        </div>

                                        <!-- TEXT -->
                                        <div>
                                            <p class="font-semibold text-sm text-gray-800 dark:text-gray-200 flex items-center gap-2">
                                                Jadi Penyedia
                                                <span class="text-[10px] bg-green-100 dark:bg-green-900/40 text-green-600 dark:text-green-400 px-2 py-0.5 rounded">
                                                    Baru
                                                </span>
                                            </p>

                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                Mulai jual jasa & dapatkan pelanggan
                                            </p>
                                        </div>

                                    </div>
                                </a>
                            @endif

                            <!-- LOGOUT -->
                            <div class="border-t border-gray-100 dark:border-gray-800 my-2"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="w-full text-left px-4 py-2 text-red-500 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-950/30 transition">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endauth

            <!-- MOBILE MENU BUTTON -->
            <button id="mobileMenuBtn" class="md:hidden text-gray-700 dark:text-gray-300">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
    </div>

    <!-- MOBILE MENU (Hidden by default) -->
    <div id="mobileMenu" class="hidden md:hidden bg-white dark:bg-gray-950 border-t border-gray-100 dark:border-gray-800 py-4 px-6 shadow-lg transition-theme">
        <nav class="flex flex-col space-y-3">
            <form action="{{ route('catalog.index') }}" method="GET" class="relative mb-3">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari jasa..."
                    class="w-full pl-11 pr-4 py-3 rounded-full border border-gray-200 dark:border-gray-700 text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 placeholder:text-gray-400 dark:placeholder:text-gray-500">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500 text-sm"></i>
            </form>
            <a href="{{ url('/') }}" class="hover:text-primary transition py-2 {{ request()->is('/') ? 'text-primary font-semibold' : 'text-gray-700 dark:text-gray-300' }}">Beranda</a>
            <a href="{{ url('/catalog') }}" class="hover:text-primary transition py-2 {{ request()->is('catalog') ? 'text-primary font-semibold' : 'text-gray-700 dark:text-gray-300' }}">Cari Jasa</a>
            <a href="{{ route('providers.index') }}" class="hover:text-primary transition py-2 {{ request()->is('providers*') ? 'text-primary font-semibold' : 'text-gray-700 dark:text-gray-300' }}">Penyedia</a>
            <a href="{{ route('forum.index') }}" class="hover:text-primary transition py-2 {{ request()->is('forum*') ? 'text-primary font-semibold' : 'text-gray-700 dark:text-gray-300' }}">Forum</a>
            <a href="{{ route('contact.index') }}" class="hover:text-primary transition py-2 {{ request()->is('contact') ? 'text-primary font-semibold' : 'text-gray-700 dark:text-gray-300' }}">Kontak</a>
            <a href="{{ route('about') }}" class="hover:text-primary transition py-2 {{ request()->is('about') ? 'text-primary font-semibold' : 'text-gray-700 dark:text-gray-300' }}">Tentang</a>

            @guest
                <div class="flex flex-col gap-2 pt-3 border-t border-gray-100 dark:border-gray-800">
                    <a href="/login" class="text-center text-gray-700 dark:text-gray-300 hover:text-primary py-2">Sign In</a>
                    <a href="/register" class="text-center bg-primary text-white px-4 py-2 rounded-full hover:bg-primary/90">Sign Up</a>
                </div>
            @endguest
        </nav>
    </div>
</header>

@push('scripts')
    <script>
        // Dark Mode Toggle (Fallback - already handled by Alpine)
        // The main dark mode is handled by Alpine.js in layout

        // CART DROPDOWN
        const cartBtn = document.getElementById('cartBtn');
        const cartDropdown = document.getElementById('cartDropdown');

        if (cartBtn && cartDropdown) {
            cartBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                cartDropdown.classList.toggle('hidden');
            });

            document.addEventListener('click', (e) => {
                if (!cartDropdown.contains(e.target) && !cartBtn.contains(e.target)) {
                    cartDropdown.classList.add('hidden');
                }
            });
        }

        // PROFILE DROPDOWN
        const btn = document.getElementById('profileBtn');
        const menu = document.getElementById('dropdownMenu');

        if (btn && menu) {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                menu.classList.toggle('hidden');
            });

            document.addEventListener('click', (e) => {
                if (!menu.contains(e.target) && !btn.contains(e.target)) {
                    menu.classList.add('hidden');
                }
            });
        }

        // MOBILE MENU
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');

        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });

            // Close mobile menu when clicking a link
            mobileMenu.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', () => {
                    mobileMenu.classList.add('hidden');
                });
            });
        }
    </script>
@endpush
