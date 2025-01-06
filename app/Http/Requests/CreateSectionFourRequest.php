<?php

namespace App\Http\Requests;

use App\Models\SectionFour;
use Illuminate\Foundation\Http\FormRequest;

class CreateSectionFourRequest extends FormRequest
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
        return SectionFour::$rules;
    }

    /**
     * @return string[]
     */
    public function message()
    {
        return SectionFour::$messages;
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return SectionFour::$customAttributes;
    }
}
