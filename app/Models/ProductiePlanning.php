<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductiePlanning extends Model
{
    protected $fillable = [
        'vehicle_id'
    ];

    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }
}
