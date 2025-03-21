<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\Planning;
use App\Models\Vehicle;
use App\Models\Module;

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

        // Haal alle voertuigen en modules op
        $vehicles = Vehicle::all();
        $modules = Module::all();

        if ($vehicles->isEmpty() || $modules->isEmpty()) {
            $this->command->warn('Geen voertuigen of modules gevonden. Zorg ervoor dat je deze eerst seed.');
            return;
        }

        // Loop totdat we 5 werkdagen hebben gevuld
        while ($workingDaysCount < 5) {
            // Weekenddagen overslaan
            if ($currentDate->isWeekend()) {
                $currentDate->addDay();
                continue;
            }

            // Genereer planningen voor elk voertuig en elk timeslot
            foreach ($vehicles as $vehicle) {
                foreach ($timeslots as $slot) {
                    Planning::create([
                        'date' => $currentDate->format('Y-m-d'),
                        'timeslot' => $slot,
                        'vehicle_id' => $vehicle->id,
                        'module_id' => $modules->random()->id, // Willekeurige module toewijzen
                        'is_completed' => false, // Standaard niet voltooid
                    ]);
                }
            }

            // Ga naar de volgende werkdag
            $currentDate->addDay();
            $workingDaysCount++;
        }
    }
}
