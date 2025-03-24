<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'vehicle_type_id', 'completion_date', 'user_id', 'expected_completion_date'];
    // Relationship
    public function modules()
    {
        return $this->hasMany(Module::class);
    }
    public function planning()
    {
        return $this->hasMany(Planning::class);
    }
    public function isComplete()
    {

        if ($this->planning->isEmpty()) {
            return false;
        }
        return $this->planning->every(function ($planning) {
            return $planning->is_completed;
        });
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function robot()
    {
        return $this->belongsTo(Robot::class);
    }
}
