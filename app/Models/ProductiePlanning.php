<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductiePlanning extends Model
{
    protected $table = 'productie_planning';
    protected $fillable = [
        'vehicle_id',
        'robot_id'
    ];

    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }
    public function robot()
    {
        return $this->belongsTo(Robot::class);
    }
}
