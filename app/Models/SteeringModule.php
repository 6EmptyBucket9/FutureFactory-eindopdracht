<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SteeringModule extends Model
{
    use SoftDeletes;
    
    protected $table = 'steering_module';
    protected $fillable = [
        'special_adjustments',
        'shape',
        'assembly_time',
        'cost',
        'name',
        'image',
    ];

    public function planning()
    {
        return $this->hasOne(Planning::class, 'steering_module_id');
    }


}
