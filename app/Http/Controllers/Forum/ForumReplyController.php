<?php

namespace App\Http\Controllers\Forum;

use App\Models\ForumReply;
use App\Models\ForumThread;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ForumReplyController extends Controller
{
    public function store(Request $request, $slug)
    {
        $validated = $request->validate([
            'content' => [
                'required',
                'min:10',
            ],
        ]);

        $thread = ForumThread::query()
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

        ForumReply::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'content' => $validated['content'],
        ]);

        $thread->increment('replies_count');

        return redirect()
            ->back()
            ->with(
                'success',
                'Balasan berhasil dikirim.'
            );
    }

    public function update(
        Request $request,
        ForumReply $reply
    ) {
        abort_if(
            $reply->user_id !== Auth::id(),
            403
        );

        $validated = $request->validate([
            'content' => [
                'required',
                'min:10',
            ],
        ]);

        $reply->update([
            'content' => $validated['content'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Balasan berhasil diperbarui.',
        ]);
    }

    public function destroy(ForumReply $reply)
    {
        abort_if(
            $reply->user_id !== Auth::id(),
            403
        );

        $thread = $reply->thread;

        $reply->delete();

        $thread->decrement('replies_count');

        return response()->json([
            'success' => true,
            'message' => 'Balasan berhasil dihapus.',
        ]);
    }
}
