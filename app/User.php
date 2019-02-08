<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

	/**
     * Get the phone record associated with the user.
     */
    public function role()
    {
		 return $this->belongsTo(Role::class);
		 //return $this->belongsTo('Role', 'role_id');
        //return $this->hasOne('App\Role','role_id');
		//return $this->hasOne('Role');
    }
	/**
     * Get the phone record associated with the user.
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
	
	/*public function ReferralUser()
    {
		 return $this->belongsTo('App\ReferralUser','reff_user_id');
    }*/
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname','lastname','gender','referral_name', 'email', 'password','username','admin','status','role_id','user_type','is_permission','profile_image','address','city','phone','zip','country_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

}
