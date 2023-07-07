<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm(){
        if(Auth::check()){
            return redirect()->route('super-admin-dashboard');
        }else{
            return view('auth.admin.login');
        }
    }
    /**
     * Handle an incoming admin authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function login(Request $request)
    {
        //return dd('hello');
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ],[
            "email.required"=>"Enter your registered email address",
            "email.email"=>"Enter a valid email address",
            "password.required"=>"Enter your password"
        ]);


        if(auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            $user = auth()->user();

            return redirect()->route('super-admin-dashboard');
        } else {
            return redirect()->back()->withError('Credentials doesn\'t match.');
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
