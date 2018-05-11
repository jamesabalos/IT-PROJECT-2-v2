<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;


use Illuminate\Support\MessageBag;

class AdminLoginController extends Controller
{
    public function __construct(){
        //$this->middleware('guest'); it will not let U access the adminLoginForm WHILE logged in as a User
        $this->middleware('guest:adminGuard', ['except' => ['logout']]); // it will allow us to access the showLoginForm, even where logged in as a user, BECAUSE  we are still a guest in the adminGuard guard
    /*     AUTH middleware:
            -if there is a page protected by auth middleware, we will make sure to redirect them
            to the correct login page if the're not logged in
            -for the pages protected by authentication, it will redirect you to the correct
            loginForm for that guard

            GUEST middlewaren
            -guest middleware:only wants people that are not login!, so if you're logged in, you don't
            have the right to see this page! and it will redirect you to the home page for that authentication
            -if the page is protected by a guest, and you're logged in from the guard that is protecting
             agaisnt, then it will send you to the correct page for that guard.
    */
    }

    public function showLoginForm(){
        return view("adminViews.admin-login");
    }
    
    public function login(Request $request){
       //Validate the form data
        $this->validate($request,[
            'email' => 'required|email',
            // 'password' => 'required|min:6'
            'password' => 'required'
        ]);

        //Attempt to log the user in
        $credentials = ['email'=>$request->email,'password'=>$request->password];
       if (Auth::guard('adminGuard')->attempt($credentials,$request->remember)) { //returns true or fals
            //if successful, then redirect to their intended location
           return redirect()->intended(route('admin.dashboard')); //send them to the dashboard or their intended location
       }
    //    else{
    //     return response()->json(['response' => 'failed', 'message' => 'Sorry, you need to be logged in!']);
    //    }
    $errors = new MessageBag; // initiate MessageBag
    $errors = new MessageBag(['email' => ['Email and/or password invalid.']]);
    //    if unssuccesful, then redirect to the login with the form data
       //redirect them back to the form data
       //back(): send them the page they were at before which is login page
       return redirect()->back()->withErrors($errors)->withInput($request->only('email','remember'));
       
    }

    public function logout()
    {
        Auth::guard('adminGuard')->logout();    
        return redirect('/');
    }



}
