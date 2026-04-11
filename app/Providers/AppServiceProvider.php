<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\Gallery;
use App\Models\Menu;
use App\Models\Setting;
use App\Models\Video;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (Schema::hasTable('settings') && Schema::hasTable('menus')) {
            View::composer('frontend.*', function ($view) {
                $view->with('siteSettings', Setting::pluck('value', 'key'));
                $view->with('navMenus', Menu::whereNull('parent_id')
                    ->where('is_active', true)
                    ->orderBy('order')
                    ->with(['children' => function ($q) {
                        $q->where('is_active', true)->orderBy('order');
                    }])
                    ->get());

                // Footer data
                if (Schema::hasTable('blogs')) {
                    $view->with('footerBlogs', Blog::where('is_published', true)->latest('published_at')->take(3)->get());
                }
                if (Schema::hasTable('galleries')) {
                    $view->with('footerGallery', Gallery::where('is_active', true)->orderBy('order')->take(6)->get());
                }
                if (Schema::hasTable('videos')) {
                    $view->with('footerVideos', Video::where('is_active', true)->orderBy('order')->take(1)->get());
                }
            });
        }
    }
}
