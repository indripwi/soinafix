<?php

namespace App\Http\Controllers;

use App\Models\User; // Ganti dengan nama model Anda jika bukan "User"
use App\Models\UserBiodata;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UserBiodataController extends Controller
{
    // Tampilkan semua data
    public function index()
    {
        $users = UserBiodata::all();
        return view('Admin.user', compact('users'));
    }

    // Tampilkan form tambah data
    public function create()
    {
        return view('user.create');
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_user' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'telepon' => 'required|string|max:20',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->nama_user);

        // Simpan file foto jika ada
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto-users');
        }

        $data['user_id'] = auth()->id(); // Jika menggunakan autentikasi

        User::create($data);

        return redirect()->route('user.index')->with('success', 'Data berhasil ditambahkan.');
    }

    // Tampilkan detail user
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('user.show', compact('user'));
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    // Simpan perubahan
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nama_user' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'telepon' => 'required|string|max:20',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->nama_user);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto) {
                Storage::delete($user->foto);
            }
            $data['foto'] = $request->file('foto')->store('foto-users');
        }

        $user->update($data);

        return redirect()->route('user.index')->with('success', 'Data berhasil diperbarui.');
    }

    // Hapus data
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->foto) {
            Storage::delete($user->foto);
        }

        $user->delete();

        return redirect()->route('user.index')->with('success', 'Data berhasil dihapus.');
    }
}
