# Render Deployment Guide

This guide will help you deploy your Laravel Smart Hostel Management System to Render.

## Prerequisites

1. A GitHub, GitLab, or Bitbucket account
2. Your code pushed to a repository
3. A Render account (sign up at [render.com](https://render.com))

## Step 1: Prepare Your Repository

Make sure your code is pushed to GitHub/GitLab/Bitbucket. The `render.yaml` file is already configured in this repository.

## Step 2: Create a Web Service on Render

1. Go to [Render Dashboard](https://dashboard.render.com)
2. Click **"New +"** → **"Web Service"**
3. Connect your repository (GitHub/GitLab/Bitbucket)
4. Select your repository: `SmartHostelManagementSystem-Laravel`
5. Render should auto-detect the `render.yaml` file

## Step 3: Configure Environment Variables

In the Render dashboard, add these environment variables:

### Required Variables

```env
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_NAME="Smart Hostel Management"
APP_URL=https://your-app-name.onrender.com
APP_ENV=production
APP_DEBUG=false
```

**To get your APP_KEY:**
- Run locally: `php artisan key:generate`
- Copy the key from your `.env` file

### Database Configuration

**Option A: Use NeonDB (Your Current Database)**

```env
DB_CONNECTION=pgsql
DB_HOST=ep-wispy-bar-a4599tk0-pooler.us-east-1.aws.neon.tech
DB_PORT=5432
DB_DATABASE=neondb
DB_USERNAME=neondb_owner
DB_PASSWORD=npg_y6Z3LXvUutsJ
DB_SSLMODE=require
```

**Option B: Use Render PostgreSQL (Recommended)**

1. In Render Dashboard, create a **PostgreSQL** database
2. Render will automatically provide these variables:
   - `DATABASE_URL` (use this instead of individual DB_ variables)
   - Or use individual variables if you prefer

### Session & Cache Configuration

```env
SESSION_DRIVER=database
CACHE_DRIVER=database
QUEUE_CONNECTION=database
```

### Logging Configuration

```env
LOG_CHANNEL=stderr
LOG_LEVEL=error
```

## Step 4: Deploy

1. Click **"Create Web Service"**
2. Render will start building your application
3. The first deployment may take 5-10 minutes

## Step 5: Run Migrations

After the first successful deployment:

1. Go to your service in Render Dashboard
2. Click on **"Shell"** tab
3. Run: `php artisan migrate`
4. If you have seeders: `php artisan db:seed`

## Step 6: Storage Configuration

⚠️ **Important**: Render's filesystem is ephemeral. Files uploaded to `storage/` will be lost on redeploy.

### For File Uploads, Use External Storage:

**Option 1: AWS S3**
```env
FILESYSTEM_DISK=s3
AWS_ACCESS_KEY_ID=your_key
AWS_SECRET_ACCESS_KEY=your_secret
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=your-bucket-name
```

**Option 2: Cloudinary**
```env
CLOUDINARY_URL=cloudinary://your_credentials
```

Update `config/filesystems.php` to use the appropriate disk.

## Step 7: Queue Workers (If Needed)

If your app uses Laravel queues:

1. In Render Dashboard, create a **Background Worker**
2. Use the same repository
3. Build Command: `composer install --no-dev --optimize-autoloader`
4. Start Command: `php artisan queue:work --sleep=3 --tries=3`

## Step 8: Scheduled Tasks (Cron Jobs)

If you have scheduled tasks:

1. In Render Dashboard, create a **Cron Job**
2. Schedule: `*/5 * * * *` (every 5 minutes)
3. Command: `cd /opt/render/project/src && php artisan schedule:run`

## Troubleshooting

### Build Fails
- Check build logs in Render dashboard
- Ensure all dependencies are in `composer.json` and `package.json`
- Verify PHP version compatibility (your app requires PHP ^8.1)

### Database Connection Issues
- Verify all database environment variables are set
- For NeonDB, ensure `DB_SSLMODE=require` is set
- Check database firewall/whitelist settings

### 500 Errors
- Check logs in Render dashboard
- Run `php artisan config:clear` in Shell
- Verify `APP_KEY` is set correctly

### Assets Not Loading
- Ensure `npm run build` completes successfully
- Check that `public/build` directory exists after build
- Verify `APP_URL` matches your Render URL

## Free Tier Limitations

- Services spin down after 15 minutes of inactivity
- First request after spin-down may take 30-60 seconds
- 750 hours/month free (enough for one always-on service)
- Consider upgrading to paid plan for production use

## Next Steps

1. Set up a custom domain (optional)
2. Configure SSL (automatic on Render)
3. Set up monitoring and alerts
4. Configure backups for your database

## Support

- [Render Documentation](https://render.com/docs)
- [Laravel on Render](https://render.com/docs/deploy-laravel)
- [Render Community](https://community.render.com)

