# Local Development Setup Guide

## Quick Start

### 1. Set Up Environment Variables

Make sure your `.env` file has:

```env
APP_NAME="Smart Hostel Management"
APP_ENV=local
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=pgsql
DB_HOST=ep-wispy-bar-a4599tk0-pooler.us-east-1.aws.neon.tech
DB_PORT=5432
DB_DATABASE=neondb
DB_USERNAME=neondb_owner
DB_PASSWORD=npg_y6Z3LXvUutsJ
DB_SSLMODE=require
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

### 3. Build Assets

```bash
# Build assets for development (with hot reload)
npm run dev

# OR build for production
npm run build
```

### 4. Start Development Server

```bash
# Start Laravel development server
php artisan serve

# Your app will be available at: http://localhost:8000
```

### 5. Run Migrations

```bash
php artisan migrate
```

## Troubleshooting Styles Not Loading Locally

### Issue: CSS files return 404

**Solution 1: Check APP_URL**
```bash
# Make sure APP_URL in .env is:
APP_URL=http://localhost:8000
```

**Solution 2: Clear Cache**
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

**Solution 3: Verify CSS Files Exist**
```bash
# Check if files exist
ls public/css/
# Should show:
# - webflow-design-system.css
# - frontend.css
```

**Solution 4: Check File Permissions**
```bash
# On Linux/Mac, ensure files are readable
chmod -R 755 public/css/
```

### Issue: Styles load but look broken

**Solution: Hard refresh browser**
- Windows/Linux: `Ctrl + Shift + R`
- Mac: `Cmd + Shift + R`

Or clear browser cache.

## Development Workflow

### Running with Hot Reload (Recommended)

Terminal 1 - Laravel Server:
```bash
php artisan serve
```

Terminal 2 - Vite Dev Server (for hot reload):
```bash
npm run dev
```

This gives you:
- Auto-reload on file changes
- Fast compilation
- Better development experience

### Running Production Build Locally

```bash
# Build assets
npm run build

# Start server
php artisan serve
```

## Testing Production Build Locally

To test how it will work on Render:

```bash
# Set production environment
APP_ENV=production
APP_DEBUG=false

# Build assets
npm run build

# Clear all caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Cache for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start server
php artisan serve
```

## Common Commands

```bash
# Clear all caches
php artisan optimize:clear

# Cache for production
php artisan optimize

# Run migrations
php artisan migrate

# Run seeders
php artisan db:seed

# Create storage link
php artisan storage:link
```

## File Structure

```
public/
├── css/
│   ├── webflow-design-system.css  ← Main design system
│   └── frontend.css                ← Custom frontend styles
├── js/
│   └── dashboard-charts.js
└── build/                          ← Vite compiled assets
    ├── assets/
    └── manifest.json
```

## Notes

- CSS files in `public/css/` are served directly (not through Vite)
- Vite handles `resources/css/app.css` and `resources/js/app.js`
- The layout uses both static CSS and Vite assets
- Always run `npm run build` before deploying to Render

