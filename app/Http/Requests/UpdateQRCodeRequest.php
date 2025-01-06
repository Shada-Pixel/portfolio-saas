<?php

namespace App\Http\Requests;

use App\Models\QRCode;
use Illuminate\Foundation\Http\FormRequest;

class UpdateQRCodeRequest extends FormRequest
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
        $rules = QRCode::$rules;
        $rules['name'] = 'required|is_unique:qr_codes,name,'.$this->route('qrcode');

        return $rules;
    }
}
