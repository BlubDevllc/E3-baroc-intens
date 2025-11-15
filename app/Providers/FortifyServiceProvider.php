<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
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
     * Configureert Fortify views en rate limiting voor authenticatie.
     */
    public function boot(): void
    {
        // Registreer login en registratie views
        Fortify::loginView(fn () => view('livewire.auth.login'));
        Fortify::registerView(fn () => view('livewire.auth.register'));
        Fortify::requestPasswordResetLinkView(fn () => view('livewire.auth.forgot-password'));
        Fortify::resetPasswordView(fn () => view('livewire.auth.reset-password'));
        
        // 2FA VIEWS UITGESCHAKELD - Uncomment om 2FA weer in te schakelen
        // Fortify::twoFactorChallengeView(fn () => view('livewire.auth.two-factor-challenge'));
        // Fortify::confirmPasswordView(fn () => view('livewire.auth.confirm-password'));

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->email.$request->ip());
        });

        // 2FA Rate limiter uitgeschakeld
        // RateLimiter::for('two-factor', function (Request $request) {
        //     return Limit::perMinute(5)->by($request->session()->get('login.id'));
        // });
    }
}
