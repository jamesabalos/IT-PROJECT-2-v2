<?php

namespace App\Http\Middleware;
use App\Physical_count;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard) {
            case 'adminGuard': //for admin
                if(Auth::guard($guard)->check()){
                    return redirect()->route('admin.dashboard');
                }
                break;
            
            default: //for sales assistant
                if (Auth::guard($guard)->check()) {
                    // return redirect('/home');
                    $physicalCount = Physical_count::all();
                    if($physicalCount[0]["status"] === "inactive"){
                        return redirect('/salesAssistant/sales');
                    }else{
                        return redirect('/salesAssistant/physicalCount');
                    }
                }
             
                break;
        }

        return $next($request);
    }
}
