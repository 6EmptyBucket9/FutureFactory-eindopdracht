<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VehicleType;

class VehicleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vehicleTypes = ['Step', 'Fiets', 'Scooter', 'Personenauto', 'Vrachtwagen', 'Bus'];

        foreach ($vehicleTypes as $type) {
            VehicleType::create(['type' => $type]);
        }
    }
}
