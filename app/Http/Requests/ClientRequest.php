<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
        return [
            'name' => 'required',
            'identity_no' => 'required|digits:16',
            'address' => 'required',
            'npwp' => 'required',
            'telp_rumah' => 'required',
            'telp_kantor' => 'required',
            'handphone' => 'required',
            'email' => 'required|email',
            'identity_file' => 'required|image'
        ];
    }
}
