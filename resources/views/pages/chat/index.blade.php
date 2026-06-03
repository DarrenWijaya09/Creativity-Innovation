@extends('layouts.app')

@section('title', 'Pesan - VEXORA')

@section('content')
    <div class="min-h-screen bg-white dark:bg-gray-950">
        <div class="flex flex-col h-screen">

            <!-- ==================== HEADER SIMPLIFIED ==================== -->
            <div class="border-b border-gray-100 dark:border-slate-700 bg-white dark:bg-gray-950 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-xl font-semibold text-gray-900 dark:text-white">Pesan</h1>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">
                            <span id="conversationCount">{{ $conversations->count() }}</span> percakapan
                        </p>
                    </div>
                    <a href="{{ route('catalog.index') }}"
                        class="text-sm text-gray-500 dark:text-gray-400 hover:text-primary dark:hover:text-primary transition">
                        <i class="fas fa-search mr-1 text-xs"></i>
                        Cari Jasa
                    </a>
                </div>
            </div>

            <!-- ==================== MAIN CHAT LAYOUT ==================== -->
            <div class="flex-1 flex overflow-hidden">

                <!-- Left Sidebar - Conversation List -->
                <div
                    class="w-full lg:w-96 border-r border-gray-100 dark:border-slate-700 flex flex-col bg-gray-50 dark:bg-slate-900/50">

                    <!-- Search Bar -->
                    <div
                        class="p-4 border-b border-gray-100 dark:border-slate-700 bg-gray-50 dark:bg-slate-900/50 sticky top-0">
                        <div class="relative">
                            <i
                                class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500 text-sm"></i>
                            <input type="text" id="searchConversation" placeholder="Cari percakapan..."
                                class="w-full pl-9 pr-3 py-2 border border-gray-200 dark:border-slate-700 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-transparent bg-white dark:bg-slate-900 text-gray-900 dark:text-white placeholder:text-gray-400 dark:placeholder:text-gray-500">
                        </div>
                    </div>

                    <!-- Conversation List - Scrollable -->
                    <div class="flex-1 overflow-y-auto" id="conversationList">
                        @forelse($conversations as $conv)
                            @include('pages.chat.partials.conversation-item', [
                                'conversation' => $conv,
                                'isActive' => isset($activeConversation) && $activeConversation->id == $conv->id,
                            ])
                        @empty
                            <div class="flex items-center justify-center h-full p-8">
                                <div class="text-center">
                                    <div
                                        class="w-12 h-12 bg-gray-100 dark:bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <i class="fas fa-comments text-gray-400 dark:text-gray-500 text-lg"></i>
                                    </div>
                                    <h3 class="text-sm font-medium text-gray-900 dark:text-white mb-1">Belum ada percakapan
                                    </h3>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Mulai chat dengan penyedia jasa</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Right Panel - Chat Area -->
                <div class="flex-1 flex flex-col bg-white dark:bg-gray-950" id="chatAreaContainer">
                    @if (isset($activeConversation))
                        <div id="chatAreaContent">
                            @include('pages.chat.show', [
                                'conversation' => $activeConversation,
                                'messages' => $messages,
                            ])
                        </div>
                    @else
                        <div id="chatAreaContent" class="flex items-center justify-center h-full">
                            <div class="text-center">
                                <div
                                    class="w-16 h-16 bg-gray-100 dark:bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-comment-dots text-gray-400 dark:text-gray-500 text-2xl"></i>
                                </div>
                                <h3 class="text-base font-medium text-gray-900 dark:text-white mb-1">Pilih percakapan</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Pilih percakapan untuk mulai chatting
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
        <script>
            // State variables
            let currentConversationId = {{ isset($activeConversation) ? $activeConversation->id : 'null' }};
            let pollingInterval = null;
            let lastMessageId = 0;

            // ==================== LOAD CONVERSATION ====================
            async function loadConversation(conversationId, conversationData = null) {
                if (currentConversationId === conversationId) return;

                // Show loading state
                showLoadingState();

                // Update current conversation ID
                currentConversationId = conversationId;

                // Update active state in sidebar
                updateActiveState(conversationId);

                // If conversationData not provided, fetch from server
                let convData = conversationData;
                if (!convData) {
                    convData = await fetchConversationData(conversationId);
                }

                if (convData) {
                    // Load chat area
                    await loadChatArea(convData);

                    // Start polling for this conversation
                    startPolling(conversationId);
                } else {
                    showErrorState();
                }
            }

            // ==================== FETCH CONVERSATION DATA ====================
            async function fetchConversationData(conversationId) {
                try {
                    const response = await fetch(`/chat/${conversationId}/data`, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    if (!response.ok) throw new Error('Failed to fetch conversation data');

                    const data = await response.json();
                    return data.success ? data.conversation : null;
                } catch (error) {
                    console.error('Error fetching conversation:', error);
                    return null;
                }
            }

            // ==================== LOAD CHAT AREA ====================
            async function loadChatArea(conversation) {
                try {
                    // Fetch messages for this conversation
                    const messagesResponse = await fetch(`/chat/${conversation.id}/messages`, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    if (!messagesResponse.ok) throw new Error('Failed to fetch messages');

                    const messagesData = await messagesResponse.json();

                    // Update lastMessageId for polling
                    if (messagesData.messages && messagesData.messages.length > 0) {
                        lastMessageId = Math.max(...messagesData.messages.map(m => m.id));
                    } else {
                        lastMessageId = 0;
                    }

                    // Render chat area
                    renderChatArea(conversation, messagesData.messages || []);

                    // Mark as read
                    await markAsRead(conversation.id);

                    // Update URL without reload
                    updateUrl(conversation.id);

                } catch (error) {
                    console.error('Error loading chat area:', error);
                    showErrorState();
                }
            }

            // ==================== RENDER CHAT AREA ====================
            function renderChatArea(conversation, messages) {
                const container = document.getElementById('chatAreaContainer');
                if (!container) return;

                // Build chat area HTML
                const chatHtml = `
            <div id="chatAreaContent" class="flex flex-col h-full">
                <!-- Chat Header -->
                <div class="p-4 border-b border-gray-100 dark:border-slate-700 sticky top-0 bg-white dark:bg-gray-950 z-10">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 dark:from-slate-700 dark:to-slate-600 flex items-center justify-center text-gray-600 dark:text-gray-300 font-semibold text-sm overflow-hidden">
                                    ${conversation.seller_avatar ?
                                        `<img src="${conversation.seller_avatar}" class="w-full h-full object-cover">` :
                                        `<span>${(conversation.seller_name || 'U').substring(0, 2).toUpperCase()}</span>`
                                    }
                                </div>
                            </div>
                            <div>
                                <div class="flex items-center gap-1">
                                    <span class="font-semibold text-gray-900 dark:text-white">${escapeHtml(conversation.seller_name)}</span>
                                    ${conversation.seller_verified ? '<i class="fas fa-check-circle text-primary text-xs"></i>' : ''}
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">${conversation.user_role === 'seller' ? 'Penyedia Jasa' : 'Pembeli'}</p>
                            </div>
                        </div>
                        ${conversation.service_slug ? `
                                    <a href="/catalog/${conversation.service_slug}" class="text-primary text-sm hover:underline hidden sm:inline-flex items-center gap-1">
                                        <i class="fas fa-external-link-alt text-xs"></i>
                                        Lihat Jasa
                                    </a>
                                ` : ''}
                    </div>
                </div>

                <!-- Messages Container -->
                <div class="flex-1 overflow-y-auto p-4 space-y-4" id="messagesContainer">
                    ${messages.length > 0 ? messages.map(msg => renderMessageBubble(msg, {{ auth()->id() }})).join('') : `
                                <div class="flex items-center justify-center h-full">
                                    <div class="text-center py-8">
                                        <div class="w-12 h-12 bg-gray-100 dark:bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-3">
                                            <i class="fas fa-comment-dots text-gray-300 dark:text-gray-600 text-lg"></i>
                                        </div>
                                        <p class="text-gray-500 dark:text-gray-400 text-sm">Belum ada pesan</p>
                                        <p class="text-gray-400 dark:text-gray-500 text-xs mt-1">Mulai percakapan sekarang</p>
                                    </div>
                                </div>
                            `}
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
        `;

                container.innerHTML = chatHtml;

                // Re-attach event listeners
                attachMessageEvents(conversation.id);

                // Scroll to bottom
                scrollToBottom();
            }

            // ==================== RENDER MESSAGE BUBBLE ====================
            function renderMessageBubble(message, currentUserId) {
                const isOwn = message.sender_id === currentUserId;
                const timeString = new Date(message.created_at).toLocaleTimeString('id-ID', {
                    hour: '2-digit',
                    minute: '2-digit'
                });

                return `
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
            }

            // ==================== ATTACH MESSAGE EVENTS ====================
            function attachMessageEvents(conversationId) {
                const messageForm = document.getElementById('messageForm');
                const messageInput = document.getElementById('messageInput');
                const sendButton = document.getElementById('sendMessageBtn');

                if (messageForm) {
                    messageForm.onsubmit = async (e) => {
                        e.preventDefault();
                        const message = messageInput?.value.trim();
                        if (!message) return;

                        await sendMessage(conversationId, message);
                    };
                }

                if (messageInput) {
                    messageInput.onkeydown = (e) => {
                        if (e.key === 'Enter' && !e.shiftKey) {
                            e.preventDefault();
                            messageForm?.dispatchEvent(new Event('submit'));
                        }
                    };

                    messageInput.oninput = function() {
                        this.style.height = 'auto';
                        this.style.height = Math.min(this.scrollHeight, 120) + 'px';
                    };
                }
            }

            // ==================== SEND MESSAGE ====================
            async function sendMessage(conversationId, message) {
                const sendButton = document.getElementById('sendMessageBtn');
                const sendIcon = document.getElementById('sendIcon');
                const loadingSpinner = document.getElementById('loadingSpinner');
                const messageInput = document.getElementById('messageInput');

                sendButton.disabled = true;
                sendIcon.classList.add('hidden');
                loadingSpinner.classList.remove('hidden');

                try {
                    const response = await fetch(`/chat/${conversationId}/messages`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute(
                                'content'),
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({
                            message: message
                        })
                    });

                    if (!response.ok) throw new Error('Failed to send message');

                    const data = await response.json();

                    if (data.success && data.message) {
                        messageInput.value = '';
                        messageInput.style.height = 'auto';
                        addMessageToContainer(data.message, true);
                        lastMessageId = Math.max(lastMessageId, data.message.id);
                        scrollToBottom();
                    }
                } catch (error) {
                    console.error('Error sending message:', error);
                    alert('Gagal mengirim pesan. Silakan coba lagi.');
                } finally {
                    sendButton.disabled = false;
                    sendIcon.classList.remove('hidden');
                    loadingSpinner.classList.add('hidden');
                    messageInput?.focus();
                }
            }

            // ==================== ADD MESSAGE TO CONTAINER ====================
            function addMessageToContainer(message, isOwn) {
                const container = document.getElementById('messagesContainer');
                if (!container) return;

                const messageHtml = renderMessageBubble(message, isOwn ? {{ auth()->id() }} : 0);
                container.insertAdjacentHTML('beforeend', messageHtml);
            }

            // ==================== MARK AS READ ====================
            async function markAsRead(conversationId) {
                try {
                    await fetch(`/chat/${conversationId}/read`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute(
                                'content'),
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                } catch (error) {
                    console.error('Error marking as read:', error);
                }
            }

            // ==================== UPDATE ACTIVE STATE ====================
            function updateActiveState(conversationId) {
                document.querySelectorAll('.conversation-item').forEach(item => {
                    item.classList.remove('bg-primary/5', 'dark:bg-primary/10', 'border-l-4', 'border-l-primary');
                    const nameElement = item.querySelector('.conversation-name');
                    if (nameElement) {
                        nameElement.classList.remove('text-primary', 'dark:text-primary');
                    }
                });

                const activeItem = document.querySelector(`.conversation-item[data-conversation-id="${conversationId}"]`);
                if (activeItem) {
                    activeItem.classList.add('bg-primary/5', 'dark:bg-primary/10', 'border-l-4', 'border-l-primary');
                    const activeName = activeItem.querySelector('.conversation-name');
                    if (activeName) {
                        activeName.classList.add('text-primary', 'dark:text-primary');
                    }
                }
            }

            // ==================== POLLING ====================
            function startPolling(conversationId) {
                if (pollingInterval) {
                    clearInterval(pollingInterval);
                }

                pollingInterval = setInterval(async () => {
                    if (currentConversationId !== conversationId) return;

                    try {
                        const response = await fetch(`/chat/${conversationId}/messages?last_id=${lastMessageId}`, {
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });

                        if (!response.ok) throw new Error('Polling failed');

                        const data = await response.json();

                        if (data.success && data.messages && data.messages.length > 0) {
                            const wasAtBottom = isScrolledToBottom();

                            data.messages.forEach(msg => {
                                if (msg.id > lastMessageId) {
                                    addMessageToContainer(msg, false);
                                    lastMessageId = Math.max(lastMessageId, msg.id);
                                }
                            });

                            if (wasAtBottom) {
                                scrollToBottom();
                            }

                            // Mark as read if there are new messages
                            if (data.messages.length > 0) {
                                await markAsRead(conversationId);
                            }
                        }
                    } catch (error) {
                        console.error('Polling error:', error);
                    }
                }, 5000);
            }

            // ==================== UI HELPER FUNCTIONS ====================
            function showLoadingState() {
                const container = document.getElementById('chatAreaContainer');
                if (container) {
                    container.innerHTML = `
                <div class="flex items-center justify-center h-full">
                    <div class="text-center">
                        <i class="fas fa-spinner fa-spin text-primary text-3xl mb-4"></i>
                        <p class="text-gray-500 dark:text-gray-400">Memuat percakapan...</p>
                    </div>
                </div>
            `;
                }
            }

            function showErrorState() {
                const container = document.getElementById('chatAreaContainer');
                if (container) {
                    container.innerHTML = `
                <div class="flex items-center justify-center h-full">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-red-100 dark:bg-red-950/30 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-exclamation-triangle text-red-500 text-2xl"></i>
                        </div>
                        <h3 class="text-base font-medium text-gray-900 dark:text-white mb-1">Gagal memuat percakapan</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Silakan coba lagi nanti</p>
                    </div>
                </div>
            `;
                }
            }

            function scrollToBottom() {
                setTimeout(() => {
                    const container = document.getElementById('messagesContainer');
                    if (container) {
                        container.scrollTop = container.scrollHeight;
                    }
                }, 100);
            }

            function isScrolledToBottom() {
                const container = document.getElementById('messagesContainer');
                if (!container) return true;
                return container.scrollHeight - container.scrollTop <= container.clientHeight + 100;
            }

            function updateUrl(conversationId) {
                const url = new URL(window.location.href);
                url.searchParams.set('conversation', conversationId);
                window.history.pushState({
                    conversationId
                }, '', url);
            }

            function escapeHtml(text) {
                const div = document.createElement('div');
                div.textContent = text;
                return div.innerHTML;
            }

            // ==================== INITIALIZE ====================
            document.addEventListener('DOMContentLoaded', () => {
                // Attach click listeners to conversation items
                document.querySelectorAll('.conversation-item').forEach(item => {
                    item.addEventListener('click', (e) => {
                        const conversationId = item.dataset.conversationId;
                        if (conversationId) {
                            loadConversation(conversationId);
                        }
                    });
                });

                // Handle browser back/forward
                window.addEventListener('popstate', (event) => {
                    const conversationId = event.state?.conversationId;
                    if (conversationId) {
                        loadConversation(conversationId);
                    }
                });
            });

            // ==================== SEARCH FILTER ====================
            const searchInput = document.getElementById('searchConversation');
            const conversationList = document.getElementById('conversationList');

            if (searchInput && conversationList) {
                searchInput.addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase();
                    const items = conversationList.querySelectorAll('.conversation-item');

                    items.forEach(item => {
                        const name = item.querySelector('.conversation-name')?.textContent.toLowerCase() || '';
                        const lastMsg = item.querySelector('.last-message')?.textContent.toLowerCase() || '';

                        if (name.includes(searchTerm) || lastMsg.includes(searchTerm)) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            }
        </script>
    @endpush

    @push('styles')
        <style>
            /* Custom scrollbar untuk conversation list */
            #conversationList::-webkit-scrollbar {
                width: 4px;
            }

            #conversationList::-webkit-scrollbar-track {
                background: transparent;
            }

            #conversationList::-webkit-scrollbar-thumb {
                background: #cbd5e1;
                border-radius: 4px;
            }

            #conversationList::-webkit-scrollbar-thumb:hover {
                background: #94a3b8;
            }

            .dark #conversationList::-webkit-scrollbar-thumb {
                background: #475569;
            }

            .dark #conversationList::-webkit-scrollbar-thumb:hover {
                background: #64748b;
            }

            /* Messages container scrollbar */
            #messagesContainer::-webkit-scrollbar {
                width: 6px;
            }

            #messagesContainer::-webkit-scrollbar-track {
                background: #f1f1f1;
                border-radius: 3px;
            }

            #messagesContainer::-webkit-scrollbar-thumb {
                background: #cbd5e1;
                border-radius: 3px;
            }

            #messagesContainer::-webkit-scrollbar-thumb:hover {
                background: #94a3b8;
            }

            .dark #messagesContainer::-webkit-scrollbar-track {
                background: #1e293b;
            }

            .dark #messagesContainer::-webkit-scrollbar-thumb {
                background: #475569;
            }

            .dark #messagesContainer::-webkit-scrollbar-thumb:hover {
                background: #64748b;
            }
        </style>
    @endpush
@endsection
