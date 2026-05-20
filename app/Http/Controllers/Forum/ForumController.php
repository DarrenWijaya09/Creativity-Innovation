<?php

namespace App\Http\Controllers\Forum;

use Illuminate\Http\Request;
use App\Models\ForumThread;
use App\Models\ForumCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function index(Request $request)
    {
        $threads = ForumThread::query()
            ->with([
                'user',
                'category',
            ])
            ->published()
            ->when($request->search, function ($query) use ($request) {

                $query->where(function ($q) use ($request) {

                    $q->where('title', 'like', '%' . $request->search . '%')
                        ->orWhere('content', 'like', '%' . $request->search . '%');

                });

            })
            ->when($request->category, function ($query) use ($request) {

                $query->whereHas('category', function ($q) use ($request) {
                    $q->where('slug', $request->category);
                });

            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $categories = ForumCategory::query()
            ->latest()
            ->get();

        return view('pages.forum.index', compact(
            'threads',
            'categories',
        ));
    }

    public function create()
    {
        $categories = ForumCategory::query()
            ->latest()
            ->get();

        return view('pages.forum.create', compact(
            'categories',
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'max:255'],
            'category_id' => ['required', 'exists:forum_categories,id'],
            'content' => ['required', 'min:20'],
        ]);

        $thread = ForumThread::create([
            'user_id' => Auth::id(),
            'category_id' => $validated['category_id'],
            'title' => $validated['title'],
            'content' => $validated['content'],
            'status' => 'published',
        ]);

        return redirect()
            ->route('forum.show', $thread->slug)
            ->with('success', 'Diskusi berhasil dibuat.');
    }

    public function show(Request $request, $slug)
    {
        $thread = ForumThread::query()
            ->with([
                'user',
                'category',
            ])
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

        $thread->increment('views_count');

        $repliesQuery = $thread->replies()
            ->with([
                'user',
            ]);

        switch ($request->get('sort')) {

            case 'oldest':

                $repliesQuery->oldest();

                break;

            case 'popular':

                $repliesQuery
                    ->orderByDesc('upvotes_count');

                break;

            case 'latest':
            default:

                $repliesQuery->latest();

                break;
        }

        $replies = $repliesQuery
            ->paginate(10)
            ->withQueryString();

        $relatedThreads = ForumThread::query()
            ->with([
                'user',
                'category',
            ])
            ->published()
            ->where('id', '!=', $thread->id)
            ->where('category_id', $thread->category_id)
            ->latest()
            ->take(4)
            ->get();

        $categories = ForumCategory::query()
            ->latest()
            ->get();

        return view('pages.forum.show', compact(
            'thread',
            'replies',
            'relatedThreads',
            'categories',
        ));
    }


    public function update(Request $request, $slug)
    {
        $thread = ForumThread::query()
            ->where('slug', $slug)
            ->firstOrFail();

        abort_if(
            $thread->user_id !== Auth::id(),
            403
        );

        $validated = $request->validate([
            'title' => ['required', 'max:255'],
            'category_id' => [
                'required',
                'exists:forum_categories,id',
            ],
            'content' => [
                'required',
                'min:20',
            ],
        ]);

        $thread->update([
            'title' => $validated['title'],
            'category_id' => $validated['category_id'],
            'content' => $validated['content'],
        ]);

        return redirect()
            ->route('forum.show', $thread->slug)
            ->with(
                'success',
                'Diskusi berhasil diperbarui.'
            );
    }

    public function destroy($slug)
    {
        $thread = ForumThread::query()
            ->where('slug', $slug)
            ->firstOrFail();

        abort_if(
            $thread->user_id !== Auth::id(),
            403
        );

        $thread->delete();

        return response()->json([
            'success' => true,
            'redirect' => route('forum.index'),
        ]);
    }
}
