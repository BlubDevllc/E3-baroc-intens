<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Volt\Volt;

class VoltServiceProvider extends ServiceProvider
{
    /**
     * Registreer Volt services.
     */
    public function register(): void
    {
        // Geen services om te registreren
    }

    /**
     * Bootstrap Volt services.
     * 
     * Mount Volt directories voor single-file Livewire componenten.
     */
    public function boot(): void
    {
        Volt::mount([
            config('livewire.view_path', resource_path('views/livewire')),
            resource_path('views/pages'),
        ]);
    }
}
