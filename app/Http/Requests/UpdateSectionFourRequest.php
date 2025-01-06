<?php

namespace App\Http\Requests;

use App\Models\SectionFour;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSectionFourRequest extends FormRequest
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
        $rules = SectionFour::$rules;
        $rules['s4_text_title'] = 'required|string|max:30';
        $rules['s4_text_secondary'] = 'required|string|max:30';
        
        return $rules;
    }

    /**
     * @return array|string[]
     */
    public function messages()
    {
       return SectionFour::$messages;
    }

    /**
     * @return array|string[]
     */
    public function attributes()
    {
        return SectionFour::$customAttributes;
    }
}
