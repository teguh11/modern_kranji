<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PembeliRequest extends FormRequest
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
            'nama' => 'required',
            'no_ktp' => 'required|digits:16',
            'alamat' => 'required',
            'npwp' => 'required',
            'telp_rumah' => 'required',
            'telp_kantor' => 'required',
            'handphone' => 'required',
            'email' => 'required|email',
        ];
    }
}
