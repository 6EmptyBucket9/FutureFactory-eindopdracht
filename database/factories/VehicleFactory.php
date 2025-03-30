<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

use App\Models\User;
use App\Models\VehicleStatus;
use App\Models\VehicleType;
use App\Models\ChassisModule;
use App\Models\DrivetrainModule;
use App\Models\SeatModule;
use App\Models\SteeringModule;
use App\Models\WheelModule;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $vehicleType = VehicleType::inRandomOrder()->first();
        $status = VehicleStatus::inRandomOrder()->first();
        $user = User::where('role', 'klant')->inRandomOrder()->first() ?: User::factory()->create(['role' => 'klant']);
        
        // Randomly decide whether the modules are installed (1) or not (0)
        $chassisInstalled = rand(0, 1);
        $drivetrainInstalled = rand(0, 1);
        $wheelsInstalled = rand(0, 1);
        $steeringInstalled = rand(0, 1);
        $seatsInstalled = rand(0, 1);

        // Completion date is only set if all modules are installed
        $completionDate = null;
        if ($chassisInstalled && $drivetrainInstalled && $wheelsInstalled && $steeringInstalled && $seatsInstalled) {
            $completionDate = Carbon::now()->addDays(rand(61, 120));
        }

        return [
            'name' => $this->faker->company,
            'vehicle_type_id' => $vehicleType->id,
            'user_id' => $user->id,
            'status_id' => $status->id,
            'expected_completion_date' => Carbon::now()->addDays(rand(10, 60)),
            'completion_date' => $completionDate,
            'chassis_module_id' => ChassisModule::inRandomOrder()->first()?->id ?? ChassisModule::factory(),
            'drivetrain_module_id' => DrivetrainModule::inRandomOrder()->first()?->id ?? DrivetrainModule::factory(),
            'seat_module_id' => SeatModule::inRandomOrder()->first()?->id ?? SeatModule::factory(),
            'steering_module_id' => SteeringModule::inRandomOrder()->first()?->id ?? SteeringModule::factory(),
            'wheel_module_id' => WheelModule::inRandomOrder()->first()?->id ?? WheelModule::factory(),
            'chassis_installed' => $chassisInstalled,
            'drivetrain_installed' => $drivetrainInstalled,
            'wheels_installed' => $wheelsInstalled,
            'steering_installed' => $steeringInstalled,
            'seats_installed' => $seatsInstalled,
        ];
    }
}
