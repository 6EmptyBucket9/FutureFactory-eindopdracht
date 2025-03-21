<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard planner') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex flex-col space-y-6">
                    <!-- Flash messages -->
                    @if (session('success'))
                        <div class="bg-green-500 text-green p-4 rounded-md shadow-md">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-500 text-red p-4 rounded-md shadow-md">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="flex flex-wrap gap-6"> <!-- Added gap-6 here -->
                        <!-- Vehicle List Form -->
                        <div class="w-full md:w-1/2 space-y-6">
                            <h3 class="font-semibold text-lg mb-4 text-gray-800">Voertuigen</h3>
                            @foreach ($vehicles as $vehicle)
                                <form action="{{ route('planner.assignVehicleProductiePlanning') }}" method="POST" class="bg-gray-50 p-6 rounded-lg shadow-md border border-gray-200">
                                    @csrf
                                    <ul class="space-y-4">
                                        <li><strong class="text-gray-800">Voertuig:</strong> {{ $vehicle->name }}</li>

                                        <!-- Planning tonen -->
                                        @if ($vehicle->planning->isNotEmpty())
                                            <li><strong class="text-gray-800">Planning:</strong></li>
                                            <ul class="pl-6 space-y-2">
                                                @foreach ($vehicle->planning as $planning)
                                                    <li>{{ $planning->date }} - Tijdslot: {{ $planning->timeslot }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <li><em class="text-gray-500">Geen planning gevonden</em></li>
                                        @endif

                                        <!-- Modules tonen -->
                                        @if ($vehicle->modules->isNotEmpty())
                                            <li><strong class="text-gray-800">Modules:</strong></li>
                                            <ul class="pl-6 space-y-2">
                                                @foreach ($vehicle->modules as $module)
                                                    <li>{{ $module->name }}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <li><em class="text-gray-500">Geen modules gekoppeld</em></li>
                                        @endif

                                        <!-- Hidden input for vehicle ID -->
                                        <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">

                                        <!-- Submit button to add vehicle to production planning -->
                                        <button type="submit"
                                            class="mt-4 w-full py-2 text-black bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            Voeg voertuig toe aan productieplanning
                                        </button>
                                    </ul>
                                </form>
                            @endforeach
                        </div>

                        <!-- Production Planning List -->
                        <div class="w-full md:w-1/2 space-y-6">
                            <h3 class="font-semibold text-lg mb-4 text-gray-800">Productieplanning</h3>
                            @if ($productiePlannings->isNotEmpty())
                                <ul class="space-y-6">
                                    @foreach ($productiePlannings as $productiePlanning)
                                        <li class="bg-gray-50 p-6 rounded-lg shadow-md border border-gray-200">
                                            <strong class="text-gray-800">Planning ID:</strong> {{ $productiePlanning->id }}<br>
                                            <strong class="text-gray-800">Voertuig:</strong> {{ $productiePlanning->vehicle->name }}<br>

                                            <div class="mt-4 space-y-4">
                                                <!-- Modules-->
                                                @if ($productiePlanning->vehicle->modules->count() > 0)
                                                    <div>
                                                        <strong class="text-gray-800">Modules:</strong>
                                                        <ul class="pl-6 space-y-2">
                                                            @foreach ($productiePlanning->vehicle->modules as $module)
                                                                <li>{{ $module->name }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @else
                                                    <div><em class="text-gray-500">Geen modules gevonden</em></div>
                                                @endif

                                                <!-- Planning date and timeslot -->
                                                @if ($productiePlanning->vehicle->planning->isNotEmpty())
                                                    <div>
                                                        <strong class="text-gray-800">Planning details:</strong>
                                                        @foreach ($productiePlanning->vehicle->planning as $planning)
                                                            <div class="space-y-1">
                                                                <strong class="text-gray-600">Datum:</strong> {{ $planning->date }}<br>
                                                                <strong class="text-gray-600">Tijdslot:</strong> {{ $planning->timeslot }}
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <div><em class="text-gray-500">Geen planning gevonden</em></div>
                                                @endif
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p><em class="text-gray-500">Geen productieplanning gevonden</em></p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
