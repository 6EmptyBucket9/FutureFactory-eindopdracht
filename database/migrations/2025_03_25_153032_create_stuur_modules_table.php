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
        Schema::create('steering_module', function (Blueprint $table) {
            $table->id();
            $table->string('special_adjustments')->nullable();
            $table->string('shape'); 
            $table->integer('assembly_time');
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
        Schema::dropIfExists('steering_module');
    }
};
