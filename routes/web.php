<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlannerDashboard;
use App\Http\Controllers\VehicleAssemblyController;
use App\Http\Controllers\CalenderController;
use App\Http\Controllers\CompletedVehicleSummaryController;
use App\Http\Controllers\ProductionPlanningController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KlantVoortgangController;
use App\Http\Controllers\ModuleCostController;
use App\Http\Controllers\ModuleSummaryController;
use App\Http\Controllers\MountModuleController;
use App\Http\Controllers\VehicleListController;
use App\Http\Controllers\VehicleConfigurationController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()){
        $user = Auth::user();

        if ($user->role = 'monteur') {
            return redirect()->route('monteur.dashboard');
        } elseif ($user->role = 'inkoper') {
            return redirect()->route('inkoper.dashboard');  
        } elseif ($user->role = 'planner') {
            return redirect()->route('planner.dashboard');  
        } elseif ($user->role = 'klant') {
            return redirect()->route('klant.dashboard');  
        }
        
 
    }
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    // Monteur
    Route::middleware(['role:monteur'])->group(function () {
        Route::get('/monteur/voertuig-configuratie', [VehicleConfigurationController::class, 'create'])->name('monteur.vehicle-configuration');
        Route::resource('vehicles', VehicleConfigurationController::class);
        Route::get('/monteur-dashboard', [HomeController::class, 'monteurDashboard'])->name('monteur.dashboard');

        Route::get('/monteur-samenstelling', [VehicleAssemblyController::class, 'index'])->name('monteur-vehicle-assembly');
        Route::post('/assemble/vehicle', [VehicleAssemblyController::class, 'assembleVehicle'])->name('assemble.vehicle');
        Route::get('/vehicle/{vehicleId}/completed', [VehicleAssemblyController::class, 'completedAssembly'])->name('monteur-completed-assembly');

        Route::get('/monteur/voertuigen-in-productie', [VehicleListController::class, 'index'])->name('monteur.vehicle-list');
        Route::get('/voertuig-modules/{vehicle}', [MountModuleController::class, 'index'])->name('monteur.mount-module-list');

        Route::post('/monteer-voertuig-module/{vehicle}/{module}', [MountModuleController::class, 'mountModule'])->name('mount.module');
    });

    // Planner
    Route::middleware(['role:planner'])->group(function () {
        Route::get('/planner-dashboard', [HomeController::class, 'plannerDashboard'])->name('planner.dashboard');
        // Productionplanning
        Route::get('/planner-productieplanning', [ProductionPlanningController::class, 'index'])->name('planner.productiePlanning');
        Route::post('/planner/assign/productieplanning', [ProductionPlanningController::class, 'assignVehicleProductiePlanning'])->name('planner.assignVehicleProductiePlanning');
        // Calender
        Route::get('/planner-calender', [CalenderController::class, 'index'])->name('planner.calender');
        Route::post('/planner/assign', [CalenderController::class, 'assignVehicle'])->name('planner.assignVehicle');
        Route::post('/planner/assignModule', [CalenderController::class, 'assignModule'])->name('planner.assignModule');
        // Completed vehicle summary
        Route::get('/planner/completed-vehicles', [CompletedVehicleSummaryController::class, 'index'])->name('planner.completedVehicles');
    });

    // Klant 
    Route::middleware(['role:klant'])->group(function () {
        Route::get('/klant-dashboard', [HomeController::class, 'klantDashboard'])->name('klant.dashboard');
        Route::get('/klant-voortgang', [KlantVoortgangController::class, 'index'])->name('klant.voortgang');
    });

    // // Inkoper
    Route::middleware(['role:inkoper'])->group(function () {
        Route::get('/inkoper-dashboard', [HomeController::class, 'inkoperDashboard'])->name('inkoper.dashboard');

        Route::get('/inkoper-module-overzicht', [ModuleSummaryController::class, 'index'])->name('inkoper.module-summary');
        Route::get('/chassis-edit/{id}', [ModuleSummaryController::class, 'chassisEdit'])->name('inkoper.chassis-edit');
        Route::get('/drivetrain-edit/{id}', [ModuleSummaryController::class, 'drivetrainEdit'])->name('inkoper.drivetrain-edit');
        Route::get('/wheel-edit/{id}', [ModuleSummaryController::class, 'wheelEdit'])->name('inkoper.wheel-edit');
        Route::get('/steering-edit/{id}', [ModuleSummaryController::class, 'steeringEdit'])->name('inkoper.steering-edit');
        Route::get('/seat-edit/{id}', [ModuleSummaryController::class, 'seatEdit'])->name('inkoper.seat-edit');

        Route::put('/chassis-update/{id}', [ModuleSummaryController::class, 'chassisUpdate'])->name('inkoper.chassis-update');
        Route::put('/drivetrain-update/{id}', [ModuleSummaryController::class, 'drivetrainUpdate'])->name('inkoper.drivetrain-update');
        Route::put('/seat-update/{id}', [ModuleSummaryController::class, 'seatUpdate'])->name('inkoper.seat-update');
        Route::put('/steering-update/{id}', [ModuleSummaryController::class, 'steeringUpdate'])->name('inkoper.steering-update');
        Route::put('/wheel-update/{id}', [ModuleSummaryController::class, 'wheelUpdate'])->name('inkoper.wheel-update');

        Route::delete('/module/{type}/{id}/soft-delete', [ModuleSummaryController::class, 'softDelete'])->name('modules.softDelete');

        Route::get('/module/chassis/create', [ModuleSummaryController::class, 'chassisCreate'])->name('inkoper.chassis.create');
        Route::post('/module/chassis/store', [ModuleSummaryController::class, 'chassisStore'])->name('module.chassis.store');

        Route::get('/module/drivetrain/create', [ModuleSummaryController::class, 'drivetrainCreate'])->name('inkoper.drivetrain.create');
        Route::post('/module/drivetrain/store', [ModuleSummaryController::class, 'drivetrainStore'])->name('module.drivetrain.store');

        Route::get('/module/seat/create', [ModuleSummaryController::class, 'seatCreate'])->name('inkoper.seat.create');
        Route::post('/module/seat/store', [ModuleSummaryController::class, 'seatStore'])->name('module.seat.store');

        Route::get('/module/steering/create', [ModuleSummaryController::class, 'steeringCreate'])->name('inkoper.steering.create');
        Route::post('/module/steering/store', [ModuleSummaryController::class, 'steeringStore'])->name('module.steering.store');

        Route::get('/module/wheel/create', [ModuleSummaryController::class, 'wheelCreate'])->name('inkoper.wheel.create');
        Route::post('/module/wheel/store', [ModuleSummaryController::class, 'wheelStore'])->name('module.wheel.store');
    });

    // Monteur/Inkoper
    Route::middleware(['role:monteur,planner'])->group(function () {
        Route::get('/module-kosten', [ModuleCostController::class, 'index'])->name('module-cost');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




require __DIR__ . '/auth.php';
