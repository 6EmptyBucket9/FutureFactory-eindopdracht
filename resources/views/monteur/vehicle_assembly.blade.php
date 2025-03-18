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

                <!-- Chassis Dropdown -->
                <div class="mb-4">
                    <label for="chassis" class="block text-sm font-medium text-gray-700">Kies Chassis</label>
                    <select name="chassis" id="chassis" class="block w-full mt-1">
                        <option value="">Kies een chassis...</option>
                        @foreach ($modules as $module)
                            @if ($module->module_type == 'chassis')
                                <option value="{{ $module->id }}">
                                    {{ $module->name }} - €{{ number_format($module->costs, 2) }} 
                                    (Wielen: {{ $module->amount_of_wheels }} - Afmetingen: {{ $module->dimensions }})
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <!-- Drivetrain Dropdown -->
                <div class="mb-4">
                    <label for="drivetrain" class="block text-sm font-medium text-gray-700">Kies Aandrijving</label>
                    <select name="drivetrain" id="drivetrain" class="block w-full mt-1">
                        <option value="">Kies een aandrijving...</option>
                        @foreach ($modules as $module)
                            @if ($module->module_type == 'drivetrain')
                                <option value="{{ $module->id }}">
                                    {{ $module->name }} - €{{ number_format($module->costs, 2) }} 
                                    (Soort: {{ $module->drivetrain_type }} - Vermogen: {{ $module->horsepower }} pk)
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <!-- Wielen Dropdown -->
                <div class="mb-4">
                    <label for="wheels" class="block text-sm font-medium text-gray-700">Kies Wielen</label>
                    <select name="wheels" id="wheels" class="block w-full mt-1">
                        <option value="">Kies een wiel...</option>
                        @foreach ($modules as $module)
                            @if ($module->module_type == 'wheels')
                                <option value="{{ $module->id }}">
                                    {{ $module->name }} - €{{ number_format($module->costs, 2) }} 
                                    (Type: {{ $module->tire_type }} - Diameter: {{ $module->tire_diameter }} inch)
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <!-- Stuur Dropdown -->
                <div class="mb-4">
                    <label for="steering" class="block text-sm font-medium text-gray-700">Kies Stuur</label>
                    <select name="steering" id="steering" class="block w-full mt-1">
                        <option value="">Kies een stuur...</option>
                        @foreach ($modules as $module)
                            @if ($module->module_type == 'steering')
                                <option value="{{ $module->id }}">
                                    {{ $module->name }} - €{{ number_format($module->costs, 2) }} 
                                    (Vorm: {{ $module->steering_shape }} - Modificatie: {{ $module->special_modifications }})
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <!-- Stoelen Dropdown -->
                <div class="mb-4">
                    <label for="seats" class="block text-sm font-medium text-gray-700">Kies Stoelen</label>
                    <select name="seats" id="seats" class="block w-full mt-1">
                        <option value="">Kies een stoel...</option>
                        @foreach ($modules as $module)
                            @if ($module->module_type == 'seats')
                                <option value="{{ $module->id }}">
                                    {{ $module->name }} - €{{ number_format($module->costs, 2) }} 
                                    (Aantal: {{ $module->number_of_seats }} - Bekleding: {{ $module->upholstery }})
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="mt-4 btn btn-primary">Assemble Vehicle</button>
            </form>
        </div>
    </div>
</x-app-layout>
