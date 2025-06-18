<?php

namespace App\Http\Controllers;

use App\Models\UserBiodata;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UserBiodataController extends Controller
{
    // Tampilkan semua data
    public function index()
    {
        $users = UserBiodata::where('user_id', auth()->id())->get();
        return view('Admin.user', compact('users'));
    }

    public function profil()
    {
        $user = auth()->user();

        // Cek apakah sudah punya biodata
        $biodata = $user->biodata;

        if (!$biodata) {
            // Jika belum ada, buatkan dengan data default
            $biodata = UserBiodata::create([
                'user_id' => $user->id,
                'nama_user' => $user->name ?? '',
                'email' => $user->email,
                'slug' => Str::slug($user->name ?? 'admin'),
                'telepon' => '',
                'alamat' => '',
                'foto' => null,
            ]);
        }

        return view('Admin.profil', compact('biodata'));
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
            'email' => 'required|email',
            'telepon' => 'required|string|max:20',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        $data = $request->except('foto');
        $data['slug'] = Str::slug($request->nama_user);
        $data['user_id'] = auth()->id();

        // DEBUG STEP 1: cek apakah file dikirim
        if (!$request->hasFile('foto')) {
            dd('TIDAK ADA FILE FOTO DIUPLOAD');
        }

        $file = $request->file('foto');

        // DEBUG STEP 2: cek apakah file valid
        if (!$file->isValid()) {
            dd('FILE FOTO TIDAK VALID');
        }

        // DEBUG STEP 3: simpan file
        $path = $file->store('foto-users', 'public');

        // DEBUG STEP 4: cek apakah berhasil disimpan ke disk
        if (!Storage::disk('public')->exists($path)) {
            dd('GAGAL SIMPAN FOTO KE STORAGE');
        }

        // DEBUG STEP 5: tampilkan path hasil upload
        dd('FOTO BERHASIL DIUPLOAD KE: ' . $path);

        // Jika sudah ok, baru lanjutkan
        $data['foto'] = $path;

        UserBiodata::updateOrCreate(
            ['user_id' => auth()->id()],
            $data
        );

        return redirect()->back()->with('success', 'Profil berhasil disimpan.');
    }




    // Tampilkan detail user
    public function show($id)
    {
        $user = UserBiodata::findOrFail($id);
        return view('user.show', compact('user'));
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $user = UserBiodata::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    // Simpan perubahan
    public function update(Request $request, $id)
    {
        $user = UserBiodata::findOrFail($id);

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
            $data['foto'] = $request->file('foto')->store('foto-users', 'public');
        }

        $user->update($data);

        return redirect()->route('user.index')->with('success', 'Data berhasil diperbarui.');
    }

    // Hapus data
    public function destroy($id)
    {
        $user = UserBiodata::findOrFail($id);

        if ($user->foto) {
            Storage::delete($user->foto);
        }

        $user->delete();

        return redirect()->route('user.index')->with('success', 'Data berhasil dihapus.');
    }
}
