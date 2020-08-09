<?php

namespace App\Providers;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('admin', function() {
            return "<?php if(Auth::check() && Auth::user()->isAdmin()): ?>";
        });

        Blade::directive('endAdmin', function() {
            return "<?php endif; ?>";
        });
    }
}
