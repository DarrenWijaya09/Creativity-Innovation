@php
    $otherUser = $conversation->buyer_id == auth()->id() ? $conversation->seller : $conversation->buyer;
    $service = $conversation->service;
@endphp

<div class="flex-1 flex flex-col bg-white">

    <!-- Chat Header -->
    <div class="p-4 border-b border-gray-100 sticky top-0 bg-white z-10">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3 min-w-0">
                <!-- Back Button Mobile -->
                <button id="backToInbox" class="lg:hidden text-gray-500 hover:text-primary transition">
                    <i class="fas fa-arrow-left text-lg"></i>
                </button>

                <!-- Avatar -->
                <div class="flex-shrink-0 group">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center text-gray-600 font-semibold text-sm overflow-hidden">
                        @if ($otherUser->avatar)
                            @if (filter_var($otherUser->avatar, FILTER_VALIDATE_URL))
                                <img src="{{ $otherUser->avatar }}" class="w-full h-full object-cover">
                            @else
                                <img src="{{ asset('storage/' . $otherUser->avatar) }}" class="w-full h-full object-cover">
                            @endif
                        @else
                            {{ strtoupper(substr($otherUser->name ?? 'U', 0, 2)) }}
                        @endif
                    </div>
                </div>

                <!-- User Info -->
                <div class="min-w-0 flex-1">
                    <div class="flex items-center gap-1">
                        <span class="font-semibold text-gray-900 truncate">
                            {{ $otherUser->name ?? 'Pengguna' }}
                        </span>
                        @if (optional($conversation->seller)->is_verified && $conversation->seller_id == $otherUser->id)
                            <i class="fas fa-check-circle text-primary text-xs flex-shrink-0"></i>
                        @endif
                    </div>
                    <p class="text-xs text-gray-400">
                        @if ($conversation->seller_id == $otherUser->id)
                            Penyedia Jasa
                        @else
                            Pembeli
                        @endif
                    </p>
                </div>
            </div>

            <!-- Service Link -->
            @if ($service)
                <a href="{{ route('catalog.show', $service->slug) }}"
                    class="text-primary text-sm hover:underline flex-shrink-0 hidden sm:inline-flex items-center gap-1">
                    <i class="fas fa-external-link-alt text-xs"></i>
                    Lihat Jasa
                </a>
            @endif
        </div>
    </div>

    <!-- Messages Container -->
    <div class="flex-1 overflow-y-auto p-4 space-y-4" id="messagesContainer" style="height: calc(100vh - 420px);">
        @forelse($messages as $message)
            @include('pages.chat.partials.message-bubble', ['message' => $message])
        @empty
            <div class="flex items-center justify-center h-full">
                <div class="text-center py-8">
                    <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-comment-dots text-gray-300 text-lg"></i>
                    </div>
                    <p class="text-gray-500 text-sm">Belum ada pesan</p>
                    <p class="text-gray-400 text-xs mt-1">Mulai percakapan dengan penyedia jasa</p>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Message Input -->
    <div class="p-4 border-t border-gray-100 bg-white">
        <form action="#" method="POST" class="relative" id="messageForm">
            @csrf
            <div class="flex items-end gap-2">
                <div class="flex-1 relative">
                    <textarea name="message" rows="1" placeholder="Tulis pesan Anda..."
                        class="w-full px-4 py-2.5 pr-12 border border-gray-200 rounded-xl resize-none focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-transparent text-sm"
                        style="min-height: 44px; max-height: 120px;" id="messageInput"></textarea>
                </div>
                <button type="submit"
                    class="flex-shrink-0 w-10 h-10 bg-primary text-white rounded-xl hover:bg-primary/90 transition shadow-sm flex items-center justify-center">
                    <i class="fas fa-paper-plane text-sm"></i>
                </button>
            </div>
        </form>
        <p class="text-xs text-gray-400 mt-2 text-center">
            <i class="fas fa-lock text-xs"></i> Pesan terenkripsi dan aman
        </p>
    </div>

</div>

@push('scripts')
    <script>
        // Auto-scroll to bottom
        const container = document.getElementById('messagesContainer');
        if (container) {
            container.scrollTop = container.scrollHeight;
        }

        // Auto-resize textarea
        const messageInput = document.getElementById('messageInput');
        if (messageInput) {
            messageInput.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = Math.min(this.scrollHeight, 120) + 'px';
            });
        }

        // Send message on Enter (Shift+Enter for new line)
        if (messageInput) {
            messageInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    document.getElementById('messageForm').submit();
                }
            });
        }

        // Back button mobile
        const backBtn = document.getElementById('backToInbox');
        if (backBtn) {
            backBtn.addEventListener('click', () => {
                window.location.href = '{{ route('chat.index') }}';
            });
        }

        // Polling for new messages (every 5 seconds)
        let lastMessageId = {{ $messages->isNotEmpty() ? $messages->first()->id : 0 }};
        const conversationId = {{ $conversation->id }};

        setInterval(() => {
            fetch(`/chat/${conversationId}/messages?last_id=${lastMessageId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.messages && data.messages.length > 0) {
                        const container = document.getElementById('messagesContainer');
                        const wasAtBottom = container.scrollHeight - container.scrollTop <= container
                            .clientHeight + 100;

                        data.messages.forEach(msg => {
                            const isOwn = msg.sender_id === {{ auth()->id() }};
                            const bubble = `
                            <div class="flex ${isOwn ? 'justify-end' : 'justify-start'}">
                                <div class="max-w-[70%]">
                                    <div class="rounded-2xl px-4 py-2.5 ${isOwn ? 'bg-primary text-white' : 'bg-gray-100 text-gray-800'}">
                                        <p class="text-sm leading-relaxed">${escapeHtml(msg.message)}</p>
                                    </div>
                                    <p class="text-xs text-gray-400 mt-1 ${isOwn ? 'text-right' : 'text-left'}">
                                        ${new Date(msg.created_at).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' })}
                                    </p>
                                </div>
                            </div>
                        `;
                            container.insertAdjacentHTML('beforeend', bubble);
                            lastMessageId = Math.max(lastMessageId, msg.id);
                        });

                        if (wasAtBottom) {
                            container.scrollTop = container.scrollHeight;
                        }
                    }
                })
                .catch(err => console.error('Polling error:', err));
        }, 5000);

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }
    </script>
@endpush
