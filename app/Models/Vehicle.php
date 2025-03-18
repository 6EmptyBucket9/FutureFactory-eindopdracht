<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = ['type'];
    // Relationship
    public function modules()
    {

        return $this->hasMany(Module::class);
    }
}
