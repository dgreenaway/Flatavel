<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

// Service providers are how Laravel boots things when the app starts.
// This one loads the site settings from JSON and shares them with every
// view. Without this I'd have to pass $settings from every single controller.

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $path = base_path('content/settings.json');

        // Read the settings file if it exists, otherwise use an empty array.
        // This stops the app breaking if the file gets deleted or on a fresh clone.
        $settings = File::exists($path)
            ? json_decode(File::get($path), true)
            : [];

        // View::share() pushes $settings into every single Blade view automatically.
        // That's why layout.blade.php can use $settings without any controller passing it.
        View::share('settings', $settings);
    }
}
