<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SteeringModule>
 */
class SteeringModuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'special_adjustments' => $this->faker->word,
            'shape' => $this->faker->randomElement(['rond', 'ovaal', 'stadium', 'hexagon']),
            'assembly_time' => $this->faker->numberBetween(1, 3), 
            'cost' => $this->faker->randomFloat(2, 200, 1000), 
            'name' => $this->faker->unique()->word, 
            'image' => 'https://via.placeholder.com/150',
        ];
    }
}
