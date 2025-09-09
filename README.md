# Filament PUPR CMS

A comprehensive Content Management System built with Laravel and Filament for Indonesian government websites, specifically designed for Kementerian Pekerjaan Umum dan Perumahan Rakyat (PUPR).

## Features

### Admin Panel (Filament 4)
- **User Management**: Role-based access control with admin, moderator, and user roles
- **Content Management**: 
  - News articles with categories and featured content
  - Static pages with hierarchical structure
  - Image gallery with multi-media support
  - Homepage sliders with customizable settings
- **Settings**: Configurable site settings and metadata
- **File Management**: Organized file uploads with public storage

### Frontend
- **Modern Design**: Indonesian government web style guidelines
- **Responsive Layout**: Mobile-first design with Tailwind CSS
- **SEO Optimized**: Meta tags, structured URLs, and clean markup
- **Performance**: Optimized images and efficient queries

### Technical Features
- **Laravel 12.0**: Latest Laravel framework
- **Filament 4**: Modern admin panel
- **SQLite Database**: Lightweight database solution
- **File Storage**: Public disk with symlinked storage
- **Image Processing**: Smart image handling for uploads
- **Multi-environment**: Development and production configurations

## Requirements

- PHP 8.2+
- Composer
- Node.js 18+
- NPM or Yarn

## Installation

1. **Clone the repository**:
   ```bash
   git clone https://github.com/yourusername/filament-pupr.git
   cd filament-pupr
   ```

2. **Install PHP dependencies**:
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**:
   ```bash
   npm install
   ```

4. **Environment setup**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database setup**:
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Storage setup**:
   ```bash
   php artisan storage:link
   ```

7. **Build frontend assets**:
   ```bash
   npm run build
   ```

## Development

1. **Start development server**:
   ```bash
   php artisan serve
   ```

2. **Start frontend development**:
   ```bash
   npm run dev
   ```

3. **Access admin panel**:
   - URL: `http://localhost:8000/backoffice`
   - Default admin: `admin@example.com` / `password`

## Project Structure

```
app/
├── Filament/Backoffice/Resources/     # Filament admin resources
│   ├── Categories/                   # Category management
│   ├── News/                         # News management
│   ├── Pages/                        # Static pages
│   ├── Galleries/                    # Gallery management
│   ├── Sliders/                      # Homepage sliders
│   ├── Settings/                     # Site settings
│   └── Users/                        # User management
├── Http/Controllers/                 # Frontend controllers
├── Models/                           # Eloquent models
└── Console/Commands/                 # Custom artisan commands

resources/
├── views/frontend/                   # Frontend templates
│   ├── layouts/                      # Layout templates
│   ├── pages/                        # Static page views
│   ├── news/                         # News views
│   ├── gallery/                      # Gallery views
│   └── home.blade.php                # Homepage
└── css/                              # Stylesheets

database/
├── migrations/                       # Database migrations
└── seeders/                          # Database seeders
```

## Configuration

### Environment Variables

Key environment variables in `.env`:

```env
APP_NAME="PUPR CMS"
APP_URL=http://localhost:8000
FILESYSTEM_DISK=public
DB_CONNECTION=sqlite
```

### File Storage

Files are stored in `storage/app/public/` with the following structure:
- `sliders/` - Homepage slider images
- `gallery/` - Gallery images and videos
- `pages/` - Page featured images
- `settings/` - Site logos and assets

## Features Overview

### News Management
- Create and edit news articles
- Category organization
- Featured articles
- SEO-friendly URLs
- Author attribution
- Publication scheduling

### Page Management
- Hierarchical page structure
- Parent-child relationships
- Custom page templates
- SEO metadata
- Featured images

### Gallery Management
- Multi-media support (images/videos)
- Tagging system
- Status management
- Responsive display
- Thumbnail generation

### Slider Management
- Homepage hero sliders
- Custom button actions
- Animation settings
- Overlay controls
- Sort ordering

### User Management
- Role-based permissions
- Admin/Moderator/User roles
- Profile management
- Secure authentication

## API Endpoints

The application provides web routes for:

- `/` - Homepage
- `/news` - News listing
- `/news/{slug}` - News article
- `/gallery` - Gallery
- `/pages/{slug}` - Static pages
- `/backoffice` - Admin panel

## Testing

Run the test suite:

```bash
php artisan test
```

Or using Pest:

```bash
./vendor/bin/pest
```

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## Security

If you discover any security vulnerabilities, please send an e-mail to the project maintainer.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Credits

- Built with [Laravel](https://laravel.com/)
- Admin panel powered by [Filament](https://filamentphp.com/)
- Styled with [Tailwind CSS](https://tailwindcss.com/)
- Icons from [Heroicons](https://heroicons.com/)

## Support

For support and questions, please open an issue on GitHub or contact the development team.
