<?php

namespace App\Http\Controllers\Chat;

use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    /**
     * GET /chat/{conversation}/messages
     */
    public function index(
        Request $request,
        Conversation $conversation
    ) {
        abort_if(
            Auth::id() !== $conversation->buyer_id &&
            Auth::id() !== $conversation->seller_id,
            403
        );

        // AUTO READ
        $conversation->messages()
            ->where('sender_id', '!=', Auth::id())
            ->where('is_read', false)
            ->update([
                'is_read' => true,
            ]);

        $lastId = $request->integer('last_id');

        $query = $conversation->messages()
            ->with('sender')
            ->orderBy('id');

        if ($lastId > 0) {
            $query->where('id', '>', $lastId);
        }

        $messages = $query->get();

        return response()->json([
            'success' => true,
            'messages' => $messages,
            'last_message_id' => $messages->last()?->id,
        ]);
    }

    /**
     * POST /chat/{conversation}/messages
     */
    public function store(
        Request $request,
        Conversation $conversation
    ) {
        abort_if(
            Auth::id() !== $conversation->buyer_id &&
            Auth::id() !== $conversation->seller_id,
            403
        );

        $validator = Validator::make(
            $request->all(),
            [
                'message' => [
                    'required',
                    'string',
                    'max:5000',
                ],
            ]
        );

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);

        }

        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => Auth::id(),
            'message' => $validator->validated()['message'],
            'is_read' => false,
        ]);

        $message->load('sender');

        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }

    /**
     * POST /chat/{conversation}/read
     */
    public function markAsRead(
        Conversation $conversation
    ) {
        abort_if(
            Auth::id() !== $conversation->buyer_id &&
            Auth::id() !== $conversation->seller_id,
            403
        );

        $conversation->messages()
            ->where('sender_id', '!=', Auth::id())
            ->where('is_read', false)
            ->update([
                'is_read' => true,
            ]);

        return response()->json([
            'success' => true,
        ]);
    }
}
