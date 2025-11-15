<?php

/**
 * Web Routes
 * 
 * Bevat de primaire applicatie routes voor:
 * - Dashboard
 * - Instellingen (profiel, wachtwoord, appearance, 2FA)
 * - Home route (redirect naar login)
 */

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

// Home route - redirect naar login voor guests
Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

// Dashboard - vereist authenticatie en geverifieerde email
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Settings routes - alleen voor ingelogde gebruikers
Route::middleware(['auth'])->group(function () {
    // Redirect /settings naar /settings/profile
    Route::redirect('settings', 'settings/profile');

    // Profiel instellingen
    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    
    // Wachtwoord wijzigen
    Volt::route('settings/password', 'settings.password')->name('password.edit');
    
    // Appearance instellingen (dark mode, etc.)
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    // Two-factor authentication (met optionele password confirmation)
    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

// Laad authenticatie routes
require __DIR__.'/auth.php';
