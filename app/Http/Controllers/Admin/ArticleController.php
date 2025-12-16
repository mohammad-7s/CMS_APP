<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{public function index(Request $request)
{
    $articles = Article::query()
        ->when($request->filled('search'), function ($query) use ($request) {
            $query->where('title', 'like', '%' . $request->search . '%');
        })
        ->when($request->filled('category_id'), function ($query) use ($request) {
            $query->whereHas('categories', function ($q) use ($request) {
            $q->where('categories.id', $request->category_id);
            });
        })
        ->latest()
        ->paginate(9)
        ->withQueryString();

    $categories = Category::withCount('articles')->get();

    return view('admin.articles.index', compact('articles', 'categories'));
}



    public function create()
    {

    $categories = Category::all();
    return view('admin.articles.create', compact('categories'));
    }

public function store(Request $request)
{
    $validated = $request->validate([
        'title'        => 'required|string|max:255',
        'content'      => 'required|string',
        'categories'   => 'required|array',
        'categories.*' => 'exists:categories,id',
        'image'        => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        'published'    => 'required|in:0,1',
    ]);

    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('articles', 'public');
    }

    $validated['slug'] = Str::slug($validated['title']);
    $validated['user_id'] = auth()->id();

    $article = Article::create($validated);

    $article->categories()->sync($validated['categories']);

    return redirect()
        ->route('admin.articles.index')
        ->with('message', 'The article has been added successfully');
}

    public function show(string $id)
    {
        //
    }

    public function edit(Article $article)
{
    $categories = Category::all();
    $selectedCategories = $article->categories->pluck('id')->toArray();

    return view('admin.articles.edit', compact('article', 'categories', 'selectedCategories'));
}



public function update(Request $request, Article $article)
{
    $validated = $request->validate([
        'title'        => 'required|string|max:255',
        'content'      => 'required|string',
        'categories'   => 'nullable|array',
        'categories.*' => 'exists:categories,id',
        'image'        => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        'published' => 'required|in:0,1',
    ]);

    if ($request->hasFile('image')) {
        // delete old image
        if ($article->image && Storage::disk('public')->exists($article->image)) {
            Storage::disk('public')->delete($article->image);
        }

        $validated['image'] = $request->file('image')->store('articles', 'public');
    }

    $validated['slug'] = Str::slug($validated['title']);

    $article->update($validated);
    $article->categories()->sync($validated['categories'] ?? []);

    return redirect()
        ->route('admin.articles.index')
        ->with('message', 'The article has been updated successfully');
}

    public function destroy($id)
{
    $article = Article::findOrFail($id);

    // Delete image if exists
    if ($article->image && Storage::disk('public')->exists($article->image)) {
    Storage::disk('public')->delete($article->image);
}

    $article->delete();

    return redirect()->route('admin.articles.index')->with('success', 'Article deleted successfully');
}
public function toggle($id)
{
    $article = Article::findOrFail($id);

    $article->published = !$article->published;

    $article->save();

    return back()->with('success', 'The article status has been updated');
}


}
