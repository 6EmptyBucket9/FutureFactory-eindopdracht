<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SeatModule>
 */
class SeatModuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'quantity' => $this->faker->numberBetween(1, 5), 
            'upholstery' => $this->faker->randomElement(['leer', 'stof', 'schapenvacht', 'kunstleer', 'metaal']),
            'assembly_time' => $this->faker->numberBetween(1, 3),
            'cost' => $this->faker->randomFloat(2, 500, 1500), 
            'name' => $this->faker->unique()->word, 
            'image' => 'https://via.placeholder.com/150',
        ];
    }
}
