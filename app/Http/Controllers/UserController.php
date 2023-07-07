<?php

namespace App\Http\Controllers;

use App\Mail\CreateNewUser;
use App\Models\Dump\LeaseLog;
use App\Models\Dump\Plan;
use App\Models\Dump\Tenant;
use App\Models\Module;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->user = new User();
        $this->leaselog = new LeaseLog();
        $this->tenant = new Tenant();
        $this->plan = new Plan();
        $this->module = new Module();
    }

    public function customerDashboard(){
        return 'Customer';
    }

    public function reGenerateApiToken(){
        $this->user->apiTokenGenerator();
        session()->flash("success", "New API token generated.");
        return back();
    }

    public function profile(Request $request){
        $user = $this->user->getUserByUuid($request->uuid);
        if(!empty($user)){
            return view('manager.user.profile',[
                'user'=>$user,
                'logs'=>$this->leaselog->getAllTenantLeaseLogsByTenantId($user->id, $user->tenant_id),
                'modules'=>$this->module->getModulesByArea(0)
            ]);
        }else{
            session()->flash("error", "No record found.");
            return back();
        }

    }

    public function addNewTeamMember(){
        $planId = Auth::user()->getTenant->plan_id;
        $tenantId = Auth::user()->tenant_id;
        return view('manager.user.add-new-team-member',[
            'managers'=>$this->user->getTenantUserByUserType(1, $tenantId),
            'planFeatures'=>$this->plan->getPlanFeaturesByPlanId( $planId),
            'plan'=>$this->plan->getPlanById($planId),
            'modules'=>$this->module->getModulesByArea(0)
        ]);
    }

    public function storeNewTeamMember(Request $request){
        $this->validate($request,[
            'firstName'=>'required',
            'surname'=>'required',
            'username'=>'required|unique:users,username',
            'phoneNumber'=>'required',
            'email'=>'required|email'
        ],[
            "firstName.required"=>"Enter first name in the field provided",
            "surname.required"=>"Enter surname in the field provided",
            "username.required"=>"Enter username in the field provided",
            "username.unique"=>"There's an existing account with this username",
            "phoneNumber.required"=>"Enter mobile number in the field provided",
            "email.email"=>"Enter a valid email address",
            "email.required"=>"Enter email address in the field provided",
        ]);
        $tenant = $this->tenant->getTenantById(Auth::user()->tenant_id);
        if(!empty($tenant)){
            $user = $this->user->createUser($request, $tenant);
            if(count($request->permission) > 0 ){
                $user->syncPermissions($request->permission);
            }
            try{
                \Mail::to($user)->send(new CreateNewUser($user, $request->password) );
                session()->flash("success", "You've successfully added a new team member. The login credentials were sent to (<i>".$request->email."</i>)");
                return back();
            }catch (\Exception $ex){
                session()->flash("error", "We had trouble sending you a welcome mail. Try again later.");
                return back();
            }
        }else{
            session()->flash("error", "Something went wrong. Try again.");
            return back();
        }

    }

    public function manageTeam(){
        return view('manager.user.manage-team',[
            'members'=>$this->user->getTenantUserByUserType(1, Auth::user()->tenant_id)
        ]);
    }
    public function changeProfilePhoto(Request $request){
        $this->validate($request,[
            'avatar'=>'required|image|mimes:jpg,jpeg,png'
        ],[
            "avatar.required"=>"Choose a profile picture to upload.",
            "avatar.image"=>"Upload an image",
            "avatar.mimes"=>"Invalid file format"
        ]);
        $this->user->updateAvatar($request);
        session()->flash("success", "Profile photo updated!");
        return back();
    }

    public function changePassword(Request $request){
        $this->validate($request,[
            'currentPassword'=>'required',
            'password'=>'required|confirmed',
        ],[
            "currentPassword.required"=>"Enter your current password",
            "password.required"=>"Choose a new password",
            "password.confirmed"=>"Chosen password does not match with re-type password"
        ]);
        $user = $this->user->getUserById(Auth::user()->id);
        if (Hash::check($request->currentPassword, $user->password)) {
            $user->password = bcrypt($request->password);
            $user->save();
            session()->flash("success", "Your password was changed successfully.");
            return back();
        }else{
            session()->flash("error", "Current password does not match our record. Try again.");
            return back();
        }
    }

    public function updateMyProfile(Request $request){
        $this->validate($request,[
            //'username'=>'required|unique:users,username',
            'firstName'=>'required',
            'lastName'=>'required',
            'mobileNo'=>'required',
            //'email'=>'required|email'
        ],[
            //"username.required"=>"Enter username",
            //"username.unique"=>"Username already taken. Try another one.",
            "lastName.required"=>"Enter your last name",
            "firstName.required"=>"Enter your first name",
            "mobileNo.required"=>"Enter your mobile number",
            //"email.required"=>"Enter your email address",
            //"email.email"=>"Enter a valid email address",
        ]);
        $this->user->editUser($request);
        session()->flash("success", "Your changes were saved.");
        return back();
    }

    public function manageTenants(){
        return view('manager.user.manage-tenants',[
            'tenants'=>$this->user->getTenantUserByUserType(2, Auth::user()->tenant_id)
        ]);
    }

    public function grantPermission(Request $request){
        $this->validate($request,[
            'permission'=>'required|array',
            'permission.*'=>'required',
            'user'=>'required'
        ]);
        $user = $this->user->getUserById($request->user);
        if(!empty($user)){
            $user->syncPermissions($request->permission);
            session()->flash("success", "You've successfully granted permission(s) to $user->first_name");
            return back();
        }else{
            session()->flash("error", "Whoops! Something went wrong. Please try again.");
            return back();
        }

    }

}
