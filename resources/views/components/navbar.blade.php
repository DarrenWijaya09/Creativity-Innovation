@php
    use Illuminate\Support\Str;
@endphp

<header class="sticky top-0 z-50 bg-white/95 dark:bg-gray-950/95 backdrop-blur-sm border-b border-gray-100 dark:border-gray-800 shadow-sm">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <!-- ==================== SINGLE ROW NAVBAR ==================== -->
        <div class="py-3 flex items-center justify-between gap-4 lg:gap-6">

            <!-- Logo - Focal Point Utama -->
            <a href="{{ url('/') }}" class="flex items-center gap-2 flex-shrink-0 hover:opacity-80 transition">
                <img src="{{ asset('assets/images/vexora-logo.png') }}" class="h-8 md:h-9 dark:brightness-90">
            </a>

            <!-- Desktop Navigation Menu -->
            <nav class="hidden lg:flex items-center gap-6 flex-1 justify-start ml-2">
                <a href="{{ url('/') }}"
                   class="text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-primary dark:hover:text-primary transition whitespace-nowrap {{ request()->is('/') ? 'text-primary dark:text-primary' : '' }}">
                    Beranda
                </a>
                <a href="{{ url('/catalog') }}"
                   class="text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-primary dark:hover:text-primary transition whitespace-nowrap {{ request()->is('catalog*') ? 'text-primary dark:text-primary' : '' }}">
                    Cari Jasa
                </a>
                <a href="{{ route('providers.index') }}"
                   class="text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-primary dark:hover:text-primary transition whitespace-nowrap {{ request()->is('providers*') ? 'text-primary dark:text-primary' : '' }}">
                    Penyedia
                </a>
                <a href="{{ route('forum.index') }}"
                   class="text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-primary dark:hover:text-primary transition whitespace-nowrap {{ request()->is('forum*') ? 'text-primary dark:text-primary' : '' }}">
                    Forum
                </a>
            </nav>

            <!-- Search Bar - Compact -->
            <div class="hidden lg:block flex-shrink-0">
                <form action="{{ route('catalog.index') }}" method="GET" class="relative">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari jasa..."
                        autocomplete="off"
                        class="w-64 pl-9 pr-3 py-2 rounded-full border border-gray-200 dark:border-gray-700
                               text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary
                               bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100
                               placeholder:text-gray-400 dark:placeholder:text-gray-500
                               transition-all duration-200 focus:w-72">
                    <i class="fas fa-search absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500 text-sm"></i>
                </form>
            </div>

            <!-- Utility Icons -->
            <div class="flex items-center gap-1 flex-shrink-0">

                <!-- Dark Mode Toggle -->
                <button x-data @click="darkMode = !darkMode"
                    class="w-9 h-9 rounded-full flex items-center justify-center
                           hover:bg-gray-100 dark:hover:bg-gray-800
                           text-gray-600 dark:text-gray-400 hover:text-primary dark:hover:text-primary
                           transition-all duration-200"
                    aria-label="Toggle Dark Mode">
                    <i x-show="!darkMode" class="fas fa-sun text-sm"></i>
                    <i x-show="darkMode" class="fas fa-moon text-sm"></i>
                </button>

                <!-- Cart -->
                <div class="relative">
                    <button id="cartBtn"
                        class="relative w-9 h-9 rounded-full flex items-center justify-center
                               hover:bg-gray-100 dark:hover:bg-gray-800
                               text-gray-600 dark:text-gray-400 hover:text-primary dark:hover:text-primary
                               transition-all duration-200">
                        <i class="fas fa-shopping-cart text-sm"></i>
                        @if ($cartCount > 0)
                            <span class="absolute -top-0.5 -right-0.5 min-w-[16px] h-[16px] px-1 bg-primary text-white text-[9px] rounded-full flex items-center justify-center font-medium">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </button>

                    <!-- Cart Dropdown -->
                    <div id="cartDropdown"
                        class="absolute right-0 mt-3 w-80 bg-white dark:bg-gray-900 rounded-2xl shadow-xl dark:shadow-black/50 border border-gray-100 dark:border-gray-800 hidden z-50">
                        <div class="flex justify-between items-center px-4 py-3 border-b border-gray-100 dark:border-gray-800">
                            <p class="font-semibold text-sm text-gray-900 dark:text-white">Keranjang</p>
                            <a href="{{ route('cart.index') }}" class="text-primary text-sm font-medium hover:underline">Lihat</a>
                        </div>

                        @if ($globalCartItems->count() > 0)
                            <div class="max-h-80 overflow-y-auto">
                                @foreach ($globalCartItems as $item)
                                    <div class="flex gap-3 px-4 py-3 border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                        <div class="w-12 h-12 rounded-xl overflow-hidden bg-gray-100 dark:bg-gray-800 flex-shrink-0">
                                            @if ($item->service?->image)
                                                @if (Str::startsWith($item->service->image, 'http'))
                                                    <img src="{{ $item->service->image }}" class="w-full h-full object-cover">
                                                @else
                                                    <img src="{{ asset('storage/' . $item->service->image) }}" class="w-full h-full object-cover">
                                                @endif
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-gray-400 dark:text-gray-600">
                                                    <i class="fas fa-image text-xs"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs font-semibold text-gray-900 dark:text-white line-clamp-1">{{ $item->service?->title }}</p>
                                            <p class="text-xs font-bold text-primary mt-1">Rp{{ number_format($item->price_snapshot, 0, ',', '.') }}</p>
                                        </div>
                                        <p class="text-xs text-gray-400 dark:text-gray-500">{{ $item->quantity }}x</p>
                                    </div>
                                @endforeach
                                <div class="p-4 border-t border-gray-100 dark:border-gray-800">
                                    <a href="{{ route('cart.index') }}" class="w-full bg-primary hover:bg-primary/90 text-white font-semibold py-2.5 rounded-xl flex items-center justify-center gap-2 transition text-sm">
                                        <i class="fas fa-shopping-cart text-xs"></i>
                                        Lihat Keranjang
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="p-6 text-center">
                                <img src="https://cdn-icons-png.flaticon.com/512/2038/2038854.png" class="w-16 mx-auto mb-3 dark:brightness-90">
                                <p class="text-sm font-semibold text-gray-900 dark:text-white mb-1">Keranjang kosong</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">Yuk, isi dengan jasa impianmu!</p>
                                <a href="{{ url('/catalog') }}" class="border border-primary text-primary px-4 py-2 rounded-lg hover:bg-primary hover:text-white text-sm transition">Mulai Belanja</a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Chat -->
                @auth
                    <a href="{{ route('chat.index') }}"
                       class="relative w-9 h-9 rounded-full flex items-center justify-center
                              hover:bg-gray-100 dark:hover:bg-gray-800
                              text-gray-600 dark:text-gray-400 hover:text-primary dark:hover:text-primary
                              transition-all duration-200
                              {{ request()->routeIs('chat.*') ? 'text-primary bg-gray-100 dark:bg-gray-800' : '' }}">
                        <i class="fas fa-comments text-sm"></i>
                        <span id="chatBadge" class="hidden absolute -top-0.5 -right-0.5 w-2 h-2 bg-primary rounded-full"></span>
                    </a>
                @endauth

                <!-- Profile / Auth -->
                @guest
                    <div class="flex items-center gap-1 ml-1">
                        <a href="/login" class="text-sm text-gray-600 dark:text-gray-400 hover:text-primary transition px-2 py-1.5">Masuk</a>
                        <a href="/register" class="text-sm bg-primary text-white px-4 py-1.5 rounded-full hover:bg-primary/90 transition">Daftar</a>
                    </div>
                @endguest

                @auth
                    <div class="relative">
                        <button id="profileBtn" class="flex items-center gap-1.5 hover:opacity-80 transition">
                            @if (Auth::user()->avatar)
                                <img src="{{ Str::startsWith(Auth::user()->avatar, 'http') ? Auth::user()->avatar : asset('storage/' . Auth::user()->avatar) }}"
                                    alt="{{ Auth::user()->name }}" class="w-7 h-7 rounded-full object-cover border dark:border-gray-700">
                            @else
                                <div class="w-7 h-7 rounded-full bg-primary text-white flex items-center justify-center font-bold text-xs">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            @endif
                            <i class="fas fa-chevron-down text-[10px] text-gray-500 dark:text-gray-400"></i>
                        </button>

                        <!-- Profile Dropdown -->
                        <div id="dropdownMenu"
                            class="absolute right-0 mt-3 w-56 bg-white dark:bg-gray-900 rounded-2xl shadow-xl dark:shadow-black/50 border border-gray-100 dark:border-gray-800 hidden z-50">
                            <div class="p-3 border-b border-gray-100 dark:border-gray-800">
                                <p class="font-semibold text-sm text-gray-900 dark:text-white truncate">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 truncate mt-0.5">{{ Auth::user()->email }}</p>
                            </div>
                            <div class="py-2 text-sm">
                                <a href="{{ route('profile.index') }}" class="block px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-800 text-gray-700 dark:text-gray-300 transition">Profil</a>
                                <a href="{{ auth()->user()->role == 1 ? '/seller/dashboard' : '/dashboard' }}" class="block px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-800 text-gray-700 dark:text-gray-300 transition">Dashboard</a>
                                <a href="{{ route('chat.index') }}" class="block px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-800 text-gray-700 dark:text-gray-300 flex items-center gap-2 transition">
                                    <i class="fas fa-comments text-xs text-primary"></i>
                                    <span>Pesan</span>
                                </a>
                                @if (Auth::user()->role == 1)
                                    <div class="border-t border-gray-100 dark:border-gray-800 my-1"></div>
                                    <a href="{{ route('services.create') }}" class="block px-4 py-2 hover:bg-gray-50 dark:hover:bg-gray-800 font-medium text-primary transition text-xs">+ Tambah Jasa</a>
                                @else
                                    <div class="border-t border-gray-100 dark:border-gray-800 my-1"></div>
                                    <a href="{{ route('provider.create') }}" class="block px-4 py-2 hover:bg-blue-50 dark:hover:bg-blue-950/30 transition">
                                        <div class="flex items-center gap-2">
                                            <i class="fas fa-store text-xs text-blue-600 dark:text-blue-400"></i>
                                            <span class="text-xs text-gray-700 dark:text-gray-300">Jadi Penyedia</span>
                                            <span class="text-[9px] bg-green-100 dark:bg-green-900/40 text-green-600 dark:text-green-400 px-1.5 py-0.5 rounded">Baru</span>
                                        </div>
                                    </a>
                                @endif
                                <div class="border-t border-gray-100 dark:border-gray-800 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="w-full text-left px-4 py-2 text-red-500 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-950/30 transition text-xs">
                                        <i class="fas fa-sign-out-alt mr-2 text-xs"></i>Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth

                <!-- Mobile Menu Button -->
                <button id="mobileMenuBtn"
                    class="lg:hidden w-9 h-9 rounded-full flex items-center justify-center hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-600 dark:text-gray-400 transition">
                    <i class="fas fa-bars text-lg"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden lg:hidden bg-white dark:bg-gray-950 border-t border-gray-100 dark:border-gray-800 py-4 mt-3 shadow-lg">
            <nav class="flex flex-col space-y-3">
                <form action="{{ route('catalog.index') }}" method="GET" class="relative mb-2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari jasa..."
                        class="w-full pl-11 pr-4 py-3 rounded-full border border-gray-200 dark:border-gray-700 text-sm focus:ring-2 focus:ring-primary/30 focus:border-primary bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500 text-sm"></i>
                </form>
                <a href="{{ url('/') }}" class="hover:text-primary py-2 transition {{ request()->is('/') ? 'text-primary font-semibold' : 'text-gray-700 dark:text-gray-300' }}">Beranda</a>
                <a href="{{ url('/catalog') }}" class="hover:text-primary py-2 transition {{ request()->is('catalog') ? 'text-primary font-semibold' : 'text-gray-700 dark:text-gray-300' }}">Cari Jasa</a>
                <a href="{{ route('providers.index') }}" class="hover:text-primary py-2 transition {{ request()->is('providers*') ? 'text-primary font-semibold' : 'text-gray-700 dark:text-gray-300' }}">Penyedia</a>
                <a href="{{ route('forum.index') }}" class="hover:text-primary py-2 transition {{ request()->is('forum*') ? 'text-primary font-semibold' : 'text-gray-700 dark:text-gray-300' }}">Forum</a>
                @auth
                    <a href="{{ route('chat.index') }}" class="hover:text-primary py-2 transition {{ request()->routeIs('chat.*') ? 'text-primary font-semibold' : 'text-gray-700 dark:text-gray-300' }} flex items-center gap-2">
                        <i class="fas fa-comments"></i> Pesan
                    </a>
                @endauth
                <a href="{{ route('contact.index') }}" class="hover:text-primary py-2 transition text-gray-700 dark:text-gray-300">Kontak</a>
                <a href="{{ route('about') }}" class="hover:text-primary py-2 transition text-gray-700 dark:text-gray-300">Tentang</a>
                @guest
                    <div class="flex flex-col gap-2 pt-3 border-t border-gray-100 dark:border-gray-800">
                        <a href="/login" class="text-center text-gray-700 dark:text-gray-300 hover:text-primary py-2">Masuk</a>
                        <a href="/register" class="text-center bg-primary text-white px-4 py-2 rounded-full hover:bg-primary/90">Daftar</a>
                    </div>
                @endguest
            </nav>
        </div>
    </div>
</header>

@push('scripts')
    <script>
        // Cart dropdown
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

        // Profile dropdown
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

        // Mobile menu
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');

        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });

            mobileMenu.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', () => {
                    mobileMenu.classList.add('hidden');
                });
            });
        }
    </script>
@endpush
