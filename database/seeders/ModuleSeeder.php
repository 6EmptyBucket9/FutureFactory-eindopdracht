<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Module;
use App\Models\Vehicle;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           $vehicle = Vehicle::create([
            'name' => 'Nikinella', 
            'vehicle_type_id' => 1
        ]);

          // Chassis Nikinella
          Module::create([
            'name' => 'Chassis Nikinella',
            'module_type' => 'chassis',
            'amount_of_wheels' => 4,
            'vehicle_id' => $vehicle->id,
            'dimensions' => json_encode(['length' => 400, 'width' => 186, 'height' => 165]),
            'assembly_time' => 2,
            'costs' => 4400,
            'image' => 'path/to/image_for_chassis_nikinella.jpg'
        ]);

        // Aandrijving Waterstof138
        Module::create([
            'name' => 'Aandrijving Waterstof138',
            'module_type' => 'drivetrain',
            'drivetrain_type' => 'waterstof',
            'horsepower' => 138,
            'vehicle_id' => $vehicle->id,
            'assembly_time' => 2,
            'costs' => 32000,
            'image' => 'path/to/image_for_waterstof138.jpg'
        ]);

        // Wielen Z15-4
        Module::create([
            'name' => 'Wielen Z15-4',
            'module_type' => 'wheels',
            'tire_type' => 'zomer',
            'tire_diameter' => 15,
            'number_of_tires' => 4,
            'compatible_chassis' => json_encode(['Nikinella', 'Centio']),
            'vehicle_id' => $vehicle->id,
            'assembly_time' => 1,
            'costs' => 1200,
            'image' => 'path/to/image_for_z15_4_wheels.jpg',
        ]);

        // Stuur Schapenstadium
        Module::create([
            'name' => 'Stuur Schapenstadium',
            'module_type' => 'steering',
            'special_modifications' => 'schapenvacht',
            'steering_shape' => 'stadium',
            'vehicle_id' => $vehicle->id,
            'assembly_time' => 1,
            'costs' => 400,
            'image' => 'path/to/image_for_schapenstadium_steering.jpg'
        ]);

        // Stoelen Leren Bekleding
        Module::create([
            'name' => 'Stoelen Leren Bekleding',
            'module_type' => 'seats',
            'number_of_seats' => 5,
            'upholstery' => 'leer',
            'vehicle_id' => $vehicle->id,
            'assembly_time' => 1,
            'costs' => 1600,
            'image' => 'path/to/image_for_leather_seats.jpg'
        ]);
    }
}

