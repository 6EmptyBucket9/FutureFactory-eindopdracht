<?php

namespace App\Http\Controllers;

use App\Models\ChassisModule;
use App\Models\DrivetrainModule;
use App\Models\SeatModule;
use App\Models\SteeringModule;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\User;
use App\Models\VehicleType;
use App\Models\WheelModule;
use Illuminate\Support\Facades\Log;

class VehicleAssemblyController extends Controller
{
    public function index()
    {
        // Get modules
        $chassisModules = ChassisModule::all();
        $drivetrainModules = DrivetrainModule::all();
        $steeringModules = SteeringModule::all();
        $seatModules = SeatModule::all();
        $wheelModules = WheelModule::all();
        $vehicleTypes = VehicleType::all();

        $users = User::where('role', 'klant')->get();

        return view('monteur.vehicle_assembly', compact('chassisModules', 'drivetrainModules', 'steeringModules', 'seatModules', 'wheelModules', 'vehicleTypes', 'users'));
    }

    public function assembleVehicle(Request $request)
    {
        // Validate de input
        $request->validate([
            'name' => 'required|string|max:255',
            'vehicle_type_id' => 'required|exists:vehicle_types,id',
            'user_id' => 'required|exists:users,id',
            'chassis' => 'required|exists:chassis_module,id',
            'drivetrain' => 'required|exists:drivetrain_module,id',
            'wheels' => 'required|exists:wheel_module,id',
            'steering' => 'required|exists:steering_module,id',
            'seats' => 'required|exists:seat_module,id',
        ]);

        // Maak een nieuw voertuig aan
        $vehicle = Vehicle::create([
            'name' => $request->input('name'),
            'status_id' => 1,
            'vehicle_type_id' => $request->input('vehicle_type_id'),
            'user_id' => $request->input('user_id'),
            'chassis_module_id' => $request->input('chassis'),
            'drivetrain_module_id' => $request->input('drivetrain'),
            'wheel_module_id' => $request->input('wheels'),
            'steering_module_id' => $request->input('steering'),
            'seat_module_id' => $request->input('seats'),
        ]);

        // Redirect naar de assemblage voltooid pagina
        return redirect()->route('monteur-completed-assembly', ['vehicleId' => $vehicle->id]);
    }


    public function completedAssembly($vehicleId)
    {
        $vehicle = Vehicle::find($vehicleId);

        $selectedModules = [
            'chassis' => $vehicle->chassisModule,
            'drivetrain' => $vehicle->drivetrainModule,
            'wheels' => $vehicle->wheelModule,
            'steering' => $vehicle->steeringModule,
            'seats' => $vehicle->seatModule,
        ];

        $totalprice = $this->calculateTotalPrice($selectedModules);

        return view('monteur.completed_assembly', [
            'selectedModules' => $selectedModules,
            'totalprice' => $totalprice,
            'vehicle' => $vehicle
        ]);
    }

    public function calculateTotalPrice($selectedModules)
    {
        $totalPrice = 0;

        foreach ($selectedModules as $module) {
            if ($module) {
                $totalPrice += $module->cost;
            }
        }

        return $totalPrice;
    }
}
