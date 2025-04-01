<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nieuwe Seat Module Aanmaken') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('module.seat.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Naam van de Seat Module -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Naam</label>
                            <input type="text" id="name" name="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Stoffering van de Seat Module -->
                        <div class="mb-4">
                            <label for="upholstery" class="block text-sm font-medium text-gray-700">Stoffering</label>
                            <select id="upholstery" name="upholstery" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                <option value="leer">Leer</option>
                                <option value="stof">Stof</option>
                                <option value="schapenvacht">Schapenvacht</option>
                                <option value="kunstleer">Kunstleer</option>
                                <option value="metaal">Metaal</option>
                            </select>
                            @error('upholstery') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Aantal Seat Modules -->
                        <div class="mb-4">
                            <label for="quantity" class="block text-sm font-medium text-gray-700">Aantal</label>
                            <input type="number" id="quantity" name="quantity" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            @error('quantity') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Assemblage Tijd van de Seat Module -->
                        <div class="mb-4">
                            <label for="assembly_time" class="block text-sm font-medium text-gray-700">Assemblage Tijd (uren)</label>
                            <input type="number" id="assembly_time" name="assembly_time" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            @error('assembly_time') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Kosten van de Seat Module -->
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
                        <x-submit-button>Maak module aan</x-submit-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
