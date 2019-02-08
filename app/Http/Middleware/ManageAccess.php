<?php

namespace App\Http\Middleware;

use Auth;

use Closure;

class ManageAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()){
            //Get the logged user
            $user = Auth::user();
            //dd($user->hasRole('admin'));
              //echo "<pre>";print_r($user->admin);die;
            if(!empty($user) && $user->admin=='1' || $user->admin=='2'){
                //return redirect()->action('AdminController@dashboard')->with('flash_message_error','Please login to access');
            }else{
				return redirect()->action('AdminController@login')->with('flash_message_error','Please login to access');
			}
            
        } else {
            //dd('You are not even logged');
           return redirect()->action('AdminController@login')->with('flash_message_error','Please login');
        }

        return $next($request);
    }
}
