<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengurusController extends Controller
{
    public function index()
    {
        $pengurus = Pengurus::all();
        return view('Admin.adm_pengurus', compact('pengurus'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_atlet' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'nama_atlet.required' => 'Nama Atlet wajib diisi.',
            'nama_atlet.string'   => 'Nama Atlet harus berupa teks.',
            'nama_atlet.max'      => 'Nama Atlet maksimal 255 karakter.',

            'slug.required' => 'Slug wajib diisi.',
            'slug.string'   => 'Slug harus berupa teks.',
            'slug.max'      => 'Slug maksimal 255 karakter.',
            'slug.unique'   => 'Slug sudah digunakan, silakan pilih yang lain.',

            'image.string' => 'Gambar harus berupa path atau nama file yang valid.',
            'image.max'    => 'Nama file gambar maksimal 255 karakter.',
        ]);


        $newName = '';
        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->title . '-' . now()->timestamp . '.' . $extension;
            $request->file('image')->storeAs('foto', $newName);
        }
        $request['gambar_url'] = $newName;

        $perengurus = Pengurus::create($request->all());
        return redirect('admin/upload-pengurus')->withToastSuccess('Pengurus Berhasil Di Tambahkan!');
    }

    public function edit($slug)
    {
        $pengurus = Pengurus::where('slug', $slug)->firstOrFail();

        return view('Admin.PengurusEdit', compact('pengurus'));
    }

    public function update(Request $request, $slug)
    {
        // Cari data program berdasarkan slug lama
        $pengurus = Pengurus::where('slug', $slug)->firstOrFail();

        // Validasi input
        $validated = $request->validate([
            'nama_atlet' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'nama_atlet.required' => 'Nama Atlet wajib diisi.',
            'nama_atlet.string'   => 'Nama Atlet harus berupa teks.',
            'nama_atlet.max'      => 'Nama Atlet maksimal 255 karakter.',

            'image.image'  => 'File harus berupa gambar.',
            'image.mimes'  => 'Gambar harus berekstensi jpg, jpeg, atau png.',
            'image.max'    => 'Ukuran gambar maksimal 2MB.',
        ]);

        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->sport_name . '-' . now()->timestamp . '.' . $extension;
            $request->file('image')->storeAs('foto', $newName);
            $pengurus->foto_url = $newName;
        }

        // Update data lain
        $pengurus->sport_name = $request->nama_atlet;
        $pengurus->slug = $request->slug;
        $pengurus->save();

        return redirect('admin/upload-pengurus')->withToastSuccess('Pengurus Berhasil Diupdate!');
    }
    public function hapus($slug)
    {
        $pengurus = Pengurus::where('slug', $slug)->firstOrFail();

        // Hapus gambar dari storage jika ada
        if ($pengurus->foto_url && Storage::exists('foto/' . $pengurus->foto_url)) {
            Storage::delete('foto/' . $pengurus->foto_url);
        }

        // Hapus data dari database
        $pengurus->delete();

        return redirect()->route('pengurus.index')->withToastSuccess('Pengurus berhasil dihapus.');
    }
    
}
