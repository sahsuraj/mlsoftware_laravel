<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest
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
                    'question' => 'required|min:10',
					'answer' =>  'required|min:10',
					];

                break;
            case 'PUT':
                
                 return [
                     'question' => 'required|min:10',
					'answer' =>  'required|min:10',
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
				'question.required' => 'This Field Is Required',
				'answer.required' => 'This Field Is Required',
			];
     }
}
