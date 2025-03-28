<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nieuwe Drivetrain Module Aanmaken') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('module.drivetrain.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Naam van de Drivetrain Module -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Naam</label>
                            <input type="text" id="name" name="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Type van de Drivetrain -->
                        <div class="mb-4">
                            <label for="type" class="block text-sm font-medium text-gray-700">Soort Drivetrain</label>
                            <select id="type" name="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                <option value="waterstof">Waterstof</option>
                                <option value="elektriciteit">Elektriciteit</option>
                            </select>
                            @error('type') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <!-- Vermogen van de Drivetrain -->
                        <div class="mb-4">
                            <label for="power" class="block text-sm font-medium text-gray-700">Vermogen (kW)</label>
                            <input type="number" id="power" name="power" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            @error('power') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Assemblage Tijd van de Drivetrain -->
                        <div class="mb-4">
                            <label for="assembly_time" class="block text-sm font-medium text-gray-700">Assemblage Tijd (uren)</label>
                            <input type="number" id="assembly_time" name="assembly_time" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            @error('assembly_time') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Kosten van de Drivetrain Module -->
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

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Maak Drivetrain Module Aan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
