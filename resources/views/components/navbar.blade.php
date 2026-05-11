@php
    use Illuminate\Support\Str;
@endphp

<header class="sticky top-0 z-50 bg-white/95 backdrop-blur-sm border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-4 flex items-center justify-between">

        <!-- Logo -->
        <a href="{{ url('/') }}" class="flex items-center gap-2">
            <img src="{{ asset('assets/images/vexora-logo.png') }}" class="h-10">
        </a>

        <!-- Desktop Navigation -->
        <nav class="hidden md:flex items-center space-x-8 text-gray-600 font-medium">
            <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'text-primary font-semibold' : '' }}">Beranda</a>
            <a href="{{ url('/catalog') }}"
                class="{{ request()->is('catalog') ? 'text-primary font-semibold' : '' }}">Cari Jasa</a>
            <a href="{{ route('providers.index') }}"
                class="{{ request()->is('providers*') ? 'text-primary font-semibold' : '' }}">Penyedia</a>
            <a href="{{ route('forum.index') }}"
                class="{{ request()->is('forum*') ? 'text-primary font-semibold' : '' }}">Forum</a>
            <a href="{{ route('contact') }}"
                class="{{ request()->is('contact') ? 'text-primary font-semibold' : '' }}">Kontak</a>
            <a href="{{ route('about') }}"
                class="{{ request()->is('about') ? 'text-primary font-semibold' : '' }}">Tentang</a>
        </nav>

        <!-- RIGHT SIDE -->
        <div class="flex items-center gap-4">

            <!-- SEARCH -->
            <div class="relative hidden md:block">
                <input type="text" placeholder="Cari jasa..."
                    class="pl-10 pr-4 py-2 rounded-full border border-gray-200 text-sm focus:ring-2 focus:ring-primary w-52">
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
            </div>

            <!-- 🛒 MINI CART -->
            <div class="relative">

                <!-- BUTTON -->
                <button id="cartBtn" class="relative text-gray-500 hover:text-primary">
                    <i class="fas fa-shopping-cart text-lg"></i>

                    <!-- Badge -->
                    <span id="cartCount"
                        class="absolute -top-2 -right-2 bg-primary text-white text-[10px] px-1.5 rounded-full">
                        0
                    </span>
                </button>

                <!-- DROPDOWN -->
                <div id="cartDropdown"
                    class="absolute right-0 mt-3 w-96 bg-white rounded-2xl shadow-xl border hidden z-50">

                    <!-- HEADER -->
                    <div class="flex justify-between items-center px-4 py-3 border-b">
                        <p class="font-semibold text-sm">
                            Keranjang (0)
                        </p>

                        <a href="" class="text-primary text-sm font-medium hover:underline">
                            Lihat
                        </a>
                    </div>

                    <!-- LIST (HIDDEN DEFAULT) -->
                    <div id="cartItems" class="hidden max-h-80 overflow-y-auto">

                        <!-- ITEM TEMPLATE -->
                        <div class="flex gap-3 px-4 py-3 border-b">
                            <img src="https://via.placeholder.com/60" class="w-14 h-14 rounded-lg object-cover">

                            <div class="flex-1">
                                <p class="text-sm font-medium line-clamp-1">
                                    Nama Produk
                                </p>

                                <div class="flex justify-between items-center mt-1">
                                    <p class="text-xs text-gray-500">1x</p>

                                    <div class="text-right">
                                        <p class="text-sm font-semibold">Rp0</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- EMPTY STATE (DEFAULT) -->
                    <div id="cartEmpty" class="p-6 text-center">

                        <img src="https://cdn-icons-png.flaticon.com/512/2038/2038854.png" class="w-20 mx-auto mb-3">

                        <p class="text-sm font-semibold mb-1">
                            Wah, keranjang belanjamu kosong
                        </p>

                        <p class="text-xs text-gray-500 mb-4">
                            Yuk, isi dengan jasa impianmu!
                        </p>

                        <a href="{{ url('/catalog') }}"
                            class="border border-primary text-primary px-4 py-2 rounded-lg hover:bg-primary hover:text-white transition text-sm">
                            Mulai Belanja
                        </a>
                    </div>

                </div>
            </div>

            <!-- AUTH -->
            @guest
                <div class="hidden md:flex items-center gap-2">
                    <a href="/login" class="text-sm text-gray-600 hover:text-primary">Sign In</a>
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
                                alt="{{ Auth::user()->name }}" class="w-9 h-9 rounded-full object-cover border">
                        @else
                            <div
                                class="w-9 h-9 rounded-full bg-primary text-white flex items-center justify-center font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @endif

                        <span class="hidden md:block text-sm font-medium text-gray-700">
                            {{ Auth::user()->name }}
                        </span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </button>

                    <!-- Dropdown -->
                    <div id="dropdownMenu"
                        class="absolute right-0 mt-3 w-64 bg-white rounded-2xl shadow-xl border hidden z-50">

                        <!-- USER INFO -->
                        <div class="p-4 border-b flex items-center gap-3">
                            <div class="min-w-0">
                                <p class="font-semibold text-sm truncate">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                            </div>
                        </div>

                        <div class="py-2 text-sm">

                            <!-- BASIC MENU -->
                            <a href="{{ route('profile.index') }}" class="block px-4 py-2 hover:bg-gray-50">Profile</a>
                            <a href="{{ auth()->user()->role == 1 ? '/seller/dashboard' : '/dashboard' }}"
                                class="block px-4 py-2 hover:bg-gray-50">
                                Dashboard
                            </a>

                            {{-- ============================= --}}
                            {{-- SELLER CTA / DASHBOARD LOGIC --}}
                            {{-- ============================= --}}

                            @if (Auth::user()->role == 1)
                                <!-- USER SUDAH SELLER -->
                                @if (Auth::user()->role == 1)
                                    <a href="" class="block px-4 py-2 hover:bg-gray-50 font-medium text-primary">
                                        Tambah Jasa
                                    </a>

                                    <a href="" class="block px-4 py-2 hover:bg-gray-50 text-gray-600">
                                        Dashboard Penyedia
                                    </a>
                                @endif
                            @else
                                <!-- USER BELUM SELLER -->
                                <div class="border-t my-2"></div>

                                <a href="{{ route('provider.create') }}"
                                    class="block px-4 py-3 hover:bg-blue-50 transition">

                                    <div class="flex items-start gap-3">

                                        <!-- ICON -->
                                        <div class="bg-blue-100 text-blue-600 p-2 rounded-lg">
                                            <i class="fas fa-store text-sm"></i>
                                        </div>

                                        <!-- TEXT -->
                                        <div>
                                            <p class="font-semibold text-sm text-gray-800 flex items-center gap-2">
                                                Jadi Penyedia
                                                <span class="text-[10px] bg-green-100 text-green-600 px-2 py-0.5 rounded">
                                                    Baru
                                                </span>
                                            </p>

                                            <p class="text-xs text-gray-500">
                                                Mulai jual jasa & dapatkan pelanggan
                                            </p>
                                        </div>

                                    </div>
                                </a>
                            @endif

                            <!-- LOGOUT -->
                            <div class="border-t my-2"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="w-full text-left px-4 py-2 text-red-500 hover:bg-red-50">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endauth

            <!-- MOBILE -->
            <button id="mobileMenuBtn" class="md:hidden text-gray-700">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
    </div>
</header>

@push('scripts')
    <script>
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
    </script>
@endpush
