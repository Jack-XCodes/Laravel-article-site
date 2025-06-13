import React from 'react';

interface ArticleCardProps {
    title: string;
    excerpt: string;
    image: string;
    category: string;
    date: string;
    slug: string;
}

export default function ArticleCard({ title, excerpt, image, category, date, slug }: ArticleCardProps) {
    return (
        <article className="group bg-white rounded-lg overflow-hidden transform transition-all duration-300 hover:shadow-lg">
            <div className="relative">
                <div className="aspect-w-16 aspect-h-10 overflow-hidden">
                    <img
                        src={image}
                        alt={title}
                        className="w-full h-full object-cover transform transition-transform duration-300 group-hover:scale-105"
                    />
                </div>
            </div>
            
            <div className="p-6">
                <div className="flex items-center space-x-2 mb-3">
                    <span className="text-sm text-gray-500 uppercase tracking-wide">
                        {category}
                    </span>
                    <span className="text-gray-400">•</span>
                    <time className="text-sm text-gray-500" dateTime={date}>
                        {new Date(date).toLocaleDateString('en-US', {
                            month: 'long',
                            day: 'numeric',
                            year: 'numeric'
                        })}
                    </time>
                </div>
                
                <h3 className="text-lg font-semibold mb-3 line-clamp-2 group-hover:text-gray-600 transition-colors">
                    <a href={`/blog/${slug}`} className="block">
                        {title}
                    </a>
                </h3>
                
                <p className="text-gray-600 text-sm line-clamp-3 leading-relaxed">{excerpt}</p>
            </div>
        </article>
    );
} 