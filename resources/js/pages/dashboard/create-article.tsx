import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm } from '@inertiajs/react';
import { FormEventHandler } from 'react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
    {
        title: 'Articles',
        href: '/dashboard/articles',
    },
    {
        title: 'Create Article',
        href: '/dashboard/articles/create',
    },
];

export default function CreateArticle() {
    const { data, setData, post, processing, errors, reset } = useForm({
        title: '',
        content: '',
        author: '',
        image: '',
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        post('/dashboard/articles', {
            onSuccess: () => reset(),
        });
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Create Article - Dashboard" />
            <div className="flex h-full flex-1 flex-col gap-6 rounded-xl p-4">
                {/* Header */}
                <div className="bg-white p-6 rounded-lg shadow-sm">
                    <div className="flex items-center justify-between">
                        <div>
                            <h1 className="text-2xl font-bold text-gray-900 mb-2">
                                Create New Article
                            </h1>
                            <p className="text-gray-600">
                                Write and publish a new article for your blog.
                            </p>
                        </div>
                        <Link
                            href="/dashboard/articles"
                            className="inline-flex items-center px-4 py-2 bg-gray-600 text-white font-medium rounded-lg hover:bg-gray-700 transition-colors"
                        >
                            <svg className="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15 19l-7-7 7-7" />
                            </svg>
                            Back to Articles
                        </Link>
                    </div>
                </div>

                {/* Form */}
                <div className="bg-white rounded-lg shadow-sm">
                    <form onSubmit={submit} className="p-6 space-y-6">
                        {/* Title */}
                        <div>
                            <label htmlFor="title" className="block text-sm font-medium text-gray-700 mb-2">
                                Article Title
                            </label>
                            <input
                                id="title"
                                type="text"
                                value={data.title}
                                onChange={(e) => setData('title', e.target.value)}
                                className="w-full px-4 py-2 text-black bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Enter article title..."
                                required
                            />
                            {errors.title && <p className="mt-1 text-sm text-red-600">{errors.title}</p>}
                        </div>

                        {/* Author */}
                        <div>
                            <label htmlFor="author" className="block text-sm font-medium text-gray-700 mb-2">
                                Author (Optional)
                            </label>
                            <input
                                id="author"
                                type="text"
                                value={data.author}
                                onChange={(e) => setData('author', e.target.value)}
                                className="w-full px-4 py-2 text-black bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Author name (leave empty to use your name)..."
                            />
                            {errors.author && <p className="mt-1 text-sm text-red-600">{errors.author}</p>}
                        </div>

                        {/* Image URL */}
                        <div>
                            <label htmlFor="image" className="block text-sm font-medium text-gray-700 mb-2">
                                Featured Image URL (Optional)
                            </label>
                            <input
                                id="image"
                                type="url"
                                value={data.image}
                                onChange={(e) => setData('image', e.target.value)}
                                className="w-full px-4 py-2 text-black bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="https://example.com/image.jpg"
                            />
                            {errors.image && <p className="mt-1 text-sm text-red-600">{errors.image}</p>}
                        </div>

                        {/* Content */}
                        <div>
                            <label htmlFor="content" className="block text-sm font-medium text-gray-700 mb-2">
                                Article Content
                            </label>
                            <textarea
                                id="content"
                                value={data.content}
                                onChange={(e) => setData('content', e.target.value)}
                                rows={12}
                                className="w-full px-4 py-2 text-black bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 font-mono"
                                placeholder="Write your article content here..."
                                required
                            />
                            {errors.content && <p className="mt-1 text-sm text-red-600">{errors.content}</p>}
                        </div>

                        {/* Preview */}
                        {data.content && (
                            <div>
                                <h3 className="text-sm font-medium text-gray-700 mb-2">Preview</h3>
                                <div className="border border-gray-200 rounded-lg p-4 bg-gray-50">
                                    <h4 className="text-lg font-semibold mb-2">{data.title || 'Article Title'}</h4>
                                    <p className="text-sm text-gray-600 mb-3">By {data.author || 'Your Name'}</p>
                                    <div className="prose prose-sm max-w-none">
                                        {data.content.split('\n').map((paragraph, index) => (
                                            <p key={index} className="mb-2">
                                                {paragraph}
                                            </p>
                                        ))}
                                    </div>
                                </div>
                            </div>
                        )}

                        {/* Submit Buttons */}
                        <div className="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                            <Link
                                href="/dashboard/articles"
                                className="px-6 py-2 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors"
                            >
                                Cancel
                            </Link>
                            <button
                                type="submit"
                                disabled={processing}
                                className="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
                            >
                                {processing ? 'Publishing...' : 'Publish Article'}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </AppLayout>
    );
} 