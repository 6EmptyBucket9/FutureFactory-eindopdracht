<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ModuleController;
use App\Models\ChassisModule;
use App\Models\DrivetrainModule;
use App\Models\Module;
use App\Models\SeatModule;
use App\Models\SteeringModule;
use App\Models\VehicleType;
use App\Models\WheelModule;

class ModuleSummaryController extends Controller
{
    public function index()
    {
        // Haal alle modules op voor elk specifiek type
        $chassisModules = ChassisModule::all();
        $drivetrainModules = DrivetrainModule::all();
        $wheelModules = WheelModule::all();
        $steeringModules = SteeringModule::all();
        $seatModules = SeatModule::all();

        // Geef de modules door aan de view
        return view('inkoper.module-summary', compact('chassisModules', 'drivetrainModules', 'wheelModules', 'steeringModules', 'seatModules'));
    }

    public function chassisEdit($id)
    {
        $vehicleTypes = VehicleType::all();
        $module = ChassisModule::findOrFail($id);
        return view('inkoper.chassis-edit', compact('module', 'vehicleTypes'));
    }

    public function drivetrainEdit($id)
    {
        $vehicleTypes = VehicleType::all();
        $module = DrivetrainModule::findOrFail($id);
        return view('inkoper.drivetrain-edit', compact('module', 'vehicleTypes'));
    }

    public function wheelEdit($id)
    {
        $chassisModules = ChassisModule::all();
        $module = WheelModule::findOrFail($id);
        return view('inkoper.wheel-edit', compact('module', 'chassisModules'));
    }

    public function steeringEdit($id)
    {
        $module = SteeringModule::findOrFail($id);
        return view('inkoper.steering-edit', compact('module'));
    }

    public function seatEdit($id)
    {
        $module = SeatModule::findOrFail($id);
        return view('inkoper.seat-edit', compact('module'));
    }

