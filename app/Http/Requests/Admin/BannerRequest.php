<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
                    'name' => 'required',
					'meta_description' =>  'required',
					];

                break;
            case 'PUT':
                
                 return [
                     'name' => 'required',
					'meta_description' =>  'required',
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
				'name.required' => 'This Field Is Required',
				'meta_description.required' => 'This Field Is Required',
			];
     }
}
