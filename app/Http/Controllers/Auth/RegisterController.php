<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ServicesController;
use App\Mail\WelcomeNewUserMail;
use App\Models\AdminNotification;
use App\Models\Dump\Plan;
use App\Models\Dump\Tenant;
use App\Models\Dump\TenantNotification;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
        $this->user = new User();
        $this->tenant = new Tenant();
        $this->adminnotification = new AdminNotification();
        $this->tenantnotification = new TenantNotification();
        $this->plan = new Plan();

        //Service
        $this->services = new ServicesController();
    }

    public function showRegistrationForm(Request $request){
        $plan = $this->plan->getFirstPlan();
        $selected = $this->plan->getPlanBySlug($request->plan);

        $urlId = null;
        if(!empty($selected)){
            $urlId = $selected->id;
        }else{
            $urlId = $plan->id;
        }

        return view('auth.register',[
            'planId'=>$urlId,
        ]);

    }

    public function register(Request $request)
    {
        $this->validate($request,[
            'firstName'=>'required',
            'phoneNumber'=>'required',
            'email'=>'required|email',
            'password'=>'required|confirmed',
            'terms'=>'required',
            'companyName'=>'required',
            'username'=>'required|unique:users,username',
           'g-recaptcha-response' => 'required|captcha',
        ],[
            'firstName.required'=>'Enter first name in the field provided.',
            'phoneNumber.required'=>'What is your phone number?',
            'email.required'=>'Enter email address',
            'email.email'=>'Enter a valid email address',
            'username.required'=>'Choose a unique username',
            'username.unique'=>"There's an account with this username. Try another one.",
            'password.required'=>'Enter your chosen password',
            'password.confirmed'=>'Password confirmation mis-matched. Try again.',
            'terms.required'=>'It is important you accept our terms & conditions to proceed',
            'companyName.required'=>'Enter your company name',
            'g-recaptcha-response.captcha'=>'Incorrect captcha',
            'g-recaptcha-response.required'=>"Our system thinks you're a robot. Why not proof it wrong?",
        ]);
            $mobile = $this->services->appendCountryCode($request->phoneNumber);
            $tenant = $this->tenant->setNewTenant($request);
            $user = $this->user->createUser($request,$tenant);
            $this->tenant->setWorkRequestAuthorizer($user->id, $tenant->id);
            #Notification
            $subject = "New registration";
            $subject2 = "Welcome to ".config('app.name');
            $body = $request->companyName." recently registered to ".config('app.name').". Kindly check it out.";
            $body2 = "Welcome to the ".config('app.name')." community! <br/> Take your time to explore the various features that ".config('app.name')." offers to make the best of your work. Feel free to contact us if you face any issue.";
            $this->adminnotification->setNewAdminNotification($subject, $body, 'view-tenant', $tenant->slug, 1, 0);
            $this->tenantnotification->setNewAdminNotification($subject2, $body2, 'view-profile', $tenant->slug, 1, $user->id);
            try{
                \Mail::to($user)->send(new WelcomeNewUserMail($user, $tenant) );
            }catch (\Exception $ex){
                session()->flash("error", "We had trouble sending you a mail. Though your account was created.");
                return back();
            }
        session()->flash("success", "Congratulations! Your account was created successfully. Proceed to login.");
        return redirect()->route('general-login');

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
