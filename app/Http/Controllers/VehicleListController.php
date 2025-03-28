<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;

class VehicleListController extends Controller
{
    public function index()
    {
        // Fetch vehicles with status 'in productie'
        $vehicles = Vehicle::where('status_id', 1)->get();

        // Return view with the list of vehicles
        return view('monteur.vehicle-list', compact('vehicles'));
    }

}
