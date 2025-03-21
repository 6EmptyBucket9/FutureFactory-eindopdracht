<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->date('expected_completion_date')->nullable(); // Add nullable date column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn('expected_completion_date'); // Remove column if migration is rolled back
        });
    }
};
