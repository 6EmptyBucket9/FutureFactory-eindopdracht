<?php

use App\Models\WheelModule;
use App\Models\ChassisModule;
use App\Models\DrivetrainModule;
use App\Models\SeatModule;
use App\Models\SteeringModule;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleStatus;
use App\Models\VehicleType;

test('loads the vehicle configuration form with necessary modules and users', function () {
    $user = User::factory()->create(['role' => 'monteur']);
    $this->actingAs($user);

    ChassisModule::factory()->create();
    DrivetrainModule::factory()->create();
    SteeringModule::factory()->create();
    SeatModule::factory()->create();
    WheelModule::factory()->create();
    VehicleStatus::factory()->create();
    VehicleType::factory()->create();
    User::factory()->create(['role' => 'klant']);

    $response = $this->get(route('monteur.vehicle-configuration'));

    $response->assertStatus(200);
    $response->assertViewHas('chassisModules');
    $response->assertViewHas('drivetrainModules');
    $response->assertViewHas('steeringModules');
    $response->assertViewHas('seatModules');
    $response->assertViewHas('wheelModules');
    $response->assertViewHas('vehicleTypes');
    $response->assertViewHas('users');
});

test('validates and stores a vehicle configuration successfully', function () {
    $user = User::factory()->create(['role' => 'monteur']);
    $this->actingAs($user);


    $chassis = ChassisModule::factory()->create();
    $wheel = WheelModule::factory()->create(['compatible_chassis' => json_encode([$chassis->id])]);
    $steering = SteeringModule::factory()->create();
    $drivetrain = DrivetrainModule::factory()->create();
    $seat = SeatModule::factory()->create();
    VehicleStatus::factory()->create();
    $vehicleType = VehicleType::factory()->create();
    $userClient = User::factory()->create(['role' => 'klant']);


    $response = $this->post(route('vehicles.store'), [
        'name' => 'Test Vehicle',
        'wheel_id' => $wheel->id,
        'chassis_id' => $chassis->id,
        'steering_id' => $steering->id,
        'drivetrain_id' => $drivetrain->id,
        'seat_id' => $seat->id,
        'vehicle_type_id' => $vehicleType->id,
        'user_id' => $userClient->id,
    ]);

    $vehicle = Vehicle::where('name', 'Test Vehicle')->first();
    $this->assertDatabaseHas('vehicles', [
        'name' => 'Test Vehicle',
        'user_id' => $userClient->id,
        'vehicle_type_id' => $vehicleType->id,
    ]);
});

test('returns an error when the wheel is not compatible with the chassis', function () {
    $user = User::factory()->create(['role' => 'monteur']);
    $this->actingAs($user);
    $chassis = ChassisModule::factory()->create();
    $wheel = WheelModule::factory()->create(['compatible_chassis' => json_encode([999])]); 
    $steering = SteeringModule::factory()->create();
    $drivetrain = DrivetrainModule::factory()->create();
    $seat = SeatModule::factory()->create();

    $vehicleType = VehicleType::factory()->create();
    VehicleStatus::factory()->create();
    $userClient = User::factory()->create(['role' => 'klant']);


    $response = $this->post(route('vehicles.store'), [
        'name' => 'Test Vehicle',
        'wheel_id' => $wheel->id,
        'chassis_id' => $chassis->id,
        'steering_id' => $steering->id,
        'drivetrain_id' => $drivetrain->id,
        'seat_id' => $seat->id,
        'vehicle_type_id' => $vehicleType->id,
        'user_id' => $userClient->id,
    ]);


    $response->assertSessionHasErrors(['wheel_id']);
});
