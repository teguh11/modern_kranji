<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
    const REQUIRED_FIELD = [
        'name' => 'required',
        'identity_no' => 'required|digits:16',
        'address' => 'required',
        'handphone' => 'required',
        'email' => 'required|email',
        // 'identity_file' => 'required|image'
    ];
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
        return self::REQUIRED_FIELD;
    }
}
