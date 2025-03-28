<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ChassisModule;
use App\Models\VehicleType;
use App\Models\WheelModule;

class ChassisModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create a Faker instance for random data

        // Get a random VehicleType (optional, but useful for seeding)
        $vehicleType = VehicleType::inRandomOrder()->first();

        // Create ChassisModules
        for ($i = 1; $i <= 10; $i++) {
            // Create a new ChassisModule
            $chassisModule = ChassisModule::create([
                'wheels_count' => rand(2, 4), // Random number of wheels (2 or 4)
                'vehicle_type_id' => $vehicleType->id, // Use random vehicle type ID
                'length' => fake()->numberBetween(3500, 6000), // Random length (in mm)
                'width' => fake()->numberBetween(1500, 2500),  // Random width (in mm)
                'height' => fake()->numberBetween(1200, 2000), // Random height (in mm)
                'cost' => fake()->randomFloat(2, 5000, 20000), // Random cost
                'name' => fake()->unique()->word,
                'image' => 'https://via.placeholder.com/150', // Placeholder image URL
            ]);

            // Attach random WheelModules to this ChassisModule
            $wheelModules = WheelModule::inRandomOrder()->take(rand(1, 3))->get(); // Pick 1 to 3 random wheel modules
            $chassisModule->wheelModules()->attach($wheelModules->pluck('id'));
        }
    }
}
