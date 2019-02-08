<?php

namespace App\GlobalSetting;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class Setting
{

  public function getData()
    {

        $setting = DB::table('settings')->where('id', '1')->get();
        return $setting;
       
    }

   
} 