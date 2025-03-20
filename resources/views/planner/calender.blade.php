<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kalender') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="border border-gray-200">
                {{-- Calender --}}
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
                                            // Get current assignVehicle for timeslot
                                            $assignedVehicleId =
                                                $weekDay['assignedVehicles'][$timeslot->timeslot] ?? null;
                                        @endphp

                                        @if ($assignedVehicleId)
                                            <p>Assigned Vehicle: {{ $vehicles->find($assignedVehicleId)->name }}</p>
                                        @else
                                            <!-- Form for each timeslot with a unique submit button -->
                                            <form method="POST" action="{{ route('planner.assignVehicle') }}">
                                                @csrf

                                                <!-- Hidden fields for the date and timeslot -->
                                                <input type="hidden" name="date" value="{{ $weekDay['date'] }}">
                                                <input type="hidden" name="timeslot" value="{{ $timeslot->timeslot }}">

                                                <select name="vehicle_id">
                                                    <option value="">Select Vehicle</option>
                                                    @foreach ($vehicles as $vehicle)
                                                        <option value="{{ $vehicle->id }}"
                                                            {{ old('vehicle_id', $assignedVehicleId) == $vehicle->id ? 'selected' : '' }}>
                                                            {{ $vehicle->name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                <button type="submit"
                                                    class="mt-2 bg-blue-500 px-4 py-2 rounded-md">Assign
                                                    Vehicle</button>
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
