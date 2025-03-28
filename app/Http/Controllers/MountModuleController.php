<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;

class MountModuleController extends Controller
{
    // Displays the list of modules that need to be mounted for the vehicle
    public function index($vehicleId)
    {
        // Retrieve the vehicle by its ID
        $vehicle = Vehicle::findOrFail($vehicleId);

        // Return the view with the vehicle data
        return view('monteur.mount-module-list', compact('vehicle'));
    }

    // Mount a specific module on a vehicle
    public function mountModule(Request $request, $vehicleId, $moduleType)
    {
        // Retrieve the vehicle by its ID
        $vehicle = Vehicle::findOrFail($vehicleId);

        // Define the available modules
        $modules = [
            'chassis' => 'chassis_installed',
            'drivetrain' => 'drivetrain_installed',
            'wheels' => 'wheels_installed',
            'steering' => 'steering_installed',
            'seats' => 'seats_installed',
        ];

        // Check if the module exists in the array
        if (!isset($modules[$moduleType])) {
            return redirect()->back()->with('error', 'Module not found.');
        }

        // Check dependencies before mounting the module
        $dependenciesMet = false;

        // Check if the module has any prerequisites
        switch ($moduleType) {
            case 'drivetrain':
                $dependenciesMet = $vehicle->chassis_installed;
                break;
            case 'wheels':
                $dependenciesMet = $vehicle->chassis_installed && $vehicle->drivetrain_installed;
                break;
            case 'steering':
                $dependenciesMet = $vehicle->wheels_installed;
                break;
            case 'seats':
                $dependenciesMet = $vehicle->steering_installed;
                break;
            default:
                $dependenciesMet = true;
        }

        // If dependencies are not met, return an error message
        if (!$dependenciesMet) {
            return redirect()->back()->with('error', 'Afhankelijkheden niet voltooid');
        }

        // Mark the current module as installed
        $vehicle->{$modules[$moduleType]} = true;
        $vehicle->save();

        // Check if all modules are completed and update vehicle status
        if ($vehicle->chassis_installed && $vehicle->drivetrain_installed && $vehicle->wheels_installed && $vehicle->steering_installed && $vehicle->seats_installed) {
            $vehicle->status_id = 2;
            $vehicle->completion_date = now();
            $vehicle->save();

            // Flash success message
            return redirect()->route('monteur.mount-module-list', $vehicle->id)->with('success', 'Alle modules zijn gemonteerd! Voertuig is voltooid.');
        }

        // Flash message for module mounted successfully
        return redirect()->back()->with('success', ucfirst($moduleType) . ' module succesvol gemonteerd.');
    }
}
