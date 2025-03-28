<?php

namespace App\Http\Controllers;

use App\Models\ChassisModule;
use App\Models\DrivetrainModule;
use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\SeatModule;
use App\Models\SteeringModule;
use App\Models\VehicleType;
use App\Models\WheelModule;

class ModuleCostController extends Controller
{
    public function index(Request $request)
    {
        $chassisModules = ChassisModule::all();
        $drivetrainModules = DrivetrainModule::all();
        $steeringModules = SteeringModule::all();
        $seatModules = SeatModule::all();
        $wheelModules = WheelModule::all();
    
        $modules = $chassisModules->merge($drivetrainModules)
        ->merge($steeringModules)
        ->merge($seatModules)
        ->merge($wheelModules);
        // Calculate totalcost 
        $totalCost = 0;
        if ($request->has('modules')) {
            $selectedModules = $modules->whereIn('id', $request->modules);
            foreach ($selectedModules as $module) {
                $totalCost += $module->cost;
            }
        }

        return view('module-cost', compact('modules', 'totalCost'));
    }
}
