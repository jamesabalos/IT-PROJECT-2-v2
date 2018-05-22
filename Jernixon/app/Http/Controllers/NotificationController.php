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
		$user = Auth::guard('adminGuard')->user();
		$user->unreadNotifications->where('id','=',$id)->markAsRead();
		return back();      
     
    }
}
