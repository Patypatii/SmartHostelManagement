# Database Configuration for NeonDB

Please update your `.env` file with the following database configuration:

```env
DB_CONNECTION=pgsql
DB_HOST=ep-wispy-bar-a4599tk0-pooler.us-east-1.aws.neon.tech
DB_PORT=5432
DB_DATABASE=neondb
DB_USERNAME=neondb_owner
DB_PASSWORD=npg_y6Z3LXvUutsJ
DB_SSLMODE=require
```

## Steps:
1. Open `.env` file in your editor
2. Find the DB_ configuration section (around lines 11-16)
3. Replace with the values above
4. Save the file
5. Run: `php artisan config:clear`
6. Run: `php artisan migrate`
