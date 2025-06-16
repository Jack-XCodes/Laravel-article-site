@extends('app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-white dark:from-gray-800 dark:to-gray-900 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="bg-gradient-to-r from-blue-600 to-yellow-500 rounded-2xl p-8 text-white relative overflow-hidden">
                <div class="absolute inset-0 bg-black/10"></div>
                <div class="relative">
                    <h1 class="text-3xl md:text-4xl font-bold mb-2 font-['Playfair_Display']">
                        Edit Article ✏️
                    </h1>
                    <p class="text-blue-100 text-lg">
                        Update and refine your content
                    </p>
                </div>
                <!-- Background Decorations -->
                <div class="absolute top-0 right-0 w-24 h-24 bg-yellow-400/20 rounded-full translate-x-12 -translate-y-12"></div>
                <div class="absolute bottom-0 left-0 w-20 h-20 bg-blue-400/20 rounded-full -translate-x-10 translate-y-10"></div>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <form method="POST" action="{{ route('dashboard.update-article', $article['id']) }}" class="p-8">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Article Title *
                    </label>
                    <input type="text" 
                           id="title" 
                           name="title" 
                           value="{{ old('title', $article['title']) }}" 
                           required
                           class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200 text-lg font-semibold"
                           placeholder="Enter your article title...">
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Author -->
                <div class="mb-6">
                    <label for="author" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Author *
                    </label>
                    <input type="text" 
                           id="author" 
                           name="author" 
                           value="{{ old('author', $article['author']) }}" 
                           required
                           class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200"
                           placeholder="Author name">
                    @error('author')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Featured Image -->
                <div class="mb-6">
                    <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Featured Image URL
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <input type="url" 
                               id="image" 
                               name="image" 
                               value="{{ old('image', $article['image']) }}"
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200"
                               placeholder="https://example.com/image.jpg">
                    </div>
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    
                    <!-- Image Preview -->
                    @if($article['image'])
                        <div class="mt-3">
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">Current image:</p>
                            <img src="{{ $article['image'] }}" 
                                 alt="Current featured image" 
                                 class="h-32 w-auto rounded-xl border border-gray-200 dark:border-gray-600 object-cover">
                        </div>
                    @endif
                </div>

                <!-- Content -->
                <div class="mb-8">
                    <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Article Content *
                    </label>
                    <div class="relative">
                        <textarea id="content" 
                                  name="content" 
                                  required
                                  rows="16"
                                  class="block w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200 resize-none"
                                  placeholder="Start writing your article content here...">{{ old('content', $article['content']) }}</textarea>
                    </div>
                    @error('content')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    
                    <!-- Content Tips -->
                    <div class="mt-4 p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-700 rounded-xl">
                        <h4 class="text-sm font-medium text-blue-800 dark:text-blue-400 mb-2">Editing Tips:</h4>
                        <ul class="text-xs text-blue-700 dark:text-blue-300 space-y-1">
                            <li>• Review your content for clarity and flow</li>
                            <li>• Check for any spelling or grammatical errors</li>
                            <li>• Ensure your headings and structure are well-organized</li>
                            <li>• Update images and links as needed</li>
                        </ul>
                    </div>
                </div>

                <!-- Publication Status -->
                <div class="mb-8 p-6 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-gray-200 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Publication Status
                    </h3>
                    
                    <div class="space-y-4">
                        <!-- Current Status -->
                        <div class="flex items-center justify-between p-3 bg-white dark:bg-gray-600 rounded-lg">
                            <span class="text-sm text-gray-700 dark:text-gray-300">Current Status:</span>
                            @if($article['published_at'])
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    Published
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-400">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    Draft
                                </span>
                            @endif
                        </div>

                        <!-- Publication Toggle -->
                        <div class="flex items-center">
                            <input type="checkbox" 
                                   id="is_published" 
                                   name="is_published" 
                                   value="1"
                                   {{ old('is_published', $article['published_at'] ? '1' : '0') == '1' ? 'checked' : '' }}
                                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="is_published" class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                                <span class="font-medium">Publish this article</span>
                                <span class="block text-xs text-gray-500 dark:text-gray-400">
                                    Check to make this article visible to the public
                                </span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <button type="submit" 
                            class="flex-1 inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-blue-600 to-yellow-500 hover:from-blue-700 hover:to-yellow-600 text-white font-medium rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Update Article
                    </button>
                    
                    <!-- Preview Button (if published) -->
                    @if($article['published_at'])
                        <a href="{{ route('articles.show', ['article' => $article['id']]) }}" 
                           target="_blank"
                           class="flex-1 inline-flex items-center justify-center px-8 py-4 bg-green-100 dark:bg-green-900/20 text-green-700 dark:text-green-400 hover:bg-green-200 dark:hover:bg-green-900/40 font-medium rounded-xl transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            Preview Live
                        </a>
                    @endif
                    
                    <a href="{{ route('dashboard.articles') }}" 
                       class="flex-1 inline-flex items-center justify-center px-8 py-4 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 font-medium rounded-xl transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Cancel
                    </a>
                </div>

                <!-- Danger Zone -->
                <div class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-600">
                    <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-700 rounded-xl p-6">
                        <h4 class="text-lg font-semibold text-red-800 dark:text-red-400 mb-2 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.865-.833-2.635 0L4.232 15.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                            Danger Zone
                        </h4>
                        <p class="text-red-700 dark:text-red-300 text-sm mb-4">
                            This action cannot be undone. This will permanently delete the article and all associated data.
                        </p>
                        <button type="button" 
                                onclick="deleteArticle({{ $article['id'] }}, '{{ addslashes($article['title']) }}')"
                                class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete Article
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Back to Dashboard -->
        <div class="mt-8 text-center">
            <a href="{{ route('dashboard') }}" 
               class="inline-flex items-center px-6 py-3 bg-white/20 hover:bg-white/30 text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 font-medium rounded-xl transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Dashboard
            </a>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 max-w-md mx-4">
        <div class="text-center">
            <div class="w-16 h-16 bg-red-100 dark:bg-red-900/20 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Delete Article</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-6">
                Are you sure you want to delete "<span id="articleTitle"></span>"? This action cannot be undone.
            </p>
            <div class="flex space-x-4">
                <button onclick="closeDeleteModal()" 
                        class="flex-1 px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium rounded-xl hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200">
                    Cancel
                </button>
                <form id="deleteForm" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="w-full px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-xl transition-colors duration-200">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Character count for content
const contentTextareaElement = document.getElementById('content');
if (contentTextareaElement) {
    const charCount = document.createElement('div');
    charCount.className = 'text-xs text-gray-500 dark:text-gray-400 mt-2 text-right';
    charCount.textContent = `${contentTextareaElement.value.length.toLocaleString()} characters`;
    
    contentTextareaElement.parentNode.appendChild(charCount);
    
    contentTextareaElement.addEventListener('input', function() {
        const count = this.value.length;
        charCount.textContent = `${count.toLocaleString()} characters`;
        
        if (count < 100) {
            charCount.className = 'text-xs text-red-500 dark:text-red-400 mt-2 text-right';
        } else if (count < 500) {
            charCount.className = 'text-xs text-yellow-500 dark:text-yellow-400 mt-2 text-right';
        } else {
            charCount.className = 'text-xs text-green-500 dark:text-green-400 mt-2 text-right';
        }
    });
    
    // Trigger initial count
    contentTextareaElement.dispatchEvent(new Event('input'));
}

function deleteArticle(id, title) {
    document.getElementById('articleTitle').textContent = title;
    document.getElementById('deleteForm').action = `/dashboard/articles/${id}`;
    document.getElementById('deleteModal').classList.remove('hidden');
    document.getElementById('deleteModal').classList.add('flex');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
    document.getElementById('deleteModal').classList.remove('flex');
}

// Close modal when clicking outside
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});
</script>
@endsection 