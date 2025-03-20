<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'vehicle_type_id' => $vehicleType->id, // Set the random vehicle type
        ];
    }
}
