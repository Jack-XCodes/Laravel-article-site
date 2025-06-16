<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first user (admin) to assign as author
        $user = User::first();
        
        if (!$user) {
            // Create a default user if none exists
            $user = User::create([
                'name' => 'Blog Author',
                'email' => 'author@example.com',
                'password' => bcrypt('password'),
            ]);
        }

        $articles = [
            [
                'title' => 'The Ultimate Guide to Modern Web Development',
                'slug' => 'ultimate-guide-modern-web-development',
                'content' => "Web development has evolved tremendously over the past decade. From simple HTML pages to complex single-page applications, the landscape has transformed completely.\n\nIn this comprehensive guide, we'll explore the modern web development stack, including:\n\n• Frontend frameworks like React, Vue, and Angular\n• Backend technologies such as Node.js, Laravel, and Django\n• Database solutions including MySQL, PostgreSQL, and MongoDB\n• DevOps tools and deployment strategies\n\nWhether you're a beginner looking to enter the field or an experienced developer wanting to stay current, this guide covers everything you need to know about modern web development practices.\n\nThe key to success in web development is continuous learning and adapting to new technologies while maintaining strong fundamentals in programming concepts.",
                'user_id' => $user->id,
                'published' => true,
                'created_at' => now()->subDays(1),
            ],
            [
                'title' => 'Building Responsive Websites with CSS Grid and Flexbox',
                'slug' => 'building-responsive-websites-css-grid-flexbox',
                'content' => "Creating responsive websites is no longer optional—it's essential. With the variety of devices and screen sizes available today, your website must look great everywhere.\n\nCSS Grid and Flexbox are two powerful layout tools that make responsive design much easier:\n\n**CSS Grid** is perfect for:\n• Two-dimensional layouts\n• Complex grid systems\n• Responsive card layouts\n• Overall page structure\n\n**Flexbox** excels at:\n• One-dimensional layouts\n• Centering content\n• Distributing space\n• Aligning items\n\nBy combining these tools, you can create beautiful, responsive layouts without relying on heavy frameworks. The key is understanding when to use each tool and how they complement each other.\n\nRemember to always test your designs on multiple devices and use browser developer tools to simulate different screen sizes.",
                'user_id' => $user->id,
                'published' => true,
                'created_at' => now()->subDays(2),
            ],
            [
                'title' => 'JavaScript ES6+ Features Every Developer Should Know',
                'slug' => 'javascript-es6-features-every-developer-should-know',
                'content' => "JavaScript has come a long way since ES6 was released. The modern features introduced have made JavaScript more powerful and developer-friendly.\n\nHere are the essential ES6+ features you should master:\n\n**1. Arrow Functions**\nCleaner syntax for function expressions with lexical 'this' binding.\n\n**2. Destructuring**\nExtract values from arrays and objects with elegant syntax.\n\n**3. Template Literals**\nString interpolation and multi-line strings made easy.\n\n**4. Async/Await**\nHandle asynchronous operations without callback hell.\n\n**5. Modules**\nOrganize your code with import/export statements.\n\n**6. Spread Operator**\nExpand arrays and objects in various contexts.\n\nThese features not only make your code more readable but also help you write more efficient and maintainable applications. Start incorporating them into your projects today!",
                'user_id' => $user->id,
                'published' => true,
                'created_at' => now()->subDays(3),
            ],
            [
                'title' => 'Database Design Best Practices for Web Applications',
                'slug' => 'database-design-best-practices-web-applications',
                'content' => "A well-designed database is the foundation of any successful web application. Poor database design can lead to performance issues, data integrity problems, and maintenance nightmares.\n\nHere are the key principles to follow:\n\n**Normalization**\nOrganize your data to eliminate redundancy and improve data integrity. Start with First Normal Form (1NF) and progress through higher normal forms as needed.\n\n**Indexing Strategy**\nCreate indexes on columns used in WHERE clauses, JOIN conditions, and ORDER BY statements. But be careful not to over-index, as it can slow down write operations.\n\n**Relationships**\nProperly define relationships between tables using foreign keys. This ensures data consistency and enables efficient queries.\n\n**Data Types**\nChoose appropriate data types for your columns. This affects storage efficiency and query performance.\n\n**Security**\nImplement proper access controls and never store sensitive data in plain text.\n\nRemember, database design is often harder to change later, so invest time in getting it right from the beginning.",
                'user_id' => $user->id,
                'published' => true,
                'created_at' => now()->subDays(4),
            ],
            [
                'title' => 'The Rise of JAMstack: Building Faster Websites',
                'slug' => 'rise-of-jamstack-building-faster-websites',
                'content' => "JAMstack (JavaScript, APIs, and Markup) represents a modern approach to web development that delivers better performance, security, and developer experience.\n\n**What makes JAMstack special?**\n\n• **Pre-built Markup**: Sites are pre-built and served from a CDN\n• **Dynamic APIs**: All server-side processes are handled by APIs\n• **Enhanced JavaScript**: Client-side JavaScript handles dynamic functionality\n\n**Benefits of JAMstack:**\n\n1. **Performance**: Pre-built sites load incredibly fast\n2. **Security**: No server means fewer attack vectors\n3. **Scalability**: CDN distribution handles traffic spikes easily\n4. **Developer Experience**: Modern tooling and deployment workflows\n\n**Popular JAMstack Tools:**\n• Static Site Generators: Gatsby, Next.js, Nuxt.js\n• Headless CMS: Contentful, Strapi, Sanity\n• Deployment: Netlify, Vercel, GitHub Pages\n\nWhile JAMstack isn't suitable for every project, it's perfect for blogs, marketing sites, documentation, and e-commerce stores. Consider it for your next project!",
                'user_id' => $user->id,
                'published' => true,
                'created_at' => now()->subDays(5),
            ],
            [
                'title' => 'API Security: Protecting Your Backend Services',
                'slug' => 'api-security-protecting-backend-services',
                'content' => "As APIs become the backbone of modern applications, securing them is more critical than ever. A single vulnerability can expose sensitive data and compromise your entire system.\n\n**Essential API Security Measures:**\n\n**Authentication & Authorization**\nImplement robust authentication mechanisms like JWT tokens or OAuth 2.0. Always validate user permissions before allowing access to resources.\n\n**Input Validation**\nNever trust user input. Validate, sanitize, and escape all incoming data to prevent injection attacks.\n\n**Rate Limiting**\nProtect against abuse by implementing rate limiting. This prevents DDoS attacks and ensures fair usage.\n\n**HTTPS Everywhere**\nAlways use HTTPS to encrypt data in transit. Never send sensitive information over unencrypted connections.\n\n**API Versioning**\nImplement proper versioning to maintain backward compatibility while allowing for security updates.\n\n**Logging & Monitoring**\nLog all API access and monitor for suspicious patterns. Quick detection is key to minimizing damage.\n\nRemember: security is not a one-time implementation but an ongoing process that requires constant attention and updates.",
                'user_id' => $user->id,
                'published' => true,
                'created_at' => now()->subDays(6),
            ],
            [
                'title' => 'Understanding Git: Version Control for Developers',
                'slug' => 'understanding-git-version-control-developers',
                'content' => "Git is an essential tool for every developer, yet many only scratch the surface of its capabilities. Understanding Git deeply will make you a more effective developer and team member.\n\n**Core Git Concepts:**\n\n**Repository**: Your project's complete history and all versions\n**Commit**: A snapshot of your project at a specific point in time\n**Branch**: A parallel line of development\n**Merge**: Combining changes from different branches\n\n**Essential Git Workflows:**\n\n**Feature Branch Workflow**\nCreate a new branch for each feature, work on it independently, then merge back to main.\n\n**Git Flow**\nA branching model with specific branch types: master, develop, feature, release, and hotfix.\n\n**GitHub Flow**\nA simplified workflow: create branch, make changes, open pull request, merge.\n\n**Best Practices:**\n• Write clear, descriptive commit messages\n• Commit often with logical chunks of work\n• Use .gitignore to exclude unnecessary files\n• Review changes before committing\n\nMastering Git will save you countless hours and prevent many headaches throughout your development career.",
                'user_id' => $user->id,
                'published' => true,
                'created_at' => now()->subDays(7),
            ],
        ];

        foreach ($articles as $article) {
            Article::create($article);
        }
    }
}
