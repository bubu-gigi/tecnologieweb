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
            return $user -> ruolo === 'admin';
        });

        Gate::define('isTecnicoAssistenza', function ($user) {
            return $user -> ruolo === 'tecnico_assistenza';
        });

        Gate::define('isTecnicoAzienda', function ($user) {
            return $user -> ruolo === 'tecnico_azienda';
        });
    }
}
