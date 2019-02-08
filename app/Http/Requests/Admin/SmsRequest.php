<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class SmsRequest extends FormRequest
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
                    'slug' => 'required|min:2|max:50',
					'phone_from' => 'required|digits_between:10,10|numeric', 
					'from_name' => 'required|min:2|max:50',
					'content'=> 'required|min:2|max:200',
					];

                break;
            case 'PUT':
                
                 return [
                    'slug' => 'required|min:2|max:50',
					'phone_from' => 'required|digits_between:10,15|numeric', 
					'from_name' => 'required|min:2|max:50',
					'content'=> 'required|min:2|max:200',
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
				'slug.required' => 'This Field Is Required',
				'phone_from.required' => 'This Field Is Required',
				'from_name.required' => 'This Field Is Required.',
				'content.required' => 'This Field Is Required',
			];
     }
}
