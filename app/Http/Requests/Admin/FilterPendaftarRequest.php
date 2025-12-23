<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FilterPendaftarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'tahun_ajaran' => 'nullable|exists:tahun_ajaran,id',
            'gelombang'    => 'nullable|exists:gelombang,id',
            'status'       => 'nullable|in:valid,pending,ditolak',
            'search'       => 'nullable|string|max:100',
        ];
    }
}
