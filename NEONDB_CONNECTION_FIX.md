# NeonDB Connection String Setup

## Issue
NeonDB requires the endpoint ID to be passed as a parameter because your PostgreSQL client library (libpq) doesn't support SNI.

## Solution

### Update .env File

Replace these lines in your `.env` file:
```env
DB_CONNECTION=pgsql
DB_HOST=ep-wispy-bar-a4599tk0-pooler.us-east-1.aws.neon.tech
DB_PORT=5432
DB_DATABASE=neondb
DB_USERNAME=neondb_owner
DB_PASSWORD=npg_y6Z3LXvUutsJ
DB_SSLMODE=require
```

With this **single line**:
```env
DATABASE_URL="postgresql://neondb_owner:npg_y6Z3LXvUutsJ@ep-wispy-bar-a4599tk0-pooler.us-east-1.aws.neon.tech:5432/neondb?sslmode=require&options=endpoint%3Dep-wispy-bar-a4599tk0"
```

### Run Commands

```bash
php artisan config:clear
php artisan migrate
```

## What This Does

- Uses PostgreSQL connection string format
- Includes `sslmode=require` for SSL
- Adds `options=endpoint%3Dep-wispy-bar-a4599tk0` (URL-encoded endpoint parameter)
- Endpoint ID `ep-wispy-bar-a4599tk0` is extracted from your hostname
