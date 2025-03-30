<?php

namespace Database\Factories;

use App\Models\ChassisModule;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WheelModule>
 */
class WheelModuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    use HasFactory;
    
    public function definition(): array
    {
        // Generating random data for WheelModule fields
        return [
            'tire_type' => $this->faker->randomElement(['winter', 'zomer', 'allseason']),
            'diameter' => $this->faker->numberBetween(15, 22),
            'quantity' => $this->faker->numberBetween(1, 6), 
            'compatible_chassis' => json_encode(
                ChassisModule::inRandomOrder()->take(rand(1, 3))->pluck('name')->toArray()
            ),
            'assembly_time' => $this->faker->numberBetween(1, 3), 
            'cost' => $this->faker->randomFloat(2, 50, 500), 
            'name' => $this->faker->unique()->word, 
            'image' => 'https://via.placeholder.com/150',
        ];
    }
}
