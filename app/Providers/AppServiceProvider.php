<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('currency', function ($expression) {
            return "Rp<?php echo number_format($expression,0,',','.'); ?>,00";
        });

        Gate::define('admin', function (User $user) {
            return $user->is_admin;
        });

        Gate::define('verified', function (User $user) {
            return $user->user_verified_at;
        });

        Gate::define('not_verified', function (User $user) {
            return !$user->user_verified_at;
        });
    }
}
