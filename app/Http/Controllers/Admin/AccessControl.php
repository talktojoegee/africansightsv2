<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Permission;
use Illuminate\Http\Request;

class AccessControl extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->module = new Module();
        $this->permission = new Permission();
    }

    public function showModules(){
        return view('super-admin.access-control.manage-modules',[
            'modules'=>$this->module->getModules()
        ]);
    }

    public function storeModule(Request $request){
        $this->validate($request,[
            'moduleName'=>'required|unique:modules,module_name'
        ],[
            "moduleName.required"=>"Enter module name",
            "moduleName.unique"=>"There's an existing module by that name"
        ]);
        $this->module->createModule($request);
        session()->flash("success", "You've successfully added a new module to the system.");
        return back();
    }

    public function editModule(Request $request){
        $this->validate($request,[
            'moduleName'=>'required|unique:modules,module_name',
            'moduleId'=>'required'
        ],[
            "moduleName.required"=>"Enter module name",
            "moduleName.unique"=>"There's an existing module by that name"
        ]);
        $this->module->editModule($request);
        session()->flash("success", "Your changes were saved.");
        return back();
    }
    public function showPermissions(){
        return view('super-admin.access-control.manage-permissions',[
            'permissions'=>$this->permission->getPermissions(),
            'modules'=>$this->module->getModules()
        ]);
    }

    public function storePermission(Request $request){
        $this->validate($request,[
            'name'=>'required|unique:permissions,name',
            'guard'=>'required',
            'module'=>'required'
        ],[
            "name.required"=>"Enter permission name",
            "name.unique"=>"There's an existing permission by that name",
            "module.required"=>"Select associative module for this permission",
            "guard.required"=>"Select associative guard for this permission",
        ]);
        $this->permission->createPermission($request);
        session()->flash("success", "You've successfully added a new permission to the system.");
        return back();
    }

    public function editPermission(Request $request){
        $this->validate($request,[
            'name'=>'required|unique:permissions,name',
            'guard'=>'required',
            'module'=>'required',
            'permissionId'=>'required'
        ],[
            "name.required"=>"Enter permission name",
            "name.unique"=>"There's an existing permission by that name",
            "module.required"=>"Select associative module for this permission",
            "guard.required"=>"Select associative guard for this permission",
        ]);
        $this->permission->editPermission($request);
        session()->flash("success", "Your changes were saved.");
        return back();
    }
}
