<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SeatModule;
use App\Models\ChassisModule;

class SeatModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {


        // Create 10 SeatModules
        for ($i = 1; $i <= 10; $i++) {
            // Create a new SeatModule with random data
            $seatModule = SeatModule::create([
                'quantity' => rand(1, 5), // Random number of seats (1 to 5)
                'upholstery' => fake()->word, // Random upholstery type (e.g., leather, fabric)
                'assembly_time' => rand(1, 3), // Random assembly time (in hours)
                'cost' => fake()->randomFloat(2, 500, 1500), // Random cost (in currency)
                'name' => fake()->unique()->word,
                'image' => 'https://via.placeholder.com/150', // Placeholder image URL
            ]);
        }
    }
}
