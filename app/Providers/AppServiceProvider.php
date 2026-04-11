<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\Setting;
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
            });
        }
    }
}
