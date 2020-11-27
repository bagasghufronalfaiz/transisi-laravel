<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'nama'      => 'required',
            'logo'      => 'required|image|mimes:png|max:2048|dimensions:min_width=100,min_height=100',
            'email'     => 'required|email:rfc,dns',
            'website'   => 'required'
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required'          => 'Kolom :attribute tidak boleh kosong yaa',
            'logo.image'        => 'Logo harus file gambar',
            'logo.mimes'        => 'Logo harus PNG',
            'logo.max'          => 'Logo tidak boleh lebih besar dari 2048 KB',
            'logo.dimensions'   => 'Panjang dan lebar logo harus lebih besar dari atau sama dengan 100px'
        ];
    }
}
