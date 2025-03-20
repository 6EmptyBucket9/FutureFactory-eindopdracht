<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VehicleAssemblyController;
use App\Http\Controllers\PlanningController;
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
        Route::get('/planner-calender', [PlanningController::class, 'index'])->name('planner.calender');
        Route::post('/planner/assign', [PlanningController::class, 'assignVehicle'])->name('planner.assignVehicle');
    });

    // Klant 
    // Route::middleware(['role:klant'])->group(function () {
    //     Route::get('/klant-dashboard', [HomeController::class, 'klantDashboard'])->name('klant-dashboard');
    // });

    // // Inkoper
    // Route::middleware(['role:inkoper'])->group(function () {
    //     Route::get('/inkoper-dashboard', [HomeController::class, 'inkoperDashboard'])->name('inkoper-dashboard');
    // });
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
