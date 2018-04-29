<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Admin;
use App\Http\Controllers\Controller;
// use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

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

    // use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showForgotPasswordForm(){
        return view("adminViews.admin-forgotPassword");        
    }
    public function forgotPassword(Request $request){

        $this->validate($request,[
            'email' => 'required',
            'username' => 'required'
        ]);
        //query
        return $request->all();
        
    }

}
