<?php

/**
 * Wachtwoord Reset Feature Tests
 * 
 * Test de complete wachtwoord reset functionaliteit inclusief:
 * - Weergave van reset request pagina
 * - Aanvragen van reset link
 * - Weergave van reset pagina met token
 * - Reset van wachtwoord met geldige token
 * - Validatie van wachtwoord eisen
 */

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Notification;
use Livewire\Volt\Volt;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('wachtwoord vergeten pagina kan worden weergegeven', function () {
    $response = $this->get(route('password.request'));

    $response->assertStatus(200);
    $response->assertSee('Wachtwoord Vergeten');
});

test('gebruikers kunnen wachtwoord reset link aanvragen', function () {
    Notification::fake();

    $user = User::factory()->create([
        'email' => 'test@barroc.nl',
    ]);

    Volt::test('auth.forgot-password')
        ->set('email', $user->email)
        ->call('sendPasswordResetLink')
        ->assertHasNoErrors();

    Notification::assertSentTo($user, ResetPassword::class);
});

test('wachtwoord reset pagina kan worden weergegeven met geldige token', function () {
    Notification::fake();

    $user = User::factory()->create();

    Volt::test('auth.forgot-password')
        ->set('email', $user->email)
        ->call('sendPasswordResetLink');

    Notification::assertSentTo($user, ResetPassword::class, function ($notification) {
        $response = $this->get(route('password.reset', $notification->token));

        $response->assertStatus(200);
        $response->assertSee('Wachtwoord Reseten');

        return true;
    });
});

test('wachtwoord kan worden gereset met geldige token', function () {
    Notification::fake();

    $user = User::factory()->create();

    Volt::test('auth.forgot-password')
        ->set('email', $user->email)
        ->call('sendPasswordResetLink');

    Notification::assertSentTo($user, ResetPassword::class, function ($notification) use ($user) {
        // Gebruik een sterk wachtwoord dat voldoet aan alle eisen
        $response = Volt::test('auth.reset-password', ['token' => $notification->token])
            ->set('email', $user->email)
            ->set('password', 'NewSecureP@ssw0rd!')
            ->set('password_confirmation', 'NewSecureP@ssw0rd!')
            ->call('resetPassword');

        $response
            ->assertHasNoErrors()
            ->assertRedirect(route('login', absolute: false));

        return true;
    });
});

test('wachtwoord reset vereist geldig email adres', function () {
    Volt::test('auth.forgot-password')
        ->set('email', 'invalid-email')
        ->call('sendPasswordResetLink')
        ->assertHasErrors(['email']);
});

test('wachtwoord moet bevestigd worden bij reset', function () {
    Notification::fake();

    $user = User::factory()->create();

    Volt::test('auth.forgot-password')
        ->set('email', $user->email)
        ->call('sendPasswordResetLink');

    Notification::assertSentTo($user, ResetPassword::class, function ($notification) use ($user) {
        $response = Volt::test('auth.reset-password', ['token' => $notification->token])
            ->set('email', $user->email)
            ->set('password', 'NewPassword123!')
            ->set('password_confirmation', 'DifferentPassword123!')
            ->call('resetPassword');

        $response->assertHasErrors(['password']);

        return true;
    });
});

test('wachtwoord moet voldoen aan sterkte eisen', function () {
    Notification::fake();

    $user = User::factory()->create();

    Volt::test('auth.forgot-password')
        ->set('email', $user->email)
        ->call('sendPasswordResetLink');

    Notification::assertSentTo($user, ResetPassword::class, function ($notification) use ($user) {
        $response = Volt::test('auth.reset-password', ['token' => $notification->token])
            ->set('email', $user->email)
            ->set('password', 'weak')
            ->set('password_confirmation', 'weak')
            ->call('resetPassword');

        $response->assertHasErrors(['password']);

        return true;
    });
});

test('ingelogde gebruikers worden doorgestuurd vanaf reset pagina', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->get(route('password.request'));

    $response->assertRedirect(route('dashboard'));
});