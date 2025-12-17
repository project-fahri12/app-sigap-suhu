<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SekolahPilihan;
use Illuminate\Http\Request;

class SekolahPilihanController extends Controller
{
    public function index()
    {
        $sekolah = SekolahPilihan::latest()->get();
        return view('admin.dataMaster.sekolahPilihan', compact('sekolah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_sekolah' => 'required|string|max:255|unique:sekolah_pilihan,nama_sekolah',
            'jenjang' => 'required|in:RA/TK,SD/MI,SLTA,SLTP,PERGURUAN TINGGI,SALAF'
        ]);


        SekolahPilihan::create([
            'nama_sekolah' => $request->nama_sekolah,
            'jenjang' => $request->jenjang
        ]);

        return redirect()->back()->with('success', 'Sekolah berhasil ditambahkan');
    }

    public function destroy($id)
    {
        SekolahPilihan::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Sekolah berhasil dihapus');
    }
}
