@extends('app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-white dark:from-gray-800 dark:to-gray-900 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- I made this header inspirational because writing should feel exciting! -->
        <div class="mb-8">
            <div class="bg-gradient-to-r from-blue-600 to-yellow-500 rounded-2xl p-8 text-white relative overflow-hidden">
                <div class="absolute inset-0 bg-black/10"></div>
                <div class="relative">
                    <h1 class="text-3xl md:text-4xl font-bold mb-2 font-['Playfair_Display']">
                        Create New Article ✍️
                    </h1>
                    <p class="text-blue-100 text-lg">
                        Share your thoughts and ideas with the world
                    </p>
                </div>
                <!-- Little decorative circles to make it feel more alive -->
                <div class="absolute top-0 right-0 w-24 h-24 bg-yellow-400/20 rounded-full translate-x-12 -translate-y-12"></div>
                <div class="absolute bottom-0 left-0 w-20 h-20 bg-blue-400/20 rounded-full -translate-x-10 translate-y-10"></div>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <form method="POST" action="{{ route('dashboard.store-article') }}" class="p-8">
                @csrf

                <!-- Title -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Article Title *
                    </label>
                    <input type="text" 
                           id="title" 
                           name="title" 
                           value="{{ old('title') }}" 
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
                           value="{{ old('author', auth()->user()->name) }}" 
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
                               value="{{ old('image') }}"
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200"
                               placeholder="https://example.com/image.jpg">
                    </div>
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 dark:text-gray-400 text-xs mt-1">
                        Optional: Add a featured image URL to make your article more visually appealing
                    </p>
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
                                  placeholder="Start writing your article content here...

You can use markdown formatting:
- **Bold text**
- *Italic text*
- # Headers
- [Links](https://example.com)
- Lists and more!

Share your knowledge, experiences, and insights with the community...">{{ old('content') }}</textarea>
                    </div>
                    @error('content')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    
                    <!-- Content Tips -->
                    <div class="mt-4 p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-700 rounded-xl">
                        <h4 class="text-sm font-medium text-blue-800 dark:text-blue-400 mb-2">Writing Tips:</h4>
                        <ul class="text-xs text-blue-700 dark:text-blue-300 space-y-1">
                            <li>• Start with an engaging introduction that hooks your readers</li>
                            <li>• Use clear headings and subheadings to organize your content</li>
                            <li>• Include examples and practical insights when possible</li>
                            <li>• End with a strong conclusion or call-to-action</li>
                        </ul>
                    </div>
                </div>

                <!-- I added this so users can choose to publish now or save as draft -->
                <div class="mb-8 p-6 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-gray-200 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Publication Options</h3>
                    
                    <div class="flex items-center">
                        <input type="checkbox" 
                               id="publish_now" 
                               name="publish_now" 
                               value="1"
                               {{ old('publish_now') ? 'checked' : '' }}
                               class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="publish_now" class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                            <span class="font-medium">Publish immediately</span>
                            <span class="block text-xs text-gray-500 dark:text-gray-400">
                                Uncheck to save as draft (you can publish later from the articles management page)
                            </span>
                        </label>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <button type="submit" 
                            class="flex-1 inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-blue-600 to-yellow-500 hover:from-blue-700 hover:to-yellow-600 text-white font-medium rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Create Article
                    </button>
                    
                    <a href="{{ route('dashboard.articles') }}" 
                       class="flex-1 inline-flex items-center justify-center px-8 py-4 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 font-medium rounded-xl transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Cancel
                    </a>
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

<script>
// I built this auto-save feature so users never lose their work (even though it's just a demo for now)
let autoSaveTimer;
const titleInput = document.getElementById('title');
const contentTextarea = document.getElementById('content');

function autoSave() {
    // This would save to localStorage or send to server - I left it as a console log for now
    console.log('Auto-saving draft...');
}

function scheduleAutoSave() {
    clearTimeout(autoSaveTimer);
    autoSaveTimer = setTimeout(autoSave, 5000); // Wait 5 seconds of no typing before saving
}

titleInput?.addEventListener('input', scheduleAutoSave);
contentTextarea?.addEventListener('input', scheduleAutoSave);

// I added a character counter because writers like to know how much they've written
const contentTextareaElement = document.getElementById('content');
if (contentTextareaElement) {
    const charCount = document.createElement('div');
    charCount.className = 'text-xs text-gray-500 dark:text-gray-400 mt-2 text-right';
    charCount.textContent = '0 characters';
    
    contentTextareaElement.parentNode.appendChild(charCount);
    
    contentTextareaElement.addEventListener('input', function() {
        const count = this.value.length;
        charCount.textContent = `${count.toLocaleString()} characters`;
        
        // I made the counter change colors to encourage longer content
        if (count < 100) {
            charCount.className = 'text-xs text-red-500 dark:text-red-400 mt-2 text-right';
        } else if (count < 500) {
            charCount.className = 'text-xs text-yellow-500 dark:text-yellow-400 mt-2 text-right';
        } else {
            charCount.className = 'text-xs text-green-500 dark:text-green-400 mt-2 text-right';
        }
    });
}
</script>
@endsection 