<?php

/**
 * Authenticatie Routes
 * 
 * Bevat alle routes voor authenticatie functionaliteit:
 * - Login/Logout
 * - Registratie
 * - Wachtwoord reset
 * - Email verificatie
 */

use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// Guest routes - alleen toegankelijk voor niet-ingelogde gebruikers
Route::middleware('guest')->group(function () {
    Volt::route('login', 'auth.login')
        ->name('login');

    Volt::route('register', 'auth.register')
        ->name('register');

    Volt::route('forgot-password', 'auth.forgot-password')
        ->name('password.request');

    Volt::route('reset-password/{token}', 'auth.reset-password')
        ->name('password.reset');
});

// Authenticated routes - vereisen ingelogde gebruiker
Route::middleware('auth')->group(function () {
    Volt::route('verify-email', 'auth.verify-email')
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
});

// Logout route - beschikbaar voor ingelogde gebruikers
Route::post('logout', App\Livewire\Actions\Logout::class)
    ->name('logout');
