<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCmspagetemplateRequest extends FormRequest
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
    return [
				'title' => 'required|min:5|max:50',
				'page_name' => 'required',
				'slug' => 'required',
				'description' => 'required',
                ];
      
    }
}
