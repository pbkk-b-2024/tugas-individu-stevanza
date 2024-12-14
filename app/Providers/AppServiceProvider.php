<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Observers\UserObserver;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        Gate::define('manage-produk', function (User $user) {
            return $user->is_admin;
        });

        // Register the UserObserver
        User::observe(UserObserver::class);
    }
}