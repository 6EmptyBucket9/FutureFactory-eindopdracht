<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VehicleAssemblyController extends Controller
{
    public function index()
    {
        // Get modules
        $modules = ModuleController::getAllModules();

        return view('monteur.vehicle_assembly', compact('modules'));
    }

    public function assembleVehicle(Request $request)
    {
        // Validate the modules in the request
        $request->validate([
            'chassis' => 'required|exists:modules,id',
            'drivetrain' => 'required|exists:modules,id',
            'wheels' => 'required|exists:modules,id',
            'steering' => 'required|exists:modules,id',
            'seats' => 'required|exists:modules,id',
        ]);

        // Get selected modules
        $selectedModules = ModuleController::getModulesByIds([
            $request->input('chassis'),
            $request->input('drivetrain'),
            $request->input('wheels'),
            $request->input('steering'),
            $request->input('seats')
        ]);

        // Store the selected modules in the session
        $request->session()->put('selected_modules', $selectedModules);

        // Redirect to the completed assembly page
        return redirect()->route('monteur-completed-assembly');
    }

    public function completedAssembly(Request $request)
    {
        // Retrieve the selected modules from the session
        $selectedModules = $request->session()->get('selected_modules');
        // Calculate totalprice
        $totalprice = $this->calculateTotalPrice($selectedModules);
        // Remove session
        $request->session()->forget('selected_modules');

        return view('monteur.completed_assembly', [
            'selectedModules' => $selectedModules,
            'totalprice' => $totalprice
        ]);
    }

    public function calculateTotalPrice($selectedModules)
    {
        $totalprice = 0;
        foreach ($selectedModules as $module) {
            $totalprice += $module->costs;
        }
        return $totalprice;
    }
}
