# Laravel Article Site

A modern, full-featured blog application built with Laravel 11, React, and Inertia.js. Features a beautiful "Sada." design with complete article management system, user authentication, and responsive UI.

## 🚀 Features

### Frontend
- **Modern Blog Interface**: Clean, responsive design inspired by "Sada." blog
- **Article Management**: Create, edit, publish/unpublish articles with live preview
- **User Authentication**: Registration, login, password reset functionality
- **Dashboard**: Comprehensive admin panel for article management
- **Real-time Preview**: Side-by-side editing with instant content preview
- **Search & Pagination**: Find and browse articles easily
- **Mobile Responsive**: Optimized for all device sizes

### Backend
- **Laravel 11**: Latest Laravel framework with modern PHP practices
- **Laravel Breeze**: Simple authentication scaffolding
- **Article CRUD**: Complete Create, Read, Update, Delete operations
- **User Management**: Secure user registration and authentication
- **Database Seeding**: Pre-populated sample articles for testing
- **API Ready**: RESTful API endpoints for article management

### Technical Stack
- **Backend**: Laravel 11, PHP 8.1+, MySQL
- **Frontend**: React 18, TypeScript, Inertia.js
- **Styling**: Tailwind CSS with custom animations
- **Build Tool**: Vite for fast development and building
- **Authentication**: Laravel Breeze

## 📋 Prerequisites

- **PHP** >= 8.1
- **Composer** - PHP dependency manager
- **Node.js** >= 16.x & **npm** - JavaScript runtime and package manager
- **MySQL** or another supported database
- **Git** - Version control

## 🛠️ Installation

### 1. Clone the Repository
```bash
git clone https://github.com/Jack-XCodes/Laravel-article-site.git
cd Laravel-article-site
```

### 2. Install PHP Dependencies
```bash
composer install
```

### 3. Install JavaScript Dependencies
```bash
npm install
```

### 4. Environment Configuration
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 5. Database Setup
Edit your `.env` file with database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_article_site
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Create the database and run migrations:
```bash
# Create database (adjust command for your system)
mysql -u root -p -e "CREATE DATABASE laravel_article_site;"

# Run migrations
php artisan migrate

# Seed sample data (optional)
php artisan db:seed --class=ArticleSeeder
```

### 6. Build Assets
```bash
# Development build
npm run dev

# Production build
npm run build
```

### 7. Start the Application
```bash
php artisan serve
```

The application will be available at [http://127.0.0.1:8000](http://127.0.0.1:8000)

## 🎯 Usage

### Public Features
- **Homepage**: Browse published articles with search functionality
- **Article Viewing**: Read individual articles with clean formatting
- **User Registration**: Create new accounts
- **User Login**: Access existing accounts

### Dashboard Features (Authenticated Users)
- **Article Management**: View all your articles with status indicators
- **Create Articles**: Write new articles with live preview
- **Edit Articles**: Modify existing content with real-time preview
- **Publish Control**: Publish/unpublish articles instantly
- **Statistics**: View article counts and quick actions

### Key Endpoints
- `/` - Homepage with article listing
- `/register` - User registration
- `/login` - User login
- `/dashboard` - User dashboard
- `/dashboard/articles` - Article management
- `/dashboard/articles/create` - Create new article
- `/dashboard/articles/{id}/edit` - Edit existing article

## 📁 Project Structure

```
├── app/
│   ├── Http/Controllers/
│   │   ├── DashboardController.php    # Dashboard and article management
│   │   └── Auth/                      # Authentication controllers
│   ├── Models/
│   │   ├── User.php                   # User model
│   │   └── Article.php                # Article model with relationships
│   └── ...
├── database/
│   ├── migrations/                    # Database schema
│   ├── seeders/                       # Sample data
│   └── factories/                     # Model factories
├── resources/
│   ├── js/
│   │   ├── components/               # React components
│   │   │   ├── Blog.tsx             # Main blog interface
│   │   │   ├── BlogLayout.tsx       # Blog layout with navigation
│   │   │   └── ArticleCard.tsx      # Article card component
│   │   ├── pages/
│   │   │   ├── dashboard/           # Dashboard pages
│   │   │   │   ├── articles.tsx    # Article management
│   │   │   │   ├── create-article.tsx
│   │   │   │   └── edit-article.tsx
│   │   │   └── auth/               # Authentication pages
│   │   └── layouts/                # Page layouts
│   └── views/                      # Blade templates
├── routes/
│   ├── web.php                     # Web routes
│   └── auth.php                    # Authentication routes
└── public/                         # Public assets
```

## 🔧 Development

### Running in Development Mode
```bash
# Start Laravel server
php artisan serve

# Start Vite dev server (in another terminal)
npm run dev
```

### Database Operations
```bash
# Fresh migration with seeding
php artisan migrate:fresh --seed

# Create new migration
php artisan make:migration create_table_name

# Create new model with migration
php artisan make:model ModelName -m
```

### Asset Building
```bash
# Development build with hot reload
npm run dev

# Production build
npm run build

# Watch for changes
npm run dev
```

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is open-sourced software licensed under the [MIT license](LICENSE).

## 👤 Author

**Jack-XCodes**
- GitHub: [@Jack-XCodes](https://github.com/Jack-XCodes)

## 🙏 Acknowledgments

- Laravel team for the amazing framework
- React team for the powerful UI library
- Tailwind CSS for the utility-first CSS framework
- Inertia.js for seamless SPA experience

---

**Happy Blogging! 📝✨**