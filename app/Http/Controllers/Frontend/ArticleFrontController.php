<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleFrontController extends Controller
{
    public function index()
    {
        $articles = Article::where('published', true)->latest()->paginate(6);
        return view('frontend.articles.index', compact('articles'));
    }

    public function show(Article $article)
    {
        // Bring articles related by the same category
        $related = Article::whereHas('categories', function ($q) use ($article) {
        $q->whereIn('categories.id', $article->categories->pluck('id'));
    })
    ->where('id', '!=', $article->id)
    ->latest()
    ->take(3)
    ->get();


        // Fetch only approved comments
        $comments = $article->comments()->where('approved', true)->latest()->get();

        return view('frontend.articles.show', compact('article', 'related', 'comments'));
    }
}
