<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Image;
use App\User;
use App\Role;
use App\Country;
use App\ReferralUser;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\KodeInfo\JOrgChart;

class ReportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function customer(Request $request)
    {
		$users = User::where('admin','!=','1')
				->where(function($q) {
				 $q->where('id','!=',Auth::user()->id);
			 })
		         ->orderBy('id', 'desc')
		         ->with('role','country')->get()->toArray();
		if($request->isMethod('post')){
			
    	   $data = $request->all();
		   
			
		}			
        
        return view('admin.reports.customer')->with(compact('users'));
    }
	
	 
	
}
