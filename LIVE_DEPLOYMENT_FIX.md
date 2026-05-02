# Live Server Image Upload Fix Guide

## Problem
Images uploaded via admin panel are broken/not displaying on the live server in both admin and frontend.

## Root Causes
1. **Missing Storage Symlink** - `public/storage` symlink to `storage/app/public` doesn't exist
2. **Incorrect APP_URL** - Environment variable not set to the actual live domain
3. **File Permissions** - Storage directory lacks proper write permissions
4. **Asset URL Generation** - Using incorrect URL path for image assets

---

## LIVE SERVER FIXES (SSH into your server)

### Step 1: Fix Environment Variables
```bash
# SSH into your server
ssh username@srgreenscapes.com

# Navigate to your application
cd ~/srgreenscapes

# Edit the .env file
nano .env
```

**Update these settings in .env:**
```
APP_ENV=production
APP_DEBUG=false
APP_URL=https://srgreenscapes.com

# Make sure filesystem is set to public
FILESYSTEM_DISK=public
```

### Step 2: Create Storage Symlink
```bash
# Run Laravel's storage link command
php artisan storage:link

# You should see: The [public/storage] directory has been linked to [storage/app/public].
```

### Step 3: Fix File Permissions
```bash
# Give proper permissions to storage directory
chmod -R 755 storage
chmod -R 755 bootstrap/cache

# If you have a web user (usually www-data or nobody), set ownership
chown -R www-data:www-data storage
chown -R www-data:www-data bootstrap/cache
```

### Step 4: Clear Laravel Caches
```bash
php artisan optimize:clear
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Step 5: Verify the Fix
```bash
# Check if symlink exists
ls -la public/ | grep storage

# Should show something like:
# lrwxrwxrwx  1 username username  25 May  2 10:30 storage -> ../storage/app/public
```

---

## Quick Command (Run All at Once)
```bash
cd ~/srgreenscapes && \
php artisan storage:link && \
chmod -R 755 storage bootstrap/cache && \
php artisan optimize:clear && \
echo "✓ Storage symlink created" && \
echo "✓ Permissions fixed" && \
echo "✓ Caches cleared"
```

---

## Alternative: Without Symlink (If Server Doesn't Support Symlinks)

If your server doesn't support symlinks (some shared hosting), modify the file path handling:

### Option 1: Use Direct Storage Path
Edit your views to access images directly without the symlink:

**In Blade templates, use:**
```php
<!-- Instead of: -->
{{ asset('storage/' . $item->image) }}

<!-- Use direct path if symlink fails: -->
{{ asset('storage/' . $item->image) ?: url('/app/storage/' . $item->image) }}
```

### Option 2: Create a Custom Route
Add this to `routes/web.php`:
```php
Route::get('/storage/{path}', function ($path) {
    $fullPath = storage_path('app/public/' . $path);
    if (!file_exists($fullPath)) {
        abort(404);
    }
    return response()->file($fullPath);
})->where('path', '.*');
```

Then in your Blade templates use:
```php
{{ route('storage.file', ['path' => $item->image]) }}
```

---

## Troubleshooting

### Images Still Not Showing
1. **Check storage directory exists:**
   ```bash
   ls -la storage/app/public/
   ```

2. **Check file permissions:**
   ```bash
   ls -la storage/app/public/gallery/
   # All files should be readable (644 or 755)
   ```

3. **Check symlink:**
   ```bash
   ls -la public/storage
   # Should show a link arrow: storage -> ../storage/app/public
   ```

4. **Check browser console** (F12 → Network):
   - Look for 404 errors on image URLs
   - Check what URL the browser is trying to load
   - Verify the path exists on server

### cPanel / GoDaddy Specific Issues
- Use **File Manager** instead of terminal if SSH unavailable
- Create symlink manually: Use "Create Symbolic Link" feature
- Set permissions via **File Manager** (set to 755 for folders, 644 for files)

---

## Post-Deployment Testing

1. **Test image display in frontend:**
   - Visit home page: `https://srgreenscapes.com/`
   - Check gallery: `https://srgreenscapes.com/gallery`
   - Right-click image → Inspect → Check image URL path

2. **Test admin uploads:**
   - Login to admin: `https://srgreenscapes.com/admin/login`
   - Upload a new banner/gallery image
   - Verify it appears on frontend

3. **Check server logs:**
   ```bash
   tail -f storage/logs/laravel.log
   ```

---

## Prevention for Future Deployments

### Add Post-Deploy Script (.github/workflows/deploy.yml)
If using GitHub Actions:
```yaml
- name: Create Storage Symlink
  run: php artisan storage:link --force

- name: Fix Permissions
  run: |
    chmod -R 755 storage
    chmod -R 755 bootstrap/cache
```

### Or in deployment automation (Gitlab CI, etc.):
```bash
# After pulling code
php artisan storage:link --force
chmod -R 755 storage bootstrap/cache
php artisan optimize:clear
```

---

## Files Affected
- Storage Path: `storage/app/public/`
- Public Link: `public/storage/` (should be symlink)
- Config: `config/filesystems.php`
- Environment: `.env` (APP_URL, FILESYSTEM_DISK)

## Support
If issues persist after following these steps, check:
1. Server error logs: `storage/logs/laravel.log`
2. Web server logs: `/var/log/apache2/error.log` or `/var/log/nginx/error.log`
3. Hosting provider documentation for specific requirements
