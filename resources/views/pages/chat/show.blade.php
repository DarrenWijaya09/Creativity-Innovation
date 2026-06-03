@php
    $otherUser = $conversation->buyer_id == auth()->id() ? $conversation->seller : $conversation->buyer;
    $service = $conversation->service;
@endphp

<div class="flex-1 flex flex-col bg-white dark:bg-gray-950" id="chatPanel">

    <!-- Chat Header -->
    <div class="p-4 border-b border-gray-100 dark:border-slate-700 sticky top-0 bg-white dark:bg-gray-950 z-10"
        id="chatHeader">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3 min-w-0">
                <!-- Back Button Mobile -->
                <button id="backToInbox" class="lg:hidden text-gray-500 dark:text-gray-400 hover:text-primary transition">
                    <i class="fas fa-arrow-left text-lg"></i>
                </button>

                <!-- Avatar -->
                <div class="flex-shrink-0 group">
                    <div id="chatAvatar"
                        class="w-10 h-10 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 dark:from-slate-700 dark:to-slate-600 flex items-center justify-center text-gray-600 dark:text-gray-300 font-semibold text-sm overflow-hidden">
                        @if ($otherUser->avatar)
                            @if (filter_var($otherUser->avatar, FILTER_VALIDATE_URL))
                                <img src="{{ $otherUser->avatar }}" class="w-full h-full object-cover"
                                    alt="{{ $otherUser->name }}">
                            @else
                                <img src="{{ asset('storage/' . $otherUser->avatar) }}"
                                    class="w-full h-full object-cover" alt="{{ $otherUser->name }}">
                            @endif
                        @else
                            {{ strtoupper(substr($otherUser->name ?? 'U', 0, 2)) }}
                        @endif
                    </div>
                </div>

                <!-- User Info -->
                <div class="min-w-0 flex-1">
                    <div class="flex items-center gap-1" id="chatUserNameContainer">
                        <span id="chatUserName" class="font-semibold text-gray-900 dark:text-white truncate">
                            {{ $otherUser->name ?? 'Pengguna' }}
                        </span>
                        @if (optional($conversation->seller)->is_verified && $conversation->seller_id == $otherUser->id)
                            <i id="chatVerifiedBadge"
                                class="fas fa-check-circle text-primary text-xs flex-shrink-0"></i>
                        @endif
                    </div>
                    <p id="chatUserRole" class="text-xs text-gray-400 dark:text-gray-500">
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
                <a id="chatServiceLink" href="{{ route('catalog.show', $service->slug) }}"
                    class="text-primary text-sm hover:underline flex-shrink-0 hidden sm:inline-flex items-center gap-1">
                    <i class="fas fa-external-link-alt text-xs"></i>
                    Lihat Jasa
                </a>
            @else
                <div id="chatServiceLinkPlaceholder" class="hidden"></div>
            @endif
        </div>
    </div>

    <!-- Messages Container -->
    <div class="flex-1 overflow-y-auto p-4 space-y-4" id="messagesContainer" style="height: calc(100vh - 420px);">
        @forelse($messages as $message)
            @include('pages.chat.partials.message-bubble', ['message' => $message])
        @empty
            <div id="emptyState" class="flex items-center justify-center h-full">
                <div class="text-center py-8">
                    <div
                        class="w-12 h-12 bg-gray-100 dark:bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-comment-dots text-gray-300 dark:text-gray-600 text-lg"></i>
                    </div>
                    <p class="text-gray-500 dark:text-gray-400 text-sm">Belum ada pesan</p>
                    <p class="text-gray-400 dark:text-gray-500 text-xs mt-1">Mulai percakapan dengan penyedia jasa</p>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Message Input -->
    <div class="p-4 border-t border-gray-100 dark:border-slate-700 bg-white dark:bg-gray-950">
        <form id="messageForm" class="relative">
            @csrf
            <div class="flex items-end gap-2">
                <div class="flex-1 relative">
                    <textarea name="message" rows="1" placeholder="Tulis pesan Anda..."
                        class="w-full px-4 py-2.5 pr-12 border border-gray-200 dark:border-slate-700 rounded-xl resize-none focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-transparent text-sm dark:bg-slate-900 dark:text-white dark:placeholder-gray-500"
                        style="min-height: 44px; max-height: 120px;" id="messageInput"></textarea>
                </div>
                <button type="submit" id="sendMessageBtn"
                    class="flex-shrink-0 w-10 h-10 bg-primary text-white rounded-xl hover:bg-primary/90 transition shadow-sm flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed">
                    <i id="sendIcon" class="fas fa-paper-plane text-sm"></i>
                    <i id="loadingSpinner" class="fas fa-spinner fa-spin text-sm hidden"></i>
                </button>
            </div>
        </form>
        <p class="text-xs text-gray-400 dark:text-gray-500 mt-2 text-center">
            <i class="fas fa-lock text-xs"></i> Pesan terenkripsi dan aman
        </p>
    </div>

