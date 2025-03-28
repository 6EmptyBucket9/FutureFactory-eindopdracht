<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nieuwe Wheel Module Aanmaken') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('module.wheel.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Naam van de Wheel Module -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Naam</label>
                            <input type="text" id="name" name="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Type van de Band -->
                        <div class="mb-4">
                            <label for="tire_type" class="block text-sm font-medium text-gray-700">Type Band</label>
                            <select id="tire_type" name="tire_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                <option value="winter">Winter</option>
                                <option value="zomer">Zomer</option>
                                <option value="allseason">Allseason</option>
                            </select>
                            @error('tire_type') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Diameter van de Band -->
                        <div class="mb-4">
                            <label for="diameter" class="block text-sm font-medium text-gray-700">Diameter (in inch)</label>
                            <input type="number" id="diameter" name="diameter" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            @error('diameter') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Aantal Wielen -->
                        <div class="mb-4">
                            <label for="quantity" class="block text-sm font-medium text-gray-700">Aantal</label>
                            <input type="number" id="quantity" name="quantity" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            @error('quantity') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Geschikt voor Chassis -->
                        <div class="mb-4">
                            <label for="compatible_chassis" class="block text-sm font-medium text-gray-700">Geschikt voor Chassis</label>
                            <select id="compatible_chassis" name="compatible_chassis[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" multiple required>
                                @foreach($chassisModules as $chassis)
                                    <option value="{{ $chassis->id }}">{{ $chassis->name }}</option>
                                @endforeach
                            </select>
                            @error('compatible_chassis') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Assemblage Tijd van de Wheel Module -->
                        <div class="mb-4">
                            <label for="assembly_time" class="block text-sm font-medium text-gray-700">Assemblage Tijd (uren)</label>
                            <input type="number" id="assembly_time" name="assembly_time" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            @error('assembly_time') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Kosten van de Wheel Module -->
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
                        <button type="submit" class="btn btn-primary">Maak Wheel Module Aan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
