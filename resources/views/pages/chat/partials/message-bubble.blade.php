@php
    $isOwn = $message->sender_id == auth()->id();
@endphp

<div class="flex {{ $isOwn ? 'justify-end' : 'justify-start' }} animate-fade-in">
    <div class="max-w-[75%] lg:max-w-[70%]">
        <div class="rounded-2xl px-4 py-2.5 {{ $isOwn ? 'bg-primary text-white' : 'bg-gray-100 text-gray-800' }}">
            <p class="text-sm leading-relaxed break-words whitespace-pre-wrap">{{ $message->message }}</p>
        </div>
        <p class="text-xs text-gray-400 mt-1 {{ $isOwn ? 'text-right' : 'text-left' }}">
            {{ $message->created_at->format('H:i') }}
        </p>
    </div>
</div>

@push('styles')
<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(8px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .animate-fade-in {
        animation: fadeIn 0.2s ease-out;
    }
</style>
@endpush
