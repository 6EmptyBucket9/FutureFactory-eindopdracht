<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ModuleController;
use App\Models\Module;

class ModuleSummaryController extends Controller
{
    public function index()
    {
        $modules = ModuleController::getAllModules();

        return view('inkoper.module-summary', compact('modules'));
    }
    public function edit(Module $module)
    {
        return view('inkoper.module-edit', compact('module'));
    }
    public function update(Request $request, Module $module)
    {
        $module->update($request->all());
        return redirect()->route('inkoper.module-summary')->with('success', 'Module bijgewerkt!');
    }
    
    public function create()
    {
        return view('inkoper.module-create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'module_type' => 'required|string',
            'amount_of_wheels' => 'nullable|integer',
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'length' => 'nullable|numeric',
            'width' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'drivetrain_type' => 'nullable|string',
            'horsepower' => 'nullable|integer',
            'tire_type' => 'nullable|string',
            'tire_diameter' => 'nullable|numeric',
            'number_of_tires' => 'nullable|integer',
            'special_modifications' => 'nullable|string',
            'steering_shape' => 'nullable|string',
            'number_of_seats' => 'nullable|integer',
            'upholstery' => 'nullable|string',
            'assembly_time' => 'nullable|integer',
            'costs' => 'nullable|numeric',
            'image' => 'nullable|image|max:2048',
            'compatible_chassis' => 'nullable|string',
        ]);
        $dimensions = [
            'length' => $request->input('length'),
            'width' => $request->input('width'),
            'height' => $request->input('height'),
        ];
        $validated['dimensions'] = json_encode($dimensions);

        ModuleController::createModule($validated);
        return redirect()->route('inkoper.module-summary')->with('success', 'Module aangemaakt!');
    }

    public function softDelete($id)
    {
        ModuleController::softDeleteModule($id);

        return redirect()->route('inkoper.module-summary')->with('success', 'Module succesvol gedelete.');
    }
}
