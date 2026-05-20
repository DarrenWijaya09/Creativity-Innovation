@extends('layouts.app')

@section('title', 'Pesan - VEXORA')

@section('content')
<div class="min-h-screen bg-gray-50 py-6 lg:py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Page Header -->
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">Pesan</h1>
                    <p class="text-gray-500 text-sm mt-1">
                        {{ $conversations->count() }} percakapan • Kelola komunikasi dengan penyedia jasa
                    </p>
                </div>
                <a href="{{ route('catalog.index') }}" class="text-primary text-sm font-medium hover:underline hidden sm:inline-flex items-center gap-1">
                    <i class="fas fa-search text-xs"></i>
                    Cari Jasa
                </a>
            </div>
        </div>

        <!-- Chat Container -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="flex flex-col lg:flex-row">

                <!-- Left Sidebar - Conversation List -->
                <div class="lg:w-96 border-r border-gray-100">
                    <!-- Search Bar -->
                    <div class="p-4 border-b border-gray-100 sticky top-0 bg-white z-10">
                        <div class="relative">
                            <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                            <input type="text"
                                   id="searchConversation"
                                   placeholder="Cari percakapan..."
                                   class="w-full pl-9 pr-3 py-2 border border-gray-200 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-transparent">
                        </div>
                    </div>

                    <!-- Conversation List -->
                    <div class="divide-y divide-gray-100 max-h-[calc(100vh-280px)] overflow-y-auto" id="conversationList">
                        @forelse($conversations as $conv)
                            @include('pages.chat.partials.conversation-item', ['conversation' => $conv, 'isActive' => isset($activeConversation) && $activeConversation->id == $conv->id])
                        @empty
                            <div class="p-8">
                                @include('pages.chat.partials.empty-state', ['type' => 'list'])
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Right Panel - Chat Area -->
                @if(isset($activeConversation))
                    @include('pages.chat.show', ['conversation' => $activeConversation, 'messages' => $messages])
                @else
                    <div class="flex-1 bg-white">
                        @include('pages.chat.partials.empty-state', ['type' => 'main'])
                    </div>
                @endif

            </div>
        </div>

    </div>
</div>

@push('scripts')
<script>
    // Simple search filter for conversations
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
                    item.style.display = '';
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
    .conversation-list-scroll {
        scrollbar-width: thin;
    }
</style>
@endpush
@endsection
