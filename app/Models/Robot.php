<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Robot extends Model
{
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
    
}
