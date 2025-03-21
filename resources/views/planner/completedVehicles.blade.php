<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Voertuigen Overzicht') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="border border-gray-200">
                <h3 class="text-lg font-semibold mb-4">Overzicht van Alle Voertuigen</h3>
                <div class="grid grid-cols-1 gap-4">
                    @foreach ($vehicles as $vehicle)
                        <div class="border border-gray-200 p-4 rounded-lg shadow-sm">
                            <h4 class="text-xl font-semibold">
                                {{ $vehicle->name }}
                                <!-- Markeer het voertuig als voltooid of niet -->
                                @if ($vehicle->isComplete())
                                    <span>(Voltooid)</span>
                                @else
                                    <span>(Nog niet voltooid)</span>
                                @endif
                            </h4>
                            <p>Voltooide Datum: {{ $vehicle->completion_date ? $vehicle->completion_date : 'Nog niet gecompleteerd' }}</p>
                            <ul>
                                @foreach ($vehicle->planning as $planning)
                                    <li>
                                        <span>
                                            {{ $planning->module ? $planning->module->name : 'Onbekende module' }} - 
                                            {{ $planning->is_completed ? 'Voltooid' : 'Nog te doen' }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
