@props([
    'seller' => null,
    'service' => null,
    'isOpen' => false,
    'conversationId' => null,
])

<div x-data="chatDrawer()" x-init="init()" x-effect="handleDrawerState()" x-cloak>

    <!-- Overlay -->
    <div x-show="isDrawerOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/40 backdrop-blur-sm z-40" @click="closeDrawer()">
    </div>

    <!-- Drawer Container -->
    <div x-show="isDrawerOpen" x-transition:enter="transform transition ease-out duration-300"
        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transform transition ease-in duration-300" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="fixed top-0 right-0 h-full bg-white dark:bg-gray-950 shadow-2xl z-50 flex flex-col"
        :class="isMobile ? 'w-full' : 'w-[420px]'">

        <!-- Header (Sticky) -->
        <div class="sticky top-0 bg-white dark:bg-gray-950 border-b border-gray-100 dark:border-slate-700 z-10">
            <div class="p-4">
                <div class="flex items-center justify-between mb-3">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Chat dengan Seller</h2>
                    <button @click="closeDrawer()"
                        class="w-8 h-8 rounded-full bg-gray-50 dark:bg-slate-800 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-slate-700 transition flex items-center justify-center">
                        <i class="fas fa-times text-sm"></i>
                    </button>
                </div>

                <!-- Seller Info -->
                <div class="flex items-center gap-3">
                    <div class="relative flex-shrink-0">
                        <div
                            class="w-12 h-12 rounded-full bg-gradient-to-br from-primary/10 to-blue-100 dark:from-primary/20 dark:to-blue-900/30 flex items-center justify-center text-primary font-semibold text-sm overflow-hidden">
                            @if ($seller && $seller->avatar)
                                <img src="{{ filter_var($seller->avatar, FILTER_VALIDATE_URL) ? $seller->avatar : asset('storage/' . $seller->avatar) }}"
                                    class="w-full h-full object-cover">
                            @else
                                {{ strtoupper(substr($seller->name ?? 'S', 0, 2)) }}
                            @endif
                        </div>
                        <div
                            class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white dark:border-gray-950">
                        </div>
                    </div>

                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2">
                            <h3 class="font-semibold text-gray-900 dark:text-white truncate">
                                {{ $seller->name ?? 'Seller' }}
                            </h3>
                            @if ($seller && $seller->is_verified)
                                <i class="fas fa-check-circle text-primary text-xs flex-shrink-0"></i>
                            @endif
                        </div>
                        <p class="text-xs text-green-600 dark:text-green-400 mt-0.5">
                            <i class="fas fa-circle text-[6px] mr-1 align-middle"></i>
                            Online
                        </p>
                    </div>

                    <a href="" class="text-primary text-xs font-medium hover:underline whitespace-nowrap">
                        Lihat Profil
                    </a>
                </div>
            </div>
        </div>

        <!-- Service Information Card -->
        @if ($service)
            <div
                class="mx-4 mt-4 p-3 bg-primary/5 dark:bg-primary/10 rounded-xl border border-primary/10 dark:border-primary/20">
                <div class="flex gap-3">
                    @if ($service->image)
                        <img src="{{ filter_var($service->image, FILTER_VALIDATE_URL) ? $service->image : asset('storage/' . $service->image) }}"
                            alt="{{ $service->title }}" class="w-12 h-12 rounded-lg object-cover flex-shrink-0">
                    @else
                        <img src="https://placehold.co/48x48/png?text=No+Image" alt="No Image"
                            class="w-12 h-12 rounded-lg object-cover flex-shrink-0">
                    @endif
                    <div class="flex-1 min-w-0">
                        <h4 class="font-semibold text-sm text-gray-900 dark:text-white line-clamp-1">
                            {{ $service->title }}
                        </h4>
                        <div class="flex items-center gap-2 mt-1">
                            <div class="flex items-center gap-0.5">
                                <i class="fas fa-star text-yellow-400 text-xs"></i>
                                <span
                                    class="text-xs font-semibold text-gray-800 dark:text-gray-200">{{ number_format($service->rating ?? 0, 1) }}</span>
                            </div>
                            <span
                                class="text-xs text-gray-400 dark:text-gray-500">({{ number_format($service->reviews_count ?? 0) }}
                                ulasan)</span>
                        </div>
                        <div class="text-sm font-bold text-primary mt-1">
                            Rp{{ number_format($service->price ?? 0, 0, ',', '.') }}
                        </div>
                    </div>
                    <a href="{{ route('catalog.show', $service->slug) }}"
                        class="flex-shrink-0 text-primary text-xs hover:underline">
                        Detail
                    </a>
                </div>
            </div>
        @endif

        <!-- Messages Area (Scrollable) -->
        <div class="flex-1 overflow-y-auto p-4 space-y-3" id="chatMessagesArea" x-ref="messagesArea">
            <template x-for="message in messages" :key="message.id">
                <div :class="message.isOwn ? 'flex justify-end' : 'flex justify-start'">
                    <div :class="message.isOwn ? 'max-w-[75%]' : 'max-w-[75%]'">
                        <div :class="message.isOwn ? 'bg-primary text-white rounded-2xl rounded-br-md' :
                            'bg-gray-100 dark:bg-slate-800 text-gray-900 dark:text-white rounded-2xl rounded-bl-md'"
                            class="px-4 py-2.5">
                            <p class="text-sm leading-relaxed break-words" x-text="message.content"></p>
                        </div>
                        <p :class="message.isOwn ? 'text-right' : 'text-left'"
                            class="text-xs text-gray-400 dark:text-gray-500 mt-1"
                            x-text="formatTime(message.created_at)"></p>
                    </div>
                </div>
            </template>

            <!-- Empty State -->
            <div x-show="messages.length === 0 && !isLoading"
                class="flex items-center justify-center h-full min-h-[300px]">
                <div class="text-center py-8">
                    <div
                        class="w-16 h-16 bg-gray-100 dark:bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-comment-dots text-gray-300 dark:text-gray-600 text-2xl"></i>
                    </div>
                    <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-2">Mulai Percakapan</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 max-w-[250px] mx-auto">
                        Ajukan pertanyaan mengenai layanan ini sebelum melakukan pemesanan.
                    </p>
                </div>
            </div>

            <!-- Loading State -->
            <div x-show="isLoading" class="flex items-center justify-center h-full min-h-[300px]">
                <div class="text-center">
                    <i class="fas fa-spinner fa-spin text-primary text-2xl"></i>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-3">Memuat pesan...</p>
                </div>
            </div>
        </div>

        <!-- Message Input Area (Sticky Bottom) -->
        <div class="sticky bottom-0 bg-white dark:bg-gray-950 border-t border-gray-100 dark:border-slate-700 p-4">
            <form @submit.prevent="sendMessage" class="relative">
                <div class="flex items-end gap-2">
                    <div class="flex-1 relative">
                        <textarea x-model="newMessage" @keydown.enter.prevent="if(!$event.shiftKey) sendMessage()" rows="1"
                            placeholder="Tulis pesan..."
                            class="w-full px-4 py-2.5 pr-12 border border-gray-200 dark:border-slate-700 rounded-xl resize-none focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-transparent text-sm dark:bg-slate-900 dark:text-white dark:placeholder-gray-500"
                            style="min-height: 44px; max-height: 120px" x-ref="messageInput"></textarea>
                    </div>
                    <button type="submit" :disabled="isSending || !newMessage.trim()"
                        class="flex-shrink-0 w-10 h-10 bg-primary text-white rounded-xl hover:bg-primary/90 transition shadow-sm flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed">
                        <i class="fas fa-paper-plane text-sm" :class="{ 'fa-spin': isSending }"></i>
                    </button>
                </div>
            </form>
            <p class="text-xs text-gray-400 dark:text-gray-500 mt-3 text-center">
                <i class="fas fa-lock text-xs"></i> Pesan terenkripsi dan aman
            </p>
        </div>
    </div>
