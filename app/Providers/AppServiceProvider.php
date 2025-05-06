<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\AboutSetting;

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
        // Ambil data AboutSetting
        $settings = AboutSetting::first();

        // Share ke semua view
        View::share('settings', $settings);

        // Kalau hanya ingin share ke partials.footer saja:
        // View::composer('partials.footer', function($view) use ($settings) {
        //     $view->with('settings', $settings);
        // });
    }
}
