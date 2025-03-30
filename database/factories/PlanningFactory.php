<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Planning;
use Illuminate\Support\Carbon;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Planning>
 */
class PlanningFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Planning::class;

    public function definition(): array
    {
        // Timeslots van 2 uur
        $timeslots = [
            '08:00-10:00',
            '10:00-12:00',
            '13:00-15:00',
            '15:00-17:00'
        ];

        // Bepaal een willekeurige datum binnen de komende 10 werkdagen
        $currentDate = Carbon::now();
        while ($currentDate->isWeekend()) {
            $currentDate->addDay();
        }

        return [
            'date' => $currentDate->addDays(rand(0, 10))->format('Y-m-d'),
            'timeslot' => $this->faker->randomElement($timeslots),
            'is_completed' => false, // Standaard niet voltooid
        ];
    }
}
