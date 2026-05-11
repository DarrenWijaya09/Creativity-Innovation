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
}
