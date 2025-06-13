import React from 'react';
import Blog from './Blog';

interface Article {
    id: number;
    title: string;
    excerpt: string;
    image?: string;
    category: string;
    date: string;
    slug: string;
}

interface WelcomeProps {
    articles: Article[];
}

export default function Welcome({ articles }: WelcomeProps) {
    return <Blog articles={articles} />;
}
