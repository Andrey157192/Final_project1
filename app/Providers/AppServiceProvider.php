<?php

namespace App\Providers;

use App\Models\AboutSetting;
use App\Actions\ResetUserPassword;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Contracts\ResetsUserPasswords;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ResetsUserPasswords::class, ResetUserPassword::class);
    }

    public function boot(): void
    {
        if (Schema::hasTable('about_settings')) {
            $about = AboutSetting::first();
            // Tambah logic jika perlu men-share $about ke view
            // View::share('about', $about);
        }
    }
}