</div>

@push('styles')
    <style>
        [x-cloak] {
            display: none !important;
        }

        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Custom scrollbar for messages area */
        #chatMessagesArea::-webkit-scrollbar {
            width: 6px;
        }

        #chatMessagesArea::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        #chatMessagesArea::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        #chatMessagesArea::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .dark #chatMessagesArea::-webkit-scrollbar-track {
            background: #1e293b;
        }

        .dark #chatMessagesArea::-webkit-scrollbar-thumb {
            background: #475569;
        }

        .dark #chatMessagesArea::-webkit-scrollbar-thumb:hover {
            background: #64748b;
        }
    </style>
@endpush

@push('scripts')
    <script>
        function chatDrawer() {
            return {
                isDrawerOpen: false,
                isMobile: false,
                conversationId: null,
                messages: [],
                newMessage: '',
                isSending: false,
                isLoading: false,
                pollingInterval: null,
                lastMessageId: 0,

                init() {
                    this.checkMobile();
                    window.addEventListener('resize', () => this.checkMobile());

                    // Listen for open drawer event
                    window.addEventListener('open-chat-drawer', (event) => {
                        console.log('[ChatDrawer] Event received:', event.detail);

                        this.conversationId = event.detail?.conversationId || null;
                        this.openDrawer();

                        if (this.conversationId) {
                            console.log('[ChatDrawer] Loading messages for conversation:', this.conversationId);
                            this.loadMessages();
                            this.startPolling();
                        } else {
                            console.warn('[ChatDrawer] No conversationId provided');
                        }
                    });
                },

                handleDrawerState() {
                    if (this.isDrawerOpen) {
                        document.body.style.overflow = 'hidden';
                    } else {
                        document.body.style.overflow = '';
                        if (this.pollingInterval) {
                            console.log('[ChatDrawer] Stopping polling');
                            clearInterval(this.pollingInterval);
                            this.pollingInterval = null;
                        }
                    }
                },

                checkMobile() {
                    this.isMobile = window.innerWidth < 768;
                },

                openDrawer() {
                    this.isDrawerOpen = true;
                    setTimeout(() => {
                        this.$refs.messageInput?.focus();
                    }, 300);
                },

                closeDrawer() {
                    this.isDrawerOpen = false;
                },

                async loadMessages() {
                    if (!this.conversationId) {
                        console.error('[ChatDrawer] Cannot load messages: no conversationId');
                        return;
                    }

                    this.isLoading = true;

                    try {
                        const response = await fetch(`/chat/${this.conversationId}/messages`, {
                            method: 'GET',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });

                        if (!response.ok) {
                            throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                        }

                        const data = await response.json();
                        console.log('[ChatDrawer] Messages loaded:', data);

                        if (data.success && data.messages) {
                            const currentUserId = {{ auth()->id() }};

                            this.messages = data.messages.map(msg => ({
                                id: msg.id,
                                content: msg.message,
                                isOwn: msg.sender_id === currentUserId,
                                created_at: msg.created_at
                            }));

                            if (this.messages.length > 0) {
                                this.lastMessageId = Math.max(...this.messages.map(m => m.id));
                                console.log('[ChatDrawer] Last message ID:', this.lastMessageId);
                            }

                            this.scrollToBottom();
                        } else {
                            console.error('[ChatDrawer] Failed to load messages:', data.message);
                        }
                    } catch (error) {
                        console.error('[ChatDrawer] loadMessages error:', error);
                    } finally {
                        this.isLoading = false;
                    }
                },

                async sendMessage() {
                    if (!this.newMessage.trim() || this.isSending) {
                        console.warn('[ChatDrawer] Cannot send: empty message or already sending');
                        return;
                    }

                    if (!this.conversationId) {
                        console.error('[ChatDrawer] Cannot send: no conversationId');
                        alert('Percakapan tidak valid. Silakan refresh halaman.');
                        return;
                    }

                    this.isSending = true;
                    const messageContent = this.newMessage.trim();

                    // Optimistic update
                    const tempMessage = {
                        id: Date.now(),
                        content: messageContent,
                        isOwn: true,
                        created_at: new Date().toISOString(),
                        temp: true
                    };
                    this.messages.push(tempMessage);
                    this.newMessage = '';
                    this.scrollToBottom();

                    try {
                        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                        const response = await fetch(`/chat/${this.conversationId}/messages`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': csrfToken || '{{ csrf_token() }}',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: JSON.stringify({
                                message: messageContent
                            })
                        });

                        if (!response.ok) {
                            throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                        }

                        const data = await response.json();
                        console.log('[ChatDrawer] Message sent:', data);

                        if (data.success && data.message) {
                            // Replace temp message with real one
                            const index = this.messages.findIndex(m => m.id === tempMessage.id);
                            if (index !== -1) {
                                const currentUserId = {{ auth()->id() }};
                                this.messages[index] = {
                                    id: data.message.id,
                                    content: data.message.message,
                                    isOwn: data.message.sender_id === currentUserId,
                                    created_at: data.message.created_at
                                };
                            }
                            this.lastMessageId = Math.max(this.lastMessageId, data.message.id);
                            console.log('[ChatDrawer] Message saved, lastMessageId updated:', this.lastMessageId);
                        } else {
                            // Remove temp message on error
                            console.error('[ChatDrawer] Failed to send message:', data.message);
                            this.messages = this.messages.filter(m => m.id !== tempMessage.id);
                            alert(data.message || 'Gagal mengirim pesan. Silakan coba lagi.');
                        }
                    } catch (error) {
                        console.error('[ChatDrawer] sendMessage error:', error);
                        this.messages = this.messages.filter(m => m.id !== tempMessage.id);
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    } finally {
                        this.isSending = false;
                        this.scrollToBottom();
                    }
                },

                async pollNewMessages() {
                    if (!this.conversationId || !this.isDrawerOpen) {
                        return;
                    }

                    try {
                        const response = await fetch(`/chat/${this.conversationId}/messages?last_id=${this.lastMessageId}`, {
                            method: 'GET',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });

                        if (!response.ok) {
                            throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                        }

                        const data = await response.json();

                        if (data.success && data.messages && data.messages.length > 0) {
                            console.log('[ChatDrawer] New messages received:', data.messages.length);

                            const wasAtBottom = this.isScrolledToBottom();
                            const currentUserId = {{ auth()->id() }};

                            data.messages.forEach(msg => {
                                if (msg.id > this.lastMessageId) {
                                    this.messages.push({
                                        id: msg.id,
                                        content: msg.message,
                                        isOwn: msg.sender_id === currentUserId,
                                        created_at: msg.created_at
                                    });
                                    this.lastMessageId = Math.max(this.lastMessageId, msg.id);
                                }
                            });

                            console.log('[ChatDrawer] Polling completed, lastMessageId:', this.lastMessageId);

                            if (wasAtBottom) {
                                this.scrollToBottom();
                            }
                        }
                    } catch (error) {
                        console.error('[ChatDrawer] pollNewMessages error:', error);
                    }
                },

                startPolling() {
                    if (this.pollingInterval) {
                        clearInterval(this.pollingInterval);
                    }
                    console.log('[ChatDrawer] Starting polling every 5 seconds');
                    this.pollingInterval = setInterval(() => this.pollNewMessages(), 5000);
                },

                scrollToBottom() {
                    setTimeout(() => {
                        if (this.$refs.messagesArea) {
                            this.$refs.messagesArea.scrollTop = this.$refs.messagesArea.scrollHeight;
                        }
                    }, 100);
                },

                isScrolledToBottom() {
                    if (!this.$refs.messagesArea) return true;
                    const element = this.$refs.messagesArea;
                    return element.scrollHeight - element.scrollTop <= element.clientHeight + 100;
                },

                formatTime(dateString) {
                    if (!dateString) return '';
                    const date = new Date(dateString);
                    const now = new Date();
                    const diffMs = now - date;
                    const diffMins = Math.floor(diffMs / 60000);
                    const diffHours = Math.floor(diffMs / 3600000);
                    const diffDays = Math.floor(diffMs / 86400000);

                    if (diffMins < 1) return 'Baru saja';
                    if (diffMins < 60) return `${diffMins} menit lalu`;
                    if (diffHours < 24) return `${diffHours} jam lalu`;
                    if (diffDays === 1) return 'Kemarin';
                    if (diffDays < 7) return `${diffDays} hari lalu`;

                    return date.toLocaleDateString('id-ID', {
                        day: 'numeric',
                        month: 'short'
                    });
                }
            }
        }
    </script>
@endpush
