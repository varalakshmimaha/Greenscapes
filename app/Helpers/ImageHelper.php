<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;

class ImageHelper
{
    /**
     * Get the correct URL for stored images
     * Works with or without storage symlink
     */
    public static function getImageUrl($path)
    {
        if (empty($path)) {
            return null;
        }

        // If it's already a full URL, return as-is
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        // Check if storage symlink exists and is valid
        $symlink = public_path('storage');
        if (is_link($symlink) || is_dir($symlink)) {
            // Symlink exists, use normal asset path
            return asset('storage/' . $path);
        }

        // Fallback: Check if file exists in storage directory directly
        $storagePath = storage_path('app/public/' . $path);
        if (file_exists($storagePath)) {
            // Return direct storage path
            $appUrl = config('app.url');
            return $appUrl . '/storage/' . $path;
        }

        // Last resort: return asset path and let Laravel handle it
        return asset('storage/' . $path);
    }

    /**
     * Get image URL with optional fallback image
     */
    public static function getImageUrlWithFallback($path, $fallback = null)
    {
        $url = self::getImageUrl($path);

        // Verify the file actually exists
        $storagePath = storage_path('app/public/' . $path);
        if (!file_exists($storagePath)) {
            return $fallback ?? asset('images/placeholder.png');
        }

        return $url;
    }

    /**
     * Check if image file exists
     */
    public static function imageExists($path)
    {
        if (empty($path)) {
            return false;
        }

        return file_exists(storage_path('app/public/' . $path));
    }
}
