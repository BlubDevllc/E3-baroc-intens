<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
        {{-- Welkom Header --}}
        <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 p-6">
            <h1 class="text-2xl font-bold text-neutral-900 dark:text-neutral-100">
                Welkom, {{ Auth::user()->name }}! 
            </h1>
            <p class="mt-2 text-neutral-600 dark:text-neutral-400">
                Je bent succesvol ingelogd op het Barroc Intens dashboard.
            </p>
        </div>

        {{-- Dashboard Cards --}}
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            {{-- Mijn Profiel --}}
            <a href="{{ route('profile.edit') }}" class="group relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 p-6 hover:border-neutral-300 dark:hover:border-neutral-600 transition-colors">
                <div class="flex items-start justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-neutral-900 dark:text-neutral-100">Mijn Profiel</h3>
                        <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-400">Bekijk en bewerk je profielgegevens</p>
                    </div>
                    <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            </a>

            {{-- Wachtwoord Wijzigen --}}
            <a href="{{ route('password.edit') }}" class="group relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 p-6 hover:border-neutral-300 dark:hover:border-neutral-600 transition-colors">
                <div class="flex items-start justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-neutral-900 dark:text-neutral-100">Beveiliging</h3>
                        <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-400">Wachtwoord en 2FA beheren</p>
                    </div>
                    <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
            </a>

            {{-- Instellingen --}}
            <a href="{{ route('appearance.edit') }}" class="group relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 p-6 hover:border-neutral-300 dark:hover:border-neutral-600 transition-colors">
                <div class="flex items-start justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-neutral-900 dark:text-neutral-100">Instellingen</h3>
                        <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-400">Personaliseer je ervaring</p>
                    </div>
                    <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
            </a>
        </div>

        {{-- Account Informatie --}}
        <div class="relative flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 p-6">
            <h2 class="text-xl font-semibold text-neutral-900 dark:text-neutral-100 mb-4">Account Informatie</h2>
            <div class="space-y-3">
                <div class="flex justify-between py-2 border-b border-neutral-200 dark:border-neutral-700">
                    <span class="text-neutral-600 dark:text-neutral-400">Email:</span>
                    <span class="font-medium text-neutral-900 dark:text-neutral-100">{{ Auth::user()->email }}</span>
                </div>
                <div class="flex justify-between py-2 border-b border-neutral-200 dark:border-neutral-700">
                    <span class="text-neutral-600 dark:text-neutral-400">Account aangemaakt:</span>
                    <span class="font-medium text-neutral-900 dark:text-neutral-100">{{ Auth::user()->created_at->format('d-m-Y') }}</span>
                </div>
                <div class="flex justify-between py-2 border-b border-neutral-200 dark:border-neutral-700">
                    <span class="text-neutral-600 dark:text-neutral-400">Laatste login:</span>
                    <span class="font-medium text-neutral-900 dark:text-neutral-100">Vandaag om {{ now()->format('H:i') }}</span>
                </div>
                <div class="flex justify-between py-2">
                    <span class="text-neutral-600 dark:text-neutral-400">Two-Factor Authentication:</span>
                    <span class="font-medium {{ Auth::user()->two_factor_secret ? 'text-green-600' : 'text-neutral-500' }}">
                        {{ Auth::user()->two_factor_secret ? '✓ Actief' : '○ Niet actief' }}
                    </span>
                </div>
            </div>
            
            <div class="mt-6 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                <p class="text-sm text-blue-800 dark:text-blue-200">
                    <strong>💡 Tip:</strong> Vergeet niet om je wachtwoord regelmatig te wijzigen en twee-factor authenticatie in te schakelen voor extra beveiliging!
                </p>
            </div>
        </div>
    </div>
</x-layouts.app>
