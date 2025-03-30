<?php

use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleStatus;
use App\Models\VehicleType;

test('loads the vehicle list with status "in productie"', function () {
    $user = User::factory()->create(['role' => 'monteur']);
    $this->actingAs($user);

    $inProductionStatus = VehicleStatus::factory()->create(['status' => 'in productie']);
    $completedStatus = VehicleStatus::factory()->create(['status' => 'gereed voor levering']);
    VehicleType::factory()->create();
    
    $vehicleInProduction = Vehicle::factory()->create(['status_id' => $inProductionStatus->id]);
    $vehicleCompleted = Vehicle::factory()->create(['status_id' => $completedStatus->id]);


    $response = $this->get(route('monteur.vehicle-list'));


    $response->assertStatus(200);
    $response->assertSee($vehicleInProduction->name);
    $response->assertDontSee($vehicleCompleted->name);
});
