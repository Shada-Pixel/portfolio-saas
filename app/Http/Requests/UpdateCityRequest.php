<?php

namespace App\Http\Requests;

use App\Models\City;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCityRequest extends FormRequest
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
        $rules = City::$rules;
        $rules['name'] = 'required|string|max:170|unique:cities,name,'.$this->route('city')->id;

        return $rules;
    }
}
