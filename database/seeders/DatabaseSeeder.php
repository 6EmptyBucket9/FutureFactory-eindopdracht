<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\VehicleStatusSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        $this->call([ 
            VehicleTypeSeeder::class,
            VehicleStatusSeeder::class,
            ChassisModuleSeeder::class,
            WheelModuleSeeder::class,
            SteeringModuleSeeder::class,
            SeatModuleSeeder::class,
            DrivetrainModuleSeeder::class,
            PlanningSeeder::class,
           
            VehicleSeeder::class,
            ProductiePlanningSeeder::class,
            RobotSeeder::class,

        ]);
    }
}
