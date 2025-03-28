<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Voltooide Voertuig Assemblage') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h3>Voltooide Assemblage voor {{ $vehicle->name }}:</h3>
            
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-2 gap-4">
                @foreach ($selectedModules as $moduleType => $module)
                    <div class="border p-4">
                        <h4>{{ ucfirst($moduleType) }}:</h4>
                        @if ($module)
                            <div class="mb-4">
                                <h5>{{ $module->name }}</h5>
                                @if ($module->image)
                                    <img src="{{ asset('storage/' . $module->image) }}" alt="{{ $module->name }}" class="w-32 h-32 mb-2">
                                @endif
                                <p>Prijs: €{{ number_format($module->cost, 2) }}</p>
                            </div>
                        @else
                            <p>Geen module geselecteerd voor deze categorie.</p>
                        @endif
                    </div>
                @endforeach

                <div class="border p-4 col-span-2">
                    <h4>Totaalprijs: €{{ number_format($totalprice, 2) }}</h4>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
