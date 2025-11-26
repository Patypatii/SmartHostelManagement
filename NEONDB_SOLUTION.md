# NeonDB Connection Issue - SNI Support Required

## Problem Summary
Cannot connect to NeonDB because the PostgreSQL client library (libpq) in XAMPP doesn't support SNI (Server Name Indication), which NeonDB requires for endpoint routing.

**Error**: `SQLSTATE[08006] [7] ERROR: Endpoint ID is not specified`

## What We Tried
1. ✅ Enabled PostgreSQL PDO extensions (`pdo_pgsql`, `pgsql`)
2. ❌ DATABASE_URL with endpoint parameter - Laravel parsed it incorrectly
3. ❌ Individual DB variables with non-pooler endpoint - Still needs SNI
4. ❌ PGOPTIONS environment variable - libpq too old to support

## Root Cause
XAMPP's PostgreSQL client library (libpq) is outdated and lacks SNI support, which NeonDB requires for their serverless infrastructure.

## Solutions

### Option 1: Use Laravel Sail (Recommended)
Laravel Sail provides Docker containers with modern PostgreSQL clients.

```bash
# Install Sail
composer require laravel/sail --dev

# Install Sail with PostgreSQL
php artisan sail:install

# Select: pgsql

# Start Sail
./vendor/bin/sail up -d

# Run migrations
./vendor/bin/sail artisan migrate
```

**Pros**: Modern libpq, consistent environment, includes all dependencies  
**Cons**: Requires Docker Desktop

### Option 2: Upgrade PostgreSQL Client Library

Download and install PostgreSQL 15+ for Windows:
- Visit: https://www.postgresql.org/download/windows/
- Install PostgreSQL
- Update PHP to use new libpq.dll

**Steps**:
1. Install PostgreSQL 15+
2. Copy `libpq.dll` from PostgreSQL installation to `C:\xampp\php\ext\`
3. Restart Apache
4. Test: `php artisan migrate`

**Pros**: Direct solution  
**Cons**: Manual installation, potential compatibility issues

### Option 3: Use Different Database (Temporary)
Switch to MySQL temporarily for development, then deploy to NeonDB in production.

Update `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hostel_db  
DB_USERNAME=root
DB_PASSWORD=
```

**Pros**: Works immediately with XAMPP  
**Cons**: Different database engine, may have minor SQL differences

### Option 4: Use Local PostgreSQL
Install PostgreSQL locally instead of using NeonDB for development.

1. Install PostgreSQL from https://www.postgresql.org/download/
2. Create local database
3. Update `.env` to use localhost

**Pros**: Full PostgreSQL features, no internet required  
**Cons**: Different setup than production

## Recommended: Laravel Sail

Laravel Sail is the easiest and most reliable solution as it provides:
- ✅ Modern PostgreSQL client with SNI support
- ✅ Consistent development environment
- ✅ Easy team collaboration
- ✅ Production-like environment

## Next Steps

**Choose one of the options above and let me know which you'd like to proceed with!**

I'm ready to help you:
- Set up Laravel Sail
- Upgrade PostgreSQL client
- Configure MySQL temporarily  
- Install local PostgreSQL

Just let me know your preference!
