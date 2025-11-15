<?php

namespace App\Livewire\Actions;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

/**
 * Logout Action
 * 
 * Handelt de logout functionaliteit af voor de applicatie.
 */
class Logout
{
    /**
     * Log de huidige gebruiker uit van de applicatie.
     * 
     * Invalideert de sessie en regenereert het CSRF token.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke()
    {
        Auth::guard('web')->logout();

        Session::invalidate();
        Session::regenerateToken();

        return redirect('/');
    }
}
