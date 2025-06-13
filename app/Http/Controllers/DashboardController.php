<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with articles
     */
    public function index(): Response
    {
        $user = auth()->user();
        $totalArticles = Article::count();
        $recentArticles = Article::latest()
            ->take(3)
            ->get()
            ->map(function ($article) {
                return [
                    'id' => $article->id,
                    'title' => $article->title,
                    'excerpt' => $article->excerpt ?? substr(strip_tags($article->content), 0, 120) . '...',
                    'author' => $article->author,
                    'image' => $article->image,
                    'published_at' => $article->published_at ? $article->published_at->format('M d, Y') : null,
                    'created_at' => $article->created_at->format('M d, Y'),
                ];
            });

        return Inertia::render('dashboard', [
            'user' => $user,
            'stats' => [
                'totalArticles' => $totalArticles,
                'recentArticles' => count($recentArticles),
                'quickActions' => 3,
            ],
            'recentArticles' => $recentArticles,
        ]);
    }

    /**
     * Show all articles for management
     */
    public function articles(): Response
    {
        $articles = Article::latest()
            ->paginate(12)
            ->through(function ($article) {
                return [
                    'id' => $article->id,
                    'title' => $article->title,
                    'slug' => $article->slug,
                    'content' => $article->content,
                    'author' => $article->author,
                    'image' => $article->image,
                    'excerpt' => $article->excerpt ?? substr(strip_tags($article->content), 0, 120) . '...',
                    'published_at' => $article->published_at ? $article->published_at->format('M d, Y') : null,
                    'created_at' => $article->created_at->format('M d, Y'),
                    'is_published' => !is_null($article->published_at),
                ];
            });

        return Inertia::render('dashboard/articles', [
            'articles' => $articles,
        ]);
    }

    /**
     * Create a new article
     */
    public function createArticle(): Response
    {
        return Inertia::render('dashboard/create-article');
    }

    /**
     * Store a new article
     */
    public function storeArticle(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'image' => 'nullable|url',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['user_id'] = auth()->id();
        $validated['published_at'] = now();

        Article::create($validated);

        return redirect()->route('dashboard.articles')->with('success', 'Article created successfully!');
    }

    public function editArticle($id)
    {
        $article = Article::findOrFail($id);

        return Inertia::render('dashboard/edit-article', [
            'article' => [
                'id' => $article->id,
                'title' => $article->title,
                'content' => $article->content,
                'author' => $article->author,
                'image' => $article->image,
                'published_at' => $article->published_at?->toISOString(),
            ],
        ]);
    }

    public function updateArticle(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'image' => 'nullable|url',
            'is_published' => 'nullable|boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        // Handle publication status
        if (isset($validated['is_published'])) {
            if ($validated['is_published'] && !$article->published_at) {
                $validated['published_at'] = now();
            } elseif (!$validated['is_published']) {
                $validated['published_at'] = null;
            }
        }

        // Remove is_published from the array as it's not a database field
        unset($validated['is_published']);

        $article->update($validated);

        return redirect()->route('dashboard.articles')->with('success', 'Article updated successfully!');
    }

    public function publishArticle($id)
    {
        $article = Article::findOrFail($id);
        
        $article->update([
            'published_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Article published successfully!');
    }

    public function unpublishArticle($id)
    {
        $article = Article::findOrFail($id);
        
        $article->update([
            'published_at' => null,
        ]);

        return redirect()->back()->with('success', 'Article unpublished successfully!');
    }
} 