<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WheelModule extends Model
{
    use HasFactory;
    
    use SoftDeletes;
    
    protected $table = 'wheel_module';
    protected $fillable = [
        'tire_type',
        'diameter',
        'quantity',
        'compatible_chassis',
        'assembly_time',
        'cost',
        'name',
        'image',
    ];
    public function chassisModules()
    {
        return $this->belongsToMany(ChassisModule::class, 'chassis_wheel');
    }
    public function planning()
    {
        return $this->hasOne(Planning::class, 'wheel_module_id');
    }

}
