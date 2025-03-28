<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignIdFor(App\Models\VehicleType::class);
            $table->foreignIdFor(App\Models\User::class);
            $table->foreignId('status_id')->constrained('vehicle_status')->cascadeOnDelete();
            $table->foreignId('chassis_module_id')->nullable()->constrained('chassis_module')->cascadeOnDelete();
            $table->foreignId('drivetrain_module_id')->nullable()->constrained('drivetrain_module')->cascadeOnDelete();
            $table->foreignId('seat_module_id')->nullable()->constrained('seat_module')->cascadeOnDelete();
            $table->foreignId('steering_module_id')->nullable()->constrained('steering_module')->cascadeOnDelete();
            $table->foreignId('wheel_module_id')->nullable()->constrained('wheel_module')->cascadeOnDelete();
            
            $table->date('expected_completion_date')->nullable();
            $table->date('completion_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('vehicles');
    }
};
