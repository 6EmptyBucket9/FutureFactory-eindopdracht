<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vehicle;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vehicle::create([
            'type' => 'Step',
        ]);
        Vehicle::create([
            'type' => 'Fiets',
        ]);
        Vehicle::create([
            'type' => 'Scooter',
        ]);
        Vehicle::create([
            'type' => 'Personenauto',
        ]);
        Vehicle::create([
            'type' => 'Vrachtwagen',
        ]);
        Vehicle::create([
            'type' => 'Bus',
        ]);
    }
}
