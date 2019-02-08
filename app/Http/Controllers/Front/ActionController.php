<?php

namespace App\Http\Controllers\Front;

use App\Events\ContactMail;
use App\Http\Requests\Front\ContactFormRequest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActionController extends Controller
{
    public function contact(ContactFormRequest $request)
    {
        event(new ContactMail($request));

        return redirect()->route('front.contact')->with('success', 'Thank you for sending us a contact response. Have a nice day!');
    }

    public function finder_distinct(Request $request)
    {
    	$json['result'] = false;
    	$json['type'] = 'year';

    	if($request->make && $request->year){
    		$json['result'] = true;
    		$json['type'] = 'model';
    		$json['data'] = \App\Configurator::distinct_models($request->year, $request->make);
    	} else if($request->year){
    		$json['result'] = true;
    		$json['type'] = 'make';
    		$json['data'] = \App\Configurator::distinct_makes($request->year);
    	}

    	return $json;
    }
}