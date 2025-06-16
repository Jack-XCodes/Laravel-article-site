<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArticleController;
use App\Models\Article;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArticleController as ApiArticleController;

Route::get('/', function () {
    $articles = Article::where('published', true)
        ->latest('created_at')
        ->take(12)
        ->get();

    return view('welcome', [
        'articles' => $articles
    ]);
})->name('home');

// Article routes
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
Route::post('/articles/{article}/like', [ArticleController::class, 'like'])->name('articles.like')->middleware('auth');
Route::post('/articles/{article}/comment', [ArticleController::class, 'comment'])->name('articles.comment')->middleware('auth');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('dashboard/articles', [DashboardController::class, 'articles'])->name('dashboard.articles');
    Route::get('dashboard/create-article', [DashboardController::class, 'createArticle'])->name('dashboard.create-article');
    Route::post('dashboard/articles', [DashboardController::class, 'storeArticle'])->name('dashboard.store-article');
    Route::get('dashboard/edit-article/{id}', [DashboardController::class, 'editArticle'])->name('dashboard.edit-article');
    Route::put('dashboard/articles/{id}', [DashboardController::class, 'updateArticle'])->name('dashboard.update-article');
    Route::put('dashboard/articles/{id}/publish', [DashboardController::class, 'publishArticle'])->name('dashboard.articles.publish');
    Route::put('dashboard/articles/{id}/unpublish', [DashboardController::class, 'unpublishArticle'])->name('dashboard.articles.unpublish');
    Route::delete('dashboard/articles/{id}', [DashboardController::class, 'deleteArticle'])->name('dashboard.articles.delete');

    Route::resource('tasks', TaskController::class)->except(['show', 'destroy']);
});

// API routes for articles
Route::prefix('api')->group(function () {
    Route::get('/articles', [ApiArticleController::class, 'index']);
    Route::get('/articles/{id}', [ApiArticleController::class, 'show']);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
