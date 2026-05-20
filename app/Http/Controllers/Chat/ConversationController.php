<?php

namespace App\Http\Controllers\Chat;

use App\Models\User;
use App\Models\Service;
use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ConversationController extends Controller
{
    public function index()
    {
        $conversations = Conversation::query()
            ->with([
                'buyer',
                'seller',
                'service',
                'lastMessage.sender',
            ])
            ->where(function ($query) {

                $query
                    ->where('buyer_id', Auth::id())
                    ->orWhere('seller_id', Auth::id());

            })
            ->latest()
            ->get();

        return view(
            'pages.chat.index',
            compact(
                'conversations'
            )
        );
    }

    public function show(Conversation $conversation)
    {
        // AUTHORIZATION
        abort_if(
            Auth::id() !== $conversation->buyer_id &&
            Auth::id() !== $conversation->seller_id,
            403
        );

        // LOAD RELATIONS
        $conversation->load([
            'buyer',
            'seller',
            'service',
        ]);

        // LOAD MESSAGES
        $messages = $conversation->messages()
            ->with([
                'sender',
            ])
            ->latest()
            ->get()
            ->reverse();

        // SIDEBAR CONVERSATIONS
        $conversations = Conversation::query()
            ->with([
                'buyer',
                'seller',
                'service',
                'lastMessage.sender',
            ])
            ->where(function ($query) {

                $query
                    ->where('buyer_id', Auth::id())
                    ->orWhere('seller_id', Auth::id());

            })
            ->latest()
            ->get();

        return view(
            'pages.chat.show',
            compact(
                'conversation',
                'messages',
                'conversations'
            )
        );
    }

    public function store(Request $request, User $provider)
    {
        // PREVENT SELF CHAT
        abort_if(
            Auth::id() === $provider->id,
            403
        );

        $serviceId = $request->service_id;

        // CHECK EXISTING CONVERSATION
        $conversation = Conversation::query()
            ->where('buyer_id', Auth::id())
            ->where('seller_id', $provider->id)
            ->where('service_id', $serviceId)
            ->first();

        // CREATE IF NOT EXISTS
        if (!$conversation) {

            $conversation = Conversation::create([
                'buyer_id' => Auth::id(),
                'seller_id' => $provider->id,
                'service_id' => $serviceId,
            ]);

        }

        return redirect()
            ->route(
                'chat.show',
                $conversation->id
            );
    }
}
