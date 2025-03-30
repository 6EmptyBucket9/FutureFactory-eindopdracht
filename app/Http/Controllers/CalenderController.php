<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Planning;
use App\Models\Vehicle;


class CalenderController extends Controller
{
    public function index()
    {


        // Haal de voertuigen op voor de dropdown
        $vehicles = Vehicle::all();

        // Haal de planningen op
        $currentDate = Carbon::now();
        $plannings = Planning::where('date', '>=', $currentDate->format('Y-m-d'))
            ->orderBy('date', 'asc')
            ->get()
            ->groupBy('date');

        // Formatteer de planningsdata
        $weekDays = $this->formatPlanningData($plannings);

        return view('planner.calender', compact('weekDays', 'vehicles'));
    }

    public function assignVehicle(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'nullable|exists:vehicles,id',
        ]);

        $planning = $this->findPlanning($request);

        if ($planning) {
            if ($planning->vehicle_id) {
                return redirect()->back()->with('error', 'Er is al een voertuig toegewezen.');
            }

            $planning->vehicle_id = $request->vehicle_id ?: null;
            $planning->save();
        }

        return redirect()->back()->with('success', 'Voertuig succesvol toegewezen.');
    }

    public function assignModule(Request $request)
    {
        $request->validate([
            'module_type' => 'required',
            'date' => 'required|date',
            'timeslot' => 'required',
        ]);

        list($moduleType, $moduleId) = explode(',', $request->module_type);

        $columnMap = [
            'chassis' => 'chassis_module_id',
            'drivetrain' => 'drivetrain_module_id',
            'wheels' => 'wheel_module_id',
            'steering' => 'steering_module_id',
            'seats' => 'seat_module_id',
        ];
        $planning = $this->findPlanning($request);
        if (!isset($columnMap[$moduleType])) {
            return redirect()->back()->with('error', 'Ongeldig module-type.');
        }

        if ($planning) {
            $column = $columnMap[$moduleType];
            $planning->$column = $moduleId;
            $planning->save();

            return redirect()->back()->with('success', 'Module succesvol toegewezen.');
        }
    }


    private function findPlanning(Request $request)
    {
        return Planning::where('date', $request->date)
            ->where('timeslot', $request->timeslot)
            ->first();
    }
    public function formatPlanningData($plannings)
    {
        return $plannings->map(function ($timeslots, $date) {
            $carbonDate = Carbon::parse($date);

            return [
                'day' => $carbonDate->format('D'),
                'date' => $date,
                'isWeekend' => $carbonDate->isWeekend(),
                'timeslots' => $carbonDate->isWeekend() ? [] : $timeslots,
                'assignedVehicles' => $this->getAssignedVehicle($timeslots),
                'assignedModules' => $this->getAssignedModules($timeslots)
            ];
        });
    }

    private function getAssignedVehicle($timeslots)
    {
        $assignedItems = [];

        foreach ($timeslots as $timeslot) {
            // Check if a vehicle is assigned to this timeslot
            if ($timeslot->vehicle_id) {
                $assignedItems[$timeslot->timeslot] = $timeslot->vehicle_id;
            }
        }

        return $assignedItems;
    }

    private function getAssignedModules($timeslots)
    {
        $assignedModules = [];

        foreach ($timeslots as $timeslot) {
            if ($timeslot->chassis_module_id) {
                $assignedModules[$timeslot->timeslot] = 'chassis';
            } elseif ($timeslot->drivetrain_module_id) {
                $assignedModules[$timeslot->timeslot] = 'drivetrain';
            } elseif ($timeslot->wheel_module_id) {
                $assignedModules[$timeslot->timeslot] = 'wheels';
            } elseif ($timeslot->steering_module_id) {
                $assignedModules[$timeslot->timeslot] = 'steering';
            } elseif ($timeslot->seat_module_id) {
                $assignedModules[$timeslot->timeslot] = 'seats';
            }
        }

        return $assignedModules;
    }
}
