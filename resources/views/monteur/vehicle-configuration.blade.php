<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nieuw Voertuig Configureren') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('vehicles.store') }}" method="POST">
                        @csrf
                        <!-- Naam van het voertuig -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Voertuignaam</label>
                            <input type="text" name="name" id="name" class="border p-2 w-full" required>
                        </div>
                        
                        <!-- Type van het voertuig -->
                        <div class="mb-4">
                            <label for="vehicle_type_id" class="block text-sm font-medium text-gray-700">Kies Voertuigtype</label>
                            <select name="vehicle_type_id" id="vehicle_type_id" class="block w-full mt-1" required>
                                <option value="">Kies een voertuigtype...</option>
                                @foreach ($vehicleTypes as $vehicleType)
                                    <option value="{{ $vehicleType->id }}">{{ $vehicleType->type }}</option>
                                @endforeach
                            </select>
                            @error('vehicle_type_id')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Voertuig voor klant -->
                        <div class="mb-4">
                            <label for="user" class="block text-sm font-medium text-gray-700">Klant</label>
                            <select name="user_id" id="user" class="block w-full mt-1" required>
                                <option value="">Kies een klant...</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Wielen -->
                        <div class="mb-4">
                            <label for="wheel_id" class="block text-sm font-medium text-gray-700">Wielen</label>
                            <select id="wheel_id" name="wheel_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                <option value="">Kies een wiel...</option>
                                @foreach ($wheelModules as $wheel)
                                    <option value="{{ $wheel->id }}">{{ $wheel->name }} - {{ $wheel->tire_type }}</option>
                                @endforeach
                            </select>
                            @error('wheel_id')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Chassis -->
                        <div class="mb-4">
                            <label for="chassis_id" class="block text-sm font-medium text-gray-700">Chassis</label>
                            <select id="chassis_id" name="chassis_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                <option value="">Kies een chassis...</option>
                                @foreach ($chassisModules as $ch)
                                    <option value="{{ $ch->id }}">{{ $ch->name }}</option>
                                @endforeach
                            </select>
                            @error('chassis_id')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Drivetrain (Aandrijving) -->
                        <div class="mb-4">
                            <label for="drivetrain_id" class="block text-sm font-medium text-gray-700">Aandrijving</label>
                            <select id="drivetrain_id" name="drivetrain_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                <option value="">Kies een aandrijving...</option>
                                @foreach ($drivetrainModules as $drivetrain)
                                    <option value="{{ $drivetrain->id }}">{{ $drivetrain->name }}</option>
                                @endforeach
                            </select>
                            @error('drivetrain_id')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Stoelen -->
                        <div class="mb-4">
                            <label for="seat_id" class="block text-sm font-medium text-gray-700">Stoelen</label>
                            <select id="seat_id" name="seat_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                <option value="">Kies een stoel...</option>
                                @foreach ($seatModules as $seat)
                                    <option value="{{ $seat->id }}">{{ $seat->name }}</option>
                                @endforeach
                            </select>
                            @error('seat_id')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Stuur -->
                        <div class="mb-4">
                            <label for="steering_id" class="block text-sm font-medium text-gray-700">Stuur</label>
                            <select id="steering_id" name="steering_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                <option value="">Kies een stuur...</option>
                                @foreach ($steeringModules as $steering)
                                    <option value="{{ $steering->id }}">{{ $steering->shape }} - {{ $steering->special_adjustments }}</option>
                                @endforeach
                            </select>
                            @error('steering_id')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <x-submit-button>Configureer</x-submit-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
