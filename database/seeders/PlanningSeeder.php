<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Planning;
class PlanningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Timeslots of 2 hours
        $timeslots = [
            '08:00-10:00', 
            '10:00-12:00', 
            '13:00-15:00', 
            '15:00-17:00'
        ];

        $workingDaysCount = 0; // Counter for working days
        $currentDate = Carbon::now(); // Current date start

        // Loop until we have 5 working days
        while ($workingDaysCount < 5) {
            // Skip weekenddays
            if ($currentDate->isWeekend()) {
                $currentDate->addDay(); // Move to the next day
                continue;
            }

            // Generate timeslots for the current day
            foreach ($timeslots as $slot) {
                Planning::create([
                    'date' => $currentDate->format('Y-m-d'),
                    'timeslot' => $slot,
                ]);
            }

            // Move to the next working day
            $currentDate->addDay();
            $workingDaysCount++; // Increment working days count
        }
    }

}