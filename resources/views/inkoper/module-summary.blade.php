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
                    <h3 class="text-lg font-semibold mb-4 text-black">Module Lijst</h3>
                    <div class="mb-6 flex flex-wrap gap-4">
                        <x-link-button href="{{ route('inkoper.chassis.create') }}">
                            Nieuwe Chassis Module Aanmaken
                        </x-link-button>
                        <x-link-button href="{{ route('inkoper.drivetrain.create') }}">
                            Nieuwe Drivetrain Module Aanmaken
                        </x-link-button>
                        <x-link-button href="{{ route('inkoper.wheel.create') }}">
                            Nieuwe Wheel Module Aanmaken
                        </x-link-button>
                        <x-link-button href="{{ route('inkoper.steering.create') }}">
                            Nieuwe Steering Module Aanmaken
                        </x-link-button>
                        <x-link-button href="{{ route('inkoper.seat.create') }}">
                            Nieuwe Seat Module Aanmaken
                        </x-link-button>
                    </div>
                </div>


                <!-- Chassis Modules -->
                <h4 class="font-semibold mb-2 text-black">Chassis Modules</h4>
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto border-collapse">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th class="px-6 py-3 text-sm font-medium text-gray-700 uppercase">Module Naam</th>
                                <th class="px-6 py-3 text-sm font-medium text-gray-700 uppercase">Acties</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($chassisModules as $module)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-800">
                                        <a href="{{ route('inkoper.chassis-edit', ['type' => 'chassis', 'id' => $module->id]) }}"
                                            class="text-black hover:underline">
                                            {{ $module->name }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        <!-- Soft Delete Form -->
                                        <form
                                            action="{{ route('modules.softDelete', ['type' => 'chassis', 'id' => $module->id]) }}"
                                            method="POST"
                                            onsubmit="return confirm('Weet je zeker dat je deze module wilt softdeleteten?');"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <x-delete-button>Verwijderen</x-delete-button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Drivetrain Modules -->
                <h4 class="font-semibold mb-2 mt-6 text-black">Drivetrain Modules</h4>
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto border-collapse">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th class="px-6 py-3 text-sm font-medium text-gray-700 uppercase">Module Naam</th>
                                <th class="px-6 py-3 text-sm font-medium text-gray-700 uppercase">Acties</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($drivetrainModules as $module)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-800">
                                        <a href="{{ route('inkoper.drivetrain-edit', ['type' => 'drivetrain', 'id' => $module->id]) }}"
                                            class="text-black hover:underline">
                                            {{ $module->name }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        <!-- Soft Delete Form -->
                                        <form
                                            action="{{ route('modules.softDelete', ['type' => 'drivetrain', 'id' => $module->id]) }}"
                                            method="POST"
                                            onsubmit="return confirm('Weet je zeker dat je deze module wilt softdeleteten?');"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <x-delete-button>Verwijderen</x-delete-button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Wheel Modules -->
                <h4 class="font-semibold mb-2 text-black">Wheel Modules</h4>
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto border-collapse">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th class="px-6 py-3 text-sm font-medium text-gray-700 uppercase">Module Naam</th>
                                <th class="px-6 py-3 text-sm font-medium text-gray-700 uppercase">Acties</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wheelModules as $module)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-800">
                                        <a href="{{ route('inkoper.wheel-edit', ['type' => 'wheel', 'id' => $module->id]) }}"
                                            class="text-black hover:underline">
                                            {{ $module->name }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        <!-- Soft Delete Form -->
                                        <form
                                            action="{{ route('modules.softDelete', ['type' => 'wheel', 'id' => $module->id]) }}"
                                            method="POST"
                                            onsubmit="return confirm('Weet je zeker dat je deze module wilt softdeleteten?');"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <x-delete-button>Verwijderen</x-delete-button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Steering Modules -->
                <h4 class="font-semibold mb-2 text-black">Steering Modules</h4>
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto border-collapse">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th class="px-6 py-3 text-sm font-medium text-gray-700 uppercase">Module Naam</th>
                                <th class="px-6 py-3 text-sm font-medium text-gray-700 uppercase">Acties</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($steeringModules as $module)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-800">
                                        <a href="{{ route('inkoper.steering-edit', ['type' => 'steering', 'id' => $module->id]) }}"
                                            class="text-black hover:underline">
                                            {{ $module->name }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        <!-- Soft Delete Form -->
                                        <form
                                            action="{{ route('modules.softDelete', ['type' => 'steering', 'id' => $module->id]) }}"
                                            method="POST"
                                            onsubmit="return confirm('Weet je zeker dat je deze module wilt softdeleteten?');"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <x-delete-button>Verwijderen</x-delete-button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Seat Modules -->
                <h4 class="font-semibold mb-2 mt-6 text-black">Seat Modules</h4>
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto border-collapse">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th class="px-6 py-3 text-sm font-medium text-gray-700 uppercase">Module Naam</th>
                                <th class="px-6 py-3 text-sm font-medium text-gray-700 uppercase">Acties</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($seatModules as $module)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-800">
                                        <a href="{{ route('inkoper.seat-edit', ['type' => 'seat', 'id' => $module->id]) }}"
                                            class="text-black hover:underline">
                                            {{ $module->name }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        <!-- Soft Delete Form -->
                                        <form
                                            action="{{ route('modules.softDelete', ['type' => 'seat', 'id' => $module->id]) }}"
                                            method="POST"
                                            onsubmit="return confirm('Weet je zeker dat je deze module wilt softdeleteten?');"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <x-delete-button>Verwijderen</x-delete-button>
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
