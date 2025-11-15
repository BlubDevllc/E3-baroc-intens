<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Registreer applicatie services.
     */
    public function register(): void
    {
        // Geen services om te registreren
    }

    /**
     * Bootstrap applicatie services.
     * 
     * Configureert password validatie regels volgens beveiligingseisen.
     */
    public function boot(): void
    {
        // Password validatie regels volgens beveiligingseisen
        Password::defaults(function () {
            return Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised();
        });
    }
}
