<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nieuwe Chassis Module Aanmaken') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('module.chassis.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Naam van de Chassis Module -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Naam</label>
                            <input type="text" id="name" name="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Aantal Wielen -->
                        <div class="mb-4">
                            <label for="wheels_count" class="block text-sm font-medium text-gray-700">Aantal Wielen</label>
                            <input type="number" id="wheels_count" name="wheels_count" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            @error('wheels_count') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Type Voertuig -->
                        <div class="mb-4">
                            <label for="vehicle_type_id" class="block text-sm font-medium text-gray-700">Type Voertuig</label>
                            <select id="vehicle_type_id" name="vehicle_type_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                @foreach($vehicleTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->type }}</option>
                                @endforeach
                            </select>
                            @error('vehicle_type_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Lengte van het Chassis -->
                        <div class="mb-4">
                            <label for="length" class="block text-sm font-medium text-gray-700">Lengte</label>
                            <input type="number" id="length" name="length" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            @error('length') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Breedte van het Chassis -->
                        <div class="mb-4">
                            <label for="width" class="block text-sm font-medium text-gray-700">Breedte</label>
                            <input type="number" id="width" name="width" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            @error('width') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Hoogte van het Chassis -->
                        <div class="mb-4">
                            <label for="height" class="block text-sm font-medium text-gray-700">Hoogte</label>
                            <input type="number" id="height" name="height" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            @error('height') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Kosten van de Chassis Module -->
                        <div class="mb-4">
                            <label for="cost" class="block text-sm font-medium text-gray-700">Kosten</label>
                            <input type="number" id="cost" name="cost" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            @error('cost') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Afbeelding Upload -->
                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700">Afbeelding</label>
                            <input type="file" id="image" name="image" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('image') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

    
                        <x-submit-button>Maak module aan</x-submit-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
