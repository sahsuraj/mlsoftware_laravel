<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReferralUser extends Model
{
   
	 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','user_id', 'reff_user_id',
    ];
	
	}
