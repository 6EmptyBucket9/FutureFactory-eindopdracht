<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DrivetrainModule extends Model
{
    use HasFactory;
    
    use SoftDeletes;
    
    protected $table = 'drivetrain_module';
    protected $fillable = [
        'type',
        'power',
        'assembly_time',
        'cost',
        'name',
        'image',
    ];

    public function planning()
    {
        return $this->hasOne(Planning::class, 'drivetrain_module_id');
    }

}
