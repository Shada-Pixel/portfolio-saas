<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $rules = [];
        if (getLoggedInUser()->hasRole('super_admin')) {
            $rules = User::$registerUserRules;
            $rules['user_name'] = 'required|max:20|unique:users,user_name,'.$this->route('user')->id;
            $rules['email'] = 'required|max:160|email:filter|unique:users,email,'.$this->route('user')->id;
        } else {
            $rules = User::$rules;
            $rules['email'] = 'required|max:160|email:filter|unique:users,email,'.request()->get('id');
            $rules['phone'] = 'required|unique:users,phone,'.request()->get('id');
        }

        return $rules;
    }
}
