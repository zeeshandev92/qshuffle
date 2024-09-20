<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;

use Illuminate\Support\ServiceProvider;

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
        // get all data from menu.json file
        $menuJson = file_get_contents(base_path('resources/data/menu.json'));
        $menuData = json_decode($menuJson);

        // Share all menuData to all the views
        View::share('menuData', $menuData);
    }
}
