<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Assemblage voor') }} {{ $vehicle->name }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <!-- Display Flash Messages -->
        @if (session('error'))
            <div class="text-red-600 mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="text-green-600 mb-4">
                {{ session('success') }}
            </div>
        @endif

        <h3 class="text-lg font-semibold">Modules voor {{ $vehicle->name }}</h3>

        <!-- Display Vehicle Status and Completion Date -->
        <div class="mt-4">
            <p><strong>Status:</strong> {{ $vehicle->status }}</p>
            @if ($vehicle->completion_date)
                <p><strong>Voltooid op:</strong> {{ $vehicle->completion_date }}</p>
            @endif
        </div>

        <ul class="mt-4">
            <!-- Check for chassis module first -->
            <li class="border p-4 mb-2">
                <span><strong>Chassis</strong></span>

                <!-- Check if chassis is installed -->
                @if ($vehicle->chassis_installed)
                    <span class="text-green-500 ml-2">Module al voltooid</span>
                @else
                    <form action="{{ route('mount.module', [$vehicle->id, 'chassis']) }}" method="POST">
                        @csrf
                        <x-submit-button>Monteer</x-submit-button>

                    </form>
                @endif
            </li>

            <!-- Check for drivetrain module only if chassis is installed -->
            <li class="border p-4 mb-2">
                <span><strong>Drivetrain</strong></span>

                @if (!$vehicle->chassis_installed)
                    <span class="text-red-500 ml-2">Afhankelijkheden niet voltooid</span>
                @elseif ($vehicle->drivetrain_installed)
                    <span class="text-green-500 ml-2">Module al voltooid</span>
                @else
                    <form action="{{ route('mount.module', [$vehicle->id, 'drivetrain']) }}" method="POST">
                        @csrf
                        <x-submit-button>Monteer</x-submit-button>

                    </form>
                @endif
            </li>

            <!-- Check for wheels module only if chassis and drivetrain are installed -->
            <li class="border p-4 mb-2">
                <span><strong>Wheels</strong></span>

                @if (!$vehicle->chassis_installed || !$vehicle->drivetrain_installed)
                    <span class="text-red-500 ml-2">Afhankelijkheden niet voltooid</span>
                @elseif ($vehicle->wheels_installed)
                    <span class="text-green-500 ml-2">Module al voltooid</span>
                @else
                    <form action="{{ route('mount.module', [$vehicle->id, 'wheels']) }}" method="POST">
                        @csrf
                        <x-submit-button>Monteer</x-submit-button>

                    </form>
                @endif
            </li>

            <!-- Check for steering module only if wheels are installed -->
            <li class="border p-4 mb-2">
                <span><strong>Steering</strong></span>

                @if (!$vehicle->wheels_installed)
                    <span class="text-red-500 ml-2">Afhankelijkheden niet voltooid</span>
                @elseif ($vehicle->steering_installed)
                    <span class="text-green-500 ml-2">Module al voltooid</span>
                @else
                    <form action="{{ route('mount.module', [$vehicle->id, 'steering']) }}" method="POST">
                        @csrf
                        <x-submit-button>Monteer</x-submit-button>

                    </form>
                @endif
            </li>

            <!-- Check for seats or saddle module only if steering is installed -->
            <li class="border p-4 mb-2">
                <span><strong>Seats or Saddle</strong></span>

                @if (!$vehicle->steering_installed)
                    <span class="text-red-500 ml-2">Afhankelijkheden niet voltooid</span>
                @elseif ($vehicle->seats_installed)
                    <span class="text-green-500 ml-2">Module al voltooid</span>
                @else
                    <form action="{{ route('mount.module', [$vehicle->id, 'seats']) }}" method="POST">
                        @csrf
                        <x-submit-button>Monteer</x-submit-button>

                    </form>
                @endif
            </li>
        </ul>
    </div>
</x-app-layout>
