<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
public function index(Request $request)
{
    $q        = trim((string) $request->input('q'));
    $category = $request->input('category');

    // Base query
    $query = Article::query()->with('categories');

    /**
     * Apply "published" filter if column exists
     */
    if (Schema::hasColumn('articles', 'published')) {
        $query->where('published', true);
    }

    /**
     * Search filter (only existing columns)
     */
    if ($q !== '') {
        $searchableColumns = collect(['title', 'slug', 'content'])
            ->filter(fn ($col) => Schema::hasColumn('articles', $col))
            ->values();

        if ($searchableColumns->isNotEmpty()) {
            $query->where(function ($qb) use ($searchableColumns, $q) {
                foreach ($searchableColumns as $col) {
                    $qb->orWhere("articles.$col", 'LIKE', "%{$q}%");
                }
            });
        }
    }

    /**
     * Filter by category
     */
    if ($category) {
        $query->whereHas('categories', function ($qb) use ($category) {
            $qb->where('categories.id', $category);
        });
    }

    /**
     * Ordering
     */
    $query->orderByDesc(
        Schema::hasColumn('articles', 'updated_at')
            ? 'updated_at'
            : 'created_at'
    );

    /**
     * Pagination
     */
    $articles = $query->paginate(9)->withQueryString();

    /**
     * Categories list
     */
    $categories = Category::orderBy('name')->get();

    return view('home', compact('articles', 'categories'));
}

}
