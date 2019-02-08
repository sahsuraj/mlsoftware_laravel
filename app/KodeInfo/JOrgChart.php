<?php

namespace App\KodeInfo;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class JOrgChart
{

    public $chain = [];
    public $tree_string = "";

    public function getChart($reff_user_id)
    {

        $users = DB::table('referral_users')->where('reff_user_id', $reff_user_id)->where('user_id', '>', 0)->pluck('user_id')->all();

        $this->chain[$reff_user_id] = $users;

        //[1]=>[2 ,3]
        $this->recursiveTree($users, $this->chain[$reff_user_id]);

        return ['tree_array' => $this->chain, 'tree_string' => $this->tree_string];
    }

    public function recursiveTree($reff_user_ids, &$arr)
    {

        $this->tree_string .= "<ul>";

        // [1]=>[2,3] $arr is at [1]
        for ($i = 0; $i < sizeof($reff_user_ids); $i++) {

            //index 2
            $referrals = DB::table('referral_users')->where('reff_user_id', $reff_user_ids[$i])->where('user_id', '>', 0)->pluck('user_id')->all();

            //index 2 users 4,5
            //by reference on 2 nd array
            $find_user = DB::table('users')->where('id', $arr[$i])->first();
			
			//echo "<pre>";print_r($find_user);
			if(empty($find_user->profile_image)){
				$find_user->profile_image='avatar.png';
			}
            $this->tree_string .= "<li title='User Name : $find_user->firstname, Sponser Email : $find_user->referral_name'><label><div class='image_jorg'><img  src='../../../images/backend_images/member/micro/$find_user->profile_image'><h1>$find_user->firstname</h1></div></label>";

            unset($arr[$i]);

            $arr[$reff_user_ids[$i]] = $referrals;

            if (sizeof($referrals) > 0) {
                //[2]=>[4,5] reference [2]=>
                $this->recursiveTree($referrals, $arr[$reff_user_ids[$i]]);
            }

            $this->tree_string .= "</li>";

        }

        $this->tree_string .= "</ul>";
    }
} 