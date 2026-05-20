<?php

namespace App\Http\Controllers\Chat;

use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function store(
        Request $request,
        Conversation $conversation
    ) {
        // AUTHORIZATION
        abort_if(
            Auth::id() !== $conversation->buyer_id &&
            Auth::id() !== $conversation->seller_id,
            403
        );

        $validated = $request->validate([
            'message' => [
                'required',
                'string',
                'max:5000',
            ],
        ]);

        Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => Auth::id(),
            'message' => $validated['message'],
        ]);

        return redirect()
            ->back();
    }
}
