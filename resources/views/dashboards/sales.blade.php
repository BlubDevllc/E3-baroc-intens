{{-- Sales Dashboard --}}
<div class="p-6 space-y-6">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Sales Afdeling</h1>
            <p class="text-gray-600">Beheer van klanten, offertes en verkoop</p>
        </div>
        <button class="px-4 py-2 bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold rounded-lg">
             Nieuwe Klant
        </button>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white rounded-lg border border-gray-200 p-4">
            <div class="text-sm text-gray-600">Open Leads</div>
            <div class="text-2xl font-bold text-gray-900 mt-1">28</div>
            <div class="text-xs text-blue-600 mt-1">→ 12 nieuw deze week</div>
        </div>
        <div class="bg-white rounded-lg border border-gray-200 p-4">
            <div class="text-sm text-gray-600">Actieve Offertes</div>
            <div class="text-2xl font-bold text-gray-900 mt-1">15</div>
            <div class="text-xs text-yellow-600 mt-1"> 8 wachten op antwoord</div>
        </div>
        <div class="bg-white rounded-lg border border-gray-200 p-4">
            <div class="text-sm text-gray-600">Conversie Ratio</div>
            <div class="text-2xl font-bold text-gray-900 mt-1">68%</div>
            <div class="text-xs text-green-600 mt-1">↑ +5% deze maand</div>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="bg-white rounded-lg border border-gray-200">
        <div class="border-b border-gray-200 px-6 py-4">
            <h2 class="text-xl font-semibold text-gray-900">Sales Afdeling</h2>
            <p class="text-sm text-gray-600">Overzicht van alle sales activiteiten</p>
        </div>

        {{-- Recommended Clients --}}
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Aanbevolen</h3>
            <p class="text-sm text-gray-600 mb-4">Dit zijn de klanten die al lang niks besteld hebben en waar je misschien weer contact mee kunt opnemen</p>
            
            <div class="space-y-3">
                @foreach([
                    ['name' => 'Caffellatte', 'type' => 'Horeca', 'contact' => 'Jan Janssen', 'phone' => '06-12345678'],
                    ['name' => 'Grandcafé Central', 'type' => 'Horeca', 'contact' => 'Piet Pieters', 'phone' => '06-98765432'],
                    ['name' => 'Koffietheek Rotterdam', 'type' => 'Retail', 'contact' => 'Marie de Vries', 'phone' => '010-1234567']
                ] as $client)
                    <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                        <div class="flex-1">
                            <div class="font-semibold text-gray-900">{{ $client['name'] }}</div>
                            <div class="text-sm text-gray-600">{{ $client['type'] }} | {{ $client['contact'] }}</div>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-sm text-gray-600">{{ $client['phone'] }}</span>
                            <button class="p-2 hover:bg-gray-100 rounded"></button>
                            <button class="p-2 hover:bg-gray-100 rounded"></button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Leads Overview --}}
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Nieuwe Leads</h3>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Bedrijfsnaam</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Contactpersoon</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">BKR Check</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Acties</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach([
                            ['company' => 'Koffiehuis De Boon', 'contact' => 'Lisa Berg', 'bkr' => 'OK', 'status' => 'Nieuw'],
                            ['company' => 'Espresso Express', 'contact' => 'Tom Bakker', 'bkr' => 'In behandeling', 'status' => 'Contact opnemen'],
                            ['company' => 'Barista Bar', 'contact' => 'Anna Smit', 'bkr' => 'OK', 'status' => 'Offerte verzonden']
                        ] as $lead)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $lead['company'] }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $lead['contact'] }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 text-xs rounded-full {{ $lead['bkr'] === 'OK' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                        {{ $lead['bkr'] }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-700">
                                        {{ $lead['status'] }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <button class="text-yellow-600 hover:text-yellow-700 text-sm font-medium">Bekijken →</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
