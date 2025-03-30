<?php

namespace Database\Factories;

use App\Models\VehicleType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ChassisModule>
 */
class ChassisModuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    use HasFactory;
    
    public function definition(): array
    {

        $vehicleType = VehicleType::first() ?? VehicleType::factory()->create(); 

        return [
            'wheels_count' => $this->faker->randomElement([2, 4]),
            'vehicle_type_id' => $vehicleType->id, 
            'length' => $this->faker->numberBetween(3500, 6000), 
            'width' => $this->faker->numberBetween(1500, 2500), 
            'height' => $this->faker->numberBetween(1200, 2000), 
            'cost' => $this->faker->randomFloat(2, 5000, 20000), 
            'name' => $this->faker->unique()->word,
            'image' => 'https://via.placeholder.com/150', 
        ];
    }
}
