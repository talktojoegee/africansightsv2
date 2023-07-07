<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Permission extends Model
{
    use HasFactory;

    public function createPermission(Request $request){
        $permission = new Permission();
        $permission->name = $request->name;
        $permission->guard_name = $request->guard;
        $permission->module_id = $request->module;
        $permission->save();
        return $permission;
    }
    public function editPermission(Request $request){
        $permission =  Permission::find($request->permissionId);
        $permission->name = $request->name;
        $permission->guard_name = $request->guard;
        $permission->module_id = $request->module;
        $permission->save();
        return $permission;
    }

    public function getPermissions(){
        return Permission::all();//orderBy('module_id', 'ASC')->get();
    }

    public function getModule(){
        return $this->belongsTo(Module::class, 'module_id');
    }
}
