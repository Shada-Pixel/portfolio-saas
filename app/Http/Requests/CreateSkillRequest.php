<?php

namespace App\Http\Requests;

use App\Models\Skill;
use Illuminate\Foundation\Http\FormRequest;

class CreateSkillRequest extends FormRequest
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
        return  Skill::$rules;
    }

    /**
     * @return array|string[]
     */
    public function messages()
    {
        return [
            'percentage.max' => 'Percentage can\'t be greater than 100.',
        ];
    }
}
