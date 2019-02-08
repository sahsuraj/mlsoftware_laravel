<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGeneralSettingRequest extends FormRequest
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
				'site_name' => 'required',
				'site_url' => 'required',
				'admin_from_email' => 'required|email',
				'admin_email' => 'required|email',
				'meta_title' => 'required',
				'meta_keyword' => 'required',
				'meta_description' => 'required',
				'referral_link' => 'required',
				'google_analytics' => 'required',
				'footer_content' => 'required',
				'company_address' => 'required',
				'site_title' => 'required',
                ];
      
    }
}
