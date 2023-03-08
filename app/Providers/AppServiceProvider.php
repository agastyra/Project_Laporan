<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
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
        Paginator::useBootstrap();

        Gate::define('office', function (User $user) {
            return $user->jabatan != 1;
        });

        Gate::define('cashier', function (User $user) {
            return $user->jabatan != 2;
        });

        Gate::define('cashier.tetap', function (User $user) {
            if (($user->jabatan == 1 && $user->status == 2) || $user->jabatan == 3) {
                return true;
            } else {
                return false;
            }
        });

        Gate::define('office.tetap', function (User $user) {
            if (($user->jabatan == 2 && $user->status == 2) || $user->jabatan == 3) {
                return true;
            } else {
                return false;
            }
        });
    }
}
