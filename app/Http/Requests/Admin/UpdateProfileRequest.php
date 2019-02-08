<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
       $user = \App\User::where('id', $this->id)->first();
	   $username = \App\User::where('username', $this->username)->first();
        
                return [
				'username' => 'unique:users,username,' . $user->id,
                'firstname' => 'required|min:2|max:50',
				'lastname' => 'required|min:2|max:50',
                ];
      
    }
}
