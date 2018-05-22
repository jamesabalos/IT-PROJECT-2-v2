<?php

namespace App\Http\Controllers;

use App\User;
use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
class NotificationController extends Controller
{
    public function MarkAsRead($id){
    	if(Auth::guard('adminGuard')->check()){
    		$user = Auth::guard('adminGuard')->user();
    	}
    	elseif(Auth::guard('web')->check()){
    		$user = Auth::user();
    	}
		
		$user->unreadNotifications->where('id','=',$id)->markAsRead();
		return back();      
     
    }
}
