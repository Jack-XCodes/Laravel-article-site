import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, usePage, useForm } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
    {
        title: 'Articles',
        href: '/dashboard/articles',
    },
];

interface Article {
    id: number;
    title: string;
    slug: string;
    content: string;
    author: string;
    published_at: string;
    created_at: string;
    image?: string;
    excerpt: string;
    is_published: boolean;
}

interface ArticlesProps {
    articles: {
        data: Article[];
        links: any[];
        meta: any;
    };
}

export default function Articles({ articles }: ArticlesProps) {
    const { props } = usePage();
    const successMessage = props.flash?.success;

    const { put, processing } = useForm();

    const togglePublish = (articleId: number, isPublished: boolean) => {
        const action = isPublished ? 'unpublish' : 'publish';
        put(`/dashboard/articles/${articleId}/${action}`, {
            preserveScroll: true,
        });
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Articles - Dashboard" />
            <div className="flex h-full flex-1 flex-col gap-6 rounded-xl p-4">
                {/* Success Message */}
                {successMessage && (
                    <div className="bg-green-50 border border-green-200 rounded-lg p-4">
                        <div className="flex items-center">
                            <svg className="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p className="text-green-800 font-medium">{successMessage}</p>
                        </div>
                    </div>
                )}

                {/* Header */}
                <div className="bg-white p-6 rounded-lg shadow-sm">
                    <div className="flex items-center justify-between">
                        <div>
                            <h1 className="text-2xl font-bold text-gray-900 mb-2">
                                Articles Management
                            </h1>
                            <p className="text-gray-600">
                                Manage all your blog articles. Edit content, publish, or unpublish articles.
                            </p>
                        </div>
                        <Link
                            href="/dashboard/articles/create"
                            className="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors"
                        >
                            <svg className="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            New Article
                        </Link>
                    </div>
                </div>

                {/* Articles Grid */}
                {articles.data.length > 0 ? (
                    <div className="bg-white rounded-lg shadow-sm">
                        <div className="p-6">
                            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                {articles.data.map((article) => (
                                    <div key={article.id} className="group border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                                        {article.image && (
                                            <div className="aspect-w-16 aspect-h-9">
                                                <img
                                                    src={article.image}
                                                    alt={article.title}
                                                    className="w-full h-48 object-cover group-hover:opacity-90 transition-opacity"
                                                />
                                            </div>
                                        )}
                                        <div className="p-4">
                                            <div className="flex items-start justify-between mb-2">
                                                <h3 className="font-semibold text-gray-900 line-clamp-2 flex-1">
                                                    {article.title}
                                                </h3>
                                                <span className={`ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium flex-shrink-0 ${
                                                    article.is_published 
                                                        ? 'bg-green-100 text-green-800' 
                                                        : 'bg-yellow-100 text-yellow-800'
                                                }`}>
                                                    {article.is_published ? 'Published' : 'Draft'}
                                                </span>
                                            </div>
                                            <p className="text-sm text-gray-600 mb-3 line-clamp-3">
                                                {article.excerpt}
                                            </p>
                                            <div className="flex items-center justify-between text-xs text-gray-500 mb-4">
                                                <span>By {article.author}</span>
                                                <span>{article.published_at || article.created_at}</span>
                                            </div>
                                            <div className="flex items-center justify-between">
                                                <div className="flex space-x-2">
                                                    <Link
                                                        href={`/dashboard/articles/${article.id}/edit`}
                                                        className="inline-flex items-center px-3 py-1.5 text-sm font-medium bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors"
                                                    >
                                                        <svg className="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                        Edit
                                                    </Link>
                                                    <button 
                                                        onClick={() => togglePublish(article.id, article.is_published)}
                                                        disabled={processing}
                                                        className={`inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md transition-colors disabled:opacity-50 ${
                                                            article.is_published
                                                                ? 'bg-yellow-600 text-white hover:bg-yellow-700'
                                                                : 'bg-green-600 text-white hover:bg-green-700'
                                                        }`}
                                                    >
                                                        <svg className="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d={
                                                                article.is_published 
                                                                    ? "M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"
                                                                    : "M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                                                            } />
                                                        </svg>
                                                        {article.is_published ? 'Unpublish' : 'Publish'}
                                                    </button>
                                                </div>
                                                {article.is_published && (
                                                    <a
                                                        href={`/blog/${article.slug}`}
                                                        target="_blank"
                                                        rel="noopener noreferrer"
                                                        className="text-gray-600 hover:text-gray-700"
                                                        title="View published article"
                                                    >
                                                        <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                        </svg>
                                                    </a>
                                                )}
                                            </div>
                                        </div>
                                    </div>
                                ))}
                            </div>
                        </div>

                        {/* Pagination */}
                        {articles.links && articles.links.length > 3 && (
                            <div className="p-6 border-t border-gray-200">
                                <div className="flex items-center justify-center space-x-2">
                                    {articles.links.map((link, index) => (
                                        <Link
                                            key={index}
                                            href={link.url || '#'}
                                            className={`
                                                px-3 py-2 text-sm rounded-lg transition-colors
                                                ${link.active 
                                                    ? 'bg-blue-600 text-white' 
                                                    : 'text-gray-600 hover:bg-gray-100'
                                                }
                                                ${!link.url ? 'opacity-50 cursor-not-allowed' : ''}
                                            `}
                                            dangerouslySetInnerHTML={{ __html: link.label }}
                                        />
                                    ))}
                                </div>
                            </div>
                        )}
                    </div>
                ) : (
                    <div className="bg-white rounded-lg shadow-sm p-12 text-center">
                        <svg className="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 className="text-xl font-medium text-gray-900 mb-2">No articles found</h3>
                        <p className="text-gray-600 mb-6">You haven't created any articles yet. Start by creating your first article.</p>
                        <Link
                            href="/dashboard/articles/create"
                            className="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors"
                        >
                            <svg className="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Create Your First Article
                        </Link>
                    </div>
                )}
            </div>
        </AppLayout>
    );
} 