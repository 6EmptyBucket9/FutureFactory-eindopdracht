<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Planner') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex flex-col space-y-6">

                    <!-- Flash messages -->
                    @if (session('success'))
                        <div>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div>
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Vehicle List Form (Table) -->
                    <div class="w-full space-y-6">
                        <h3 class="font-semibold text-lg mb-4 text-gray-800">Voertuigen</h3>
                        <table class="min-w-full table-auto border-collapse">
                            <thead>
                                <tr class="bg-gray-100 text-left">
                                    <th class="px-6 py-3 text-sm font-medium text-gray-700 uppercase">Voertuig</th>
                                    <th class="px-6 py-3 text-sm font-medium text-gray-700 uppercase">Planning</th>
                                    <th class="px-6 py-3 text-sm font-medium text-gray-700 uppercase">Modules</th>
                                    <th class="px-6 py-3 text-sm font-medium text-gray-700 uppercase">Robot</th>
                                    <th class="px-6 py-3 text-sm font-medium text-gray-700 uppercase">Acties</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vehicles as $vehicle)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm font-medium text-gray-800">{{ $vehicle->name }}
                                        </td>

                                        <!-- Planning details -->
                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            @if ($vehicle->planning->isNotEmpty())
                                                <ul class="pl-6 space-y-2">
                                                    @foreach ($vehicle->planning as $planning)
                                                        <li>{{ $planning->date }} - Tijdslot: {{ $planning->timeslot }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <em class="text-gray-500">Geen planning gevonden</em>
                                            @endif
                                        </td>

                                        <!-- Modules details -->
                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            <ul class="pl-6 space-y-2">
                                                @if ($vehicle->chassisModule)
                                                    <li>{{ $vehicle->chassisModule->name }}</li>
                                                @else
                                                    <em class="text-gray-500">Geen chassis module gekoppeld</em>
                                                @endif

                                                @if ($vehicle->drivetrainModule)
                                                    <li>{{ $vehicle->drivetrainModule->name }}</li>
                                                @else
                                                    <em class="text-gray-500">Geen drivetrain module gekoppeld</em>
                                                @endif

                                                @if ($vehicle->wheelModule)
                                                    <li>{{ $vehicle->wheelModule->name }}</li>
                                                @else
                                                    <em class="text-gray-500">Geen wiel module gekoppeld</em>
                                                @endif

                                                @if ($vehicle->steeringModule)
                                                    <li>{{ $vehicle->steeringModule->name }}</li>
                                                @else
                                                    <em class="text-gray-500">Geen stuur module gekoppeld</em>
                                                @endif

                                                @if ($vehicle->seatModule)
                                                    <li>{{ $vehicle->seatModule->name }}</li>
                                                @else
                                                    <em class="text-gray-500">Geen stoel module gekoppeld</em>
                                                @endif
                                            </ul>
                                        </td>

                                        <!-- Robot dropdown and form -->
                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            <form action="{{ route('planner.assignVehicleProductiePlanning') }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">

                                                <!-- Robot selection -->
                                                <label for="robot_id"
                                                    class="block text-sm font-medium text-gray-700">Kies Robot</label>
                                                <select name="robot_id" id="robot_id" class="block w-full mt-1">
                                                    @foreach ($robots as $robot)
                                                        <option value="{{ $robot->id }}">{{ $robot->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                        </td>


                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            <button type="submit">
                                                Voeg toe aan productieplanning
                                            </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Production Planning Table -->
                    <div class="w-full space-y-6">
                        <h3 class="font-semibold text-lg mb-4 text-gray-800">Productieplanning</h3>
                        @if ($productiePlannings->isNotEmpty())
                            <table class="min-w-full table-auto border-collapse">
                                <thead>
                                    <tr class="bg-gray-100 text-left">
                                        <th class="px-6 py-3 text-sm font-medium text-gray-700 uppercase">Planning ID
                                        </th>
                                        <th class="px-6 py-3 text-sm font-medium text-gray-700 uppercase">Voertuig</th>
                                        <th class="px-6 py-3 text-sm font-medium text-gray-700 uppercase">Modules</th>
                                        <th class="px-6 py-3 text-sm font-medium text-gray-700 uppercase">Robot</th>
                                        <th class="px-6 py-3 text-sm font-medium text-gray-700 uppercase">Planning
                                            Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productiePlannings as $productiePlanning)
                                        <tr class="border-b hover:bg-gray-50">
                                            <td class="px-6 py-4 text-sm font-medium text-gray-800">
                                                {{ $productiePlanning->id }}
                                            </td>

                                            <td class="px-6 py-4 text-sm text-gray-600">
                                                @if ($productiePlanning->vehicle)
                                                    {{ $productiePlanning->vehicle->name }}
                                                @else
                                                    <em class="text-gray-500">Geen voertuig gevonden</em>
                                                @endif
                                            </td>

                                            <td class="px-6 py-4 text-sm text-gray-600">
                                                @if ($productiePlanning->vehicle)
                                                    <div>
                                                        {{ $productiePlanning->vehicle->chassisModule ? $productiePlanning->vehicle->chassisModule->name : 'Geen chassis module gekoppeld' }}
                                                    </div>
                                                    <div>
                                                        {{ $productiePlanning->vehicle->drivetrainModule ? $productiePlanning->vehicle->drivetrainModule->name : 'Geen drivetrain module gekoppeld' }}
                                                    </div>
                                                    <div>
                                                        {{ $productiePlanning->vehicle->wheelModule ? $productiePlanning->vehicle->wheelModule->name : 'Geen wiel module gekoppeld' }}
                                                    </div>
                                                    <div>
                                                        {{ $productiePlanning->vehicle->steeringModule ? $productiePlanning->vehicle->steeringModule->name : 'Geen stuur module gekoppeld' }}
                                                    </div>
                                                    <div>
                                                        {{ $productiePlanning->vehicle->seatModule ? $productiePlanning->vehicle->seatModule->name : 'Geen stoel module gekoppeld' }}
                                                    </div>
                                                @else
                                                    <em class="text-gray-500">Geen modules beschikbaar</em>
                                                @endif
                                            </td>

                                            <td class="px-6 py-4 text-sm text-gray-600">
                                                @if ($productiePlanning->robot)
                                                    {{ $productiePlanning->robot->name }}
                                                @else
                                                    <em class="text-gray-500">Geen robot toegewezen</em>
                                                @endif
                                            </td>

                                            <td class="px-6 py-4 text-sm text-gray-600">
                                                @if ($productiePlanning->vehicle)
                                                    @foreach ($productiePlanning->vehicle->planning as $planning)
                                                        <div>{{ $planning->date }} - Tijdslot:
                                                            {{ $planning->timeslot }}</div>
                                                    @endforeach
                                                @else
                                                    <em class="text-gray-500">Geen planning beschikbaar</em>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        @else
                            <p><em class="text-gray-500">Geen productieplanning gevonden</em></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
