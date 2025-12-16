<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
class CommentFrontController extends Controller
{



    public function store(Request $request, Article $article)
{
    if (!Auth::check()) {
    return back()->with('error', 'You must log in to add a comment');
}

    // Rate limit per IP + article (prevent spam)
    $key = 'comment-submit|' . $request->ip() . '|' . $article->id;
    if (RateLimiter::tooManyAttempts($key, 5)) {
        return response()->json(['message' => 'Too many attempts, please wait.'], 429);
    }
    RateLimiter::hit($key, 60); // 5 attempts per minute

    if (isset($article->comments_enabled) && ! $article->comments_enabled) {
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Comments are disabled for this article.'], 403);
        }
        return back()->with('message', 'Comments are disabled for this article.');
    }

    $article = Article::where('id', $article->id)->firstOrFail();

    $request->validate([
        'message' => 'required|string',
    ]);

    $article->comments()->create([
        'user_id' => Auth::id(),
        'email'=>Auth::user()->email,
        'name' =>Auth::user()->name,
        'comment' => $request->message,
        'approved' => false,
    ]);
    return back()->with('message', 'The comment has been sent and will appear after approval.');
}

}
