<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DrivetrainModule;
use App\Models\WheelModule;
use App\Models\ChassisModule;
use App\Models\SteeringModule;
use App\Models\SeatModule;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Planning extends Model
{
    use HasFactory;
    
    protected $table = 'planning'; 
    protected $fillable = [
        'date',
        'timeslot',
        'vehicle_id',
        'module_id',
        'is_completed',
        'wheel_module_id',
        'chassis_module_id',
        'drivetrain_module_id',
        'steering_module_id',
        'seat_module_id',

    ];

    public function wheelModule()
    {
        return $this->belongsTo(WheelModule::class, 'wheel_module_id');
    }

    public function chassisModule()
    {
        return $this->belongsTo(ChassisModule::class, 'chassis_module_id');
    }
    public function driveModule()
    {
        return $this->belongsTo(DrivetrainModule::class, 'drivetrain_module_id');
    }

    public function steeringModule()
    {
        return $this->belongsTo(SteeringModule::class, 'steering_module_id');
    }
    public function seatsModule()
    {
        return $this->belongsTo(SeatModule::class, 'seat_module_id');
    }
}

