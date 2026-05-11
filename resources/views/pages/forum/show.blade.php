@extends('layouts.app')

@section('title', $thread->title . ' - Forum VEXORA')

@section('content')
<div class="animate-fade-in max-w-4xl mx-auto">

    <!-- Back Button -->
    <a href="{{ route('forum.index') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-primary mb-6 transition">
        <i class="fas fa-arrow-left"></i> Kembali ke Forum
    </a>

    <!-- Thread Content -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 mb-6">
        <div class="flex flex-wrap items-start justify-between gap-3 mb-4">
            <div>
                <div class="flex items-center gap-2 mb-2 flex-wrap">
                    <span class="px-2 py-0.5 rounded-full text-xs font-medium"
                          style="background-color: {{ $thread->category?->color ?? '#E0E7FF' }}; color: {{ $thread->category?->color ? '#1E3A8A' : '#4338CA' }};">
                        {{ $thread->category?->name ?? 'Umum' }}
                    </span>
                    <span class="text-xs text-gray-400">
                        <i class="far fa-clock"></i> {{ $thread->created_at->diffForHumans() }}
                    </span>
                </div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $thread->title }}</h1>
            </div>
            <div class="flex items-center gap-2">
                <button class="upvote-btn px-3 py-1.5 bg-gray-100 rounded-lg text-sm text-gray-600 hover:bg-primary/10 hover:text-primary transition"
                        data-thread-id="{{ $thread->id }}">
                    <i class="fas fa-arrow-up"></i> <span class="upvote-count">{{ number_format($thread->upvotes_count) }}</span>
                </button>
                <button class="px-3 py-1.5 bg-gray-100 rounded-lg text-sm text-gray-600 hover:bg-primary/10 hover:text-primary transition">
                    <i class="fas fa-bookmark"></i>
                </button>
            </div>
        </div>

        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary/20 to-blue-100 flex items-center justify-center text-primary font-semibold text-sm overflow-hidden flex-shrink-0">
                @if($thread->user && $thread->user->avatar)
                    @if(filter_var($thread->user->avatar, FILTER_VALIDATE_URL))
                        <img src="{{ $thread->user->avatar }}" class="w-full h-full object-cover">
                    @else
                        <img src="{{ asset('storage/' . $thread->user->avatar) }}" class="w-full h-full object-cover">
                    @endif
                @else
                    {{ strtoupper(substr($thread->user->name ?? 'U', 0, 2)) }}
                @endif
            </div>
            <div>
                <p class="font-semibold text-gray-800">{{ $thread->user->name ?? 'Pengguna' }}</p>
                <p class="text-xs text-gray-400">
                    @if($thread->user && $thread->user->created_at)
                        Bergabung {{ $thread->user->created_at->format('M Y') }}
                    @else
                        Member VEXORA
                    @endif
                </p>
            </div>
        </div>

        <div class="prose max-w-none text-gray-600 leading-relaxed space-y-4">
            {!! nl2br(e($thread->content)) !!}
        </div>
    </div>

    <!-- Reply List -->
    <div class="mb-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-bold text-lg text-gray-800">{{ number_format($thread->replies_count) }} Balasan</h3>
            <div class="flex gap-2">
                <button class="reply-sort-btn text-xs text-gray-500 hover:text-primary transition {{ request('sort') == 'latest' || !request('sort') ? 'text-primary font-medium' : '' }}"
                        data-sort="latest">Terbaru</button>
                <span class="text-gray-300">|</span>
                <button class="reply-sort-btn text-xs text-gray-500 hover:text-primary transition {{ request('sort') == 'oldest' ? 'text-primary font-medium' : '' }}"
                        data-sort="oldest">Terlama</button>
                <span class="text-gray-300">|</span>
                <button class="reply-sort-btn text-xs text-gray-500 hover:text-primary transition {{ request('sort') == 'popular' ? 'text-primary font-medium' : '' }}"
                        data-sort="popular">Terpopuler</button>
            </div>
        </div>

        <div id="replies-container" class="space-y-4">
            @forelse($replies as $reply)
            <div class="reply-card bg-white rounded-xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition" data-reply-id="{{ $reply->id }}">
                <div class="flex gap-3">
                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center text-gray-500 font-semibold text-xs overflow-hidden flex-shrink-0">
                        @if($reply->user && $reply->user->avatar)
                            @if(filter_var($reply->user->avatar, FILTER_VALIDATE_URL))
                                <img src="{{ $reply->user->avatar }}" class="w-full h-full object-cover">
                            @else
                                <img src="{{ asset('storage/' . $reply->user->avatar) }}" class="w-full h-full object-cover">
                            @endif
                        @else
                            {{ strtoupper(substr($reply->user->name ?? 'U', 0, 2)) }}
                        @endif
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between flex-wrap gap-2 mb-1">
                            <div>
                                <span class="font-semibold text-gray-800">{{ $reply->user->name ?? 'Pengguna' }}</span>
                                <span class="text-xs text-gray-400 ml-2">{{ $reply->created_at->diffForHumans() }}</span>
                                @if($reply->is_solution)
                                    <span class="ml-2 text-xs bg-green-100 text-green-700 px-1.5 py-0.5 rounded-full">
                                        <i class="fas fa-check-circle"></i> Best Solution
                                    </span>
                                @endif
                            </div>
                            <div class="flex items-center gap-2">
                                <button class="reply-upvote text-xs text-gray-400 hover:text-primary transition" data-reply-id="{{ $reply->id }}">
                                    <i class="fas fa-arrow-up"></i> <span class="upvote-count">{{ number_format($reply->upvotes_count) }}</span>
                                </button>
                                <button class="text-xs text-gray-400 hover:text-primary transition reply-btn" data-reply-id="{{ $reply->id }}">
                                    <i class="fas fa-reply"></i> Balas
                                </button>
                            </div>
                        </div>
                        <div class="reply-content text-gray-600 text-sm leading-relaxed">
                            {!! nl2br(e($reply->content)) !!}
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-12 bg-gray-50 rounded-2xl">
                <i class="fas fa-comments text-gray-300 text-4xl mb-3"></i>
                <h4 class="font-semibold text-gray-800 mb-1">Belum ada balasan</h4>
                <p class="text-sm text-gray-500">Jadilah yang pertama merespon diskusi ini</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($replies->hasPages())
        <div class="mt-6">
            {{ $replies->appends(request()->query())->links() }}
        </div>
        @endif
    </div>

    <!-- Reply Form -->
    @auth
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 sticky bottom-4">
        <h3 class="font-bold text-gray-800 mb-4">Tulis Balasan</h3>
        <form action="{{ route('forum.reply.store', $thread->slug) }}" method="POST" id="replyForm">
            @csrf
            <textarea name="content" rows="4" placeholder="Tulis komentar atau saran Anda..."
                      class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 resize-none @error('content') border-red-500 @enderror">{{ old('content') }}</textarea>
            @error('content')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
            <div class="flex justify-between items-center mt-3">
                <div class="flex gap-2 text-gray-400 text-sm">
                    <i class="fas fa-bold cursor-pointer hover:text-primary"></i>
                    <i class="fas fa-italic cursor-pointer hover:text-primary"></i>
                    <i class="fas fa-link cursor-pointer hover:text-primary"></i>
                    <i class="fas fa-code cursor-pointer hover:text-primary"></i>
                </div>
                <button type="submit" class="bg-primary hover:bg-primary/90 text-white font-medium px-6 py-2 rounded-xl transition">
                    Kirim Balasan
                </button>
            </div>
        </form>
        <p class="text-xs text-gray-400 mt-3">
            Dengan mengirim balasan, Anda menyetujui <a href="#" class="text-primary">Panduan Komunitas</a> VEXORA.
        </p>
    </div>
    @else
    <div class="bg-white rounded-2xl p-8 text-center border border-gray-100">
        <i class="fas fa-lock text-gray-400 text-3xl mb-3"></i>
        <h3 class="font-semibold text-gray-800 mb-2">Login untuk ikut berdiskusi</h3>
        <p class="text-sm text-gray-500 mb-4">Silakan login untuk memberikan balasan atau pertanyaan</p>
        <a href="{{ route('login') }}" class="inline-block px-6 py-2.5 bg-primary text-white font-medium rounded-xl hover:bg-primary/90 transition">
            Login Sekarang
        </a>
    </div>
    @endauth

    <!-- Related Threads -->
    @if($relatedThreads && $relatedThreads->count() > 0)
    <div class="mt-10 pt-6 border-t border-gray-100">
        <h3 class="font-bold text-lg text-gray-800 mb-4">Diskusi Terkait</h3>
        <div class="space-y-3">
            @foreach($relatedThreads as $related)
            <a href="{{ route('forum.show', $related->slug) }}" class="block bg-white rounded-xl p-4 border border-gray-100 hover:shadow-md transition group">
                <div class="flex items-center justify-between flex-wrap gap-2">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="px-2 py-0.5 rounded-full text-xs font-medium"
                                  style="background-color: {{ $related->category?->color ?? '#E0E7FF' }}; color: {{ $related->category?->color ? '#1E3A8A' : '#4338CA' }};">
                                {{ $related->category?->name ?? 'Umum' }}
                            </span>
                            <span class="text-xs text-gray-400">{{ $related->created_at->diffForHumans() }}</span>
                        </div>
                        <h4 class="font-semibold text-gray-800 group-hover:text-primary transition line-clamp-1">{{ $related->title }}</h4>
                        <div class="flex items-center gap-3 mt-1 text-xs text-gray-400">
                            <span><i class="far fa-comment"></i> {{ number_format($related->replies_count) }} balasan</span>
                            <span><i class="fas fa-eye"></i> {{ number_format($related->views_count) }} dilihat</span>
                        </div>
                    </div>
                    <i class="fas fa-chevron-right text-gray-300 group-hover:text-primary transition"></i>
                </div>
            </a>
            @endforeach
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
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .prose p, .prose ul {
        margin-bottom: 1rem;
    }
    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush

@push('scripts')
<script>
    // Reply form submission prevention double click
    const replyForm = document.getElementById('replyForm');
    if (replyForm) {
        replyForm.addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';
            }
        });
    }

    // Reply sorting
    const sortBtns = document.querySelectorAll('.reply-sort-btn');
    sortBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const sort = this.dataset.sort;
            const url = new URL(window.location.href);
            url.searchParams.set('sort', sort);
            window.location.href = url.toString();
        });
    });

    // Upvote functionality
    const upvoteBtns = document.querySelectorAll('.upvote-btn, .reply-upvote');
    upvoteBtns.forEach(btn => {
        btn.addEventListener('click', async function(e) {
            e.preventDefault();
            const isThread = this.classList.contains('upvote-btn');
            const id = this.dataset.threadId || this.dataset.replyId;
            const type = isThread ? 'thread' : 'reply';

            try {
                const response = await fetch(`/forum/${type}/${id}/upvote`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                const data = await response.json();
                if (data.success) {
                    const countSpan = this.querySelector('.upvote-count');
                    if (countSpan) countSpan.textContent = data.count.toLocaleString();
                }
            } catch (error) {
                console.error('Error upvoting:', error);
            }
        });
    });
</script>
@endpush

@endsection
