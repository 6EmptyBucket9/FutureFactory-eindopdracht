<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;

class ModuleCostController extends Controller
{
    public function index(Request $request)
    {
        $modules = ModuleController::getAllModules();
        // Calculate totalcost 
        $totalCost = 0;
        if ($request->has('modules')) {
            $selectedModules = Module::whereIn('id', $request->modules)->get();
            foreach ($selectedModules as $module) {
                $totalCost += $module->costs;
            }
        }

        return view('module-cost', compact('modules', 'totalCost'));
    }
}
