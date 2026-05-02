#!/bin/bash
# Live Server Diagnostics Script
# Run this on your live server to diagnose image upload issues

echo "=========================================="
echo "SR GREENSCAPES - IMAGE UPLOAD DIAGNOSTICS"
echo "=========================================="
echo ""

# 1. Check symlink status
echo "1. CHECKING SYMLINK STATUS"
echo "=================================="
if [ -L public/storage ]; then
    echo "✓ Symlink exists"
    LINK_TARGET=$(readlink public/storage)
    echo "  Target: $LINK_TARGET"
    
    if [ -d "$LINK_TARGET" ]; then
        echo "  ✓ Target directory exists"
        TARGET_FILES=$(find "$LINK_TARGET" -type f | wc -l)
        echo "  Files in target: $TARGET_FILES"
    else
        echo "  ✗ Target directory DOES NOT EXIST"
        echo "  Symlink is BROKEN!"
    fi
else
    echo "✗ Symlink does not exist"
fi
echo ""

# 2. Check if direct path exists
echo "2. CHECKING STORAGE DIRECTORY"
echo "=================================="
if [ -d "storage/app/public" ]; then
    echo "✓ storage/app/public directory exists"
    STORAGE_FILES=$(find storage/app/public -type f | wc -l)
    echo "  Total files: $STORAGE_FILES"
    
    # List subdirectories
    echo "  Subdirectories:"
    ls -ld storage/app/public/*/ 2>/dev/null | awk '{print "    " $9}'
    echo ""
    
    # Check specific directories
    for dir in gallery banners blogs projects services testimonials team videos; do
        if [ -d "storage/app/public/$dir" ]; then
            FILE_COUNT=$(find "storage/app/public/$dir" -type f 2>/dev/null | wc -l)
            echo "  - $dir: $FILE_COUNT files"
        fi
    done
else
    echo "✗ storage/app/public directory DOES NOT EXIST"
fi
echo ""

# 3. Check file permissions
echo "3. CHECKING FILE PERMISSIONS"
echo "=================================="
echo "Storage directory permissions:"
ls -ld storage/app/public
echo ""
echo "Sample file permissions (first 5):"
find storage/app/public -type f 2>/dev/null | head -5 | while read file; do
    ls -lh "$file"
done
echo ""

# 4. Check .env configuration
echo "4. CHECKING ENVIRONMENT CONFIGURATION"
echo "=================================="
echo "APP_URL setting:"
grep "^APP_URL=" .env | head -1
echo ""
echo "FILESYSTEM_DISK setting:"
grep "^FILESYSTEM_DISK=" .env | head -1
echo ""
echo "APP_ENV setting:"
grep "^APP_ENV=" .env | head -1
echo ""

# 5. Test one image URL
echo "5. TESTING IMAGE AVAILABILITY"
echo "=================================="
SAMPLE_IMAGE=$(find storage/app/public -type f -name "*.jpg" -o -name "*.png" 2>/dev/null | head -1)
if [ -n "$SAMPLE_IMAGE" ]; then
    echo "Sample image found: $SAMPLE_IMAGE"
    
    # Extract relative path
    REL_PATH=${SAMPLE_IMAGE#storage/app/public/}
    echo "Relative path: $REL_PATH"
    
    # Get APP_URL from .env
    APP_URL=$(grep "^APP_URL=" .env | cut -d'=' -f2)
    echo "Expected URL: $APP_URL/storage/$REL_PATH"
    
    # Test if file is accessible via web
    echo ""
    echo "Testing accessibility..."
    HTTP_STATUS=$(curl -s -o /dev/null -w "%{http_code}" "$APP_URL/storage/$REL_PATH" 2>/dev/null || echo "connection-error")
    echo "HTTP Status: $HTTP_STATUS"
    
    if [ "$HTTP_STATUS" = "200" ]; then
        echo "✓ Image is accessible via web"
    elif [ "$HTTP_STATUS" = "404" ]; then
        echo "✗ Image returns 404 - Not Found"
    elif [ "$HTTP_STATUS" = "403" ]; then
        echo "✗ Image returns 403 - Permission Denied"
    else
        echo "✗ Unexpected status or connection error"
    fi
else
    echo "No images found in storage directory"
fi
echo ""

# 6. Check web server user
echo "6. CHECKING WEB SERVER CONFIGURATION"
echo "=================================="
echo "Current user: $(whoami)"
echo "Web server processes:"
ps aux | grep -E 'apache|nginx|httpd|www-data' | grep -v grep | head -3
echo ""

# 7. Final recommendations
echo "7. RECOMMENDATIONS"
echo "=================================="
echo ""
echo "If images are still broken after this diagnostic:"
echo ""
echo "Option A: Remove and recreate the symlink"
echo "  rm -f public/storage"
echo "  php artisan storage:link"
echo ""
echo "Option B: Fix broken symlink (if it points to wrong location)"
echo "  rm -f public/storage"
echo "  ln -s ../storage/app/public public/storage"
echo ""
echo "Option C: Verify .env has correct APP_URL"
echo "  nano .env"
echo "  Look for: APP_URL=https://srgreenscapes.com"
echo ""
echo "Option D: Ensure web server user owns storage"
echo "  chown -R www-data:www-data storage bootstrap/cache"
echo "  chmod -R 755 storage bootstrap/cache"
echo ""
echo "=========================================="
echo "END OF DIAGNOSTICS"
echo "=========================================="
