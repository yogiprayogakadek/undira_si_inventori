<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdatePasswordRequest extends FormRequest
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
            'new_password' => 'required|same:confirm_password|not_in:12345678|min:8',
            'confirm_password' => 'required|same:new_password|min:8',
        ];

        if (Request::instance()->has('user_id')) {
            $rules += [
                'current_password' => 'nullable|min:8',
            ];
        } else {
            $rules += [
                'current_password' => 'required|min:8',
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => ':attribute tidak boleh kosong',
            'mimes' => ':attribute harus berupa file :values',
            'image' => ':attribute harus berupa file gambar',
            'date' => ':attribute harus berupa tanggal',
            'numeric' => ':attribute harus berupa angka',
            'email' => ':attribute salah format',
            'same' => ':attribute tidak sama',
            'min' => ':attribute minimal :min karakter',
            'new_password.not_in' => 'Mohon gunakan password lainnya'
        ];
    }

    public function attributes()
    {
        return [
            'current_password' => 'Password saat ini',
            'new_password' => 'Password baru',
            'confirm_password' => 'Konfirmasi password',
        ];
    }
}
