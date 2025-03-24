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
                        <button>Maak een nieuwe module aan</button>
                    </a>

                    <h3 class="text-lg font-semibold mb-4">Module Lijst</h3>
                    <ul>
                        @foreach ($modules as $module)
                            <li class="mb-2 flex justify-between items-center">
                                <a href="{{ route('inkoper.module-edit', $module->id) }}">
                                    {{ $module->name }}
                                </a>

                                {{-- Soft delete formulier --}}
                                <form action="{{ route('modules.softDelete', $module->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je deze module wilt softdeleteten?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">
                                        Softdeleten
                                    </button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
