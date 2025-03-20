<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'vehicle_type_id'];
    // Relationship
    public function modules()
    {

        return $this->hasMany(Module::class);
    }
}
