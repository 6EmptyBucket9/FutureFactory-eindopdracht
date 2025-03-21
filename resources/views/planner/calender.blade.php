<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kalender') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="border border-gray-200">
                {{-- Calendar --}}
                <div class="grid grid-cols-5 divide-gray-200 border-b border-gray-200">
                    @foreach ($weekDays as $weekDay)
                        <div class="p-3.5 text-center border-r border-gray-200">
                            <span class="text-sm font-medium text-gray-500">{{ $weekDay['day'] }}</span>
                            <span class="block text-sm font-medium text-gray-900">{{ $weekDay['date'] }}</span>

                            <!-- Timeslots -->
                            <div class="mt-2">
                                @foreach ($weekDay['timeslots'] as $timeslot)
                                    <div class="border-r border-gray-200 mb-4">
                                        <h4 class="font-semibold text-center">Timeslot: {{ $timeslot->timeslot }}</h4>

                                        @php
                                            // Get current assigned vehicle for the timeslot
                                            $assignedVehicleId = $weekDay['assignedVehicles'][$timeslot->timeslot] ?? null;
                                            // Get the assigned module (if exists)
                                            $assignedModuleId = $weekDay['assignedModules'][$timeslot->timeslot] ?? null;
                                        @endphp

                                        @if ($assignedVehicleId)
                                            <p>Assigned Vehicle: {{ $vehicles->find($assignedVehicleId)->name }}</p>

                                            <!-- Form for selecting and assigning a module to the assigned vehicle -->
                                            <form method="POST" action="{{ route('planner.assignModule') }}">
                                                @csrf

                                                <!-- Hidden fields for the date, timeslot, and vehicle_id -->
                                                <input type="hidden" name="date" value="{{ $weekDay['date'] }}">
                                                <input type="hidden" name="timeslot" value="{{ $timeslot->timeslot }}">
                                                <input type="hidden" name="vehicle_id" value="{{ $assignedVehicleId }}">

                                                <select name="module_id" class="border border-gray-300 p-2 rounded-md w-full">
                                                    <option value="">Select Module for vehicle</option>
                                                    @foreach ($vehicles->find($assignedVehicleId)->modules as $module)
                                                        <option value="{{ $module->id }}"
                                                            {{ old('module_id', $assignedModuleId) == $module->id ? 'selected' : '' }}>
                                                            {{ $module->name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                <button type="submit" class="mt-2 py-2 px-4 text-white bg-gray-500 rounded-md hover:bg-gray-400 focus:outline-none">Assign Module</button>
                                            </form>
                                        @else
                                            <!-- Form for assigning a vehicle to the timeslot -->
                                            <form method="POST" action="{{ route('planner.assignVehicle') }}">
                                                @csrf

                                                <!-- Hidden fields for the date and timeslot -->
                                                <input type="hidden" name="date" value="{{ $weekDay['date'] }}">
                                                <input type="hidden" name="timeslot" value="{{ $timeslot->timeslot }}">

                                                <select name="vehicle_id" class="border border-gray-300 p-2 rounded-md w-full">
                                                    <option value="">Select Vehicle</option>
                                                    @foreach ($vehicles as $vehicle)
                                                        <option value="{{ $vehicle->id }}"
                                                            {{ old('vehicle_id', $assignedVehicleId) == $vehicle->id ? 'selected' : '' }}>
                                                            {{ $vehicle->name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                <button type="submit" class="mt-2 py-2 px-4 text-white bg-gray-500 rounded-md hover:bg-gray-400 focus:outline-none">Assign Vehicle</button>
                                            </form>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
