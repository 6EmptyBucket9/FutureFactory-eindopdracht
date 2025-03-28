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
        Schema::table('productie_planning', function (Blueprint $table) {
            $table->unsignedBigInteger('robot_id')->nullable()->after('vehicle_id'); // Add robot_id as a foreign key
            $table->foreign('robot_id')->references('id')->on('robots')->onDelete('set null'); // Set foreign key constraint
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('productie_planning', function (Blueprint $table) {
            $table->dropForeign(['robot_id']); // Drop the foreign key constraint
            $table->dropColumn('robot_id'); // Drop the robot_id column
        });
    }
};
