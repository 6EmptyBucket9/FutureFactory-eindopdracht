<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Vehicle;

class Module extends Model
{
    protected $fillable = [
        'name',
        'module_type',
        'amount_of_wheels',
        'vehicle_id',
        'dimensions',
        'drivetrain_type',
        'power',
        'tire_type',
        'tire_diameter', 
        'number_of_tires',
        'special_modifications',
        'steering_shape',
        'number_of_seats',
        'upholstery',
        'assembly_time',
        'costs',
        'image',
        'compatible_chassis', 
    ];
    

    // Relationship
    public function vechile(){
        return $this->belongsTo(Vehicle::class);
    }
}
