@php
    $categoryColors = [
        'blue' => [
            'badge' => 'bg-blue-50 text-blue-700 ring-blue-100 dark:bg-blue-950/30 dark:text-blue-400 dark:ring-blue-800',
            'dot' => 'bg-blue-500 dark:bg-blue-400',
        ],
        'purple' => [
            'badge' => 'bg-purple-50 text-purple-700 ring-purple-100 dark:bg-purple-950/30 dark:text-purple-400 dark:ring-purple-800',
            'dot' => 'bg-purple-500 dark:bg-purple-400',
        ],
        'pink' => [
            'badge' => 'bg-pink-50 text-pink-700 ring-pink-100 dark:bg-pink-950/30 dark:text-pink-400 dark:ring-pink-800',
            'dot' => 'bg-pink-500 dark:bg-pink-400',
        ],
        'emerald' => [
            'badge' => 'bg-emerald-50 text-emerald-700 ring-emerald-100 dark:bg-emerald-950/30 dark:text-emerald-400 dark:ring-emerald-800',
            'dot' => 'bg-emerald-500 dark:bg-emerald-400',
        ],
        'orange' => [
            'badge' => 'bg-orange-50 text-orange-700 ring-orange-100 dark:bg-orange-950/30 dark:text-orange-400 dark:ring-orange-800',
            'dot' => 'bg-orange-500 dark:bg-orange-400',
        ],
        'cyan' => [
            'badge' => 'bg-cyan-50 text-cyan-700 ring-cyan-100 dark:bg-cyan-950/30 dark:text-cyan-400 dark:ring-cyan-800',
            'dot' => 'bg-cyan-500 dark:bg-cyan-400',
        ],
        'red' => [
            'badge' => 'bg-red-50 text-red-700 ring-red-100 dark:bg-red-950/30 dark:text-red-400 dark:ring-red-800',
            'dot' => 'bg-red-500 dark:bg-red-400',
        ],
        'amber' => [
            'badge' => 'bg-amber-50 text-amber-700 ring-amber-100 dark:bg-amber-950/30 dark:text-amber-400 dark:ring-amber-800',
            'dot' => 'bg-amber-500 dark:bg-amber-400',
        ],
        'indigo' => [
            'badge' => 'bg-indigo-50 text-indigo-700 ring-indigo-100 dark:bg-indigo-950/30 dark:text-indigo-400 dark:ring-indigo-800',
            'dot' => 'bg-indigo-500 dark:bg-indigo-400',
        ],
    ];
@endphp

@extends('layouts.app')

@section('title', 'Forum Diskusi Teknologi - VEXORA')

