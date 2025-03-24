<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use SoftDeletes;
    use HasFactory;

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
    public function plannings()
    {
        return $this->hasMany(Planning::class);
    }
}
