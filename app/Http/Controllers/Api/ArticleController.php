<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        // Return published articles, newest first
        return Article::whereNotNull('published_at')
            ->orderByDesc('published_at')
            ->get();
    }

    public function show($id)
    {
        return Article::where('id', $id)
            ->whereNotNull('published_at')
            ->firstOrFail();
    }
}
