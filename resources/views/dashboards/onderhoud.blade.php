{{-- Onderhoud Dashboard --}}
<div class="p-6 space-y-6">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Onderhoud Afdeling</h1>
            <p class="text-gray-600">Beheer onderhoudsopdrachten en planning</p>
        </div>
        <button class="px-4 py-2 bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold rounded-lg">
             Rapport Inplannen
        </button>
    </div>

    {{-- Urgent Alerts --}}
    <div class="bg-orange-50 border border-orange-200 rounded-lg p-4">
        <div class="flex items-start gap-3">
            <span class="text-xl">🔧</span>
            <div>
                <h3 class="font-semibold text-orange-900">Spoedopdrachten</h3>
                <p class="text-sm text-orange-700">Je hebt 2 spoedopdrachten die vandaag nog afgehandeld moeten worden.</p>
            </div>
        </div>
    </div>

    {{-- Maintenance Overview --}}
    <div class="bg-white rounded-lg border border-gray-200">
        <div class="border-b border-gray-200 px-6 py-4">
            <h2 class="text-xl font-semibold text-gray-900">Onderhoudsafdeling</h2>
            <p class="text-sm text-gray-600">Overzicht van alle geplande onderhoudswerkzaamheden</p>
        </div>

        {{-- Stats --}}
        <div class="grid grid-cols-4 gap-4 p-6 border-b border-gray-200">
            <div>
                <div class="text-sm text-gray-600">Actieve Klanten</div>
                <div class="text-2xl font-bold text-gray-900 mt-1">42</div>
            </div>
            <div>
                <div class="text-sm text-gray-600">Ingeplande Opdrachten</div>
                <div class="text-2xl font-bold text-gray-900 mt-1">18</div>
            </div>
            <div>
                <div class="text-sm text-gray-600">Wachtend op Goedkeuring</div>
                <div class="text-2xl font-bold text-gray-900 mt-1">5</div>
            </div>
            <div>
                <div class="text-sm text-gray-600">Spoedopdrachten</div>
                <div class="text-2xl font-bold text-red-600 mt-1">2</div>
            </div>
        </div>

        {{-- Mijn Afspraken --}}
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Mijn Afspraken</h3>
            <div class="space-y-3">
                @foreach([
                    ['client' => 'Grandcafé Central', 'type' => 'Storing', 'date' => '2025-11-10', 'time' => '09:00 - 11:00', 'priority' => 'Spoed', 'status' => 'ingepland'],
                    ['client' => 'Café De Boon', 'type' => 'Onderhoud', 'date' => '2025-11-10', 'time' => '14:00 - 16:00', 'priority' => 'Normaal', 'status' => 'ingepland'],
                    ['client' => 'Koffietheek', 'type' => 'Reparatie', 'date' => '2025-11-11', 'time' => '10:00 - 12:00', 'priority' => 'Spoed', 'status' => 'bevestigd']
                ] as $appointment)
                    <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                        <div class="flex-1">
                            <div class="flex items-center gap-2">
                                <span class="font-semibold text-gray-900">{{ $appointment['client'] }}</span>
                                @if($appointment['priority'] === 'Spoed')
                                    <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">{{ $appointment['priority'] }}</span>
                                @else
                                    <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">{{ $appointment['priority'] }}</span>
                                @endif
                            </div>
                            <div class="text-sm text-gray-600 mt-1">
                                {{ $appointment['type'] }} | {{ $appointment['date'] }} | {{ $appointment['time'] }}
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            @if($appointment['status'] === 'ingepland')
                                <span class="px-3 py-1 text-sm rounded-full bg-orange-100 text-orange-700">Ingepland</span>
                            @else
                                <span class="px-3 py-1 text-sm rounded-full bg-green-100 text-green-700">Bevestigd</span>
                            @endif
                            <button class="p-2 hover:bg-gray-100 rounded">→</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Planning & Communicatie --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Planning Section --}}
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Planning & Communicatie</h3>
            <div class="space-y-4">
                <div class="p-3 bg-blue-50 rounded-lg">
                    <div class="flex items-start gap-2">
                        <span class="text-blue-600"></span>
                        <div>
                            <div class="font-medium text-blue-900">Teammeeting</div>
                            <div class="text-sm text-blue-700">Morgen, 09:00 - Kantoor</div>
                        </div>
                    </div>
                </div>
                <div class="p-3 bg-green-50 rounded-lg">
                    <div class="flex items-start gap-2">
                        <span class="text-green-600">✓</span>
                        <div>
                            <div class="font-medium text-green-900">Training voltooid</div>
                            <div class="text-sm text-green-700">Nieuwe espressomachine - Certificaat ontvangen</div>
                        </div>
                    </div>
                </div>
                <div class="p-3 bg-yellow-50 rounded-lg">
                    <div class="flex items-start gap-2">
                        <span class="text-yellow-600"></span>
                        <div>
                            <div class="font-medium text-yellow-900">Deadline nadert</div>
                            <div class="text-sm text-yellow-700">Onderhoudscertificaten updaten voor 15 nov</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Product Defecten Overzicht --}}
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Product Defecten Overzicht</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between py-2 border-b">
                    <div>
                        <div class="font-medium text-gray-900">Bean Grinder XL</div>
                        <div class="text-sm text-gray-600">Elektrisch probleem</div>
                    </div>
                    <div class="text-right">
                        <div class="text-sm font-semibold text-gray-900">3x</div>
                        <div class="text-xs text-gray-500">Deze maand</div>
                    </div>
                </div>
                <div class="flex items-center justify-between py-2 border-b">
                    <div>
                        <div class="font-medium text-gray-900">Espresso Pro 3000</div>
                        <div class="text-sm text-gray-600">Lekkage</div>
                    </div>
                    <div class="text-right">
                        <div class="text-sm font-semibold text-gray-900">2x</div>
                        <div class="text-xs text-gray-500">Deze maand</div>
                    </div>
                </div>
                <div class="flex items-center justify-between py-2">
                    <div>
                        <div class="font-medium text-gray-900">Filter Machine Pro</div>
                        <div class="text-sm text-gray-600">Verwarming defect</div>
                    </div>
                    <div class="text-right">
                        <div class="text-sm font-semibold text-gray-900">1x</div>
                        <div class="text-xs text-gray-500">Deze maand</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Afgeronde Opdrachten --}}
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Afgeronde Opdrachten</h3>
        <div class="space-y-2">
            @foreach([
                ['client' => 'Espresso Bar', 'type' => 'Onderhoud', 'date' => '2025-11-08', 'rating' => '⭐⭐⭐⭐⭐'],
                ['client' => 'Café Amsterdam', 'type' => 'Reparatie', 'date' => '2025-11-07', 'rating' => '⭐⭐⭐⭐'],
                ['client' => 'Koffiehuis', 'type' => 'Installatie', 'date' => '2025-11-05', 'rating' => '⭐⭐⭐⭐⭐']
            ] as $completed)
                <div class="flex items-center justify-between p-3 border-b hover:bg-gray-50">
                    <div>
                        <span class="font-medium text-gray-900">{{ $completed['client'] }}</span>
                        <span class="text-sm text-gray-600 ml-2">| {{ $completed['type'] }}</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="text-sm text-gray-600">{{ $completed['date'] }}</span>
                        <span>{{ $completed['rating'] }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
