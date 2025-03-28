<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Voertuigen Overzicht') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="border border-gray-200">
                <h3 class="text-lg font-semibold mb-4">Overzicht van Uw Voertuigen</h3>
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

                            <!-- Add the current status of the vehicle -->
                            <p class="text-sm font-medium mt-2">
                                <strong>Status:</strong>
                                <span class="text-gray-600">
                                    {{ ucfirst($vehicle->vehicleStatus->name) }}
                                </span>
                            </p>

                            <p>Geplande opleverdatum: {{ $vehicle->expected_completion_date }}</p>
                            <p>Voltooide Datum:
                                {{ $vehicle->completion_date ? $vehicle->completion_date : 'Nog niet gecompleteerd' }}
                            </p>

                            <!-- Show vehicle modules and their installation status -->
                            <ul>
                                <li>
                                    <strong>Chassis:</strong>
                                    @if ($vehicle->chassis_installed)
                                        {{ $vehicle->chassisModule->name }} - Geïnstalleerd
                                    @else
                                        <em>Geen chassis module geïnstalleerd</em>
                                    @endif
                                </li>

                                <li>
                                    <strong>Aandrijfas:</strong>
                                    @if ($vehicle->drivetrain_installed)
                                        {{ $vehicle->drivetrainModule->name }} - Geïnstalleerd
                                    @else
                                        <em>Geen drivetrain module geïnstalleerd</em>
                                    @endif
                                </li>

                                <li>
                                    <strong>Wielen:</strong>
                                    @if ($vehicle->wheels_installed)
                                        {{ $vehicle->wheelModule->name }} - Geïnstalleerd
                                    @else
                                        <em>Geen wiel module geïnstalleerd</em>
                                    @endif
                                </li>

                                <li>
                                    <strong>Stuur:</strong>
                                    @if ($vehicle->steering_installed)
                                        {{ $vehicle->steeringModule->name }} - Geïnstalleerd
                                    @else
                                        <em>Geen stuur module geïnstalleerd</em>
                                    @endif
                                </li>

                                <li>
                                    <strong>Stoelen:</strong>
                                    @if ($vehicle->seats_installed)
                                        {{ $vehicle->seatModule->name }} - Geïnstalleerd
                                    @else
                                        <em>Geen stoel module geïnstalleerd</em>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
