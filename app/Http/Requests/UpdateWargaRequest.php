<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateWargaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'wilayah_id'  => ['required', 'exists:wilayahs,id'],
            'nama'        => ['required'],
            'nik'         => [
                'required',
                'digits:16',
                Rule::unique('wargas')->ignore($this->warga) // Ini sudah benar!
            ],
            // TAMBAHKAN FIELD DI BAWAH INI:
            'alamat'      => ['required'],
            'penghasilan' => ['required'],
            'tanggungan'  => ['required'],
        ];
    }
}