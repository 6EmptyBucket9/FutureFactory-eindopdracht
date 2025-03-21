<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
    protected $fillable = [
        'date',
        'timeslot',
        'vehicle_id',
        'module_id',
        'is_completed'
    ];

    // Relations
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
