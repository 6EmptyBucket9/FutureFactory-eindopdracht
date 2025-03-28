<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChassisModule extends Model
{
    use SoftDeletes; 
    protected $table = 'chassis_module';
    protected $fillable = [
        'wheels_count',
        'vehicle_type_id', 
        'length',
        'width',
        'height',
        'cost',
        'name',
        'image',
    ];
    public function wheelModules()
    {
        return $this->belongsToMany(WheelModule::class, 'chassis_wheel');
    }
    public function planning()
    {
        return $this->hasOne(Planning::class, 'chassis_module_id');
    }

}
