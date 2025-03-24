<?php

namespace App\Http\Controllers;

use App\Models\ProductiePlanning;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Robot;


class ProductionPlanningController extends Controller
{


    public function index()
    {
        $vehicles = Vehicle::all();
        $robots = Robot::all(); // Get all available robots
        $productiePlannings = ProductiePlanning::all();
        
        return view('planner.productiePlanning', compact('vehicles', 'robots', 'productiePlannings'));
    }
    
    public function assignVehicleProductiePlanning(Request $request)
    {
    
        // Validate the incoming data
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'robot_id' => 'required|exists:robots,id',
        ]);
    
        // Check if the vehicle already has a planning
        $productiePlanning = ProductiePlanning::where('vehicle_id', $request->vehicle_id)->first();
        
        if (!$productiePlanning) {
            // If no planning exists, create a new productie planning
            ProductiePlanning::create([
                'vehicle_id' => $validated['vehicle_id'],
                'robot_id' => $validated['robot_id'], 
            ]);
      
            
            return redirect()->back()->with('success', 'Voertuig succesvol toegevoegd aan productieplanning met de geselecteerde robot.');
        } else {
            // If the vehicle already has a planning, return an error
            return redirect()->back()->with('error', 'Dit voertuig heeft al een productieplanning.');
        }
    }
    
    
}
