<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DrivetrainModule>
 */
class DrivetrainModuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(['waterstof', 'elektriciteit']), 
            'power' => $this->faker->numberBetween(100, 1000), 
            'assembly_time' => $this->faker->numberBetween(1, 5), 
            'cost' => $this->faker->randomFloat(2, 1000, 5000), 
            'name' => $this->faker->unique()->word, 
            'image' => 'https://via.placeholder.com/150', 
        ];
    }
}
