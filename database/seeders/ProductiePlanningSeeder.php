<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vehicle;
use App\Models\ProductiePlanning;

class ProductiePlanningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        $vehicles = Vehicle::all();

        // Half of the vehicles are in planning
        $selectedVehicles = $vehicles->random(round($vehicles->count() * 0.5));

        foreach ($selectedVehicles as $vehicle) {
            ProductiePlanning::create([
                'vehicle_id' => $vehicle->id,
            ]);
        }
    }
}
