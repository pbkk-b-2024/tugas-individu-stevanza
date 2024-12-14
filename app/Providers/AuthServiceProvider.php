<?php

namespace App\Providers;

use App\Models\Produk;
use App\Models\Service;
use App\Policies\ProdukPolicy;
use App\Policies\ServicePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Produk::class => ProdukPolicy::class,
        Service::class => ServicePolicy::class,
    ];

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->registerPolicies();

        // Register gates here if needed
        Gate::define('manageBookings', function ($user) {
            return $user->role === 'admin';
        });
    }
}