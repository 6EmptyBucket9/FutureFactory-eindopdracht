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
        Schema::create('planning', function (Blueprint $table) {
            $table->id();
            $table->date('date'); // Date
            $table->string('timeslot'); // Timeslot for date
            $table->foreignId('vehicle_id')->nullable()->constrained()->onDelete('cascade'); // Foreign key for vehicle
            $table->foreignId('wheel_module_id')->nullable()->constrained('wheel_module')->onDelete('set null'); // Foreign key for wheel module
            $table->foreignId('chassis_module_id')->nullable()->constrained('chassis_module')->onDelete('set null'); // Foreign key for chassis module
            $table->foreignId('drivetrain_module_id')->nullable()->constrained('drivetrain_module')->onDelete('set null'); // Foreign key for drive module
            $table->foreignId('steering_module_id')->nullable()->constrained('steering_module')->onDelete('set null'); // Foreign key for steering module
            $table->foreignId('seat_module_id')->nullable()->constrained('seat_module')->onDelete('set null'); // Foreign key for seats module
            $table->boolean('is_completed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planning');
    }
};
