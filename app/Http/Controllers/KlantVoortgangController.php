<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;

class KlantVoortgangController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Get the authenticated user
        $vehicles = $user->vehicles; // Get all vehicles for this user
    
        return view('klant.voortgang', compact('vehicles'));
    }
}
