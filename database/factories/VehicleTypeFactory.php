<?php

namespace Database\Factories;

use App\Models\VehicleType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VehicleType>
 */
class VehicleTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = VehicleType::class;

    public function definition(): array
    {
        $vehicleTypes = ['Step', 'Fiets', 'Scooter', 'Personenauto', 'Vrachtwagen', 'Bus'];

        return [
            'type' => $this->faker->randomElement($vehicleTypes), // Randomly pick a vehicle type
        ];
    }
}
