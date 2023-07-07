<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Module extends Model
{
    use HasFactory;


    public function getPermissions(){
        return $this->hasMany(Permission::class, 'module_id');
    }
    public function createModule(Request $request){
        $module = new Module();
        $module->module_name = $request->moduleName;
        $module->save();
        return $module;
    }

    public function editModule(Request $request){
        $module =  Module::find($request->moduleId);
        $module->module_name = $request->moduleName;
        $module->save();
        return $module;
    }

    public function getModules(){
        return Module::orderBy('module_name', 'ASC')->get();
    }
    public function getModulesByArea($area){
        return Module::where('area', $area)->orderBy('module_name', 'ASC')->get();
    }
}
