<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\ChassisModule;
use App\Models\DrivetrainModule;
use App\Models\SeatModule;
use App\Models\SteeringModule;
use App\Models\WheelModule;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'vehicle_type_id',
        'status_id',
        'completion_date',
        'user_id',
        'expected_completion_date',
        'chassis_module_id',
        'drivetrain_module_id',
        'wheel_module_id',
        'steering_module_id',
        'seat_module_id',
        'chassis_installed',
        'drivetrain_installed',
        'wheels_installed',
        'steering_installed',
        'seats_installed',
    ];

    public function isComplete()
    {
        return $this->chassis_installed &&
               $this->drivetrain_installed &&
               $this->wheels_installed &&
               $this->steering_installed &&
               $this->seats_installed;
    }
    
    // Relationships
    public function planning()
    {
        return $this->hasMany(Planning::class);
    }
    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class);
    }
    public function vehicleStatus()
    {
        return $this->belongsTo(VehicleStatus::class, 'status_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function robot()
    {
        return $this->belongsTo(Robot::class);
    }
    public function chassisModule()
    {
        return $this->belongsTo(ChassisModule::class, 'chassis_module_id');
    }

    public function drivetrainModule()
    {
        return $this->belongsTo(DrivetrainModule::class, 'drivetrain_module_id');
    }

    public function steeringModule()
    {
        return $this->belongsTo(SteeringModule::class, 'steering_module_id');
    }

    public function seatModule()
    {
        return $this->belongsTo(SeatModule::class, 'seat_module_id');
    }

    public function wheelModule()
    {
        return $this->belongsTo(WheelModule::class, 'wheel_module_id');
    }
}