</div>

@push('scripts')
    <script>
        // ==================== DOM ELEMENTS ====================
        let container = document.getElementById('messagesContainer');
        let messageInput = document.getElementById('messageInput');
        let messageForm = document.getElementById('messageForm');
        let sendButton = document.getElementById('sendMessageBtn');
        let sendIcon = document.getElementById('sendIcon');
        let loadingSpinner = document.getElementById('loadingSpinner');
        let emptyState = document.getElementById('emptyState');

        // ==================== STATE VARIABLES ====================
        let lastMessageId = {{ $messages->isNotEmpty() ? $messages->last()->id : 0 }};
        let conversationId = {{ $conversation->id }};
        let currentUserId = {{ auth()->id() }};
        let pollingInterval = null;
        let isSending = false;
        let isOnline = navigator.onLine;
        let hasMarkedAsRead = false;

        // ==================== HELPER FUNCTIONS ====================

        // Scroll to bottom of messages container
        function scrollToBottom() {
            if (container) {
                container.scrollTop = container.scrollHeight;
            }
        }

        // Check if user is scrolled to bottom
        function isScrolledToBottom() {
            if (!container) return true;
            return container.scrollHeight - container.scrollTop <= container.clientHeight + 100;
        }

        // Escape HTML to prevent XSS
        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        // Format timestamp
        function formatTime(dateString) {
            const date = new Date(dateString);
            return date.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        // Remove empty state if exists
        function removeEmptyState() {
            const emptyStateDiv = document.getElementById('emptyState');
            if (emptyStateDiv && container?.contains(emptyStateDiv)) {
                emptyStateDiv.remove();
            }
        }

        // ==================== UPDATE CHAT PANEL HEADER ====================
        function updateChatHeader(conversationData) {
            // Update avatar
            const avatarDiv = document.getElementById('chatAvatar');
            if (avatarDiv) {
                if (conversationData.seller_avatar) {
                    avatarDiv.innerHTML =
                        `<img src="${conversationData.seller_avatar}" class="w-full h-full object-cover" alt="${escapeHtml(conversationData.seller_name)}">`;
                } else {
                    avatarDiv.innerHTML = escapeHtml((conversationData.seller_name || 'U').substring(0, 2).toUpperCase());
                }
            }

            // Update user name
            const userNameSpan = document.getElementById('chatUserName');
            if (userNameSpan) {
                userNameSpan.textContent = conversationData.seller_name || 'Pengguna';
            }

            // Update verified badge
            const verifiedBadge = document.getElementById('chatVerifiedBadge');
            if (verifiedBadge) {
                if (conversationData.seller_verified) {
                    verifiedBadge.style.display = 'inline-block';
                } else {
                    verifiedBadge.style.display = 'none';
                }
            }

            // Update user role
            const userRoleSpan = document.getElementById('chatUserRole');
            if (userRoleSpan) {
                userRoleSpan.textContent = conversationData.user_role === 'seller' ? 'Penyedia Jasa' : 'Pembeli';
            }

            // Update service link
            const serviceLink = document.getElementById('chatServiceLink');
            if (serviceLink && conversationData.service_slug) {
                serviceLink.href = `/catalog/${conversationData.service_slug}`;
                serviceLink.classList.remove('hidden');
            } else if (serviceLink) {
                serviceLink.classList.add('hidden');
            }
        }

        // ==================== MARK AS READ ====================
        async function markAsRead() {
            if (hasMarkedAsRead) return;

            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ||
                    document.querySelector('input[name="_token"]')?.value;

                const response = await fetch(`/chat/${conversationId}/read`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (response.ok) {
                    hasMarkedAsRead = true;
                    console.log('[Chat] Marked as read successfully');
                }
            } catch (error) {
                console.error('[Chat] Mark as read failed:', error);
            }
        }

        // ==================== ADD MESSAGE BUBBLE ====================
        function addMessageBubble(message, isOwn) {
            removeEmptyState();

            const timeString = formatTime(message.created_at);
            const bubbleHtml = `
            <div class="flex ${isOwn ? 'justify-end' : 'justify-start'} message-bubble" data-message-id="${message.id}">
                <div class="max-w-[70%]">
                    <div class="rounded-2xl px-4 py-2.5 ${isOwn ? 'bg-primary text-white rounded-br-md' : 'bg-gray-100 dark:bg-slate-800 text-gray-800 dark:text-gray-200 rounded-bl-md'}">
                        <p class="text-sm leading-relaxed">${escapeHtml(message.message)}</p>
                    </div>
                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-1 ${isOwn ? 'text-right' : 'text-left'}">
                        ${timeString}
                    </p>
                </div>
            </div>
        `;

            container.insertAdjacentHTML('beforeend', bubbleHtml);
        }

        // ==================== LOAD MESSAGES ====================
        async function loadMessages() {
            try {
                const response = await fetch(`/chat/${conversationId}/messages`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (!response.ok) throw new Error('Failed to load messages');

                const data = await response.json();

                if (data.success && data.messages) {
                    // Clear container but preserve empty state
                    while (container.firstChild) {
                        container.removeChild(container.firstChild);
                    }

                    if (data.messages.length === 0) {
                        // Show empty state
                        const emptyStateHtml = `
                        <div id="emptyState" class="flex items-center justify-center h-full">
                            <div class="text-center py-8">
                                <div class="w-12 h-12 bg-gray-100 dark:bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <i class="fas fa-comment-dots text-gray-300 dark:text-gray-600 text-lg"></i>
                                </div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm">Belum ada pesan</p>
                                <p class="text-gray-400 dark:text-gray-500 text-xs mt-1">Mulai percakapan dengan penyedia jasa</p>
                            </div>
                        </div>
                    `;
                        container.insertAdjacentHTML('beforeend', emptyStateHtml);
                        emptyState = document.getElementById('emptyState');
                        lastMessageId = 0;
                    } else {
                        data.messages.forEach(msg => {
                            const isOwn = msg.sender_id === currentUserId;
                            addMessageBubble(msg, isOwn);
                        });
                        lastMessageId = Math.max(...data.messages.map(m => m.id));
                        scrollToBottom();
                    }
                }
            } catch (error) {
                console.error('[Chat] Load messages failed:', error);
            }
        }

        // ==================== SEND MESSAGE ====================
        async function sendMessage(messageContent) {
            if (!messageContent.trim() || isSending) return false;

            isSending = true;
            sendButton.disabled = true;
            sendIcon.classList.add('hidden');
            loadingSpinner.classList.remove('hidden');

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ||
                document.querySelector('input[name="_token"]')?.value;

            try {
                const response = await fetch(`/chat/${conversationId}/messages`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        message: messageContent
                    })
                });

                if (!response.ok) throw new Error(`HTTP ${response.status}`);

                const data = await response.json();

                if (data.success && data.message) {
                    addMessageBubble(data.message, true);
                    lastMessageId = Math.max(lastMessageId, data.message.id);
                    scrollToBottom();
                    return true;
                } else {
                    throw new Error(data.message || 'Failed to send message');
                }
            } catch (error) {
                console.error('[Chat] Send message failed:', error);
                alert('Gagal mengirim pesan. Silakan coba lagi.');
                return false;
            } finally {
                isSending = false;
                sendButton.disabled = false;
                sendIcon.classList.remove('hidden');
                loadingSpinner.classList.add('hidden');
            }
        }

        // ==================== POLL NEW MESSAGES ====================
        async function pollNewMessages() {
            if (!isOnline) return;

            try {
                const response = await fetch(`/chat/${conversationId}/messages?last_id=${lastMessageId}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (!response.ok) throw new Error(`HTTP ${response.status}`);

                const data = await response.json();

                if (data.success && data.messages && data.messages.length > 0) {
                    const wasAtBottom = isScrolledToBottom();
                    let hasNewMessagesFromOthers = false;

                    data.messages.forEach(msg => {
                        if (msg.id > lastMessageId) {
                            const isOwn = msg.sender_id === currentUserId;
                            addMessageBubble(msg, isOwn);
                            lastMessageId = Math.max(lastMessageId, msg.id);

                            if (!isOwn) {
                                hasNewMessagesFromOthers = true;
                            }
                        }
                    });

                    if (hasNewMessagesFromOthers) {
                        markAsRead();
                    }

                    if (wasAtBottom) {
                        scrollToBottom();
                    }
                }
            } catch (error) {
                console.error('[Chat] Polling failed:', error);
            }
        }

        // ==================== POLLING MANAGEMENT ====================
        function startPolling() {
            if (pollingInterval) {
                clearInterval(pollingInterval);
            }
            pollingInterval = setInterval(() => pollNewMessages(), 5000);
            console.log('[Chat] Polling started for conversation:', conversationId);
        }

        function stopPolling() {
            if (pollingInterval) {
                clearInterval(pollingInterval);
                pollingInterval = null;
                console.log('[Chat] Polling stopped');
            }
        }

        // ==================== NETWORK RESILIENCE ====================
        function handleOnline() {
            isOnline = true;
            console.log('[Chat] Network online, resuming polling');
            startPolling();
            pollNewMessages();
            markAsRead();
        }

        function handleOffline() {
            isOnline = false;
            console.log('[Chat] Network offline, stopping polling');
            stopPolling();
        }

        // ==================== REFRESH CHAT PANEL ====================
        async function refreshChatPanel(newConversationId, conversationData = null) {
            // Stop current polling
            stopPolling();

            // Update conversation ID
            conversationId = newConversationId;

            // Reset states
            hasMarkedAsRead = false;
            lastMessageId = 0;

            // Update header if data provided
            if (conversationData) {
                updateChatHeader(conversationData);
            }

            // Reload messages
            await loadMessages();

            // Mark as read
            await markAsRead();

            // Start polling for new conversation
            startPolling();

            console.log('[Chat] Chat panel refreshed for conversation:', conversationId);
        }

        // ==================== EVENT LISTENERS ====================

        // Auto-scroll to bottom on load
        scrollToBottom();

        // Mark conversation as read when page loads
        markAsRead();

        // Auto-resize textarea
        if (messageInput) {
            messageInput.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = Math.min(this.scrollHeight, 120) + 'px';
            });
        }

        // Handle form submission
        if (messageForm) {
            messageForm.addEventListener('submit', async (e) => {
                e.preventDefault();

                const message = messageInput.value.trim();
                if (!message) return;

                messageInput.value = '';
                messageInput.style.height = 'auto';

                const success = await sendMessage(message);

                if (!success) {
                    messageInput.value = message;
                    messageInput.style.height = 'auto';
                    messageInput.style.height = Math.min(messageInput.scrollHeight, 120) + 'px';
                    messageInput.focus();
                }
            });
        }

        // Handle Enter key (Shift+Enter for new line)
        if (messageInput) {
            messageInput.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    messageForm.dispatchEvent(new Event('submit'));
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

        // Network event listeners
        window.addEventListener('online', handleOnline);
        window.addEventListener('offline', handleOffline);

        // Start polling
        startPolling();

        // Cleanup on page unload
        window.addEventListener('beforeunload', () => {
            stopPolling();
            window.removeEventListener('online', handleOnline);
            window.removeEventListener('offline', handleOffline);
        });

        // Visibility API - stop polling when tab is hidden
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                stopPolling();
            } else {
                startPolling();
                pollNewMessages();
                markAsRead();
            }
        });

        // ==================== EXPOSE PUBLIC METHODS ====================
        window.chatPanel = {
            refreshChatPanel,
            updateChatHeader,
            loadMessages,
            conversationId: () => conversationId
        };

        console.log('[Chat] Chat panel initialized for conversation:', conversationId);
    </script>
@endpush
