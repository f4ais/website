<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreWargaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'wilayah_id' => ['required', 'exists:wilayahs,id'],
            'nama' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'digits:16', 'unique:wargas,nik'],
            'alamat' => ['required'],
            'penghasilan' => ['required', 'numeric'],
            'tanggungan' => ['required', 'integer', 'min:0'],
            'kondisi_rumah' => ['required'],
        ];
    }
}