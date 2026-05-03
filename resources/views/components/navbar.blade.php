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
                class="{{ request()->is('providers*') ? 'text-primary font-semibold' : '' }}">
                Penyedia
            </a>
            <a href="#">Forum</a>
            <a href="#">Kontak</a>
            <a href="{{ route('about') }}" class="{{ request()->is('about') ? 'text-primary font-semibold' : '' }}">
                Tentang
            </a>
        </nav>

        <!-- RIGHT SIDE -->
        <div class="flex items-center gap-4">

            <!-- SEARCH -->
            <div class="relative hidden md:block">
                <input type="text" placeholder="Cari jasa..."
                    class="pl-10 pr-4 py-2 rounded-full border border-gray-200 text-sm focus:ring-2 focus:ring-primary w-52">
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
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

                    <!-- Trigger -->
                    <button id="profileBtn" class="flex items-center gap-2">

                        @if (Auth::user()->avatar)
                            <img src="{{ Auth::user()->avatar }}" class="w-9 h-9 rounded-full object-cover border">
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

                        <!-- Header -->
                        <div class="p-4 border-b flex items-center gap-3">

                            @if (Auth::user()->avatar)
                                <img src="{{ Auth::user()->avatar }}" class="w-10 h-10 rounded-full object-cover border">
                            @else
                                <div
                                    class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center font-bold">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            @endif

                            <div class="min-w-0">
                                <p class="font-semibold text-sm truncate">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                            </div>
                        </div>

                        <!-- Menu -->
                        <div class="py-2 text-sm">
                            <a href="/profile" class="block px-4 py-2 hover:bg-gray-50">Profile</a>
                            <a href="/dashboard" class="block px-4 py-2 hover:bg-gray-50">Dashboard</a>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-50">Pesanan</a>

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

            <!-- MOBILE BUTTON -->
            <button id="mobileMenuBtn" class="md:hidden text-gray-700">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
    </div>

    <!-- MOBILE MENU -->
    <div id="mobileMenu" class="hidden md:hidden bg-white border-t p-4">
        <nav class="flex flex-col space-y-3">
            <a href="{{ url('/') }}">Beranda</a>
            <a href="{{ url('/catalog') }}">Cari Jasa</a>
            <a href="#">Penyedia</a>
            <a href="#">Tentang</a>
            <a href="#">Blog</a>
            <a href="#">Kontak</a>

            @guest
                <div class="pt-3 border-t">
                    <a href="/login" class="block py-2">Sign In</a>
                    <a href="/register" class="block py-2 text-primary font-semibold">Sign Up</a>
                </div>
            @endguest
        </nav>
    </div>
</header>

@push('scripts')
    <script>
        // Mobile menu
        const mobileBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');

        if (mobileBtn && mobileMenu) {
            mobileBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        // Dropdown click
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
