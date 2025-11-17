<?php

/**
 * Wachtwoord Reset Component
 * 
 * Stelt gebruikers in staat om hun wachtwoord te reseten via een
 * beveiligde reset link die ze per email hebben ontvangen.
 */

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Locked]
    public string $token = '';
    
    #[Validate('required|string|email')]
    public string $email = '';
    
    #[Validate('required|string|confirmed', as: 'wachtwoord')]
    public string $password = '';
    
    public string $password_confirmation = '';

    /**
     * Initialiseer het component met de reset token.
     * 
     * @param string $token De beveiligde reset token uit de URL
     * @return void
     */
    public function mount(string $token): void
    {
        $this->token = $token;

        $this->email = request()->string('email');
    }

    /**
     * Reset het wachtwoord voor de opgegeven gebruiker.
     * 
     * Valideert de token en email, reset het wachtwoord en logt
     * de gebruiker automatisch in na succesvolle reset.
     * 
     * @return void
     */
    public function resetPassword(): void
    {
        $this->validate([
            'token' => ['required'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        // Probeer het wachtwoord te reseten met de opgegeven credentials
        $status = Password::reset(
            $this->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) {
                $user->forceFill([
                    'password' => Hash::make($this->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // Controleer of het wachtwoord succesvol is gereset
        if ($status !== Password::PasswordReset) {
            $this->addError('email', 'De reset link is ongeldig of verlopen. Vraag een nieuwe aan.');
            return;
        }

        // Toon succes bericht en redirect naar login
        Session::flash('status', 'Uw wachtwoord is succesvol gereset. U kunt nu inloggen met uw nieuwe wachtwoord.');

        $this->redirectRoute('login', navigate: true);
    }
}; ?>

<div class="flex flex-col gap-6">
    <!-- Header -->
    <div class="text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-yellow-400 mb-4">
            <svg class="w-8 h-8 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
        </div>
        <h1 class="text-2xl font-bold text-gray-900 mb-2">Wachtwoord Reseten</h1>
        <p class="text-gray-600">Voer uw nieuwe wachtwoord in</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form method="POST" wire:submit="resetPassword" class="flex flex-col gap-6">
        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-900 mb-2">Email Adres</label>
            <input
                wire:model="email"
                id="email"
                type="email"
                required
                autocomplete="email"
                placeholder="uw.email@example.com"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 outline-none transition"
            />
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-900 mb-2">Nieuw Wachtwoord</label>
            <input
                wire:model="password"
                id="password"
                type="password"
                required
                autocomplete="new-password"
                placeholder="Minimaal 8 karakters"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 outline-none transition"
            />
            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
            <p class="mt-1 text-xs text-gray-500">Minimaal 8 karakters, hoofdletters, kleine letters, cijfers en symbolen</p>
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-900 mb-2">Bevestig Wachtwoord</label>
            <input
                wire:model="password_confirmation"
                id="password_confirmation"
                type="password"
                required
                autocomplete="new-password"
                placeholder="Herhaal uw wachtwoord"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 outline-none transition"
            />
            @error('password_confirmation')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <button
            type="submit"
            class="w-full bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold py-3 px-4 rounded-lg transition duration-200 shadow-sm"
            data-test="reset-password-button"
        >
            Reset Wachtwoord
        </button>
    </form>
</div>
