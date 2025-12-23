<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBerkasRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'file' => 'required|file|mimes:pdf|max:5120',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => 'Berkas PDF wajib diupload.',
            'file.mimes' => 'Berkas harus berupa PDF.',
            'foto.required' => 'Pas foto wajib diupload.',
            'foto.image' => 'Pas foto harus berupa gambar.',
        ];
    }
}
