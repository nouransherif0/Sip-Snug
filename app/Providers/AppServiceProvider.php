<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\Rules\Password;
use Illuminate\Pagination\Paginator;

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
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        Password::defaults(function () {
            return Password::min(8)
                           ->letters()
                           ->numbers()
                           ->symbols();
        });

        Paginator::useBootstrapFive();

        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('store_locations')) {
                \Illuminate\Support\Facades\View::share(
                    'storeLocations',
                    \App\Models\StoreLocation::where('is_active', true)->orderBy('id', 'asc')->get()
                );
            }
        } catch (\Exception $e) {
            // Ignore schema exception before migration runs
        }
    }
}
