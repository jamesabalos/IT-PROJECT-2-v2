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
		if($stat == "Accepted"){
			$stockquan = DB::table('stock_adjustments')->where('stock_adjustments_id',$id)->first();
			if($stockquan->type =="damaged"){
				$data = DB::table('damaged_items')->where('product_id',$stockquan->product_id)->count();
				if($data == '0'){
					$insertdam = DB::table('damaged_items')->insert(['product_id'=>$stockquan->product_id,'quantity'=>$stockquan->quantity,'created_at'=>$stockquan->created_at]);

				}else{
					$update = DB::table('damaged_items')->where('product_id',$stockquan->product_id)->increment('quantity',$stockquan->quantity);
				}

			}elseif ($stockquan->type =="damaged_salable"){
				$data = DB::table('damaged_salable_items')->where('product_id',$stockquan->product_id)->count();
				if($data == '0'){
					$insertdamsal = DB::table('damaged_salable_items')->insert(['product_id'=>$stockquan->product_id,'quantity'=>$stockquan->quantity,'created_at'=>$stockquan->created_at]);

				}else{
					$update = DB::table('damaged_salable_items')->where('product_id',$stockquan->product_id)->increment('quantity',$stockquan->quantity);
				}
			}elseif ($stockquan->type =="lost"){
				$data = DB::table('lost_items')->where('product_id',$stockquan->product_id)->count();
				if($data == '0'){
					$insertlost = DB::table('lost_items')->insert(['product_id'=>$stockquan->product_id,'quantity'=>$stockquan->quantity,'created_at'=>$stockquan->created_at]);

				}else{
					$update = DB::table('lost_items')->where('product_id',$stockquan->product_id)->increment('quantity',$stockquan->quantity);
				}
			}
		}
			
			
			return $back();

	}

}
