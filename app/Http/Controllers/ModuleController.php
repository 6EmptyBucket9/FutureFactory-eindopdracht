<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Vehicle;
class ModuleController extends Controller
{
    public static function getAllModules()
    {
        return Module::all();
    }
    
    public static function getModulesByIds(array $ids)
    {
        return Module::whereIn('id', $ids)->get();
    }


}
