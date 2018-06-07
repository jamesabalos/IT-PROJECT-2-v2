<?php

namespace App\Http\Controllers;

use App\User;
use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use DB;
class NotificationController extends Controller
{
    public function MarkAsRead($id){
    	if(Auth::guard('adminGuard')->check()){
    		$user = Auth::guard('adminGuard')->user();
    		$user->unreadNotifications->where('id','=',$id)->markAsRead();
		
    	}
    	if(Auth::guard('web')->check()){
    		$user = Auth::user();
    		$user->unreadNotifications->where('id','=',$id)->markAsRead();
		
    	}
		
		return back();      
     
	}
	public function stockStatus($id,$stat){		
		$update = DB::table('stock_adjustments')->where('stock_adjustments_id',$id)->update(['status'=>$stat]);
		return back();
	}
}
