<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Planning;
use App\Models\Vehicle;

class PlanningController extends Controller
{
    public function index()
    {
        // Get todays date
        $currentDate = Carbon::now();

        //Get the next 5 workingdays
        $plannings = Planning::where('date', '>=', $currentDate->format('Y-m-d'))
            ->orderBy('date', 'asc')
            ->get()
            ->groupBy('date');

        // Get all vehicles for dropdown selection
        $vehicles = Vehicle::all();

        // Format data for the view
        $weekDays = [];
        foreach ($plannings as $date => $timeslots) {
            $carbonDate = Carbon::parse($date);
            $weekDays[] = [
                'day' => $carbonDate->format('D'), //Format carbon to day
                'date' => $date,
                'isWeekend' => $carbonDate->isWeekend(), // Check if it's a weekend
                'timeslots' => $carbonDate->isWeekend() ? [] : $timeslots, // Only show timeslots on weekdays
                // Retrieve assigned vehicles for the timeslots
                'assignedVehicles' => $timeslots->keyBy('timeslot')->map(function ($planning) {
                    return $planning->vehicle_id;
                }),
            ];
        }

        return view('planner.calender', compact('weekDays', 'vehicles'));
    }

    public function assignVehicle(Request $request)
    {
        // Validate the input
        $request->validate([
            'date' => 'required|date',
            'timeslot' => 'required|string',
            'vehicle_id' => 'nullable|exists:vehicles,id', // Vehicle can be null
        ]);
    
        // Find specific planning
        $planning = Planning::where('date', $request->date)
                            ->where('timeslot', $request->timeslot)
                            ->first();
    
        if ($planning) {
            $planning->vehicle_id = $request->vehicle_id ?: null; // If no vehicle selected, set to null
            $planning->save();
        }
    
        return redirect()->back()->with('success', 'Vehicle assigned successfully.');
    }
    
    
    
}
