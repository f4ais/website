<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSurveyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'warga_id' => ['required', 'exists:wargas,id'],
            'pekerjaan' => ['required'],
            'penghasilan' => ['required', 'numeric'],
            'tanggungan' => ['required', 'integer'],
            'kondisi_rumah' => ['required'],
            'status_rumah' => ['required'],
            'memiliki_kendaraan' => ['required', 'boolean'],
            'memiliki_bpjs' => ['required', 'boolean'],
            'catatan' => ['nullable'],
        ];
    }
}