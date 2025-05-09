<?php

namespace App\Providers;

use App\Models\AboutSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
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
        if (Schema::hasTable('about_settings')) {
            $about = AboutSetting::first(); // atau kode lain yang memanggil tabel ini
        }
    }
}
