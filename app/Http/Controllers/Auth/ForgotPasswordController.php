<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Mail\ResetPassword;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function __construct(){
        $this->user = new User();
        $this->reset = new PasswordReset();
    }

    public function customResetPassword(Request $request)
    {
        $this->validate($request,[
            'username'=>'required'
        ],[
            "username.required"=>"Enter your registered username"
        ]);
        $user = $this->user->getUserByUsername(strip_tags($request->username));
        if(!empty($user)){
            try {
                if(!empty($user)){
                    $token = $this->reset->setNewPasswordResetRequest($request);
                    #Send mail
                    try{
                        \Mail::to($user)->send(new ResetPassword($token,$user) );
                        session()->flash("success", "You're one step away. Click the link we sent to your email. We'll help you get back your account.");
                        return back();
                    }catch (\Exception $ex){
                        session()->flash("error", "We had trouble sending you a reset link. Try again later.");
                        return back();
                    }
                }else{
                    session()->flash("error", "We could not find any account associated with this email (<i>".$request->username."</i>).");
                    return back();
                }
            }catch (\Exception $exception){
                session()->flash("error", "Something went wrong. Try again later.");
                return back();
            }
        }else{
            session()->flash("error", "Whoops! There's no existing account with this username(".$request->username.")");
            return back();
        }
    }
}
