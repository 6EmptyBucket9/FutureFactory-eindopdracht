<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Beheer modules') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <a href="{{ route('inkoper.module-create') }}">
                        <button class="bg-blue-500 text-white px-4 py-2 rounded mb-4">Maak een nieuwe module aan</button>
                    </a>

                    <h3 class="text-lg font-semibold mb-4">Module Lijst</h3>

                    <!-- Table for displaying the modules -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto border-collapse">
                            <thead>
                                <tr class="bg-gray-100 text-left">
                                    <th class="px-6 py-3 text-sm font-medium text-gray-700 uppercase">Module Naam</th>
                                    <th class="px-6 py-3 text-sm font-medium text-gray-700 uppercase">Acties</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($modules as $module)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm font-medium text-gray-800">
                                            <a href="{{ route('inkoper.module-edit', $module->id) }}" class="text-blue-500 hover:underline">
                                                {{ $module->name }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 text-sm">
                                            <!-- Soft Delete Form -->
                                            <form action="{{ route('modules.softDelete', $module->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je deze module wilt softdeleteten?');" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                                                    Softdeleten
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
