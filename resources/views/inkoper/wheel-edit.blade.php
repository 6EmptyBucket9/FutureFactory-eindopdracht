<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bewerk Wiel Module') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('inkoper.wheel-update', $module->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Module Naam</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $module->name) }}" class="mt-1 block w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="tire_type" class="block text-sm font-medium text-gray-700">Banden Type</label>
                            <input type="text" name="tire_type" id="tire_type" value="{{ old('tire_type', $module->tire_type) }}" class="mt-1 block w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="diameter" class="block text-sm font-medium text-gray-700">Diameter (in cm)</label>
                            <input type="number" name="diameter" id="diameter" value="{{ old('diameter', $module->diameter) }}" class="mt-1 block w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="quantity" class="block text-sm font-medium text-gray-700">Aantal</label>
                            <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $module->quantity) }}" class="mt-1 block w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="compatible_chassis" class="block text-sm font-medium text-gray-700">Compatibele Chassis</label>
                            <select id="compatible_chassis" name="compatible_chassis[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" multiple required>
                                @foreach($chassisModules as $chassis)
                                    <option value="{{ $chassis->id }}" 
                                        @if(in_array($chassis->id, old('compatible_chassis', $module->compatible_chassis ? json_decode($module->compatible_chassis) : [])))
                                            selected
                                        @endif
                                    >
                                        {{ $chassis->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('compatible_chassis') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
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

                        <x-submit-button>Bewerk module</x-submit-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
