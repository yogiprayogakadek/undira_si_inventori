<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class RequestProduk extends FormRequest
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
            'nama' => "required|string|max:50|min:3",
            // 'nama' => "required|string|max:50|min:3|unique:produk,nama,{$this->id}",
            'keterangan' => 'required',
            // 'jenis' => 'required',
            'stok' => 'required|numeric',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
        ];
        if (!Request::instance()->has('produk_id')) {
            $rules += [
                'status' => 'nullable',
                'foto' => 'required|mimes:jpeg,png,jpg|max:2048',
            ];
        } else {
            $rules += [
                'status' => 'required',
                'foto' => 'nullable|mimes:jpeg,png,jpg|max:2048',
            ];
        }

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
            'nama' => 'Nama',
            'keterangan' => 'Keterangan',
            // 'jenis' => 'Jenis',
            'stok' => 'Stok',
            'harga_jual' => 'Harga jual',
            'harga_beli' => 'Harga beli',
            'status' => 'Status',
            'foto' => 'Foto produk',
        ];
    }
}
