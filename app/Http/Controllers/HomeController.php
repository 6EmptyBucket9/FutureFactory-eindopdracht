<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function plannerDashboard()
    {
        return view('planner.dashboard');
    }

    public function klantDashboard()
    {
        return view('klant.dashboard');
    }

    public function inkoperDashboard()
    {
        return view('inkoper.dashboard');
    }
}
