<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nieuwe Module Aanmaken') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('inkoper.module-store') }}" enctype="multipart/form-data">
                        @csrf

                        {{-- Unieke naam --}}
                        <label for="name">Naam:</label>
                        <input type="text" id="name" name="name" class="border-gray-300 rounded w-full"
                            required>

                        {{-- Module Type --}}
                        <label for="module_type">Module Type:</label>
                        <select id="module_type" name="module_type" class="border-gray-300 rounded w-full">
                            <option value="chassis">Chassis</option>
                            <option value="aandrijving">Aandrijving</option>
                            <option value="wielen">Wielen</option>
                            <option value="stuur">Stuur</option>
                            <option value="stoelen">Stoelen</option>
                        </select>

                        {{-- Chassis: Aantal wielen --}}
                        <p>Chassis</p>
                        <label for="amount_of_wheels">Aantal Wielen:</label>
                        <select id="amount_of_wheels" name="amount_of_wheels" class="border-gray-300 rounded w-full">
                            <option value="">-- Selecteer --</option>
                            <option value="2">2</option>
                            <option value="4">4</option>
                            <option value="6">6</option>
                            <option value="8">8</option>
                        </select>

                        {{-- Afmetingen (vrij invoerveld) --}}
                        <label for="length">Lengte (cm):</label>
                        <input type="number" id="length" name="length" class="border-gray-300 rounded w-full"
                            required>

                        <label for="width">Breedte (cm):</label>
                        <input type="number" id="width" name="width" class="border-gray-300 rounded w-full"
                            required>

                        <label for="height">Hoogte (cm):</label>
                        <input type="number" id="height" name="height" class="border-gray-300 rounded w-full"
                            required>

                        {{-- Aandrijving: Soort --}}
                        <label for="drivetrain_type">Aandrijvingstype:</label>
                        <select id="drivetrain_type" name="drivetrain_type" class="border-gray-300 rounded w-full">
                            <option value="">-- Selecteer --</option>
                            <option value="waterstof">Waterstof</option>
                            <option value="elektriciteit">Elektriciteit</option>
                        </select>

                        {{-- Aandrijving: Vermogen --}}
                        <label for="power">Vermogen (PK):</label>
                        <input type="number" id="power" name="power" class="border-gray-300 rounded w-full">

                        {{-- Wielen: Type band --}}
                        <label for="tire_type">Type Band:</label>
                        <select id="tire_type" name="tire_type" class="border-gray-300 rounded w-full">
                            <option value="">-- Selecteer --</option>
                            <option value="winter">Winter</option>
                            <option value="zomer">Zomer</option>
                            <option value="allseason">Allseason</option>
                        </select>

                        {{-- Wielen: Diameter --}}
                        <label for="tire_diameter">Band Diameter (inch):</label>
                        <input type="number" step="0.1" id="tire_diameter" name="tire_diameter"
                            class="border-gray-300 rounded w-full">

                        {{-- Wielen: Aantal --}}
                        <label for="number_of_tires">Aantal Banden:</label>
                        <input type="number" id="number_of_tires" name="number_of_tires"
                            class="border-gray-300 rounded w-full">

                        <p>Stuur</p>
                        {{-- Stuur: Vorm --}}
                        <label for="steering_shape">Stuurvorm:</label>
                        <select id="steering_shape" name="steering_shape" class="border-gray-300 rounded w-full">
                            <option value="">-- Selecteer --</option>
                            <option value="rond">Rond</option>
                            <option value="ovaal">Ovaal</option>
                            <option value="stadium">Stadium</option>
                            <option value="hexagon">Hexagon</option>
                        </select>

                        {{-- Stuur: Speciale aanpassingen --}}
                        <label for="special_modifications">Speciale Modificaties:</label>
                        <textarea id="special_modifications" name="special_modifications" class="border-gray-300 rounded w-full"></textarea>
                        <p>Stoelen</p>
                        {{-- Stoelen: Aantal --}}
                        <label for="number_of_seats">Aantal Stoelen:</label>
                        <input type="number" id="number_of_seats" name="number_of_seats"
                            class="border-gray-300 rounded w-full">

                        {{-- Stoelen: Stoffering --}}
                        <label for="upholstery">Stoffering:</label>
                        <select id="upholstery" name="upholstery" class="border-gray-300 rounded w-full">
                            <option value="">-- Selecteer --</option>
                            <option value="leer">Leer</option>
                            <option value="stof">Stof</option>
                            <option value="schapenvacht">Schapenvacht</option>
                            <option value="kunstleer">Kunstleer</option>
                            <option value="metaal">Metaal</option>
                        </select>
                        <p>Algemeen</p>
                        {{-- Montage tijd --}}
                        <label for="assembly_time">Montagetijd (in 2-uurs blokken):</label>
                        <input type="number" id="assembly_time" name="assembly_time"
                            class="border-gray-300 rounded w-full">

                        {{-- Kosten --}}
                        <label for="costs">Kosten (€):</label>
                        <input type="number" step="0.01" id="costs" name="costs"
                            class="border-gray-300 rounded w-full">

                        {{-- Afbeelding uploaden --}}
                        <label for="image">Afbeelding:</label>
                        <input type="file" id="image" name="image" class="border-gray-300 rounded w-full">

                        {{-- Geschikte chassis (vrije tekst) --}}
                        <label for="compatible_chassis">Geschikte Chassis:</label>
                        <input type="text" id="compatible_chassis" name="compatible_chassis"
                            class="border-gray-300 rounded w-full">

                        {{-- Submit knop --}}
                        <<x-submit-button>Maak module aan</x-submit-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
