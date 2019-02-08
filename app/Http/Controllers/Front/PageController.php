<?php

namespace App\Http\Controllers\Front;

use Auth;
use App\Category;
use App\Product;
use App\Smartbuck;

use Illuminate\Support\Facades\DB; //temp

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{

    public function index()
    {
    	return view('front.index');
    }

    public function video()
    {
    	$videos = array(
    		['name' => 'Pro+ Software Update Walk Through', 'url' => 'https://www.youtube.com/embed/z9gvPdePSgY?rel=0'],
            ['name' => 'Smart Sensor Overview', 'url' => 'https://www.youtube.com/embed/4dLg_HjegC8']
    	);

    	$videos = collect($videos);
    	//dd($videos);

    	return view('front.video', [
    		'videos' => $videos
    	]);
    }

    public function contact()
    {
    	return view('front.contact');
    }

    public function sandbox()
    {
        //Just get the years
        $years = \App\Configurator::distinct_years();
        foreach($years as $year){
            echo '<p>' . $year->year . '</p>';
        }
        //dd($years);

        //Then mock that you selected a year (year_id)
        $makes = \App\Configurator::distinct_makes(19);
        foreach($makes as $make){
            echo '<p>' . $make->name . '</p>';
        }
        //dd($makes);

        //Finally mock that you selected a make (make_id) with a year
        $models = \App\Configurator::distinct_models(19, 2); //year, make
        foreach($models as $model){
            echo '<p>' . $model->name . ' ' . $model->sub_name . '</p>';
        }
        //dd($models);
    }
}
