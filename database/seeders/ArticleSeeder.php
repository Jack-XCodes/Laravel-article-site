<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            [
                'title' => 'Getting Started with Laravel and React',
                'slug' => 'getting-started-with-laravel-and-react',
                'content' => 'Laravel and React make a powerful combination for building modern web applications. In this article, we\'ll explore how to set up a Laravel backend with a React frontend using Inertia.js. This setup allows you to build single-page applications while leveraging the power of Laravel\'s robust backend features.',
                'author' => 'John Doe',
                'published_at' => now()->subDays(1),
                'image' => 'https://images.unsplash.com/photo-1633356122544-f134324a6cee?w=800',
            ],
            [
                'title' => 'Modern Frontend Development with TypeScript',
                'slug' => 'modern-frontend-development-with-typescript',
                'content' => 'TypeScript has revolutionized frontend development by bringing static typing to JavaScript. Learn how to leverage TypeScript in your React applications for better code quality, improved developer experience, and fewer runtime errors. We\'ll cover best practices and advanced features.',
                'author' => 'Jane Smith',
                'published_at' => now()->subDays(2),
                'image' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=800',
            ],
            [
                'title' => 'Building Scalable APIs with Laravel',
                'slug' => 'building-scalable-apis-with-laravel',
                'content' => 'API design is crucial for modern web applications. This comprehensive guide covers Laravel API development best practices, including authentication, rate limiting, versioning, and documentation. Learn how to build APIs that can scale with your application.',
                'author' => 'Mike Johnson',
                'published_at' => now()->subDays(3),
                'image' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=800',
            ],
            [
                'title' => 'Database Optimization Techniques',
                'slug' => 'database-optimization-techniques',
                'content' => 'Database performance can make or break your application. Discover advanced optimization techniques including indexing strategies, query optimization, and database design patterns that will significantly improve your application\'s performance.',
                'author' => 'Sarah Wilson',
                'published_at' => now()->subDays(4),
                'image' => 'https://images.unsplash.com/photo-1544377193-33dcf4d68fb5?w=800',
            ],
            [
                'title' => 'The Future of Web Development',
                'slug' => 'the-future-of-web-development',
                'content' => 'Web development is constantly evolving. Explore emerging trends like WebAssembly, Progressive Web Apps, and serverless architecture. Learn how these technologies are shaping the future of web development and how you can prepare for what\'s coming next.',
                'author' => 'David Brown',
                'published_at' => now()->subDays(5),
                'image' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=800',
            ],
            [
                'title' => 'CSS Grid vs Flexbox: When to Use Which',
                'slug' => 'css-grid-vs-flexbox-when-to-use-which',
                'content' => 'CSS Grid and Flexbox are powerful layout tools, but knowing when to use each can be challenging. This article provides clear guidelines and practical examples to help you choose the right tool for your layout needs.',
                'author' => 'Emily Davis',
                'published_at' => now()->subDays(6),
                'image' => 'https://images.unsplash.com/photo-1524666041070-9d87656c25bb?w=800',
            ],
        ];

        foreach ($articles as $article) {
            Article::create($article);
        }
    }
}
