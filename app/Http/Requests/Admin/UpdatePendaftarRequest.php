<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePendaftarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nik' => 'required|string|min:16|max:20',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'status_santri' => 'required|in:mukim,non_mukim',
            'asal_sekolah' => 'nullable|string|max:50',

            'provinsi' => 'required|string|max:25',
            'kabupaten' => 'required|string|max:25',
            'kecamatan' => 'required|string|max:25',
            'desa' => 'required|string|max:25',
            'rt' => 'nullable|string|max:3',
            'rw' => 'nullable|string|max:3',
            'alamat_detail' => 'required|string|max:255',

            // orang tua
            'nama_ayah' => 'nullable|string|max:255',
            'pekerjaan_ayah' => 'nullable|string|max:255',
            'no_hp_ayah' => 'nullable|string|max:20',
            'status_ayah' => 'nullable|in:hidup,meninggal,tidak_diketahui',

            'nama_ibu' => 'nullable|string|max:255',
            'pekerjaan_ibu' => 'nullable|string|max:255',
            'no_hp_ibu' => 'nullable|string|max:20',
            'status_ibu' => 'nullable|in:hidup,meninggal,tidak_diketahui',

            // wali
            'nama_wali' => 'nullable|string|max:255',
            'hubungan_wali' => 'nullable|in:ayah,ibu,paman,bibi,kakek,nenek,lainnya',
            'no_hp_wali' => 'nullable|string|max:20',
        ];
    }
}
