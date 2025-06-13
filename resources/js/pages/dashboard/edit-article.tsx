import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm } from '@inertiajs/react';
import { FormEventHandler, useState } from 'react';

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
        title: 'Edit Article',
        href: '#',
    },
];

interface Article {
    id: number;
    title: string;
    content: string;
    author: string;
    image?: string;
    published_at?: string;
}

interface EditArticleProps {
    article: Article;
}

export default function EditArticle({ article }: EditArticleProps) {
    const [showPreview, setShowPreview] = useState(true);
    const [isFullscreen, setIsFullscreen] = useState(false);
    const { data, setData, put, processing, errors, wasSuccessful } = useForm({
        title: article.title,
        content: article.content,
        author: article.author,
        image: article.image || '',
        is_published: !!article.published_at,
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        put(`/dashboard/articles/${article.id}`, {
            onSuccess: () => {
                // Success message will be handled by the backend redirect
            },
        });
    };

    const publishArticle = () => {
        put(`/dashboard/articles/${article.id}/publish`, {
            onSuccess: () => {
                // Success message will be handled by the backend redirect
            },
        });
    };

    const unpublishArticle = () => {
        put(`/dashboard/articles/${article.id}/unpublish`, {
            onSuccess: () => {
                // Success message will be handled by the backend redirect
            },
        });
    };

    const insertText = (before: string, after: string = '') => {
        const textarea = document.getElementById('content') as HTMLTextAreaElement;
        if (textarea) {
            const start = textarea.selectionStart;
            const end = textarea.selectionEnd;
            const selectedText = textarea.value.substring(start, end);
            const replacement = before + selectedText + after;
            
            const newContent = textarea.value.substring(0, start) + replacement + textarea.value.substring(end);
            setData('content', newContent);
            
            // Set cursor position after insertion
            setTimeout(() => {
                textarea.focus();
                if (selectedText) {
                    textarea.setSelectionRange(start + before.length, start + before.length + selectedText.length);
                } else {
                    textarea.setSelectionRange(start + before.length, start + before.length);
                }
            }, 0);
        }
    };

    const formatContent = (content: string) => {
        return content.split('\n').map((paragraph, index) => {
            // Handle headers
            if (paragraph.startsWith('# ')) {
                return <h1 key={index} className="text-2xl font-bold mb-4 text-gray-900">{paragraph.slice(2)}</h1>;
            }
            if (paragraph.startsWith('## ')) {
                return <h2 key={index} className="text-xl font-semibold mb-3 text-gray-900">{paragraph.slice(3)}</h2>;
            }
            if (paragraph.startsWith('### ')) {
                return <h3 key={index} className="text-lg font-medium mb-2 text-gray-900">{paragraph.slice(4)}</h3>;
            }
            
            // Handle bold text
            let formattedText = paragraph.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
            // Handle italic text
            formattedText = formattedText.replace(/\*(.*?)\*/g, '<em>$1</em>');
            // Handle links
            formattedText = formattedText.replace(/\[([^\]]+)\]\(([^)]+)\)/g, '<a href="$2" class="text-blue-600 hover:underline">$1</a>');
            
            if (paragraph.trim() === '') {
                return <br key={index} />;
            }
            
            return (
                <p key={index} className="mb-4 text-gray-700 leading-relaxed" dangerouslySetInnerHTML={{ __html: formattedText }} />
            );
        });
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={`Edit Article: ${article.title} - Dashboard`} />
            <div className={`flex h-full flex-1 flex-col gap-6 rounded-xl p-4 ${isFullscreen ? 'fixed inset-0 z-50 bg-white' : ''}`}>
                {/* Header */}
                <div className="bg-white p-6 rounded-lg shadow-sm">
                    <div className="flex items-center justify-between">
                        <div>
                            <div className="flex items-center gap-3 mb-2">
                                <h1 className="text-2xl font-bold text-gray-900">
                                    Edit Article: {data.title}
                                </h1>
                                <span className={`inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${
                                    article.published_at 
                                        ? 'bg-green-100 text-green-800' 
                                        : 'bg-yellow-100 text-yellow-800'
                                }`}>
                                    {article.published_at ? 'Published' : 'Draft'}
                                </span>
                            </div>
                            <p className="text-gray-600">
                                Update your article content. Use markdown formatting for better styling.
                            </p>
                        </div>
                        <div className="flex space-x-2">
                            {/* Publish/Unpublish Actions */}
                            {article.published_at ? (
                                <button
                                    type="button"
                                    onClick={unpublishArticle}
                                    disabled={processing}
                                    className="inline-flex items-center px-4 py-2 bg-yellow-600 text-white font-medium rounded-lg hover:bg-yellow-700 disabled:opacity-50 transition-colors"
                                >
                                    <svg className="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21" />
                                    </svg>
                                    Unpublish
                                </button>
                            ) : (
                                <button
                                    type="button"
                                    onClick={publishArticle}
                                    disabled={processing}
                                    className="inline-flex items-center px-4 py-2 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 disabled:opacity-50 transition-colors"
                                >
                                    <svg className="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                    Publish Now
                                </button>
                            )}
                            
                            <button
                                type="button"
                                onClick={() => setIsFullscreen(!isFullscreen)}
                                className="inline-flex items-center px-4 py-2 bg-purple-600 text-white font-medium rounded-lg hover:bg-purple-700 transition-colors"
                            >
                                <svg className="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d={isFullscreen ? "M9 9V4.5M9 9H4.5M9 9L3.5 3.5M15 15v4.5M15 15h4.5M15 15l4.5 4.5" : "M3.5 3.5l4.5 4.5M9 4.5V9M9 9H4.5M15 15l4.5 4.5M15 15v4.5M15 15h4.5"} />
                                </svg>
                                {isFullscreen ? 'Exit Fullscreen' : 'Fullscreen'}
                            </button>
                            <button
                                type="button"
                                onClick={() => setShowPreview(!showPreview)}
                                className="inline-flex items-center px-4 py-2 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-colors"
                            >
                                <svg className="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                {showPreview ? 'Hide Preview' : 'Show Preview'}
                            </button>
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
                </div>

                <div className={`grid gap-6 ${showPreview ? 'grid-cols-1 lg:grid-cols-2' : 'grid-cols-1'}`}>
                    {/* Form */}
                    <div className="bg-white rounded-lg shadow-sm">
                        <div className="p-6 border-b border-gray-200">
                            <h2 className="text-lg font-semibold text-gray-900">Edit Content</h2>
                        </div>
                        <form onSubmit={submit} className="p-6 space-y-6">
                            {/* Publication Status */}
                            <div className="bg-gray-50 p-4 rounded-lg">
                                <div className="flex items-center justify-between">
                                    <div>
                                        <h3 className="text-sm font-medium text-gray-900">Publication Status</h3>
                                        <p className="text-sm text-gray-600">
                                            {article.published_at 
                                                ? `Published on ${new Date(article.published_at).toLocaleDateString()}`
                                                : 'This article is currently a draft'
                                            }
                                        </p>
                                    </div>
                                    <div className="flex items-center">
                                        <input
                                            id="is_published"
                                            type="checkbox"
                                            checked={data.is_published}
                                            onChange={(e) => setData('is_published', e.target.checked)}
                                            className="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded bg-white"
                                        />
                                        <label htmlFor="is_published" className="ml-2 text-sm text-gray-900">
                                            Published
                                        </label>
                                    </div>
                                </div>
                            </div>

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
                                        className="w-full px-4 py-3 text-lg text-black bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Enter article title..."
                                        required
                                    />
                                {errors.title && <p className="mt-1 text-sm text-red-600">{errors.title}</p>}
                            </div>

                            {/* Author */}
                            <div>
                                <label htmlFor="author" className="block text-sm font-medium text-gray-700 mb-2">
                                    Author
                                </label>
                                <input
                                    id="author"
                                    type="text"
                                    value={data.author}
                                    onChange={(e) => setData('author', e.target.value)}
                                    className="w-full px-4 py-2 text-black bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Author name..."
                                    required
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

                            {/* Formatting Toolbar */}
                            <div>
                                <label className="block text-sm font-medium text-gray-700 mb-2">
                                    Article Content
                                </label>
                                <div className="border border-gray-300 rounded-lg overflow-hidden">
                                    {/* Toolbar */}
                                    <div className="bg-gray-50 px-4 py-2 border-b border-gray-200 flex flex-wrap gap-2">
                                        <button
                                            type="button"
                                            onClick={() => insertText('**', '**')}
                                            className="px-3 py-1 text-sm bg-white border border-gray-300 rounded hover:bg-gray-100 font-bold"
                                            title="Bold"
                                        >
                                            B
                                        </button>
                                        <button
                                            type="button"
                                            onClick={() => insertText('*', '*')}
                                            className="px-3 py-1 text-sm bg-white border border-gray-300 rounded hover:bg-gray-100 italic"
                                            title="Italic"
                                        >
                                            I
                                        </button>
                                        <button
                                            type="button"
                                            onClick={() => insertText('# ', '')}
                                            className="px-3 py-1 text-sm bg-white border border-gray-300 rounded hover:bg-gray-100"
                                            title="Heading 1"
                                        >
                                            H1
                                        </button>
                                        <button
                                            type="button"
                                            onClick={() => insertText('## ', '')}
                                            className="px-3 py-1 text-sm bg-white border border-gray-300 rounded hover:bg-gray-100"
                                            title="Heading 2"
                                        >
                                            H2
                                        </button>
                                        <button
                                            type="button"
                                            onClick={() => insertText('### ', '')}
                                            className="px-3 py-1 text-sm bg-white border border-gray-300 rounded hover:bg-gray-100"
                                            title="Heading 3"
                                        >
                                            H3
                                        </button>
                                        <button
                                            type="button"
                                            onClick={() => insertText('[Link Text](', ')')}
                                            className="px-3 py-1 text-sm bg-white border border-gray-300 rounded hover:bg-gray-100"
                                            title="Link"
                                        >
                                            🔗
                                        </button>
                                    </div>
                                    
                                    {/* Content Textarea */}
                                    <textarea
                                        id="content"
                                        value={data.content}
                                        onChange={(e) => setData('content', e.target.value)}
                                        rows={isFullscreen ? 30 : 20}
                                        className="w-full px-4 py-3 border-0 focus:outline-none focus:ring-0 font-mono text-sm resize-none text-black bg-white"
                                        placeholder="Write your article content here... Use markdown formatting:

# Heading 1
## Heading 2
### Heading 3

**Bold text**
*Italic text*
[Link text](http://example.com)

Just start typing and see the live preview!"
                                        required
                                    />
                                </div>
                                {errors.content && <p className="mt-1 text-sm text-red-600">{errors.content}</p>}
                                <div className="mt-2 flex justify-between text-xs text-gray-500">
                                    <span>{data.content.length} characters</span>
                                    <span>{data.content.split('\n').length} lines</span>
                                </div>
                            </div>

                            {/* Submit Buttons */}
                            <div className="flex items-center justify-between pt-6 border-t border-gray-200">
                                <Link
                                    href="/dashboard/articles"
                                    className="px-6 py-2 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors"
                                >
                                    Cancel
                                </Link>
                                <div className="flex space-x-3">
                                    <button
                                        type="submit"
                                        disabled={processing}
                                        className="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
                                    >
                                        {processing ? (
                                            <span className="flex items-center">
                                                <svg className="animate-spin -ml-1 mr-3 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                                    <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4"></circle>
                                                    <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                </svg>
                                                Saving...
                                            </span>
                                        ) : (
                                            'Save Changes'
                                        )}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    {/* Preview */}
                    {showPreview && (
                        <div className="bg-white rounded-lg shadow-sm">
                            <div className="p-6 border-b border-gray-200">
                                <div className="flex items-center justify-between">
                                    <h2 className="text-lg font-semibold text-gray-900">Live Preview</h2>
                                    <span className={`inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${
                                        data.is_published 
                                            ? 'bg-green-100 text-green-800' 
                                            : 'bg-yellow-100 text-yellow-800'
                                    }`}>
                                        {data.is_published ? 'Will be Published' : 'Will be Draft'}
                                    </span>
                                </div>
                            </div>
                            <div className="p-6 max-h-screen overflow-y-auto">
                                {data.content ? (
                                    <div>
                                        {data.image && (
                                            <div className="mb-6">
                                                <img
                                                    src={data.image}
                                                    alt={data.title}
                                                    className="w-full h-64 object-cover rounded-lg"
                                                    onError={(e) => {
                                                        e.currentTarget.style.display = 'none';
                                                    }}
                                                />
                                            </div>
                                        )}
                                        <h1 className="text-3xl font-bold text-gray-900 mb-3">
                                            {data.title || 'Article Title'}
                                        </h1>
                                        <p className="text-sm text-gray-600 mb-6">
                                            By {data.author || 'Author Name'}
                                        </p>
                                        <div className="prose prose-gray max-w-none">
                                            {formatContent(data.content)}
                                        </div>
                                    </div>
                                ) : (
                                    <div className="text-center py-12">
                                        <svg className="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <p className="text-gray-500">Start writing to see the preview</p>
                                    </div>
                                )}
                            </div>
                        </div>
                    )}
                </div>
            </div>
        </AppLayout>
    );
} 