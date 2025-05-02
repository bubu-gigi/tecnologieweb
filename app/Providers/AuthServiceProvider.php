<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('isAdmin', function ($user) {
            return $user -> role === 'admin';
        });

        Gate::define('isStaff', function ($user) {
            return $user -> role === 'staff';
        });

        Gate::define('isCustomer', function ($user) {
            return $user -> role === 'customer';
        });
    }
}
