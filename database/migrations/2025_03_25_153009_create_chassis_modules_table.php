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
        Schema::create('chassis_module', function (Blueprint $table) {
            $table->id();
            $table->integer('wheels_count'); 
            $table->foreignIdFor(App\Models\VehicleType::class);
            $table->integer('length'); 
            $table->integer('width'); 
            $table->integer('height');
            $table->decimal('cost', 8, 2); 
            $table->string('name')->unique(); 
            $table->string('image')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chassis_module');
    }
};
