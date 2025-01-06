<?php

namespace App\Http\Requests;

use App\Models\FrontCms;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCmsRequest extends FormRequest
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
        if (request()->get('section') == FrontCms::SECTION_ONE) {
            return FrontCms::$sectionOneRules;
        }

        if (request()->get('section') == FrontCms::SECTION_TWO) {
            return FrontCms::$sectionTwoRules;
        }

        if (request()->get('section') == FrontCms::SECTION_FOUR) {
            return FrontCms::$sectionFourRules;
        }
        
        if (request()->get('section') == FrontCms::SECTION_THREE) {
            return FrontCms::$sectionThreeRules;
        }

        if (request()->get('section') == FrontCms::SECTION_FIVE) {
            return FrontCms::$sectionFiveRules;
        }
    }

    /**
     * @return array|string[]
     */
    public function messages()
    {
        if (request()->get('section') == FrontCms::SECTION_ONE) {
            return FrontCms::$sectionOneCustomMessages;
        }
        if (request()->get('section') == FrontCms::SECTION_TWO) {
            return FrontCms::$sectionTwoCustomMessages;
        }

        if (request()->get('section') == FrontCms::SECTION_FOUR) {
            return FrontCms::$sectionFourCustomMessages;
        }
        
        if (request()->get('section') == FrontCms::SECTION_THREE) {
            return FrontCms::$sectionThreeCustomMessages;
        }

        if (request()->get('section') == FrontCms::SECTION_FIVE) {
            return FrontCms::$sectionFiveCustomMessages;
        }
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        if (request()->get('section') == FrontCms::SECTION_ONE) {
            return FrontCms::$sectionOneCustomAttributes;
        }
        if (request()->get('section') == FrontCms::SECTION_TWO) {
            return FrontCms::$sectionTwoCustomAttributes;
        }
        
        if (request()->get('section') == FrontCms::SECTION_FOUR) {
            return FrontCms::$sectionFourCustomAttributes;
        }
        
        if (request()->get('section') == FrontCms::SECTION_THREE) {
            return FrontCms::$sectionThreeCustomAttributes;
        }
        if (request()->get('section') == FrontCms::SECTION_FIVE) {
            return FrontCms::$sectionFiveCustomAttributes;
        }
    }
}
