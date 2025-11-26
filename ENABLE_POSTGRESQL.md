# Enable PostgreSQL Extensions in PHP

## Problem
Migration failed with: `could not find driver (Connection: pgsql...)`

This means the PostgreSQL PDO driver is not enabled in your PHP installation.

## Solution

### Step 1: Open php.ini File
Your PHP configuration file is located at: `C:\xampp\php\php.ini`

1. Open this file in **Notepad** or your code editor
2. Press `Ctrl + F` to search

### Step 2: Enable PostgreSQL Extensions

Search for these lines (they will have a semicolon `;` at the start):

```ini
;extension=pdo_pgsql
;extension=pgsql
```

**Remove the semicolon** from both lines to make them:

```ini
extension=pdo_pgsql
extension=pgsql
```

### Step 3: Save and Restart

1. **Save** the `php.ini` file
2. **Restart Apache** in XAMPP Control Panel:
   - Open XAMPP Control Panel
   - Click "Stop" on Apache
   - Wait 2 seconds
   - Click "Start" on Apache

### Step 4: Verify Installation

Open PowerShell and run:

```powershell
php -m | findstr pgsql
```

You should see:
```
pdo_pgsql
pgsql
```

### Step 5: Run Migrations

Once verified, run:

```powershell
cd C:\Users\patri\Desktop\WEBSITES\PHP\SmartHostelManagementSystem-Laravel
php artisan migrate
```

---

## Quick Commands

```powershell
# 1. Check current extensions
php -m | findstr pdo

# 2. Find php.ini location
php --ini

# 3. After enabling extensions, verify
php -m | findstr pgsql

# 4. Run migrations
php artisan migrate
```

---

## Need Help?

If you can't find the extensions in php.ini, search for:
- `extension=pdo_pgsql`
- `extension=pgsql`

If they don't exist, add these two lines in the "Dynamic Extensions" section.
