<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ForumVote;
use App\Models\ForumThread;
use App\Models\ForumReply;
use Illuminate\Support\Facades\Auth;

class ForumVoteController extends Controller
{
    public function thread($id)
    {
        $thread = ForumThread::findOrFail($id);

        $vote = ForumVote::where([
            'user_id' => Auth::id(),
            'thread_id' => $thread->id,
        ])->first();

        if ($vote) {

            $vote->delete();

            $thread->decrement('upvotes_count');

        } else {

            ForumVote::create([
                'user_id' => Auth::id(),
                'thread_id' => $thread->id,
            ]);

            $thread->increment('upvotes_count');
        }

        return response()->json([
            'success' => true,
            'count' => $thread->fresh()->upvotes_count,
        ]);
    }

    public function reply($id)
    {
        $reply = ForumReply::findOrFail($id);

        $vote = ForumVote::where([
            'user_id' => Auth::id(),
            'reply_id' => $reply->id,
        ])->first();

        if ($vote) {

            $vote->delete();

            $reply->decrement('upvotes_count');

        } else {

            ForumVote::create([
                'user_id' => Auth::id(),
                'reply_id' => $reply->id,
            ]);

            $reply->increment('upvotes_count');
        }

        return response()->json([
            'success' => true,
            'count' => $reply->fresh()->upvotes_count,
        ]);
    }
}
