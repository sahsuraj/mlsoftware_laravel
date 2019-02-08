<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
   /* public function categories(){
    	return $this->hasMany('App\Category','parent_id');
    }*/
	 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'display_name',
    ];
	
	}
