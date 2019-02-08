<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class CmsRequest extends FormRequest
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
                    'title' => 'required|min:2|max:200',
					'page_name' => 'required|min:2|max:50',
					'slug' => 'required|min:2|max:50',
					'keywords'=> 'required', 
					'description' => 'required', 
					];

                break;
            case 'PUT':
                
        
                return [
                  
				    'title' => 'required|min:2|max:200',
					'page_name' => 'required|min:2|max:50',
					'slug' => 'required|min:2|max:50',
					'keywords'=> 'required', 
					'description' => 'required', 
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
				    'title' => 'required|min:2|max:200',
					'page_name' => 'required|min:2|max:50',
					'slug' => 'required|min:2|max:50',
					'keywords'=> 'required', 
					'description' => 'required', 
			];
     }
}
