<?php

/**
 * Wachtwoord Vergeten Component
 * 
 * Stelt gebruikers in staat om een wachtwoord reset link aan te vragen.
 * Verstuurt een email met reset instructies naar het opgegeven email adres.
 */

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Validate('required|string|email')]
    public string $email = '';

    /**
     * Verstuur een wachtwoord reset link naar het opgegeven email adres.
     * 
     * Gebruikt Laravel's ingebouwde Password reset functionaliteit om
     * een beveiligde reset link te genereren en te versturen.
     * 
     * @return void
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate();

        // Verstuur reset link - geeft altijd succes om email enumeration te voorkomen
        Password::sendResetLink($this->only('email'));

        session()->flash('status', 'Als het account bestaat, wordt er een reset link verstuurd naar het opgegeven email adres.');
    }
}; ?>

<div class="flex flex-col gap-6">
    <!-- Header -->
    <div class="text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-yellow-400 mb-4">
            <svg class="w-8 h-8 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
            </svg>
        </div>
        <h1 class="text-2xl font-bold text-gray-900 mb-2">Wachtwoord Vergeten</h1>
        <p class="text-gray-600">Voer uw email adres in om een reset link te ontvangen</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form method="POST" wire:submit="sendPasswordResetLink" class="flex flex-col gap-6">
        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-900 mb-2">Email Adres</label>
            <input
                wire:model="email"
                id="email"
                type="email"
                required
                autofocus
                autocomplete="email"
                placeholder="uw.email@example.com"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 outline-none transition"
            />
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <button
            type="submit"
            class="w-full bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold py-3 px-4 rounded-lg transition duration-200 shadow-sm"
            data-test="email-password-reset-link-button"
        >
            Verstuur Reset Link
        </button>
    </form>

    <!-- Terug naar login link -->
    <div class="text-center text-sm text-gray-600">
        <span>Of, </span>
        <a href="{{ route('login') }}" wire:navigate class="text-yellow-600 hover:text-yellow-700 font-medium">
            keer terug naar inloggen
        </a>
    </div>
</div>
