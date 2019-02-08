<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
                    'member_id' => 'required',
					'subject' => 'required|min:2|max:50',
					'message'=> 'required|min:2',
					];

                break;
            case 'PUT':
                
                 return [
                    'member_id' => 'required|min:2|max:50',
					'subject' => 'required|min:2|max:50',
					'message'=> 'required|min:2',
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
				'member_id.required' => 'This Field Is Required',
				'subject.required' => 'This Field Is Required',
				'message.required' => 'This Field Is Required',
			];
     }
}