    public function chassisUpdate(Request $request, $id)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'wheels_count' => 'required|integer',
            'vehicle_type_id' => 'required|integer',
            'length' => 'required|numeric',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'cost' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);


        $module = ChassisModule::findOrFail($id);


        $module->update([
            'name' => $validated['name'],
            'wheels_count' => $validated['wheels_count'],
            'vehicle_type_id' => $validated['vehicle_type_id'],
            'length' => $validated['length'],
            'width' => $validated['width'],
            'height' => $validated['height'],
            'cost' => $validated['cost'],
        ]);

        // Handle the image upload if an image was provided
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('chassis_images', 'public');
            $module->update(['image' => $path]);
        }

        // Redirect to a route (example: the module summary page)
        return redirect()->route('inkoper.module-summary')->with('success', 'Chassis module updated successfully.');
    }

    public function drivetrainUpdate(Request $request, $id)
    {
        $module = DrivetrainModule::findOrFail($id);

        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'power' => 'required|numeric',
            'assembly_time' => 'required|numeric',
            'cost' => 'required|numeric',
            'image' => 'nullable|image|max:1024',
        ]);

        // Update the module attributes
        $module->update([
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'power' => $request->input('power'),
            'assembly_time' => $request->input('assembly_time'),
            'cost' => $request->input('cost'),
        ]);

        // Handle image upload if present
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('drivetrain_images', 'public');
            $module->update(['image' => $imagePath]);
        }

        // Redirect back to the edit page with success message
        return redirect()->route('inkoper.module-summary', $module->id)
            ->with('success', 'Module updated successfully.');
    }

    public function seatUpdate(Request $request, $id)
    {
        // Find the SeatModule by its ID
        $module = SeatModule::findOrFail($id);

        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|numeric',
            'upholstery' => 'required|string|max:255',
            'assembly_time' => 'required|numeric',
            'cost' => 'required|numeric',
            'image' => 'nullable|image|max:1024',
        ]);

        // Update the SeatModule attributes
        $module->update([
            'name' => $request->input('name'),
            'quantity' => $request->input('quantity'),
            'upholstery' => $request->input('upholstery'),
            'assembly_time' => $request->input('assembly_time'),
            'cost' => $request->input('cost'),
        ]);

        // Handle image upload if an image is provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('seat_images', 'public');
            $module->update(['image' => $imagePath]);
        }

        // Redirect to the edit page with success message
        return redirect()->route('inkoper.module-summary', $module->id)
            ->with('success', 'Module updated successfully.');
    }


    public function steeringUpdate(Request $request, $id)
    {
        // Find the SteeringModule by its ID
        $module = SteeringModule::findOrFail($id);

        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'special_adjustments' => 'required|string|max:255',
            'shape' => 'required|string|max:255',
            'assembly_time' => 'required|numeric',
            'cost' => 'required|numeric',
            'image' => 'nullable|image|max:1024',
        ]);

        // Update the SteeringModule attributes
        $module->update([
            'name' => $request->input('name'),
            'special_adjustments' => $request->input('special_adjustments'),
            'shape' => $request->input('shape'),
            'assembly_time' => $request->input('assembly_time'),
            'cost' => $request->input('cost'),
        ]);

        // Handle image upload if an image is provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('steering_images', 'public');
            $module->update(['image' => $imagePath]);
        }

        // Redirect to the edit page with success message
        return redirect()->route('inkoper.module-summary', $module->id)
            ->with('success', 'Module updated successfully.');
    }

    public function wheelUpdate(Request $request, $id)
    {
        // Find the WheelModule by its ID
        
        $module = WheelModule::findOrFail($id);

        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'tire_type' => 'required|string|max:255',
            'diameter' => 'required|numeric',
            'quantity' => 'required|numeric',
            'compatible_chassis' => 'required|string|max:255',
            'assembly_time' => 'required|numeric',
            'cost' => 'required|numeric',
            'image' => 'nullable|image|max:1024',
        ]);

        // Update the WheelModule attributes
        $module->update([
            'name' => $request->input('name'),
            'tire_type' => $request->input('tire_type'),
            'diameter' => $request->input('diameter'),
            'quantity' => $request->input('quantity'),
            'compatible_chassis' => $request->input('compatible_chassis'),
            'assembly_time' => $request->input('assembly_time'),
            'cost' => $request->input('cost'),
        ]);

        // Handle image upload if an image is provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('wheel_images', 'public');
            $module->update(['image' => $imagePath]);
        }

        // Redirect to the edit page with success message
        return redirect()->route('inkoper.module-summary', $module->id)
            ->with('success', 'Module updated successfully.');
    }

    public function softDelete($type, $id)
    {
        // Dynamically resolve the module type based on the type passed
        switch ($type) {
            case 'chassis':
                $module = ChassisModule::findOrFail($id);
                break;
            case 'drivetrain':
                $module = DrivetrainModule::findOrFail($id);
                break;
            case 'seat':
                $module = SeatModule::findOrFail($id);
                break;
            case 'steering':
                $module = SteeringModule::findOrFail($id);
                break;
            case 'wheel':
                $module = WheelModule::findOrFail($id);
                break;
            default:
                return redirect()->route('inkoper.module-summary')->with('error', 'Module type not found');
        }

        // Soft delete the module
        $module->delete();

        // Redirect back to the previous page with a success message
        return redirect()->route('inkoper.module-summary')->with('success', ucfirst($type) . ' module soft deleted successfully');
    }
    public function chassisCreate()
    {
        $vehicleTypes = VehicleType::all();
        return view('inkoper.chassis-create', compact('vehicleTypes'));
    }

    public function drivetrainCreate()
    {
        return view('inkoper.drivetrain-create');
    }

    public function seatCreate()
    {
        return view('inkoper.seat-create');
    }

    public function steeringCreate()
    {
        return view('inkoper.steering-create');
    }

    public function wheelCreate()

    {
        $chassisModules = ChassisModule::all();
        return view('inkoper.wheel-create', compact('chassisModules'));
    }
    public function chassisStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'wheels_count' => 'required|integer',
            'vehicle_type_id' => 'required|integer',
            'length' => 'required|numeric',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'cost' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        $module = ChassisModule::create($validated);

        // Handle image upload if present
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('chassis_images', 'public');
            $module->update(['image' => $imagePath]);
        }

        return redirect()->route('inkoper.module-summary')->with('success', 'Chassis module created successfully.');
    }

    public function drivetrainStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'power' => 'required|numeric',
            'assembly_time' => 'required|numeric',
            'cost' => 'required|numeric',
            'image' => 'nullable|image|max:1024',
        ]);

        $module = DrivetrainModule::create($validated);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('drivetrain_images', 'public');
            $module->update(['image' => $imagePath]);
        }

        return redirect()->route('inkoper.module-summary')->with('success', 'Drivetrain module created successfully.');
    }

    public function seatStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|numeric',
            'upholstery' => 'required|string|max:255',
            'assembly_time' => 'required|numeric',
            'cost' => 'required|numeric',
            'image' => 'nullable|image|max:1024',
        ]);

        $module = SeatModule::create($validated);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('seat_images', 'public');
            $module->update(['image' => $imagePath]);
        }

        return redirect()->route('inkoper.module-summary')->with('success', 'Seat module created successfully.');
    }

    public function steeringStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'special_adjustments' => 'required|string|max:255',
            'shape' => 'required|string|max:255',
            'assembly_time' => 'required|numeric',
            'cost' => 'required|numeric',
            'image' => 'nullable|image|max:1024',
        ]);

        $module = SteeringModule::create($validated);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('steering_images', 'public');
            $module->update(['image' => $imagePath]);
        }

        return redirect()->route('inkoper.module-summary')->with('success', 'Steering module created successfully.');
    }

    public function wheelStore(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'tire_type' => 'required|string|max:255',
            'diameter' => 'required|numeric',
            'quantity' => 'required|numeric',
            'compatible_chassis' => 'required|array',
            'compatible_chassis.*' => 'exists:chassis_module,id',
            'assembly_time' => 'required|numeric',
            'cost' => 'required|numeric',
            'image' => 'nullable|image|max:1024',
        ]);

        // Handle the image upload if a file is provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('wheel_images', 'public');
        } else {
            $imagePath = null;  // In case no image is uploaded
        }

        // Create the new WheelModule
        $wheelModule = WheelModule::create([
            'name' => $validated['name'],
            'tire_type' => $validated['tire_type'],
            'diameter' => $validated['diameter'],
            'quantity' => $validated['quantity'],
            'compatible_chassis' => json_encode($validated['compatible_chassis']),
            'assembly_time' => $validated['assembly_time'],
            'cost' => $validated['cost'],
            'image' => $imagePath,
        ]);

        // Redirect back with a success message
        return redirect()->route('inkoper.module-summary')->with('success', 'Wheel module created successfully!');
    }
}
