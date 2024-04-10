<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfilRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'nama' => 'required|unique:pengguna,nama,' . $this->id,
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => ':attribute tidak boleh kosong.',
            'unique' => ':attribute sudah ada pada database.',
        ];
    }

    public function attributes()
    {
        return [
            'nama' => 'Nama',
        ];
    }
}
