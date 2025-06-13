import React, { useState } from 'react';
import BlogLayout from '../layouts/BlogLayout';
import Categories from '../components/blog/Categories';
import ArticleCard from '../components/blog/ArticleCard';

interface Article {
    id: number;
    title: string;
    excerpt: string;
    image?: string;
    category: string;
    date: string;
    slug: string;
}

interface BlogProps {
    articles?: Article[];
}

export default function Blog({ articles = [] }: BlogProps) {
    const [searchQuery, setSearchQuery] = useState('');

    const filteredArticles = articles.filter(article =>
        article.title.toLowerCase().includes(searchQuery.toLowerCase()) ||
        article.excerpt.toLowerCase().includes(searchQuery.toLowerCase())
    );

    return (
        <BlogLayout>
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                {/* Blog Header */}
                <div className="mb-8">
                    <h1 className="text-4xl font-bold text-gray-900 mb-4">Blog</h1>
                    <div className="flex items-center text-sm text-gray-500">
                        <a href="/" className="hover:text-gray-700">Home</a>
                        <span className="mx-2">/</span>
                        <a href="/blog" className="hover:text-gray-700">Blog</a>
                        <span className="mx-2">/</span>
                        <span>List Sidebar</span>
                    </div>
                </div>

                <div className="flex flex-col lg:flex-row gap-8">
                    {/* Sidebar */}
                    <div className="lg:w-1/4">
                        <div className="sticky top-24 space-y-8">
                            {/* Search */}
                            <div className="bg-white p-6 rounded-lg shadow-sm">
                                <h3 className="font-semibold mb-4">Search</h3>
                                <div className="relative">
                                    <input
                                        type="search"
                                        placeholder="Search..."
                                        value={searchQuery}
                                        onChange={(e) => setSearchQuery(e.target.value)}
                                        className="w-full px-4 py-2 pr-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-200 focus:border-gray-400"
                                    />
                                    <button className="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                        <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <Categories />

                            {/* Top Posts */}
                            <div className="bg-white p-6 rounded-lg shadow-sm">
                                <h3 className="font-semibold mb-4">Top Posts</h3>
                                <div className="space-y-4">
                                    {articles.slice(0, 5).map((article, index) => (
                                        <div key={index} className="flex items-start space-x-2">
                                            <span className="text-lg font-bold text-gray-300 mt-1">{index + 1}</span>
                                            <div>
                                                <a href={`/blog/${article.slug}`} className="text-sm font-medium text-gray-900 hover:text-gray-600 line-clamp-2">
                                                    {article.title}
                                                </a>
                                                <p className="text-xs text-gray-500 mt-1">
                                                    {new Date(article.date).toLocaleDateString('en-US', {
                                                        month: 'long',
                                                        day: 'numeric',
                                                        year: 'numeric'
                                                    })}
                                                </p>
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            </div>

                            {/* Instagram */}
                            <div className="bg-white p-6 rounded-lg shadow-sm">
                                <h3 className="font-semibold mb-4">Instagram</h3>
                                <div className="grid grid-cols-3 gap-2">
                                    {Array.from({length: 9}, (_, i) => (
                                        <div key={i} className="aspect-square bg-gray-200 rounded"></div>
                                    ))}
                                </div>
                            </div>
                        </div>
                    </div>

                    {/* Main Content */}
                    <div className="lg:w-3/4">
                        {filteredArticles.length > 0 ? (
                            <>
                                {/* Articles Grid */}
                                <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    {filteredArticles.map((article, index) => (
                                        <div
                                            key={article.slug}
                                            className="opacity-0 animate-fade-up"
                                            style={{
                                                animationDelay: `${index * 100}ms`,
                                                animationFillMode: 'forwards'
                                            }}
                                        >
                                            <ArticleCard {...article} />
                                        </div>
                                    ))}
                                </div>

                                {/* Pagination */}
                                <div className="mt-12 flex justify-center">
                                    <nav className="flex items-center space-x-1">
                                        {[1, 2, 3, 4, '...'].map((page, index) => (
                                            <button
                                                key={index}
                                                className={`
                                                    w-10 h-10 flex items-center justify-center text-sm transition-colors duration-200
                                                    ${page === 1
                                                        ? 'bg-gray-900 text-white'
                                                        : 'text-gray-700 hover:bg-gray-100'
                                                    }
                                                    ${page === '...' ? 'cursor-default' : 'hover:bg-gray-100'}
                                                `}
                                            >
                                                {page}
                                            </button>
                                        ))}
                                    </nav>
                                </div>
                            </>
                        ) : (
                            <div className="text-center py-12">
                                <div className="mb-8">
                                    <svg className="w-24 h-24 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={1} d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <h3 className="text-xl font-medium text-gray-900 mb-2">No articles found</h3>
                                <p className="text-gray-600 mb-6">
                                    {searchQuery ? 'No articles match your search.' : 'No articles have been published yet.'}
                                </p>
                                {searchQuery && (
                                    <button
                                        onClick={() => setSearchQuery('')}
                                        className="text-blue-600 hover:text-blue-700 font-medium"
                                    >
                                        Clear search
                                    </button>
                                )}
                            </div>
                        )}
                    </div>
                </div>
            </div>
        </BlogLayout>
    );
} 