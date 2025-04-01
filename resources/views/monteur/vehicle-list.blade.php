<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Voertuigen in Productie') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <h3 class="text-lg font-semibold">Voertuigen in Productie</h3>

        @if ($vehicles->isEmpty())
            <p class="mt-4">Er zijn momenteel geen voertuigen in productie.</p>
        @else
            <ul class="mt-4">
                @foreach ($vehicles as $vehicle)
                    <li class="border p-4 mb-2">
                        <span>{{ $vehicle->name }}</span>
                        <x-link-button href="{{ route('monteur.mount-module-list', $vehicle->id) }}">Monteer
                            Modules</x-link-button>

                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</x-app-layout>
