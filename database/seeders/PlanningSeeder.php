<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Planning;
use Illuminate\Support\Carbon;

class PlanningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Timeslots van 2 uur
        $timeslots = [
            '08:00-10:00',
            '10:00-12:00',
            '13:00-15:00',
            '15:00-17:00'
        ];

        $workingDaysCount = 0; // Aantal werkbare dagen
        $currentDate = Carbon::now(); // Startdatum

        // Loop totdat we 5 werkdagen hebben gevuld
        while ($workingDaysCount < 5) {
            // Weekenddagen overslaan
            if ($currentDate->isWeekend()) {
                $currentDate->addDay();
                continue;
            }

            // Genereer de tijdslots voor de huidige werkdag
            foreach ($timeslots as $slot) {
                Planning::create([
                    'date' => $currentDate->format('Y-m-d'),
                    'timeslot' => $slot,
                    'is_completed' => false, // Standaard niet voltooid
                ]);
            }

            // Ga naar de volgende werkdag
            $currentDate->addDay();
            $workingDaysCount++;
        }
    }
}
