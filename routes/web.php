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
use App\Http\Controllers\ModuleSummaryController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    // Monteur
    Route::middleware(['role:monteur'])->group(function () {
        Route::get('/monteur-samenstelling', [VehicleAssemblyController::class, 'index'])->name('monteur-vehicle-assembly');
        Route::post('/assemble/vehicle', [VehicleAssemblyController::class, 'assembleVehicle'])->name('assemble.vehicle');


        Route::middleware(['auth', 'role:monteur'])->get('/monteur-afgeronde-samenstelling', [VehicleAssemblyController::class, 'completedAssembly'])->name('monteur-completed-assembly');
    });

    // Planner
    Route::middleware(['role:planner'])->group(function () {
        Route::get('/planner-dashboard', [HomeController::class, 'plannerDashboard'])->name('planner.dashboard');
        // Productionplanning
        Route::get('/planner-productieplanning', [ProductionPlanningController::class, 'productiePlanning'])->name('planner.productiePlanning');
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
        Route::get('/inkoper/modules/{module}/edit', [ModuleSummaryController::class, 'edit'])->name('inkoper.module-edit');
        Route::put('/inkoper/modules/{module}', [ModuleSummaryController::class, 'update'])->name('inkoper.module-update');
        Route::get('/inkoper/modules/create', [ModuleSummaryController::class, 'create'])->name('inkoper.module-create');
        Route::post('/inkoper/modules', [ModuleSummaryController::class, 'store'])->name('inkoper.module-store');
        Route::delete('inkoper/modules/{id}/softDelete', [ModuleSummaryController::class, 'softDelete'])->name('modules.softDelete');
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




require __DIR__ . '/auth.php';
