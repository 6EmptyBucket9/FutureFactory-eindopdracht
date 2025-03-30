<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleStatus;
use App\Models\VehicleType;
use Illuminate\Foundation\Testing\RefreshDatabase;





uses(RefreshDatabase::class);





test('mount module list page returns correct data', function () {
    $user = User::factory()->create(['role' => 'monteur']);
    $this->actingAs($user);

    VehicleType::factory()->create();
    VehicleStatus::factory()->create();
    $vehicle = Vehicle::factory()->create();

    $response = $this->get(route('monteur.mount-module-list', $vehicle->id));
    $response->assertStatus(200);
    $response->assertViewIs('monteur.mount-module-list');
    $response->assertViewHas('vehicle', $vehicle);
});


test('it mounts a chassis module successfully', function () {
    $user = User::factory()->create(['role' => 'monteur']);
    $this->actingAs($user);

    VehicleType::factory()->create();
    VehicleStatus::factory()->create();
    $vehicle = Vehicle::factory()->create([
        'chassis_installed' => false,
        'drivetrain_installed' => false,
        'wheels_installed' => false,
        'steering_installed' => false,
        'seats_installed' => false,
    ]);

  
    $response = $this->post(route('mount.module', ['vehicle' => $vehicle->id, 'module' => 'chassis']));

    $this->assertDatabaseHas('vehicles', [
        'id' => $vehicle->id,
        'chassis_installed' => true,
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success', 'Chassis module succesvol gemonteerd.');
});

test('it does not mount a drivetrain without chassis', function () {
    $user = User::factory()->create(['role' => 'monteur']);
    $this->actingAs($user);
    VehicleType::factory()->create();
    VehicleStatus::factory()->create();
    $vehicle = Vehicle::factory()->create([
        'chassis_installed' => false,
    ]);

    $response = $this->post(route('mount.module', ['vehicle' => $vehicle->id, 'module' => 'drivetrain']));

    $this->assertDatabaseHas('vehicles', [
        'id' => $vehicle->id,
        'drivetrain_installed' => false,
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('error', 'Afhankelijkheden niet voltooid');
});

test('it mounts a vehicle successfully and marks it complete', function () {

    $user = User::factory()->create(['role' => 'monteur']);
    $this->actingAs($user);

    $vehicleType = VehicleType::factory()->create();
    $inProductionStatus = VehicleStatus::factory()->create(['status' => 'in productie']);
    $completedStatus = VehicleStatus::factory()->create(['status' => 'gereed voor levering']);

    $vehicle = Vehicle::factory()->create([
        'vehicle_type_id' => $vehicleType->id,
        'status_id' => $inProductionStatus->id,
        'chassis_installed' => true,
        'drivetrain_installed' => true,
        'wheels_installed' => true,
        'steering_installed' => true,
        'seats_installed' => false,
    ]);


    $response = $this->post(route('mount.module', ['vehicle' => $vehicle->id, 'module' => 'seats']));

    $this->assertDatabaseHas('vehicles', [
        'id' => $vehicle->id,
        'seats_installed' => true,
        'status_id' => $completedStatus->id,
    ]);

    $response->assertRedirect(route('monteur.mount-module-list', $vehicle->id));

    $response->assertSessionHas('success', 'Alle modules zijn gemonteerd! Voertuig is voltooid.');
});
