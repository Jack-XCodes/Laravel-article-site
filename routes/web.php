<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;
use App\Models\Article;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Api\ArticleController;

Route::get('/', function () {
    $articles = Article::whereNotNull('published_at')
        ->latest('published_at')
        ->take(12)
        ->get()
        ->map(function ($article) {
            return [
                'id' => $article->id,
                'title' => $article->title,
                'slug' => $article->slug,
                'date' => $article->published_at ? $article->published_at->format('Y-m-d') : $article->created_at->format('Y-m-d'),
                'category' => 'Blog', // You can add a category field to articles table later
                'image' => $article->image,
                'excerpt' => $article->excerpt ?? substr(strip_tags($article->content), 0, 120) . '...',
            ];
        });

    return Inertia::render('welcome', [
        'articles' => $articles
    ]);
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('dashboard/articles', [DashboardController::class, 'articles'])->name('dashboard.articles');
    Route::get('dashboard/articles/create', [DashboardController::class, 'createArticle'])->name('dashboard.articles.create');
    Route::post('dashboard/articles', [DashboardController::class, 'storeArticle'])->name('dashboard.articles.store');
    Route::get('dashboard/articles/{id}/edit', [DashboardController::class, 'editArticle'])->name('dashboard.articles.edit');
    Route::put('dashboard/articles/{id}', [DashboardController::class, 'updateArticle'])->name('dashboard.articles.update');
    Route::put('dashboard/articles/{id}/publish', [DashboardController::class, 'publishArticle'])->name('dashboard.articles.publish');
    Route::put('dashboard/articles/{id}/unpublish', [DashboardController::class, 'unpublishArticle'])->name('dashboard.articles.unpublish');

    Route::resource('tasks', TaskController::class)->except(['show', 'destroy']);
});

// API routes for articles
Route::prefix('api')->group(function () {
    Route::get('/articles', [ArticleController::class, 'index']);
    Route::get('/articles/{id}', [ArticleController::class, 'show']);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
