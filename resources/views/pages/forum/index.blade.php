@extends('layouts.app')

@section('title', 'Forum Diskusi Teknologi - VEXORA')

@section('content')
<div class="animate-fade-in">

    <!-- Forum Header -->
    <section class="mb-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Forum Diskusi Teknologi</h1>
                <p class="text-gray-500 mt-1">Diskusikan topik seputar teknologi & IT bersama komunitas</p>
            </div>
            <a href="{{ route('forum.create') }}" class="inline-flex items-center gap-2 bg-primary hover:bg-primary/90 text-white font-medium px-5 py-2.5 rounded-xl transition shadow-sm">
                <i class="fas fa-plus-circle"></i> Buat Diskusi
            </a>
        </div>

        <!-- Search & Filter Bar -->
        <form method="GET" action="{{ route('forum.index') }}" class="flex flex-col md:flex-row gap-4 mb-6">
            <div class="flex-1 relative">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Cari diskusi... (contoh: Laravel, React, deployment)"
                       class="w-full pl-11 pr-4 py-3 bg-white border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50">
            </div>
            <div class="flex gap-2 overflow-x-auto pb-2 md:pb-0 scrollbar-hide">
                <a href="{{ route('forum.index', request()->except('category')) }}"
                   class="px-4 py-2 rounded-full text-sm font-medium whitespace-nowrap transition {{ !request('category') ? 'bg-primary/10 text-primary' : 'bg-gray-100 text-gray-600 hover:bg-primary hover:text-white' }}">
                    Semua
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('forum.index', array_merge(request()->except('category'), ['category' => $category->slug])) }}"
                       class="px-4 py-2 rounded-full text-sm font-medium whitespace-nowrap transition {{ request('category') == $category->slug ? 'bg-primary/10 text-primary' : 'bg-gray-100 text-gray-600 hover:bg-primary hover:text-white' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </form>
    </section>

    <!-- Thread List -->
    <section class="space-y-4">
        @forelse($threads as $thread)
        <div class="bg-white rounded-2xl p-5 shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100 cursor-pointer group"
             onclick="window.location='{{ route('forum.show', $thread->slug) }}'">
            <div class="flex flex-wrap items-start justify-between gap-3">
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-2 flex-wrap">
                        <span class="px-2 py-0.5 rounded-full text-xs font-medium"
                              style="background-color: {{ $thread->category?->color ?? '#E0E7FF' }}; color: {{ $thread->category?->color ? '#1E3A8A' : '#4338CA' }};">
                            {{ $thread->category?->name ?? 'Umum' }}
                        </span>
                        <span class="text-xs text-gray-400">
                            <i class="far fa-clock"></i> {{ $thread->created_at->diffForHumans() }}
                        </span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-1 group-hover:text-primary transition line-clamp-1">
                        {{ $thread->title }}
                    </h3>
                    <p class="text-gray-500 text-sm line-clamp-2">
                        {{ Str::limit(strip_tags($thread->content), 120) }}
                    </p>
                    <div class="flex items-center gap-4 mt-3 text-sm text-gray-400">
                        <span class="flex items-center gap-1">
                            <i class="fas fa-user-circle"></i> {{ $thread->user?->name ?? 'Pengguna' }}
                        </span>
                        <span class="flex items-center gap-1">
                            <i class="far fa-comment"></i> {{ number_format($thread->replies_count) }} balasan
                        </span>
                        <span class="flex items-center gap-1">
                            <i class="fas fa-arrow-up"></i> {{ number_format($thread->upvotes_count) }} upvote
                        </span>
                        <span class="flex items-center gap-1">
                            <i class="fas fa-eye"></i> {{ number_format($thread->views_count) }} dilihat
                        </span>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-16 bg-gray-50 rounded-2xl">
            <i class="fas fa-comments text-gray-300 text-5xl mb-4"></i>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Belum ada diskusi</h3>
            <p class="text-gray-500 text-sm mb-4 max-w-md mx-auto">
                {{ request('search') ? 'Tidak ada diskusi yang cocok dengan pencarian Anda.' : 'Jadilah yang pertama memulai diskusi di forum teknologi VEXORA!' }}
            </p>
            <a href="{{ route('forum.create') }}" class="inline-flex items-center gap-2 bg-primary hover:bg-primary/90 text-white font-medium px-5 py-2.5 rounded-xl transition shadow-sm">
                <i class="fas fa-plus-circle"></i> Buat Diskusi Pertama
            </a>
        </div>
        @endforelse
    </section>

    <!-- Pagination -->
    @if($threads->hasPages())
    <div class="mt-10">
        {{ $threads->appends(request()->query())->links() }}
    </div>
    @endif

</div>

@push('styles')
<style>
    .animate-fade-in {
        animation: fadeIn 0.5s ease-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
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
</style>
@endpush

@push('scripts')
<script>
    // Preserve search on category filter click
    document.querySelectorAll('.category-filter').forEach(link => {
        link.addEventListener('click', function(e) {
            const searchValue = document.querySelector('input[name="search"]')?.value;
            if (searchValue) {
                const url = new URL(this.href);
                url.searchParams.set('search', searchValue);
                this.href = url.toString();
            }
        });
    });
</script>
@endpush

@endsection
