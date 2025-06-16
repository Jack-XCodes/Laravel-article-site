<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{
    /** @use HasFactory<\Database\Factories\ArticleFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'author',
        'slug',
        'published_at',
        'image',
        'user_id',
        'published',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'published' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
    }

    // Helper methods for like/dislike counts
    public function likesCount(): int
    {
        return $this->likes()->where('is_like', true)->count();
    }

    public function dislikesCount(): int
    {
        return $this->likes()->where('is_like', false)->count();
    }

    // Check if user has liked/disliked this article
    public function userLike($userId = null): ?Like
    {
        $userId = $userId ?? auth()->id();
        if (!$userId) return null;
        
        return $this->likes()->where('user_id', $userId)->first();
    }

    // Scope for published articles
    public function scopePublished($query)
    {
        return $query->where('published', true);
    }
}
