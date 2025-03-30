<?php

use App\Models\ChassisModule;
use App\Models\DrivetrainModule;
use App\Models\SeatModule;
use App\Models\SteeringModule;
use App\Models\WheelModule;
use App\Models\VehicleType;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

uses(RefreshDatabase::class);

beforeEach(function () {
    // Set up any necessary initial state or mocks
    Storage::fake('public');
});


test('index page returns correct modules data', function () {
    $user = User::factory()->create();
    $user->role = 'inkoper';
    $this->actingAs($user);

    ChassisModule::factory()->create();
    DrivetrainModule::factory()->create();
    WheelModule::factory()->create();
    SteeringModule::factory()->create();
    SeatModule::factory()->create();


    $response = $this->get(route('inkoper.module-summary'));


    $response->assertStatus(200);
    $response->assertViewHas('chassisModules');
    $response->assertViewHas('drivetrainModules');
    $response->assertViewHas('wheelModules');
    $response->assertViewHas('steeringModules');
    $response->assertViewHas('seatModules');
});


test('chassisEdit page returns correct data', function () {
    $user = User::factory()->create();
    $user->role = 'inkoper';
    $this->actingAs($user);
    $vehicleType = VehicleType::factory()->create();
    $chassisModule = ChassisModule::factory()->create();

    // Act: Access the chassis edit page
    $response = $this->get(route('inkoper.chassis-edit', $chassisModule->id));

    // Assert: Check if the response is successful and contains the necessary data
    $response->assertStatus(200);
    $response->assertViewHas('module');
    $response->assertViewHas('vehicleTypes');
});


test('chassisUpdate updates the chassis module correctly', function () {
    $user = User::factory()->create();
    $user->role = 'inkoper';
    $this->actingAs($user);
    $chassisModule = ChassisModule::factory()->create();
    $vehicleType = VehicleType::factory()->create();


    $response = $this->put(route('inkoper.chassis-update', $chassisModule->id), [
        'name' => 'Updated Chassis',
        'wheels_count' => 4,
        'vehicle_type_id' => $vehicleType->id,
        'length' => 5.5,
        'width' => 2.0,
        'height' => 1.5,
        'cost' => 1500.0,
    ]);

    $response->assertRedirect(route('inkoper.module-summary'));
    $this->assertDatabaseHas('chassis_module', [
        'name' => 'Updated Chassis',
        'wheels_count' => 4,
    ]);
});


test('soft delete a chassis module', function () {

    $user = User::factory()->create();
    $user->role = 'inkoper';
    $this->actingAs($user);
    $chassisModule = ChassisModule::factory()->create();

    $response = $this->delete(route('modules.softDelete', ['type' => 'chassis', 'id' => $chassisModule->id]));


    $response->assertRedirect(route('inkoper.module-summary'));
    $response->assertSessionHas('success', 'Chassis module soft deleted successfully');

    $this->assertSoftDeleted($chassisModule);
});


test('store a new drivetrain module', function () {
    $user = User::factory()->create();
    $user->role = 'inkoper';
    $this->actingAs($user);

 
    $drivetrainData = [
        'name' => 'New Drivetrain',
        'type' => 'elektrisch',
        'power' => 200,
        'assembly_time' => 5,
        'cost' => 3000,
        'image' => 'drivetrain_images/kvKC2iRHzqaXiUrL2EXluvy5da9S3k0s595FOP4o.jpg',
    ];


    $response = $this->post(route('module.drivetrain.store'), [
        'name' => 'New Drivetrain',
        'type' => 'elektrisch',
        'power' => 200,
        'assembly_time' => 5,
        'cost' => 3000,
        'image' => UploadedFile::fake()->image('dummy-image.jpg'),
    ]);

    $response->assertRedirect(route('inkoper.module-summary'));


    $this->assertDatabaseHas('drivetrain_module', [
        'name' => 'New Drivetrain',
        'type' => 'elektrisch',
        'power' => 200,
        'assembly_time' => 5,
        'cost' => 3000,
    ]);

    //Check that the image field matches the expected pattern
    $module = \App\Models\DrivetrainModule::latest()->first();
    $this->assertMatchesRegularExpression('/drivetrain_images\/[a-zA-Z0-9]+\.jpg/', $module->image);
});
