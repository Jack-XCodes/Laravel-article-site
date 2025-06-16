<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    // I built this dashboard to give users a nice overview of their content
    // It shows stats like total articles, published vs drafts, and recent articles
    public function index(): View
    {
        $user = auth()->user();
        
        // Getting all the stats I want to display on the dashboard
        $totalArticles = Article::count();
        $publishedArticles = Article::whereNotNull('published_at')->count();
        $draftArticles = Article::whereNull('published_at')->count();
        
        // Show the 3 most recent articles to give a quick preview
        $recentArticles = Article::latest()
            ->take(3)
            ->get();

        return view('dashboard', [
            'user' => $user,
            'totalArticles' => $totalArticles,
            'publishedArticles' => $publishedArticles,
            'draftArticles' => $draftArticles,
            'recentArticles' => $recentArticles,
        ]);
    }

    // This is where I show all articles in a nice grid layout for easy management
    // I added pagination because nobody wants to scroll through hundreds of articles!
    public function articles(): View
    {
        $articles = Article::latest()
            ->paginate(12)
            ->through(function ($article) {
                // I transform each article to include all the data my view needs
                // Plus I create a nice excerpt if one doesn't exist
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

        return view('dashboard.articles', [
            'articles' => $articles,
        ]);
    }

    // Simple method to show the article creation form - nothing fancy here
    public function createArticle(): View
    {
        return view('dashboard.create-article');
    }

    // Here's where I handle creating new articles with some smart logic
    // I wanted users to be able to publish immediately OR save as draft
    public function storeArticle(Request $request)
    {
        // First, I validate all the input because security matters!
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'image' => 'nullable|url',
            'publish_now' => 'nullable|boolean',
        ]);

        // I auto-generate a URL-friendly slug from the title
        $validated['slug'] = Str::slug($validated['title']);
        $validated['user_id'] = auth()->id();
        
        // This is the cool part - if they check "publish now", set the date
        // Otherwise, keep it null (which means it's a draft)
        if ($request->has('publish_now') && $request->publish_now) {
            $validated['published_at'] = now();
        } else {
            $validated['published_at'] = null;
        }

        // Clean up - this field was just for our logic, not for the database
        unset($validated['publish_now']);

        Article::create($validated);

        // Give them a nice message based on what they chose to do
        $message = $validated['published_at'] ? 'Article published successfully!' : 'Article saved as draft!';
        return redirect()->route('dashboard.articles')->with('success', $message);
    }

    // I load the article data and format it nicely for the edit form
    public function editArticle($id)
    {
        $article = Article::findOrFail($id);

        // I organize the data exactly how my edit form expects it
        return view('dashboard.edit-article', [
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

    // This handles updating articles with some smart publication logic
    // I wanted to make it easy to change between draft and published
    public function updateArticle(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        // Same validation as creating, but for updates
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'image' => 'nullable|url',
            'is_published' => 'nullable|boolean',
        ]);

        // Update the slug if the title changed
        $validated['slug'] = Str::slug($validated['title']);

        // Here's the magic - handle publishing/unpublishing smoothly
        if (isset($validated['is_published'])) {
            if ($validated['is_published'] && !$article->published_at) {
                // They want to publish it now, so set the date
                $validated['published_at'] = now();
            } elseif (!$validated['is_published']) {
                // They want to unpublish it, so remove the date
                $validated['published_at'] = null;
            }
        }

        // This was just for our logic, not for the database
        unset($validated['is_published']);

        $article->update($validated);

        return redirect()->route('dashboard.articles')->with('success', 'Article updated successfully!');
    }

    // Quick publish button - I used this to make publishing super easy
    public function publishArticle($id)
    {
        $article = Article::findOrFail($id);
        
        // Just set the published date to now and boom - it's live!
        $article->update([
            'published_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Article published successfully!');
    }

    // And the opposite - hide an article from the public
    public function unpublishArticle($id)
    {
        $article = Article::findOrFail($id);
        
        // Remove the published date to make it a draft again
        $article->update([
            'published_at' => null,
        ]);

        return redirect()->back()->with('success', 'Article unpublished successfully!');
    }

    // Sometimes you just need to delete stuff - this handles that
    // I made sure to add confirmation modals in the frontend for this!
    public function deleteArticle($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('dashboard.articles')->with('success', 'Article deleted successfully!');
    }
} 