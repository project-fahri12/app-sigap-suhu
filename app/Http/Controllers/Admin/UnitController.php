<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        $unit = Unit::latest()->get();

        return view('admin.dataMaster.unit', compact('unit'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_unit' => 'required|string|max:255|unique:unit,nama_unit',
            'jenis_kelamin' => 'required|in:putra,putri,campur',
        ]);

        Unit::create([
            'nama_unit' => $request->nama_unit,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        return redirect()->back()->with('success', 'Unit berhasil ditambahkan');
    }

    public function destroy($id)
    {
        Unit::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Unit berhasil dihapus');
    }
}
