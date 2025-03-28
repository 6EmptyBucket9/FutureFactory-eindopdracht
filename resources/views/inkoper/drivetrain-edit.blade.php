<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bewerk Aandrijving Module') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('inkoper.drivetrain-update', $module->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Module Naam</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $module->name) }}" class="mt-1 block w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                            <input type="text" name="type" id="type" value="{{ old('type', $module->type) }}" class="mt-1 block w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="power" class="block text-sm font-medium text-gray-700">Vermogen (kW)</label>
                            <input type="number" name="power" id="power" value="{{ old('power', $module->power) }}" class="mt-1 block w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="assembly_time" class="block text-sm font-medium text-gray-700">Montagetijd (uur)</label>
                            <input type="number" name="assembly_time" id="assembly_time" value="{{ old('assembly_time', $module->assembly_time) }}" class="mt-1 block w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="cost" class="block text-sm font-medium text-gray-700">Kosten (€)</label>
                            <input type="number" name="cost" id="cost" value="{{ old('cost', $module->cost) }}" class="mt-1 block w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700">Afbeelding</label>
                            <input type="file" name="image" id="image" class="mt-1 block w-full">
                            @if ($module->image)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $module->image) }}" alt="Module Image" class="w-32 h-32 object-cover">
                                </div>
                            @endif
                        </div>

                        <button type="submit">Bewerk Module</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
