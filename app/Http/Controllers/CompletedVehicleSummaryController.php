<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class CompletedVehicleSummaryController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::with('planning')->get();

        return view('planner.completedVehicles', compact('vehicles'));
    }
}
