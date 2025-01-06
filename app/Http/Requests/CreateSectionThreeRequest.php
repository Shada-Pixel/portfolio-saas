<?php

namespace App\Http\Requests;

use App\Models\SectionThree;
use Illuminate\Foundation\Http\FormRequest;

class CreateSectionThreeRequest extends FormRequest
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
        return SectionThree::$rules;
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
