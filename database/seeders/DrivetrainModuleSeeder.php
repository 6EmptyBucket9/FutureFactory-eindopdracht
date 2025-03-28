<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DrivetrainModule;
use App\Models\ChassisModule;

class DrivetrainModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        // Create 10 DrivetrainModules
        for ($i = 1; $i <= 10; $i++) {
            // Create a new DrivetrainModule with random data
            $drivetrainModule = DrivetrainModule::create([
                'type' => fake()->word, // Random drivetrain type (e.g., electric, gasoline)
                'power' => rand(100, 1000), // Random power (in HP)
                'assembly_time' => rand(1, 5), // Random assembly time (in hours)
                'cost' => fake()->randomFloat(2, 1000, 5000), // Random cost
                'name' => fake()->unique()->word,
                'image' => 'https://via.placeholder.com/150', // Placeholder image URL
            ]);

        }
    }
}
