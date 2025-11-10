{{-- Finance Dashboard --}}
<div class="p-6 space-y-6">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Financieel Afdeling</h1>
            <p class="text-gray-600">Beheer facturen, betalingen en financiële overzichten</p>
        </div>
        <button class="px-4 py-2 bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold rounded-lg">
         Genereer Factuur
        </button>
    </div>

    {{-- Financial Stats --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="text-sm text-gray-600 mb-2">Totale Omzet</div>
            <div class="text-3xl font-bold text-gray-900">€153.500</div>
            <div class="mt-4">
                <div class="text-xs text-gray-600 mb-1">Deze maand</div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-green-500 h-2 rounded-full" style="width: 78%"></div>
                </div>
                <div class="text-xs text-gray-600 mt-1">78% van target</div>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="text-sm text-gray-600 mb-2">Openstaand</div>
            <div class="text-3xl font-bold text-gray-900">€42.750</div>
            <div class="mt-4">
                <div class="text-xs text-gray-600 mb-1">Status</div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-yellow-500 h-2 rounded-full" style="width: 28%"></div>
                </div>
                <div class="text-xs text-gray-600 mt-1">28% nog niet betaald</div>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="text-sm text-gray-600 mb-2">Winstmarge</div>
            <div class="text-3xl font-bold text-gray-900">€21.700</div>
            <div class="mt-4">
                <div class="text-xs text-gray-600 mb-1">Deze maand</div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-green-500 h-2 rounded-full" style="width: 65%"></div>
                </div>
                <div class="text-xs text-green-600 mt-1">↑ +12% vs vorige maand</div>
            </div>
        </div>
    </div>

    {{-- Open Invoices --}}
    <div class="bg-white rounded-lg border border-gray-200">
        <div class="border-b border-gray-200 px-6 py-4">
            <h2 class="text-xl font-semibold text-gray-900">Openstaande Facturen</h2>
            <p class="text-sm text-gray-600">Overzicht van alle openstaande betalingen</p>
        </div>

        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Factuurnr</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Klant</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Factuurdatum</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Vervaldatum</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Bedrag</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Acties</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach([
                            ['nr' => 'FAC-2025-001', 'client' => 'Caffellatte B.V', 'date' => '2025-10-15', 'due' => '2025-11-15', 'amount' => '€2.450', 'status' => 'open'],
                            ['nr' => 'FAC-2025-002', 'client' => 'Grandcafé Central', 'date' => '2025-10-20', 'due' => '2025-11-20', 'amount' => '€3.750', 'status' => 'open'],
                            ['nr' => 'FAC-2025-003', 'client' => 'Koffietheek R\'dam', 'date' => '2025-10-01', 'due' => '2025-11-01', 'amount' => '€1.850', 'status' => 'overdue'],
                            ['nr' => 'FAC-2025-004', 'client' => 'Espresso Bar', 'date' => '2025-10-25', 'due' => '2025-11-25', 'amount' => '€5.200', 'status' => 'open']
                        ] as $invoice)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $invoice['nr'] }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $invoice['client'] }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $invoice['date'] }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $invoice['due'] }}</td>
                                <td class="px-4 py-3 text-sm font-semibold text-gray-900">{{ $invoice['amount'] }}</td>
                                <td class="px-4 py-3">
                                    @if($invoice['status'] === 'overdue')
                                        <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">Verlopen</span>
                                    @else
                                        <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">Open</span>
                                    @endif
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

    {{-- Recent Transactions --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Laatste Transacties</h3>
            <div class="space-y-3">
                @foreach([
                    ['type' => 'Ontvangen', 'client' => 'Café De Boon', 'amount' => '€1.250', 'date' => 'Vandaag, 14:30'],
                    ['type' => 'Ontvangen', 'client' => 'Koffie Express', 'amount' => '€875', 'date' => 'Gisteren, 09:15'],
                    ['type' => 'Betaald', 'client' => 'Coffee Supplier', 'amount' => '-€3.200', 'date' => '2 dagen geleden']
                ] as $transaction)
                    <div class="flex items-center justify-between py-3 border-b">
                        <div>
                            <div class="font-medium text-gray-900">{{ $transaction['client'] }}</div>
                            <div class="text-xs text-gray-500">{{ $transaction['date'] }}</div>
                        </div>
                        <div class="text-right">
                            <div class="font-semibold {{ strpos($transaction['amount'], '-') === 0 ? 'text-red-600' : 'text-green-600' }}">
                                {{ $transaction['amount'] }}
                            </div>
                            <div class="text-xs text-gray-500">{{ $transaction['type'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Maandelijkse Statistieken</h3>
            <div class="space-y-4">
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="text-gray-600">Ontvangen betalingen</span>
                        <span class="font-semibold text-green-600">€110.750</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-500 h-2 rounded-full" style="width: 72%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="text-gray-600">Uitgaande betalingen</span>
                        <span class="font-semibold text-red-600">€89.050</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-red-500 h-2 rounded-full" style="width: 58%"></div>
                    </div>
                </div>
                <div class="pt-3 border-t">
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-900">Netto resultaat</span>
                        <span class="font-bold text-green-600">€21.700</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
