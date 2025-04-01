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

                                            @if (isset($weekDay['assignedVehicles'][$timeslot->timeslot]))
                                                <p class="text-sm text-gray-700">Voertuig:
                                                    {{ $vehicles->find($weekDay['assignedVehicles'][$timeslot->timeslot])->name }}
                                                </p>

                                                <!-- Display Assigned Module -->
                                                @if (isset($weekDay['assignedModules'][$timeslot->timeslot]))
                                                    <p class="text-sm text-blue-600">
                                                        Toegewezen module:
                                                        {{ $weekDay['assignedModules'][$timeslot->timeslot] }} Module
                                                    </p>
                                                @else
                                                    <p class="text-sm text-gray-500">Geen module toegewezen</p>
                                                @endif

                                                <!-- Display Module Assignment Form only if no module is assigned -->
                                                @if (!isset($weekDay['assignedModules'][$timeslot->timeslot]))
                                                    <form method="POST" action="{{ route('planner.assignModule') }}">
                                                        @csrf
                                                        <input type="hidden" name="date"
                                                            value="{{ $weekDay['date'] }}">
                                                        <input type="hidden" name="timeslot"
                                                            value="{{ $timeslot->timeslot }}">
                                                        <input type="hidden" name="vehicle_id"
                                                            value="{{ $weekDay['assignedVehicles'][$timeslot->timeslot] }}">

                                                        <select name="module_type" class="border p-2 rounded w-full">
                                                            <option value="">Selecteer module</option>

                                                            @foreach (['chassis', 'drivetrain', 'steering', 'seats', 'wheels'] as $moduleType)
                                                                @if ($vehicles->find($weekDay['assignedVehicles'][$timeslot->timeslot])->{$moduleType . 'Module'})
                                                                    <option
                                                                        value="{{ $moduleType }},{{ $vehicles->find($weekDay['assignedVehicles'][$timeslot->timeslot])->{$moduleType . 'Module'}->id }}">
                                                                        {{ ucfirst($moduleType) }} Module:
                                                                        {{ $vehicles->find($weekDay['assignedVehicles'][$timeslot->timeslot])->{$moduleType . 'Module'}->name }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        </select>

                                                        <x-submit-button>Submit</x-submit-button>

                                                    </form>
                                                @endif
                                            @else
                                                <!-- Vehicle Assignment Form -->
                                                <form method="POST" action="{{ route('planner.assignVehicle') }}">
                                                    @csrf
                                                    <input type="hidden" name="date"
                                                        value="{{ $weekDay['date'] }}">
                                                    <input type="hidden" name="timeslot"
                                                        value="{{ $timeslot->timeslot }}">
                                                    <select name="vehicle_id" class="border p-2 rounded w-full">
                                                        <option value="">Selecteer voertuig</option>
                                                        @foreach ($vehicles as $vehicle)
                                                            <option value="{{ $vehicle->id }}">{{ $vehicle->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <x-submit-button>Submit</x-submit-button>

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
