<x-layouts.app :title="__('Dashboard')">
    @php
        $userRole = Auth::user()->role ?? 'employee';
    @endphp

    {{-- 2FA Reminder Banner --}}
    @if(session('show_2fa_reminder') || (!Auth::user()->two_factor_secret))
        <div class="mx-6 mt-6 mb-4 bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-lg shadow-sm" x-data="{ show: true }" x-show="show">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div class="ml-3 flex-1">
                    <h3 class="text-sm font-medium text-yellow-800">
                         Beveilig je account met Two-Factor Authentication
                    </h3>
                    <div class="mt-2 text-sm text-yellow-700">
                        <p>Voor extra beveiliging raden we sterk aan om 2FA in te schakelen. Dit duurt maar 2 minuten!</p>
                    </div>
                    <div class="mt-4 flex gap-3">
                        <a href="{{ route('two-factor.show') }}" class="inline-flex items-center px-4 py-2 bg-yellow-400 hover:bg-yellow-500 text-gray-900 text-sm font-semibold rounded-lg transition">
                             2FA Nu Inschakelen
                        </a>
                        <button @click="show = false" class="inline-flex items-center px-4 py-2 bg-white hover:bg-gray-50 text-gray-700 text-sm font-medium rounded-lg border border-gray-300 transition">
                            Later
                        </button>
                    </div>
                </div>
                <div class="ml-auto pl-3">
                    <button @click="show = false" class="inline-flex text-gray-400 hover:text-gray-500">
                        <span class="sr-only">Sluiten</span>
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    @endif

    @if($userRole === 'management')
        @include('dashboards.management')
    @elseif($userRole === 'sales')
        @include('dashboards.sales')
    @elseif($userRole === 'inkoop')
        @include('dashboards.inkoop')
    @elseif($userRole === 'finance')
        @include('dashboards.finance')
    @elseif($userRole === 'onderhoud' || $userRole === 'planning')
        @include('dashboards.onderhoud')
    @else
        {{-- Default Dashboard --}}
        <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl p-6">
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
                    <strong> Tip:</strong> Vergeet niet om je wachtwoord regelmatig te wijzigen en twee-factor authenticatie in te schakelen voor extra beveiliging!
                </p>
            </div>
        </div>
        </div>
    @endif
</x-layouts.app>
