@php
    $otherUser = $conversation->buyer_id == auth()->id() ? $conversation->seller : $conversation->buyer;
    $isActive = $isActive ?? false;
    $isUserBuyer = $conversation->buyer_id == auth()->id();
    $userRole = $isUserBuyer ? 'Pembeli' : 'Penyedia Jasa';
    $service = $conversation->service;
@endphp

<div data-conversation-id="{{ $conversation->id }}" data-service-id="{{ $service->id ?? '' }}"
    data-seller-id="{{ $otherUser->id ?? '' }}" data-seller-name="{{ $otherUser->name ?? '' }}"
    data-seller-avatar="{{ $otherUser->avatar ?? '' }}"
    data-seller-verified="{{ optional($conversation->seller)->is_verified && $conversation->seller_id == optional($otherUser)->id ? 'true' : 'false' }}"
    data-service-title="{{ $service->title ?? '' }}" data-service-image="{{ $service->image ?? '' }}"
    data-service-price="{{ $service->price ?? '' }}" data-service-rating="{{ $service->rating ?? '' }}"
    data-service-reviews="{{ $service->reviews_count ?? '' }}" data-service-slug="{{ $service->slug ?? '' }}"
    class="conversation-item cursor-pointer transition-all duration-200 {{ $isActive ? 'bg-primary/5 dark:bg-primary/10 border-l-4 border-l-primary' : 'hover:bg-gray-50 dark:hover:bg-slate-800/50' }}">
    <div class="p-4">
        <div class="flex gap-3">
            <!-- Avatar -->
            <div class="flex-shrink-0 relative">
                <div
                    class="w-12 h-12 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 dark:from-slate-700 dark:to-slate-600 flex items-center justify-center text-gray-600 dark:text-gray-300 font-semibold text-sm overflow-hidden">
                    @if ($otherUser && $otherUser->avatar)
                        @if (filter_var($otherUser->avatar, FILTER_VALIDATE_URL))
                            <img src="{{ $otherUser->avatar }}" class="w-full h-full object-cover"
                                alt="{{ $otherUser->name }}">
                        @else
                            <img src="{{ asset('storage/' . $otherUser->avatar) }}" class="w-full h-full object-cover"
                                alt="{{ $otherUser->name }}">
                        @endif
                    @else
                        {{ strtoupper(substr($otherUser->name ?? 'U', 0, 2)) }}
                    @endif
                </div>
                @if ($conversation->unread_count > 0)
                    <span
                        class="absolute -top-1 -right-1 w-4 h-4 bg-primary rounded-full border-2 border-white dark:border-gray-950"></span>
                @endif
            </div>

            <!-- Conversation Info -->
            <div class="flex-1 min-w-0">
                <!-- Header: Name & Role & Time -->
                <div class="flex items-center justify-between gap-2 mb-1">
                    <div class="flex items-center gap-2 min-w-0 flex-1">
                        <h3
                            class="conversation-name font-semibold text-gray-900 dark:text-white text-sm truncate {{ $isActive ? 'text-primary dark:text-primary' : '' }}">
                            {{ $otherUser->name ?? 'Pengguna' }}
                        </h3>
                        @if (optional($conversation->seller)->is_verified && $conversation->seller_id == optional($otherUser)->id)
                            <i class="fas fa-check-circle text-primary text-xs flex-shrink-0"></i>
                        @endif
                        <!-- Role Badge -->
                        <span
                            class="px-2 py-0.5 bg-gray-100 dark:bg-slate-800 text-gray-600 dark:text-gray-400 text-xs rounded-full flex-shrink-0">
                            {{ $userRole }}
                        </span>
                    </div>
                    <span
                        class="last-message-time text-xs text-gray-400 dark:text-gray-500 flex-shrink-0 whitespace-nowrap">
                        {{ $conversation->last_message_at ? \Carbon\Carbon::parse($conversation->last_message_at)->diffForHumans() : '' }}
                    </span>
                </div>

                <!-- Service Info (if available) -->
                @if ($service)
                    <div class="flex items-center gap-1 mb-1">
                        <i class="fas fa-box text-gray-400 dark:text-gray-500 text-xs"></i>
                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate">
                            {{ $service->title }}
                        </p>
                    </div>
                @endif

                <!-- Last Message -->
                <div class="flex items-center justify-between gap-2 mt-1">
                    <p
                        class="last-message text-sm {{ $conversation->unread_count > 0 ? 'text-gray-900 dark:text-white font-medium' : 'text-gray-500 dark:text-gray-400' }} truncate">
                        <i class="fas fa-reply-all text-xs mr-1 opacity-60"></i>
                        {{ $conversation->last_message ?? 'Belum ada pesan' }}
                    </p>
                    @if ($conversation->unread_count > 0)
                        <span
                            class="unread-badge flex-shrink-0 px-2 py-0.5 bg-primary text-white text-xs font-medium rounded-full">
                            {{ $conversation->unread_count }}
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
