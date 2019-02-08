<?php

namespace App\Http\Requests\Front;

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
        $user = \App\User::where('email', $this->email)->first();
        
        return [
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id)
            ],
             'name' => 'required|string|max:255',
			'username' => 'required|string|max:20|unique:users',
            'password' => 'required|string|min:6|confirmed',
			'role_id' => 'required|string|max:255'
        ];
    }
}
