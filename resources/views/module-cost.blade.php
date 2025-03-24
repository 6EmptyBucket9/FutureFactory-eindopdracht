<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Module kosten') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h3 class="text-lg font-semibold mb-4">Module Lijst</h3>

                    <!-- Form for selecting modules -->
                    <form action="{{ route('module-cost') }}" method="GET">
                        <div class="overflow-x-auto">
                            <table class="min-w-full table-auto border-collapse">
                                <thead>
                                    <tr class="bg-gray-100 text-left">
                                        <th class="px-6 py-3 text-sm font-medium text-gray-700 uppercase">Module Naam</th>
                                        <th class="px-6 py-3 text-sm font-medium text-gray-700 uppercase">Kosten (€)</th>
                                        <th class="px-6 py-3 text-sm font-medium text-gray-700 uppercase">Selecteren</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($modules as $module)
                                        <tr class="border-b hover:bg-gray-50">
                                            <td class="px-6 py-4 text-sm font-medium text-gray-800">{{ $module->name }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-600">{{ number_format($module->costs, 2, ',', '.') }}</td>
                                            <td class="px-6 py-4">
                                                <input type="checkbox" name="modules[]" value="{{ $module->id }}" class="module-checkbox">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6">
                            <button type="submit">
                                Bereken Totaal Kosten
                            </button>
                        </div>
                    </form>

                    <!-- Display total cost -->
                    @if(isset($totalCost))
                        <div class="mt-6">
                            <h4 class="text-lg font-semibold">Totaal Kosten:</h4>
                            <p class="text-xl font-bold text-gray-800">€ {{ number_format($totalCost, 2, ',', '.') }}</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
