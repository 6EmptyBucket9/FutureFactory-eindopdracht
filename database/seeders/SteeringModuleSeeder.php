<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SteeringModule;
use App\Models\ChassisModule;

class SteeringModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        // Create 10 SteeringModules
        for ($i = 1; $i <= 10; $i++) {
            // Create a new SteeringModule with random data
            $steeringModule = SteeringModule::create([
                'special_adjustments' =>fake()->word, // Random special adjustments (e.g., power steering)
                'shape' =>fake()->word, // Random shape (e.g., circular, rectangular)
                'assembly_time' => rand(1, 3), // Random assembly time (in hours)
                'cost' =>fake()->randomFloat(2, 200, 1000), // Random cost (in currency)
                'name' => fake()->unique()->word,
                'image' => 'https://via.placeholder.com/150', // Placeholder image URL
            ]);

   
        }
    }
}
