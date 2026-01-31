<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        \Illuminate\Support\Facades\View::composer('customer.partials.header', function ($view) {
            $view->with('navCategories', \App\Models\Category::where('show_in_nav', true)
                ->where('status', true)
                ->orderBy('sort_order')
                ->get());
        });

        // Share settings with Admin Views
        \Illuminate\Support\Facades\View::composer(['admin.*', 'admin.auth.login'], function ($view) {
            $storeName = \App\Helpers\SettingsHelper::get('store_name', 'eCommerce');
            $themeColor = \App\Helpers\SettingsHelper::get('theme_color', '#4f46e5');

            $view->with('adminSettings', [
                'store_name' => $storeName,
                'theme_color' => $themeColor,
            ]);
        });
    }
}
