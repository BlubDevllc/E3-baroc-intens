{{-- Management Dashboard --}}
<div class="p-6 space-y-6">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Management Login</h1>
            <p class="text-gray-600">Bedrijfsapplicatie - Algemeen overzicht</p>
        </div>
        <div class="flex items-center gap-2">
            <span class="text-sm text-gray-600">🔔</span>
            <span class="text-sm text-gray-600">👤</span>
        </div>
    </div>

    {{-- Quick Stats --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-lg border border-gray-200 p-4">
            <div class="text-sm text-gray-600">Leads</div>
            <div class="text-2xl font-bold text-gray-900 mt-1">124</div>
            <div class="text-xs text-green-600 mt-1">↑ 12% vs vorige maand</div>
        </div>
        <div class="bg-white rounded-lg border border-gray-200 p-4">
            <div class="text-sm text-gray-600">Offertes</div>
            <div class="text-2xl font-bold text-gray-900 mt-1">89</div>
            <div class="text-xs text-green-600 mt-1">↑ 8% vs vorige maand</div>
        </div>
        <div class="bg-white rounded-lg border border-gray-200 p-4">
            <div class="text-sm text-gray-600">Inkooporders</div>
            <div class="text-2xl font-bold text-gray-900 mt-1">45</div>
            <div class="text-xs text-gray-600 mt-1">= Stabiel</div>
        </div>
        <div class="bg-white rounded-lg border border-gray-200 p-4">
            <div class="text-sm text-gray-600">Facturen</div>
            <div class="text-2xl font-bold text-gray-900 mt-1">156</div>
            <div class="text-xs text-red-600 mt-1">↓ 3% vs vorige maand</div>
        </div>
    </div>

    {{-- Charts Row --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Bar Chart --}}
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Maandelijkse Prestaties</h3>
            <div class="space-y-3">
                @foreach(['Jan', 'Feb', 'Mrt', 'Apr', 'Mei', 'Jun'] as $month)
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-600">{{ $month }}</span>
                            <span class="font-medium">{{ rand(50, 100) }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-yellow-400 h-2 rounded-full" style="width: {{ rand(50, 100) }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Pie Chart --}}
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Verdeling per Afdeling</h3>
            <div class="flex items-center justify-center h-48">
                <svg class="w-40 h-40" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="40" fill="#FCD34D" />
                    <circle cx="50" cy="50" r="40" fill="#F59E0B" 
                        stroke-dasharray="75 25" stroke-dashoffset="25" 
                        transform="rotate(-90 50 50)" pathLength="100" 
                        stroke-width="40" fill="none"/>
                    <circle cx="50" cy="50" r="40" fill="#D97706" 
                        stroke-dasharray="50 50" stroke-dashoffset="-25" 
                        transform="rotate(-90 50 50)" pathLength="100" 
                        stroke-width="40" fill="none"/>
                </svg>
            </div>
            <div class="mt-4 space-y-2">
                <div class="flex items-center justify-between text-sm">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-yellow-300"></div>
                        <span>Sales</span>
                    </div>
                    <span class="font-medium">35%</span>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                        <span>Inkoop</span>
                    </div>
                    <span class="font-medium">30%</span>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-yellow-700"></div>
                        <span>Finance</span>
                    </div>
                    <span class="font-medium">35%</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Bottom Tables --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Recent Activities --}}
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Recente Activiteiten</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between py-2 border-b">
                    <div>
                        <div class="text-sm font-medium">Nieuwe lead toegevoegd</div>
                        <div class="text-xs text-gray-500">2 uur geleden</div>
                    </div>
                    <span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded">Nieuw</span>
                </div>
                <div class="flex items-center justify-between py-2 border-b">
                    <div>
                        <div class="text-sm font-medium">Offerte verzonden</div>
                        <div class="text-xs text-gray-500">5 uur geleden</div>
                    </div>
                    <span class="px-2 py-1 text-xs bg-blue-100 text-blue-700 rounded">Verwerkt</span>
                </div>
                <div class="flex items-center justify-between py-2">
                    <div>
                        <div class="text-sm font-medium">Factuur goedgekeurd</div>
                        <div class="text-xs text-gray-500">1 dag geleden</div>
                    </div>
                    <span class="px-2 py-1 text-xs bg-gray-100 text-gray-700 rounded">Voltooid</span>
                </div>
            </div>
        </div>

        {{-- Team Performance --}}
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Team Prestaties</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between py-2 border-b">
                    <div class="text-sm">Sales Team</div>
                    <div class="flex items-center gap-2">
                        <div class="w-24 bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: 85%"></div>
                        </div>
                        <span class="text-sm font-medium w-12 text-right">85%</span>
                    </div>
                </div>
                <div class="flex items-center justify-between py-2 border-b">
                    <div class="text-sm">Inkoop Team</div>
                    <div class="flex items-center gap-2">
                        <div class="w-24 bg-gray-200 rounded-full h-2">
                            <div class="bg-yellow-500 h-2 rounded-full" style="width: 72%"></div>
                        </div>
                        <span class="text-sm font-medium w-12 text-right">72%</span>
                    </div>
                </div>
                <div class="flex items-center justify-between py-2">
                    <div class="text-sm">Finance Team</div>
                    <div class="flex items-center gap-2">
                        <div class="w-24 bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: 90%"></div>
                        </div>
                        <span class="text-sm font-medium w-12 text-right">90%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
