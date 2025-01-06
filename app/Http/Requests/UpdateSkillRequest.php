<?php

namespace App\Http\Requests;

use App\Models\Skill;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSkillRequest extends FormRequest
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
        $rules = Skill::$rules;
        $rules['name'] = 'required|max:15|is_unique:skills,name,'.request()->get('id');

        return $rules;
    }

    /**
     * @return array|string[]
     */
    public function messages()
    {
        return [
            'percentage.max' => 'Percentage not greater than 100.',
        ];
    }
}
