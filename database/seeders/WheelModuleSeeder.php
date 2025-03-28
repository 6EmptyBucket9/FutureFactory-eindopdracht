<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WheelModule;
use App\Models\ChassisModule;

class WheelModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {


        // Create 10 WheelModules
        for ($i = 1; $i <= 10; $i++) {
            // Create a new WheelModule with random data
            $wheelModule = WheelModule::create([
                'tire_type' => fake()->word, // Random tire type (e.g., radial, all-terrain)
                'diameter' => rand(15, 22), // Random diameter (in inches)
                'quantity' => rand(1, 6), // Random quantity (1 to 6 wheels)
                'compatible_chassis' => json_encode([]),
                'assembly_time' => rand(1, 3), // Random assembly time (in hours)
                'cost' => fake()->randomFloat(2, 50, 500), // Random cost (in currency)
                'name' => fake()->unique()->word, // Random name for the wheel module
                'image' => 'https://via.placeholder.com/150', // Placeholder image URL
            ]);
        }
    }
}
