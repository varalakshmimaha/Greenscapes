<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\Gallery;
use App\Models\Menu;
use App\Models\PageBanner;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Setting;
use App\Models\TeamCategory;
use App\Models\Video;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Register image helper Blade directive
        Blade::directive('imageUrl', function ($path) {
            return "<?php echo \App\Helpers\ImageHelper::getImageUrl({$path}); ?>";
        });

        Blade::directive('imageExists', function ($path) {
            return "<?php echo \App\Helpers\ImageHelper::imageExists({$path}) ? 'true' : 'false'; ?>";
        });

        try {
        if (Schema::hasTable('settings') && Schema::hasTable('menus')) {
            View::composer('frontend.*', function ($view) {
                if (Schema::hasTable('page_banners')) {
                    $ctaBanner = PageBanner::where('page', 'cta')->first();
                    $view->with('ctaBanner', $ctaBanner);
                }
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

                // Navbar dropdown data
                if (Schema::hasTable('team_categories')) {
                    $view->with('navTeamCategories', TeamCategory::where('is_active', true)->orderBy('order')->get());
                }
                if (Schema::hasTable('services')) {
                    $view->with('navServices', Service::where('is_active', true)->orderBy('order')->get());
                }
                if (Schema::hasTable('service_categories')) {
                    $view->with('navServiceCategories', ServiceCategory::where('is_active', true)->orderBy('order')->with('service')->get());
                }
            });
        }
        } catch (\Exception $e) {
            // Silently fail if DB is not available (e.g. during package:discover)
        }
    }
}
