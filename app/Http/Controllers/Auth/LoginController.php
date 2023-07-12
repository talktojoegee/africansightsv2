<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Dump\Tenant;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->user = new User();
        //$this->tenant = new Tenant();
    }

    public function login(Request $request){
        $this->validate($request,[
            'username'=>'required',
            'password'=>'required'
        ],[
            'username.required'=>'Enter your registered username for this account',
            'password.required'=>'Enter your password for this account'
        ]);
        $user = $this->user->getUserByUsername($request->username);
        if(!empty($user)){
            if(Auth::attempt(['username'=>$request->username, 'password'=>$request->password], $request->remember)){
                if(Auth::user()->is_admin == 1){ //manager
                    //return 'Before redirecting...';
                    ActivityLog::logActivity(Auth::user()->tenant_id, Auth::user()->id, 1, 'User login', Auth::user()->first_name.' just logged in.');
                    return redirect()->route('admin-dashboard', ['account'=>$user->getTenant->website]);
                }else{
                    ActivityLog::logActivity(Auth::user()->tenant_id, Auth::user()->id, 1, 'User login', Auth::user()->first_name.' just logged in.');
                    return redirect()->route('residence-dashboard');
                }

            }else{
                session()->flash("error", " Wrong or invalid login credentials. Try again.");
                return back();
            }
        }else{
            session()->flash("error", "There's no existing account with this login details. Try again.");
            return back();
        }
    }

    public function showLoginForm()
    {
        //$subDomain = strtolower(str_replace('.'. env('APP_URL'), '', request()->getHost()));
        //$tenant = $this->tenant->getTenantByWebsite($subDomain);
            return view('auth.login');

    }

    public function showGeneralLoginForm()
    {
        return view('auth.general-login');
    }
}
