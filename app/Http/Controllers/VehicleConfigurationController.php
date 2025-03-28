<?php

namespace App\Http\Controllers;

use App\Models\WheelModule;
use App\Models\ChassisModule;
use App\Models\DrivetrainModule;
use App\Models\SeatModule;
use App\Models\SteeringModule;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Http\Request;

class VehicleConfigurationController extends Controller
{
    public function create()
    {

        $chassisModules = ChassisModule::all();
        $drivetrainModules = DrivetrainModule::all();
        $steeringModules = SteeringModule::all();
        $seatModules = SeatModule::all();
        $wheelModules = WheelModule::all();
        $vehicleTypes = VehicleType::all();

        $users = User::where('role', 'klant')->get();
        return view('monteur.vehicle-configuration', compact('chassisModules', 'drivetrainModules', 'steeringModules', 'seatModules', 'wheelModules', 'vehicleTypes', 'users'));
    }

    public function store(Request $request)
    {
    
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'wheel_id' => 'required|exists:wheel_module,id',
            'chassis_id' => 'required|exists:chassis_module,id',
            'steering_id' => 'required|exists:steering_module,id',
            'drivetrain_id' => 'required|exists:drivetrain_module,id',
            'seat_id' => 'required|exists:seat_module,id',
            'vehicle_type_id' => 'required|exists:vehicle_types,id',
            'user_id' => 'required|exists:users,id' 
        ]);
    
        // Controleer of de wielen compatibel zijn met het chassis
        $chassis = ChassisModule::findOrFail($validated['chassis_id']);
        $wheel = WheelModule::findOrFail($validated['wheel_id']);
        $compatibleChassis = json_decode($wheel->compatible_chassis, true);
        if (!in_array($chassis->id, $compatibleChassis)) {
            return redirect()->back()->withErrors(['wheel_id' => 'Dit wiel is niet compatibel met het gekozen chassis.']);
        }
        // Voeg het voertuig toe aan de database
        $vehicle = Vehicle::create([
            'name' => $validated['name'],
            'wheel_id' => $validated['wheel_id'],
            'chassis_id' => $validated['chassis_id'],
            'steering_id' => $validated['steering_id'],
            'drivetrain_id' => $validated['drivetrain_id'],
            'seat_id' => $validated['seat_id'],
            'vehicle_type_id' => $validated['vehicle_type_id'],
            'user_id' => $request->user_id, 
            'status_id' => 1
        ]);
    
        return redirect()->route('monteur.vehicle-list', $vehicle);
    }
    
}
