<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bewerk Module: ') . $module->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('inkoper.module-update', $module->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <label class="block text-sm font-medium text-gray-700">Module Naam:</label>
                        <input type="text" name="name" value="{{ $module->name }}" class="w-full border-gray-300 rounded-md shadow-sm mb-2">

                        <label class="block text-sm font-medium text-gray-700">Type:</label>
                        <input type="text" name="module_type" value="{{ $module->module_type }}" class="w-full border-gray-300 rounded-md shadow-sm mb-2">

                        <label class="block text-sm font-medium text-gray-700">Aantal Wielen:</label>
                        <input type="number" name="amount_of_wheels" value="{{ $module->amount_of_wheels }}" class="w-full border-gray-300 rounded-md shadow-sm mb-2">

                        <label class="block text-sm font-medium text-gray-700">Afmetingen:</label>
                        <input type="text" name="dimensions" value="{{ $module->dimensions }}" class="w-full border-gray-300 rounded-md shadow-sm mb-2">

                        <button type="submit" class="px-4 py-2 rounded">Opslaan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
