<?php

namespace App\Http\Requests;

use App\Models\SectionFive;
use Illuminate\Foundation\Http\FormRequest;

class CreateSectionFiveRequest extends FormRequest
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
        return SectionFive::$rules;
    }

    /**
     * @return array|string[]
     */
    public function messages()
    {
        return SectionFive::$messages;
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return SectionFive::$customAttributes;
    }
}
