<?php



namespace App\Http\Controllers\Front;



use Auth;
use Validator;

use App\User;
use App\Role;

use App\Http\Requests\LoginRequest;

use App\Http\Requests\Front\UserRequest;



use Illuminate\Http\Request;

use App\Http\Controllers\Controller;



class AccountController extends Controller

{

    public function login()

    { echo 's';die;

    	return view('front.login');

    }



    public function create()

    {

        $regions = \App\GeoRegion::all();

        $countries = \App\GeoCountry::find([39, 232]);

    	return view('front.register', [

            'regions' => $regions,

            'countries' => $countries

        ]);

    }



    public function logging(LoginRequest $request)

    {

    	dd($request);die;



    	if(Auth::attempt(['email' => $request->email, 'password' => $request->password ])){

    		$user = Auth::user();



    		//Then decide which to redirect the user by role

    		if($user->isRole('user')){

    			return redirect()->route('account.index');

    		} else if($user->isRole('admin')){

    			return redirect()->route('manage.index');

    		}



    		//Might do something if no role?

    		return redirect()->route('front.login')->with('warning', 'We had trouble with your account, please contact support (877-659-8767).');

    	} else {

    		return redirect()->route('front.login')->withErrors('Email and password did not match.');

    	}

    }



    public function store(UserRequest $request)

    {

        if($request->has('coupon')){
            $coupon = Coupon::where('coupon_code', $request->coupon)->first();

            if( empty($coupon) ){
                return back()->withErrors('Coupon code is invalid');
            }
        }


    	$user = User::create([

    		'email' => $request->email,

    		'password' => bcrypt($request->password),

    		'first_name' => $request->first_name,

    		'last_name' => $request->last_name,

    		'company' => $request->company,

    		'street' => $request->street,

            'suite' => $request->suite,

            'city' => $request->city,

            'region_id' => $request->region_id,

            'country_id' => $request->country_id,

            'postal' => $request->postal,

            'phone' => $request->phone,

            'supplier' =>$request->supplier

    	]);



    	if($user){

            $user->roles()->attach(2); //Make account with user role



            if($request->serial){

                $device = \App\Device::create([

                    'user_id' => $user->id,

                    'serial_number' => $request->serial

                ]);

            }

            if($request->coupon){
                $coupon->redeems()->create(['coupon_id' => $coupon->id, 'customer_id' => $user->id, 'date' => date('Y-m-d')]);
            }

            //Attempt to log the user

            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){

                if(empty($coupon)){
                    return redirect()->route('account.index');
                }
                    return redirect()->route('account.index')->with('success', $coupon->customer_message);

            } else {

                return back()->with('warning', 'We were unable to log you in after registration. Please try using the login form.');

            }

    		//return redirect()->route('account.index');

        } else {

            return back()->withErrors('User failed to be created');

        }



        return back()->with('success', 'Great job, now make the stupid account pages you twat! :)'); 

    }



    public function update(UserRequest $request, User $user)

    {

        if($request->password_old){

            if($user->password != bcrypt($request->password_old)){

                return back()->withErrors('You did not match your old password');

            } else {

                $user->password = bcrypt($request->password);

            }   

        }

        

        $user->first_name = $request->first_name;

        $user->last_name = $request->last_name;

        $user->company = $request->company;

        $user->street = $request->street;

        $user->suite = $request->suite;

        $user->city = $request->city;

        $user->region_id = $request->region_id;

        $user->country_id = $request->country_id;

        $user->postal = $request->postal;

        $user->phone = $request->phone;

        $user->supplier = $request->supplier;



        if($user->save()){

            return redirect()->route('account.edit')->with('success', 'Your account successfully updated');

        } else {

            return back()->withErrors('Your account failed to be updated');

        }

    }



    public function logout()

    {

    	Auth::logout();

    	return back();

    }



    public function forgot()

    {

        return view('front.forgot');

    }



    public function reset(Request $request, $token = null)

    {

        //dd($request, $token);



        return view('front.reset')->with(

            ['token' => $token, 'email' => $request->email]

        );

    }

}

