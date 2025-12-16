<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->input('status', 'all'); // all, approved, pending
        $article_id = $request->input('article_id', null);

        $query = Comment::with('article')->orderByDesc('created_at');

        if ($status === 'approved') {
            $query->where('approved', true);
        } elseif ($status === 'pending') {
            $query->where('approved', false);
        }

        if ($article_id) {
            $query->where('article_id', $article_id);
        }

        $comments = $query->paginate(20)->withQueryString();

        // To get the list of articles for the selection filter (simple view)
        $articles = Article::orderBy('title')->get(['id','title','comments_enabled']);

        return view('admin.comments.index', compact('comments','articles','status','article_id'));
    }


    public function approve(Comment $comment)
    {
        $comment->update(['approved' => true]);

        return redirect()->route('admin.comments.index')->with('message', 'The comment has been approved.');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('admin.comments.index')->with('message', 'The comment has been deleted.');
    }

    /**
     * Disable/Enable comments for a specific article
     */
    public function toggleArticleComments(Article $article)
    {

        $article->comments_enabled = ! $article->comments_enabled;
        $article->save();

        $status = $article->comments_enabled ? 'Activated' : 'Suspended';
        return back()->with('message', "Comments have been {$status} for the article '{$article->title}'.");
    }
}
