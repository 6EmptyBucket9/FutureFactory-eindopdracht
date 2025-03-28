<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Voertuigassemblage') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('assemble.vehicle') }}" method="POST">
                @csrf

                <!-- Naam van het voertuig -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Voertuignaam</label>
                    <input type="text" name="name" id="name" class="border p-2 w-full" required>
                </div>
                {{-- Type van het voertuig --}}
                <div class="mb-4">
                    <label for="vehicle_type_id" class="block text-sm font-medium text-gray-700">Kies
                        Voertuigtype</label>
                    <select name="vehicle_type_id" id="vehicle_type_id" class="block w-full mt-1">
                        <option value="">Kies een voertuigtype...</option>
                        @foreach ($vehicleTypes as $vehicleType)
                            <option value="{{ $vehicleType->id }}">{{ $vehicleType->type }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- Voertuig voor klant --}}

                <div class="mb-4">
                    <label for="user" class="block text-sm font-medium text-gray-700">Klant</label>
                    <select name="user_id" id="user" class="block w-full mt-1">
                        <option value="">Kies een klant...</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                </div>


                <!-- Chassis Dropdown -->
                <div class="mb-4">
                    <label for="chassis" class="block text-sm font-medium text-gray-700">Kies Chassis</label>
                    <select name="chassis" id="chassis" class="block w-full mt-1">
                        <option value="">Kies een chassis...</option>
                        @foreach ($chassisModules as $module)
                            <option value="{{ $module->id }}">{{ $module->name }} -
                                €{{ number_format($module->costs, 2) }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Aandrijving Dropdown -->
                <div class="mb-4">
                    <label for="drivetrain" class="block text-sm font-medium text-gray-700">Kies Aandrijving</label>
                    <select name="drivetrain" id="drivetrain" class="block w-full mt-1">
                        <option value="">Kies een aandrijving...</option>
                        @foreach ($drivetrainModules as $module)
                            <option value="{{ $module->id }}">{{ $module->name }} -
                                €{{ number_format($module->costs, 2) }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Wielen Dropdown -->
                <div class="mb-4">
                    <label for="wheels" class="block text-sm font-medium text-gray-700">Kies Wielen</label>
                    <select name="wheels" id="wheels" class="block w-full mt-1">
                        <option value="">Kies een wiel...</option>
                        @foreach ($wheelModules as $module)
                            <option value="{{ $module->id }}">{{ $module->name }} -
                                €{{ number_format($module->costs, 2) }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Stuur Dropdown -->
                <div class="mb-4">
                    <label for="steering" class="block text-sm font-medium text-gray-700">Kies Stuur</label>
                    <select name="steering" id="steering" class="block w-full mt-1">
                        <option value="">Kies een stuur...</option>
                        @foreach ($steeringModules as $module)
                            <option value="{{ $module->id }}">{{ $module->name }} -
                                €{{ number_format($module->costs, 2) }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Stoelen Dropdown -->
                <div class="mb-4">
                    <label for="seats" class="block text-sm font-medium text-gray-700">Kies Stoelen</label>
                    <select name="seats" id="seats" class="block w-full mt-1">
                        <option value="">Kies een stoel...</option>
                        @foreach ($seatModules as $module)
                            <option value="{{ $module->id }}">{{ $module->name }} -
                                €{{ number_format($module->costs, 2) }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="mt-4 btn btn-primary">Assembleer Voertuig</button>
            </form>
        </div>
    </div>
</x-app-layout>
