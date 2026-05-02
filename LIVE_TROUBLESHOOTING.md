# QUICK TROUBLESHOOTING - Run These Commands on Live Server

## Step 1: Verify Symlink Status
```bash
# Check if symlink exists and what it points to
ls -la public/storage

# If output shows: storage -> ../storage/app/public
# Then symlink is correct ✓

# If output shows something else or error, symlink is broken ✗
```

## Step 2: Verify Storage Directory Has Files
```bash
# Count total files in storage
find storage/app/public -type f | wc -l

# List directories
ls -la storage/app/public/

# Should show: banners/, blogs/, gallery/, projects/, services/, testimonials/, videos/, etc.
```

## Step 3: Check .env Configuration
```bash
# View critical settings
grep -E "^APP_URL|^FILESYSTEM_DISK|^APP_ENV" .env

# Should show:
# APP_URL=https://srgreenscapes.com
# FILESYSTEM_DISK=public
# APP_ENV=production
```

## Step 4: Test Direct File Access
```bash
# Try to access a specific image
cd ~
find htdocs/srgreenscapes.com/Greenscapes/storage/app/public -name "*.jpg" -type f | head -1

# Copy the path, for example:
# storage/app/public/gallery/5PcGoOmsj93fue9LMPiaQryBz8pawu4Iy7RbGTxI.jpg

# Test if accessible via web:
curl -I https://srgreenscapes.com/storage/gallery/5PcGoOmsj93fue9LMPiaQryBz8pawu4Iy7RbGTxI.jpg

# Should return: HTTP/1.1 200 OK
# NOT: HTTP/1.1 404 Not Found
```

## Step 5: If Symlink is Broken - Recreate It
```bash
# Remove broken symlink
rm -f public/storage

# Recreate it properly
php artisan storage:link

# Or manually create it:
ln -s ../storage/app/public public/storage

# Verify it works:
ls -la public/storage
# Should show: public/storage -> ../storage/app/public
```

## Step 6: Verify File Permissions
```bash
# Check storage directory permissions
ls -ld storage/app/public
# Should show: drwxr-xr-x (755)

# If not 755, fix it:
chmod -R 755 storage
chmod -R 755 bootstrap/cache

# Also verify ownership matches web server user:
ls -la storage/app/public/ | head
# Should be owned by www-data or similar web server user

# If not, fix ownership:
chown -R www-data:www-data storage
chown -R www-data:www-data bootstrap/cache
```

## Step 7: Clear All Caches
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan optimize:clear
```

## Step 8: Test Admin Upload
1. Login to admin: https://srgreenscapes.com/admin
2. Go to Gallery → Add Gallery Image
3. Upload a test image
4. Check if it appears in storage:
   ```bash
   ls -lat storage/app/public/gallery/ | head -5
   # Should show your newly uploaded file
   ```

## Step 9: Test Frontend Display
1. Go to https://srgreenscapes.com/gallery
2. Open browser DevTools (F12) → Network tab
3. Look for image requests
4. Check if they return 200 or 404
5. Check the exact URL being requested

## Common Issues & Solutions

### Issue: "404 Not Found" for Images
**Cause**: Symlink is broken or doesn't point to correct location
**Fix**: 
```bash
rm -f public/storage
php artisan storage:link
```

### Issue: "403 Forbidden" for Images
**Cause**: File permissions are too restrictive
**Fix**:
```bash
chmod -R 755 storage/app/public
chown -R www-data:www-data storage/app/public
```

### Issue: Images show placeholder/error
**Cause**: .env APP_URL is incorrect
**Fix**:
```bash
# Edit .env
nano .env
# Find: APP_URL=
# Change to: APP_URL=https://srgreenscapes.com
# Press Ctrl+X, Y, Enter to save

# Then clear caches
php artisan config:clear
```

### Issue: New uploads aren't showing
**Cause**: Web server user can't write to storage
**Fix**:
```bash
chown -R www-data:www-data storage
chmod -R 755 storage
chmod -R 644 storage/app/public/*/*.jpg
chmod -R 644 storage/app/public/*/*.png
```

## How to Get Help
If still broken, run the diagnostic script and share output:
```bash
# Make script executable
chmod +x LIVE_SERVER_DIAGNOSTICS.sh

# Run it
./LIVE_SERVER_DIAGNOSTICS.sh

# Share the output with your developer
```

The script will help identify exactly what's wrong!
