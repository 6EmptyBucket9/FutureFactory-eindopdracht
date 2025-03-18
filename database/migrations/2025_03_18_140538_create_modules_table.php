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
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('module_type', ['chassis', 'drivetrain', 'wheels', 'steering', 'seats']);
            $table->integer('amount_of_wheels')->nullable(); // Number of wheels (only for chassis)
            $table->foreignIdFor(App\Models\Vehicle::class); // Foreign key to vehicle
            $table->string('dimensions')->nullable(); // Dimensions of chassis in cm
            $table->string('drivetrain_type')->nullable(); // Drivetrain type (hydrogen/electricity)
            $table->integer('horsepower')->nullable(); // Power in horsepower
            $table->string('tire_type')->nullable(); // Tire type (winter, summer, all-season)
            $table->integer('tire_diameter')->nullable(); // Tire diameter
            $table->integer('number_of_tires')->nullable(); // Number of tires
            $table->string('special_modifications')->nullable(); // Special modifications for steering
            $table->string('steering_shape')->nullable(); // Steering shape
            $table->integer('number_of_seats')->nullable(); // Number of seats
            $table->string('upholstery')->nullable(); // Upholstery for seats/saddle
            $table->integer('assembly_time')->nullable(); // Assembly time required (in 2-hour blocks)
            $table->decimal('costs', 10, 2)->nullable(); // Cost per module
            $table->string('image')->nullable(); // Image of the module
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
