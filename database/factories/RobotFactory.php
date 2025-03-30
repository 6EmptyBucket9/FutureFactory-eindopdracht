<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Robot>
 */
class RobotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['TwoWheels', 'HydroBoy', 'HeavyD']),
            'type' => $this->faker->randomElement(['tweewielers', 'waterstofvoertuigen', 'zware voertuigen']),
            'description' => function (array $attributes) {
                switch ($attributes['name']) {
                    case 'TwoWheels':
                        return 'Verantwoordelijk voor het assembleren van tweewielers.';
                    case 'HydroBoy':
                        return 'Verantwoordelijk voor het assembleren van waterstofvoertuigen.';
                    case 'HeavyD':
                        return 'Verantwoordelijk voor het assembleren van zware voertuigen.';
                    default:
                        return '';
                }
            },
        ];
    }
}
