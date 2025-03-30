<?php

namespace Tests\Feature;

use App\Models\ProductiePlanning;
use App\Models\Robot;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleStatus;
use App\Models\VehicleType;
use Illuminate\Foundation\Testing\RefreshDatabase;





uses(RefreshDatabase::class);

test('it retrieves vehicles, robots, and productie planning for the index view', function () {
    $user = User::factory()->create(['role' => 'planner']);
    $this->actingAs($user);

    VehicleType::factory()->create();
    VehicleStatus::factory()->create();
    $vehicle = Vehicle::factory()->create();
    $robot = Robot::factory()->create();
    $productiePlanning = ProductiePlanning::factory()->create([
        'vehicle_id' => $vehicle->id,
        'robot_id' => $robot->id,
    ]);

    $response = $this->get(route('planner.productiePlanning'));

    $response->assertStatus(200);


    $response->assertViewHas('vehicles');
    $response->assertViewHas('robots');
    $response->assertViewHas('productiePlannings');
    $response->assertViewHas('vehicles', function ($vehicles) use ($vehicle) {
        return $vehicles->contains($vehicle);
    });
});

test('it assigns a vehicle to productie planning successfully', function () {
    $user = User::factory()->create(['role' => 'planner']);
    $this->actingAs($user);

    VehicleType::factory()->create();
    VehicleStatus::factory()->create();
    $vehicle = Vehicle::factory()->create();
    $robot = Robot::factory()->create();


    $response = $this->post(route('planner.assignVehicleProductiePlanning'), [
        'vehicle_id' => $vehicle->id,
        'robot_id' => $robot->id,
    ]);

    $this->assertDatabaseHas('productie_planning', [
        'vehicle_id' => $vehicle->id,
        'robot_id' => $robot->id,
    ]);

    $response->assertSessionHas('success', 'Voertuig succesvol toegevoegd aan productieplanning met de geselecteerde robot.');

});

test('it returns an error when the vehicle already has a productie planning', function () {
    $user = User::factory()->create(['role' => 'planner']);
    $this->actingAs($user);

    VehicleType::factory()->create();
    VehicleStatus::factory()->create();
    $vehicle = Vehicle::factory()->create();
    $robot = Robot::factory()->create();

    ProductiePlanning::create([
        'vehicle_id' => $vehicle->id,
        'robot_id' => $robot->id,
    ]);
    
    $response = $this->post(route('planner.assignVehicleProductiePlanning'), [
        'vehicle_id' => $vehicle->id,
        'robot_id' => $robot->id,
    ]);

    $response->assertSessionHas('error', 'Dit voertuig heeft al een productieplanning.');
    
});
