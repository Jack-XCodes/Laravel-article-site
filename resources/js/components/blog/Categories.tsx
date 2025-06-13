import React, { useState } from 'react';

interface Category {
    name: string;
    count: number;
    icon: string;
}

const categories: Category[] = [
    { name: 'Culture', count: 12, icon: '🎨' },
    { name: 'Creativity', count: 8, icon: '💡' },
    { name: 'Food', count: 15, icon: '🍳' },
    { name: 'Travel', count: 10, icon: '✈️' },
    { name: 'Humor', count: 6, icon: '😄' },
    { name: 'Music', count: 9, icon: '🎵' },
];

export default function Categories() {
    const [hoveredCategory, setHoveredCategory] = useState<string | null>(null);

    return (
        <div className="bg-white p-6 rounded-xl shadow-sm">
            <h2 className="text-xl font-semibold mb-6 bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                Explore Categories
            </h2>
            
            <div className="space-y-3">
                {categories.map((category) => (
                    <a
                        key={category.name}
                        href={`/category/${category.name.toLowerCase()}`}
                        className="group block"
                        onMouseEnter={() => setHoveredCategory(category.name)}
                        onMouseLeave={() => setHoveredCategory(null)}
                    >
                        <div className={`
                            flex items-center justify-between p-3 rounded-lg transition-all duration-300
                            ${hoveredCategory === category.name ? 'bg-blue-50 scale-105' : 'hover:bg-gray-50'}
                        `}>
                            <div className="flex items-center space-x-3">
                                <span className="text-2xl">{category.icon}</span>
                                <span className={`
                                    font-medium transition-colors duration-300
                                    ${hoveredCategory === category.name ? 'text-blue-600' : 'text-gray-700'}
                                `}>
                                    {category.name}
                                </span>
                            </div>
                            <div className="flex items-center space-x-2">
                                <span className={`
                                    text-sm transition-colors duration-300
                                    ${hoveredCategory === category.name ? 'text-blue-600' : 'text-gray-400'}
                                `}>
                                    {category.count}
                                </span>
                                <svg
                                    className={`
                                        w-4 h-4 transform transition-transform duration-300
                                        ${hoveredCategory === category.name ? 'translate-x-1 text-blue-600' : 'text-gray-400'}
                                    `}
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        strokeLinecap="round"
                                        strokeLinejoin="round"
                                        strokeWidth={2}
                                        d="M9 5l7 7-7 7"
                                    />
                                </svg>
                            </div>
                        </div>
                    </a>
                ))}
            </div>

            <div className="mt-6 pt-6 border-t">
                <button className="w-full px-4 py-2 text-sm font-medium text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors duration-300 flex items-center justify-center space-x-2">
                    <span>View All Categories</span>
                    <svg className="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </button>
            </div>
        </div>
    );
} 