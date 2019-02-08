<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        switch($this->method()){
            case 'POST':
                return [
                    'firstname' => 'required|min:2|max:50',
					'lastname' => 'required|min:2|max:50',
					'gender' => 'required|min:2|max:50',
					'referral_name'=>'required|email',
					'role_id' => 'required',           
					'email' => 'required|email|unique:users',
					'username' => 'required|string|max:20|unique:users',
					'password' => 'required|min:6',                
					'confirm_password' => 'required|min:6|max:20|same:password',
					'address' => 'required|min:2|max:500',
					'city' => 'required|min:2|max:50',
					'phone' => 'required|min:2|max:20',
					'zip' => 'required|min:2|max:10',
					'country_id' => 'required|min:2|max:10',
					];

                break;
            case 'PUT':
                $user = \App\User::where('email', $this->email)->first();
        
                return [
                    'email' => [
                        'required',
                        'email',
                        Rule::unique('users')->ignore($user->id)
                    ],
				'firstname' => 'required|min:2|max:50',
				'lastname' => 'required|min:2|max:50',
				'gender' => 'required|min:2|max:50',
				'referral_name'=>'required|email',
				'role_id' => 'required',      
				'username' => 'required|string|max:20|unique:users',
				'password' => 'required|min:6',                
				'confirm_password' => 'required|min:6|max:20|same:password',
				'address' => 'required|min:2|max:500',
				'city' => 'required|min:2|max:50',
				'phone' => 'required|min:2|max:20',
				'zip' => 'required|min:2|max:10',
				'country_id' => 'required|min:2|max:10',
                ];
                
                break;
        }
    }
	/**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
     { 
			return [
				'firstname.required' => 'First Name is required',
				'firstname.min' => 'First Name must be at least 2 characters.',
				'firstname.max' => 'First Name should not be greater than 50 characters.',
				'lastname.required' => 'Last Name is required',
				'username.required' => 'User Name is required',
				'email.required' => 'Email is required',
				'address' => 'required|min:2|max:500',
				'city' => 'required|min:2|max:50',
				'phone' => 'required|min:2|max:20',
				'zip' => 'required|min:2|max:10',
				'country_id' => 'required|min:2|max:10',
			];
     }
}
