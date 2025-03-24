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
        Schema::table('modules', function (Blueprint $table) {
            $table->foreignIdFor(App\Models\Vehicle::class)
                  ->nullable()
                  ->change(); // Make the foreign key column nullable
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('modules', function (Blueprint $table) {
            $table->foreignIdFor(App\Models\Vehicle::class)
                  ->nullable(false)
                  ->change(); // Revert the nullable change
        });
    }
};
