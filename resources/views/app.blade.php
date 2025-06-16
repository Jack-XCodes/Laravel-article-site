<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @class(['dark' => ($appearance ?? 'system') == 'dark'])>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- Inline script to detect system dark mode preference and apply it immediately --}}
        <script>
            (function() {
                const appearance = '{{ $appearance ?? "system" }}';

                if (appearance === 'system') {
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

                    if (prefersDark) {
                        document.documentElement.classList.add('dark');
                    }
                }
            })();
        </script>

        {{-- Custom theme colors --}}
        <style>
            html {
                background: linear-gradient(135deg, #3b82f6 0%, #f59e0b 100%);
            }

            html.dark {
                background: linear-gradient(135deg, #1e3a8a 0%, #92400e 100%);
            }

            .blog-gradient {
                background: linear-gradient(135deg, #3b82f6 0%, #f59e0b 100%);
            }

            .blog-gradient-dark {
                background: linear-gradient(135deg, #1e3a8a 0%, #92400e 100%);
            }

            .text-gradient {
                background: linear-gradient(135deg, #3b82f6 0%, #f59e0b 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .card-hover {
                transition: all 0.3s ease;
            }

            .card-hover:hover {
                transform: translateY(-4px);
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            }

            .dark .card-hover:hover {
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.4), 0 10px 10px -5px rgba(0, 0, 0, 0.2);
            }
        </style>

        <title>{{ $title ?? config('app.name', 'Laravel') }} - Modern Blog</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|playfair-display:400,500,600,700" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased min-h-screen bg-gradient-to-br from-blue-500 to-yellow-500 dark:from-blue-900 dark:to-yellow-800">
        <!-- Navigation -->
        <nav class="bg-white/95 dark:bg-gray-900/95 backdrop-blur-sm shadow-lg border-b border-blue-200 dark:border-yellow-600/30 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <!-- Logo -->
                        <a href="{{ route('home') }}" class="flex items-center group">
                            <div class="w-8 h-8 bg-gradient-to-br from-blue-600 to-yellow-500 rounded-lg mr-3 flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                </svg>
                            </div>
                            <span class="text-xl font-bold text-gradient group-hover:scale-105 transition-transform font-['Playfair_Display']">
                                {{ config('app.name', 'ModernBlog') }}
                            </span>
                        </a>
                        
                        <!-- Navigation Links -->
                        <div class="hidden sm:ml-8 sm:flex sm:space-x-8">
                            <a href="{{ route('home') }}" 
                               class="border-transparent text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-yellow-400 hover:border-blue-600 dark:hover:border-yellow-400 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                Home
                            </a>
                            @auth
                                <a href="{{ route('dashboard') }}" 
                                   class="border-transparent text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-yellow-400 hover:border-blue-600 dark:hover:border-yellow-400 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                    Dashboard
                                </a>
                                <a href="{{ route('dashboard.articles') }}" 
                                   class="border-transparent text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-yellow-400 hover:border-blue-600 dark:hover:border-yellow-400 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Articles
                                </a>
                            @endauth
                        </div>
                    </div>

                    <!-- Right Side -->
                    <div class="flex items-center space-x-4">
                        @auth
                            <!-- User Menu -->
                            <div class="relative flex items-center space-x-3">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-gradient-to-br from-blue-600 to-yellow-500 rounded-full flex items-center justify-center">
                                        <span class="text-white text-sm font-medium">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                    </div>
                                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300 font-medium">
                                        Welcome, {{ auth()->user()->name }}
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Logout -->
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" 
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-lg text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-yellow-400 hover:bg-blue-50 dark:hover:bg-yellow-900/20 transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" 
                               class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-yellow-400 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                </svg>
                                Login
                            </a>
                            <a href="{{ route('register') }}" 
                               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-yellow-500 hover:from-blue-700 hover:to-yellow-600 text-white text-sm font-medium rounded-lg shadow-md hover:shadow-lg transition-all duration-200 transform hover:scale-105">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                                Register
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="relative z-10">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white/95 dark:bg-gray-900/95 backdrop-blur-sm border-t border-blue-200 dark:border-yellow-600/30 mt-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <h3 class="text-lg font-semibold text-gradient font-['Playfair_Display'] mb-4">{{ config('app.name', 'ModernBlog') }}</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            A modern blog platform built with Laravel, Livewire, and Tailwind CSS.
                        </p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Quick Links</h3>
                        <ul class="space-y-2">
                            <li><a href="{{ route('home') }}" class="text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-yellow-400 transition-colors">Home</a></li>
                            @auth
                                <li><a href="{{ route('dashboard') }}" class="text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-yellow-400 transition-colors">Dashboard</a></li>
                                <li><a href="{{ route('dashboard.articles') }}" class="text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-yellow-400 transition-colors">Manage Articles</a></li>
                            @endauth
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">About</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Built with modern web technologies for the best user experience.
                        </p>
                    </div>
                </div>
                <div class="border-t border-gray-200 dark:border-gray-700 mt-8 pt-8 text-center">
                    <p class="text-gray-600 dark:text-gray-400">
                        © {{ date('Y') }} {{ config('app.name', 'ModernBlog') }}. Made with ❤️ using Laravel & Livewire.
                    </p>
                </div>
            </div>
        </footer>

        @livewireScripts
    </body>
</html>
