<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use App\Models\VehicleType;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $vehicleType = VehicleType::inRandomOrder()->first();

        return [
            'name' => $this->faker->company, 
            'vehicle_type_id' => $vehicleType ? $vehicleType->id : VehicleType::factory(), // Ensure vehicle type exists
            'completion_date' => $this->faker->optional()->date(), // Random completion date or null
            'expected_completion_date' => Carbon::now()->addDays(rand(10, 60)), // Random future date for expected completion
        ];
    }
}
