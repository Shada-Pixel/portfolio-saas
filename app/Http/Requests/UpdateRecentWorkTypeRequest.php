<?php

namespace App\Http\Requests;

use App\Models\RecentWorkType;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRecentWorkTypeRequest extends FormRequest
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
        $rules = RecentWorkType::$rules;
        $rules['name'] = 'required|is_unique:recent_work_types,name,'.request()->get('id');

        return $rules;
    }
}
