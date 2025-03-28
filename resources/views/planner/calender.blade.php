<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kalender') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="border border-gray-200">
                <div class="grid grid-cols-5 divide-gray-200 border-b border-gray-200">
                    @foreach ($weekDays as $weekDay)
                        <div class="p-4 text-center border-r border-gray-200">
                            <span class="text-sm font-medium text-gray-500">{{ $weekDay['day'] }}</span>
                            <span class="block text-sm font-medium text-gray-900">{{ $weekDay['date'] }}</span>
                            <div class="mt-2 space-y-4">
                                @if (!empty($weekDay['timeslots']))
                                    @foreach ($weekDay['timeslots'] as $timeslot)
                                        <div class="border p-2 rounded-md shadow-sm">
                                            <h4 class="font-semibold">Timeslot: {{ $timeslot->timeslot }}</h4>

                                            @php
                                                $assignedVehicle = $vehicles->find($weekDay['assignedVehicles'][$timeslot->timeslot] ?? null);
                                            @endphp

                                            @if ($assignedVehicle)
                                                <p class="text-sm text-gray-700">Voertuig: {{ $assignedVehicle->name }}</p>

                                                @php
                                                    $assignedModule = null;
                                                    if ($assignedVehicle->chassisModule) {
                                                        $assignedModule = $assignedVehicle->chassisModule;
                                                    } elseif ($assignedVehicle->drivetrainModule) {
                                                        $assignedModule = $assignedVehicle->drivetrainModule;
                                                    } elseif ($assignedVehicle->steeringModule) {
                                                        $assignedModule = $assignedVehicle->steeringModule;
                                                    } elseif ($assignedVehicle->seatModule) {
                                                        $assignedModule = $assignedVehicle->seatModule;
                                                    } elseif ($assignedVehicle->wheelModule) {
                                                        $assignedModule = $assignedVehicle->wheelModule;
                                                    }
                                                @endphp

                                                @if ($assignedModule)
                                                    <p class="text-sm text-green-600">Toegewezen module: {{ $assignedModule->name }}</p>
                                                @else
                                                    <!-- Module Toewijzing Formulier -->
                                                    <form method="POST" action="{{ route('planner.assignModule') }}">
                                                        @csrf
                                                        <input type="hidden" name="date" value="{{ $weekDay['date'] }}">
                                                        <input type="hidden" name="timeslot" value="{{ $timeslot->timeslot }}">
                                                        <input type="hidden" name="vehicle_id" value="{{ $assignedVehicle->id }}">

                                                        <select name="module_type" class="border p-2 rounded w-full">
                                                            <option value="">Selecteer module</option>

                                                            @if ($assignedVehicle->chassisModule)
                                                                <option value="chassis,{{ $assignedVehicle->chassisModule->id }}">
                                                                    Chassis Module: {{ $assignedVehicle->chassisModule->name }}
                                                                </option>
                                                            @endif

                                                            @if ($assignedVehicle->drivetrainModule)
                                                                <option value="drivetrain,{{ $assignedVehicle->drivetrainModule->id }}">
                                                                    Drivetrain Module: {{ $assignedVehicle->drivetrainModule->name }}
                                                                </option>
                                                            @endif

                                                            @if ($assignedVehicle->steeringModule)
                                                                <option value="steering,{{ $assignedVehicle->steeringModule->id }}">
                                                                    Steering Module: {{ $assignedVehicle->steeringModule->name }}
                                                                </option>
                                                            @endif

                                                            @if ($assignedVehicle->seatModule)
                                                                <option value="seats,{{ $assignedVehicle->seatModule->id }}">
                                                                    Seat Module: {{ $assignedVehicle->seatModule->name }}
                                                                </option>
                                                            @endif

                                                            @if ($assignedVehicle->wheelModule)
                                                                <option value="wheels,{{ $assignedVehicle->wheelModule->id }}">
                                                                    Wheel Module: {{ $assignedVehicle->wheelModule->name }}
                                                                </option>
                                                            @endif

                                                            @if (!$assignedVehicle->chassisModule && 
                                                                 !$assignedVehicle->drivetrainModule && 
                                                                 !$assignedVehicle->steeringModule && 
                                                                 !$assignedVehicle->seatModule && 
                                                                 !$assignedVehicle->wheelModule)
                                                                <option value="">Geen modules beschikbaar</option>
                                                            @endif
                                                        </select>

                                                        <button type="submit" class="mt-2 w-full bg-gray-500 text-white py-1 rounded hover:bg-gray-400">
                                                            Toewijzen
                                                        </button>
                                                    </form>
                                                @endif
                                            @else
                                                <!-- Voertuig Toewijzing Formulier -->
                                                <form method="POST" action="{{ route('planner.assignVehicle') }}">
                                                    @csrf
                                                    <input type="hidden" name="date" value="{{ $weekDay['date'] }}">
                                                    <input type="hidden" name="timeslot" value="{{ $timeslot->timeslot }}">
                                                    <select name="vehicle_id" class="border p-2 rounded w-full">
                                                        <option value="">Selecteer voertuig</option>
                                                        @foreach ($vehicles as $vehicle)
                                                            <option value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <button type="submit" class="mt-2 w-full bg-gray-500 text-white py-1 rounded hover:bg-gray-400">
                                                        Toewijzen
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    @endforeach
                                @else
                                    <p class="text-sm text-gray-500">Geen beschikbare tijdslots voor vandaag.</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
