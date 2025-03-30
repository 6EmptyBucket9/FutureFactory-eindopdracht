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
        return [
            'name' => $this->faker->company,
            'vehicle_type_id' => $vehicleType->id,
            'user_id' => $user->id,
            'status_id' => $status->id,
            'expected_completion_date' => Carbon::now()->addDays(rand(10, 60)),
            'completion_date' => Carbon::now()->addDays(rand(61, 120)),
            'chassis_module_id' => ChassisModule::inRandomOrder()->first()?->id ?? ChassisModule::factory(),
            'drivetrain_module_id' => DrivetrainModule::inRandomOrder()->first()?->id ?? DrivetrainModule::factory(),
            'seat_module_id' => SeatModule::inRandomOrder()->first()?->id ?? SeatModule::factory(),
            'steering_module_id' => SteeringModule::inRandomOrder()->first()?->id ?? SteeringModule::factory(),
            'wheel_module_id' => WheelModule::inRandomOrder()->first()?->id ?? WheelModule::factory(),
        ];
    }
}
