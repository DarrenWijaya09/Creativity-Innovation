@php
    $otherUser = $conversation->buyer_id == auth()->id() ? $conversation->seller : $conversation->buyer;
    $isActive = $isActive ?? false;
@endphp

<a href="{{ route('chat.show', $conversation->id) }}"
   class="conversation-item block p-4 hover:bg-gray-50 transition-all duration-200 {{ $isActive ? 'bg-primary/5 border-l-4 border-l-primary' : '' }}">
    <div class="flex gap-3">
        <!-- Avatar -->
        <div class="flex-shrink-0">
            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center text-gray-600 font-semibold text-sm overflow-hidden">
                @if($otherUser && $otherUser->avatar)
                    @if(filter_var($otherUser->avatar, FILTER_VALIDATE_URL))
                        <img src="{{ $otherUser->avatar }}" class="w-full h-full object-cover">
                    @else
                        <img src="{{ asset('storage/' . $otherUser->avatar) }}" class="w-full h-full object-cover">
                    @endif
                @else
                    {{ strtoupper(substr($otherUser->name ?? 'U', 0, 2)) }}
                @endif
            </div>
        </div>

        <!-- Conversation Info -->
        <div class="flex-1 min-w-0">
            <div class="flex items-center justify-between gap-2">
                <div class="flex items-center gap-1 min-w-0">
                    <h3 class="conversation-name font-semibold text-gray-900 text-sm truncate {{ $isActive ? 'text-primary' : '' }}">
                        {{ $otherUser->name ?? 'Pengguna' }}
                    </h3>
                    @if(optional($conversation->seller)->is_verified && $conversation->seller_id == optional($otherUser)->id)
                        <i class="fas fa-check-circle text-primary text-xs flex-shrink-0"></i>
                    @endif
                </div>
                <span class="text-xs text-gray-400 flex-shrink-0">
                    {{ $conversation->last_message_at ? \Carbon\Carbon::parse($conversation->last_message_at)->diffForHumans() : '' }}
                </span>
            </div>
            <div class="flex items-center justify-between gap-2 mt-0.5">
                <p class="last-message text-sm {{ $conversation->unread_count > 0 ? 'text-gray-900 font-medium' : 'text-gray-400' }} truncate">
                    {{ $conversation->last_message ?? 'Belum ada pesan' }}
                </p>
                @if($conversation->unread_count > 0)
                    <span class="flex-shrink-0 w-2 h-2 bg-primary rounded-full"></span>
                @endif
            </div>
        </div>
    </div>
</a>
