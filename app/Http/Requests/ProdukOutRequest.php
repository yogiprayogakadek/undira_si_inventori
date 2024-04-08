<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdukOutRequest extends FormRequest
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
        $rules =  [
            // 'supplier_id' => 'required',
            'data' => 'required|array|min:1',
            // 'produk_id' => 'required',
            // 'kategori' => 'required',
            'tanggal_proses' => 'required|date',
            // 'jumlah' => 'required|numeric',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => ':attribute tidak boleh kosong',
            'min' => ':attribute minimal :min karakter',
            'max' => ':attribute maksimal :max karakter',
            'unique' => ':attribute sudah digunakan',
            'mimes' => ':attribute harus berupa file :values',
            'image' => ':attribute harus berupa file gambar',
            'same' => ':attribute tidak sama dengan :other',
            'date' => ':attribute harus berupa tanggal',
            'numeric' => ':attribute harus berupa angka',
            'regex' => ':attribute panjang 12 karakter',
        ];
    }

    public function attributes()
    {
        return [
            // 'supplier_id' => 'Nama supplier',
            'data' => 'Produk',
            'tanggal_proses' => 'Tanggal',
            // 'kategori' => 'Kategori',
            // 'jumlah' => 'Jumlah',
        ];
    }
}

