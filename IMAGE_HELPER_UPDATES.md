# Image URL Helper Updates

## New Image Helper System

A new `ImageHelper` class has been added to make image URLs work reliably, even if the storage symlink is missing or misconfigured.

### Files Added
- `app/Helpers/ImageHelper.php` - Image URL helper with fallback support
- Updated `app/Providers/AppServiceProvider.php` - Added Blade directives

### How to Use

#### Option 1: Use in Blade Views (Recommended)
```blade
<!-- Old way: -->
<img src="{{ asset('storage/' . $item->image) }}" alt="Image">

<!-- New way (more reliable): -->
<img src="@imageUrl($item->image)" alt="Image">
```

#### Option 2: Use in PHP (Controllers, etc.)
```php
use App\Helpers\ImageHelper;

// Get reliable image URL
$url = ImageHelper::getImageUrl($item->image);

// Get with fallback if file missing
$url = ImageHelper::getImageUrlWithFallback($item->image, asset('images/placeholder.png'));

// Check if image exists
if (ImageHelper::imageExists($item->image)) {
    // do something
}
```

---

## Files That Need Updating

### Admin Views
Update these files to use `@imageUrl()` instead of `asset('storage/')`:
- `resources/views/admin/gallery/edit.blade.php`
- `resources/views/admin/banners/edit.blade.php` 
- `resources/views/admin/blogs/edit.blade.php`
- `resources/views/admin/service-categories/edit.blade.php`
- `resources/views/admin/service-subcategories/edit.blade.php`
- `resources/views/admin/testimonials/edit.blade.php`
- `resources/views/admin/team/edit.blade.php`
- `resources/views/admin/about/edit.blade.php`
- `resources/views/admin/projects/edit.blade.php`
- `resources/views/admin/settings/logo.blade.php`
- `resources/views/admin/settings/brochure.blade.php`

### Frontend Views
Update these files to use `@imageUrl()`:
- `resources/views/frontend/gallery.blade.php`
- `resources/views/frontend/home.blade.php`
- `resources/views/frontend/about.blade.php`
- `resources/views/frontend/projects.blade.php`
- `resources/views/frontend/project-detail.blade.php`
- `resources/views/frontend/blogs.blade.php`
- `resources/views/frontend/blog-detail.blade.php`
- `resources/views/frontend/testimonials.blade.php`
- `resources/views/frontend/services.blade.php`
- `resources/views/frontend/our-team.blade.php`
- `resources/views/frontend/layouts/app.blade.php` (footer partials)

---

## Update Pattern

Replace this pattern:
```blade
{{ asset('storage/' . $variable->image) }}
```

With this:
```blade
@imageUrl($variable->image)
```

---

## Example Updates

### Gallery Image (Before)
```blade
<img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title ?? 'Gallery' }}">
```

### Gallery Image (After)
```blade
<img src="@imageUrl($item->image)" alt="{{ $item->title ?? 'Gallery' }}">
```

---

## Testing After Updates

1. **Test on local server:**
   ```bash
   php artisan serve
   # Check if all images load
   ```

2. **Test on live server:**
   ```bash
   # SSH into server
   cd ~/srgreenscapes
   php artisan storage:link
   # Test frontend and admin images
   ```

3. **Check browser console:**
   - Press F12 → Network tab
   - Look for any broken image URLs (404 errors)
   - Verify image paths are correct

---

## Notes

- The `@imageUrl()` directive automatically checks for symlink and provides fallback
- Works whether or not the `public/storage` symlink exists
- Gracefully handles missing files
- Can be combined with caching for performance

## Configuration

To use a default placeholder image:
```blade
<!-- In a view, create a reusable macro: -->
@macro('imageOrPlaceholder')
    <img src="@imageUrl($image) ?: {{ asset('images/placeholder.png') }}" alt="Image">
@endmacro
```
