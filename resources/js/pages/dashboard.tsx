import { PlaceholderPattern } from '@/components/ui/placeholder-pattern';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

interface Article {
    id: number;
    title: string;
    author: string;
    published_at: string;
    created_at: string;
    image?: string;
    excerpt: string;
}

interface User {
    id: number;
    name: string;
    email: string;
}

interface Stats {
    totalArticles: number;
    recentArticles: number;
    quickActions: number;
}

interface DashboardProps {
    user: User;
    stats: Stats;
    recentArticles: Article[];
}

export default function Dashboard({ user, stats, recentArticles }: DashboardProps) {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard" />
            <div className="flex h-full flex-1 flex-col gap-6 rounded-xl p-4">
                {/* Welcome Section */}
                <div className="bg-white p-6 rounded-lg shadow-sm">
                    <h1 className="text-2xl font-bold text-gray-900 mb-2">
                        Welcome back, {user.name}!
                    </h1>
                    <p className="text-gray-600">
                        Here's what's happening with your blog articles.
                    </p>
                </div>

                {/* Stats Grid */}
                <div className="grid auto-rows-min gap-4 md:grid-cols-3">
                    <div className="bg-white p-6 rounded-lg shadow-sm">
                        <div className="flex items-center justify-between">
                            <div>
                                <p className="text-sm font-medium text-gray-600">Total Articles</p>
                                <p className="text-3xl font-bold text-gray-900">{stats.totalArticles}</p>
                            </div>
                            <div className="p-3 bg-blue-100 rounded-full">
                                <svg className="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div className="bg-white p-6 rounded-lg shadow-sm">
                        <div className="flex items-center justify-between">
                            <div>
                                <p className="text-sm font-medium text-gray-600">Recent Articles</p>
                                <p className="text-3xl font-bold text-gray-900">{stats.recentArticles}</p>
                            </div>
                            <div className="p-3 bg-green-100 rounded-full">
                                <svg className="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div className="bg-white p-6 rounded-lg shadow-sm">
                        <div className="flex items-center justify-between">
                            <div>
                                <p className="text-sm font-medium text-gray-600">Quick Actions</p>
                                <div className="mt-2 space-x-2">
                                    <Link
                                        href="/dashboard/articles/create"
                                        className="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors"
                                    >
                                        New Article
                                    </Link>
                                </div>
                            </div>
                            <div className="p-3 bg-purple-100 rounded-full">
                                <svg className="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Recent Articles */}
                <div className="bg-white rounded-lg shadow-sm">
                    <div className="p-6 border-b border-gray-200">
                        <div className="flex items-center justify-between">
                            <h2 className="text-lg font-semibold text-gray-900">Recent Articles</h2>
                            <Link
                                href="/dashboard/articles"
                                className="text-blue-600 hover:text-blue-700 font-medium"
                            >
                                View All
                            </Link>
                        </div>
                    </div>
                    
                    {recentArticles.length > 0 ? (
                        <div className="p-6">
                            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                {recentArticles.map((article) => (
                                    <div key={article.id} className="group border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                                        {article.image && (
                                            <div className="aspect-w-16 aspect-h-9">
                                                <img
                                                    src={article.image}
                                                    alt={article.title}
                                                    className="w-full h-32 object-cover group-hover:opacity-90 transition-opacity"
                                                />
                                            </div>
                                        )}
                                        <div className="p-4">
                                            <h3 className="font-semibold text-gray-900 mb-2 line-clamp-2">
                                                {article.title}
                                            </h3>
                                            <p className="text-sm text-gray-600 mb-3 line-clamp-2">
                                                {article.excerpt}
                                            </p>
                                            <div className="flex items-center justify-between text-xs text-gray-500">
                                                <span>By {article.author}</span>
                                                <span>{article.published_at || article.created_at}</span>
                                            </div>
                                        </div>
                                    </div>
                                ))}
                            </div>
                        </div>
                    ) : (
                        <div className="p-12 text-center">
                            <svg className="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <h3 className="text-lg font-medium text-gray-900 mb-2">No articles yet</h3>
                            <p className="text-gray-600 mb-4">Get started by creating your first article.</p>
                            <Link
                                href="/dashboard/articles/create"
                                className="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors"
                            >
                                Create Article
                            </Link>
                        </div>
                    )}
                </div>
            </div>
        </AppLayout>
    );
}
