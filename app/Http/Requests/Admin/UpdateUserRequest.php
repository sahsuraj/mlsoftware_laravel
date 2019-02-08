<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
                return [
                'email' => 'required|email|unique:users,email,'.$user->id,
				'username' => 'unique:users,username,' . $user->id,
				'firstname' => 'required|min:2|max:50',
				'lastname' => 'required|min:2|max:50',
				'gender' => 'required|min:2|max:50',
				'role_id' => 'required',
				'address' => 'required|min:2|max:500',
				'city' => 'required|min:2|max:50',
				'phone' => 'required|min:2|max:20',
				'zip' => 'required|min:2|max:10',
				'country_id' => 'required|min:2|max:10',
                ];
      
    }
}
