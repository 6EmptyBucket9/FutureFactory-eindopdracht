<?php

namespace App\Http\Controllers;

use App\Models\ProductiePlanning;
use Illuminate\Http\Request;
use App\Models\Vehicle;

class ProductionPlanningController extends Controller
{


    public function productiePlanning()
    {
        $vehicles = Vehicle::with(['planning', 'modules'])->get();
        $productiePlannings = ProductiePlanning::with('vehicle')->get();


        return view('planner.productiePlanning', compact('vehicles', 'productiePlannings'));
    }
    public function assignVehicleProductiePlanning(Request $request)
    {
        $productiePlanning = ProductiePlanning::where('vehicle_id', $request->vehicle_id)->first();

        if (!$productiePlanning) {
            ProductiePlanning::create([
                'vehicle_id' => $request->vehicle_id
            ]);



            return redirect()->back()->with('success', 'Voertuig succesvol toegevoegd aan productieplanning.');
        } else {
            return redirect()->back()->with('error', 'Dit voertuig heeft al een productieplanning.');
        }
    }
}
