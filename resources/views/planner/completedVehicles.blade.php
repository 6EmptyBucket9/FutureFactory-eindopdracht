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
                                <!-- Chassis module -->
                                <li>
                                    <span>
                                        {{ $vehicle->chassisModule ? $vehicle->chassisModule->name : 'Geen chassis module gekoppeld' }} - 
                                        {{ $vehicle->chassis_installed ? 'Voltooid' : 'Nog te doen' }}
                                    </span>
                                </li>

                                <!-- Drivetrain module -->
                                <li>
                                    <span>
                                        {{ $vehicle->drivetrainModule ? $vehicle->drivetrainModule->name : 'Geen drivetrain module gekoppeld' }} - 
                                        {{ $vehicle->drivetrain_installed ? 'Voltooid' : 'Nog te doen' }}
                                    </span>
                                </li>

                                <!-- Wheel module -->
                                <li>
                                    <span>
                                        {{ $vehicle->wheelModule ? $vehicle->wheelModule->name : 'Geen wiel module gekoppeld' }} - 
                                        {{ $vehicle->wheels_installed ? 'Voltooid' : 'Nog te doen' }}
                                    </span>
                                </li>

                                <!-- Steering module -->
                                <li>
                                    <span>
                                        {{ $vehicle->steeringModule ? $vehicle->steeringModule->name : 'Geen stuur module gekoppeld' }} - 
                                        {{ $vehicle->steering_installed ? 'Voltooid' : 'Nog te doen' }}
                                    </span>
                                </li>

                                <!-- Seat module -->
                                <li>
                                    <span>
                                        {{ $vehicle->seatModule ? $vehicle->seatModule->name : 'Geen stoel module gekoppeld' }} - 
                                        {{ $vehicle->seats_installed ? 'Voltooid' : 'Nog te doen' }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
