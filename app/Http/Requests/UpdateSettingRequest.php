<?php

namespace App\Http\Requests;

use App\Models\Setting;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
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
        if (getUser()->hasRole('super_admin')) {
            if (request()->get('sectionName') == 'privacy-settings') {
                return [
                    'privacy_policy'   => 'required',
                    'terms_conditions' => 'required',
                ];
            }  if (request()->get('sectionName') == 'social-settings') {
                return [
                    's6_text_title'   => 'required|string|max:30',      
                    's6_text_secondary' => 'required|string|max:100',
                ];
            } else {
                return Setting::$adminRules;
            }
        } else {
            if (request()->get('sectionName') == 'general') {
                return Setting::$rules;
            } if (request()->get('sectionName') == 'social-settings') {
                return [
                    'value'   => 'nullable',
                ];
            }  
        }
    }
    
    /** 
     *@return array|string[]
     */
    public function attributes()
    {
        return Setting::$socialSetting;
    }
}
