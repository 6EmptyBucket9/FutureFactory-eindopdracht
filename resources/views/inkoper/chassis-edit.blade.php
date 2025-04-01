<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bewerk Chassis Module') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('inkoper.chassis-update', $module->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Module Naam</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $module->name) }}" class="mt-1 block w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="wheels_count" class="block text-sm font-medium text-gray-700">Aantal Wielen</label>
                            <input type="number" name="wheels_count" id="wheels_count" value="{{ old('wheels_count', $module->wheels_count) }}" class="mt-1 block w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="vehicle_type_id" class="block text-sm font-medium text-gray-700">Voertuig Type</label>
                            <select name="vehicle_type_id" id="vehicle_type_id" class="mt-1 block w-full" required>
                                <option value="">Selecteer voertuig type</option>
                                <!-- Example options, adjust according to your application -->
                                @foreach ($vehicleTypes as $type)
                                    <option value="{{ $type->id }}" {{ old('vehicle_type_id', $module->vehicle_type_id) == $type->id ? 'selected' : '' }}>
                                        {{ $type->type }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="length" class="block text-sm font-medium text-gray-700">Lengte (in cm)</label>
                            <input type="number" name="length" id="length" value="{{ old('length', $module->length) }}" class="mt-1 block w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="width" class="block text-sm font-medium text-gray-700">Breedte (in cm)</label>
                            <input type="number" name="width" id="width" value="{{ old('width', $module->width) }}" class="mt-1 block w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="height" class="block text-sm font-medium text-gray-700">Hoogte (in cm)</label>
                            <input type="number" name="height" id="height" value="{{ old('height', $module->height) }}" class="mt-1 block w-full" required>
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

                        <x-submit-button>Bewerk module</x-submit-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
