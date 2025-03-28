<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VehicleStatus;

class VehicleStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = ['in productie', 'gereed voor levering', 'geleverd'];

        foreach ($statuses as $status) {
            VehicleStatus::firstOrCreate(['status' => $status]);
        }
    }
}
