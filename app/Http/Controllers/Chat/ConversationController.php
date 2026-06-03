<?php
namespace App\Http\Controllers\Chat;
use App\Models\User;
use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class ConversationController extends Controller
{
    public function index()
    {
        $conversations = Conversation::query()->with(['buyer', 'seller', 'service', 'lastMessage.sender',])->where(function ($query) {
            $query->where('buyer_id', Auth::id())->orWhere('seller_id', Auth::id()); })->latest()->get();
        return view('pages.chat.index', compact('conversations'));
    } /** * Fallback full-page conversation * (masih dipertahankan untuk debugging) */
    public function show(Conversation $conversation)
    {
        $this->authorizeConversation($conversation);
        $conversation->load(['buyer', 'seller', 'service',]);
        $messages = $conversation->messages()->with('sender')->orderBy('created_at')->get();
        $conversations = Conversation::query()->with(['buyer', 'seller', 'service', 'lastMessage.sender',])->where(function ($query) {
            $query->where('buyer_id', Auth::id())->orWhere('seller_id', Auth::id()); })->latest()->get();
        return view('pages.chat.index', ['conversations' => $conversations, 'activeConversation' => $conversation, 'messages' => $messages,]);
    } /** * AJAX endpoint * GET /chat/{conversation}/data */
    public function data(Conversation $conversation)
    {
        $this->authorizeConversation($conversation);
        $conversation->load(['buyer', 'seller', 'service',]);
        $messages = $conversation->messages()->with('sender')->orderBy('created_at')->get();
        return response()->json(['success' => true, 'conversation' => ['id' => $conversation->id, 'buyer_id' => $conversation->buyer_id, 'seller_id' => $conversation->seller_id, 'service_id' => $conversation->service_id, 'created_at' => $conversation->created_at,], 'buyer' => $conversation->buyer, 'seller' => $conversation->seller, 'service' => $conversation->service, 'messages' => $messages,]);
    }
    public function store(Request $request, User $provider)
    {
        abort_if(Auth::id() === $provider->id, 403, 'You cannot start a conversation with yourself.');
        $validated = $request->validate(['service_id' => ['nullable', 'exists:services,id',],]);
        $conversation = Conversation::firstOrCreate(['buyer_id' => Auth::id(), 'seller_id' => $provider->id, 'service_id' => $validated['service_id'] ?? null,]);
        return response()->json(['success' => true, 'conversation_id' => $conversation->id, 'conversation' => ['id' => $conversation->id, 'buyer_id' => $conversation->buyer_id, 'seller_id' => $conversation->seller_id, 'service_id' => $conversation->service_id,],]);
    } /** * Reusable authorization helper */
    private function authorizeConversation(Conversation $conversation): void
    {
        abort_if(Auth::id() !== $conversation->buyer_id && Auth::id() !== $conversation->seller_id, 403);
    }
}
