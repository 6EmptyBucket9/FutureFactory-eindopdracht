<?php

use App\Models\ChassisModule;
use App\Models\Vehicle;
use App\Models\Planning;
use App\Models\VehicleStatus;
use App\Models\VehicleType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;

uses(RefreshDatabase::class);

use App\Models\User;

test('index page returns correct data', function () {
    $user = User::factory()->create();
    $user->role = 'planner';
    $this->actingAs($user);


    VehicleType::factory()->create();  
    VehicleStatus::factory()->create();
    Vehicle::factory()->count(3)->create();
    $planning = Planning::factory()->create(['date' => Carbon::now()->format('Y-m-d')]);


    $response = $this->get(route('planner.calender'));


    $response->assertStatus(200);
    $response->assertViewHas('vehicles');
    $response->assertViewHas('weekDays');
});


test('assign vehicle successfully', function () {
    $user = User::factory()->create();
    $user->role = 'planner';
    $this->actingAs($user);


    VehicleType::factory()->create();
    VehicleStatus::factory()->create();
    $vehicle = Vehicle::factory()->create();
    $planning = Planning::factory()->create();

    $response = $this->post(route('planner.assignVehicle'), [
        'vehicle_id' => $vehicle->id,
        'date' => $planning->date,
        'timeslot' => $planning->timeslot,
    ]);

    $response->assertRedirect();
    $this->assertDatabaseHas('planning', [
        'id' => $planning->id,
        'vehicle_id' => $vehicle->id
    ]);
});


test('prevent assigning vehicle when already assigned', function () {
    $user = User::factory()->create();
    $user->role = 'planner';
    $this->actingAs($user);


    VehicleType::factory()->create();
    VehicleStatus::factory()->create();
    $vehicle1 = Vehicle::factory()->create();
    $vehicle2 = Vehicle::factory()->create();
    $planning = Planning::factory()->create(['vehicle_id' => $vehicle1->id]);


    $response = $this->post(route('planner.assignVehicle'), [
        'vehicle_id' => $vehicle2->id,
        'date' => $planning->date,
        'timeslot' => $planning->timeslot,
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('error', 'Er is al een voertuig toegewezen.');
});



test('error session is not set when invalid module type', function () {
    $planning = Planning::factory()->create();

    $response = $this->post(route('planner.assignModule'), [
        'module_type' => 'invalidType,1',
        'date' => $planning->date,
        'timeslot' => $planning->timeslot,
    ]);
    $response->assertSessionMissing('error');
});

