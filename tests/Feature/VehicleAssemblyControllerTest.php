<?php

use App\Models\ChassisModule;
use App\Models\DrivetrainModule;
use App\Models\SeatModule;
use App\Models\SteeringModule;
use App\Models\WheelModule;
use App\Models\VehicleType;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleStatus;

test('returns required data on the index page', function () {
    $user = User::factory()->create(['role' => 'monteur']);
    $this->actingAs($user);

    ChassisModule::factory()->count(1)->create();
    DrivetrainModule::factory()->count(1)->create();
    SteeringModule::factory()->count(1)->create();
    SeatModule::factory()->count(1)->create();
    WheelModule::factory()->count(1)->create();
    VehicleType::factory()->count(1)->create();
    User::factory()->create(['role' => 'klant']);

    $response = $this->get(route('monteur-vehicle-assembly'));

    $response->assertStatus(200);
    $response->assertViewHasAll([
        'chassisModules',
        'drivetrainModules',
        'steeringModules',
        'seatModules',
        'wheelModules',
        'vehicleTypes',
        'users'
    ]);
});

test('assembles a vehicle and redirects to completed assembly page', function () {
    $user = User::factory()->create(['role' => 'monteur']);
    $this->actingAs($user);

    $chassis = ChassisModule::factory()->create();
    $drivetrain = DrivetrainModule::factory()->create();
    $wheels = WheelModule::factory()->create();
    $steering = SteeringModule::factory()->create();
    $seats = SeatModule::factory()->create();
    $vehicleType = VehicleType::factory()->create();
    VehicleStatus::factory()->create();
    $user = User::factory()->create(['role' => 'klant']);

    $response = $this->post(route('assemble.vehicle'), [
        'name' => 'Test Vehicle',
        'vehicle_type_id' => $vehicleType->id,
        'user_id' => $user->id,
        'chassis' => $chassis->id,
        'drivetrain' => $drivetrain->id,
        'wheels' => $wheels->id,
        'steering' => $steering->id,
        'seats' => $seats->id,
    ]);

    $vehicle = Vehicle::where('name', 'Test Vehicle')->first();

    $response->assertRedirect(route('monteur-completed-assembly', ['vehicleId' => $vehicle->id]));

    $this->assertDatabaseHas('vehicles', [
        'name' => 'Test Vehicle',
        'vehicle_type_id' => $vehicleType->id,
        'user_id' => $user->id,
    ]);
});

test('calculates the total price for selected modules and displays the vehicle', function () {
       $user = User::factory()->create(['role' => 'monteur']);
    $this->actingAs($user);

    $chassis = ChassisModule::factory()->create(['cost' => 1000]);
    $drivetrain = DrivetrainModule::factory()->create(['cost' => 2000]);
    $wheels = WheelModule::factory()->create(['cost' => 500]);
    $steering = SteeringModule::factory()->create(['cost' => 300]);
    $seats = SeatModule::factory()->create(['cost' => 400]);
    VehicleType::factory()->create();
    VehicleStatus::factory()->create();
    $vehicle = Vehicle::factory()->create([
        'chassis_module_id' => $chassis->id,
        'drivetrain_module_id' => $drivetrain->id,
        'wheel_module_id' => $wheels->id,
        'steering_module_id' => $steering->id,
        'seat_module_id' => $seats->id,
    ]);


    $response = $this->get(route('monteur-completed-assembly', ['vehicleId' => $vehicle->id]));


    $response->assertStatus(200);
    $response->assertViewHas('totalprice', 4200); 
    $response->assertViewHas('selectedModules');
    $response->assertViewHas('vehicle');
});
