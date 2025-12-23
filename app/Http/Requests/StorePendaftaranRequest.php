<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePendaftaranRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Data Pendaftar (Wajib diisi)
            'nik' => 'required|string|min:16|max:20|unique:pendaftar,nik',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'status_santri' => 'required|in:mukim,non_mukim',
            'asal_sekolah' => 'required|max:100',
            'provinsi' => 'required|string',
            'kabupaten' => 'required|string',
            'kecamatan' => 'required|string',
            'desa' => 'required|string',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'alamat_detail' => 'required|string|max:255',
            'gelombang_id' => 'required|exists:gelombang,id',
            'unit_id' => 'required|exists:unit,id',
            'sekolah_pilihan_id' => 'required|exists:sekolah_pilihan,id',
            'tahun_ajaran_id' => 'required|exists:tahun_ajaran,id',

            // Data Orang Tua
            'nama_ayah' => 'required|string|max:255',
            'pekerjaan_ayah' => 'nullable|string|max:255',
            'no_hp_ayah' => 'nullable|string|max:20',
            'status_ayah' => 'required|in:hidup,meninggal,tidak_diketahui',
            'nama_ibu' => 'required|string|max:255',
            'pekerjaan_ibu' => 'nullable|string|max:255',
            'no_hp_ibu' => 'nullable|string|max:20',
            'status_ibu' => 'required|in:hidup,meninggal,tidak_diketahui',
            'alamat_orang_tua' => 'nullable|string',

            // Data Wali
            'nama_wali' => 'nullable|string|max:255',
            'pekerjaan_wali' => 'nullable|string|max:255',
            'hubungan_wali' => 'nullable|in:ayah,ibu,paman,bibi,kakek,nenek,lainnya',
            'alamat_wali' => 'nullable|string',
            'no_hp_wali' => 'nullable|string|max:20',
        ];
    }
}