@section('content')
    <div class="animate-fade-in">

        <!-- Forum Header - Premium -->
        <section class="mb-12">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 mb-8">
                <div class="space-y-2">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white tracking-tight">
                        Diskusi Teknologi
                    </h1>
                    <p class="text-gray-500 dark:text-gray-400 text-base max-w-2xl">
                        Bergabunglah dengan komunitas developer Indonesia. Diskusikan teknologi terbaru, bagikan pengalaman,
                        dan temukan solusi.
                    </p>
                </div>
                <a href="{{ route('forum.create') }}"
                    class="group inline-flex items-center gap-2 bg-primary hover:bg-primary/90 text-white font-semibold px-6 py-3 rounded-xl transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    <i class="fas fa-plus-circle text-sm"></i>
                    <span>Buat Diskusi Baru</span>
                </a>
            </div>

            <!-- Search Bar - Enhanced -->
            <div class="relative max-w-2xl">
                <form method="GET" action="{{ route('forum.index') }}" class="relative">
                    <div class="relative">
                        <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500 text-sm"></i>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari diskusi... (contoh: Laravel, React, deployment)"
                            class="w-full pl-11 pr-20 py-3.5 bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-700 rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary/50 transition-all duration-200 shadow-sm text-gray-900 dark:text-white placeholder:text-gray-400 dark:placeholder:text-gray-500">
                        @if (request('search'))
                            <a href="{{ route('forum.index') }}"
                                class="absolute right-3 top-1/2 -translate-y-1/2 px-3 py-1 text-xs text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 transition">
                                <i class="fas fa-times"></i>
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </section>

        <!-- Category Filters - Refined -->
        <div class="mb-10">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2">
                    <i class="fas fa-tag text-gray-400 dark:text-gray-500 text-xs"></i>
                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Filter Kategori</span>
                </div>
                @if (request('category'))
                    <a href="{{ route('forum.index', request()->except('category')) }}"
                        class="text-xs text-primary hover:underline flex items-center gap-1">
                        <i class="fas fa-times-circle"></i> Reset filter
                    </a>
                @endif
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('forum.index', request()->except('category')) }}"
                    class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-200
                      {{ !request('category')
                          ? 'bg-primary text-white shadow-sm'
                          : 'bg-gray-100 dark:bg-slate-800 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-slate-700 hover:text-gray-800 dark:hover:text-white' }}">
                    Semua Diskusi
                </a>
                @foreach ($categories as $category)
                    <a href="{{ route('forum.index', array_merge(request()->except('category'), ['category' => $category->slug])) }}"
                        class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-200
                          {{ request('category') == $category->slug
                              ? 'bg-primary text-white shadow-sm'
                              : 'bg-gray-100 dark:bg-slate-800 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-slate-700 hover:text-gray-800 dark:hover:text-white' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Thread List - Redesigned Cards -->
        <section class="space-y-4">
            @forelse($threads as $thread)
                @php
                    $categoryStyle = $categoryColors[$thread->category?->color] ?? [
                        'badge' => 'bg-gray-50 text-gray-700 ring-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:ring-gray-700',
                        'dot' => 'bg-gray-400 dark:bg-gray-500',
                    ];
                @endphp
                <div class="group bg-white dark:bg-slate-900 rounded-2xl border border-gray-100 dark:border-slate-700 hover:border-gray-200 dark:hover:border-slate-600 transition-all duration-300 hover:shadow-lg dark:hover:shadow-black/30 cursor-pointer"
                    onclick="window.location='{{ route('forum.show', $thread->slug) }}'">

                    <div class="p-6">
                        <!-- Top Row: Category + Timestamp -->
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center gap-2">
                                <span
                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium ring-1 {{ $categoryStyle['badge'] }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $categoryStyle['dot'] }}"></span>
                                    {{ $thread->category?->name ?? 'Umum' }}
                                </span>
                                <span class="text-xs text-gray-400 dark:text-gray-500 flex items-center gap-1">
                                    <i class="far fa-clock text-xs"></i>
                                    {{ $thread->created_at->diffForHumans() }}
                                </span>
                            </div>
                            <div class="flex items-center gap-3 text-xs text-gray-400 dark:text-gray-500">
                                <span class="flex items-center gap-1">
                                    <i class="fas fa-eye"></i> {{ number_format($thread->views_count) }}
                                </span>
                            </div>
                        </div>

                        <!-- Title - Focal Point -->
                        <h3
                            class="text-xl font-bold text-gray-900 dark:text-white group-hover:text-primary transition-colors duration-200 mb-2 line-clamp-1">
                            {{ $thread->title }}
                        </h3>

                        <!-- Excerpt -->
                        <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed line-clamp-2 mb-4">
                            {{ Str::limit(strip_tags($thread->content), 140) }}
                        </p>

                        <!-- Author & Stats - Refined -->
                        <div class="flex flex-wrap items-center justify-between gap-4 pt-3 border-t border-gray-50 dark:border-slate-800">
                            <div class="flex items-center gap-2">
                                <div
                                    class="w-6 h-6 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 flex items-center justify-center text-gray-600 dark:text-gray-400 text-xs font-medium overflow-hidden">
                                    @if ($thread->user && $thread->user->avatar)
                                        @if (filter_var($thread->user->avatar, FILTER_VALIDATE_URL))
                                            <img src="{{ $thread->user->avatar }}" alt="{{ $thread->user->name }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <img src="{{ asset('storage/' . $thread->user->avatar) }}"
                                                alt="{{ $thread->user->name }}" class="w-full h-full object-cover">
                                        @endif
                                    @else
                                        <span class="text-sm font-semibold text-gray-600 dark:text-gray-400">
                                            {{ strtoupper(substr($thread->user->name ?? 'U', 0, 1)) }}
                                        </span>
                                    @endif
                                </div>
                                <span
                                    class="text-sm text-gray-600 dark:text-gray-400 font-medium">{{ $thread->user?->name ?? 'Pengguna' }}</span>
                            </div>

                            <div class="flex items-center gap-4">
                                <div class="flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400">
                                    <i class="far fa-comment text-gray-400 dark:text-gray-500"></i>
                                    <span class="font-medium">{{ number_format($thread->replies_count) }}</span>
                                    <span class="text-xs text-gray-400 dark:text-gray-500">balasan</span>
                                </div>
                                <div class="flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400">
                                    <i class="fas fa-arrow-up text-gray-400 dark:text-gray-500"></i>
                                    <span class="font-medium">{{ number_format($thread->upvotes_count) }}</span>
                                    <span class="text-xs text-gray-400 dark:text-gray-500">upvote</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Empty State - Premium -->
                <div class="text-center py-20 bg-gray-50 dark:bg-slate-800/50 rounded-3xl">
                    <div class="flex justify-center mb-6">
                        <div
                            class="w-20 h-20 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 rounded-full flex items-center justify-center">
                            <i class="fas fa-comments text-gray-400 dark:text-gray-500 text-3xl"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">
                        {{ request('search') ? 'Tidak ada hasil yang ditemukan' : 'Belum ada diskusi' }}
                    </h3>
                    <p class="text-gray-500 dark:text-gray-400 text-sm mb-6 max-w-md mx-auto">
                        {{ request('search')
                            ? 'Coba gunakan kata kunci lain atau jelajahi kategori yang tersedia'
                            : 'Jadilah yang pertama memulai diskusi di forum teknologi VEXORA' }}
                    </p>
                    @if (request('search'))
                        <a href="{{ route('forum.index') }}"
                            class="inline-flex items-center gap-2 px-5 py-2.5 border border-gray-300 dark:border-slate-600 text-gray-700 dark:text-gray-300 font-medium rounded-xl hover:bg-gray-100 dark:hover:bg-slate-700 transition">
                            <i class="fas fa-times"></i> Hapus Filter
                        </a>
                    @else
                        <a href="{{ route('forum.create') }}"
                            class="inline-flex items-center gap-2 bg-primary hover:bg-primary/90 text-white font-semibold px-6 py-3 rounded-xl transition shadow-md">
                            <i class="fas fa-plus-circle"></i> Buat Diskusi Pertama
                        </a>
                    @endif
                </div>
            @endforelse
        </section>

        <!-- Pagination - Styled -->
        @if ($threads->hasPages())
            <div class="mt-12 pt-2">
                {{ $threads->appends(request()->query())->links() }}
            </div>
        @endif

        <!-- Community Stats - Subtle Footer -->
        @if ($threads->total() > 0)
            <div class="mt-12 pt-8 border-t border-gray-100 dark:border-slate-800">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div class="flex items-center gap-6">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-primary/10 dark:bg-primary/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-users text-primary text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-800 dark:text-gray-200">{{ number_format($threads->total()) }}</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500">Total Diskusi</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-primary/10 dark:bg-primary/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-reply-all text-primary text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-800 dark:text-gray-200">
                                    {{ number_format($threads->sum('replies_count')) }}</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500">Total Balasan</p>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('forum.create') }}"
                        class="text-sm text-primary hover:underline flex items-center gap-1">
                        <i class="fas fa-plus-circle"></i> Mulai diskusi baru
                    </a>
                </div>
            </div>
        @endif

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

            .line-clamp-1 {
                display: -webkit-box;
                -webkit-line-clamp: 1;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            .line-clamp-2 {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            /* Pagination customization */
            .pagination {
                display: flex;
                justify-content: center;
                gap: 0.5rem;
                flex-wrap: wrap;
            }

            .pagination .page-item .page-link {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                min-width: 2.5rem;
                height: 2.5rem;
                padding: 0 0.75rem;
                border-radius: 0.75rem;
                border: 1px solid #e5e7eb;
                color: #4b5563;
                font-size: 0.875rem;
                font-weight: 500;
                transition: all 0.2s ease;
            }

            .dark .pagination .page-item .page-link {
                background-color: #0f172a;
                border-color: #1e293b;
                color: #cbd5e1;
            }

            .pagination .page-item.active .page-link {
                background-color: #3B82F6;
                border-color: #3B82F6;
                color: white;
            }

            .pagination .page-item .page-link:hover:not(.active) {
                background-color: #f3f4f6;
                border-color: #d1d5db;
            }

            .dark .pagination .page-item .page-link:hover:not(.active) {
                background-color: #1e293b;
            }

            .pagination .page-item.disabled .page-link {
                opacity: 0.5;
                cursor: not-allowed;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            // Preserve search and filters on category click
            document.querySelectorAll('.category-filter').forEach(link => {
                link.addEventListener('click', function(e) {
                    const searchValue = document.querySelector('input[name="search"]')?.value;
                    const currentUrl = new URL(window.location.href);
                    if (searchValue && !currentUrl.searchParams.has('search')) {
                        e.preventDefault();
                        const url = new URL(this.href);
                        url.searchParams.set('search', searchValue);
                        window.location.href = url.toString();
                    }
                });
            });
        </script>
    @endpush

@endsection
