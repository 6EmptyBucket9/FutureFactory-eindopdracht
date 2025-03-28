<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;

class KlantVoortgangController extends Controller
{
    public function index()
    {

        $user = Auth::user();
        $vehicles = Vehicle::where('user_id', $user->id)->get();
        return view('klant.voortgang', compact('vehicles'));
    }
}
