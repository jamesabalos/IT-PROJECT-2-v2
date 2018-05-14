<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Admin;
use Hash;
use DB;
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

        // $employee = Admin::find($request->adminId);
        // $password = Hash::make($request->New_Password);
        // if($request->Email===$employee->email && $request->New_Password===$request->Confirm_Password && Hash::check($request->Current_Password, $employee->password)){
        //     $employee->password = $password;
        //     $employee->save();
        //     return "successful";
        // }else{
        //     return "unsuccessful";
        // }
        $employee = DB::table('admins')
        ->select('name', 'email')    
        ->where( [['name','=',$request->username],['email','=',$request->email]])
        ->get();

        if( count($employee) > 0 ){
            $firstName = explode(" ",$request->username);
            $defaultPassword = $firstName[0]."@jernixon";
            $employee = DB::table('admins')  
            ->where( [['name','=',$request->username],['email','=',$request->email]])
            ->update(['password' => Hash::make($defaultPassword)]);
            return $defaultPassword;
        }else{
            return response()->json([
                'errors' => ['Email or username does not exist.']
            ],422);
        }
        
       
      
        
    }

}
