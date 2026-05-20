@php
    use Illuminate\Support\Str;

    $categoryColors = [
        'blue' => 'bg-blue-100 text-blue-700',
        'purple' => 'bg-purple-100 text-purple-700',
        'pink' => 'bg-pink-100 text-pink-700',
        'emerald' => 'bg-emerald-100 text-emerald-700',
        'orange' => 'bg-orange-100 text-orange-700',
        'cyan' => 'bg-cyan-100 text-cyan-700',
        'red' => 'bg-red-100 text-red-700',
        'amber' => 'bg-amber-100 text-amber-700',
        'indigo' => 'bg-indigo-100 text-indigo-700',
    ];

    function getInitials($name)
    {
        if (!$name) {
            return 'U';
        }
        $words = explode(' ', trim($name));
        if (count($words) >= 2) {
            return strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
        }
        return strtoupper(substr($name, 0, 2));
    }
@endphp

@extends('layouts.app')

@section('title', $thread->title . ' - Forum VEXORA')

@section('content')
    <div class="animate-fade-in max-w-4xl mx-auto px-4 sm:px-0">

        <!-- Back Button -->
        <div class="mb-8">
            <a href="{{ route('forum.index') }}"
                class="inline-flex items-center gap-2 text-gray-400 hover:text-primary transition text-sm">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Kembali ke Forum</span>
            </a>
        </div>

        <!-- Thread Content -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm mb-8 overflow-hidden" id="threadContainer">
            <!-- Display Mode -->
            <div id="threadDisplayMode" class="p-6 sm:p-8">
                <div class="flex flex-wrap items-start justify-between gap-4 mb-6">
                    <div class="space-y-3">
                        <div class="flex items-center gap-2">
                            <span
                                class="px-2.5 py-1 rounded-full text-xs font-medium {{ $categoryColors[$thread->category?->color] ?? 'bg-gray-100 text-gray-700' }}">
                                {{ $thread->category?->name ?? 'Umum' }}
                            </span>
                            <span class="text-xs text-gray-400 flex items-center gap-1">
                                <i class="far fa-clock text-xs"></i>
                                {{ $thread->created_at->diffForHumans() }}
                            </span>
                        </div>
                        <h1 id="threadTitle"
                            class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-900 leading-tight tracking-tight">
                            {{ $thread->title }}
                        </h1>
                    </div>
                    <div class="flex items-center gap-2">
                        <button
                            class="upvote-btn group flex items-center gap-1.5 px-3 py-1.5 bg-gray-50 hover:bg-primary/5 rounded-xl text-sm text-gray-500 hover:text-primary transition-all duration-200 disabled:opacity-50"
                            data-thread-id="{{ $thread->id }}" data-type="thread">
                            <i class="fas fa-arrow-up text-xs group-hover:-translate-y-0.5 transition-transform"></i>
                            <span class="upvote-count font-medium">{{ number_format($thread->upvotes_count) }}</span>
                        </button>

                        @if ($thread->isOwner())
                            <button id="editThreadBtn"
                                class="flex items-center gap-1.5 px-3 py-1.5 bg-gray-50 hover:bg-blue-50 rounded-xl text-sm text-gray-500 hover:text-blue-600 transition">
                                <i class="fas fa-pen text-xs"></i>
                                <span>Edit</span>
                            </button>

                            <button id="deleteThreadBtn"
                                class="flex items-center gap-1.5 px-3 py-1.5 bg-gray-50 hover:bg-red-50 rounded-xl text-sm text-gray-500 hover:text-red-600 transition"
                                data-delete-url="{{ route('forum.destroy', $thread->slug) }}">
                                <i class="fas fa-trash text-xs"></i>
                                <span>Hapus</span>
                            </button>
                        @endif
                    </div>
                </div>

                <div class="flex items-center gap-3 py-5 border-y border-gray-100 mb-6">
                    <div
                        class="w-10 h-10 rounded-full bg-gradient-to-br from-primary/10 to-blue-100 flex items-center justify-center text-primary font-semibold text-sm overflow-hidden flex-shrink-0">
                        @if ($thread->user && $thread->user->avatar)
                            @if (filter_var($thread->user->avatar, FILTER_VALIDATE_URL))
                                <img src="{{ $thread->user->avatar }}" class="w-full h-full object-cover">
                            @else
                                <img src="{{ asset('storage/' . $thread->user->avatar) }}"
                                    class="w-full h-full object-cover">
                            @endif
                        @else
                            {{ getInitials($thread->user->name ?? 'Pengguna') }}
                        @endif
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900 text-sm">{{ $thread->user->name ?? 'Pengguna' }}</p>
                        <p class="text-xs text-gray-400">
                            @if ($thread->user && $thread->user->created_at)
                                Bergabung {{ $thread->user->created_at->format('M Y') }}
                            @else
                                Member VEXORA
                            @endif
                        </p>
                    </div>
                </div>

                <div id="threadContent" class="markdown-body prose prose-gray max-w-none">
                    {!! Str::markdown($thread->content) !!}
                </div>
            </div>

            <!-- Edit Mode (Hidden by default) -->
            <div id="threadEditMode" class="hidden p-6 sm:p-8">
                <form action="{{ route('forum.update', $thread->slug) }}" method="POST" id="editThreadForm">
                    @csrf
                    @method('PUT')

                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                Judul Diskusi <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="title" value="{{ old('title', $thread->title) }}" required
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                Kategori <span class="text-red-500">*</span>
                            </label>
                            <select name="category_id" required
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 bg-white">
                                <option value="">Pilih kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $thread->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                Isi Diskusi <span class="text-red-500">*</span>
                            </label>
                            <textarea name="content" rows="8" required
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 resize-y">{{ old('content', $thread->content) }}</textarea>
                            <p class="text-xs text-gray-400 mt-1">Minimal 20 karakter. Mendukung Markdown.</p>
                        </div>

                        <div class="flex gap-3 pt-3 border-t border-gray-100">
                            <button type="submit"
                                class="bg-primary hover:bg-primary/90 text-white font-medium px-5 py-2 rounded-xl transition shadow-sm">
                                <i class="fas fa-save mr-1.5 text-xs"></i> Simpan Perubahan
                            </button>
                            <button type="button" id="cancelEditBtn"
                                class="px-5 py-2 border border-gray-300 text-gray-600 font-medium rounded-xl hover:bg-gray-50 transition">
                                Batal
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Reply List Section -->
        <div class="mb-8">
            <div class="flex flex-wrap items-center justify-between gap-3 mb-5">
                <h3 class="text-lg font-semibold text-gray-900">{{ number_format($thread->replies_count) }} Balasan</h3>
                <div class="flex items-center gap-3 text-xs">
                    <button
                        class="reply-sort-btn text-gray-500 hover:text-primary transition {{ request('sort') == 'latest' || !request('sort') ? 'text-primary font-medium' : '' }}"
                        data-sort="latest">Terbaru</button>
                    <span class="text-gray-300">•</span>
                    <button
                        class="reply-sort-btn text-gray-500 hover:text-primary transition {{ request('sort') == 'oldest' ? 'text-primary font-medium' : '' }}"
                        data-sort="oldest">Terlama</button>
                    <span class="text-gray-300">•</span>
                    <button
                        class="reply-sort-btn text-gray-500 hover:text-primary transition {{ request('sort') == 'popular' ? 'text-primary font-medium' : '' }}"
                        data-sort="popular">Terpopuler</button>
                </div>
            </div>

            <div id="replies-container" class="space-y-5">
                @forelse($replies as $reply)
                    <div class="reply-card bg-white rounded-xl border border-gray-100 hover:border-gray-200 transition-all duration-200"
                        data-reply-id="{{ $reply->id }}" data-original-content="{{ e($reply->content) }}">
                        <div class="p-5 sm:p-6">
                            <div class="flex gap-3">
                                <div
                                    class="w-9 h-9 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center text-gray-500 font-semibold text-xs overflow-hidden flex-shrink-0 mt-0.5">
                                    @if ($reply->user && $reply->user->avatar)
                                        @if (filter_var($reply->user->avatar, FILTER_VALIDATE_URL))
                                            <img src="{{ $reply->user->avatar }}" class="w-full h-full object-cover">
                                        @else
                                            <img src="{{ asset('storage/' . $reply->user->avatar) }}"
                                                class="w-full h-full object-cover">
                                        @endif
                                    @else
                                        {{ getInitials($reply->user->name ?? 'Pengguna') }}
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                                        <div class="flex items-center gap-2 flex-wrap">
                                            <span class="reply-author font-semibold text-gray-900 text-sm">
                                                {{ $reply->user->name ?? 'Pengguna' }}
                                            </span>
                                            <span
                                                class="text-xs text-gray-400">{{ $reply->created_at->diffForHumans() }}</span>
                                            @if ($reply->is_solution)
                                                <span
                                                    class="inline-flex items-center gap-1 text-xs bg-green-50 text-green-700 px-2 py-0.5 rounded-full">
                                                    <i class="fas fa-check-circle text-xs"></i> Best Solution
                                                </span>
                                            @endif
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <button
                                                class="reply-upvote group flex items-center gap-1 text-xs text-gray-400 hover:text-primary transition disabled:opacity-50"
                                                data-reply-id="{{ $reply->id }}">
                                                <i
                                                    class="fas fa-arrow-up text-xs group-hover:-translate-y-0.5 transition-transform"></i>
                                                <span
                                                    class="upvote-count font-medium">{{ number_format($reply->upvotes_count) }}</span>
                                            </button>
                                            <button class="reply-quote text-xs text-gray-400 hover:text-primary transition"
                                                data-reply-id="{{ $reply->id }}">
                                                <i class="fas fa-reply mr-1"></i> Balas
                                            </button>
                                            @if ($reply->isOwner())
                                                <button
                                                    class="reply-edit-btn text-xs text-gray-400 hover:text-blue-600 transition"
                                                    data-reply-id="{{ $reply->id }}">
                                                    <i class="fas fa-pen mr-1"></i> Edit
                                                </button>
                                                <button
                                                    class="reply-delete-btn text-xs text-gray-400 hover:text-red-600 transition"
                                                    data-reply-id="{{ $reply->id }}">
                                                    <i class="fas fa-trash mr-1"></i> Hapus
                                                </button>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Reply Display Mode -->
                                    <div class="reply-display-mode">
                                        <div class="reply-content markdown-body prose prose-sm max-w-none">
                                            {!! Str::markdown($reply->content) !!}
                                        </div>
                                    </div>

                                    <!-- Reply Edit Mode (Hidden by default) -->
                                    <div class="reply-edit-mode hidden mt-3">
                                        <form class="edit-reply-form" data-reply-id="{{ $reply->id }}">
                                            @csrf
                                            @method('PUT')
                                            <textarea name="content" rows="4"
                                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 resize-y text-sm">{{ $reply->content }}</textarea>
                                            <div class="flex gap-2 mt-2">
                                                <button type="submit"
                                                    class="px-3 py-1.5 bg-primary text-white text-xs font-medium rounded-lg hover:bg-primary/90 transition">
                                                    Simpan
                                                </button>
                                                <button type="button"
                                                    class="cancel-reply-edit px-3 py-1.5 border border-gray-300 text-gray-600 text-xs font-medium rounded-lg hover:bg-gray-50 transition">
                                                    Batal
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-14 bg-gray-50/50 rounded-2xl">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-comments text-gray-300 text-xl"></i>
                        </div>
                        <h4 class="font-semibold text-gray-800 mb-1">Belum ada balasan</h4>
                        <p class="text-sm text-gray-400">Jadilah yang pertama merespon diskusi ini</p>
                    </div>
                @endforelse
            </div>

            @if ($replies->hasPages())
                <div class="mt-8 pt-2">{{ $replies->appends(request()->query())->links() }}</div>
            @endif
        </div>

        <!-- Reply Form -->
        @auth
            <div class="sticky bottom-6 z-10">
                <div class="bg-white rounded-2xl border border-gray-100 shadow-lg transition-all duration-200 overflow-hidden"
                    id="replyComposer">
                    <div id="compactComposer" class="p-4 cursor-pointer hover:bg-gray-50/50 transition-colors duration-150"
                        role="button" tabindex="0" aria-expanded="false">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-full bg-gradient-to-br from-primary/10 to-blue-100 flex items-center justify-center text-primary font-semibold text-xs overflow-hidden flex-shrink-0">
                                @if (auth()->user()->avatar)
                                    @if (filter_var(auth()->user()->avatar, FILTER_VALIDATE_URL))
                                        <img src="{{ auth()->user()->avatar }}" class="w-full h-full object-cover">
                                    @else
                                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}"
                                            class="w-full h-full object-cover">
                                    @endif
                                @else
                                    {{ getInitials(auth()->user()->name) }}
                                @endif
                            </div>
                            <div
                                class="flex-1 text-gray-400 text-sm border border-gray-200 rounded-xl px-4 py-2.5 hover:border-gray-300 hover:bg-white transition-all">
                                <span class="text-gray-400">Tulis balasan...</span>
                            </div>
                            <div class="text-gray-300 text-sm">
                                <i class="fas fa-chevron-down text-xs transition-transform duration-200"></i>
                            </div>
                        </div>
                    </div>

                    <div id="expandedComposer" class="hidden">
                        <div class="p-5 sm:p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-2">
                                    <div
                                        class="w-8 h-8 rounded-full bg-gradient-to-br from-primary/10 to-blue-100 flex items-center justify-center text-primary font-semibold text-xs overflow-hidden flex-shrink-0">
                                        @if (auth()->user()->avatar)
                                            @if (filter_var(auth()->user()->avatar, FILTER_VALIDATE_URL))
                                                <img src="{{ auth()->user()->avatar }}" class="w-full h-full object-cover">
                                            @else
                                                <img src="{{ asset('storage/' . auth()->user()->avatar) }}"
                                                    class="w-full h-full object-cover">
                                            @endif
                                        @else
                                            {{ getInitials(auth()->user()->name) }}
                                        @endif
                                    </div>
                                    <span class="text-sm font-medium text-gray-700">Tulis Balasan</span>
                                </div>
                                <button id="collapseBtn"
                                    class="text-gray-400 hover:text-gray-600 transition p-1 rounded-lg hover:bg-gray-100">
                                    <i class="fas fa-times text-sm"></i>
                                </button>
                            </div>

                            <form action="{{ route('forum.reply.store', $thread->slug) }}" method="POST" id="replyForm">
                                @csrf

                                <div
                                    class="border border-gray-200 rounded-xl overflow-hidden focus-within:ring-2 focus-within:ring-primary/20 focus-within:border-primary/50 transition-all">
                                    <textarea name="content" id="replyContent" rows="5" placeholder="Tulis komentar atau saran Anda..."
                                        class="w-full px-4 py-3 resize-y focus:outline-none text-gray-700 text-sm">{{ old('content') }}</textarea>
                                </div>

                                <div class="text-xs text-gray-400 mt-2">
                                    Mendukung Markdown: **bold** • *italic* • `code` • ```code block```
                                </div>

                                @error('content')
                                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                @enderror

                                <div class="flex flex-wrap items-center justify-between gap-3 mt-4">
                                    <div class="text-xs text-gray-400">
                                        <span id="charCount">0</span>/1000 karakter
                                    </div>
                                    <button type="submit" id="submitReplyBtn"
                                        class="bg-primary hover:bg-primary/90 text-white font-medium px-5 py-2 rounded-xl transition shadow-sm disabled:opacity-50 text-sm">
                                        <i class="fas fa-paper-plane mr-1.5 text-xs"></i> Kirim Balasan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <p class="text-xs text-gray-400 mt-3 text-center">
                    Dengan mengirim balasan, Anda menyetujui <a href="#" class="text-primary">Panduan Komunitas</a>
                    VEXORA.
                </p>
            </div>

            <script>
                (function() {
                    // ==================== THREAD EDIT & DELETE ====================
                    const editThreadBtn = document.getElementById('editThreadBtn');
                    const deleteThreadBtn = document.getElementById('deleteThreadBtn');
                    const displayMode = document.getElementById('threadDisplayMode');
                    const editMode = document.getElementById('threadEditMode');
                    const cancelEditBtn = document.getElementById('cancelEditBtn');

                    if (editThreadBtn && displayMode && editMode) {
                        editThreadBtn.addEventListener('click', () => {
                            displayMode.classList.add('hidden');
                            editMode.classList.remove('hidden');
                            editMode.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        });

                        if (cancelEditBtn) {
                            cancelEditBtn.addEventListener('click', () => {
                                displayMode.classList.remove('hidden');
                                editMode.classList.add('hidden');
                            });
                        }
                    }

                    if (deleteThreadBtn) {
                        deleteThreadBtn.addEventListener('click', async () => {
                            const confirmed = confirm(
                                'Apakah Anda yakin ingin menghapus diskusi ini? Tindakan ini tidak dapat dibatalkan.'
                            );

                            if (!confirmed) return;

                            const deleteUrl = deleteThreadBtn.dataset.deleteUrl;

                            try {
                                const response = await fetch(deleteUrl, {
                                    method: 'DELETE',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Accept': 'application/json'
                                    }
                                });

                                if (!response.ok) {
                                    throw new Error('Gagal menghapus thread.');
                                }

                                const data = await response.json();

                                if (data.success) {
                                    window.location.href = data.redirect;
                                } else {
                                    alert(data.message || 'Gagal menghapus diskusi.');
                                }

                            } catch (error) {
                                console.error(error);
                                alert('Terjadi kesalahan saat menghapus diskusi.');
                            }
                        });
                    }

                    // ==================== REPLY EDIT & DELETE ====================
                    document.querySelectorAll('.reply-edit-btn').forEach(btn => {
                        btn.addEventListener('click', () => {
                            const replyCard = btn.closest('.reply-card');
                            const displayDiv = replyCard.querySelector('.reply-display-mode');
                            const editDiv = replyCard.querySelector('.reply-edit-mode');
                            if (displayDiv && editDiv) {
                                displayDiv.classList.add('hidden');
                                editDiv.classList.remove('hidden');
                            }
                        });
                    });

                    document.querySelectorAll('.cancel-reply-edit').forEach(btn => {
                        btn.addEventListener('click', () => {
                            const replyCard = btn.closest('.reply-card');
                            const displayDiv = replyCard.querySelector('.reply-display-mode');
                            const editDiv = replyCard.querySelector('.reply-edit-mode');
                            if (displayDiv && editDiv) {
                                displayDiv.classList.remove('hidden');
                                editDiv.classList.add('hidden');
                            }
                        });
                    });

                    document.querySelectorAll('.edit-reply-form').forEach(form => {
                        form.addEventListener('submit', async (e) => {
                            e.preventDefault();
                            const replyId = form.dataset.replyId;
                            const formData = new FormData(form);
                            const content = formData.get('content');

                            try {
                                const response = await fetch(`/forum/reply/${replyId}`, {
                                    method: 'PUT',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify({
                                        content
                                    })
                                });
                                const data = await response.json();
                                if (data.success) {
                                    window.location.reload();
                                } else {
                                    alert('Gagal mengupdate balasan.');
                                }
                            } catch (error) {
                                console.error('Error:', error);
                                alert('Terjadi kesalahan.');
                            }
                        });
                    });

                    document.querySelectorAll('.reply-delete-btn').forEach(btn => {
                        btn.addEventListener('click', async () => {
                            if (confirm('Apakah Anda yakin ingin menghapus balasan ini?')) {
                                const replyId = btn.dataset.replyId;
                                try {
                                    const response = await fetch(`/forum/reply/${replyId}`, {
                                        method: 'DELETE',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        }
                                    });
                                    const data = await response.json();
                                    if (data.success) {
                                        window.location.reload();
                                    } else {
                                        alert('Gagal menghapus balasan.');
                                    }
                                } catch (error) {
                                    console.error('Error:', error);
                                    alert('Terjadi kesalahan.');
                                }
                            }
                        });
                    });

                    // ==================== COMPOSER FUNCTIONALITY ====================
                    const compactComposer = document.getElementById('compactComposer');
                    const expandedComposer = document.getElementById('expandedComposer');
                    const collapseBtn = document.getElementById('collapseBtn');
                    const textarea = document.getElementById('replyContent');
                    const replyForm = document.getElementById('replyForm');
                    const charCountSpan = document.getElementById('charCount');

                    let isExpanded = false;

                    function expandComposer() {
                        if (isExpanded) return;
                        if (compactComposer) compactComposer.style.display = 'none';
                        if (expandedComposer) expandedComposer.classList.remove('hidden');
                        isExpanded = true;
                        setTimeout(() => {
                            if (textarea) textarea.focus();
                        }, 200);
                    }

                    function collapseComposer() {
                        if (!isExpanded) return;
                        if (compactComposer) compactComposer.style.display = 'block';
                        if (expandedComposer) expandedComposer.classList.add('hidden');
                        isExpanded = false;
                    }

                    function updateCharCount() {
                        if (charCountSpan && textarea) {
                            charCountSpan.textContent = textarea.value.length;
                        }
                    }

                    if (compactComposer) {
                        compactComposer.addEventListener('click', expandComposer);
                        compactComposer.addEventListener('keydown', (e) => {
                            if (e.key === 'Enter' || e.key === ' ') {
                                e.preventDefault();
                                expandComposer();
                            }
                        });
                    }

                    if (collapseBtn) {
                        collapseBtn.addEventListener('click', collapseComposer);
                    }

                    if (textarea) {
                        textarea.addEventListener('input', updateCharCount);
                        updateCharCount();
                        textarea.addEventListener('focus', () => {
                            if (!isExpanded) expandComposer();
                        });
                    }

                    if (replyForm) {
                        replyForm.addEventListener('submit', function() {
                            const submitBtn = document.getElementById('submitReplyBtn');
                            if (submitBtn) {
                                submitBtn.disabled = true;
                                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1.5"></i> Mengirim...';
                            }
                        });
                    }

                    document.querySelectorAll('.reply-quote').forEach(btn => {
                        btn.addEventListener('click', (e) => {
                            const replyCard = btn.closest('.reply-card');
                            const replyAuthor = replyCard?.querySelector('.reply-author')?.textContent
                                ?.trim() || 'Pengguna';
                            const replyContentElement = replyCard?.querySelector('.reply-content');
                            let replyContent = '';
                            if (replyContentElement) {
                                replyContent = replyContentElement.innerText.trim();
                            }
                            if (textarea) {
                                const quotedText =
                                    `> **${replyAuthor}** mengatakan:\n> ${replyContent.split('\n').join('\n> ')}\n\n`;
                                textarea.value = quotedText;
                                textarea.focus();
                                updateCharCount();
                                if (!isExpanded) expandComposer();
                            }
                        });
                    });

                    document.addEventListener('keydown', (e) => {
                        if (e.key === 'Escape' && isExpanded && textarea && !textarea.value.trim()) {
                            collapseComposer();
                        }
                    });
                })();
            </script>
        @else
            <div class="bg-gray-50/50 rounded-2xl p-8 text-center border border-gray-100 mb-8">
                <div class="w-14 h-14 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-lock text-gray-400 text-lg"></i>
                </div>
                <h3 class="font-semibold text-gray-800 mb-1">Login untuk ikut berdiskusi</h3>
                <p class="text-sm text-gray-400 mb-4">Silakan login untuk memberikan balasan atau pertanyaan</p>
                <a href="{{ route('login') }}"
                    class="inline-block px-5 py-2 bg-primary text-white font-medium rounded-xl hover:bg-primary/90 transition text-sm">Login
                    Sekarang</a>
            </div>
        @endauth

        <!-- Related Threads -->
        @if ($relatedThreads && $relatedThreads->count() > 0)
            <div class="pt-6 border-t border-gray-100">
                <h3 class="font-semibold text-gray-900 mb-5">Diskusi Terkait</h3>
                <div class="space-y-3">
                    @foreach ($relatedThreads as $related)
                        <a href="{{ route('forum.show', $related->slug) }}"
                            class="block bg-white rounded-xl p-4 border border-gray-100 hover:border-gray-200 hover:shadow-sm transition-all duration-200 group">
                            <div class="flex items-start justify-between gap-3">
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2 mb-1.5">
                                        <span
                                            class="px-2 py-0.5 rounded-full text-xs font-medium {{ $categoryColors[$related->category?->color] ?? 'bg-gray-100 text-gray-700' }}">
                                            {{ $related->category?->name ?? 'Umum' }}
                                        </span>
                                        <span
                                            class="text-xs text-gray-400">{{ $related->created_at->diffForHumans() }}</span>
                                    </div>
                                    <h4
                                        class="font-medium text-gray-800 group-hover:text-primary transition line-clamp-1 text-sm">
                                        {{ $related->title }}
                                    </h4>
                                    <div class="flex items-center gap-3 mt-1.5 text-xs text-gray-400">
                                        <span class="flex items-center gap-1">
                                            <i class="far fa-comment text-xs"></i>
                                            {{ number_format($related->replies_count) }}
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <i class="fas fa-eye text-xs"></i> {{ number_format($related->views_count) }}
                                        </span>
                                    </div>
                                </div>
                                <i
                                    class="fas fa-chevron-right text-gray-300 text-xs group-hover:text-primary group-hover:translate-x-0.5 transition-all"></i>
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
                animation: fadeIn 0.4s ease-out;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(12px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .markdown-body {
                line-height: 1.6;
                color: #374151;
            }

            .markdown-body p {
                margin-bottom: 1rem;
            }

            .markdown-body p:last-child {
                margin-bottom: 0;
            }

            .markdown-body h1,
            .markdown-body h2,
            .markdown-body h3,
            .markdown-body h4 {
                color: #1f2937;
                font-weight: 600;
                margin-top: 1.25rem;
                margin-bottom: 0.75rem;
            }

            .markdown-body h1 {
                font-size: 1.5rem;
            }

            .markdown-body h2 {
                font-size: 1.25rem;
            }

            .markdown-body h3 {
                font-size: 1.125rem;
            }

            .markdown-body ul,
            .markdown-body ol {
                margin: 0.75rem 0;
                padding-left: 1.5rem;
            }

            .markdown-body li {
                margin-bottom: 0.25rem;
            }

            .markdown-body code:not(pre code) {
                background-color: #f3f4f6;
                padding: 0.125rem 0.375rem;
                border-radius: 0.375rem;
                font-size: 0.8125rem;
                color: #dc2626;
                font-family: 'SF Mono', Monaco, 'Cascadia Code', monospace;
            }

            .markdown-body pre {
                background-color: #1e293b;
                color: #e2e8f0;
                padding: 1rem;
                border-radius: 0.75rem;
                overflow-x: auto;
                margin: 1rem 0;
                font-size: 0.8125rem;
                line-height: 1.5;
            }

            .markdown-body pre code {
                background-color: transparent;
                color: inherit;
                padding: 0;
                font-size: inherit;
            }

            .markdown-body blockquote {
                border-left: 3px solid #e5e7eb;
                padding-left: 1rem;
                margin: 1rem 0;
                color: #6b7280;
                font-style: italic;
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
            // Upvote functionality
            const upvoteBtns = document.querySelectorAll('.upvote-btn, .reply-upvote');
            upvoteBtns.forEach(btn => {
                btn.addEventListener('click', async function(e) {
                    e.preventDefault();
                    if (this.disabled) return;
                    const isThread = this.classList.contains('upvote-btn') && this.dataset.type ===
                        'thread';
                    const id = this.dataset.threadId || this.dataset.replyId;
                    const type = isThread ? 'thread' : 'reply';
                    const countSpan = this.querySelector('.upvote-count');
                    const originalText = countSpan?.innerText;
                    this.disabled = true;
                    if (countSpan) countSpan.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
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
                            if (countSpan) countSpan.textContent = data.count.toLocaleString();
                            this.classList.add('bg-primary/10', 'text-primary');
                            setTimeout(() => this.classList.remove('bg-primary/10'), 200);
                        } else if (data.message === 'already_voted') {
                            if (countSpan) countSpan.textContent = originalText;
                            this.classList.add('bg-red-50');
                            setTimeout(() => this.classList.remove('bg-red-50'), 200);
                        }
                    } catch (error) {
                        console.error('Error upvoting:', error);
                        if (countSpan) countSpan.textContent = originalText;
                        this.classList.add('bg-red-50');
                        setTimeout(() => this.classList.remove('bg-red-50'), 200);
                    } finally {
                        this.disabled = false;
                    }
                });
            });

            // Reply sorting
            const sortBtns = document.querySelectorAll('.reply-sort-btn');
            sortBtns.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const sort = this.dataset.sort;
                    const url = new URL(window.location.href);
                    url.searchParams.set('sort', sort);
                    window.location.href = url.toString();
                });
            });
        </script>
    @endpush

@endsection
