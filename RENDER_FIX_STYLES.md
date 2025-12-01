# Fix: Styles Not Loading on Render

## Problem
CSS/styles are not loading on your deployed Render application.

## Solution

### Step 1: Verify APP_URL in Render

1. Go to your Render Dashboard
2. Select your web service: `SmartHostelManagement`
3. Go to **Environment** tab
4. Check if `APP_URL` is set to: `https://smarthostelmanagement.onrender.com`
   - If it's missing or incorrect, add/update it:
     ```
     APP_URL=https://smarthostelmanagement.onrender.com
     ```
5. **Save** the changes
6. **Redeploy** your service (Render will auto-redeploy when you save env vars)

### Step 2: Clear Laravel Cache (After Redeploy)

Once redeployed, go to **Shell** tab in Render and run:

```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

### Step 3: Verify Asset Files

The CSS files should be in:
- `/public/css/webflow-design-system.css`
- `/public/css/frontend.css`

These are already in your repository, so they should be accessible at:
- `https://smarthostelmanagement.onrender.com/css/webflow-design-system.css`
- `https://smarthostelmanagement.onrender.com/css/frontend.css`

### Step 4: Test Direct Access

Open these URLs in your browser to verify files are accessible:
- https://smarthostelmanagement.onrender.com/css/webflow-design-system.css
- https://smarthostelmanagement.onrender.com/css/frontend.css

If you get 404 errors, the files aren't being served correctly.

## Alternative: Use Absolute URLs

If the issue persists, you can temporarily hardcode the asset URLs in your layout file:

**In `resources/views/layouts/frontend.blade.php`**, change:
```php
<link rel="stylesheet" href="{{ asset('css/webflow-design-system.css') }}">
<link rel="stylesheet" href="{{ asset('css/frontend.css') }}">
```

To:
```php
<link rel="stylesheet" href="https://smarthostelmanagement.onrender.com/css/webflow-design-system.css">
<link rel="stylesheet" href="https://smarthostelmanagement.onrender.com/css/frontend.css">
```

## Common Issues

### Issue 1: APP_URL Not Set
**Symptom**: Asset URLs are relative or point to localhost
**Fix**: Set `APP_URL=https://smarthostelmanagement.onrender.com` in Render

### Issue 2: Assets Not Built
**Symptom**: Vite assets (if used) not loading
**Fix**: Ensure `npm run build` runs during Docker build (already in Dockerfile)

### Issue 3: Public Directory Not Served
**Symptom**: All assets return 404
**Fix**: `php artisan serve` automatically serves from `public/`, so this should work

### Issue 4: Cached Config
**Symptom**: Changes not reflecting
**Fix**: Run `php artisan config:clear` in Render Shell

## Quick Fix Script

Run this in Render Shell after setting APP_URL:

```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Then refresh your browser with hard refresh (Ctrl+Shift+R or Cmd+Shift+R).

