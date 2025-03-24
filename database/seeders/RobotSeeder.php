<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Robot;

class RobotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Robot::create([
            'name' => 'TwoWheels',
            'type' => 'tweewielers',
            'description' => 'Verantwoordelijk voor het assembleren van tweewielers.',
        ]);
    
        Robot::create([
            'name' => 'HydroBoy',
            'type' => 'waterstofvoertuigen',
            'description' => 'Verantwoordelijk voor het assembleren van waterstofvoertuigen.',
        ]);
    
        Robot::create([
            'name' => 'HeavyD',
            'type' => 'zware voertuigen',
            'description' => 'Verantwoordelijk voor het assembleren van zware voertuigen.',
        ]);
    }
    
}
