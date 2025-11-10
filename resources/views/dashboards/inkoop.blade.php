{{-- Inkoop Dashboard --}}
<div class="p-6 space-y-6">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Inkoop Afdeling</h1>
            <p class="text-gray-600">Beheer voorraad, leveranciers en bestellingen</p>
        </div>
        <button class="px-4 py-2 bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold rounded-lg">
            ➕ Bestelling Plaatsen
        </button>
    </div>

    {{-- Inventory Alerts --}}
    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
        <div class="flex items-start gap-3">
            <span class="text-xl">⚠️</span>
            <div>
                <h3 class="font-semibold text-red-900">Lage Voorraad Waarschuwing</h3>
                <p class="text-sm text-red-700">Er zijn 5 producten met kritisch lage voorraad. Bestel snel om tekorten te voorkomen.</p>
            </div>
        </div>
    </div>

    {{-- Voorraad Overview --}}
    <div class="bg-white rounded-lg border border-gray-200">
        <div class="border-b border-gray-200 px-6 py-4">
            <h2 class="text-xl font-semibold text-gray-900">Voorraad Overzicht</h2>
            <p class="text-sm text-gray-600">Alle producten in het magazijn met voorraadinformatie</p>
        </div>

        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Product</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Type</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Leverancier</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Huidige<br>voorraad</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Minimum<br>voorraad</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Acties</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach([
                            ['product' => 'Arabica Bonen', 'type' => 'Koffiebonen', 'supplier' => 'Coffee Supplier B.V', 'current' => 150, 'min' => 50, 'status' => 'ok'],
                            ['product' => 'Robusta Bonen', 'type' => 'Koffiebonen', 'supplier' => 'Coffee Supplier B.V', 'current' => 80, 'min' => 50, 'status' => 'ok'],
                            ['product' => 'Melkpoeder', 'type' => 'Ingrediënten', 'supplier' => 'Dairy Products Ltd', 'current' => 25, 'min' => 30, 'status' => 'low'],
                            ['product' => 'Espresso Bekers', 'type' => 'Verpakking', 'supplier' => 'Packaging Pro', 'current' => 500, 'min' => 200, 'status' => 'ok'],
                            ['product' => 'Filters', 'type' => 'Accessoires', 'supplier' => 'Coffee Tools Inc', 'current' => 15, 'min' => 50, 'status' => 'critical']
                        ] as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $item['product'] }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $item['type'] }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $item['supplier'] }}</td>
                                <td class="px-4 py-3 text-sm font-medium">{{ $item['current'] }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $item['min'] }}</td>
                                <td class="px-4 py-3">
                                    @if($item['status'] === 'ok')
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">✓ OK</span>
                                    @elseif($item['status'] === 'low')
                                        <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">⚠ Laag</span>
                                    @else
                                        <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">✖ Kritiek</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <button class="text-yellow-600 hover:text-yellow-700 text-sm font-medium">Bestellen →</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Bestellingen --}}
    <div class="bg-white rounded-lg border border-gray-200">
        <div class="border-b border-gray-200 px-6 py-4">
            <h2 class="text-xl font-semibold text-gray-900">Openstaande Bestellingen</h2>
        </div>

        <div class="p-6">
            <div class="space-y-4">
                @foreach([
                    ['order' => 'Best-001', 'product' => 'Arabica Bonen Premium', 'supplier' => 'Coffee Supplier', 'date' => '2025-10-25', 'status' => 'Verzonden'],
                    ['order' => 'Best-002', 'product' => 'Melkpoeder Bulk', 'supplier' => 'Dairy Products', 'date' => '2025-10-28', 'status' => 'In behandeling'],
                    ['order' => 'Best-003', 'product' => 'Koffie Filters x1000', 'supplier' => 'Coffee Tools', 'date' => '2025-11-01', 'status' => 'Nieuw']
                ] as $order)
                    <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                        <div>
                            <div class="font-semibold text-gray-900">{{ $order['order'] }} - {{ $order['product'] }}</div>
                            <div class="text-sm text-gray-600">Leverancier: {{ $order['supplier'] }} | Besteld op: {{ $order['date'] }}</div>
                        </div>
                        <div class="flex items-center gap-4">
                            @if($order['status'] === 'Verzonden')
                                <span class="px-3 py-1 text-sm rounded-full bg-blue-100 text-blue-700">{{ $order['status'] }}</span>
                            @elseif($order['status'] === 'In behandeling')
                                <span class="px-3 py-1 text-sm rounded-full bg-yellow-100 text-yellow-700">{{ $order['status'] }}</span>
                            @else
                                <span class="px-3 py-1 text-sm rounded-full bg-gray-100 text-gray-700">{{ $order['status'] }}</span>
                            @endif
                            <button class="text-yellow-600 hover:text-yellow-700 text-sm font-medium">Details →</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
