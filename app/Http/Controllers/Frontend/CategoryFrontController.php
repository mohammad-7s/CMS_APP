<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryFrontController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(6);
        return view('frontend.categories.index', compact('categories'));
    }
    public function show(Category $category)
{
    $category = Category::where('id', $category->id)->firstOrFail();

    // Fetching articles by category
    $articles = $category->articles()
        ->where('published', true)
        ->latest()
        ->paginate(9);

    return view('frontend.categories.show', compact('category', 'articles'));
}

}
