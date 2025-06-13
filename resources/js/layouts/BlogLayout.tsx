import React, { useState, useEffect } from 'react';

interface BlogLayoutProps {
    children: React.ReactNode;
}

export default function BlogLayout({ children }: BlogLayoutProps) {
    const [isScrolled, setIsScrolled] = useState(false);
    const [isMobileMenuOpen, setIsMobileMenuOpen] = useState(false);

    useEffect(() => {
        const handleScroll = () => {
            setIsScrolled(window.scrollY > 20);
        };
        window.addEventListener('scroll', handleScroll);
        return () => window.removeEventListener('scroll', handleScroll);
    }, []);

    return (
        <div className="min-h-screen bg-gray-50">
            <header className={`fixed w-full z-50 transition-all duration-300 ${
                isScrolled ? 'bg-white/95 backdrop-blur-sm shadow-sm' : 'bg-white'
            }`}>
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                    <div className="flex justify-between items-center">
                        <h1 className="text-2xl font-bold text-gray-900">
                            Sada.
                        </h1>
                        
                        {/* Mobile menu button */}
                        <button 
                            onClick={() => setIsMobileMenuOpen(!isMobileMenuOpen)}
                            className="md:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors"
                        >
                            <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                {isMobileMenuOpen ? (
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
                                ) : (
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4 6h16M4 12h16M4 18h16" />
                                )}
                            </svg>
                        </button>

                        {/* Desktop navigation */}
                        <nav className="hidden md:flex items-center space-x-8">
                            <a href="/" className="text-gray-700 hover:text-gray-900 transition-colors">
                                Home
                            </a>
                            <a href="/pages" className="text-gray-700 hover:text-gray-900 transition-colors">
                                Pages
                            </a>
                            <a href="/portfolio" className="text-gray-700 hover:text-gray-900 transition-colors">
                                Portfolio
                            </a>
                            <a href="/blog" className="text-gray-700 hover:text-gray-900 transition-colors font-medium">
                                Blog
                            </a>
                            <a href="/shop" className="text-gray-700 hover:text-gray-900 transition-colors">
                                Shop
                            </a>
                            <a href="/elements" className="text-gray-700 hover:text-gray-900 transition-colors">
                                Elements
                            </a>
                            
                            {/* Auth Links */}
                            <div className="flex items-center space-x-4 ml-8 border-l pl-8">
                                <a href="/login" className="text-gray-600 hover:text-gray-900 transition-colors">
                                    Login
                                </a>
                                <a href="/register" className="bg-gray-900 text-white px-4 py-2 rounded-lg hover:bg-gray-800 transition-colors">
                                    Sign Up
                                </a>
                            </div>
                        </nav>
                    </div>

                    {/* Mobile navigation */}
                    <div className={`md:hidden transition-all duration-300 overflow-hidden ${
                        isMobileMenuOpen ? 'max-h-96 opacity-100' : 'max-h-0 opacity-0'
                    }`}>
                        <nav className="py-4 space-y-4 border-t mt-4">
                            <a href="/" className="block text-gray-700 hover:text-gray-900 transition-colors">
                                Home
                            </a>
                            <a href="/pages" className="block text-gray-700 hover:text-gray-900 transition-colors">
                                Pages
                            </a>
                            <a href="/portfolio" className="block text-gray-700 hover:text-gray-900 transition-colors">
                                Portfolio
                            </a>
                            <a href="/blog" className="block text-gray-700 hover:text-gray-900 transition-colors font-medium">
                                Blog
                            </a>
                            <a href="/shop" className="block text-gray-700 hover:text-gray-900 transition-colors">
                                Shop
                            </a>
                            <a href="/elements" className="block text-gray-700 hover:text-gray-900 transition-colors">
                                Elements
                            </a>
                            <div className="pt-4 border-t space-y-4">
                                <a href="/login" className="block text-gray-600 hover:text-gray-900 transition-colors">
                                    Login
                                </a>
                                <a href="/register" className="block bg-gray-900 text-white px-4 py-2 rounded-lg hover:bg-gray-800 transition-colors text-center">
                                    Sign Up
                                </a>
                            </div>
                        </nav>
                    </div>
                </div>
            </header>

            <main className="pt-20">
                {children}
            </main>

            <footer className="bg-white border-t mt-16">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                    <div className="grid grid-cols-1 md:grid-cols-4 gap-8">
                        <div className="space-y-4">
                            <h3 className="text-lg font-bold text-gray-900">Sada.</h3>
                            <p className="text-gray-500">© 2024 Enigmatic Themes</p>
                        </div>
                        <div>
                            <h4 className="font-semibold mb-4 text-gray-900">About us</h4>
                            <ul className="space-y-2 text-sm">
                                <li><a href="/about" className="text-gray-500 hover:text-gray-900 transition-colors">Aenean mattis</a></li>
                                <li><a href="/team" className="text-gray-500 hover:text-gray-900 transition-colors">Vestibulum ante</a></li>
                                <li><a href="/careers" className="text-gray-500 hover:text-gray-900 transition-colors">Sapien etiam</a></li>
                                <li><a href="/history" className="text-gray-500 hover:text-gray-900 transition-colors">Morbi eget leo</a></li>
                            </ul>
                        </div>
                        <div>
                            <h4 className="font-semibold mb-4 text-gray-900">Product</h4>
                            <ul className="space-y-2 text-sm">
                                <li><a href="/features" className="text-gray-500 hover:text-gray-900 transition-colors">Vestibulum diam</a></li>
                                <li><a href="/pricing" className="text-gray-500 hover:text-gray-900 transition-colors">Pharetra sapien ante</a></li>
                                <li><a href="/api" className="text-gray-500 hover:text-gray-900 transition-colors">Finibus bibendum nulla</a></li>
                                <li><a href="/docs" className="text-gray-500 hover:text-gray-900 transition-colors">Duis tristique ligula</a></li>
                            </ul>
                        </div>
                        <div>
                            <h4 className="font-semibold mb-4 text-gray-900">Contact us</h4>
                            <ul className="space-y-2 text-sm">
                                <li><span className="text-gray-500">hello@sadamarket.com</span></li>
                                <li><span className="text-gray-500">Mobile: +34-1-240-260</span></li>
                            </ul>
                            <div className="flex space-x-3 mt-4">
                                <a href="#" className="text-gray-400 hover:text-gray-600 transition-colors">
                                    <svg className="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                    </svg>
                                </a>
                                <a href="#" className="text-gray-400 hover:text-gray-600 transition-colors">
                                    <svg className="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                                    </svg>
                                </a>
                                <a href="#" className="text-gray-400 hover:text-gray-600 transition-colors">
                                    <svg className="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.097.118.112.222.082.343-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001.012.001z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    );
} 