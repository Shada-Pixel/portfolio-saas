<?php

namespace App\Http\Requests;

use App\Models\SectionThree;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSectionThreeRequest extends FormRequest
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
        $rules = SectionThree::$rules;
        $rules['s3_text_title'] = 'required|string|max:30';
        $rules['s3_image_main'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        $rules['image_url'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048';

        return $rules;
    }

    /**
     * @return array|string[]
     */
    public function messages()
    {
        return SectionThree::$messages;
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return SectionThree::$customAttributes;
    }
}
