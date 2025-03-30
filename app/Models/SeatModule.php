<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SeatModule extends Model
{
    use HasFactory;
    
    use SoftDeletes;
    
    protected $table = 'seat_module';
    protected $fillable = [
        'quantity',
        'upholstery',
        'assembly_time',
        'cost',
        'name',
        'image',
    ];
    public function planning()
    {
        return $this->hasOne(Planning::class, 'seat_module_id');
    }

}
