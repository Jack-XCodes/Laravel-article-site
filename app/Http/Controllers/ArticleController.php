<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Like;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function show(Article $article)
    {
        // Load the article with its relationships
        $article->load(['user', 'comments.user', 'likes']);
        
        // Get like/dislike counts
        $likesCount = $article->likesCount();
        $dislikesCount = $article->dislikesCount();
        
        // Check if current user has liked/disliked
        $userLike = $article->userLike();
        
        return view('articles.show', compact('article', 'likesCount', 'dislikesCount', 'userLike'));
    }

    public function like(Request $request, Article $article)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userId = Auth::id();
        $isLike = $request->input('type') === 'like';

        // Check if user already has a like/dislike for this article
        $existingLike = Like::where('user_id', $userId)
                           ->where('article_id', $article->id)
                           ->first();

        if ($existingLike) {
            if ($existingLike->is_like === $isLike) {
                // Same type - remove the like/dislike
                $existingLike->delete();
            } else {
                // Different type - update it
                $existingLike->update(['is_like' => $isLike]);
            }
        } else {
            // Create new like/dislike
            Like::create([
                'user_id' => $userId,
                'article_id' => $article->id,
                'is_like' => $isLike,
            ]);
        }

        return back()->with('success', $isLike ? 'Article liked!' : 'Article disliked!');
    }

    public function comment(Request $request, Article $article)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'article_id' => $article->id,
            'content' => $request->input('content'),
        ]);

        return back()->with('success', 'Comment added successfully!');
    }
}
