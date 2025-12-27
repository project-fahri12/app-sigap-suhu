<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AkunController extends Controller
{
    public function index()
    {
        $dataPengguna = User::latest()->paginate(10);
        return view('admin.dataAkun.index', compact('dataPengguna'));
    }

    public function simpan(Request $request)
    {
        $validasi = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role'     => 'required|in:admin,petugas,pendaftar'
        ]);

        User::create([
            'name'     => $validasi['name'],
            'email'    => $validasi['email'],
            'password' => Hash::make($validasi['password']),
            'role'     => $validasi['role'],
        ]);

        return back()->with('sukses', 'Akun pengguna berhasil ditambahkan.');
    }

    public function ubah(Request $request, $id)
    {
        $pengguna = User::findOrFail($id);

        $validasi = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role'  => 'required|in:admin,petugas,pendaftar'
        ]);

        $pengguna->name = $request->name;
        $pengguna->email = $request->email;
        $pengguna->role = $request->role;

        if ($request->filled('password')) {
            $pengguna->password = Hash::make($request->password);
        }

        $pengguna->save();

        return back()->with('sukses', 'Data akun berhasil diperbarui.');
    }

    public function hapus($id)
    {
        $pengguna = User::findOrFail($id);

        // Proteksi agar tidak menghapus diri sendiri
        if ($pengguna->id === Auth::id()) {
            return back()->with('gagal', 'Anda tidak dapat menghapus akun sendiri.');
        }

        $pengguna->delete();
        return back()->with('sukses', 'Akun berhasil dihapus.');
    }
}
